<?php

    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }

    include '../functions.php';
    // $config = include '../partials/config.php';
    include '../Classes/Db.php';
    include '../Classes/Ad.php';
    include '../Classes/User.php';
    include '../Classes/Request.php';
    include '../Classes/StripePayment.php';

    require_once '../vendor/autoload.php';

    if(isset($_SESSION['user'])) {
        try {
            
            // Ad Id
            $adId = $_POST['ad_id'];
            // Connected Merchant Account
            $connectedAccountId = $_POST['account_id'];
            // Extract Google Pay payment token details
            $googlePayToken = $_POST['google_pay_payment_token'];

            // Student & Tutor Ids        
            $account_type_id = user_account_type_id();     
            if($account_type_id == 2) {
                // Student
                $studentId = get_uid();
            } else {
                // Tutor
                $studentId = $_POST['student_id'];
            }
            $ad = new Ad();
            $ad_details = $ad->get_single_ad($adId);
            $tutorId = $ad_details["tutor_uid"];

            // Create a booking request
            $request = new Request();$request_type = 'paid';
            $res = $request->create_request($studentId, $tutorId, $request_type);
            $requestResponse = json_decode($res, true);


            if ($requestResponse['status'] == '1') {
                $requestId = $requestResponse['request_id'];
            
                $pay = new StripePayment;
                $res = $pay->processPayment($googlePayToken, $adId, $requestId, $studentId, $tutorId, $connectedAccountId);

            }

        } catch (\Stripe\Exception\CardException $e) {
            // Handle card errors
            echo 'Card Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Handle rate limit errors
            echo 'Rate Limit Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle invalid request errors
            echo 'Invalid Request Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Handle authentication errors
            echo 'Authentication Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Handle API connection errors
            echo 'API Connection Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle generic API errors
            echo 'API Error: ' . $e->getMessage();
        } catch (Exception $e) {
            // Handle other exceptions
            echo 'Error: ' . $e->getMessage();
        }
    }
?>