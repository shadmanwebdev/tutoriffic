<?php
    include './partials/header.php';

    if(isset($_SESSION['tutor_id'])) {
        unset($_SESSION['tutor_id']);
    }
    if(isset($_SESSION['datetimes'])) {
        unset($_SESSION['datetimes']);
    }
    if(isset($_SESSION['datetimes_2'])) {
        unset($_SESSION['datetimes_2']);
    }
?>

<!-- Calendar CSS hover -->
<link rel="stylesheet" href="css/custom-calendar.css?v=32">
<!-- Calendar JS -->
<script src="js/custom-calendar.js?v=27" defer></script>



<?php include './partials/nav-2.php'; ?>

<link rel="stylesheet" href="css/tutor.css?v=2">

<style>
    .user-no-picture {
        width: 100%;
        height: 100%;
        font-size: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: rgb(255,145,77);
    }
</style>

<style>
    .schedule {
        margin-right: 100px;
    }
    .scheduling-days {
        display: flex;
        flex-flow: row wrap;
        width: 100%;
    }
    .sch-dow {
        align-self: flex-start;
        flex: 1 0;
        padding: 0;
        text-align: center;
    }
    .sch-dow {
        border-top: 4px solid rgb(255, 145, 77);
    }
    .sch-dow-inner {
        align-items: center;
        color: #384047;
        display: flex;
        flex-direction: column;
        font-size: 16px;
        line-height: 1.5;
        padding: 16px 0;
    }
    .sch-dow + .sch-dow {
        margin-left: 4px;
    }
    .d {
        margin-bottom: 0;
    }
    .dow {
        margin-bottom: 0;
    }
    .times {
        margin-top: 20px;
    }
</style>

<!-- Report btn -->
<style>
    .btn.report-btn {
        background: rgb(255 207 178);
        color: #181818;
        border-radius: 30px;
        padding: 12px 60px;
        min-width: 100%;
        margin: 0 auto 0 auto;
    }
    .btns-wrapper {
        display: flex;
        flex-flow: column nowrap;
    }
    .btns-wrapper a {
        display: block;
        margin-bottom: 10px;
    }
</style>

<style>
    #report-popup {
        top: 10%;
        left: 50%;
        padding: 50px;
        width: 600px;
        margin-top: 0px;
        margin-left: -300px;
    }
</style>

