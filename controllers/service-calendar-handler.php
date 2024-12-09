<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    // include '../calendar-functions.php';
    include '../Classes/Db.php';
    // include '../Classes/User.php';
    include '../Classes/Ad.php';
    include('../Classes/ServiceCalendar.php');
    

    if(isset($_POST['save_availability'])) {
        $sc = new ServiceCalendar;
        $sc->save_availability();
    }

    // Update Gig
    if(isset($_POST['update_gig'])) {
        $gig_id = $_POST['gig_id'];
        $availability_status = $sc->check_session_range($gig_id);
        // var_dump($availability_status);
        if($availability_status == true) {
            $gig->update_gig($gig_id);
        } else {
            $status = '10';
            echo $status;
        }
    }



    // Sessions
    if(isset($_POST['remove_datetimes_session'])) {
        // var_dump($_POST);
        $sc = new ServiceCalendar;
        $sc->remove_datetimes_session($_POST['session_temp_ids_json']);
    }


    if(isset($_GET['date']) && isset($_GET['times'])) {
        // Update merchant session
        if($_GET['type'] == 'merchant') {
            $sc = new ServiceCalendar;
            $sc->merchant_datetimes_session($_GET['date'], $_GET['times']);
        } 
        // Update customer session
        else {
            $sc = new ServiceCalendar;
            $sc->customer_datetimes_session($_GET['date'], $_GET['times']);
        }
    }

    if(isset($_GET['get_customer_booking'])) {
        $sc = new ServiceCalendar;
        $sc->get_customer_datetimes_session();
    }


    if(isset($_GET['check_availability_session'])) {
        if(isset($_SESSION['datetimes'])) {
            echo $_SESSION['datetimes'];
        } else {
            echo '0';
        }
    }
?>