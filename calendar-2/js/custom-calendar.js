// Booking
function highlight(el) {
    if(!el.classList.contains('date-selected')) {
        // Add highlight
        el.classList.add('date-selected');
        return;
    } else {
        // Remove highlight
        el.classList.remove('date-selected');
        return;
    }
}
function highlight2(el) {
    // Remove highlight
    document.querySelectorAll('.time-slot').forEach(element => {
        if(element.classList.contains('time-selected')) {
            element.classList.remove('time-selected');
        }
    });
    // Add highlight
    if(!el.classList.contains('time-selected')) {
        el.classList.add('time-selected');
    }
}
function highlight3(el) {
    // Remove highlight
    // document.querySelectorAll('.time-slot').forEach(element => {
    //     if(element.classList.contains('time-selected')) {
    //         element.classList.remove('time-selected');
    //     }
    // });
    // Add highlight
    if(!el.classList.contains('time-selected')) {
        el.classList.add('time-selected');
    } else {
        el.classList.remove('time-selected');
    }
}
// Month
function get_month(event, m, y, json_encoded_array=null) {
    /*
        1. Arguments = month, year
        2. Send the values to php script
        3. Php takes the values and creates html
        for the month of the year
        4. Echos the html as response
        5. We get the wrapping element and 
        insert the response inside it
    */
    event.preventDefault();

    // Build the URL with query parameters
    var url = `get-html.php?get_month=true&month=${m}&year=${y}&selected=${json_encoded_array}`;

    fetch(url)
        .then(response => response.text())
        .then(response => {
            console.log(response);
            $('#month-wrapper').html(response);
        })
        .catch(err => console.log(err));
}
function set_date(event, d, m, y) {
    event.preventDefault();

    var date = `${d}-${m}-${y}`;

    console.log(date);

        // Build the URL with query parameters
        var url = `get-times-popup.php?date=${date}`;

        fetch(url)
            .then(response => response.text())
            .then(response => {
                console.log(response);
                $('#times-popup-wrapper').html(response);
                popup('times-popup');
            })
            .catch(err => console.log(err));


    // // Session Exists
    // if(sessionStorage.getItem('booking_datetime')) {
    //     // Get Session
    //     var dates_json = sessionStorage.getItem('booking_datetime');
    //     // Parse the JSON string
    //     var dates_array = JSON.parse(dates_json);
    //     // Check if array
    //     if (Array.isArray(dates_array)) {
    //         if(dates_array.indexOf(date) == -1) {
    //             dates_array.push(date);
    //         } else {
    //             dates_array = dates_array.filter(item => item !== date);
    //         }
    //     }
    // } else {
    //     var dates_array = [];
    //     dates_array.push(date);
    // }
    
    // // Encode it back
    // var dates_json_new = JSON.stringify(dates_array);

    // console.log(dates_json_new);
    // sessionStorage.setItem('booking_datetime', dates_json_new);
}
function submit() {
    var booking_datetime = sessionStorage.getItem('booking_datetime');
    console.log(booking_datetime);
    // formData.append('booking_datetime', booking_datetime);
}
function hasDatesInNextThreeMonths(dateArray) {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();
    var subsequentMonths = 0;

    for (var i = 0; i < dateArray.length; i++) {
        // Split the date string into day, month, and year parts
        var dateParts = dateArray[i]['date'].split('-');
        var day = parseInt(dateParts[0], 10);
        var month = parseInt(dateParts[1], 10) - 1; // Adjust month (JavaScript months are 0-indexed)
        var year = parseInt(dateParts[2], 10);

        // Create a new Date object using the parsed parts
        var date = new Date(year, month, day);

        console.log(dateArray[i]['date']);
        console.log(date);

        if (date > currentDate && date.getMonth() === currentMonth + subsequentMonths && date.getFullYear() === currentYear) {
            subsequentMonths++;

            if (subsequentMonths >= 3) {
                return true;
            }
        }
    }

    return false;
}
function update_datetimes_session(date) {
    var date = document.querySelector('#date-for-times').textContent;
    var timeElems = document.querySelectorAll('.time-selected > a');

    var times_list = [];

    timeElems.forEach(el => {
        var time = el.textContent;
        times_list.push(time);
    });

    // Toggle date highlight
    var dateElem = $('[data-date="'+date+'"]');
    // No times selected / saved
    if(times_list.length == 0) {
        dateElem.removeClass('date-selected');
    } else {
        // Times selected / saved
        dateElem.addClass('date-selected')
    }

    var timesJson = JSON.stringify(times_list);

    // Build the URL with query parameters
    var url = `controllers/booking-handler.php?date=${date}&times=${timesJson}`;

    fetch(url)
        .then(response => response.text())
        .then(response => {
            console.log(response);
            closePopup('times-popup');
        })
        .catch(err => console.log(err));
}

