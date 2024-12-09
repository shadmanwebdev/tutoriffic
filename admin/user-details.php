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

<style>
    .td-thumb {
        width: 80px;
        height: 100px;
        overflow: hidden;
    }
    .td-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .table-action a {
        color: #6c757d;
    }
    .table-action .feather {
        width: 18px;
        height: 18px;
    }
    .table-action a:hover {
        color: #212529;
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

        fetch('./confirm-delete-popup.php?id='+id)
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

        fetch('../controllers/service-handler.php', {
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
                        window.location.href = './services';
                    }, 500);
                // }, 500);
            } else {
                $('#message-response-1').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    }
</script>


<style>
    .details-wrapper {
        max-width: 900px;
        margin: 50px auto;
    }
    .details-row {
        max-width: 100%;
        display: flex;
        flex-flow: row wrap;
        column-gap: 20px;
    }
    .details-column {
        width: calc(50% - 10px);
    }
    .card {
        max-width: 900px;
        box-shadow: none;
        padding: 50px;
        margin: 0px auto 20px auto;
    }
    .card-header {
        padding: 10px 0;
    }
    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    ul.details-list {
        width: 100%;
        list-style: none;
    }
    ul.details-list-50 {
        width: 50%;
        list-style: none;
    }
    ul.details-list li,
    ul.details-list-50 li {
        font-size: 16px;
        margin-bottom: 25px;
    }
    ul.details-list li div:first-child,
    ul.details-list-50 li div:first-child {
        margin-bottom: 5px;
    }
    @media screen and (max-width: 900px) {
        .card {
            max-width: 95%;
            box-shadow: none;
            padding: 30px;
            margin: 30px auto;
        }
    }
</style>


<style>
    .details-column.details-column-100 {
        width: 100%;
    }
    .product-group {
        display: flex;
        flex-flow: row nowrap;
    }
    .product-primary, .product-secondary {
        width: calc(50% - 10px);
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
                    $user = new User;
                    $user->user_details($_GET['uid']);
                ?>

                   
 



            </div>
        </div>
    </div>



</div>



<?php
    include './footer.php';
?>
