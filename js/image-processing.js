// Click
function fireButton(event, input) {
     ;
    input.nextElementSibling.click();
}

// Preview Profile Photo
function readURL(input) {
    // .closest() method finds the closest ancestor element that matches a given selector
    var imgPreviewWrapper = $(input).closest('.img-preview-wrapper');

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // .find() method to search for a descendant element based on a selector within the selected element
            imgPreviewWrapper.find('.img-preview').attr('src', e.target.result);
            imgPreviewWrapper.find('.profile-placeholder').css({"display":"none"});
            imgPreviewWrapper.find('.selected-img').css({"display":"block"});
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Reusable function for image validation
function validateImage(inputElement) {
    var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];

    var imgPreviewWrapper = $(inputElement).closest('.img-preview-wrapper');

    var imgErrorElement = imgPreviewWrapper.find('.img-error');
    var errElement = imgPreviewWrapper.find('.err');

    if (inputElement.files.length === 0) {
        imgErrorElement.html('');
        errElement.removeClass('s');
        return;
    }

    var file = inputElement.files[0];
    var imgType = file.name.split('.').pop(); // Get the file extension
    var imgSize = file.size; // Get the file size in bytes

    if (!allowed.includes(imgType)) {
        errElement.addClass('s');
        imgErrorElement.html('<div class="error">Incorrect File Type</div>');
    } else if (imgSize > 1500000) { // 1.5MB in bytes
        errElement.addClass('s');
        imgErrorElement.html('<div class="error">Image is too large (max 1.5MB)</div>');
    } else {
        errElement.removeClass('s');
        imgErrorElement.html('');
        readURL(inputElement); // Assuming readURL is a function to handle image preview
    }
}

// Attach the event listener to all image input elements
// $('.image-input').on('change', function() {
//     console.log(this);
//     validateImage(this);
// });

