<?php

    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }

    include '../functions.php';
    // $config = include '../partials/config.php';
    include '../Classes/Db.php';
    include '../Classes/Ad.php';
    include '../Classes/Request.php';
    include '../Classes/StripePayment.php';

    require_once '../vendor/autoload.php';

    // var_dump($config);
    
// User is logged in
if(isset($_SESSION['user'])) {
    try {

        $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');

        // Connected Merchant Account
        $connectedAccountId = $_POST['account_id'];

        // Extract Google Pay payment token details
        $google_pay_payment_token = json_decode($_POST['google_pay_payment_token'], true);


        $paymentMethodId = $google_pay_payment_token['id'];


        // Create a PaymentMethod using the Google Pay payment token
        $googlePayPaymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'token' => $paymentMethodId,
            ],
        ]);

        // Create a Payment Intent
        $paymentIntent = $stripe->paymentIntents->create([
            'payment_method' => $googlePayPaymentMethod->id,
            'payment_method_types' => ['card'], // Replace with the actual payment method (e.g., card token)
            'amount' => 1000, // 100 cents = $1.00
            'currency' => 'usd',
            'application_fee_amount' => 100, // 10 = $0.10, Replace with any application fee if applicable
            'capture_method' => 'manual', // Merchant will manually capture
            'confirm' => true, // Confirm this PaymentIntent immediately
            'transfer_data' => [ // (Connect only)
                'destination' => $connectedAccountId
            ],
        ]);

        // var_dump($paymentIntent);


        $paymentIntentId = $paymentIntent->id;
        $paymentMethod = $paymentIntent->payment_method;
        $connectedAccountId = $paymentIntent->transfer_data->destination;
        $amount = $paymentIntent->amount;
        $currency = $paymentIntent->currency;
        $createdAt = $paymentIntent->created;
        $paymentStatus = $paymentIntent->status;

        // var_dump($paymentIntentId, $paymentMethod, $connectedAccountId, $amount, $currency, $createdAt, $paymentStatus);
        
   
        // Student
        $studentId = get_uid();
        
        // Tutor
        $ad = new Ad;
        $ad_array = $ad->get_single_ad($_POST['ad_id']);
        $tutorId  = $ad_array['tutor_uid'];

        // Create Request
        $request = new Request();
        $res = $request->create_request($studentId, $tutorId);

        // var_dump($res);

        $request_response = json_decode($res, true);

        $status = $request_response['status'];
        
        // Request Created
        if($status == '1') {
            $request_id = $request_response['request_id'];

            // Insert Payment Intent into Database
            $pay = new StripePayment;
            $res = $pay->create_payment_intent($paymentIntentId, $paymentMethod, $connectedAccountId, $amount, $currency, $createdAt, $paymentStatus, $studentId, $tutorId, $request_id);
        }


    } catch (\Stripe\Exception\CardException $e) {
        // Handle card errors
        echo 'Card Error: ' . $e->getMessage();
    } catch (\Stripe\Exception\RateLimitException $e) {
        // Handle rate limit errors
        echo 'Rate Limit Error: ' . $e->getMessage();
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle invalid request errors
        echo 'Invalid Request Error: ' . $e->getMessage();
    } catch (\Stripe\Exception\AuthenticationException $e) {
        // Handle authentication errors
        echo 'Authentication Error: ' . $e->getMessage();
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Handle API connection errors
        echo 'API Connection Error: ' . $e->getMessage();
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle generic API errors
        echo 'API Error: ' . $e->getMessage();
    } catch (Exception $e) {
        // Handle other exceptions
        echo 'Error: ' . $e->getMessage();
    }
}
?>