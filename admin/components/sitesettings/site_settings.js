function update_site_settings(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_site_settings = $('#update_site_settings').val();
    const sitename = $('#sitename').val();
    const title_tag = $('#title_tag').val();
    const meta_description = $('#meta_description').val();
    const copyright_text = $('#copyright_text').val();
    const contact = $('#contact').val();

    console.log(sitename);

    if(update_site_settings) {
        formData.append('update_site_settings', update_site_settings);
        formData.append('sitename', sitename);
        formData.append('title_tag', title_tag);
        formData.append('meta_description', meta_description);
        formData.append('copyright_text', copyright_text);
        formData.append('contact', contact);
    
        fetch('../controllers/site-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Settings were updated!</div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> An error occured while submitting this form!</div></div>");
    }
}