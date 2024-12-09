<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $fileDir = dirname(__FILE__); // $parentDir = dirname($fileDir);
    
    if(!isset($_SESSION['v'])) { 
        $_SESSION['v'] = 1; 
        $v = $_SESSION['v'];
    } else {
        $v = floatval($_SESSION['v']) + .1;
        $_SESSION['v'] = $v;
    }

    include '../functions.php';
    include '../Classes/Db.php';
    include('../Classes/SiteSettings.php');
    include('../Classes/Message.php');
    include('../Classes/Faq.php');
    $s = new SiteSettings;




    // include '../Classes/User.php';
    // Classes
    // spl_autoload_register('load_class');

    // $settings = new SiteSettings();
    // $home = new Home();
    // $faq = new Faq();
    // $user = new User();
    // // $user->check_user_session();
    // if(isset($_GET['page'])) {
    //     $_SESSION['previous_data'] = $_GET['page'];
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<title><?= $s->sitename(); ?></title>
    <meta name='title' content='<?= $s->title_tag(); ?>'>
    <meta name='description' content='<?= $s->meta_description(); ?>'>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/icomoon/style.css?v=100">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/ionicons.min.css?v=5">
    <link rel="stylesheet" href="./css/table.css?v=12">
    <link rel="stylesheet" href="./css/form.css?v=18">
    <link rel="stylesheet" href="./css/form-response.css?v=16">
    <link rel="stylesheet" href="./css/paging.css?v=21">
    <link rel="stylesheet" href="./css/loader.css?v=21">
    <link rel="stylesheet" href="./css/popup.css?v=22">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {  
            /* background-color: #f7f7fc; */
            font-size: 0.875rem;
            font-family: sans-serif;
        }
        .error {
            color: #ff6060;
            font-size: 14px;
            line-height: 2;
            padding: 0 4px;
        }
        .wrapper {
            align-items: stretch;
            display: flex;
            width: 100%;
            background: #222e3c;
        }
        .main {
            display: flex;
            width: 100%;
            min-width: 0;
            min-height: 100vh;
            transition: margin-left 0.35s ease-in-out, left 0.35s ease-in-out, margin-right 0.35s ease-in-out, right 0.35s ease-in-out;
            background: #f7f7fc;
            flex-direction: column;
            overflow: hidden;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }


        /* Sidebar & topbar */
        .top-bar {
            padding: 20px 30px;
            background: #fff;
            /* box-shadow: 0 0 2rem 0 rgba(33, 37, 41, 0.1); */
        }
        #navBtn {
            /* display: grid; */
            margin-left: auto;
        }
        .show_sidebar {
            animation: .5s pull ease-in-out forwards;
        }
        .hide_sidebar {
            animation: .5s push ease-in-out forwards;
        }
        
        @keyframes pull {
            
            0% {
                margin-left: -260px;
            }
            100% {
                margin-left: 0;
            }
        }
        @keyframes push {
            0% {
                margin-left: 0;
            }
            100% {
                margin-left: -260px;
            }
        }
        #navBtn {
            display: grid;
            grid-template-rows: auto;
            grid-template-columns: 1fr;
            row-gap: 7px;
            cursor: pointer;
            width: 28px;
            height: 19px;
            position: relative;
            z-index: 0;
        }
        #navBtn span {
            width: 28px;
            height: 2px;
            /* background-color: #fff; */
            background-color: #4f4f4f;
        }


        .delete-link {
            color: red;
        }
    </style>

    <!-- JQUERY -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <!-- JQUERY UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- JS -->
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>
    <script src="./js/admin.js?v=13" defer></script>
    <script src="./js/faq.js?v=13" defer></script>

    

    <!-- TinyMCE -->
    <!-- <script src="https://cdn.tiny.cloud/1/93uwww3rarc2konkzn8yvxhx6748irjh3szcgde1rrzzaway/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
</head>
<body>

    <div id="popBg"></div>
    <div id="bgOverlay"></div>

    <div id='msg-alert'></div>
    <div id='loader'></div>
