<?php
    include './partials/header.php';
?>


    <style>
        body {
            background-color: #ebebeb;
        }
        form {
            font-family: sans-serif;
            max-width: 400px;
            padding: 50px;
            margin: 100px auto;
            background-color: #fff;
            border: 1px solid rgb(195, 195, 195);
        }
        form h2 {
            font-size: 28px;
            line-height: 36px;
            font-weight: 400;
            margin: 0 0 30px;
        }
        h4.form-heading {
            margin: 0 0 9px;
            text-align: left;
            font-size: 14px;
            line-height: 20px;
            font-weight: 500;
        }
        .custom-input {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .input-label {
            font-size: 14px;
            position: absolute;
            top: 50%;
            left: 8px;
            transform: translate(0, -50%);
            transition: all 0.3s;
            color: #8a96a3;
            pointer-events: none;
            padding-left: 5px;
            padding-right: 5px;
        }
        .input-field {
            box-sizing: border-box;
            width: 100%;
            padding: 8px 16px;
            border: 1px solid rgba(0, 0, 0, 0.38);
            color: #242529;
            transition: border-color 0.3s, color 0.3s;
            max-height: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 16px;
            line-height: 20px;
            border-radius: 6px;
        }

        .custom-input.focus .input-field {
            border: 1px solid #00aff0;
            outline: none;
        }
        .custom-input.focus .input-label {
            top: 0px;
            left: 5px;
            transform: translateY(-50%) scale(0.85);
            color: #00aff0;
            background-color: #fff;
            padding-left: 5px;
            padding-right: 5px;
        }
        .input-wrapper {
            padding-bottom: 0;
            min-height: 66px;
        }


        .g-btn {
            border: none;
            padding: 8px 18px;
            font-size: 14px;
            line-height: 20px;
            color: #fefefe;
            /* background: #00aff0; */
            background: rgba(138,150,163,.75);
            opacity: .4;
            /* pointer-events: none; */
            min-width: 78px;
            transition: opacity .15s ease,background-color .15s ease,box-shadow .15s ease;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
            display: block;
            width: 100%;
            border-radius: 1000px;
            padding-top: 10px;
            padding-bottom: 10px;
            min-height: 40px;
            cursor: pointer;
        }


        .b-loginreg__links[data-v-dd04cece] {
            font-size: 14px;
            line-height: 20px;
            padding-bottom: 30px;
            padding-top: 30px;
            display: flex;
            justify-content: center;
        }
        .b-loginreg__links>span+span[data-v-dd04cece] {
            padding-left: 18px;
            position: relative;
        }
        .m-flat {
            color: #00aff0;
            padding: 0;
            background-color: transparent;
            font-size: 13px;
            line-height: 20px;
            border: none;
            outline: none;
        }
    </style>



    <style>
        .invalid input.input-field {
            border-color: #ff6060;
        }
        .invalid textarea.input-field {
            border-color: #ff6060;
        }
        .invalid label.input-label {
            color: #ff6060;
        }
        .error-text {
            color: #ff6060;
            font-size: 12px;
            line-height: 20px;
            padding: 0 12px;
        }
        .g-btn.active {
            color: #fefefe;
            background: #00aff0;
            opacity: 1;
        }
    </style>






		
    
        <!-- Forgot password form -->
        <form class="popup hide_popup" action="" id='forgot-pwd-popup'>
            <img onclick="closePopup('subscriber-popup');" class='x-icon' src="assets/svg/x-icon.svg" alt="Close">
            <h4 class="form-heading">If you have an account, you will receive a password reset link to this e-mail.</h4>
            <div class="input-wrapper" id='email-wrapper-1'>
                <div class="custom-input">
                    <label for="email-field" class="input-label">Email</label>
                    <input name="email" id="email-field-1" type="email" class="input-field">
                </div>
                <div id='email-error-1' class="error-text"></div>
            </div>
            <span id='forgot-pwd-submit' class="g-btn" onclick='forgot_password(this.event);'>Send</span>
            
            <!-- Response -->
            <div class='ms-response' id='ms-response-3'></div>

        </form>

        <!-- Log in form -->
        <form action="" id='login-form'>
            <h2>Log In</h2>
            <!-- <h4 class="form-heading">Log In</h4> -->
            <div class="input-wrapper" id='email-wrapper-2'>
                <div class="custom-input">
                    <label for="email-field" class="input-label">Email</label>
                    <input name="email" id="email-field-2" type="email" class="input-field">
                </div>
                <div id='email-error-2' class="error-text"></div>
            </div>
            <div class="input-wrapper" id='pwd-wrapper-1'>
                <div class="custom-input">
                    <label for="password-field" class="input-label">Password</label>
                    <input name="password" id="pwd-field-1" type="password" class="input-field">
                </div>
                <div id='pwd-error-1' class="error-text"></div>
            </div>

            <span id='login-submit' class="g-btn" onclick="login();">LOG IN</span>
            
            <!-- Response -->
            <div class='ms-response' id='ms-response-1'></div>

            <div data-v-dd04cece="" class="b-loginreg__links">
                <span data-v-dd04cece="">
                    <button onclick="popup('forgot-pwd-popup');" type="button" at-attr="forgot_password" class="m-flat"> Forgot password? </button>
                </span>
                <span data-v-dd04cece="">
                    <button id='show-signup-button' type="button" class="m-flat" onclick='showSignupForm()'> Sign up for UncutCollege </button>
                </span>
            </div>

        </form>

        <!-- Sign up form -->
        <form action="" id='signup-form'>
            <h2>Sign up</h2>
            <!-- <h4 class="form-heading">Create Account</h4> -->
            <div class="input-wrapper" id='name-wrapper-1'>
                <div class="custom-input">
                    <label for="name-field" class="input-label">Name</label>
                    <input name="name" id="name-field-1" type="name" class="input-field">
                </div>
                <div id='name-error-1' class="error-text"></div>
            </div>
            <div class="input-wrapper" id='email-wrapper-3'>
                <div class="custom-input">
                    <label for="email-field" class="input-label">Email</label>
                    <input name="email" id="email-field-3" type="email" class="input-field">
                </div>
                <div id='email-error-3' class="error-text"></div>
            </div>
            <div class="input-wrapper" id='pwd-wrapper-2'>
                <div class="custom-input">
                    <label for="password-field" class="input-label">Password</label>
                    <input name="password" id="pwd-field-2" type="password" class="input-field">
                </div>
                <div id='pwd-error-2' class="error-text"></div>
            </div>
            <span id='signup-submit' class="g-btn" onclick='signup();'>SIGN UP</span>

            <!-- Response -->
            <div class='ms-response' id='ms-response-2'></div>

            <div data-v-dd04cece="" class="b-loginreg__links">
                <span data-v-dd04cece="">
                    <button onclick="popup('forgot-pwd-popup');" data-v-dd04cece="" type="button" at-attr="forgot_password" class="m-flat"> Forgot password? </button>
                </span>
                <span data-v-dd04cece="">
                    <button id='show-login-button' data-v-dd04cece="" at-attr="sign_up" type="button" class="m-flat" onclick='showLoginForm()'> Login to UncutCollege </button>
                </span>
            </div>

        </form>




<script>

    // Function to show login form and hide signup form
    function showLoginForm() {
        document.getElementById('login-form').style.display = 'block';
        document.getElementById('signup-form').style.display = 'none';
    }

    // Function to show signup form and hide login form
    function showSignupForm() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('signup-form').style.display = 'block';
    }

    // Add event listeners to the buttons
    document.getElementById('show-signup-button').addEventListener('click', function(event) {
         ; // Prevent the button from submitting the form
        showSignupForm();
    });

    document.getElementById('show-login-button').addEventListener('click', function(event) {
         ; // Prevent the button from submitting the form
        showLoginForm();
    });

    // Check URL query parameter
    const urlParams = new URLSearchParams(window.location.search);
    const formParam = urlParams.get('form');

    if (formParam === 'createaccount') {
        showSignupForm();
    } else {
        showLoginForm();
    }
