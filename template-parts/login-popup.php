

<div class='popup hide_popup' id='login-popup'>
    <h4>Log In</h4>
    <form>
            <div class="row no-gutters">
                <div class="input-wrapper">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email-field-2" placeholder="Enter your email address">
                    </div>
                    <div id='email-error-2' class="error"></div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="input-wrapper">
                    <div class="form-group">
                        <input type="password" class="form-control" id="pwd-field-1" placeholder="Enter your password">
                    </div>
                    <div id='pwd-error-1' class="error"></div>
                </div>
            </div>
            <div class="btn-wrapper">
                <button class="submit-btn" onclick='login(event)'>Log In</button>
            </div>
          <div class="row no-gutters">
            <div class="col-md-12 text-center mt-4">
                Don't have an account? <span class='form-link' onclick="popup('join-popup')">Sign Up</span>
            </div>
          </div>
          <div id='ms-response-1' class='text-center'></div>
        </form>
</div>