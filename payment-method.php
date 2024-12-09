<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';ad_title
?>
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
    .ion-android-add, .ion-android-close {
        margin-left: auto; 
        color: #fff; 
        background-color: rgb(71,136,199); 
        width: 30px; 
        height: 30px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        border-radius: 50%; 
    }
</style>



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
                    .methods-payment {
                        width: 100%;
                        padding: 30px;
                        -webkit-box-sizing: border-box;
                        box-sizing: border-box;
                        background-color: #fff;
                        border-radius: 10px;
                    }
                    .methods-payment .title {
                        margin: 0;
                        font-size: 18px;
                        font-weight: 700;
                    }
                    .methods-payment .text {
                        margin: 20px 0 25px;
                        font-size: 16px;
                        font-weight: 400;
                    }
                    .methods-payment .add-means {
                        padding: 20px;
                        border-radius: 10px;
                        background-color: #f7f7f7;
                        position: relative;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                    }
                    .methods-payment .add-means .wrapper-svg {
                        position: relative;
                        width: 54px;
                        height: 54px;
                        background-color: rgba(34,34,34,.08);
                        border-radius: 100%;
                        margin-right: 20px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                    .methods-payment .add-means .wrapper-svg img {
                        width: 30px;
                        height: 30px;
                    }
                    .methods-payment .add-means .text {
                        margin: 0;
                        font-size: 16px;
                        font-weight: 600;
                    }
                    #not-mobile-app .methods-payment .add-means>* {
                        display: inline-block;
                        vertical-align: middle;
                    }
                </style>
                
                <div class='col-md-8'>
                    <div class='card mb-4'>
                        <?php
                            $sp = new StripeSubscription();
                            $sp->show_payment_method();
                        ?>
                    </div>
                </div>
            </div>
        </div>




        <script defer>
            function disconnect_stripe_account(connected_account_id) {
                const formData = new FormData();

                formData.append('disconnect_stripe', 'true');
                formData.append('connected_account_id', connected_account_id);

                fetch('./stripe-connect/disconnect', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    return response.text();
                })
                .then(response => {
                    console.log(response);
                    // if(response == '1') {
                        window.location.href = './payment-method';
                    // } else {
                    //     $('message-response').html("<div class='error'>Failed! An error occured.</div>");
                    // }
                })
                .catch(err => console.log(err));
            }
        </script>






</body>
</html>