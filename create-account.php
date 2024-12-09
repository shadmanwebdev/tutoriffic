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

        <!-- Step 1 -->
        <div class="inner-div step current-step" id='step-1'>
            <div id="elementF" style='margin-top: 60px;'>
                <h4 style='margin-bottom: 30px;'>Choose account type</h4>
                <ul>
                    <li>
                        <a class="list-item">
                        Student<input name='home' id='home' value='2' type="checkbox" style="display: none;">
                        </a>
                    </li>
                    <li>
                        <a class="list-item">
                        Parent/Guardian<input name='travel' id='travel' value='1' type="checkbox" style="display: none;"> 
                        </a>
                    </li>
                    <li>
                        <a class="list-item">
                        Tutor<input name='online' id='online' value='3' type="checkbox" style="display: none;"> 
                        </a>
                    </li>
                </ul>
            </div>
        </div>

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

        <div class="inner-div step" id='step-2'>
            <h4 style='margin-bottom: 30px;'>Account details</h4>
            <div class='step-header'>
                <input type="hidden" name='user_account_type_id' id='user_account_type_id'>
                <div class="row no-gutters" style='justify-content: space-between;'>
                <div class="custom-col-6">
                    <div class="form-group input-container">
                        <input type="text" class="form-control" id="fname-field-1" placeholder="First Name">
                    </div>
                    <div id='fname-error-1' class="error"></div>
                </div>
                <div class="custom-col-6">
                    <div class="form-group input-container">
                        <input type="text" class="form-control" id="lname-field-1" placeholder="Last Name">
                    </div>
                    <div id='lname-error-1' class="error"></div>
                </div>
                </div>
                <div class="row no-gutters">
                    <div class="input-wrapper">
                        <div class="form-group input-container">
                            <input type="text" class="form-control" id="phone-field-3" placeholder="Phone">
                        </div>
                        <div id='phone-error-3' class="error"></div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="input-wrapper">
                        <div class="form-group input-container">
                            <input type="email" class="form-control" id="email-field-3" placeholder="Email address">
                        </div>
                        <div id='email-error-3' class="error"></div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="input-wrapper">
                        <div class="form-group input-container">
                            <input type="password" class="form-control" id="pwd-field-2" placeholder="Password">
                        </div>
                        <div id='pwd-error-2' class="error"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class='btns-wrapper'>
            <span class='btn btn-back' onclick="prevStep()">Back</span>
            <span class='btn btn-proceed' onclick="nextStep()">Next</span>
        </div>
    </div>
