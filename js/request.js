

function createFreeLessonRequest() {
    const formData = new FormData();

    // Handle request data
    
    // Validate
    var isSubject = document.querySelector('.selected-ad-subject') !== null;
    var expectation = document.getElementById('lesson_expectations').value;
    var message = document.getElementById('msg_student').value;
    var isLessonLengthSelected = document.querySelector('.component-checkbox-register.checked') !== null;
    var lesLength = document.querySelector('.component-checkbox-register.checked');
    var lessonType = document.querySelector('input[name=lesson_type]:checked').value;

    // console.log(day, time);

    if (lesLength) {
        var lengthValue = lesLength.querySelector('input').value;
        console.log('Lesson length id: ' + lengthValue);
    } else {
        console.log('Lesson length not selected');
    }

    // Message
    if(message) {
        $('#message-wrapper-outer').removeClass('invalid');
        $('#messageError').html('');
    }
    // Subject
    if(isSubject) {
        $('#subjects-wrapper-outer').removeClass('invalid');
        $('#subjectsError').html('');
    }
    // Expectation
    if(expectation) {
        $('#expectations-wrapper-outer').removeClass('invalid');
        $('#expectationsError').html('');
    }


    if (
        lessonType && isSubject && expectation && isLessonLengthSelected
    ) {
        
        // Subjects
        subIds = [];
        var subjectElems = document.querySelectorAll('div[data-subject-id]');
        subjectElems.forEach(subElem => {
            var subId = subElem.getAttribute('data-subject-id');
            subIds.push(subId);
        });
        var subJson = JSON.stringify(subIds);

        // Lesson Length
        var lesLengthChecked = document.querySelector('.component-checkbox-register.checked');
        var lesson_length = lesLengthChecked.getAttribute('data-length');
        
        // Ad Id
        var ad_id = document.getElementById('ad_id').value;

        // Subjects, associated boards, price etc
        var subjectsSession = sessionStorage.getItem('subjects');
    
        // console.log(ad_id, message, expectation, subJson, dayId, timeId, lesson_length);


        formData.append('create_request', 'true');
        formData.append('request_type', 'free');
        formData.append('ad_id', ad_id);
        formData.append('subjects', subjectsSession);
        formData.append('message', message);
        formData.append('expectation', expectation);


        formData.append('lesson_length', lesson_length);
        formData.append('lesson_type', lessonType);

        // Make an AJAX request to your server with the payment token
        // You can use libraries like Axios or Fetch for this purpose
        // Example using Fetch API:
        fetch('controllers/request-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Handle the response from the server
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });



    } else {
        // Message
        if(!message) {
            $('#message-wrapper-outer').addClass('invalid');
            $('#messageError').html('<div>Field cannot be blank</div>');
        }
        // Subject
        if(!isSubject) {
            $('#subjects-wrapper-outer').addClass('invalid');
            $('#subjectsError').html('<div>Select a subject</div>');
        }
        // Expectation
        if(!expectation) {
            $('#expectations-wrapper-outer').addClass('invalid');
            $('#expectationsError').html('<div>Field cannot be blank</div>');
        }
        // Day
        if(day == 'Select Day') {
            $('#day-selector').addClass('invalid');
            $('#dayError').html('<div>Select a day</div>');
        }
        // Time
        if(time == 'Select Time') {
            $('#time-selector').addClass('invalid');
            $('#timeError').html('<div>Select a time</div>');
        }
        
        console.log('error');
    }
}

function cancel_request(event, request_id) {
    event.preventDefault();
    load_start();

    var formData = new FormData();

    formData.append('cancel', 'true');
    formData.append('request_id', request_id);

    fetch('./controllers/request-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        setTimeout(() => {
            load_end();
            console.log(data);
            var page = get_page()
            window.location.href = './'+page;
            // // Parse the string into a JS object
            // var dataObj = JSON.parse(data);
            // // Access the status property
            // var status = dataObj.status;
            // console.log(status);
            // if(status == 'canceled') {
            //     window.location.href = './my-payments';
            // }
        }, 500);
    })
    .catch(error => {
        console.error('Error:', error);
    });

}

function refund_request(event, request_id) {
    event.preventDefault();
    load_start();

    var formData = new FormData();

    formData.append('refund', 'true');
    formData.append('request_id', request_id);

    fetch('./controllers/request-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        setTimeout(() => {
            load_end();
            console.log(data);
            var page = get_page()
            window.location.href = './'+page;
            // // Parse the string into a JS object
            // var dataObj = JSON.parse(data);
            // // Access the status property
            // var status = dataObj.status;
            // console.log(status);
            // if(status == 'canceled') {
            //     window.location.href = './my-payments';
            // }
        }, 500);
    })
    .catch(error => {
        console.error('Error:', error);
    });

}

