<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';

    include '../Classes/Db.php';
    include '../Classes/Support.php';

    $support = new Support();
    
    if(isset($_POST['create_report'])) {
        $support->create_report();
    }
    if(isset($_GET['support-logout'])) {
        $support->logout();
    }
    if(isset($_POST['login_support_account']) && isset($_POST['email']) && isset($_POST['password'])) {
        $support->login();
    }
    if(isset($_POST['create_support_account']) && isset($_POST['email']) && isset($_POST['password'])) {
        $support->signup();
    }
    if(isset($_POST['create_ticket'])) {
        // var_dump($_POST);
        $support->create_ticket();
    }
    if(isset($_GET['del_account'])) {
        // var_dump($_GET);
        $support->del_account($_GET['del_account']);
    }
    if(isset($_POST['create_reply'])) {
        // var_dump($_POST);
        $support->create_reply();
    }
    if(isset($_GET['ticket_close'])) {
        $support->close_ticket($_GET['ticket_close'], $_GET['org']);
    }
    if(isset($_GET['ticket_open'])) {
        $support->open_ticket($_GET['ticket_open'], $_GET['org']);
    }
    
    if(isset($_GET['ticket_id']) && isset($_GET['closed'])) {
        $support->close_ticket($_GET['ticket_id'], $_GET['org']);
    }
?>