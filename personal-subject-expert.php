<?php
    include './partials/header.php';
?>
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>

<link rel="stylesheet" href="css/tutor.css">

<style>
    .main-content {
        width: 95%;
        max-width: 1400px !important;
    }
    .user-no-picture {
        width: 100%;
        height: 100%;
        font-size: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: rgb(255,145,77);
    }
</style>

<div class='page-wrapper main-content'>



<style>
    /* Form Wrapper */
    .form-wrapper {
        margin: 25vh auto;
        max-width: 95%;
        text-align: center;
    }
    @media (min-width: 576px) {
        .form-wrapper {
            width: 500px;
        }
    }
    @media (min-width: 768px) {
        .form-wrapper {
            width: 600px;
        }
    }
    @media (min-width: 991px) {
        .form-wrapper {
            width: 626px;
        }
    }
    .form-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 1rem;
        line-height: 1.2;
        color: rgb(34, 34, 34);
        margin-left: auto;
        margin-right: auto;
    }
    /* Form */
    form.question-form {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        padding: 2rem 1rem;
        width: 100%;
        box-shadow: rgba(13, 13, 15, 0.1) 0px 4px 20px 1px;
        background-color: rgb(251, 250, 251);
        border-radius: 0.5rem;
    }
    @media (min-width: 991px) {
        form.question-form {
            padding: 2rem;
        }
    }
    
    /* Topic Wrapper */
    .topic-wrapper, .priority-wrapper {
        width: 100%;
        margin-bottom: 15px;
        text-align: left;
    }
    .topic-wrapper select,
    .priority-wrapper select {
        width: 100%;
        color: rgb(0, 0, 0);
        border-radius: 8px;
        overflow: hidden auto;
        border: 2px solid rgb(235, 113, 0) !important;

        z-index: 100;
        padding: 0.5rem 0.75rem;
        font-size: 1rem !important;
        outline: none !important;
    }
    /* Textarea Wrapper */
    .textarea-wrapper {
        width: 100%;
        margin-bottom: 20px;
        text-align: left;
    }
    /* Textarea */
    textarea.question {
            
        width: 100%;
        color: rgb(0, 0, 0);
        border-radius: 8px;
        overflow: hidden auto;
        max-height: 15rem;
        border: 2px solid rgb(235, 113, 0) !important;

        /* width: 100%; */
        z-index: 100;
        min-height: 5rem;
        padding: 0.5rem 0.75rem;
        font-size: 1rem !important;
        line-height: 2rem !important;
        outline: none !important;

        caret-color: transparent;
        resize: none;
    }
    /* @media (min-width: 991px) {
        textarea.question {
            width: 600px;
        }
    } */
    /* Buttons */
    .qa-btns-wrapper {
        display: flex;
        justify-content: space-between;
    }
    .img-btn-container {
        height: 2.5rem;
        -webkit-box-align: center;
        align-items: center;
        display: flex;
        border-right: none;
        -webkit-box-pack: end;
        justify-content: flex-end;
    }
    .img-btn-container .submit,
    .submit-btn-container .submit {
        border: 0.5rem;
        border-radius: 50%;
        height: 2.5rem;
        margin: 0px;
        padding: 0px;
        width: 2.5rem;
        cursor: default;
    } 
    /* Image Btn */
    .img-btn-container .submit {
        /* width: 100%; */
        text-align: left;
        /* display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: flex-start;
        justify-content: flex-start; */
    }
    /* Submit Btn */
    .submit-btn-container .submit {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        background-color: rgb(226, 225, 230);
        margin-left: 20px;
    }


    .submitContainer .submit i {
        color: rgb(118, 118, 118);
    }

    @media (min-width: 991px) {
        /* .qa-btns-wrapper {         
            display: flex;
        }
        .img-btn-container {
            border-right: 1px solid rgb(146, 142, 159);
        }
        
        .img-btn-container .submit {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            margin-left: 20px;
            margin-right: 20px;
        } */
    }
</style>
    
    

    <?php

        // if(isset($_SESSION['user'])) {
        //     if(isset($_COOKIE['user'])) {
        //         $userdata = json_decode($_COOKIE['user'], true);
        //         $user_account_type_id = $userdata['user_account_type_id'];
        //     } else {
        //         $userdata = json_decode($_SESSION['user'], true);
        //         $user_account_type_id = $userdata['user_account_type_id'];
        //     }

        //     // Check if user is student
        //     if($user_account_type_id == '2') {

?>

<style>
    .form-fields-wrapper {
        display: flex;
        flex-direction: column;
    }
</style>


<style>
    .img-btn-container .submit span {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        background-color: rgb(226, 225, 230);
        margin-left: 20px;

        border: 0.5rem;
        border-radius: 50%;
        height: 2.5rem;
        margin: 0px;
        padding: 0px;
        width: 2.5rem;
        cursor: default;
    }
</style>