function select_lesson_type(label) {
    const radioInput = label.previousElementSibling;
    const allLabels = document.querySelectorAll('.radio-label-3');

    // Unselect all labels
    allLabels.forEach((label) => {
        label.classList.remove('selected');
        label.previousElementSibling.checked = false;
    });

    // Select the clicked label
    label.classList.add('selected');

    // Update the radio input's checked property
    radioInput.checked = true;
}



function get_subject_popup(el) {

    const adSubjectId = el.getAttribute('data-ad-subj-id');

    fetch('./subject-options-popup?ad_subject_id=' + adSubjectId)
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

function get_subject_popup_request(el) {

    const requestId = document.getElementById('request_id').value;
    const adSubjectId = el.getAttribute('data-ad-subj-id');

    fetch('./subject-options-popup-request.php?ad_subject_id=' + adSubjectId + '&request_id=' + requestId)
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

function save_subject_options() {
    console.log('save');
    
    // Get the checkboxes with the data attribute 'data-boards-id'
    var checkboxes = document.querySelectorAll('input[data-boards-id]:checked');

    // Get the value for the 'ad_subject_id' input
    var adSubjectId = document.getElementById('ad_subject_id').value;

    // Get the parent element with 'data-ad-subj-id'
    var adSubjIdElement = document.querySelector('[data-ad-subj-id="' + adSubjectId + '"]');

    adSubjIdElement.classList.add('selected-ad-subject');

    // Get the child element with class 'ad-subject-boards'
    var adSubjectBoardsElement = adSubjIdElement.querySelector('.ad-subject-boards');

    // Check if adSubjectBoardsElement is not null before proceeding
    if (adSubjectBoardsElement) {
        // Remove existing elements from adSubjectBoardsElement
        adSubjectBoardsElement.innerHTML = '';

        // Loop through checked checkboxes
        checkboxes.forEach(function (checkbox) {
            // Get data attribute value and input value
            var boardId = checkbox.getAttribute('data-boards-id');
            var inputValue = checkbox.value;

            // Create a new div element
            var newDiv = document.createElement('div');

            // Set data attribute and text content
            newDiv.setAttribute('data-subject-board-id', boardId);
            newDiv.textContent = inputValue;

            // Append the new div to the 'ad-subject-boards' element
            adSubjectBoardsElement.appendChild(newDiv);


        });

        // Get the Price
        var price = document.querySelector('[data-subject-price-id="'+adSubjectId+'"]').textContent;
        // Create new price element
        var priceElement = document.createElement('div');
        priceElement.setAttribute('data-price-id', adSubjectId);
        priceElement.textContent = price;
        // Remove old price
        var prevPriceElem = document.querySelector('[data-price-id="'+adSubjectId+'"]');
        if (prevPriceElem) {
            adSubjIdElement.removeChild(prevPriceElem);
        }
        // Add new price
        adSubjIdElement.appendChild(priceElement);
    }
    
    send_subject_options();

    closePopup();

    // document.getElementById('ad-subject-popup-wrapper').innerHTML = '';
}


function select_ads_popup(event, tutor_id, student_id=null) {
    /*
        1. Select from a list of ads for this tutor
    */
    event.preventDefault();

    console.log(tutor_id, student_id);


    let url = './tutur-ads-popup?tutor_id=' + tutor_id;

    if(student_id) {
        url = './tutur-ads-popup?tutor_id=' + tutor_id + '&student_id=' + student_id;
    }

    fetch(url)
    .then(response => response.text())
    .then(response => {
        setTimeout(function() {
            console.log(response);
            $('#select-ads-popup-wrapper').html(response);
            popup('select-ads-popup');
        }, 500);
    })
    .catch( err => console.log(err));

}


function select_tutor_ad(label) {
    const radioInput = label.previousElementSibling;
    const allLabels = document.querySelectorAll('.radio-label-4');

    // Unselect all labels
    allLabels.forEach((label) => {
        label.classList.remove('selected');
        label.previousElementSibling.checked = false;
    });

    // Select the clicked label
    label.classList.add('selected');

    // Update the radio input's checked property
    radioInput.checked = true;
}

function select_ad_and_proceed(student_id=null) {
    var ad_id = document.querySelector('input[name=ad]:checked').value;
    if(student_id == null) {
        window.location.href = './schedule?ad_id=' + ad_id;
    } else {
        window.location.href = './schedule?ad_id=' + ad_id + '&student_id=' + student_id;
    }
    
}