</form>




    <script defer>
        function prevStep() {
            var curStep = document.querySelector('.current-step');
            var curStepId = curStep.id;
            var idArr = curStepId.split('-');
            var curStepNum = parseInt(idArr[1]);
            if(curStepNum != 1) {
                var prevStepNum = curStepNum - 1;
                var prevStep = document.getElementById('step-' + prevStepNum);
                curStep.classList.remove('current-step');
                prevStep.classList.add('current-step');
            }
        }
        function nextStep() {

            var curStep = document.querySelector('.current-step');
            console.log(curStep);
            var curStepId = curStep.id;               
            var idArr = curStepId.split('-');
            var curStepNum = parseInt(idArr[1]);
            if(curStepNum == 2) {

                signup();                  
                
            } else {

                var nextStepNum = parseInt(idArr[1]) + 1;
                var nextStep = document.getElementById('step-' + nextStepNum);
                curStep.classList.remove('current-step');
                nextStep.classList.add('current-step');
            }

        }
    </script>

    <script defer>

        function handleCheckboxClick(checkboxContainerId) {
            const container = document.getElementById(checkboxContainerId);
            const liItems = container.querySelectorAll(".list-item");

            liItems.forEach((l) => {
                const checkbox = l.querySelector("input[type='checkbox']");

                // Function to update checkbox and list item state
                function updateState() {
                    if (checkbox.checked) {
                        liItems.forEach((otherItem) => {
                            const otherCheckbox = otherItem.querySelector("input[type='checkbox']");
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.checked = false;
                                otherItem.classList.remove("selected-item");
                                otherCheckbox.style.display = "none";
                            }
                        });

                        l.classList.add("selected-item");
                        checkbox.style.display = "block";
                    } else {
                        l.classList.remove("selected-item");
                        checkbox.style.display = "none";
                    }
                }

                // Event listener for list item click
                l.addEventListener("click", () => {
                    checkbox.checked = !checkbox.checked;
                    updateState();
                });

                // Event listener for checkbox click
                checkbox.addEventListener("click", (e) => {
                    e.stopPropagation();
                    updateState();
                });

            });
        }
        // Usage
        handleCheckboxClick("elementF");

        function signup() {
            
            var formData = new FormData();

            const fname = $('#fname-field-1').val();
            const lname = $('#lname-field-1').val();
            const phone = $('#phone-field-3').val();
            const email = $('#email-field-3').val();
            const password = $('#pwd-field-2').val();

            const user_account_type_id = getCheckboxValue('elementF');
            


            // console.log(email, password);

            if(
                fname && lname && phone && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
            ) {
                // load_start();

                $('#fname-wrapper-1').removeClass('invalid');
                $('#fname-error-1').html('');
                $('#lname-wrapper-1').removeClass('invalid');
                $('#lname-error-1').html('');
                $('#email-wrapper-3').removeClass('invalid');
                $('#email-error-3').html('');
                $('#phone-wrapper-3').removeClass('invalid');
                $('#phone-error-3').html('');
                $('#pwd-wrapper-2').removeClass('invalid');
                $('#pwd-error-2').html('');

                formData.append('fname', fname);
                formData.append('lname', lname);
                formData.append('email', email);
                formData.append('phone', phone);
                formData.append('password', password);
                formData.append('user_account_type_id', user_account_type_id);
                formData.append('signup', 'true');


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
                        // console.log(response);
                        if($.trim(response) == '1') {
                            window.location.href = './signup-confirmation?code=1&status=success';
                            // $('#message-response').html("<div class='success'>Success!</div>");
                        } else if($.trim(response) == '2') {
                            $('#ms-response-2').html("<div class='error'>Email already exists</div>");
                        } else {
                            $('#ms-response-2').html("<div class='error'>Error! Please try again</div>");
                        }
                    }, 500);
                })
                .catch( err => console.log(err));
            } else {
                // First name error
                if(fname) {
                    $('#fname-error-1').html('');
                    $('#fname-wrapper-1').removeClass('invalid');
                } else {
                    $('#fname-error-1').html('<div>Required</div>');
                    $('#fname-wrapper-1').addClass('invalid');
                }
                // Last name error
                if(lname) {
                    $('#lname-error-1').html('');
                    $('#lname-wrapper-1').removeClass('invalid');
                } else {
                    $('#lname-error-1').html('<div>Required</div>');
                    $('#lname-wrapper-1').addClass('invalid');
                }
                // Email error
                if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                    $('#email-error-3').html('');
                    $('#email-wrapper-3').removeClass('invalid');
                } else {
                    if(email) {
                        $('#email-error-3').html('<div>Invalid email address</div>');
                        $('#email-wrapper-3').addClass('invalid');
                    } else {
                        $('#email-error-3').html('<div>Required</div>');
                        $('#email-wrapper-3').addClass('invalid');
                    }
                }
                // Phone error
                if(phone) {
                    $('#phone-error-3').html('');
                    $('#phone-wrapper-3').removeClass('invalid');
                } else {
                    $('#phone-error-3').html('<div>Required</div>');
                    $('#phone-wrapper-3').addClass('invalid');
                }
                // Password error
                if(password) {
                    $('#pwd-error-2').html('');
                    $('#pwd-wrapper-2').removeClass('invalid');
                } else {
                    $('#pwd-error-2').html('<div>Required</div>');
                    $('#pwd-wrapper-2').addClass('invalid');
                }
            }
        }

        function getCheckboxValue(checkboxWrapperId) {
            // Get selected checkbox value
            let selectedValue = '';
            $("#"+checkboxWrapperId+ " input[type='checkbox']").each(function () {
                if ($(this).prop('checked')) {
                    selectedValue = $(this).val();
                    return false; // break out of the loop
                }
            });
            return selectedValue;
        }   

    </script>

    <script>
        function collectAndEncodeValues(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]:checked');
            const valuesArray = [];

            checkboxes.forEach(checkbox => {
                valuesArray.push({
                    id: checkbox.getAttribute('data-' + dropdownId.replace('-dropdown', '') + '-id'),
                    value: checkbox.value
                });
            });

            const encodedValues = JSON.stringify(valuesArray);
            console.log(encodedValues);
            return encodedValues;

            // You can now append the encodedValues to a form or use it as needed
            // For example, assuming you have a form with id 'myForm'
            // document.getElementById('myForm').append('encodedValues', encodedValues);
        }
    </script>


</body>
</html>