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
    
    if (isset($_POST['subject_data_json'])) {
        $subject_data_json = $_POST['subject_data_json'];
        $subject_options_temp = $_POST['subject_options_temp'];

        $ad = new Ad;
        $ad->ad_subject_options_edit_ad($subject_data_json, $subject_options_temp);
    }

?>

