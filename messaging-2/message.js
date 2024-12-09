function create_message(event) {
     ;

    var create_msg = $('#create_msg').val();
    var content = $('#msg_content').val();
    var to_id = $('#to_id').val();

    if(
        create_msg && content && to_id
    ) {

        $('#msg_content').removeClass('invalid');
        $('#contentError').html('');
        $('#toError').html('');
    

        // Create a new FormData object
        var formData = new FormData();
        
        var image = $('#image')[0].files;
        for (var i = 0; i < image.length; i++) {
            formData.append('image[]', image[i]);
        }

        formData.append('create_msg', create_msg);
        formData.append('content', content);
        formData.append('to_id', to_id);
        
        
        fetch('./controllers/message-handler.php', {
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
            // Append the fetched message HTML to the last 'message' element
            const lastMessage = document.querySelector('.msgbox-body-inner .message:last-child');
            lastMessage.insertAdjacentHTML('afterend', response);

            // Assuming you've inserted the new message using insertAdjacentHTML
            // messageContainer is the element that contains the messages
            const messageContainer = document.querySelector('.msgbox-body-outer');

            // Calculate the new scroll height after adding the message
            const newScrollHeight = messageContainer.scrollHeight;

            // Update the scrollTop property to scroll to the new scroll height
            messageContainer.scrollTop = newScrollHeight;
        });
    } else {
        // Content
        if(content) {
            $('#contentError').html('');
            $('#msg_content').removeClass('invalid');
        } else {
            $('#contentError').html('<div>Field cannot be blank</div>');
            $('#msg_content').addClass('invalid');
        }
        // To
        if(to_id) {
            $('#toError').html('');
        } else {
            $('#toError').html('<div>Please select a user to send message</div>');
        }
    }
}
function del_msg_img(event, type, img, id, n) {
     ;

    var formData = new FormData();

    formData.append('delpostimg', 'true');
    formData.append('type', type);
    formData.append('postimg', img);
    formData.append('id', id);


    fetch('../controllers/post-handler.php', {
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
        console.log(response);
        if($.trim(response) == '1') {
            $('#img-wrapper-'+n).html("");
        } else {
            $('#message-response').html("<div class='error'>There was an error</div>");
        }
    });  
}

// Timer from a given time to 5 minutes later 
function updateTimer(timerElemId, inputDateTimeString, countdownDuration) {
    // Get the current datetime in the New York (Eastern Time) timezone
    const nyTimeZone = 'America/New_York';
    const options = { timeZone: nyTimeZone };
    const currentDateTime = new Date().toLocaleString(undefined, options);
    console.log('target: ' + inputDateTimeString);
    console.log('current: ' + currentDateTime);

    // Parse the countdown beginning datetime string in New York time
    const [datePart, timePart] = inputDateTimeString.split(' ');
    const [year, month, day] = datePart.split('-').map(Number);
    const [hours, minutes, seconds] = timePart.split(':').map(Number);

    // Create a new Date object in New York time
    const inputDate = new Date(year, month - 1, day, hours, minutes, seconds);
    console.log(inputDate);

    // Calculate targetDateTime in New York time
    const targetDateTime = inputDate.getTime() + countdownDuration;

    // Calculate the remaining time in milliseconds
    const remainingTime = targetDateTime - new Date(currentDateTime).getTime();

    if (remainingTime <= 0) {
        // Timer has expired
        document.getElementById(timerElemId).innerHTML = "Timer Expired!";
    } else {
        // Calculate hours, minutes, and seconds
        const hours = Math.floor(remainingTime / (1000 * 60 * 60));
        const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        // Display the remaining time
        document.getElementById(timerElemId).innerHTML = `${hours}h ${minutes}m ${seconds}s`;

        // Update the timer every 1 second
        setTimeout(function () {
            updateTimer(timerElemId, inputDateTimeString, countdownDuration); // Pass the inputDateTimeString to continue updating
        }, 1000);
    }
}


// Rest of your code remains the same
function convertTimeToCountdown(inputTime) {
    // Split the input time into hours, minutes, and seconds
    const [hours, minutes, seconds] = inputTime.split(':').map(Number);

    // Calculate the total duration in milliseconds
    const countDur = ((hours * 60 + minutes) * 60 + seconds) * 1000;

    return countDur;
}



function fireButton(event) {
     ;
    document.getElementById('image').click()
}

function fireButton2(event) {
     ;
    document.getElementById('video').click()
}

$("#image").change(function(){
    const selectedImages = document.getElementById('image').files;
    const numSelectedImages = selectedImages.length;

    document.getElementById('image-name-1').style.display = 'block';
    document.getElementById('image-name-1').textContent = numSelectedImages;
});
$("#video").change(function(){
    const selectedvideos = document.getElementById('video').files;
    const numSelectedvideos = selectedvideos.length;

    document.getElementById('video-name-1').style.display = 'block';
    document.getElementById('video-name-1').textContent = numSelectedvideos;
});

$(document).ready(function() {
    if(window.innerWidth < 996) {
        $('.user-list').on('click', function() {
            // Move user-list to the left (hidden) and show msgbox
            $('.user-list').css('transform', 'translateX(-100%)');
            $('.msgbox').css('transform', 'translateX(-100%)');
        });

        $('#resetButton').on('click', function() {
            // Reset the positions to their original state
            $('.user-list').css('transform', 'translateX(0)');
            $('.msgbox').css('transform', 'translateX(100%)');
        });
    }
});