<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';ad_title
    // Where can your lessons be held?
?>


<?php include './partials/nav-2.php'; ?>

<link rel="stylesheet" href="css/create-account.css">


<form id='my-listing-form'>
    <input type="hidden" name="create_ad" id="create_ad" value='true'>
    <div id="my-listing">

        <!-- Step 2 -->
        <style>
            .textarea-container textarea {
                width: 100%;
                padding: 16px;
                background-color: #f7f7f7;
                resize: none;
                border: solid 2px #fff;
                outline: none;
                font-size: 16px;
                font-weight: normal;
                border-radius: 16px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                background-clip: padding-box;
                -webkit-transition: all .15s;
                transition: all .15s;
            }
            .inpreq {
                font-size: 16px;
                color: gray;
            }
        </style>

        <style>
            .input-container input {
                height: 64px;
                width: 100%;
                border: none;
                outline: none;
                /* padding: 0px; */
                padding: 10px 20px;
                font-size: 16px;
                font-weight: 600;
                border: solid 1px #000;
            }
        </style>

        <div class="inner-div step current-step" id='step-1'>
            <h4 style='margin-bottom: 30px;'>Log In</h4>
            <div class='step-header'>
                <div class="row no-gutters">
                    <div class="input-wrapper email-wrapper-2">
                        <div class="form-group input-container">
                            <input type="email" class="form-control" id="email-field-2" placeholder="Email address">
                        </div>
                        <div id='email-error-2' class="error"></div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="input-wrapper pwd-wrapper-1">
                        <div class="form-group input-container">
                            <input type="password" class="form-control" id="pwd-field-1" placeholder="Password">
                        </div>
                        <div id='pwd-error-1' class="error"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class='btns-wrapper'>
            
            <a class='btn btn-back' href='./' style='color: #616368;'>Back</a>
            <!-- <span class='btn btn-back' onclick="prevStep()">Back</span> -->
            <span class='btn btn-proceed' onclick="login(event)">Log In</span>
        </div>
    </div>
</form>




    <script defer>
        function login(event) {
             ;

            var formData = new FormData();

            const email = $('#email-field-2').val();
            const password = $('#pwd-field-1').val();

            formData.append('email', email);
            formData.append('password', password);
            formData.append('login', 'true');

            // console.log(email, password);

            if(
                email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
            ) {
                // load_start();

                $('#email-wrapper-2').removeClass('invalid');
                $('#email-error-2').html('');
                $('#pwd-wrapper-1').removeClass('invalid');
                $('#pwd-error-1').html('');

                fetch('./controllers/user-handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    return response.text()      
                })
                .then(response => {
                    setTimeout(function() {
                        // load_end();
                        console.log(response);

                        if($.trim(response) == '1' || $.trim(response) == '7') {
                            window.location.href = './my-account';
                        } 
                        else {
                            $('#ms-response-1').html("<div class='error'>Invalid email or password</div>");
                        }
                    }, 500);
                })
                .catch( err => console.log(err));
            } else {
                // Email error
                if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                    $('#email-error-2').html('');
                    $('#email-wrapper-2').removeClass('invalid');
                } else {
                    if(email) {
                        $('#email-error-2').html('<div>Invalid email</div>');
                        $('#email-wrapper-2').addClass('invalid');
                    } else {
                        $('#email-error-2').html('<div>Required</div>');
                        $('#email-wrapper-2').addClass('invalid');
                    }
                }
                // Password error
                if(password) {
                    $('#pwd-error-1').html('');
                    $('#pwd-wrapper-1').removeClass('invalid');
                } else {
                    $('#pwd-error-1').html('<div>Required</div>');
                    $('#pwd-wrapper-1').addClass('invalid');
                }
            }
        }
    </script>


</body>
</html>