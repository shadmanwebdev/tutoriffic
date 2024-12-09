<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    error_reporting(E_ALL);
    ini_set("display_errors","On");

    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/User.php');
    include('./Classes/Ad.php');

    $subject = $_POST['subject']; 
    $level = $_POST['level'];

    // var_dump($subject, $level);

    if(isset($_POST['search'])) {
        $ad = new Ad;
        $ad->searched_ads($subject, $level);
    }
?>