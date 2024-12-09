<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Ad.php';
    include '../Classes/ServiceCalendar.php';
    
    $cc = new ServiceCalendar();

    if(isset($_GET['date']) && isset($_GET['times'])) {
        // Update merchant session
        if($_GET['type'] == 'merchant') {
            $cc->merchant_datetimes_session($_GET['date'], $_GET['times']);
        } 
    }


    // Customer will pick a single time value
    if(isset($_GET['date']) && isset($_GET['time'])) {
        // Update customer session
        $cc->customer_datetimes_session($_GET['date'], $_GET['time']);
    }

    if(isset($_GET['check_availability_session'])) {
        if(isset($_SESSION['datetimes'])) {
            echo $_SESSION['datetimes'];
        } else {
            echo '0';
        }
    }
?>