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
    .err {
        color: red;
        margin-top: 3px;
    }
</style>


<style>
    .info-btns-wrapper {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .info-btns-wrapper div:nth-child(1) {
        margin-right: 10px;
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
                    $user->updateEmailForm();
                    $user->updatePwdForm();
                ?>

            </div>
        </div>
    </div>



</div>


<script src="./js/user.js?v=10" defer></script>

<?php
    include './footer.php';
?>