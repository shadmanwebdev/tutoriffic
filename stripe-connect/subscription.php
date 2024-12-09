<?php

    require_once '../vendor/autoload.php';

    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/StripeSubscription.php';
    include '../Classes/Request.php';

    $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');
    

    $connected_account_id = $_POST['account_id'];

    // Extract Google Pay payment token details
    $google_pay_payment_token = json_decode($_POST['google_pay_payment_token'], true);

    // Create customer
    // $customer = $stripe->customers->create(
    //     [
    //         'email' => 'shadmanwebdev@gmail.com',
    //         'name' => 'Shadman Sakib',  
    //     ],
    //     ['stripe_account' => $connected_account_id]
    // );

    // Create customer
    $customer = $stripe->customers->create(
        [
            'email' => 'shadmanwebdev@gmail.com',
            'name' => 'Shadman Sakib',
            'source' => $google_pay_payment_token['id'], // Use the Google Pay payment token as the source
        ],
        // ['stripe_account' => $connected_account_id]
    );
    // var_dump($customer);


    // Create product
    $product = $stripe->products->create(
        ['name' => 'Basic Dashboard'],
        // ['stripe_account' => $connected_account_id]
    );

    // var_dump($product);


    $product_id = $product->id;


    // Create price
    $price = $stripe->prices->create(
        [
            'product' => $product_id,
            'unit_amount' => 100,
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'],
        ],
        // ['stripe_account' => $connected_account_id]
    );

    // var_dump($price);

    // Create subscription
    $subscription = $stripe->subscriptions->create([
        'customer' => $customer->id,
        'items' => [['price' => $price->id]],
        'trial_period_days' => 7,  // Set the trial period (adjust as needed)
        'application_fee_percent' => 10, // A non-negative decimal between 0 and 100
        // 'expand' => ['latest_invoice.payment_intent'],
        // 'collection_method' => 'send_invoice', // Set collection method to send_invoice
        // 'days_until_due' => 7,  // Set the number of days until the invoice is due
        'transfer_data' => [ // (Connect only)
            'destination' => $connected_account_id
        ],
    ]);

    // Response will have the status "active"

    // var_dump($subscription);

    $sp = new StripeSubscription; 
    $res = $sp->create_subscription($subscription, $connected_account_id);

    if($res == '1') {
        // Create Request 
        if(isset($_POST['create_request'])) {
            $request = new Request();
            $request->create_request();
        }
    }
?>