<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    require_once '../vendor/autoload.php';
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    include '../Classes/Ad.php';
    include '../Classes/Request.php';
    include '../Classes/StripePayment.php';
    $request = new Request();

    if(isset($_POST['create_request'])) {
        $request->create_request();
    }
    if(isset($_POST['cancel'])) {
        $sp = new StripePayment();
        $sp->cancel_request('canceled', $_POST['request_id']);
    }
    if(isset($_POST['refund'])) {
        $sp = new StripePayment();
        $sp->refund_request('refunded', $_POST['request_id']);
    }
    
?>