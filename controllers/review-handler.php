<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Review.php';
    $review = new Review();

    if(isset($_POST['create_review'])) {
        $review->create_review();
    }
    
?>