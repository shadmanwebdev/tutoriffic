<?php
    include './header.php';
?>

<style>
    .admin-form-outer {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .admin-form-wrapper {
        margin: 50px 20px;
        width: 95%;
        max-width: 700px;
        min-width: 320px;
    }
    .admin-form-wrapper form {
        width: 100%;
    }
    .form-title {
        font-weight: bold;
        letter-spacing: 1.2px;
        margin-bottom: 30px;
        font-size: 23px;
    }
    label {
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }
</style>


<style>
    .err {
        color: red;
        margin-top: 3px;
    }
</style>


<div class='wrapper'>

    <?php
        include './sidebar.php';
    ?>

    <div class='main'>
        <?php
            include './topbar.php';
        ?>
        <div class='admin-form-outer'>
            <div class='admin-form-wrapper'>
                
                <?php
                    $settings = new Settings;
                    $settings->updateForm();
                    $settings->updateLogoForm();
                ?>

            </div>
        </div>
    </div>



</div>






<script src="js/message.js?v=9" defer></script>
<script src="js/post.js?v=13" defer></script>


<script defer>
    function fireButton(event) {
        event.preventDefault();
        document.getElementById('image').click()
    }
    $("#image").change(function(){
        var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
        var imageSrc = document.getElementById('image').value;
        var imageSrcArr = imageSrc.split('\\');
        var imgName = imageSrcArr.at(-1);
        var imgNameArr = imgName.split('.');
        var imgType = imgNameArr.at(-1);

        if(imageSrc && allowed.includes(imgType)) {

            document.getElementById('image-name-1').innerHTML = imgName;
            document.getElementById('image-name-1').classList.remove('err');
            return;
        } else if (!imageSrc) {
            document.getElementById('image-name-1').classList.add('err');
            document.getElementById('image-name-1').innerHTML = 'Source not found';
            return;
        } else if (!allowed.includes(imgType)) {
            document.getElementById('image-name-1').classList.add('err');
            document.getElementById('image-name-1').innerHTML = 'Invalid image type';
            return;
        }
    });

    function update_cover_section() {
        event.preventDefault();
        var formData = new FormData();

        const update_cover_section = $('#update_cover_section').val();
        const title = $('#title').val();
        const subtitle = $('#subtitle').val();
        const image = $('input#image')[0].files[0];

  

        if(update_cover_section) {
            formData.append('update_cover_section', update_cover_section);
            formData.append('title', title);
            formData.append('subtitle', subtitle);
            formData.append('image', image);

            fetch('../controllers/settings-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();   
            })
            .then(response => {
                console.log(response);
                if($.trim(response) == '1') {
                    $('#message-response').html("<div class='success'>Cover section updated!</div>");
                } else {
                    $('#message-response').html("<div class='error'>There was an error</div>");
                }
            })
            .catch( err => console.log(err));
        } else {
            $('#message-response').html("<div class='error'>There was an error</div>");
        }
    }

    function update_logo() {
        event.preventDefault();
        var formData = new FormData();

        const update_logo = $('#update_logo').val();
        const image = $('input#image')[1].files[0];


        if(update_logo) {
            formData.append('update_logo', update_logo);
            formData.append('image', image);

            fetch('../controllers/settings-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();   
            })
            .then(response => {
                console.log(response);
                if($.trim(response) == '1') {
                    $('#message-response').html("<div class='success'>Cover section updated!</div>");
                } else {
                    $('#message-response').html("<div class='error'>There was an error</div>");
                }
            })
            .catch( err => console.log(err));
        } else {
            $('#message-response').html("<div class='error'>There was an error</div>");
        }
    }

</script>


<?php
    include './footer.php';
?>