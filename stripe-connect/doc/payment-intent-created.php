<?php


$paymentIntentData = array(
    'id' => 'pi_3OiP3sH4rZ2esk0g0BLnOIBx',
    'object' => 'payment_intent',
    'amount' => 100,
    'amount_capturable' => 100,
    'amount_details' => array('tip' => array()),
    'amount_received' => 0,
    'application' => NULL,
    'application_fee_amount' => 10,
    'automatic_payment_methods' => NULL,
    'canceled_at' => NULL,
    'cancellation_reason' => NULL,
    'capture_method' => 'manual',
    'client_secret' => 'pi_3OiP3sH4rZ2esk0g0BLnOIBx_secret_xoMjoMKAqxTktbSif5jwmEydj',
    'confirmation_method' => 'automatic',
    'created' => 1707604216,
    'currency' => 'usd',
    'customer' => NULL,
    'description' => NULL,
    'invoice' => NULL,
    'last_payment_error' => NULL,
    'latest_charge' => 'ch_3OiP3sH4rZ2esk0g0pLsquNs',
    'livemode' => false,
    'metadata' => array(),
    'next_action' => NULL,
    'on_behalf_of' => NULL,
    'payment_method' => 'pm_1OiP3rH4rZ2esk0gAKJIYZ3B',
    'payment_method_configuration_details' => NULL,
    'payment_method_options' => array(
        'card' => array(
            'installments' => NULL,
            'mandate_options' => NULL,
            'network' => NULL,
            'request_three_d_secure' => 'automatic'
        )
    ),
    'payment_method_types' => array('card'),
    'processing' => NULL,
    'receipt_email' => NULL,
    'review' => NULL,
    'setup_future_usage' => NULL,
    'shipping' => NULL,
    'source' => NULL,
    'statement_descriptor' => NULL,
    'statement_descriptor_suffix' => NULL,
    'status' => 'requires_capture', // When 'confirm' equals true, and 'capture_method' set to 'manual' in request
    'transfer_data' => array('destination' => 'acct_1OTaarQZ0lB36zVa'),
    'transfer_group' => 'group_pi_3OiP3sH4rZ2esk0g0BLnOIBx'
);



?>