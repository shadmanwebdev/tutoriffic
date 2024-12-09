<?php


class StripePayment extends Db {
    public function __construct() {
        $this->stripe_secret = 'sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9';
        $this->con = $this->con();
    }

    public function create_payment_intent($paymentIntentId, $paymentMethod, $connectedAccountId, $amount, $currency, $createdAt, $paymentStatus, $studentId, $tutorId, $request_id) {
        $sql = "INSERT INTO payment_intents (payment_intent_id, payment_method, connected_account_id, amount, currency, created_at, payment_status, student_id, tutor_id, request_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        $stmt->bind_param("sssisisiii", $paymentIntentId, $paymentMethod, $connectedAccountId, $amount, $currency, $createdAt, $paymentStatus, $studentId, $tutorId, $request_id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        echo $status;
        
    }
    public function cancel_request($request_status, $request_id) {
        $sql = "UPDATE requests SET request_status = ? WHERE request_id = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $request_status, $request_id);
        $stmt->execute();
        $stmt->close();

        // Payment Intent
        $sql = "SELECT * FROM payment_intents WHERE request_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        // Payment Intent Id
        $payment_intent_id = $data[0]['payment_intent_id'];

        // Cancel Payment
        $this->cancel($payment_intent_id);
    }
    public function refund_request($request_status, $request_id) {
        $sql = "UPDATE requests SET request_status = ? WHERE request_id = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $request_status, $request_id);
        $stmt->execute();
        $stmt->close();

        // Payment Intent
        $sql = "SELECT * FROM payment_intents WHERE request_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        // Payment Intent Id
        $payment_intent_id = $data[0]['payment_intent_id'];

        // Cancel Payment
        $this->refund($payment_intent_id);
    }
    public function update_payment_intent($paymentIntentId, $paymentStatus, $cancelledAt = null) {
        $sql = "UPDATE payment_intents SET payment_status = ?, canceled_at = ? WHERE payment_intent_id = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $paymentStatus, $cancelledAt, $paymentIntentId);
        $stmt->execute();
        $stmt->close();
        
        // Add error handling as needed
    }
    public function get_payments($filters) {
        $sql = "SELECT * FROM payment_intents WHERE ";
        $params = array();
        
        $paramTypes = ''; // String to store types for bind_param
    
        foreach ($filters as $key => $value) {
            switch ($key) {
                case 'payment_status':
                    if ($value === 'pending') {
                        $sql .= "payment_status IN ('requires_payment_method', 'requires_capture', 'requires_confirmation', 'requires_action', 'processing') AND ";
                    } elseif ($value === null) {
                        $sql .= "payment_status IN ('requires_payment_method', 'requires_capture', 'requires_confirmation', 'requires_action', 'processing', 'succeeded') AND ";
                    } elseif ($value === 'cancelled') {
                        $sql .= "payment_status = 'cancelled' AND ";
                    }
                    break;
    
                default:
                    if ($value == null) {
                        $sql .= "";
                    } else {
                        $sql .= "$key = ? AND ";
                        $params[] = $value;
    
                        // Determine the type and add to paramTypes
                        $paramTypes .= (is_int($value) ? 'i' : 's');
                    }
                    break;
            }
        }

        
    
        // Remove the trailing "AND"
        $sql = rtrim($sql, 'AND ');

        // var_dump($sql);
    
        $stmt = $this->con->prepare($sql);
    
        // Combine paramTypes with the string for the other placeholders
        $types = $paramTypes . str_repeat('s', count($params) - strlen($paramTypes));
        $stmt->bind_param($types, ...$params);
    
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        // var_dump($data);
        return $data;
    }
    
    public function get_payment_intent($payment_intent_id) {
        $sql = "SELECT * FROM payment_intents WHERE payment_intent_id=? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $payment_intent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        // var_dump($data);
        return $data[0];
    }
    public function retrieve_payments($filters) {
        $payments = $this->get_payments($filters);

        $paymentsStr = "<div class='subscriptions'>
            <h6>Payments</h6>
        ";

        if(count($payments) > 0) {
            foreach($payments as $payment) {
                $payment_intent_id = $payment['payment_intent_id'];
                $paymentsStr .= $this->show_retrieved_single($payment_intent_id);
            }
        }

        $paymentsStr .= "</div>";
        echo $paymentsStr;
    }



