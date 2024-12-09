
function reply(event) {
    event.preventDefault();

    const email = $('#email').val();
    const reply = $('#reply').val();

    console.log(email, reply);

    if(email && reply) {
        $('#replyError').html('');
        var formData = new FormData();

        formData.append('send_reply', 'true');
        formData.append('email', email);
        formData.append('reply', reply);

        fetch('../controllers/message-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();   
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response').html("<div class='success'>Reply sent!</div>");
            } else {
                $('#message-response').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        if(reply) {
            $('#replyError').html('');
        } else {
            $('#replyError').html('<div>Field cannot be blank</div>');
        }
    }
}