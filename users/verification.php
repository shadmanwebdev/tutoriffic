<?php include './partials/header.php'; ?>




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
            letter-spacing: 0em;
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
        $status_text = "Error!";
        $icon = "<div class='icon cross'>
            <i class='ion-android-close'></i>
        </div>";
        $status_msg = "The verification attempt failed";

        // Verification
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if(empty($selector) || empty($validator)) {
            echo 'Could not validate your request';
        } else {
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {  


                $user = new User;  
                $status = $user->verify_account($selector, $validator);  
                if($status == '1') {
                    
                    $status_text = "Verified!";
                    $icon = "<div class='icon check'>
                        <i class='fa fa-check'></i>
                    </div>";
                    $status_msg = "Your account has been verified";
                }
            }
        }
    ?> 


    <div class='popup'>
        <div class='popup-inner-div'>
            
            <?= $icon; ?>
            <div class='popup-title'><?= $status_text; ?></div>
            <div class='popup-subtitle'>
                <div class='success'>
                    <?= $status_msg; ?>
                </div>
                <div class='back' style='margin-top: 20px;'>
                    <a href='./'>Back to Home</a>
                </div>
            </div>
        </div>
    </div>










</body>
</html>