<?php
    // Include necessary files
    require 'vendor/autoload.php'; // Make sure you include Stripe's PHP SDK (use Composer for installation)
    require 'path/to/your/StripePaymentClass.php'; // Adjust the path to where your classes are located

    use Stripe\StripeClient;

    function captureFunds() {
        // Initialize Stripe client
        $stripe = new StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');
        
        // Fetch pending payments eligible for capture
        $payments = getPendingPayments();
        
        foreach ($payments as $payment) {
            $lessonEndTime = strtotime($payment['lesson_end_time']);
            $currentTime = time();

            // Ensure 24 hours have passed since the lesson end
            if (($currentTime - $lessonEndTime) >= 86400) {
                try {
                    // Capture the payment
                    $stripe->paymentIntents->capture($payment['payment_intent_id']);
                    
                    // Update payment status in the database
                    markPaymentCaptured($payment['id']);
                    echo "Captured payment: " . $payment['payment_intent_id'] . "\n";
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    echo 'Payment Capture Error: ' . $e->getMessage() . "\n";
                }
            }
        }
    }

    function getPendingPayments() {
        // Placeholder: Fetch payments from your database that are pending and eligible for capture
        // Replace this with your actual database logic

        return [
            // Example array of payments
            [
                'id' => 1,
                'payment_intent_id' => 'pi_1GqAZnH4Jt7ABCDv74X35P9H',
                'lesson_end_time' => '2024-12-08 14:00:00', // Example lesson end time
            ],
            // More payment records can go here
        ];
    }

    function markPaymentCaptured($paymentId) {
        // Placeholder: Update the database to mark this payment as captured
        // Replace this with your actual database logic
        echo "Payment ID " . $paymentId . " marked as captured.\n";
    }

    // Run the function to capture funds
    captureFunds();
?>