</script>



<script>

    function forgot_onchage() {
        var emailInput1 = document.getElementById('email-field-1');
    
        if(typeof(emailInput1) != 'undefined' && emailInput1 != null) {
            emailInput1.addEventListener('keydown', function() {
                if(emailInput1.value && emailInput1.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                    $('#email-error-2').html('');
                    $('#email-wrapper-2').removeClass('invalid');
                    $('#forgot-pwd-submit').addClass('active');
                } else {
                    $('#forgot-pwd-submit').removeClass('active');
                    if(emailInput2.value) {
                        $('#email-error-2').html('<div>Please enter a valid email address</div>');
                        $('#email-wrapper-2').addClass('invalid');
                    } else {
                        $('#email-error-2').html('<div>The Email field is required</div>');
                        $('#email-wrapper-2').addClass('invalid');
                    }
                }
            });
        }
    }
    forgot_onchage();


    
    // Define a function to handle validation and updating UI
    function handleInputValidation() {
        var emailInput2 = document.getElementById('email-field-2');
        var pwdInput1 = document.getElementById('pwd-field-1');

        if (emailInput2.value && emailInput2.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-2').html('');
            $('#email-wrapper-2').removeClass('invalid');
            if (typeof(pwdInput1) != 'undefined' && pwdInput1 != null) {
                if (pwdInput1.value) {
                    $('#login-submit').addClass('active');
                } else {
                    $('#login-submit').removeClass('active');
                }
            }
        } else {
            $('#login-submit').removeClass('active');
            if (emailInput2.value) {
                $('#email-error-2').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-2').addClass('invalid');
            } else {
                $('#email-error-2').html('<div>The Email field is required</div>');
                $('#email-wrapper-2').addClass('invalid');
            }
        }
    }
    // Define a function to handle password input validation and updating UI
    function handlePasswordValidation() {
        var emailInput2 = document.getElementById('email-field-2');
        var pwdInput1 = document.getElementById('pwd-field-1');
        if (pwdInput1.value) {
            console.log(pwdInput1.value);
            $('#pwd-error-1').html('');
            $('#pwd-wrapper-1').removeClass('invalid');
            if (emailInput2.value && emailInput2.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                if (emailInput2.value) {
                    $('#login-submit').addClass('active');
                } else {
                    $('#login-submit').removeClass('active');
                }
            }
        } else {
            $('#pwd-error-1').html('<div>The Password field is required</div>');
            $('#pwd-wrapper-1').addClass('invalid');
        }
    }
    function login_onchage() {
        var emailInput2 = document.getElementById('email-field-2');
        var pwdInput1 = document.getElementById('pwd-field-1');
    
        // Attach the common function to 'keydown' and 'change' events
        if (typeof(emailInput2) != 'undefined' && emailInput2 != null) {
            emailInput2.addEventListener('keydown', handleInputValidation);
            emailInput2.addEventListener('change', handleInputValidation);
        }
        // Attach the common function to 'keydown' and 'change' events for pwdInput1
        if (typeof(pwdInput1) != 'undefined' && pwdInput1 != null) {
            pwdInput1.addEventListener('keydown', handlePasswordValidation);
            pwdInput1.addEventListener('change', handlePasswordValidation);
        }
    }
    login_onchage();

    







    // Define a function to handle input validation and updating UI for signup form
    function handleSignupInputValidation(name, email, pwd) {
        if (name && pwd && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#signup-submit').addClass('active');
        } else {
            $('#signup-submit').removeClass('active');
        }
    }

    // Define a function to handle input validation and updating UI for name input
    function handleNameValidation() {
        var nameInput1 = document.getElementById('name-field-1');
        var emailInput3 = document.getElementById('email-field-3');
        var pwdInput2 = document.getElementById('pwd-field-2');
        
        if (nameInput1.value) {
            handleSignupInputValidation(nameInput1.value, emailInput3.value, pwdInput2.value);
            $('#name-error-1').html('');
            $('#name-wrapper-1').removeClass('invalid');
        } else {
            $('#name-error-1').html('<div>The Name field is required</div>');
            $('#name-wrapper-1').addClass('invalid');
        }
    }

    // Define a function to handle input validation and updating UI for email input
    function handleEmailValidation() {
        var nameInput1 = document.getElementById('name-field-1');
        var emailInput3 = document.getElementById('email-field-3');
        var pwdInput2 = document.getElementById('pwd-field-2');
        
        if (emailInput3.value && emailInput3.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-3').html('');
            $('#email-wrapper-3').removeClass('invalid');
            handleSignupInputValidation(nameInput1.value, emailInput3.value, pwdInput2.value);
        } else {
            if (emailInput3.value) {
                $('#email-error-3').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-3').addClass('invalid');
            } else {
                $('#email-error-3').html('<div>The Email field is required</div>');
                $('#email-wrapper-3').addClass('invalid');
            }
        }
    }

    // Define a function to handle input validation and updating UI for password input
    function handlePwdValidation() {
        var nameInput1 = document.getElementById('name-field-1');
        var emailInput3 = document.getElementById('email-field-3');
        var pwdInput2 = document.getElementById('pwd-field-2');
        
        if (pwdInput2.value) {
            $('#pwd-error-2').html('');
            $('#pwd-wrapper-2').removeClass('invalid');
            handleSignupInputValidation(nameInput1.value, emailInput3.value, pwdInput2.value);
        } else {
            $('#pwd-error-2').html('<div>The Password field is required</div>');
            $('#pwd-wrapper-2').addClass('invalid');
        }
    }

    // Attach the common functions to 'keydown' and 'change' events for signup form inputs
    function signup_onchange() {
        var nameInput1 = document.getElementById('name-field-1');
        var emailInput3 = document.getElementById('email-field-3');
        var pwdInput2 = document.getElementById('pwd-field-2');

        if (typeof(nameInput1) != 'undefined' && nameInput1 != null) {
            nameInput1.addEventListener('keydown', handleNameValidation);
            nameInput1.addEventListener('change', handleNameValidation);
        }

        if (typeof(emailInput3) != 'undefined' && emailInput3 != null) {
            emailInput3.addEventListener('keydown', handleEmailValidation);
            emailInput3.addEventListener('change', handleEmailValidation);
        }

        if (typeof(pwdInput2) != 'undefined' && pwdInput2 != null) {
            pwdInput2.addEventListener('keydown', handlePwdValidation);
            pwdInput2.addEventListener('change', handlePwdValidation);
        }
    }

    // Call the signup_onchange function to set up event listeners
    signup_onchange();


    
</script>







<?php
    include './partials/footer.php';
?>