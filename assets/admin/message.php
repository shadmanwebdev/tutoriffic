<?php
    include './header.php';
?>

<style>
    .message {
        position: relative;
        display: block;
        height: 50px;
        line-height: 50px;
        cursor: default;
        transition-duration: 0.3s;


        font-family: "Roboto", sans-serif;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #76838f;
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
        padding-left: 80px;
    }
</style>

<style>
    .mb-4, .my-4 {
        margin-bottom: 1.5rem !important;
    }
    .mt-1, .my-1 {
        margin-top: 0.25rem !important;
    }
    .media {
        display: flex;
        align-items: flex-start;
    }
    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .float-right {
        float: right !important;
    }


    .text-primary {
        color: #7571f9;
    }
    .text-primary {
        color: #7571f9 !important;
    }
    .m-0 {
        margin: 0 !important;
    }
    h4, .h4 {
        font-size: 1.125rem;
    }
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        margin-bottom: 0.5rem;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #222222;
    }
    h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 0.5rem;
    }


    .btn {
        background-color: #F3F3F9;
        padding: 7px 18px;
    }
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>




<style>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid #eeeef1;
        border-radius: 0.125rem;
        padding: 1.25rem;
    }
    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
    }
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    .w-100 {
        width: 100%!important;
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
                        <!-- <div class="card-header">
                            <h5 class="card-title mb-0">Messages</h5>
                        </div> -->



                        <div class="email-right-box">
                            <?php
                                $message = new Message();
                                echo $message->message($_GET['id']);
                            ?>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>






<script src="js/contact.js"></script>

<?php
    include './footer.php';
?>