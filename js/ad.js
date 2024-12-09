function get_subject_popup_edit_ad(subject_data_json) {
    const formData = new FormData();

    console.log(subject_data_json);
    const subjectOptionsTemp = sessionStorage.getItem('subjectOptions');

    console.log(subjectOptionsTemp);

    formData.append('subject_data_json', JSON.stringify(subject_data_json));
    formData.append('subject_options_temp', subjectOptionsTemp);

    fetch('./subject-options-popup-edit-ad.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        setTimeout(function() {
            console.log(response);
            $('#ad-subject-popup-wrapper').html(response);
            popup('ad-subject-popup');
        }, 500);
    })
    .catch( err => console.log(err));

}


function save_subject_options_edit_ad() {
    // Clear the session storage (optional, based on your use case)
    // sessionStorage.clear();

    // Capture the values of the checkboxes and input fields
    const edexcelChecked = document.getElementById('custom-checkbox-201').checked;
    const aqaChecked = document.getElementById('custom-checkbox-202').checked;
    const ocrChecked = document.getElementById('custom-checkbox-203').checked;
    const gcseChecked = document.getElementById('custom-checkbox-301').checked;
    const alevelChecked = document.getElementById('custom-checkbox-302').checked;
    const price = document.getElementById('price').value;

    // Get the JSON data from the hidden input and parse it
    const subjectDataJson = document.getElementById('subject_data_json').value;
    const subjectData = JSON.parse(subjectDataJson);

    // Create an object with form data and JSON data fields
    const formData = {
        subj_id: subjectData.subj_id,
        subject_name: subjectData.subject_name,
        previously_selected: subjectData.previously_selected,
        boards: {
            edexcel: edexcelChecked ? 'yes' : 'no',
            aqa: aqaChecked ? 'yes' : 'no',
            ocr: ocrChecked ? 'yes' : 'no'
        },
        levels: {
            gcse: gcseChecked ? 'yes' : 'no',
            alevel: alevelChecked ? 'yes' : 'no'
        },
        price: price,
        ad_subject_details: subjectData.ad_subject_details
    };

    // Retrieve existing data from sessionStorage or initialize an empty array
    let existingData = JSON.parse(sessionStorage.getItem('subjectOptions')) || [];

    // Check if an item with the same subj_id already exists and remove it
    existingData = existingData.filter(item => item.subj_id !== formData.subj_id);

    // Validate that at least one level, one board, and a price is selected
    const hasSelectedBoard = edexcelChecked || aqaChecked || ocrChecked;
    const hasSelectedLevel = gcseChecked || alevelChecked;
    const isPriceValid = price.trim() !== '';

    // Find the checkbox to uncheck
    const checkboxToUncheck = document.querySelector(`input[data-subject-id="${formData.subj_id}"]`);

    // If validation fails
    if (!hasSelectedBoard || !hasSelectedLevel || !isPriceValid) {
        // Optionally show an alert
        // alert('Please select at least one board, one level, and enter a price.');

        // Uncheck the checkbox with the same data-subject-id as the subj_id
        if (checkboxToUncheck) {
            checkboxToUncheck.checked = false; // Uncheck the checkbox
        }

        // Remove the item with the matching subj_id from the session storage (if it exists)
        existingData = existingData.filter(item => item.subj_id !== formData.subj_id);
        sessionStorage.setItem('subjectOptions', JSON.stringify(existingData));

        closePopup();
        return;
    } else {
        // Ensure the checkbox is checked
        if (checkboxToUncheck) {
            checkboxToUncheck.checked = true; // Check the checkbox
        }
    }

    // Add the new formData to the existing data
    existingData.push(formData);

    console.log(existingData); // Log the updated array for debugging

    // Save the updated array back to sessionStorage
    sessionStorage.setItem('subjectOptions', JSON.stringify(existingData));


    var formData2 = new FormData();

    formData2.append('update_ad_subjects', 'true');
    formData2.append('subject_options', JSON.stringify(existingData));

    $('ad-title-error').html('');

    fetch('./controllers/ad-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.text()      
    })
    .then(response => {
        setTimeout(function() {
            // load_end();
            console.log(response);
            
            if($.trim(response) == '1') {
                $('#message-response-4').html("<div class='success'>Updated!</div>");
            } else {
                $('#message-response-4').html("<div class='error'>There was an error</div>");
            }
        }, 500);
    })
    .catch( err => console.log(err));


    closePopup();
    return;
}


function toggleCheckbox(event, checkboxId) {
    // Prevent the default checkbox toggle behavior
    event.preventDefault();

    // Get the checkbox element
    const checkbox = document.getElementById(checkboxId);

    // Toggle the checkbox state
    checkbox.checked = !checkbox.checked; // Check or uncheck based on current state
}



function save_lesson_locations() {
    const ad_id = document.getElementById('ad_id').value;
    const formData = new FormData(); // Initialize formData

    // Get all checkboxes inside the popup with the class 'locations'
    const locationCheckboxes = document.querySelectorAll('.popup[data-popup="locations"] .custom-checkbox-inner input[type="checkbox"]');

    // Initialize an array to store selected location IDs
    const selectedLocations = [];

    // Iterate over each checkbox and check if it's checked
    locationCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            // If checked, push the location ID (from the data attribute) to the array
            selectedLocations.push(checkbox.getAttribute('data-location-id'));
        }
    });

    const selected_locations_json = JSON.stringify(selectedLocations);

    // Append data to formData
    formData.append('ad_id', ad_id);
    formData.append('selected_locations_json', selected_locations_json);
    formData.append('update_location', 'true');

    if (selectedLocations.length > 0) {
        // Send data with fetch
        fetch('./controllers/ad-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            setTimeout(function() {
                console.log(response);
                if ($.trim(response) == '1') {
                    console.log("Locations updated successfully");
                } 
            }, 500);
        })
        .catch(err => console.log(err));

        // Close the popup
        closePopup();

        // Return the selected locations array if needed elsewhere
        return selectedLocations;
    } else {
        console.log("No locations selected");
        return [];
    }
}