    public function retrieve($payment_intent_id) {
        // Retrieve a Payment Intent
        $stripe = new \Stripe\StripeClient($this->stripe_secret);        
        $paymentIntent = $stripe->paymentIntents->retrieve($payment_intent_id, []);
        // var_dump($paymentIntent);
        return $paymentIntent;
    }
    public function get_payment_user($uid) {
        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }
    public function show_retrieved_single($payment_intent_id) {
        // From Stripe
        $paymentIntent =  $this->retrieve($payment_intent_id);
        // var_dump($paymentIntent);
        $paymentIntentStatus = $paymentIntent['status'];

        // From Database
        $payment_intent =  $this->get_payment_intent($payment_intent_id);

        // Account Type
        $account_type_id = user_account_type_id(); // 2 = Student, 3 = Tutor

        // From / To
        $user_array = ($account_type_id == '2') ? $this->get_payment_user($payment_intent['tutor_id']) : $this->get_payment_user($payment_intent['student_id']);
        

        // Payment Status Changed
        if($payment_intent['payment_status'] != $paymentIntentStatus) {
            $cancelled_at = ($paymentIntent['status'] == 'canceled') ? $paymentIntent['canceled_at'] : null;
            
            // Update Database
            $this->update_payment_intent($payment_intent_id, $paymentIntentStatus, $cancelled_at);
        }
        

        $paymentRow = "";

        $status_array_1 = array('requires_capture', 'requires_payment_method', 'requires_action', 'processing');

        // Payment Intent Status
        if(in_array($paymentIntent["status"], $status_array_1)) {
            $state = 'Pending';
        } elseif ($paymentIntent["status"] == 'requires_confirmation') {
            $state = 'Requires Confirmation';
        } elseif ($paymentIntent["status"] == 'canceled') {
            $state = 'Canceled';
        } elseif ($paymentIntent["status"] == 'succeeded') {
            $state = 'Confirmed';
        }


        $paymentActionsColumn = "";

        // Display Action Buttons for Payment Recipients
        if($account_type_id != '2') {
            // Payment Action Buttons
            if(in_array($paymentIntent["status"], $status_array_1)) {
                $paymentActionsColumn .= "<div class='payment-actions'>
                    <span class='btn capture stripe-btn' onclick='capture(\"{$paymentIntent['id']}\");'>Accept</span>
                    <span class='btn cancel stripe-btn' onclick='cancel(\"{$paymentIntent['id']}\");'>Cancel</span>
                </div>";
            } elseif($paymentIntent["status"] == 'requires_confirmation') {
                $paymentActionsColumn .= "<div class='payment-actions'>
                    <span class='btn cancel stripe-btn' onclick='cancel(\"{$paymentIntent['id']}\");'>Cancel</span>
                </div>";
            } else {
                $paymentActionsColumn .= "<div class='payment-actions'></div>";
            }
        }

        $created_at = unix_to_datetime($payment_intent['created_at']);

        $paymentRow .= "<div class='payment-row'>";

        // Amount
        $cents_to_dollar = $payment_intent['amount'] / 100;
        $decimal_amount = number_format($cents_to_dollar, 2);
        // Currency
        $cur = strtoupper($payment_intent['currency']);

        $paymentRow .= "<div class='subscription-row'>
            <div class='subscription-column'>
                <b>{$user_array['firstname']} {$user_array['lastname']}</b>
            </div>
            <div class='subscription-column'>
                {$cur} {$decimal_amount}
            </div>
            <div class='subscription-column' style='text-transform: capitalize;'>
                <span class='status'>$state</span>
            </div>
            <div class='subscription-column'> 
                $paymentActionsColumn
            </div>
        </div>";

        
        $paymentRow .= "</div>";

        return $paymentRow;
    }
    // Cancel
    public function cancel($payment_intent_id) {
        /* 
            Only a PaymentIntent with one of the following statuses may be canceled: 
            requires_payment_method, requires_capture, requires_confirmation, requires_action, processing.
        */
        // Cancel a Payment Intent
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
        $paymentIntent = $stripe->paymentIntents->cancel($payment_intent_id, []);
        // var_dump($paymentIntent);
        $paymentIntent = json_encode($paymentIntent, true);
        return $paymentIntent;
    }
    // Capture
    public function capture($payment_intent_id) {
        // Capture a Payment Intent
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
        $paymentIntent = $stripe->paymentIntents->capture($payment_intent_id, [
            'amount_to_capture' => 100, // Any additional amount is refunded
            'application_fee_amount' => 10 // (Connect only)
        ]);
        $paymentIntent = json_encode($paymentIntent, true);
        // var_dump($paymentIntent);
        return $paymentIntent;
    }
    // Refund
    public function refund($payment_intent_id) {
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
        $refund = $stripe->refunds->create([
            'payment_intent' => $payment_intent_id,
        ]);
        return $refund;
    }
    public function retrieve_single_refund($refund_id) {
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
        $stripe->refunds->retrieve($refund_id, []);
        return $refund;
    }
    public function cancel_refund($refund_id) {
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
        $stripe->refunds->cancel($refund_id, []);
        return $refund;
    }





    

