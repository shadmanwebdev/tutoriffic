<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Question.php';
    $q = new Question();

    if(isset($_POST['create_question'])) {      
        $q->create_question();     
    }

?>