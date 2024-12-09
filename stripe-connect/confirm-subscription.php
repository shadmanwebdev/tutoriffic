<?php

if(!isset($_SESSION)) { 
    ob_start();
    session_start(); 
}

include('../functions.php');
include('../Classes/Db.php');
include('../Classes/StripeSubscription.php');

$sp = new StripeSubscription;


require_once '../vendor/autoload.php';

$stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');

$subscriptionId = $_GET['subscription']; // Replace with your subscription ID

$connectedAccountId = $_GET['account_id']; // Replace with the actual connected account ID

// Assuming you have a method to retrieve subscription details from your database
$subscriptionId = $_GET['subscription']; // Replace with your subscription ID
// $subscription = $sp->get_subscription($subscriptionId);


try {
    // $subscription = $stripe->subscriptions->retrieve($subscriptionId,
    // [],
    // ['stripe_account' => $connectedAccountId]);
    
    // // Subscription exists, you can access details using $subscription
    // echo 'Subscription found: ' . $subscription->id;


    $s = $stripe->subscriptions->update(
        $subscriptionId,
        ['metadata' => ['status' => 'active']],  // Update metadata to mark as active
        ['stripe_account' => $connectedAccountId]
    );
    var_dump($s);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Subscription not found, handle the exception
    if ($e->getHttpStatus() === 404) {
        echo 'Subscription not found.';
    } else {
        echo 'Error retrieving subscription: ' . $e->getMessage();
    }
}

?>

