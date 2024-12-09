function get_subject_popup(el) {

    const adSubjectId = el.getAttribute('data-ad-subj-id');

    // Boards in the clicked subject item
    const boardElements = el.querySelectorAll('.ad-subject-boards div');
    const boardNames = Array.from(boardElements).map(boardEl => boardEl.textContent);
    console.log('Board Names:', boardNames);
    // Create an object to send via JSON
    const boardsData = {
        boards: boardNames
    };
    const jsonboardsData = JSON.stringify(boardsData);

    const formData = new FormData();
    formData.append('ad_subject_id', adSubjectId);
    formData.append('boards', jsonboardsData);
    
    fetch('./subject-options-popup', {
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

function send_subject_options() {
    // Retrieve session data for subjects or initialize if not present
    var subjectsSession = JSON.parse(sessionStorage.getItem('subjects')) || {};

    // Get the div with the id 'subjects-2'
    var subjects2Div = document.getElementById('subjects-2');

    // Get the value for the 'ad_subject_id' input
    var adSubjectId = document.getElementById('ad_subject_id').value;

    // Get the text for 'data-subject-name-id' and 'data-subject-price-id' that matches adSubjectId
    var subjectName = document.querySelector('[data-subject-name-id="' + adSubjectId + '"]').textContent;
    var subjectPrice = document.querySelector('[data-subject-price-id="' + adSubjectId + '"]').textContent;

    // Remove old element for this subject
    var prevSubject = document.querySelector('[data-subject-id="' + adSubjectId + '"]');
    if (prevSubject) {
        subjects2Div.removeChild(prevSubject);
    }
    // Create a new div element for the subject
    var subjectDiv = document.createElement('div');
    subjectDiv.setAttribute('data-subject-id', adSubjectId);
    subjectDiv.classList.add('subject-summary');

    // Create and append elements for the subject
    var nameElement = document.createElement('div');
    nameElement.setAttribute('data-id', adSubjectId);
    nameElement.classList.add('subject-name');
    nameElement.textContent = subjectName;

    // Get the checkboxes with the data attribute 'data-boards-id'
    var checkboxes = document.querySelectorAll('input[data-boards-id]:checked');

    // Create a new div element outside the loop
    var boardsElement = document.createElement('div');
    boardsElement.classList.add('selected-boards');

    var num_of_boards = checkboxes.length;
    
    // Collect board selections for session storage
    var selectedBoards = [];

    // Loop through checked checkboxes
    var i = 1;
    checkboxes.forEach(function (checkbox) {
        // Get data attribute value and input value
        var boardId = checkbox.getAttribute('data-boards-id');
        var inputValue = checkbox.value;

        // Create a new div element
        var newDiv = document.createElement('div');

        console.log(boardId);

        // Set data attribute and text content
        newDiv.setAttribute('data-subject-board-id', boardId);
        newDiv.textContent = inputValue;



        // Append the newDiv to the boardsElement
        boardsElement.appendChild(newDiv);

        if(i < num_of_boards) {
            var commaElem = document.createElement('div');
            commaElem.textContent = ',';
            commaElem.classList.add('comma');
            boardsElement.appendChild(commaElem);
        }

        
        // Collect the board for session storage
        selectedBoards.push({
            boardId: boardId,
            value: inputValue
        });


        i++;
    });

    var priceElement = document.createElement('div');
    priceElement.setAttribute('data-selected-price-id', adSubjectId);
    priceElement.textContent = subjectPrice;

    // Append elements to the subjectDiv
    subjectDiv.appendChild(nameElement);
    subjectDiv.appendChild(boardsElement);
    subjectDiv.appendChild(priceElement);

    // Append the subjectDiv to the 'subjects-2' element
    subjects2Div.appendChild(subjectDiv);

    // Update the session storage with the current subject
    if(selectedBoards.length > 0) {
        subjectsSession[adSubjectId] = {
            name: subjectName,
            price: subjectPrice,
            boards: selectedBoards
        };

    } else {
        delete subjectsSession[adSubjectId];
        
        const adSubj = document.querySelector(`[data-ad-subj-id="${adSubjectId}"]`);

        console.log(124, adSubj);
        // Check if element exists before removing the class
        if (adSubj) {
            adSubj.classList.remove('selected-ad-subject');
            // console.log(adSubj);
        }

        const adSubjPrice = document.querySelector(`[data-price-id="${adSubjectId}"]`);
        if (adSubjPrice) {
            adSubjPrice.textContent = '';
            console.log(adSubjPrice);
        }
    }

    console.log(subjectsSession);
    // Save updated subjects to session storage
    sessionStorage.setItem('subjects', JSON.stringify(subjectsSession));
    

    // Create total price
    var priceTotal = document.getElementById('price-total');

    var pricesAll = document.querySelectorAll('[data-selected-price-id]');

    // Set ntital price
    var total = 0;
    pricesAll.forEach(priceSingle => {
        var itemPriceString = priceSingle.textContent.replace('£', ''); // Remove currency symbol
        var itemPrice = parseFloat(itemPriceString.replace(',', '')); // Remove commas and parse as float
        total += itemPrice;
    });

    priceTotal.textContent = '£' + total.toFixed(2); // Display total with two decimal places
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



function switchTabSchedule(defaultClass, switchTo, activeClass) {
    /*
        The switchTabSchedule() is a mutated form of our original switchTab()
        It combines swtiching tabs according to the function arguments we provide
        with the validations necessary before the switch
    */
    
    // Validate

    if(switchTo == 'tab-3') {

        var isSubject = document.querySelector('.selected-ad-subject') !== null;
        var expectation = document.getElementById('lesson_expectations').value;
        var message = document.getElementById('msg_student').value;
        var isLessonLengthSelected = document.querySelector('.component-checkbox-register.checked') !== null;
        var lesLength = document.querySelector('.component-checkbox-register.checked');

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
            isSubject && expectation && isLessonLengthSelected
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
        
            console.log(message, expectation, subJson, lesson_length);

            // Switch
            var tabs = document.getElementsByClassName(defaultClass);
            const switchToTab = document.querySelector('.' + switchTo);
            /*
                Loop through all tabs and remove active class
                Add active class to the tab we want to show
            */
            for (var i = 0; i < tabs.length; i++) {
                var tab = tabs[i];
                tab.classList.remove(activeClass);
            }
            switchToTab.classList.add(activeClass);

            switchTo.classList.add('large-width');
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
            console.log('error');
        }
    }
    // else if(switchTo == 'tab-3') {
    //     // const session_id = $('#session-wrapper .selected-label').data('selected-value');

    //     fetch(`./controllers/service-calendar-handler.php?get_customer_booking=true`)
    //         .then(response => response.text())
    //         .then(response => {
    //             var datetimes = response;
    //             console.log('datetimes', datetimes);

    //             // // Datetimes
    //             // var datetimesData = JSON.parse(datetimes);
    //             // var date = datetimesData[0].date;
    //             // var time = datetimesData[0].times[0].time.trim();



    //             if(datetimes != '') {

    //                 // Switch
    //                 var tabs = document.getElementsByClassName(defaultClass);
    //                 const switchToTab = document.querySelector('.' + switchTo);
    //                 /*
    //                     Loop through all tabs and remove active class
    //                     Add active class to the tab we want to show
    //                 */
    //                 for (var i = 0; i < tabs.length; i++) {
    //                     var tab = tabs[i];
    //                     tab.classList.remove(activeClass);
    //                 }
    //                 switchToTab.classList.add(activeClass);

    //                 switchTo.classList.add('large-width');


    //                 // load_start();

    //                 // const formData = new FormData();

    //                 // formData.append('datetimes', datetimes);
    //                 // formData.append('date', date);
    //                 // formData.append('time', time);

    //                 // fetch('./controllers/booking-handler', {
    //                 //     method: 'POST',
    //                 //     body: formData
    //                 // })
    //                 // .then(response => {
    //                 //     return response.text()
    //                 // })
    //                 // .then(response => {
    //                 //     setTimeout(function() {
    //                 //         load_end();

    //                 //         console.log(response);
    //                 //         if($.trim(response) == '1') {
    //                 //             $('#message-response').html("<div class='success'>Booking was successful!</div>");
    //                 //         } else {
    //                 //             $('#message-response').html("<div class='error'>There was an error</div>");
    //                 //         }
    //                 //     }, 500);
    //                 // })
    //                 // .catch(err => console.log(err));
    //             } else {  
    //                 // Datetime
    //                 if(datetimes = '') {
    //                     document.querySelector('#sessions-error').innerHTML = '<div>Select a time slot to continue</div>';
    //                 } else {
    //                     document.querySelector('#sessions-error').innerHTML = '';
    //                 }
    //             }

    //         })
    //         .catch(error => console.error('Error fetching messages:', error));

    // }
    
}