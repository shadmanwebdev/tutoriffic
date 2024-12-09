<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    $user = new User();

    if(isset($_POST['prelaunch_sign_up'])) {
        $user->prelaunch_sign_up($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['questions'], $_POST['user_account_type'], $_POST['other_details'], $_POST['social_media'], $_POST['other_social_details']);
    }
    if(isset($_POST['update_user_details'])) {
        $user->update_user_details();
    }
    if(isset($_POST['update_postal_address'])) {
        $user->update_postal_address();
    }
    if(isset($_POST['upload_certificate'])) {
        $user->update_user_certificate();
    }
    if(isset($_POST['upload_identification'])) {
        $user->update_user_identification();
    }
    if(isset($_POST['upload_profile_photo'])) {
        $user->update_profile_photo();
    }
    // var_dump($_POST);

    if(isset($_POST['signup'])) {
        $user->create();
    }
    if(isset($_POST['update_user'])) {
        $user->update_user();
    }
    if(isset($_POST['validate_email'])) {    
        $user_status = $user->get_user_status();    
        if($user_status == 'admin') {
            $em = $user->get_user_email();
            if($em != $_POST['email']) {
                $user->validate_email();
            } else {
                if($em == $_POST['email']) {
                    echo '7';
                } else {
                    echo '8';
                }
            }
        }
    }
    
    // if(isset($_POST['update_admin'])) {
    //     $user->update_admin();
    // }
    // if(isset($_GET['del_user'])) {
    //     $user->delete($_GET['del_user']);
    // }
    if(isset($_POST['create_ad'])) {
        var_dump($_POST);
        $user->create_ad();
        header('location: ../my-listing-confirmation');
    }
    if(isset($_POST['login'])) {
        $user->login();
    }
    if(isset($_POST['update_profile_details'])) {
        $user->update_profile_details();
    }
    if(isset($_POST['update_user_password'])) {
        $user->update_user_password();
    }
    if(isset($_POST['forgot'])) {
        $check_email = $user->email_exists($_POST['email']);
        if($check_email == '1') {
            $url = $user->generatePwdLink($_POST['email']);
            $subject = 'JustPearlyThings Password Reset';
            $msgBody = "<p>Your password reset link: </p>
            <a href='$url'>$url</a>";

            $smtp_details = $user->smtp_details();
            
            $host = $smtp_details['smtp_host'];
            $encryption = $smtp_details['smtp_encryption'];
            $port = $smtp_details['smtp_port'];
            $username = $smtp_details['username'];
            $pwd = $smtp_details['pwd'];

    
            sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $_POST['email'], $subject, $msgBody);
            echo '1';

        } else {
            echo '0';
        }
    }
    if(isset($_POST['update_password'])) {
        $user->update_password();
    }
    if(isset($_GET['deluser'])) {
        $user->delete($_GET['deluser']);
    }
?>