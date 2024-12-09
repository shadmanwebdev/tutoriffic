

<div class='popup hide_popup' id='join-popup'>
    <h4>Create Account</h4>
    <form>
        <input type="hidden" name='user_account_type_id' id='user_account_type_id'>
        <div class="row no-gutters" style='justify-content: space-between;'>
        <div class="custom-col-6">
            <div class="form-group">
                <input type="text" class="form-control" id="fname-field-1" placeholder="First Name">
            </div>
            <div id='fname-error-1' class="error"></div>
        </div>
        <div class="custom-col-6">
            <div class="form-group">
                <input type="text" class="form-control" id="lname-field-1" placeholder="Last Name">
            </div>
            <div id='lname-error-1' class="error"></div>
        </div>
        </div>
        <div class="row no-gutters">
            <div class="input-wrapper">
                <div class="form-group">
                    <input type="email" class="form-control" id="email-field-3" placeholder="Enter your email address">
                </div>
                <div id='email-error-3' class="error"></div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="input-wrapper">
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd-field-2" placeholder="Enter your password">
                </div>
                <div id='pwd-error-2' class="error"></div>
            </div>
        </div>
        <div class="btn-wrapper">
            <button class="submit-btn" onclick='signup(event)'>Sign Up</button>
        </div>
        <div class="row no-gutters">
            <div class="col-md-12 text-center mt-4">
                Already have an account? <span class='form-link' onclick="popup('login-popup')">Log in</span>
            </div>
        </div>
        <div id='ms-response-2' class='text-center'></div>
    </form>
</div>