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
                $contactDetails = new Message2();
                echo $contactDetails->updateForm();
            ?>

            </div>
        </div>
    </div>



</div>



<script defer>

    function update_contact_details(event) {
        event.preventDefault();
        var formData = new FormData();

        const update_contact_details = $('#update_contact_details').val();
        const address = $('#address').val();
        const phone = $('#phone').val();
        const email = $('#email').val();
        const website = $('#website').val();

        if(update_contact_details) {
            load_start();
            
            formData.append('update_contact_details', update_contact_details);
            formData.append('address', address);
            formData.append('phone', phone);
            formData.append('email', email);
            formData.append('website', website);

            // console.log(update_hero_slide, hero_slide_id, title, subtitle, link, image);

            fetch('../controllers/message-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();   
            })
            .then(response => {
                console.log(response);
                setTimeout(function() {
                    load_end();
                    if($.trim(response) == '1') {
                        $('#message-response-1').html("<div class='success'>Contact details updated!</div>");
                    } else {
                        $('#message-response-1').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            $('#message-response-1').html("<div class='error'>There was an error</div>");
        }

    }
</script>


<?php
    include './footer.php';
?>