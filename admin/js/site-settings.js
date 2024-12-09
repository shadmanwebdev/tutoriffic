function update_site_settings(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_site_settings = $('#update_site_settings').val();
    const sitename = $('#sitename').val();
    const title_tag = $('#title_tag').val();
    const meta_description = $('#meta_description').val();
    const copyright_text = $('#copyright_text').val();
    const contact = $('#contact').val();

    if(update_site_settings && sitename && title_tag && meta_description && copyright_text && contact) {
        
        load_start();
        
        $('#sitename-error').html('');
        $('#title-tag-error').html('');
        $('#meta-description-error').html('');
        $('#copyright-text-error').html('');
        $('#contact-error').html('');

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
            
            setTimeout(function() {
                load_end();
                if($.trim(response) == '1') {
                    $('#message-response-1').html("<div class='success'>Settings were updated!</div>");
                } else {
                    $('#message-response-1').html("<div class='error'>An error occured while submitting this form!</div></div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {
        // Site name
        if(sitename) {
            $('#sitename-error').html('');
            $('#sitename-wrapper').removeClass('invalid');
        } else {
            $('#sitename-error').html('<div>Field cannot be blank</div>');
            $('#sitename-wrapper').addClass('invalid');
        }
        // Title tag
        if(title_tag) {
            $('#title-tag-error').html('');
            $('#title-tag-wrapper').removeClass('invalid');
        } else {
            $('#title-tag-error').html('<div>Field cannot be blank</div>');
            $('#title-tag-wrapper').addClass('invalid');
        }
        // Meta Description
        if(meta_description) {
            $('#meta-description-error').html('');
            $('#meta-description-wrapper').removeClass('invalid');
        } else {
            $('#meta-description-error').html('<div>Field cannot be blank</div>');
            $('#meta-description-wrapper').addClass('invalid');
        }
        // Copyright Text
        if(copyright_text) {
            $('#copyright-text-error').html('');
            $('#copyright-text-wrapper').removeClass('invalid');
        } else {
            $('#copyright-text-error').html('<div>Field cannot be blank</div>');
            $('#copyright-text-wrapper').addClass('invalid');
        }
        // Contact Email
        if(contact) {
            $('#contact-error').html('');
            $('#contact-wrapper').removeClass('invalid');
        } else {
            $('#contact-error').html('<div>Field cannot be blank</div>');
            $('#contact-wrapper').addClass('invalid');
        }
    }
}