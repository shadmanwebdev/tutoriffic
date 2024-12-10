<?php
    // Include necessary files
    include '../functions.php';
    // $config = include '../partials/config.php';
    include '../Classes/Db.php';
    include '../Classes/Ad.php';
    include '../Classes/User.php';
    include '../Classes/Request.php';
    include '../Classes/StripePayment.php';

    require_once '../vendor/autoload.php';


    // Run the function to capture funds   
    $pay = new StripePayment;
    $res = $pay->getPendingPaymentsToReauthorize();
?>
