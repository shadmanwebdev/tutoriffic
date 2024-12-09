<?php
    include './header.php';
    // require 'vendor/autoload.php'; .flex-row .flex-column:nth-child(2)
?>

<style>
    .admin-form-outer {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .admin-form-wrapper {
        margin: 50px 20px;
        width: 95%;
        max-width: 900px;
        min-width: 320px;
    }
    .admin-form-wrapper form {
        width: 100%;
    }
    .form-title {
        font-weight: bold;
         
        margin-bottom: 30px;
        font-size: 23px;
    }
    label {
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    
    .card {
        display: none;
        margin: 0px auto !important;
    }
    .card.active  {
        display: block;
        background-color: transparent!important;
        box-shadow: none;
    }
</style>



<div class='wrapper'>

    <?php
        include './sidebar.php';
    ?>

    <div class='main'>
        <?php
            include './topbar.php';
        ?>
        <div class='admin-form-outer'>
            <div class='admin-form-wrapper'>










<?php

    function createForm() {
        return "
        <form autocomplete='off' id='product_create_form' class='col-md-12 product_create_form' method='POST' enctype='multipart/form-data'>    
            <h4 class='form-title'>New Merch</h4>                      
            <input type='hidden' name='create_product' id='create_product' value='true'>
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
            <div>
                <span style='margin-top: 10px;' onclick='next(event)' type='submit' name='update_event' class='btn btn-primary'>Next</span>
            </div>
        </form>";
    }
    function createForm2() {

        echo "
        <div class='col-md-12 col-lg-12'>
            <input type='hidden' name='colors' id='colors' value='' />
            <input type='hidden' name='sizes' id='sizes' value='' />
            <div class='row'> 
                <div class='col-md-12 mb-3' style='display: flex; width: 100%;'>
                    <h2 id='tab2title'>Title</h2>
                </div>
                <div class='col-md-12'>    
                    <div class='variants'>    
                        


                        <div class='variant-input-group'>
                            <div class='flex-row'>

                                <div class='flex-column'>
                                    <div class='variant-input-label'>
                                        <div scope='col'>Name</div>
                                    </div>
                                    <div class='variant-input-field'>
                                        <input class='form-control' type='text' name='adon_name' id='adon_name'>
                                    </div>
                                </div>

                                <div class='flex-column'>
                                    <div class='variant-input-label'>
                                        <div scope='col'>Description</div>
                                    </div>
                                    <div class='variant-input-field'>
                                        <textarea class='form-control' type='text' name='adon_description' id='adon_description'></textarea>
                                    </div>
                                </div>

                                <div class='flex-column'>
                                    <div class='variant-input-label'>
                                        <div scope='col'>Price</div>
                                    </div>
                                    <div class='variant-input-field'>
                                        <input class='form-control' type='number' name='adon_description' id='adon_description'>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div style='display: flex; flow-flow: row nowrap; justify-content: space-between;'>
                <div>
                    <span style='margin-top: 10px;' onclick='addRow()' name='add_row' class='btn btn-secondary'>Add Row</span>  
                    <span style='margin-top: 10px;' onclick='removeLastRow()' name='remove_row' class='btn btn-danger'>Remove</span>  
                </div>
                <div>
                    <span style='margin-top: 10px;' onclick='return goBack()' type='submit' name='back' class='btn btn-secondary'>Back</span>  
                    <span style='margin-top: 10px;' onclick='return create_product(event)' type='submit' name='update_event' class='btn btn-primary'>Submit</span>  
                
                </div>
            </div>
            <div id='message-response'></div>
        </div>";
    }

?>



<style>
    .variant-image-wrapper {
        width: 150px;
        height: auto;
        margin-right: 20px;
        object-fit: cover;
        object-fit: cover;
        margin-top: 15px;
        display: flex;
        justify-content: center;
    }
    .variant-image-wrapper img {
        width: 100%; 
        height: 100%;
    }

    @media (max-width: 767px) {
        .flex-column {
            min-width: 100%;
        }
    }
</style>

<style>
    .message {
        position: relative;
        display: block;
        height: 50px;
        line-height: 50px;
        cursor: default;
        transition-duration: 0.3s;
    }
    a {
        text-decoration: none;
        transition: all 0.4s ease-in-out;
        color: #76838f;
    }
    a:hover {   
        color: #7571f9;
        text-decoration: none;
    }
    .message .col-mail {
        display: flex;
        flex-flow: row nowrap;
    }
    .message .col-mail-2 .subject {
        overflow: hidden;
        white-space: nowrap;
    }
    .message .col-mail-2 .date {
        width: 170px;
        /* padding-left: 80px; */
    }
    a.del-link {
        text-decoration: none;
        transition: all 0.4s ease-in-out;
        color: #d80000;
    }

    .btn.btn-secondary {
        color: #fff !important;
        background-color: #6c757d !important;
        border-color: #6c757d !important;
        cursor: pointer;
    }
    .btn-danger {
        color: #fff !important;
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    .info-btns-wrapper {
        display: flex;
        flex-flow: row nowrap;
        align-items: center; 
    }
    .info-btns-wrapper div:nth-child(1) {
        margin-right: 10px; 
    }
    .remove-info {
        display: flex;
        align-items: center; 
        justify-content: center;
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
        width: 30px; 
        height: 30px; 
        border-radius: 50%; 
        font-weight: bold; 
        font-size: 25px;
    }
</style>


<style>
    img {
        max-width: 100px;
        max-height: 100px;
    }
    .variants {
        width: 100%;
        margin-bottom: 1rem;
        color: #4a4e69;
        width: 100%;
    }
    .variant-input-group {
        border: 1px solid #dee2e6;
        margin-bottom: 1rem;
    }
    .size-qty-wrapper {
        width: 100%;
        display: flex; 
        flex-flow: row nowrap; 
        margin-bottom: 10px;
    }
    .variant-input-label {
        display: flex;
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        padding: 0.75rem;
        vertical-align: top;
        border-left: 1px solid #eeeef1;
        border-right: 1px solid #eeeef1;
        border-top: 1px solid #eeeef1;
        font-weight: bold;
    }
    .flex-row {
        display: flex;
        flex-flow: column nowrap;
        background: #fff;
    }
    .flex-column {
        width: 100%;
    }
    .flex-row .flex-column:first-child {
        width: 100%;
        border-right: 1px solid #eeeef1;
    }
    .flex-row .flex-column:nth-child(2) {
        width: 100%;
    }
    .flex-row .flex-column:nth-child(3) {
        width: 100%;
    }
    .variant-input-field {
        padding: 0.75rem;
    }
    .variant-input-field.input-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        column-gap: 20px;
    }
    @media (max-width: 767px) {
        .flex-row {
            display: flex;
            flex-flow: column nowrap !important;
        }
        .flex-row .flex-column:first-child {
            margin-bottom: 10px;
        }
        .variant-input-field.input-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>


<style>
    .subcat-selector {
        display: none;
    }
    .subcat-selector.show-subcat-selector {
        display: block;
    }
</style>





        <div class='py-4 px-3 px-md-4 card active' id='card-1'>
            <div class='row'>

                <?php
                    // $product = new Product();
                    // echo $product->createForm();
                    echo createForm();

                ?>

            </div>
        </div>

        <div class='py-4 px-3 px-md-4 card' id='card-2'>



            <?php
                // $product = new Product();
                // echo $product->createForm2();
                echo createForm2();
            ?>



        </div>










            </div>
        </div>
    </div>



</div>







<!-- Prev / Next -->
<script defer>
    function next(event) {
         ;
        var create_product = $('#create_product').val();
        var title = $('#title').val();
        var price = $('#price').val();
        if(
            create_product && title && price
        ) {
            $('#card-1').removeClass('active');
            $('#card-2').addClass('active');
        } else {
            // Title
            if(title) {
                $('#titleError').html('');
                $('#title').removeClass('invalid');
            } else {
                $('#titleError').html('<div>Title cannot be blank</div>');
                $('#title').addClass('invalid');
            }
            // Price
            if(price) {
                $('#priceError').html('');
                $('#price').removeClass('invalid');
            } else {
                $('#priceError').html('<div>Price cannot be blank</div>');
                $('#price').addClass('invalid');
            }
        }
    }

    function goBack() {
        $('#card-2').removeClass('active');
        $('#card-1').addClass('active');
    }
</script>



<!-- Add New Row -->
<script>
    function addRow() {
        try {
            var variantsContainer = document.querySelector('.variants');

            // New Group
            var variantInputGroup = document.createElement('div');
            variantInputGroup.className = 'variant-input-group';

            // Single Row
            var variantRow = document.createElement('div');
            variantRow.className = 'flex-row';

            // Column 1
            var col1 = document.createElement('div');
            col1.className = 'flex-column';

            // Input Label
            var inpLabel = document.createElement('div');
            inpLabel.className = 'variant-input-label';
            inpLabel.textContent = 'Title';

            var inpWrapper = document.createElement('div');
            inpWrapper.className = 'variant-input-field';
            var inputElem = document.createElement('input');
            inputElem.type = 'text';
            inputElem.name = 'adon_name';
            inputElem.className = 'form-control adon_name';
            inpWrapper.appendChild(inputElem);
            col1.appendChild(inpLabel);
            col1.appendChild(inpWrapper);
            variantRow.appendChild(col1);

            
            // Column 2
            var col2 = document.createElement('div');
            col2.className = 'flex-column';

            // Input Label
            var inpLabel2 = document.createElement('div');
            inpLabel2.className = 'variant-input-label';
            inpLabel2.textContent = 'Description';

            var textWrapper = document.createElement('div');
            textWrapper.className = 'variant-input-field';
            var textElem = document.createElement('textarea');
            textElem.name = 'adon_description';
            textElem.className = 'form-control adon_description';
            textWrapper.appendChild(textElem);
            col2.appendChild(inpLabel2);
            col2.appendChild(textWrapper);
            variantRow.appendChild(col2);



            // Column 3
            var col3 = document.createElement('div');
            col3.className = 'flex-column';

            // Input Label
            var inpLabel3 = document.createElement('div');
            inpLabel3.className = 'variant-input-label';
            inpLabel3.textContent = 'Price';

            var inpWrapper2 = document.createElement('div');
            inpWrapper2.className = 'variant-input-field';
            var inputElem2 = document.createElement('input');
            inputElem2.type = 'number';
            inputElem2.name = 'price';
            inputElem2.className = 'form-control price';
            inpWrapper2.appendChild(inputElem2);
            col3.appendChild(inpLabel3);
            col3.appendChild(inpWrapper2);
            variantRow.appendChild(col3);

            


            // Append Row
            variantInputGroup.appendChild(variantRow);
            // Append Group
            variantsContainer.appendChild(variantInputGroup);
        } catch (error) {
            // Code to handle the error
            console.log('An error occurred:', error);
        }
    }
    function removeLastRow() {
        var variantsContainer = document.querySelector('.variants');
        var variantInputGroups = variantsContainer.querySelectorAll('.variant-input-group');
        
        // Check if there is more than one row
        if (variantInputGroups.length > 1) {
            var variantInputGroup = variantInputGroups[variantInputGroups.length - 1];
            variantsContainer.removeChild(variantInputGroup);
        }
    }
    function createTableCell(element) {
        var cell = document.createElement('td');
        cell.appendChild(element);
        return cell;
    }
</script>


<!-- Create -->
<script defer>
    function create_product(event) {
         ;

        var create_product = $('#create_product').val();
        var title = $('#title').val();
        var description = $('#description').val();
        var price = $('#price').val();

        load_start();

        if(
            create_product && title && price
        ) {
            $('#titleError').html('');
            $('#descriptionError').html('');
            $('#priceError').html('');
        

            // Create a new FormData object
            var formData = new FormData();

            formData.append('create_product', create_product);
            formData.append('title', title);
            formData.append('description', description);
            formData.append('price', price);

            // Variants
            var variantGroups = document.querySelectorAll('.variant-input-group');

            var list = [];
            for (var i = 0; i < variantGroups.length; i++) {
                var variantGroup = variantGroups[i];
                var input1 = variantGroup.querySelector('.variant-input-field input.adon_name');
                var input2 = variantGroup.querySelector('.variant-input-field textarea.adon_description');
                var input3 = variantGroup.querySelector('.variant-input-field input.price');
                

                var inner_list = {
                    'name': input1.value,
                    'description': input2.value,
                    'price': input3.value
                }

                list.push(inner_list);
            }

            var listJson = json.stringify(list);

            formData.append('variants', listJson);
            
            fetch('../controllers/product-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    // error processing
                    throw new Error("HTTP status " + response.status);
                }
                return response.text(); 
            })
            .then(response => { 
                setTimeout(function() {
                    load_end();

                    if($.trim(response) == '1') {
                        $('#message-response-1').html("<div class='success'>New product added!</div>");
                    } else {
                        $('#message-response-1').html("<div class='error'>There was an error</div>");
                    }

                }, 1000);
            });
        } else {
            // Title
            if(title) {
                $('#titleError').html('');
                $('#title').removeClass('invalid');
            } else {
                $('#titleError').html('<div>Title cannot be blank</div>');
                $('#title').addClass('invalid');
            }
            // Price
            if(price) {
                $('#priceError').html('');
                $('#price').removeClass('invalid');
            } else {
                $('#priceError').html('<div>Price cannot be blank</div>');
                $('#price').addClass('invalid');
            }
            // Category
            if(category) {
                $('#categoryError').html('');
                $('#category').removeClass('invalid');
            } else {
                $('#categoryError').html('<div>Category cannot be blank</div>');
                $('#category').addClass('invalid');
            }
            // Subcategory
            if(subcategory) {
                $('#subcategoryError').html('');
                $('#subcategory').removeClass('invalid');
            } else {
                $('#subcategoryError').html('<div>Subcategory cannot be blank</div>');
                $('#subcategory').addClass('invalid');
            }
        }
    }
    function tab2title() {
        var inputValue = document.getElementById('title').value;
        document.getElementById('tab2title').textContent = inputValue;
    }
</script>







<?php
    include './footer.php';
?>
