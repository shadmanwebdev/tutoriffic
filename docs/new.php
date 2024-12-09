<?php


require_once 'StripeClient.php'; // Include Stripe library

// Process payment using Google Pay and Stripe
function processPayment($googlePayToken, $adId, $accountId) {
    try {
        // Initialize Stripe client
        $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');

        // Extract Google Pay payment token details
        $googlePayToken = json_decode($googlePayToken, true);
        $paymentMethodId = $googlePayToken['id'];

        // Create a PaymentMethod
        $googlePayPaymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => ['token' => $paymentMethodId],
        ]);

        // Create a Payment Intent
        $paymentIntent = $stripe->paymentIntents->create([
            'payment_method' => $googlePayPaymentMethod->id,
            'payment_method_types' => ['card'],
            'amount' => 1000, // Example: 1000 cents = $10
            'currency' => 'usd',
            'application_fee_amount' => 100, // 10 = $0.10 (10% commission)
            'capture_method' => 'manual',
            'confirm' => true,
            'transfer_data' => ['destination' => $accountId],
        ]);

        // Save payment data in the database
        savePaymentData($paymentIntent, $adId);

    } catch (\Stripe\Exception\CardException $e) {
        echo 'Card Error: ' . $e->getMessage();
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Save payment intent details to the database
function savePaymentData($paymentIntent, $adId) {
    $paymentIntentId = $paymentIntent->id;
    $paymentMethod = $paymentIntent->payment_method;
    $connectedAccountId = $paymentIntent->transfer_data->destination;
    $amount = $paymentIntent->amount;
    $currency = $paymentIntent->currency;
    $createdAt = $paymentIntent->created;
    $paymentStatus = $paymentIntent->status;

    // Get tutor and student details
    $studentId = get_uid();
    $ad = new Ad;
    $adArray = $ad->get_single_ad($adId);
    $tutorId = $adArray['tutor_uid'];

    // Create a booking request
    $request = new Request();
    $res = $request->create_request($studentId, $tutorId);
    $requestResponse = json_decode($res, true);

    if ($requestResponse['status'] == '1') {
        $requestId = $requestResponse['request_id'];

        // Save payment details
        $pay = new StripePayment;
        $pay->create_payment_intent(
            $paymentIntentId, $paymentMethod, $connectedAccountId,
            $amount, $currency, $createdAt, $paymentStatus, 
            $studentId, $tutorId, $requestId
        );
    }
}

// Handle post-lesson fund release and commission
function releaseFunds($lessonId) {
    // Fetch lesson details
    $lesson = getLessonDetails($lessonId);
    $amount = $lesson['amount'];
    $tutorAccountId = $lesson['tutor_account_id'];
    $studentId = $lesson['student_id'];
    $tutorId = $lesson['tutor_id'];

    // Calculate tutor's share (90%)
    $tutorAmount = $amount * 0.9;

    // Release funds via Stripe
    $stripe = new \Stripe\StripeClient('sk_test_...');
    $stripe->transfers->create([
        'amount' => $tutorAmount,
        'currency' => 'usd',
        'destination' => $tutorAccountId,
        'transfer_group' => $lessonId,
    ]);

    // Update lesson payment status
    updateLessonPaymentStatus($lessonId, 'completed');
}

// Handle refund policies
function processRefund($lessonId, $cancelType) {
    $lesson = getLessonDetails($lessonId);
    $paymentIntentId = $lesson['payment_intent_id'];

    // Check cancellation/refund policies
    if ($cancelType === 'student_within_24h' || $cancelType === 'tutor_within_24h') {
        refundPayment($paymentIntentId);
        updateLessonPaymentStatus($lessonId, 'refunded');
    } elseif ($cancelType === 'student_before_24h' || $cancelType === 'tutor_before_24h') {
        refundPayment($paymentIntentId);
        updateLessonPaymentStatus($lessonId, 'refunded');
    } else {
        // No refund allowed
        return false;
    }
}

// Refund payment through Stripe
function refundPayment($paymentIntentId) {
    $stripe = new \Stripe\StripeClient('sk_test_...');
    $stripe->refunds->create(['payment_intent' => $paymentIntentId]);
}