<div class="form-wrapper">
    <h1 data-test="title" class="form-title">Personal Subject Expert</h1>
    <form class="question-form">
        <input type="hidden" name='tutor_id' id='tutor_id' value='1'>
        <div class='form-fields-wrapper'>
            <div class="topic-wrapper" id='topic-wrapper'>
                <select name="topic" id="topic">
                    <option value="" hidden>Select Topic</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="English">English</option>
                </select>
                <div class='error' id='topic-error'></div>
            </div>
            <!-- Textarea -->
            <div style='margin-bottom: 15px;' class="textarea-wrapper" id='question-wrapper'>
                <textarea class="question" id="question" name='question' placeholder="What's your question?"></textarea>
                <div style='padding: 2px 4px 0px 4px;' class='error' id='question-error'></div>
            </div>
            <div class="priority-wrapper" id='priority-wrapper'>
                <select name="priority" id="priority">
                    <option value="" hidden>Priority level</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <div class='error' id='priority-error'></div>
            </div>
        </div>
        <!-- Btns -->
        <div class='qa-btns-wrapper'>


            <div class="img-btn-container">
                <div class='submit' style='margin-right: 5px;'>
                    <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
                    <span style='text-align: left;' style='cursor:pointer;' onclick='return fireButton(event);'>
                        <i class='icon-image'></i>
                    </span>  
                </div>
                <span id='image-name-1'></span>
            </div>
            <div class="submit-btn-container">
                <span class='submit' onclick='create_question(event);'>
                    <i class='icon-send'></i>
                </span>
            </div>
        </div>

        <div class='message-response' id='message-response-1'></div>


    </form>

</div>





<?php






        //     }
        // }
    ?>



</div>





<script defer>

    function create_question(event) {
         ;

        var formData = new FormData();

        const topic = $('#topic').val();
        const question = $('#question').val();
        const priority = $('#priority').val();
        
        const input =  $('input#image')[0];
        // var errElement = document.getElementById('err');
        const file =  $('input#image')[0].files[0];

        const tutor_id = $('#tutor_id').val();

        // Reset error messages and styles
        $('#topic-error').html('');
        $('#topic-wrapper').removeClass('invalid');
        $('#question-error').html('');
        $('#question-wrapper').removeClass('invalid');
        $('#priority-error').html('');
        $('#priority-wrapper').removeClass('invalid');

        // Validate form fields
        if (topic && question && priority) {
            formData.append('create_question', 'true');
            formData.append('topic', topic);
            formData.append('question', question);
            formData.append('priority', priority);
            if(file != undefined) {
                formData.append('image', file);
            }
            formData.append('tutor_id', tutor_id);

            fetch('./controllers/question-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(response => {
                setTimeout(function () {
                    if ($.trim(response) === '1') { 
                        $('#message-response-1').html("<div class='success'>Success! Your question was sent</div>");
                    } else {
                        $('#message-response-1').html("<div class='error'>Error! Please try again</div>");
                    }
                }, 500);
            })
            .catch(err => console.log(err));
        } else {
            // Display error messages for empty fields
            if (!topic) {
                $('#topic-error').html("<div>Required</div>");
                $('#topic-wrapper').addClass('invalid');
            } else {
                $('#topic-error').html("");
                $('#topic-wrapper').removeClass('invalid');
            }
            if (!question) {
                $('#question-error').html("<div>Required</div>");
                $('#question-wrapper').addClass('invalid');
            } else {
                $('#question-error').html("");
                $('#question-wrapper').removeClass('invalid');
            }
            if (!priority) {
                $('#priority-error').html("<div>Required</div>");
                $('#priority-wrapper').addClass('invalid');
            } else {
                $('#priority-error').html("");
                $('#priority-wrapper').removeClass('invalid');
            }
        }
    }

</script>



<script defer>
    function fireButton(event) {
         ;
        document.getElementById('image').click()
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            // reader.onload = function (e) {
            //     $('#img-preview').attr('src', e.target.result);
            //     $('.profile-placeholder').css({"display":"none"});
            //     $('#selected-img').css({"display":"block"});
            // }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
        var imageInput = document.getElementById('image');
        var imgErrorElement = document.getElementById('img-error-1');
        // var errElement = document.getElementById('err');

        if (imageInput.files.length === 0) {
            imgErrorElement.innerHTML = '';
            // errElement.classList.remove('s');
            return;
        }

        var file = imageInput.files[0];
        var imgType = file.name.split('.').pop(); // Get the file extension
        var imgSize = file.size; // Get the file size in bytes

        if (!allowed.includes(imgType)) {
            // errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Incorrect File Type</div>';
        } else if (imgSize > 1500000) { // 1.5MB in bytes
            // errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Image is too large (max 1.5MB)</div>';
        } else {
            // errElement.classList.remove('s');
            var imageSrc = imageInput.value;
            var imageSrcArr = imageSrc.split('\\');
            var imgName = imageSrcArr.at(-1);
            document.getElementById('image-name-1').innerHTML = imgName;
            imgErrorElement.innerHTML = '';
            readURL(this); // Assuming readURL is a function to handle image preview
        }
    });
</script>


<!-- <script defer>
    function fireButton(event) {
         ;
        document.getElementById('image').click()
    }


    // Preview Profile Photo
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result);
                $('.profile-placeholder').css({"display":"none"});
                $('#selected-img').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
        var imageInput = document.getElementById('image');
        var imgErrorElement = document.getElementById('img-error');
        var errElement = document.getElementById('err');

        if (imageInput.files.length === 0) {
            imgErrorElement.innerHTML = '';
            errElement.classList.remove('s');
            return;
        }

        var file = imageInput.files[0];
        var imgType = file.name.split('.').pop(); // Get the file extension
        var imgSize = file.size; // Get the file size in bytes

        if (!allowed.includes(imgType)) {
            errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Incorrect File Type</div>';
        } else if (imgSize > 1500000) { // 1.5MB in bytes
            errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Image is too large (max 1.5MB)</div>';
        } else {
            errElement.classList.remove('s');
            imgErrorElement.innerHTML = '';
            readURL(this); // Assuming readURL is a function to handle image preview
        }
    });
</script> -->



</body>
</html>