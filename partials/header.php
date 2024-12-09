<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    error_reporting(E_ALL);
    ini_set("display_errors","On");

    if(!isset($_SESSION['v'])) { 
        $_SESSION['v'] = 10; 
        $v = $_SESSION['v'];
    } else {
        $v = floatval($_SESSION['v']) + 10;
        $_SESSION['v'] = $v;
    }

    $fileDir = dirname(__FILE__);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);


    $config = include(ROOT_PATH.'partials/config.php');
    require_once './vendor/autoload.php';
    include(ROOT_PATH.'functions.php');
    include(CLASSES_PATH.'Db.php');
    include(CLASSES_PATH.'User.php');
    include(CLASSES_PATH.'Ad.php');
    include(CLASSES_PATH.'Review.php');
    include(CLASSES_PATH.'Request.php');
    include(CLASSES_PATH.'Message.php');
    include(CLASSES_PATH.'StripePayment.php');
    include(CLASSES_PATH.'StripeSubscription.php');
    include(CLASSES_PATH.'ServiceCalendar.php');
    include(CLASSES_PATH.'Support.php');

    $user = new User;


    /*
        Redirect users to log in page when 
        visiting restricted urls
    */
    $restricted = array('schedule', 'schedule-modify');
    $pagename = get_pagename();
    if(in_array($pagename, $restricted)) {
        $logged_in = is_logged_in();
        if($logged_in == '0') {
            header('location: ./login');
        }
    }
    
    // Call this function on every page you want to track
    rememberLastPage();

    // Example: Retrieve the last visited page
    $lastVisitedPage = getLastPage();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoriffic</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Roboto:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/magnific-popup.css">
    <link rel="stylesheet" href="./fonts/ionicons/css/ionicons.min.css?">
    <link rel="stylesheet" href="./css/icomoon/style.css?v=100">
    <link rel="stylesheet" href="css/default.css?v=222">
    <link rel="stylesheet" href="css/popup.css?v=3">
    <link rel="stylesheet" href="css/loader.css?v=64">
    <link rel="stylesheet" href="css/form-response.css?v=65">
    <link rel="stylesheet" href="css/request.css?v=3">
    <link rel="stylesheet" href="css/my-requests.css?v=3">

    <link href="./css/animate.min.css" rel="stylesheet">
    <link href="./fonts/icofont/icofont.min.css" rel="stylesheet">
    
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">





    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

    <script src="./js/popper.min.js"></script>
    <script src="./bootstrap/bootstrap.min.js"></script>
    <!-- Include jQuery and jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>

    <script src="./js/jquery.magnific-popup.js"></script>

    <script src="./js/jquery.easing.min.js"></script>
    <script src="js/main.js?v=34"></script>
    <script src="js/popup.js?v=2"></script>
    <!-- <script src="js/user.js?v=11"></script> -->
    <script src="js/mylist.js?v=11"></script>
    <script src="js/request.js?v=28"></script>
</head>
<body id='m'>

<div id='loader'></div>

<div id='popBg' onclick='closePopup();'></div>
<!-- An error occurred while processing your request. -->