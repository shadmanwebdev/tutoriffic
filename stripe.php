<?php

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

$stripe->paymentIntents->create(
    [
        'amount' => 1000,
        'currency' => 'usd',
        'automatic_payment_methods' => ['enabled' => true],
        'application_fee_amount' => 123,
    ],
    ['stripe_account' => '{{CONNECTED_ACCOUNT_ID}}']
);

?>