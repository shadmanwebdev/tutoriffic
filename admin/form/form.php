 <?php
 
    $img_str = "<input class='input pdt-img-input' id='image' type='file' name='image[]' value='' style='display: none;' multiple>
    <div style='cursor:pointer; margin-bottom: 5px;' onclick='return fireButton(event);'>
        <i class='fas fa-paperclip'></i>
        <span>Images</span>
        <span id='image-name-1'></span>
    </div>";


    return "
    <form autocomplete='off' id='post_create_form' class='col-md-12 post_create_form' method='POST' enctype='multipart/form-data'>    
        <h4 class='form-title'>New Post</h4>                      
        <input type='hidden' name='create_post' id='create_post' value='true'>
        <div class='mb-3'>
            <label class='form-label' for='title'>Title: </label>
            <input onchange='tab2title()' type='text' title='title' id='title' class='form-control' placeholder='Title'>
            <div class='error' id='titleError'></div>
        </div>
        <div class='mb-3'>
            <label for='price' class='form-label'>Description: </label>
            <textarea class='form-control' name='description' id='description' rows='5'></textarea>
            <div class='error' id='descriptionError'></div>
        </div>
        <div class='mb-3'>
            <label for='price' class='form-label'>Price: </label>
            <input type='text' name='price' id='price' class='form-control' placeholder='Price'>
            <div class='error' id='priceError'></div>
        </div>     

        $img_str

        <div>
            <span style='margin-top: 10px;' onclick='next(event)' type='submit' name='update_event' class='btn btn-primary'>Next</span>
        </div>
    </form>";

?>