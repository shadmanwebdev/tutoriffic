<?php
    include './partials/header.php';
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


    <!-- User Avatar -->
    <style>
        .choose-photo {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
            row-gap: 30px;
            border-radius: 50%;
            overflow: hidden;
            box-sizing: content-box;
        }
        .selected-img {
            position: relative;
            width: 200px;
            height: 200px;
            display: none;
            margin: 0 auto;
            border-radius: 20px; 
            overflow: hidden;
        }
        .selected-img img {
            width: inherit;
            height: inherit;
            object-fit: cover;
        }
        .selected-img img.img-success {
            width: 35px;
            height: 35px;
            position: absolute;
            top: 5px;
            right: 5px;
        }
        .profile-placeholder {
            width: 200px;
            height: 200px;
            overflow: hidden;
            margin: 0 auto;
            border-radius: 50%;
        }
        .profile-placeholder img {
            width: 100%;
            height: 100%;    
            object-fit: cover;
        }
        .register-btn-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .upload-btn {
            width: 200px;
            color: #1B68FF;
            background-color: #fff;
            padding: 8px 0;
            text-align: center;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            border: 1px solid #1B68FF;
        }
        .profile-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .err {
            display: none;
            padding: 5px 15px;
            border-radius: 30px;
            background: #D70000;
            margin: 0 auto;
            font-size: 16px;
            position: absolute;
            color: #fff;
        }
        .err.s {
            display: block;
        }
        .selected-option {
            font-weight: 500;
        }
        textarea#description {
            font-weight: 500;
        }
        .img-error .error {
            color: #ff6060;
            font-size: 12px;
            letter-spacing: .6px;
            line-height: 20px;
            padding: 0 12px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>






    <!-- Select -->
    <style>
        /* Apply styles to the custom-selector container */
        .custom-selector {
            position: relative;
            margin-bottom: 20px;
        }

        /* Apply styles to the custom-select-wrapper */
        .custom-select-wrapper {
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
            position: relative;
            width: 100%;
            text-align: left;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Apply styles when the custom-select-wrapper has focus */
        .custom-select-wrapper:focus {
            border-color: #444;
        }

        /* Apply styles to the custom-options when the custom-select-wrapper has focus */
        .custom-select-wrapper:focus .custom-options {
            border-color: #444;
            max-height: 180px;
            overflow: scroll;
        }

        /* Apply styles to the triangle icon after the selected label when the custom-select-wrapper has focus */
        .custom-select-wrapper:focus .selected-label:after {
            transition: all 0.3s ease;
            border-color: #444 transparent transparent transparent;
            transform: translateY(-50%) rotate(-180deg);
        }

        /* Apply styles to the selected label */
        .selected-label {
            color: #999;
            width: 100%;
            display: inline-block;
            padding: 18px 10.4px 18px 20px;
            box-sizing: border-box;
        }

        /* Apply styles to the selected label when it is focused */
        .selected-label.already {
            color: #444;
        }

        /* Apply styles to the triangle icon after the selected label */
        .selected-label:after {
            content: "";
            transition: all 0.3s ease;
            width: 0;
            height: 0;
            position: absolute;
            right: 20px;
            top: 50%;
            transform-origin: 50% 50%;
            transform: translateY(-50%) rotate(0deg);
            border-style: solid;
            border-width: 6px 4.5px 0 4.5px;
            border-color: #d8d8d8 transparent transparent transparent;
        }

        /* Apply styles to the custom-options */
        .custom-options {
            position: absolute;
            top: calc(100% - 10px);
            left: -1px;
            width: calc(100% + 2px);
            list-style: none;
            border: 1px solid #e0e0e0;
            border-top-color: #fff !important;
            border-radius: 0 0 5px 5px;
            padding: 0 10px 10px 10px;
            overflow: hidden;
            cursor: pointer;
            z-index: 100;
        }

        /* Apply styles to the custom-options and custom-options li */
        .custom-options,
        .custom-options li {
            background-color: #fff;
            box-sizing: border-box;
        }

        /* Apply styles to the custom-options li */
        .custom-options li {
            transition: all 0.3s ease;
            width: 100%;
            padding: 10px 0 10px 10px;
            border-radius: 5px;
            color: #999;
        }

        /* Apply styles to the custom-options li when hovering or having the cursor on it */
        .custom-options li.cursorOn,
        .custom-options li:hover {
            background-color: #f7f7f7;
            color: #fff;
            color: #444;
        }

        /* Apply styles to the selected option in the custom-options */
        .custom-options li.selected {
            color: #444;
        }
        .custom-options:not(.active) {
            display: none;
        }
        .custom-options.active {
            display: block;
            max-height: 180px;
            overflow: scroll;
        }
        .custom-options:not(.active) + .selected-label:after {
            width: 0;
            height: 0;
            border: none;
        }
        .custom-options li {
            transition: all 0.3s ease;
            width: 100%;
            padding: 10px 0 10px 10px;
            border-radius: 5px;
            color: #999;
        }
        .custom-options li.cursorOn,
        .custom-options li:hover {
            background-color: #f7f7f7;
            color: #fff;
            color: #444;
        }
        .custom-options li.selected {
            color: #444;
        }
    </style>

    <!-- Input -->
    <style>
        /* Apply styles to the custom input element */
        .custom-input {
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
            position: relative;
            width: 100%;
            text-align: left;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 600;
            padding: 18px 10.4px 18px 20px;
            color: #999;
            box-sizing: border-box;
        }

        /* Apply styles to the custom input element when it's focused */
        .custom-input:focus {
            border-color: #444;
        }

        /* Apply styles to the success rule-checker class for the input element */
        .custom-input.rule-checker-success {
            /* Add your success styles here */
        }

        /* Apply styles to the custom input element when it's a placeholder */
        .custom-input::placeholder {
            color: #999;
        }

        /* Apply styles to the custom input element when it's a success */
        .custom-input[data-rule="success"] {
        /* Add your success styles here */
        }
    </style>

        

    

        <div class='container dashboard-container'>
            <div class='row'>

                <!-- Column 1 -->
                <div class='col-md-4'>
                    <!-- <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title text-center mb-4">General Information 🙂</h6>
                            
 


                            <div class="custom-selector">
                                <div class="custom-select-wrapper">
                                    <span class="selected-label" id="gender">Gender</span>
                                    <ul class="custom-options">
                                        <li data-value="M"><span data-label="Male">Male</span></li>
                                        <li data-value="F"><span data-label="Female">Female</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <input type="text" class="custom-input" data-rule="success" data-label="firstname" name='firstname' id='firstname' placeholder="First name">
                            </div>
                            <div>
                                <input type="text" class="custom-input" data-rule="success" data-label="lastname" name='lastname' id='lastname' placeholder="Last name">
                            </div>
                            <div>
                                <input type='date' class="custom-input" data-rule="success" data-label="date_of_birth" name='date_of_birth' id='date_of_birth'>
                            </div>
                            <div>
                                <input type="text" class="custom-input" data-rule="success" data-label="email" placeholder="Email" name='email' id='email'>
                            </div>
                            <div>
                                <input type="text" class="custom-input" data-rule="success" data-label="phone" placeholder="Phone" name='phone' id='phone'>
                            </div>
                            <div>
                                <input type="text" class="custom-input" data-rule="success" data-label="skype_id" placeholder="Skype ID" name='skype_id' id='skype_id'>
                            </div>

                            
                            <div class="custom-selector">
                                <div class="custom-select-wrapper">
                                    <span class="selected-label" id="availability">Availability</span>
                                    <ul class="custom-options">
                                        <li data-value="1"><span data-label="Available">Yes</span></li>
                                        <li data-value="0"><span data-label="Not Available">No</span></li>
                                    </ul>
                                </div>
                            </div>

        


                            <div class='row justify-content-center'>
                                <input onclick='update_user_details(event)' style='margin: 10px auto 0 auto;' type="submit" class="form-btn btn btn-validate" value="Save">
                            </div>
                        </div>
                    </div> -->

                    <?php
                        $user->general_info_form();
                    ?>

                    <?php
                        $user->certificate_form();
                    ?>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title text-center">Notifications</h6>
                            
                            <style>
                                .custom-checkbox {
                                    background-color: #5bca8d;
                                    padding: 15px 20px;
                                    display: flex;
                                    align-items: center;
                                    margin-bottom: 10px;
                                    border-radius: 5px;
                                }
                                .custom-checkbox-inner {
                                    display: flex;
                                    align-items: center;
                                    margin-right: 10px;
                                }

                                /* Hide the default checkbox */
                                input[type="checkbox"] {
                                    display: none;
                                }

                                /* Style the label to create a custom checkbox */
                                label {
                                    display: inline-block;
                                    position: relative;
                                    padding: 10px; /* Adjust the padding as needed */
                                    border: 2px solid #ccc; /* Default border color */
                                    border-radius: 50%; /* Make it round */
                                    width: 20px; /* Set the width and height for the custom checkbox */
                                    height: 20px;
                                    background-color: #f0f0f0; /* Default background color */
                                    margin-bottom: 0;
                                }

                                /* Style the label when the checkbox is checked */
                                input[type="checkbox"]:checked + label {
                                    background-color: #fff; /* Background color when checked */
                                    border-color: #5bca8d; /* Green border color when checked */
                                }

                                /* Add some inner content or icons to the label to indicate the checkbox */
                                label::before {
                                    content: '\2713'; /* Unicode checkmark symbol */
                                    display: block;
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    color: #5bca8d; /* Green color for the checkmark when checked */
                                    font-size: 14px; /* Adjust the size of the checkmark */
                                    opacity: 0; /* Hide the checkmark by default */
                                }

                                /* Style the label when the checkbox is not checked */
                                input[type="checkbox"] + label {
                                    transition: background-color 0.3s, border-color 0.3s; /* Add a smooth transition effect */
                                }

                                /* Show the checkmark when the checkbox is checked */
                                input[type="checkbox"]:checked + label::before {
                                    opacity: 1;
                                }
                                .checkbox-text {
                                    color: #fff!important;
                                    font-size: 15px;
                                    font-weight: 500;
                                    color: #999;
                                    display: inline-block;

                                }
                            </style>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input type="checkbox" id="custom-checkbox">
                                    <label for="custom-checkbox"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Account activity
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input type="checkbox" id="custom-checkbox-2">
                                    <label for="custom-checkbox-2"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Lesson Requests
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input type="checkbox" id="custom-checkbox-3">
                                    <label for="custom-checkbox-3"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Offers concerning my Ads
                                </div>
                            </div>
                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input type="checkbox" id="custom-checkbox-4">
                                    <label for="custom-checkbox-4"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Newsletter
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>


                <!-- Column 2 -->
                <div class='col-md-4'>
                    
                    
                    <?php
                        $user->postal_address_form();
                    ?>
                    <?php
                        $user->identification_form();
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-center">Delete Account</h6>
                            <p class="card-text">ATTENTION! All of your data (contacts, ads, emails, ...) will be definitively and irreversibly deleted.</p>
                            <a href="#" class="btn btn-gray">Delete Account</a>
                        </div>
                    </div>
                </div>

                
                <!-- Column 3 -->
                <div class='col-md-4'>
                    <?php
                        $user->profile_photo_form();
                    ?>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title text-center">Change Password</h6>
                            

                            <div class='row justify-content-center'>
                                <input onclick='update_user_details(event)' style='margin: 10px auto 0 auto;' type="submit" class="form-btn btn btn-validate" value="Send Reset Link">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





<script src="js/image-processing.js" defer></script>

<script defer>
    custom_select();
    $('.image-input-1').on('change', function() {
        console.log(this);
        validateImage(this);

        const input =  $('input.image-input-1')[0];
        var errElement = document.querySelector('.err-1');

        const file =  $('input.image-input-1')[0].files[0];
        const reader = new FileReader();
        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 900; // Change this to your desired width
                    const maxHeight = 900; // Change this to your desired height

                    let newWidth = img.width;
                    let newHeight = img.height;

                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }

                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }

                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {

                        var formData = new FormData();

                        // Append the resized image blob to the original formData object
                        formData.append('upload_certificate', 'true');
                        formData.append('certificate', blob, 'resized_image.webp');


                        fetch('./controllers/user-handler', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            return response.text();
                        })
                        .then(response => {
                            console.log(response);
                            if(response == '1') {

                                $('#message-response-2').html("<div class='success'>Updated!</div>");
                            } else {
                                $('#message-response-2').html("<div class='error'>Error!</div>");

                            }
                        })
                        .catch(err => console.log(err));

                    }, 'image/webp', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };

            reader.readAsDataURL(file);
        }
    });
    $('.image-input-2').on('change', function() {
        console.log(this);
        validateImage(this);

        const input =  $('input.image-input-2')[0];
        var errElement = document.querySelector('.err-2');

        const file =  $('input.image-input-2')[0].files[0];
        const reader = new FileReader();
        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 900; // Change this to your desired width
                    const maxHeight = 900; // Change this to your desired height

                    let newWidth = img.width;
                    let newHeight = img.height;

                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }

                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }

                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {

                        var formData = new FormData();

                        // Append the resized image blob to the original formData object
                        formData.append('upload_identification', 'true');
                        formData.append('identification', blob, 'resized_image.webp');


                        fetch('./controllers/user-handler', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            return response.text();
                        })
                        .then(response => {
                            console.log(response);
                            if(response == '1') {

                                $('#message-response-3').html("<div class='success'>Updated!</div>");
                            } else {
                                $('#message-response-2').html("<div class='error'>Error!</div>");

                            }
                        })
                        .catch(err => console.log(err));

                    }, 'image/webp', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };

            reader.readAsDataURL(file);
        }
    });
    $('.image-input-3').on('change', function() {
        console.log(this);
        validateImage(this);

        const input =  $('input.image-input-3')[0];
        var errElement = document.querySelector('.err-3');

        const file =  $('input.image-input-3')[0].files[0];
        const reader = new FileReader();
        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 900; // Change this to your desired width
                    const maxHeight = 900; // Change this to your desired height

                    let newWidth = img.width;
                    let newHeight = img.height;

                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }

                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }

                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {

                        var formData = new FormData();

                        // Append the resized image blob to the original formData object
                        formData.append('upload_profile_photo', 'true');
                        formData.append('profile_photo', blob, 'resized_image.webp');


                        fetch('./controllers/user-handler', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            return response.text();
                        })
                        .then(response => {
                            console.log(response);
                            if(response == '1') {

                                $('#message-response-4').html("<div class='success'>Updated!</div>");
                            } else {
                                $('#message-response-2').html("<div class='error'>Error!</div>");

                            }
                        })
                        .catch(err => console.log(err));

                    }, 'image/webp', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };

            reader.readAsDataURL(file);
        }
    });
    function update_postal_address(event) {
         ;
        const address = $("#address").val();

        var formData = new FormData();

        formData.append('update_postal_address', 'true');
        formData.append('address', address)


        fetch('./controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            // setTimeout(function() {
                console.log(response);
                if ($.trim(response) == '1') {
                    $('#message-response-5').html("<div class='success'>Updated!</div>");
                } else {
                    $('#message-response-5').html("<div class='error'>Error!</div>");
                }
            // }, 500);
        })
        .catch(err => console.log(err));
    }
    function update_user_details(event) {
         ;
        const firstname = $("input[name='firstname']").val();
        const lastname = $("input[name='lastname']").val();
        const email = $("input[name='email']").val();
        const gender = $("span[id='gender']").text();
        const date_of_birth = $("input[name='date_of_birth']").val();
        const phone = $("input[name='phone']").val();
        const skype_id = $("input[name='skype_id']").val();
        


        if (email) {
            var formData = new FormData();

            formData.append('update_user_details', 'true');
            formData.append('firstname', firstname);
            formData.append('lastname', lastname);
            formData.append('email', email);
            formData.append('gender', gender);
            formData.append('date_of_birth', date_of_birth);
            formData.append('phone', phone);
            formData.append('skype_id', skype_id);

            if ($("span[id='availability']").length > 0) {
                const availability = $("span[id='availability']").text();
                formData.append('availability', availability);
            }


            fetch('./controllers/user-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();
            })
            .then(response => {
                // setTimeout(function() {
                    console.log(response);
                    if ($.trim(response) == '1') {
                        $('#message-response').html("<div class='success'>Updated!</div>");
                    } else {
                        $('#message-response').html("<div class='error'>Error!</div>");
                    }
                // }, 500);
            })
            .catch(err => console.log(err));
        } else {
            $('#code').addClass('invalid');
            $('#codeError').html('<div>Code cannot be blank</div>');
        }
    }
</script>

</body>
</html>