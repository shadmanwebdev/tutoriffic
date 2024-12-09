<?php
    include './header.php';
    // require 'vendor/autoload.php';
?>

<style>
    .card {
        max-width: 900px;
    }
    @media screen and (max-width: 576px) {
        .card {
            max-width: 90%;
        }
        .d-none {
            display: none;
        }
    }
</style>





<!-- DELETE POPUP -->
<style>
    #deletePopup {
        width: 600px;
        padding: 50px;
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 1000;
        margin-top: -150px;
        margin-left: -300px;
        box-shadow: 1px 4px 8px rgba(0, 0, 0, 0.5);
        background-color: #fff;
        row-gap: 10px;
    }
    #bookingPopupInner {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 5px;
    }
    #popup-heading {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 45px;
    }
    #btnOuterWrapper, #btnLockedOuterWrapper {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 10px;
        margin-top: 10px;
    }
    .del-popup-btn {
        margin-top: 20px;
        border-color: #4cae4c;
        display: inline-block;
        margin: 0;
        font-weight: normal;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        white-space: nowrap;
        padding: 12px 0;
        width: 150px;
        font-size: 15px;
        line-height: 1.6;
        border-radius: 4px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    #close-btn {
        background-color: gray;
    }
    .del-popup-btn {
        color: #fff;
        background-color: #5cb85c;
    }
    #cross {
        position: absolute;
        right: 15px;
        top: 15px;
    }
    #cross i {
        color: gray;
        font-size: 30px;
        cursor: pointer;
    }
    @media screen and (max-width: 576px) {
        #deletePopup {
            width: 350px;
            height: auto;
            margin-left: -175px;
            margin-top: -250px;
            padding: 50px 30px;
            align-items: center;
        }
        #popup-heading {
            font-size: 18px;
            margin-bottom: 10px;
        }
        #btnOuterWrapper {
            margin-top: 0;
        }
        #bookBtn, #bookCancelBtn {
            width: 120px;
        }
    }

</style>



<!-- DELETE POPUP -->
<div id='deletePopup' class='hide_popup popup'>
    
</div>

<script defer>
    function get_popup_content(id) {
        console.log(id);

        fetch('./confirm-delete-popup.php?type=users&id='+id)
        .then(response => response.text())
        .then(response => {
            console.log(response);
            // setTimeout(function() {
                // Insert Content
                $('#deletePopup').html(response);
                // Show Pop Up
                popup('deletePopup');
            // }, 500);
        })
        .catch( err => console.log(err));
    }
    function confirm_delete() {
        var formData = new FormData();

        const del_id = $('#del_id').val();

        formData.append('del', 'true');
        formData.append('del_id', del_id);

        var url = '../controllers/user-handler.php';
        var redirect_url = './users';

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            console.log(response);
            if(response == '1') {
                // setTimeout(function() {
                    $('#message-response-1').html("<div class='error'>The Item was Deleted!</div>");
                    setTimeout(function() {
                        // Show Pop Up
                        popup('deletePopup');
                        // Reload Page
                        window.location.href = redirect_url;
                    }, 500);
                // }, 500);
            } else {
                $('#message-response-1').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    }
</script>



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


            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Users</h5>
                    </div>
                        
                    <?php
                        $user = new User;
                        $user->users_admin();
                    ?>
                </div>
            </div>



            </div>
        </div>
    </div>



</div>





<?php
    include './footer.php';
?>