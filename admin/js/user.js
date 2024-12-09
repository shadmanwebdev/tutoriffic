function update_user_password() {
    var formData = new FormData();

    const password = $('#password-field').val();
    const password_repeat = $('#password-field-2').val();
    
    if(
       password && password_repeat && password == password_repeat
    ) {
        load_start();

        $('#password-error').html('');
        $('#password-wrapper').removeClass('invalid');
        $('#password-error-2').html('');
        $('#password-wrapper-2').removeClass('invalid');

        formData.append('update_user_password', 'true');
        formData.append('pwd', password);

        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            setTimeout(function() {
                load_end();

                console.log(response);
                if($.trim(response) == '1') {
                    $('#message-response-2').html("<div class='success'>Password updated!</div></div>");
                } else {
                    $('#message-response-2').html("<div class='error'>There was an error</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {

        /*
            1. Passwords exist and they match
            2. Passwords exist but they don't match
            3. One of the password fields are empty
        */
        if(password && password_repeat && password == password_repeat) {
            $('#password-error').html('');
            $('#password-wrapper').removeClass('invalid');
            $('#password-error-2').html('');
            $('#password-wrapper-2').removeClass('invalid');
        } else if(password && password_repeat && password != password_repeat) {
            $('#password-error-2').html('<div>Passwords don\'t match</div>');
            $('#password-wrapper-2').addClass('invalid');
        } else {
            // Password
            if(password) {
                $('#password-error').html('');
                $('#password-wrapper').removeClass('invalid');
            } else {
                $('#password-error').html('<div>Field cannot be blank</div>');
                $('#password-wrapper').addClass('invalid');
            }
            // Repeat Password
            if(password_repeat) {
                $('#password-error-2').html('');
                $('#password-wrapper-2').removeClass('invalid');
            } else {
                $('#password-error-2').html('<div>Field cannot be blank</div>');
                $('#password-wrapper-2').addClass('invalid');
            }
        }
    }
}
function update_email() {
    
    const email = $('#email-field').val();

    if(
        email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
    ) {

        load_start();

        var formData = new FormData();

        $('#email-error').html('');
        $('#email-wrapper').removeClass('invalid');

        formData.append('update_email', 'true');
        formData.append('email', email);

        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            setTimeout(function() {
                load_end();

                console.log(response);
                if($.trim(response) == '1') {
                    $('#message-response').html("<div class='success'>Admin email updated!</div></div>");
                } else {
                    $('#message-response').html("<div class='error'>There was an error</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {
        // Email
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error').html('');
            $('#email-wrapper').removeClass('invalid');
        } else {
            if(email) {
                $('#email-error').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper').addClass('invalid');
            } else {
                $('#email-error').html('<div>The Email field is required</div>');
                $('#email-wrapper').addClass('invalid');
            }
        }
    }

}
function update_public_info(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_public_info = $('#update_public_info').val();
    const username = $('#username').val();
    const bio = $('#bio').val();
    const photo = $('input#image')[0].files[0];

    console.log(update_public_info, username, bio, photo);
    
    if(
        update_public_info
    ) {
        formData.append('update_public_info', update_public_info);
        formData.append('username', username);
        formData.append('bio', bio);
        formData.append('photo', photo);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success'>Public information updated!</div>");
            } else {
                $('#message-response-1').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response-1').html("<div class='error'>There was an error</div>");
    }
}
function create_admin(event) {
    event.preventDefault();

    const create_admin = $('#create_admin').val();
    const username = $('#username').val();
    const bio = $('#bio').val();
    const photo = $('input#image')[0].files[0];
    const fname = $('#fname').val();
    // const lname = $('#lname').val();
    const email = $('#email').val();
    const password = $('#password').val();
    const access_level = $('#access_level').val();

    // console.log(create_admin, username, bio, photo, fname, lname, email, password, access_level);
    
    if(
        create_admin
    ) {
        var formData = new FormData();

        formData.append('create_admin', create_admin);
        formData.append('username', username);
        formData.append('bio', bio);
        formData.append('photo', photo);
        formData.append('fname', fname);
        // formData.append('lname', lname);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('access_level', access_level);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success'>New Admin Created!</div>");
            } else {
                $('#message-response-1').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response-1').html("<div class='error'>There was an error</div>");
    }
}
function update_admin(event) {
    event.preventDefault();

    const update_admin = $('#update_admin').val();
    const user_id = $('#user_id').val();
    const username = $('#username').val();
    const bio = $('#bio').val();
    const photo = $('input#image')[0].files[0];
    const fname = $('#fname').val();
    // const lname = $('#lname').val();
    const email = $('#email').val();
    const password = $('#password').val();
    const account_status = $('#account_status').val();
    const access_level = $('#access_level').val();

    // console.log(update_admin, username, bio, photo, fname, lname, email, password, account_status, access_level);
    
    if(
        update_admin
    ) {
        var formData = new FormData();

        formData.append('update_admin', update_admin);
        formData.append('user_id', user_id);
        formData.append('username', username);
        formData.append('bio', bio);
        formData.append('photo', photo);
        formData.append('fname', fname);
        // formData.append('lname', lname);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('account_status', account_status);
        formData.append('access_level', access_level);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success'>Admin Profile Updated!</div>");
            } else {
                $('#message-response-1').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response-1').html("<div class='error'>There was an error</div>");
    }
}