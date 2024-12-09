<?php
    include './partials/header.php';
?>
<?php
    // $options = [
    //     'cost' => 11
    // ];
    // // $pwd = password_hash($password, PASSWORD_DEFAULT);
    // $pwd = password_hash('abc', PASSWORD_BCRYPT, $options);
    // echo $pwd;
?>

    <div class='bg-silver-300'>

        <div class="content login-content">
            <form id="login-form" class="login-form" onsubmit='return support_login(event)' method='POST'>
                <input type="hidden" id="login_support_account" name="create_support_account" value="true">
                <h2 class="login-title">Log in</h2>
                <div class="form-group">
                    <div class="input-group-icon right">
                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-icon right">
                        <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <label class="ui-checkbox ui-checkbox-info">
                        <input type="checkbox">
                        <span class="input-span"></span>Remember me</label>
                        <a href="./support-signup">Sign Up</a>
                        <!-- <a href="./forgot-password">Forgot password?</a> -->
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-block" type="submit">Login</button>
                </div>
            </form>
        </div>
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>

        <!-- END PAGA BACKDROPS-->
        <!-- CORE PLUGINS -->
        <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
        <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- PAGE LEVEL PLUGINS -->
        <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <!-- CORE SCRIPTS-->
        <script src="assets/js/app.js" type="text/javascript"></script>
        <!-- PAGE LEVEL SCRIPTS-->
        <script type="text/javascript">
            $(function() {
                $('#login-form').validate({
                    errorClass: "help-block",
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true
                        }
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                });
            });
        </script>
    </div>
</body>

</html>