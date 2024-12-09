/*
    Add a new row to the form by creating row and columns 
    and appending to the wrapping element

    Modify this as required for the individual form
*/
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
        inpLabel.textContent = 'Name';

        // Input Error
        var inpError = document.createElement('div');
        inpError.className = 'error';

        var inpWrapper = document.createElement('div');
        inpWrapper.className = 'variant-input-field';
        var inputElem = document.createElement('input');
        inputElem.type = 'text';
        inputElem.name = 'adon_name';
        inputElem.className = 'form-control adon_name';
        inpWrapper.appendChild(inputElem);

        col1.appendChild(inpLabel);
        col1.appendChild(inpWrapper);
        col1.appendChild(inpError);
        variantRow.appendChild(col1);

        
        // Column 2
        var col2 = document.createElement('div');
        col2.className = 'flex-column';

        // Input Label
        var inpLabel2 = document.createElement('div');
        inpLabel2.className = 'variant-input-label';
        inpLabel2.textContent = 'Description';

        // Input Error
        var inpError2 = document.createElement('div');
        inpError2.className = 'error';

        var textWrapper = document.createElement('div');
        textWrapper.className = 'variant-input-field';
        var textElem = document.createElement('textarea');
        textElem.name = 'adon_description';
        textElem.className = 'form-control adon_description';
        textWrapper.appendChild(textElem);
        col2.appendChild(inpLabel2);
        col2.appendChild(textWrapper);
        col2.appendChild(inpError2);
        variantRow.appendChild(col2);



        // Column 3
        var col3 = document.createElement('div');
        col3.className = 'flex-column';

        // Input Label
        var inpLabel3 = document.createElement('div');
        inpLabel3.className = 'variant-input-label';
        inpLabel3.textContent = 'Price';

        // Input Error
        var inpError3 = document.createElement('div');
        inpError3.className = 'error';

        var inpWrapper2 = document.createElement('div');
        inpWrapper2.className = 'variant-input-field';
        var inputElem2 = document.createElement('input');
        inputElem2.type = 'number';
        inputElem2.name = 'price';
        inputElem2.className = 'form-control adon_price';
        inpWrapper2.appendChild(inputElem2);
        col3.appendChild(inpLabel3);
        col3.appendChild(inpWrapper2);
        col3.appendChild(inpError3);
        variantRow.appendChild(col3);

        // Columns

        // Image Column
        // var imageColumn = document.createElement('div');
        // imageColumn.className = 'flex-column';

        // var imageLabel = document.createElement('div');
        // imageLabel.className = 'variant-input-label';
        // imageLabel.textContent = 'Image';

        // var imageField = document.createElement('div');
        // imageField.className = 'variant-input-field';
        // var imageInput = document.createElement('input');
        // imageInput.className = 'form-control';
        // imageInput.type = 'file';
        // imageInput.name = 'image';
        // imageField.appendChild(imageInput);

        // imageColumn.appendChild(imageLabel);
        // imageColumn.appendChild(imageField);
        // variantRow.appendChild(imageColumn);

        // Select Column
        // var colorColumn = document.createElement('div');
        // colorColumn.className = 'flex-column';

        // var colorLabel = document.createElement('div');
        // colorLabel.className = 'variant-input-label';
        // colorLabel.textContent = 'Color';

        // var colorField = document.createElement('div');
        // colorField.className = 'variant-input-field';
        // var colorSelect = document.createElement('select');
        // colorSelect.className = 'form-control color';
        // colorSelect.name = 'color';
        // var colorsInput = document.getElementById('colors');
        // var colorsData = JSON.parse(colorsInput.value);
        // var selectedColors = Array.from(document.querySelectorAll('.color option:checked')).map(option => option.value);
        // var selectColorOption = document.createElement('option');
        // selectColorOption.value = '';
        // selectColorOption.text = 'Select Color';
        // selectColorOption.hidden = true;
        // colorSelect.appendChild(selectColorOption);
        // colorsData.forEach(function(color) {
        //     if (!selectedColors.includes(color.id)) {
        //         var option = document.createElement('option');
        //         option.value = color.id;
        //         option.text = color.name;
        //         colorSelect.appendChild(option);
        //     }
        // });
        // colorField.appendChild(colorSelect);

        // colorColumn.appendChild(colorLabel);
        // colorColumn.appendChild(colorField);
        // variantRow.appendChild(colorColumn);


        // Multiple Checkbox and Quantity
        // var sizeQtyColumn = document.createElement('div');
        // sizeQtyColumn.className = 'flex-column';

        // var sizeQtyLabel = document.createElement('div');
        // sizeQtyLabel.className = 'variant-input-label';
        // sizeQtyLabel.textContent = 'Size and Quantity';

        // var sizeQtyField = document.createElement('div');
        // sizeQtyField.className = 'variant-input-field input-grid';

        // var sizesInput = document.getElementById('sizes');
        // var sizesData = JSON.parse(sizesInput.value);
        // var selectedSizes = Array.from(document.querySelectorAll('.size-qty-wrapper input[type="checkbox"]:checked')).map(checkbox => checkbox.value);

        // sizesData.forEach(function(size) {
        //     // if (!selectedSizes.includes(size.id)) {
        //         var sizeQtyWrapper = document.createElement('div');
        //         sizeQtyWrapper.className = 'size-qty-wrapper';

        //         var sizeCheckboxDiv = document.createElement('div');
        //         sizeCheckboxDiv.style = 'display: flex; flex-flow: row nowrap; align-items: center; margin-right: 10px;';

        //         var sizeCheckbox = document.createElement('input');
        //         sizeCheckbox.style = 'margin-right: 5px;';
        //         sizeCheckbox.classList.add('checkbox');
        //         sizeCheckbox.type = 'checkbox';
        //         sizeCheckbox.name = 'size[]';
        //         sizeCheckbox.value = size.id;

        //         var sizeLabel = document.createElement('span');
        //         sizeLabel.textContent = size.name;

        //         var quantityInput = document.createElement('input');
        //         quantityInput.classList.add('form-control');
        //         quantityInput.type = 'number';
        //         quantityInput.name = 'quantity[]';

        //         sizeCheckboxDiv.appendChild(sizeCheckbox);
        //         sizeCheckboxDiv.appendChild(sizeLabel);
        //         sizeQtyWrapper.appendChild(sizeCheckboxDiv);
        //         sizeQtyWrapper.appendChild(quantityInput);
        //         sizeQtyField.appendChild(sizeQtyWrapper);
        //     // }
        // });

        // sizeQtyColumn.appendChild(sizeQtyLabel);
        // sizeQtyColumn.appendChild(sizeQtyField);
        // variantRow.appendChild(sizeQtyColumn);


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



