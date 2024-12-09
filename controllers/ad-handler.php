<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Ad.php';
    $ad = new Ad();

    if(isset($_POST['create_ad'])) {  
        // var_dump($_POST);
        $ad->create_ad_2();     
    }
    if(isset($_POST['update_location'])) {  
        $ad->update_ad_locations();     
    }

    if(isset($_POST['update_ad_title'])) {  
        $ad->update_ad_title();     
    }
    if(isset($_POST['update_about_lesson'])) {  
        $ad->update_about_lesson();     
    }
    if(isset($_POST['update_about_tutor'])) {  
        $ad->update_about_tutor();     
    }
    if(isset($_POST['update_ad_subjects'])) {  
        $ad->update_ad_subjects();     
    }
?>