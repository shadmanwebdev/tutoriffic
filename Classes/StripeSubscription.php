<?php
/*
    1. Display Subscriptions
        -> retrieve_subscriptions($filters)
            -> get_subscriptions($filters)
            -> Loop
                -> show_retrieved_single($subscription_id)
                    -> retrieve_subscription($subscription_id)
                    -> update_payment_intent($subscription_id, $stripeSubscriptionStatus, $cancelled_at)
*/


class StripeSubscription extends Db {
    public function __construct() {
        $this->stripe_secret = 'sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9';
        $this->con = $this->con();
    }
    
    public function create_subscription($subscriptionData, $account_id) {
        // Extract values from the subscription data
        $id = $subscriptionData->id;
        $customer_id = $subscriptionData->customer;
        $collection_method = $subscriptionData->collection_method;
        $created_at = $subscriptionData->created;
        $current_period_end = $subscriptionData->current_period_end;
        $subscription_status = $subscriptionData->status;
        $days_until_due = $subscriptionData->days_until_due;
    
        // Extract additional information
        $invoice_id = $subscriptionData->latest_invoice;
    
        // Extract payment information
        $payment_amount = $subscriptionData->items->data[0]->price->unit_amount;
        $currency = $subscriptionData->items->data[0]->price->currency;
        $subscription_interval = $subscriptionData->items->data[0]->price->recurring->interval;
    
        // Get tutor ID from stripe_accounts table
        $tutor_id = $this->stripe_tutor_id($account_id);
    
        // Get student ID using the get_uid() function
        $student_id = get_uid();

    
        // Prepare the SQL statement
        $sql = "INSERT INTO subscriptions (id, customer_id, collection_method, created_at, current_period_end, subscription_status, days_until_due, invoice_id, account_id, payment_amount, currency, subscription_interval, tutor_id, student_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        $stmt->bind_param("ssssssssssssss", $id, $customer_id, $collection_method, $created_at, $current_period_end, $subscription_status, $days_until_due, $invoice_id, $account_id, $payment_amount, $currency, $subscription_interval, $tutor_id, $student_id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        return $status;
    }
    public function connected_account_details($uid, $account_id, $account_type, $email, $fullname, $city, $country, $line1, $line2, $postal_code, $state, $charges_enabled, $payouts_enabled, $requirements, $created_at) {
        $sql = "INSERT INTO stripe_accounts (user_id, account_id, account_type, email, fullname, city, country, line1, line2, postal_code, state, charges_enabled, payouts_enabled, requirements, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
                
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param('issssssssssssss', $uid, $account_id, $account_type, $email, $fullname, $city, $country, $line1, $line2, $postal_code, $state, $charges_enabled, $payouts_enabled, $requirements, $created_at);
        if ($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';                
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        // echo $status;
    }
    public function get_payment_method() {
        $uid = get_uid();
        $sql = "SELECT * FROM stripe_accounts WHERE user_id=?";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        $stmt->bind_param('i', $uid);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
    }
    public function show_payment_method() {
        $payment_method_array = $this->get_payment_method();


        // <p class='text'>In order to pay your tutors, you must register a means of payment.</p>
        if(count($payment_method_array) > 0) {
            $tutor_uid = get_uid();

            $connected_account_id = $this->get_account_id($tutor_uid);

            $method = "
            <div class='methods-payment'>
                <h3 class='title'>Method of Payment</h3>
                <p class='text'>You have a stripe account connected to receive payments</p>
                <div class='add-means'>
                    <div class='wrapper-svg'>
                        <div>
                            <img src='./assets/icons8-card-payment-50.png' alt=''>
                        </div>
                    </div>
                    <p class='text'>Stripe Account Connected</p>
                    <span class='ion-android-close' onclick=' onclick='disconnect_stripe_account(\"$connected_account_id\");'></span>
                </div>
            </div>
            ";
        } else {
            $method = "
            <a href='./stripe-connect/onboarding.php'>
                <div class='methods-payment'>
                    <h3 class='title'>Method of Payment</h3>
                    <p class='text'>In order to receive payments from your students you must connect a payment method</p>
                    <div class='add-means'>
                        <div class='wrapper-svg'>
                            <div>
                                <img src='./assets/icons8-card-payment-50.png' alt=''>
                            </div>
                        </div>
                        <p class='text'>Add a payment method</p>
                        <span class='ion-android-add'></span>
                    </div>
                </div>
            </a>
            ";
        }
        echo $method;
    }
    public function remove_stripe_account_from_database($connected_account_id) {
        $sql  = "DELETE FROM stripe_accounts WHERE account_id=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $connected_account_id);
        if($stmt->execute()) {
            $stmt->close();
            $status = '1';
        } else {
            $status = '0';
        }
        // echo $status;
    }


    public function disconnect_stripe_account() {
        $tutor_uid = get_uid();
        $connected_account_id = $this->get_account_id($tutor_uid);
        if (!$connected_account_id) {
            // Handle missing account ID
            echo 'Error: Missing account ID';
            exit;
        }
        try {
            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            $stripe = new \Stripe\StripeClient($this->stripe_secret);

            // \Stripe\OAuth::deauthorize([
            //     // 'client_id' => 'ca_P1eBjGhryFc6LIC3YbDiKh8NAURadTMH',
            //     'stripe_user_id' => $connected_account_id,
            // ]);
            $response = $stripe->oauth->deauthorize([
                'client_id' => 'ca_P1eBjGhryFc6LIC3YbDiKh8NAURadTMH',
                'stripe_user_id' => $connected_account_id,
            ]);

            // var_dump($response);

            /* 
                object(Stripe\StripeObject)#17 (1) {
                    ["stripe_user_id"]=>
                    string(21) "acct_1PDjJMH2ta6UTI0a"
                }
            */
            $this->remove_stripe_account_from_database($connected_account_id);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle the error
            echo 'Error: ' . $e->getMessage();
        }
            
    }
    public function get_tutor_id($ad_id) {
        $stmt = $this->con->prepare("SELECT tutor_uid FROM ads WHERE ads.ad_id = ? LIMIT 1");
        $stmt->bind_param('i', $ad_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {      
            return $row['tutor_uid'];
        }
    }
    public function stripe_tutor_id($account_id) {
        $stmt = $this->con->prepare("SELECT user_id FROM stripe_accounts WHERE account_id = ? LIMIT 1");
        $stmt->bind_param('i', $account_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {      
            return $row['user_id'];
        }
    }
    public function get_account_id($tutor_uid) {
        $stmt = $this->con->prepare("SELECT account_id FROM stripe_accounts WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $tutor_uid);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {      
            return $row['account_id'];
        }
    }
    public function stripe_btn($ad_id) {
        $tutor_uid = $this->get_tutor_id($ad_id);
        $account_id = $this->get_account_id($tutor_uid);
        // var_dump($tutor_uid);
        if(isset($account_id)) {
            echo "<a class='btn stripe-btn' style='display: none;' href='./stripe-connect/subscription?account_id=$account_id'>Pay with Stripe</a>";
        } else {
            echo "";
        }
    }
    public function google_pay_btn($ad_id) {
        $tutor_uid = $this->get_tutor_id($ad_id);
        $account_id = $this->get_account_id($tutor_uid);
        // var_dump($tutor_uid);
        if(isset($account_id)) {
            echo "<div style='margin-top: 50px; display: flex; justify-content: center;' id='gpay-container'></div>";
        } else {
            echo "";
        }
    }
    public function get_subscription($subscription_id) {
        // echo $subscription_id;
        $sql = "SELECT 
            subscriptions.id AS subscription_id,
            subscriptions.customer_id,
            subscriptions.collection_method,
            subscriptions.created_at AS subscription_created_at,
            subscriptions.current_period_end,
            subscriptions.subscription_status,
            subscriptions.days_until_due,
            subscriptions.invoice_id,
            subscriptions.account_id,
            subscriptions.payment_amount,
            subscriptions.currency,
            subscriptions.subscription_interval,
            subscriptions.tutor_id,
            subscriptions.student_id
        FROM 
            subscriptions
        WHERE subscriptions.id=? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        
        $stmt->bind_param('s', $subscription_id);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            $data = array();
            if($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data_row = array(
                        'id' => $row['subscription_id'],
                        'customer_id' => $row['customer_id'],
                        'collection_method' => $row['collection_method'],
                        'subscription_created_at' => date("M d, Y", $row['subscription_created_at']),
                        'current_period_end' => $row['current_period_end'],
                        'subscription_status' => $row['subscription_status'],
                        'days_until_due' => $row['days_until_due'],
                        'invoice_id' => $row['invoice_id'],
                        'account_id' => $row['account_id'],
                        'payment_amount' => $row['payment_amount'],
                        'currency' => $row['currency'],
                        'subscription_interval' => $row['subscription_interval'],
                        'tutor_id' => $row['tutor_id'],
                        'student_id' => $row['student_id']
                    );
                    array_push($data, $data_row);
                }
            }
        } else {  
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        
        return $data[0];
    }
    public function get_subscriptions($filters) {
        $sql = "SELECT 
            subscriptions.id AS subscription_id,
            subscriptions.customer_id,
            subscriptions.collection_method,
            subscriptions.created_at AS subscription_created_at,
            subscriptions.current_period_end,
            subscriptions.subscription_status,
            subscriptions.days_until_due,
            subscriptions.invoice_id,
            subscriptions.account_id,
            subscriptions.payment_amount,
            subscriptions.currency,
            subscriptions.subscription_interval,
            subscriptions.tutor_id,
            subscriptions.student_id
        FROM 
            subscriptions
        WHERE ";
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
        $data = array();
        if($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $subscriptionId = $row['subscription_id'];
            
                // Check if the subscription is already in the result array
                if (!isset($data[$subscriptionId])) {
                    // If not, add the subscription with basic information
                    $data[$subscriptionId] = array(
                        'id' => $subscriptionId,
                        'customer_id' => $row['customer_id'],
                        'collection_method' => $row['collection_method'],
                        'subscription_created_at' => date("M d, Y", $row['subscription_created_at']),
                        'current_period_end' => $row['current_period_end'],
                        'subscription_status' => $row['subscription_status'],
                        'days_until_due' => $row['days_until_due'],
                        'invoice_id' => $row['invoice_id'],
                        'account_id' => $row['account_id'],
                        'payment_amount' => $row['payment_amount'],
                        'currency' => $row['currency'],
                        'subscription_interval' => $row['subscription_interval'],
                        'tutor_id' => $row['tutor_id'],
                        'student_id' => $row['student_id']
                    );
                }
            }
        }
        return $data;
    }
    public function get_subscription_user($uid) {
        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }
    public function retrieve_subscription($subscription_id) {
        try {
            $stripe = new \Stripe\StripeClient($this->stripe_secret);
            $subscription = $stripe->subscriptions->retrieve($subscription_id, []);
            // var_dump($subscription);
            return $subscription;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle the Stripe API error
            $statusCode = $e->getHttpStatus();
            $errorBody = $e->getJsonBody();
            $errorMessage = $errorBody['error']['message'];


            $subscription = array(
                'code' => $statusCode,
                'error_body' => $errorBody,
                'error_msg' => $errorMessage
            );
    
            // Log or handle the error as needed
            // For example, log to a file, send an email, etc.
            // error_log("Stripe API Error $statusCode: $errorMessage");
            // echo "Stripe API Error $statusCode: $errorMessage";
            return $subscription;
    
            // Optionally, rethrow the exception to propagate it up the call stack
            // throw $e;
        } catch (Exception $e) {
            
            $errorMessage = $e->getMessage();

            $subscription = array(
                'code' => 0,
                // 'error_body' => $errorBody,
                'error_msg' => $errorMessage
            );
            return $subscription;
            // Handle other types of exceptions
            // Log or handle the error as needed
            // error_log("Unexpected error: " . $e->getMessage());
            // // Optionally, rethrow the exception to propagate it up the call stack
            // throw $e;
        }
    }
    public function show_retrieved_single($subscription_id) {
        $subscription = $this->get_subscription($subscription_id);
        // var_dump($subscription);

        // Account Type
        $account_type_id = user_account_type_id(); // 2 = Student, 3 = Tutor



        // From Stripe
        
        $stripeSubscription =  $this->retrieve_subscription($subscription_id);

        // var_dump($stripeSubscription);

        if(!isset($stripeSubscription['code'])) {

            $stripeSubscriptionStatus = $stripeSubscription['status'];
            // Payment Status Changed
            if($subscription['subscription_status'] != $stripeSubscriptionStatus) {
                $cancelled_at = ($stripeSubscriptionStatus == 'canceled') ? $stripeSubscription['canceled_at'] : null;
                
                // Update Database
                $this->update_subscription($subscription_id, $stripeSubscriptionStatus, $cancelled_at);
            }
        } else {
            $stripeSubscriptionStatus = $subscription['subscription_status'];
        }

        // From / To
        $user_array = ($account_type_id == '2') ? $this->get_subscription_user($subscription['tutor_id']) : $this->get_subscription_user($subscription['student_id']);


        if(!isset($stripeSubscription['code'])) {
            if ($stripeSubscriptionStatus == 'active') {
                $state = 'Active';


            } elseif ($stripeSubscriptionStatus == 'canceled') {
                $state = 'Canceled';
            } else {
                $state = 'Unknown';
            }

        }

        // Display Action Buttons for Payment Recipients
        $paymentActionsColumn = "";
        if($account_type_id != '2') {
            if ($stripeSubscriptionStatus == 'active') {
                // Cancel
                $paymentActionsColumn .= "<a href=\"./stripe-connect/cancel-subscription?subscription={$subscription['id']}&account_id={$subscription['connected_account_id']}\" class='stripe-btn' id='confirmPaymentButton'>Cancel</a>";
            }
        } else {
            if ($stripeSubscriptionStatus == 'active') {
                // Cancel
                $paymentActionsColumn .= "<a href=\"./stripe-connect/cancel-subscription?subscription={$subscription['id']}&account_id={$subscription['connected_account_id']}\" class='stripe-btn' id='confirmPaymentButton'>Cancel</a>";
            }
        }
        
        // Stripe amount (cents) to dollar
        $decimal_amount = number_format($subscription['payment_amount'] / 100, 2, '.', '');


        

        // var_dump($subscription);
        $subscription_rows = "<div class='subscription-row'>
            <div class='subscription-column'>
                <b>{$user_array['firstname']} {$user_array['lastname']}</b>
            </div>
            <div class='subscription-column'>
                USD {$decimal_amount}
            </div>
            <div class='subscription-column' style='text-transform: capitalize;'>
                {$stripeSubscriptionStatus}
            </div>
            <div class='subscription-column'>
                {$subscription['subscription_created_at']}
            </div>
            <div class='subscription-column'>
                $paymentActionsColumn  
            </div>
        </div>";
            // <a href=\"./stripe-connect/confirm-subscription?subscription={$subscription['id']}&account_id=acct_1OHHzHH6FVx9mTYd\" class='stripe-btn' id='confirmPaymentButton'>Accept</a>
    

        return $subscription_rows;
    }

    public function retrieve_subscriptions($filters) {
        $subscriptions = $this->get_subscriptions($filters);

        $subscriptionsStr = "<div class='subscriptions'>
            <h6>Subscriptions</h6>
        ";

        if(count($subscriptions) > 0) {
            foreach($subscriptions as $subscription) {
                $subscription_id = $subscription['id'];
                $subscriptionsStr .= $this->show_retrieved_single($subscription_id);
            }
        }

        $subscriptionsStr .= "</div>";
        echo $subscriptionsStr;
    }
    // Update
    public function update_subscription($id, $subscription_status, $canceled_at = null) {
        $sql = "UPDATE subscriptions SET subscription_status = ?, canceled_at = ? WHERE id = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $subscription_status, $canceled_at, $id);
        $stmt->execute();
        $stmt->close();
        
        // Add error handling as needed
    }
    
}

?>