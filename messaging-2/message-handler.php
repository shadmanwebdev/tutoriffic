<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Message.php';
    $msg = new Message();

    if(isset($_POST['create_msg'])) {      
        $msg->create_message();     
    }

?>