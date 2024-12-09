<?php
    include './partials/header.php';
?>

<?php include './partials/nav-2.php'; ?>


<link rel="stylesheet" href="css/profile-picture.css">
    

<form id='my-listing-form'>
    <input type="hidden" name="create_ad" id="create_ad" value='true'>
    <div id="my-listing">

        <!-- Step 1 -->
        <div class="inner-div step current-step" id='step-1'>
            <!-- <div class='step-header'>
                <h2 class='text-center'>Profile Picture</h2>
            </div> -->
            <?php
                $user->profile_photo_form_2();
            ?>
        </div>

    </div>
</form>

 


<script src="js/image-processing.js" defer></script>

<script defer>
    $('.image-input-3').on('change', function() {
        console.log(this);
        validateImage(this);

        const input =  $('input.image-input-3')[0];
        var errElement = document.querySelector('.err');

        const file =  $('input.image-input-3')[0].files[0];
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


                        var formData = new FormData();
                        // Append the resized image blob to the original formData object
                        formData.append('upload_profile_photo', 'true');
                        formData.append('photo', blob, 'resized_image.webp');


                        fetch('./controllers/user-handler', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            return response.text();
                        })
                        .then(response => {
                            console.log(response);
                            if(response == '1') {
                                $('#message-response-4').html("<div class='success'>Updated!</div>");
                            } else {
                                $('#message-response-4').html("<div class='error'>Error!</div>");
                            }
                        })
                        .catch(err => console.log(err));

                    }, 'image/webp', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };

            reader.readAsDataURL(file);
        }
    });
</script>


</body>
</html>