    function savePaymentData($paymentIntent, $adId) {
        $studentId = get_uid();
        $ad = new Ad();
        $ad_array = $ad->get_single_ad($adId);
        $tutorId = $ad_array['tutor_uid'];
    
        $paymentIntentId = $paymentIntent->id;
        $amount = $paymentIntent->amount;
        $currency = $paymentIntent->currency;
        $createdAt = $paymentIntent->created;
        $paymentStatus = $paymentIntent->status;
    
        // Insert into database
        $pay = new StripePayment();
        $pay->create_payment_intent(
            $paymentIntentId, null, $paymentIntent->transfer_data->destination,
            $amount, $currency, $createdAt, $paymentStatus, $studentId, $tutorId, $adId
        );
    }
    function markPaymentCaptured($paymentId) {
        // Placeholder: Update the database to mark this payment as captured
        // Replace this with your actual database logic
        echo "Payment ID " . $paymentId . " marked as captured.\n";
    }
    function captureFunds() {
        $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');
        
        // Fetch pending payments eligible for capture
        $payments = $this->getPendingPayments(); // Retrieve payments from the database
        
        foreach ($payments as $payment) {
            $lessonEndTime = strtotime($payment['lesson_end_time']);
            $currentTime = time();
    
            // Ensure 24 hours have passed since the lesson end
            if (($currentTime - $lessonEndTime) >= 86400) {
                try {
                    // Capture payment
                    $stripe->paymentIntents->capture($payment['payment_intent_id']);
    
                    // Update payment status in the database
                    $this->markPaymentCaptured($payment['id']);
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    logError('Payment Capture Error: ' . $e->getMessage());
                }
            }
        }
    }
    
    public function getPendingPayments() {
        $sql = "SELECT * FROM payment_intents WHERE payment_status = 'requires_capture'";

        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if (count($data) > 0) {
            return $data;
        } else {
            return array();
        }
    }

    function processRefund($paymentIntentId) {
        $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');
    
        try {
            // Create a refund
            $stripe->refunds->create(['payment_intent' => $paymentIntentId]);
    
            // Update database to mark refund processed
            markRefundProcessed($paymentIntentId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            logError('Refund Error: ' . $e->getMessage());
        }
    }
    public function getPendingPayments() {
        // Get the current timestamp
        $currentTimestamp = time();
        
        // Define the SQL query to fetch payment intents with 'requires_capture' status
        $sql = "SELECT * FROM payment_intents WHERE payment_status = 'requires_capture' LIMIT 1";
        
        // Prepare the SQL statement
        $stmt = $this->con->prepare($sql);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Fetch the data into an associative array
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        // Check if any payments are found
        if (count($data) > 0) {
            $payment = $data[0];
            
            // Check if the payment is about to expire (e.g., within the last 24 hours of the authorization window)
            $paymentCreatedAt = $payment['created_at'];
            $expirationThreshold = 7 * 24 * 60 * 60; // 7 days expiration window in seconds
            $timeSinceCreated = $currentTimestamp - $paymentCreatedAt;
            
            if ($timeSinceCreated > $expirationThreshold) {
                // Handle reauthorization (either create a new payment intent or reauthorize the existing one)
                // For example, call a method to reauthorize the payment:
                $this->reauthorizePayment($payment['payment_intent_id']);
            }
            
            return $payment;
        } else {
            return null; // Return null if no pending payments found
        }
    }
    
    public function reauthorizePayment($paymentIntentId) {
        // Implement the logic to reauthorize the payment
        // This might involve creating a new payment intent or using Stripe's API to reauthorize the existing payment.
        try {
            $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');
            
            // Reauthorize the payment intent
            $paymentIntent = $stripe->paymentIntents->confirm($paymentIntentId);
            
            // Update the payment status and other relevant details in your database
            $this->updatePaymentStatus($paymentIntentId, 'requires_capture');
            
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo 'Error reauthorizing payment: ' . $e->getMessage();
        }
    }
    
}


?>