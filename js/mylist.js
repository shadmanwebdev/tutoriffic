function add_to_list(id) {
    var formData = new FormData();
    if (id) {
        formData.append('ad_id', id);
        formData.append('bookmark', 'true');

        fetch('./controllers/mylist-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            // console.log(response);
            if ($.trim(response) == '1') {
                $('.icon-filled-' + id).css({ 'display': 'block' });
                $('.icon-'+id).css({ 'display': 'none' });
            } else {
                console.log(response);
                $('.icon-filled-'+id).css({ 'display': 'none' });
                $('.icon-'+id).css({ 'display': 'block' });
            }
        })
        .catch(err => console.log(err));
    } else {
        $('#code').addClass('invalid');
        $('#codeError').html('<div>Code cannot be blank</div>');
    }
}