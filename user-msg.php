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
    include('./Classes/Message.php');


    // Assuming $currentUserId is the ID of the currently logged-in user
    // This can be retrieved from your session or wherever you store it
    $currentUserId = get_uid();
    
    if (isset($_GET['user'])) {
        $selectedUserId = intval($_GET['user']); // User we selected on the left column
        $msg = new Message;
        $msg->display_user_messages($currentUserId, $selectedUserId);
    }

?>

