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
    include('./Classes/Request.php');
    
    if (isset($_GET['request_id']) && isset($_GET['ad_subject_id'])) {
        $ad_subject_id = $_GET['ad_subject_id'];
        $request_id = $_GET['request_id'];
        
        $request = new Request;
        $request->ad_subject_options_request($request_id, $ad_subject_id);
    }

?>

