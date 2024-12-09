<?php

    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set("display_errors","On");

    $fileDir = dirname(__FILE__);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/User.php');
    include('./Classes/Ad.php');
    
    if (isset($_GET['tutor_id'])) {
        $tutor_id = $_GET['tutor_id'];
        $ad = new Ad;
        echo $ad->tutur_ads_options($tutor_id);
    }

?>

