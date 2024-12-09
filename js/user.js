function login(event) {
     ;

    var formData = new FormData();

    const email = $('#email-field-2').val();
    const password = $('#pwd-field-1').val();

    formData.append('email', email);
    formData.append('password', password);
    formData.append('login', 'true');

    // console.log(email, password);

    if(
        email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
    ) {
        // load_start();

        $('#email-wrapper-2').removeClass('invalid');
        $('#email-error-2').html('');
        $('#pwd-wrapper-1').removeClass('invalid');
        $('#pwd-error-1').html('');

        fetch('./controllers/user-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            setTimeout(function() {
                // load_end();
                console.log(response);

                if($.trim(response) == '1' || $.trim(response) == '7') {
                    window.location.href = './my-account';
                } 
                else {
                    $('#ms-response-1').html("<div class='error'>Invalid email or password</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {
        // Email error
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-2').html('');
            $('#email-wrapper-2').removeClass('invalid');
        } else {
            if(email) {
                $('#email-error-2').html('<div>Invalid email</div>');
                $('#email-wrapper-2').addClass('invalid');
            } else {
                $('#email-error-2').html('<div>Required</div>');
                $('#email-wrapper-2').addClass('invalid');
            }
        }
        // Password error
        if(password) {
            $('#pwd-error-1').html('');
            $('#pwd-wrapper-1').removeClass('invalid');
        } else {
            $('#pwd-error-1').html('<div>Required</div>');
            $('#pwd-wrapper-1').addClass('invalid');
        }
    }
}
function signup(event) {
     ;
    
    var formData = new FormData();

    const fname = $('#fname-field-1').val();
    const lname = $('#lname-field-1').val();
    const email = $('#email-field-3').val();
    const password = $('#pwd-field-2').val();
    const user_account_type_id = $('#user_account_type_id').val();

    // console.log(email, password);

    if(
        fname && lname && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
    ) {
        // load_start();

        $('#fname-wrapper-1').removeClass('invalid');
        $('#fname-error-1').html('');
        $('#lname-wrapper-1').removeClass('invalid');
        $('#lname-error-1').html('');
        $('#email-wrapper-3').removeClass('invalid');
        $('#email-error-3').html('');
        $('#pwd-wrapper-2').removeClass('invalid');
        $('#pwd-error-2').html('');

        formData.append('fname', fname);
        formData.append('lname', lname);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('user_account_type_id', user_account_type_id);
        formData.append('signup', 'true');


        fetch('./controllers/user-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            setTimeout(function() {
                // load_end();
                // console.log(response);

                if($.trim(response) == '1') {
                    window.location.href = './signup-confirmation?code=1&status=success';
                    // $('#message-response').html("<div class='success'>Success!</div>");
                } else if($.trim(response) == '2') {
                    $('#ms-response-2').html("<div class='error'>Email already exists</div>");
                } else {
                    $('#ms-response-2').html("<div class='error'>Error! Please try again</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {
        // First name error
        if(fname) {
            $('#fname-error-1').html('');
            $('#fname-wrapper-1').removeClass('invalid');
        } else {
            $('#fname-error-1').html('<div>Required</div>');
            $('#fname-wrapper-1').addClass('invalid');
        }
        // Last name error
        if(lname) {
            $('#lname-error-1').html('');
            $('#lname-wrapper-1').removeClass('invalid');
        } else {
            $('#lname-error-1').html('<div>Required</div>');
            $('#lname-wrapper-1').addClass('invalid');
        }
        // Email error
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-3').html('');
            $('#email-wrapper-3').removeClass('invalid');
        } else {
            if(email) {
                $('#email-error-3').html('<div>Invalid email address</div>');
                $('#email-wrapper-3').addClass('invalid');
            } else {
                $('#email-error-3').html('<div>Required</div>');
                $('#email-wrapper-3').addClass('invalid');
            }
        }
        // Password error
        if(password) {
            $('#pwd-error-2').html('');
            $('#pwd-wrapper-2').removeClass('invalid');
        } else {
            $('#pwd-error-2').html('<div>Required</div>');
            $('#pwd-wrapper-2').addClass('invalid');
        }
    }
}

function forgot_password(event) {
     ;
    var formData = new FormData();

    const emailValue = $('#email-field-1').val();

    if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        $('#email-wrapper-1').removeClass('invalid');
        $('#email-error-1').html('');

        formData.append('forgot_password', 'true');
        formData.append('email', emailValue);
    
        fetch('./controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            // var alert = document.getElementById('msg-response');

            // if($.trim(response) == '1') {
            //     console.log($.trim(response));
            //     // alert.innerHTML = "<div class='success'>Reset email sent</div>";
            // } else if ($.trim(response) == '2') {
            //     alert.innerHTML = "<div class='error'>This email is not registered</div>";
            // } else {
            //     alert.innerHTML = "<div class='error'>There was an error.</div>";
            // }
        })
        .catch( err => console.log(err));
    } else {
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-1').html('');
            $('#email-wrapper-1').removeClass('invalid');
        } else {
            if(email) {
                $('#email-error-1').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-1').addClass('invalid');
            } else {
                $('#email-error-1').html('<div>The Email field is required</div>');
                $('#email-wrapper-1').addClass('invalid');
            }
        }
    }
}

function verify_login(event) {
     ;
    var formData = new FormData();

    const code = $('#code').val();

    formData.append('code', code);
    formData.append('verify_login', 'true');

    if (code) {
        fetch('./controllers/login-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            setTimeout(function() {
                load_end();
                console.log(response);
                if ($.trim(response) == '1') {
                    window.location.href = './admin/index';
                    // $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New FAQ created!</div></div>");
                } else {
                    $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> Incorrect Code!</div></div>");
                }
            }, 500);
        })
        .catch(err => console.log(err));
    } else {
        $('#code').addClass('invalid');
        $('#codeError').html('<div>Code cannot be blank</div>');
    }
}