<!-- Ticket form -->
<style>
    .open-ticket-wrapper {
        max-width: 100%;
    }
    .small-11 {
        width: 100%;
        padding-top: 0;
        padding-bottom: 0;  
        padding-left: 0;
        padding-right: 0;  
        border: none;
    }
    .row {
        margin-right: 0px;
        margin-left: 0px;
    }
    /* .box-content {
        padding: 25px;
    } */
    .column.small-centered, .columns.small-centered {
        position: relative;
        margin-left: auto;
        margin-right: auto;
        float: none !important;
    }
    /* .form-header {
    } */
    .column, .columns {
        position: relative;
        float: left;
    }
    .box-content h2 {
        font-size: 24px;
        font-weight: 300;
        margin: 0.84em 0 0 0;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    .row .row.but-pad {
        margin: 0;
    }

    .row .row.collapse {
        display: flex;
        width: 100%;
        /* width: auto; */
        margin: 0;
        max-width: none;
        *zoom: 1;
    }
    .small-12.columns {
        
        display: flex;
        width: 100%;
    }
    .collapse:not(.show) {
        display: block;
    }
    input[type="text"], input[type="password"], 
    input[type="date"], input[type="datetime"], 
    input[type="datetime-local"], input[type="month"], 
    input[type="week"], input[type="email"], 
    input[type="number"], input[type="search"], 
    input[type="tel"], input[type="time"], input[type="url"], textarea {
        width: 100%;
        color: rgb(60, 60, 60);
        font-family: 'Open Sans', 'Calibri', Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 300;
        line-height: 22px;
        margin: 0 0 3px 0;
        padding: 0.625em 0.625em 0.625em;
    }
    input[type="text"], 
    input[type="password"], 
    input[type="date"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="month"], 
    input[type="week"], 
    input[type="email"], 
    input[type="number"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="time"], 
    input[type="url"], 
    textarea {
        -webkit-appearance: none;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-color: white;
        font-family: inherit;
        border: 1px solid #cccccc;
        -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        color: rgba(0, 0, 0, 0.75);
        display: block;
        font-size: 0.875rem;
        margin: 0 0 1rem 0;
        padding: 0.5rem;
        height: 2.3125rem;
        width: 100%;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: -webkit-box-shadow 0.45s, border-color 0.45s ease-in-out;
        -moz-transition: -moz-box-shadow 0.45s, border-color 0.45s ease-in-out;
        transition: box-shadow 0.45s, border-color 0.45s ease-in-out;
    }
    
    button, .button {
        background-color: rgb(51,102,204);
        border: none;
        color: white;
    }
    button:hover, .button:hover {
        background-color: rgb(14, 69, 178);
    }
    .button.imp.small {
        padding: 11px 20px 10px 20px;
        font-size: 14px;
        line-height: normal;
        margin: 0px 2px 0 2px;
        border-radius: 2px;
    }
    button.alert, .button.alert {
        background-color: #7A7A7A;
    }
    button.alert:hover, 
    button.alert:focus, 
    .button.alert:hover, 
    .button.alert:focus {
        background-color: #525252;
        color: white;
    }

    @media (max-width: 768px) {
        .open-ticket-wrapper {
            max-width: 95%;
            margin: 50px auto;
        }
        .small-11 {
            width: 100%;
            padding-top: 0.9375rem;
            padding-bottom: 0.9375rem;
            padding-left: 1.9375rem;
            padding-right: 1.9375rem;
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
    }
</style>

<!-- Report popup -->
<div class='popup hide_popup' id='report-popup'>
    <?php
        $support = new Support;
        $support_id = $support->get_support_id();
        echo $support->create_report_form($_GET['a']);
    ?>
</div>


<div class='page-wrapper main-content'>

    <?php
        $ad = new Ad();
        $ad_id = $_GET['a'];
        $ad_details = $ad->get_single_ad($ad_id);
        $tutor_id = $ad_details['tutor_uid'];

        $_SESSION['tutor_id'] = $tutor_id;
        $_SESSION['ad_id'] = $ad_id;

        $ad->tutor_profile($ad_id);
    ?>


    <div class='col-lg-8 col-md-8 calendar-wrapper'>

        <!-- Times Pop Up -->
        <div id='times-popup-wrapper'></div>

        <!-- Month -->
        <div id='month-outer-wrapper'>
            <h2 data-role="title">Current Availability</h2>
            <div class='container' id='month-wrapper'>
                    
                <?php
                    // Set the timezone
                    $timezone = new DateTimeZone('Europe/London');
                    // Create a new DateTime object with the specified timezone
                    $date = new DateTime('now', $timezone);
                    $currentDayOfWeek = $date->format("D");
                    // // Sat or Sun
                    // if($currentDayOfWeek == 'Sat') {
                    //     $date->modify('+2 days');
                    // } else if($currentDayOfWeek == 'Sun') {
                    //     $date->modify('+1 day');
                    // }
                
                    // Get current date in numerical format (day)
                    $currentDay = $date->format('d');
                    // Get current month in numerical format
                    $currentMonth = $date->format('n');
                    // Get current year
                    $currentYear = $date->format('Y');
                    // Get current day of week
                
                
                    $sc = new ServiceCalendar;
                    $month = $sc->show_service_calendar($currentMonth, $currentYear);
                    echo $month;
                ?>
            </div>  
            <div class='error' id='datetime-error'></div>

        </div>

    </div>




<?php
    if(isset($_SESSION['user'])) {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $user_account_type_id = $userdata['user_account_type_id'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $user_account_type_id = $userdata['user_account_type_id'];
        }

        // Check if user is student
        if($user_account_type_id == '2') {
            
            $request = new Request;
            // Check if student has a request
            $requests = $request->get_student_request($_GET['a']);

            if(count($requests) > 0) {
                $student_id = get_uid();
                $review = new Review;
                $reviews = $review->review_exists_for_student($student_id);
            

                // Check if there are no reviews
                if(count($reviews) == 0) {

?>

<!-- Review form -->
<div id='review-form' class='col-md-8'>
    <h2 style='margin-bottom: 12px;'>Write a review</h2>
    <div class='rt-wrapper'>
        <span class='rt-label'>Your rating</span>
        <span class='stars'>

            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>


        </span>
    </div>
    <input type="hidden" name='ad_id' id='ad_id' value='<?= $_GET['id']; ?>'>
    <input type="hidden" name='tutor_id' id='tutor_id' value='<?= $ad_array['tutor_uid']; ?>'>
    <div class='textarea-container'>
        <textarea id="review" name="review" placeholder="E.g. Thanks! John is an amazing tutor." style="height: 128px;"></textarea>
    </div>
    <div class="btns-wrapper">
        <span class="btn btn-validate" onclick="create_review()">Post</span>
    </div>
</div>

<?php
                }
            }
        }
    }
?>





    <?php
        $review = new Review();
        $review->reviews(1);
    ?>


</div>





<script defer>

    function create_review() {
        var rating = $('.stars .selected').length;
        var ad_id = $('#ad_id').val();
        var tutor_id = $('#tutor_id').val();
        var review = $('#review').val();

        if(rating && review && tutor_id && ad_id) {
            var formData = new FormData();
    
            formData.append('create_review', 'true');
            formData.append('ad_id', ad_id);
            formData.append('tutor_id', tutor_id);
            formData.append('review', review);
            formData.append('rating', rating);
    
            fetch('./controllers/review-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                // Select the last element with the 'comment' class
                var lastReview = $('.review-item:first');
                // New HTML content to be inserted after the last 'review' element
                var newReview = response;
                // Insert the new review after the last 'review' element
                lastReview.before(newReview);
                $('#review').val('');
            })
            .catch( err => console.log(err));
        }
    }
    $(document).ready(function () {
        // Click function
        $('.icon').click(function () {
            if (!$(this).hasClass('selected')) {
                $(this).addClass('selected').prevAll().addClass('selected');
                $(this).nextAll().removeClass('selected');

                // Remove star_border class and add icon-star2 class
                $(this).removeClass('icon-star_border').addClass('icon-star2').prevAll().removeClass('icon-star_border').addClass('icon-star2');
            } else {
                $(this).nextAll().removeClass('selected');
                $(this).nextAll().removeClass('icon-star2').addClass('icon-star_border');
            }
        });

        // Mouseover function
        $('.icon').mouseover(function () {
            if (!$(this).hasClass('selected')) {
                $(this).addClass('icon-star2').prevAll().addClass('icon-star2');
                $(this).removeClass('icon-star_border').prevAll().removeClass('icon-star_border');
            }
        });

        // Mouseout function
        $('.icon').mouseout(function () {
            if (!$(this).hasClass('selected')) {
                $(this).removeClass('icon-star2').addClass('icon-star_border');
                // Remove icon-star2 from elements without selected class
                $(this).siblings(':not(.selected)').removeClass('icon-star2');
                // Add icon-star_border to elements without selected class
                $(this).siblings(':not(.selected)').addClass('icon-star_border');
            }
        });

    });
</script>





<script defer>
    function report(event) {
        event.preventDefault();

        const reportedAdId = document.getElementById('reported_ad_id').value;
        const reportedBy = document.getElementById('reported_by').value;
        const message = document.getElementById('msg').value;

        if (!message.trim()) {
            alert("Please enter a message.");
            return;
        }

        const formData = new FormData();
        formData.append('create_report', 'true');
        formData.append('reported_ad_id', reportedAdId);
        formData.append('reported_by', reportedBy);
        formData.append('msg', message);

        fetch('./controllers/support-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text(); // Assuming the response is JSON
            } else {
                throw new Error('Failed to submit the report.');
            }
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success' style='margin-top: 0px;'>Your report was sent</div>");
            } else {
                $('#message-response-1').html("<div class='error' style='margin-top: 0px;'>Invalid email or password</div>");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the report.');
        });
    }
</script>



</body>
</html>