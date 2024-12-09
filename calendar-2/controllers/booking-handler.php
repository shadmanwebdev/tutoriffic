<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../calendar-functions.php';
    // include '../Classes/Gig.php';
    // $gig = new Gig();

    // Create Gig
    // if(isset($_POST['create_gig'])) {
    //     // var_dump($_POST);
    //     $gig->create_gig();
    // }
    if(isset($_GET['date']) && isset($_GET['times'])) {
        // var_dump($_POST);
        merchant_datetimes_session($_GET['date'], $_GET['times']);
    }
    if(isset($_GET['check_availability_session'])) {
        if(isset($_SESSION['datetimes'])) {
            echo $_SESSION['datetimes'];
        } else {
            echo '0';
        }
    }
?>