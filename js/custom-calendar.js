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
function highlight4(el) {
    // console.log(el);

    document.querySelectorAll('.time-slot').forEach(element => {
        if(element.classList.contains('customer-select')) {
            element.classList.remove('customer-select');
        }
    });

    // Add highlight
    if(!el.classList.contains('customer-select')) {
        if(el.classList.contains('merchant-time-selected')) {
            el.classList.add('customer-select');
        } 
    } else {
        el.classList.remove('customer-select');
    }
}

function highlight5(el) {
    // Add highlight
    if(!el.classList.contains('unavailable-time-slot')) {
        if(!el.classList.contains('merchant-time-selected')) {
            el.classList.add('merchant-time-selected');
        } else {
            el.classList.remove('merchant-time-selected');
        }
    }
}
// Month
function get_month(event, m, y) {
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
    var url = `get-service-calendar-html.php?get_month=true&month=${m}&year=${y}`;
    // var url = `get-month-popup.php?get_month=true&month=${m}&year=${y}&selected=${json_encoded_array}`;

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

    // Get the current URL
    var url = window.location.pathname;
    // Extract the filename from the URL
    var filename = url.substring(url.lastIndexOf('/') + 1);
    // Check if the filename is "schedule.php" or "schedule" (without extension)
    if (filename === 'schedule.php' || filename === 'schedule') {
        // Build the URL with query parameters
        var url = `get-times-popup-customer.php?date=${date}`;
    } else if (filename === 'schedule-modify.php' || filename === 'schedule-modify') {
        // Build the URL with query parameters
        var url = `get-times-popup-customer.php?date=${date}`;
        console.log(filename);
    } else if (filename === 'tutor-profile.php' || filename === 'tutor-profile') {
        // Build the URL with query parameters
        var url = `get-times-popup-customer.php?date=${date}`;
    } else {
        var url = `get-times-popup.php?times_popup=true&date=${date}`;
    }

    fetch(url)
        .then(response => response.text())
        .then(response => {
            console.log(response);
            if (filename === 'schedule-modify.php' || filename === 'schedule-modify') {
                closePopup('month-outer-wrapper');
            }
            $('#times-popup-wrapper').html(response);
            // popup('times-popup');

            var timesPopup = document.getElementById('times-popup');
            
            if(timesPopup.classList.contains('hide_popup')) {
                if(popBg.classList.contains('light')) {
                    popBg.classList.remove('light');
                }
                popBg.classList.add('dark');

                timesPopup.classList.remove('hide_popup');
                timesPopup.classList.add('show_popup');

                return;
            }
        })
        .catch(err => console.log(err));
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
    var timeElems = document.querySelectorAll('.merchant-time-selected > a');

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
    var url = `controllers/booking-handler.php?type=merchant&date=${date}&times=${timesJson}`;

    fetch(url)
        .then(response => response.text())
        .then(response => {
            console.log(response);
            
            // Close Times Pop Up
            var popup = document.getElementById('times-popup');
            var popBg = document.getElementById('popBg');   
            if(popup.classList.contains('show_popup')) {
                popup.classList.remove('show_popup');
                popup.classList.add('hide_popup');
            }
            if(popBg.classList.contains('dark')) {
                popBg.classList.remove('dark');
            }
        })
        .catch(err => console.log(err));
}

function update_datetimes_session_customer(date) {
    var date = document.querySelector('#date-for-times').textContent;
    // var timeElems = document.querySelectorAll('.customer-select > a');
    
    // var times_list = [];

    // timeElems.forEach(el => {
    //     var time = el.textContent;
    //     times_list.push(time);
    // });

    // If user selects just the a single time slot we only need the first time
    var time = document.querySelectorAll('.customer-select > a')[0].textContent.trim();
    
    console.log(date, time);
    
    $('.customer-date-selected').removeClass('customer-date-selected');

    var dateElem = $('[data-date="'+date+'"]');
    // No times selected / saved
    if(time) {
        // Times selected / saved
        dateElem.addClass('customer-date-selected');
    } else {
        dateElem.removeClass('customer-date-selected');
    }

    // var timesJson = JSON.stringify(times_list);

    // Build the URL with query parameters
    // var url = `controllers/booking-handler.php?type=customer&date=${date}&times=${timesJson}`;
    var url = `controllers/booking-handler.php?type=customer&date=${date}&time=${time}`;

    fetch(url)
        .then(response => response.text())
        .then(response => {
            // console.log(response);
            // Get the current URL
            var url = window.location.pathname;
            // Extract the filename from the URL
            var filename = url.substring(url.lastIndexOf('/') + 1);

            // console.log(filename);

            if (filename === 'tutor-profile.php' || filename === 'tutor-profile') {
                window.location.href = './schedule';
            } else {
                closePopup('times-popup');
            }
        })
        .catch(err => console.log(err));
}