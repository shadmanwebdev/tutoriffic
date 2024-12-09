<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    $config = include('../partials/config.php');
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/StripeSubscription.php';

    require_once '../vendor/autoload.php';

    $connected_account_id = isset($_POST['connected_account_id']) ? $_POST['connected_account_id'] : null;
   

    if (!$connected_account_id) {
        // Handle missing account ID
        echo 'Error: Missing account ID';
        exit;
    }
    
    try {
        $ss = new StripeSubscription;
        $ss->disconnect_stripe_account($connected_account_id);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle the error
        echo 'Error: ' . $e->getMessage();
    }
    
?>