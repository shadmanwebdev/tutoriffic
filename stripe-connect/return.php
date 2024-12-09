<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/ionicons.min.css"> -->
    <!-- <link rel="stylesheet" href="css/bootstrap-alt.css"> -->
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../css/default.css?v=10">
</head>
<body id='m'>

<?php

    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    include('../functions.php');
    include('../Classes/Db.php');
    include('../Classes/StripeSubscription.php');


    require_once '../vendor/autoload.php';
    
    $stripe = new \Stripe\StripeClient('sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9');
    
    // Assuming you've stored the account ID in a session or retrieved it from the database
    $account_id = isset($_SESSION['connected_account_id']) ? $_SESSION['connected_account_id'] : null;
    
    if (!$account_id) {
        // Handle missing account ID
        echo 'Error: Missing account ID';
        exit;
    }
    
    try {
        // Retrieve the account information using the account ID
        $account = $stripe->accounts->retrieve($account_id);

        // var_dump($account);

        // $uid = get_uid();
        $uid = 1;
    
        // Assuming $account contains the Account object
        $account_id = $account->id;
        $account_type = $account->type;
        $email = $account->email;
        $payouts_enabled = ($account->payouts_enabled == false) ? 0 : 1; // Check if payouts are enabled
        $fullname = $account->business_profile->name;
        $city = $account->business_profile->support_address->city;
        $country = $account->business_profile->support_address->country;
        $line1 = $account->business_profile->support_address->line1;
        $line2 = $account->business_profile->support_address->line2;
        $postal_code = $account->business_profile->support_address->postal_code;
        $state = $account->business_profile->support_address->state;
        $charges_enabled = ($account->charges_enabled == false) ? 0 : 1;
        $country = $account->country;

        $requirements = json_encode($account->requirements);

        $created_at = datetime_now();

        /*
        var_dump([
            'account_id' => $account->id,
            'account_type' => $account->type,
            'email' => $account->email,
            'payouts_enabled' => $account->payouts_enabled,
            'name' => $account->business_profile->name,
            'city' => $account->business_profile->support_address->city,
            'country' => $account->business_profile->support_address->country,
            'line1' => $account->business_profile->support_address->line1,
            'line2' => $account->business_profile->support_address->line2,
            'postal_code' => $account->business_profile->support_address->postal_code,
            'state' => $account->business_profile->support_address->state,
            'charges_enabled' => $account->charges_enabled,
            'country_code' => $account->country,
            'requirements' => $requirements
        ]);
        */

        $sc = new StripeSubscription;
        $sc->connected_account_details($uid, $account_id, $account_type, $email, $fullname, $city, $country, $line1, $line2, $postal_code, $state, $charges_enabled, $payouts_enabled, $requirements, $created_at);

    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle the error
        echo 'Error: ' . $e->getMessage();
    }
    // echo "<a href='../'>Back to Homepage</a>";
?>



<style>
    body {
        background: #A1A1A1;
    }
    .popup {
        padding: 50px;
        max-width: 538px;
        position: static;
        margin: 200px auto;
        border-radius: 15px;
        background: #FFFFFF;
        box-shadow: 0px 2px 10px 0px #00000026;
        text-align: center;
    }
    .popup-title {  
        font-size: 20px;
        font-weight: 600;
        line-height: 30px;
        text-align: center;
        color: #000;
    }
    .popup-subtitle {
        margin: 10px 0;
        line-height: 1.5;
    }
    form.verify-code input {
        color: #ADADAD;
        border: 2px solid #ADADAD;
        padding: 10px 20px;
        radius: 7px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    form.verify-code .form-group {
        display: flex;
    }
    form.verify-code div.submit {
        padding: 10px 20px;
        border-radius: 7px;
        background: #FFB600;
        color: #0E0E0E;
        width: 100%;
        cursor: pointer;
        transition: .4s;
    }
    form.verify-code div.submit:hover {
        background: #ffc73c;
    }
    .popup .icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 10px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .popup .icon.check {
        background-color: rgb(27,187,101);
    }
    .popup .icon.cross {
        background-color: red;
    }
    .popup .icon i {
        font-size: 25px;
        color: #fff;
    }
    .back a {
        font-weight: 600;
        color: #000;
    }
    @media screen and (max-width: 576px) {
        .popup {
            width: 98%;
            padding: 30px 10px;
        }
        .popup .icon {
            width: 55px;
            height: 55px;
        }
        .popup-title {  
            font-size: 18px;
            font-weight: 600;
        }
        .popup-subtitle {
            font-size: 13px;
        }
    }
</style>

<?php
    // Extract relevant details from the Stripe\Account object
    $account_id = $account->id;
    $business_name = $account->business_profile->name;
    $email = $account->email;
    $country = $account->country;
    $charges_enabled = $account->charges_enabled ? "Enabled" : "Disabled";
    $payouts_enabled = $account->payouts_enabled ? "Enabled" : "Disabled";
?>




<div class="popup">
    <!-- Your confirmation content -->
    <div class="popup-inner-div">
        <!-- Display relevant account details -->
        <div class="popup-title">Confirmation</div>
        <div class="popup-subtitle">
            <div>Business Name: <?= $business_name ?></div>
            <div>Email: <?= $email ?></div>
            <div>Country: <?= $country ?></div>
            <!-- Add more details as needed -->
            <div class="back" style="margin-top: 20px;">
                <a href="../">Back to Home</a>
            </div>
        </div>
    </div>
</div>



</body>
</html>