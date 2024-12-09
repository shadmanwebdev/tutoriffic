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




<style>
    #messages {
        border: 1px solid #eeeef1;
    }
    .message {
        position: relative;
        display: block;
        height: 50px;
        line-height: 50px;
        cursor: default;
        transition-duration: 0.3s;
    }
    a {
        text-decoration: none;
        transition: all 0.4s ease-in-out;
        color: #76838f;
    }
    a:hover {   
        color: #7571f9;
        text-decoration: none;
    }
    .message .col-mail {
        display: flex;
        flex-flow: row nowrap;
    }
    .message .col-mail-2 .subject {
        overflow: hidden;
        white-space: nowrap;
    }
    .message .col-mail-2 .date {
        width: 170px;
        /* padding-left: 80px; */
    }
</style>



<style>
    tr:hover {
        cursor: pointer;
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

                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Messages</h5>
                        </div>
                    
                        <?php
                            $message = new Message;
                            $message->messages();
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