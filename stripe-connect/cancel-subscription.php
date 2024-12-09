<?php


if(!isset($_SESSION)) { 
    ob_start();
    session_start(); 
}

include('../functions.php');
$config = include('../partials/config.php');
include('../Classes/Db.php');
include('../Classes/StripeSubscription.php');


require_once '../vendor/autoload.php';

$stripe = new \Stripe\StripeClient($config['stripe_secret']); // Replace with your secret key

// Assuming you have the subscription ID you want to refund
$subscriptionId = $_GET['subscription']; // Replace with the actual subscription ID
$connectedAccountId = $_GET['account_id'];
try {
    // // Retrieve the subscription
    // $subscription = $stripe->subscriptions->retrieve(
    //     $subscriptionId,
    //     [],
    //     ['stripe_account' => $connectedAccountId]
    // );

    // Cancel the subscription (this effectively refunds the unused portion)
    $subscription = $stripe->subscriptions->cancel(
        $subscriptionId,
        []
    );

    $ss = new StripeSubscription;
    // $sp->update_subscription_status('canceled', $subscriptionId);
    $ss->update_subscription($subscriptionId, $subscription['status'], $subscription['canceled_at']);

    echo 'Subscription canceled. Refund complete.';
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle the error
    echo 'Error canceling subscription: ' . $e->getMessage();
    echo 'HTTP Status Code: ' . $e->getHttpStatus();
    echo 'Stripe Error Code: ' . $e->getStripeCode();
    echo 'Error Type: ' . $e->getErrorType();
}

?>
