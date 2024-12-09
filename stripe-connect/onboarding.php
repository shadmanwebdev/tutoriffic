<?php

if(!isset($_SESSION)) { 
    ob_start();
    session_start(); 
}

require_once '../vendor/autoload.php';


// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');


// Get account id
$response = $stripe->accounts->create(['type' => 'standard']);
$account_id = $response->id;
$_SESSION['connected_account_id'] = $account_id;


if($_SERVER['SERVER_NAME'] == 'localhost') {
    $refresh_url = 'http://localhost/tutoriffic/stripe-connect/reauth.php';
    $return_url = 'http://localhost/tutoriffic/stripe-connect/return.php';
} else {
    $refresh_url = 'https://testserver123.great-site.net/tutoriffic/stripe-connect/reauth.php';
    $return_url = 'https://testserver123.great-site.net/tutoriffic/stripe-connect/return.php';
}


// Use the account id to get account link
$response2 = $stripe->accountLinks->create([
    'account' => $account_id,
    'refresh_url' => $refresh_url,
    'return_url' => $return_url,
    'type' => 'account_onboarding',
]);


// Redirect to the link url
header("location: $response2->url");


// After account verification users will be redirected to the return_url

?>