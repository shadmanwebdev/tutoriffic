<?php

    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/StripePayment.php';


    require_once '../vendor/autoload.php';


    if(isset($_POST['capture'])) {
        $sp = new StripePayment;
        $paymentIntent = $sp->capture($_POST['payment_intent_id']);
        echo $paymentIntent;
    }
    if(isset($_POST['cancel'])) {
        $sp = new StripePayment;
        $paymentIntent = $sp->cancel($_POST['payment_intent_id']);
        echo $paymentIntent;
    }

?>