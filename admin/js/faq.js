function create_faq(event) {
    event.preventDefault();
    var formData = new FormData();

    const create_faq = $('#create_faq').val();
    const question = $('#question').val();
    const answer = $('#answer').val();

    if(question && answer) {
        formData.append('create_faq', create_faq);
        formData.append('question', question);
        formData.append('answer', answer);
    
        fetch('../controllers/faq-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success'>New FAQ Created!</div>");
            } else {
                $('#message-response-1').html("<div class='error'>There was an error!</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response-1').html("<div class='error'>There was an error!</div>");
    }
}
function update_faq(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_faq = $('#update_faq').val();
    const faq_id = $('#faq_id').val();
    const question = $('#question').val();
    const answer = $('#answer').val();

    if(question && answer && faq_id) {
        formData.append('update_faq', update_faq);
        formData.append('faq_id', faq_id);
        formData.append('question', question);
        formData.append('answer', answer);
    
        fetch('../controllers/faq-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success'>New FAQ Created!</div>");
            } else {
                $('#message-response-1').html("<div class='error'>There was an error!</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response-1').html("<div class='error'>There was an error!</div>");
    }
}