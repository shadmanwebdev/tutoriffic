<?php
    include './partials/header.php';
?>
<!-- subscription-row -->
<?php 
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>



<?php
    include './template-parts/account-navigation.php';
?>
<?php
    include './template-parts/sub-bar.php';
?>





    <style>
        body {
            background-color: #f7f7f7;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
        }
        .card:hover {
            -webkit-box-shadow: 0 20px 50px 0 rgba(0,0,0,.1);
            box-shadow: 0 20px 50px 0 rgba(0,0,0,.1);
        }
        .card-body {
            padding: 2.5rem 2rem;
        }
    </style>

        

    <style>
        .card {
            min-width: 360px;
            /* padding: 40px 66px 24px; */
            -webkit-box-shadow: 0px 4px 16px rgba(96,97,112,0.08);
            box-shadow: 0px 4px 16px rgba(96,97,112,0.08);
            -webkit-border-radius: 20px;
            border-radius: 20px;
            margin-bottom: 16px;
        }
        .header-demands {
            padding: 40px;
        }
        .img-wrapper {
            margin: 0 auto 16px;
            width: 140px;
            height: 140px;
            overflow: hidden;
            border-radius: 32px;
        }
        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center;
        }
        .profile-infos {
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            position: relative;
            padding: 50px 40px 40px 40px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .profile-infos .name {
            margin: 20px 0 0 0;
            font-size: 26px;
            font-weight: 700;
            color: #393939;
            line-height: normal;
            letter-spacing: normal;
            text-align: center;
        }
        .profile-infos .adress {
            margin: 10px 0 0 0;
            font-size: 18px;
            font-weight: 600;
            color: #b1b1b1;
            line-height: 1.4;
            letter-spacing: normal;
            text-align: center;
        }
        ul.messages {
            margin: 0;
        }
    </style>
        

    

        <div class='container'>
            <div class='row'>

                <!-- Column 1 -->
                <div class='col-md-4'>
                    <div class='card mb-4'>


                        <?php
                            include 'template-parts/payment-navigation.php';
                        ?>
                        
                    </div>
                </div>


                <style>
                    .subscriptions {
                        display: flex;
                        flex-flow: column nowrap;
                        border-radius: none;
                        background: #fff;
                        border: 1px solid rgba(0,0,0,.125);
                    }
                    .subscriptions h6 {
                        padding-left: 20px;
                        margin-top: 20px;
                        margin-bottom: 20px;
                    }
                    .subscription-row {
                        background: #fff;
                        display: flex;
                        flex-flow: row nowrap;
                        align-items: center;
                        border-top: 1px solid rgba(0,0,0,.125);
                        border-bottom: 1px solid rgba(0,0,0,.125);
                    }
                    .subscription-column {
                        padding: 20px 0px 20px 20px;
                    }  
                    .subscription-column:nth-child(1) {
                        width: 22%;
                    }
                    .subscription-column:nth-child(2) {
                        width: 20%;
                    }
                    .subscription-column:nth-child(3) {
                        width: 18%;
                    }
                    .subscription-column:nth-child(4) {
                        width: 45%;
                    }
                    .subscription-row a {
                        display: flex;
                        justify-content: center;
                        margin-bottom: 0;
                        max-width: 90px; 
                        min-width: 90px; 
                        padding: 10px 15px; 
                        font-size: 14px;
                    }
                </style>

                <!-- Column 2 -->
                <div class='col-md-8'>

                    <style>
                        .payment-actions {
                            display: flex;
                            flex-flow: row nowrap;
                        }
                        .payment-actions .stripe-btn {
                            display: flex;
                            justify-content: center;
                            margin-bottom: 0;
                            max-width: 120px;
                            min-width: 120px;
                            padding: 10px 15px;
                            font-size: 14px;
                        }
                        
                        .payment-actions .stripe-btn {
                            margin: 0 5px;
                            font-size: 14px;
                            padding: 8px 10px;
                        }
                        .payment-actions .stripe-btn.cancel {
                            background: gray;
                            color: #fff;
                        }
                    </style>

                    <!-- One time Payments -->
                    <?php
                        // $sp2 = new StripePayment();
                        // $payment_intent_id = 'pi_3OiP3sH4rZ2esk0g0BLnOIBx';
                        // $sp2->show_retrieved_single($payment_intent_id);
                        if(isset($_SESSION['user'])) {
                            $sp = new StripePayment();

                            $account_type_id = user_account_type_id();
                            $uid = get_uid();

                            $filters = array(
                                'student_id' => ($account_type_id == '2') ? intval($uid) : null,
                                'tutor_id'  => ($account_type_id == '3') ? intval($uid) : null,
                                'payment_status' => isset($_GET['status']) ? $_GET['status'] : null
                            );
                            // var_dump($filters);
                            $sp->retrieve_payments($filters);
                        } else {
                            echo 'User is not logged in';
                        }
                    ?>

                </div>
            </div>
        </div>




<script defer>
    

    function capture(payment_intent_id) {
        load_start();

        var formData = new FormData();

        formData.append('capture', 'true');
        formData.append('payment_intent_id', payment_intent_id);

        fetch('stripe-connect/paymentintent-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            setTimeout(() => {
                load_end();
                // Parse the string into a JS object
                var dataObj = JSON.parse(data);
                // Access the status property
                var status = dataObj.status;
                console.log(status);
                if(status == 'succeeded') {
                    window.location.href = './my-payments';
                }
            }, 500);
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }
    function cancel(payment_intent_id) {
        load_start();

        var formData = new FormData();

        formData.append('cancel', 'true');
        formData.append('payment_intent_id', payment_intent_id);

        fetch('stripe-connect/paymentintent-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            setTimeout(() => {
                load_end();
                // Parse the string into a JS object
                var dataObj = JSON.parse(data);
                // Access the status property
                var status = dataObj.status;
                console.log(status);
                if(status == 'canceled') {
                    window.location.href = './my-payments';
                }
            }, 500);
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

</script>



</body>
</html>