function update_password(event) {
     ;
    var formData = new FormData();

    const selector = $('#selector').val();
    const validator = $('#validator').val();
    const new_password = $('#password').val();
    const repeat_password = $('#repeat_password').val();
    
    if(new_password && repeat_password && new_password == repeat_password) {
        load_start();
        
        formData.append('update_password_2', 'true');
        formData.append('selector', selector);
        formData.append('validator', validator);
        formData.append('new_password', new_password);
        formData.append('repeat_password', repeat_password);
    
        fetch('./controllers/user-handler', {
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
                var alert = document.getElementById('msg-response');

                if($.trim(response) == '1') {
                    alert.innerHTML = "<div class='success'>Password updated</div>";
                } else if ($.trim(response) == '2') {
                    alert.innerHTML = "<div class='error'>Passwords don't match</div>";
                } else {
                    alert.innerHTML = "<div class='error'>There was an error.</div>";
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else if (empty(new_password) || empty(repeat_password)) {
        if(empty(new_password)) {
            $('#new_password_error').html("<div>Field cannot be empty</div>");
        }
        if(empty(repeat_password)) {
            $('#repeat_password_error').html("<div>Field cannot be empty</div>");
        }
    } else if (new_password != repeat_password) {
        $('#repeat_password_error').html("<div>Passwords don't match</div>");
    }
}



function email_setup(event) {
     ;
    var formData = new FormData();

    const email_setup = $('#email_setup').val();
    const smtp_host = $('#smtp_host').val();
    const smtp_encryption = $('#smtp_encryption').val();
    const smtp_port = $('#smtp_port').val();
    const username = $('#username').val();
    const password = $('#password').val();
    
    if(
        email_setup
    ) {
        formData.append('email_setup', email_setup);
        formData.append('smtp_host', smtp_host);
        formData.append('smtp_encryption', smtp_encryption);
        formData.append('smtp_port', smtp_port);
        formData.append('username', username);
        formData.append('password', password);


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
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> SMTP details updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        // console.log(email_setup, smtp_host, smtp_encryption, smtp_port, username, password);
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
    }
}
function update_user() {
    var formData = new FormData();

    // const photo = $('input#image')[0].files[0];
    const name = $('#name-field').val();
    const email = $('#email-field').val();
    const password = $('#password-field').val();
    const password_repeat = $('#password-field-2').val();
    
    if(
        name && email && (password && password_repeat && password == password_repeat) || (!password && !password_repeat)
    ) {

        var errElement = document.getElementById('err');
            
        const input = document.getElementById('image');
        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            const file = input.files[0];
            const reader = new FileReader();
        
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;
        
                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 500; // Change this to your desired width
                    const maxHeight = 500; // Change this to your desired height
        
                    let newWidth = img.width;
                    let newHeight = img.height;
        
                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }
        
                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }
        
                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);
        
                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {
                        // Append the resized image blob to the original formData object
                        formData.append('i', blob, 'resized_image.webp');

                        load_start();

                        formData.append('update_user', 'true');
                        formData.append('name', name);
                        formData.append('email', email);
                        if(password) {
                            formData.append('pwd', password);
                        }
                        formData.append('photo', photo);

                        fetch('./controllers/user-handler', {
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
                                    $('#message-response').html("<div class='success'>Profile information updated!</div></div>");
                                } else {
                                    $('#message-response').html("<div class='error'>There was an error</div>");
                                }
                            }, 500);
                        })
                        .catch( err => console.log(err));
                    }, 'image/jpeg', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };
    
            reader.readAsDataURL(file);
            
        } else {
            load_start();

            $('#name-error').html('');
            $('#name-wrapper').removeClass('invalid');
            $('#email-error').html('');
            $('#email-wrapper').removeClass('invalid');
    

            formData.append('update_user', 'true');
            formData.append('name', name);
            formData.append('email', email);
            if(password) {
                formData.append('pwd', password);
            }
    
            fetch('./controllers/user-handler', {
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
                        $('#message-response').html("<div class='success'>Profile updated!</div></div>");
                    } else {
                        $('#message-response').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        }
    }
    else {
        $('#message-response').html("<div class='error'>There was an error</div>");
    }
}
function update_profile_details() {
    var formData = new FormData();

    // const photo = $('input#image')[0].files[0];
    const name = $('#name-field').val();
    const email = $('#email-field').val();

    

    if(
        name && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
    ) {

        const input =  $('input#image')[0];
        var errElement = document.getElementById('err');

        const file =  $('input#image')[0].files[0];
        const reader = new FileReader();
        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 500; // Change this to your desired width
                    const maxHeight = 500; // Change this to your desired height

                    let newWidth = img.width;
                    let newHeight = img.height;

                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }

                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }

                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {
                        // Append the resized image blob to the original formData object
                        formData.append('photo', blob, 'resized_image.webp');

                        load_start();

                        $('#name-error').html('');
                        $('#name-wrapper').removeClass('invalid');
                        $('#email-error').html('');
                        $('#email-wrapper').removeClass('invalid');
                
                        formData.append('update_user', 'true');
                        formData.append('name', name);
                        formData.append('email', email);
                        // formData.append('photo', photo);
                
                        fetch('./controllers/user-handler', {
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
                                    $('#message-response').html("<div class='success'>Profile updated!</div></div>");
                                } else {
                                    $('#message-response').html("<div class='error'>There was an error</div>");
                                }
                            }, 500);
                        })
                        .catch( err => console.log(err));

                    }, 'image/jpeg', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };

            reader.readAsDataURL(file);
        } else {
            load_start();

            $('#name-error').html('');
            $('#name-wrapper').removeClass('invalid');
            $('#email-error').html('');
            $('#email-wrapper').removeClass('invalid');
    
            formData.append('update_user', 'true');
            formData.append('name', name);
            formData.append('email', email);
    
            fetch('./controllers/user-handler', {
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
                        $('#message-response').html("<div class='success'>Profile updated!</div></div>");
                    } else {
                        $('#message-response').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        }
    } else {
        // Name
        if(name) {
            $('#name-error').html('');
            $('#name-wrapper').removeClass('invalid');
        } else {
            $('#name-error').html('<div>Field cannot be blank</div>');
            $('#name-wrapper').addClass('invalid');
        }
        // Email
        // Email error
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

        fetch('./controllers/user-handler', {
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
        $('#message-response').html("<div class='error'>There was an error</div>");
    }
}