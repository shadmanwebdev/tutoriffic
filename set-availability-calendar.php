<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    if(isset($_SESSION['tutor_id'])) {
        unset($_SESSION['tutor_id']);
    }
    // if(isset($_SESSION['datetimes'])) {
    //     unset($_SESSION['datetimes']);
    // }
    // if(isset($_SESSION['datetimes_2'])) {
    //     unset($_SESSION['datetimes_2']);
    // }
?>

<!-- Calendar CSS -->
<link rel="stylesheet" href="css/custom-calendar.css?v=30">

<!-- Calendar JS -->
<script src="js/custom-calendar.js?v=29" defer></script>

<!-- Times Pop Up -->
<div id='times-popup-wrapper'></div>

<!-- Popup -->
<style>
    #times-popup.popup {
        position: fixed;
        top: 0;
        left: 0;
        background-color: #fff;
        padding: 20px;
        width: 95%;
        margin-top: 2.5%;
        margin-left: 2.5%;
        z-index: 1001;
    }
    h2.popup-heading {
        margin: 0 0 10px !important;
    }
    @media (min-width: 991px) {
        #times-popup.popup {
            padding: 50px;           
            width: 90%;
            margin-top: 2.5%;
            margin-left: 5%; 
        }
    }

</style>
<!-- Calendar -->
<style>
    #month-outer-wrapper {
        display: flex;
        flex-flow: column;
        align-items: center;
        margin: 50px 0 20px 0;
    }
    #month-wrapper {
        max-width: 400px;
        margin: 0px 0 20px 0;
    }
    .container, .col-sm-12 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .time-slot {
        display: flex;
        margin-bottom: 10px;
    }
</style>
       
<style>
    #sb_dateview_container .top-date-select .calendar .weeks-date .day-off {
        opacity: 0.8 !important;
        color: #81889a;
    }
    /* Hidden dates */
    .past-month-date a {
        display: none;
    }
    .future-month-date a {
        display: none;
    }
    .past-month-date, .future-month-date {
        opacity: 0;
    }
    /* .past-month-date {
        display: none;
    }
    .future-month-date {
        display: none;
    } */
</style>

<style>
    .sb-cell.free:hover {
        background: rgb(255, 145, 77);
        color: #fff !important;
    }
    .time-selected a {
        background: rgb(255, 145, 77) !important;
        color: #fff !important;
    }
    .merchant-time-selected a {
        background: rgb(255, 145, 77) !important;
        color: #fff !important;
    }
    #month-outer-wrapper {
        margin: 30px 0 50px 0;
    }
    #month-wrapper {
        max-width: 100%;
        width: 100%;
        margin: 0px 0 50px 0;
    }
    .header {
        padding: 0 30px;
    }
    .section {
        border-radius: 0;
        box-shadow: none;
        padding: 0px 30px;
    }
</style>


<style>
    .btns-wrapper {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center !important;
        margin-top: 10px;
    }
    .btn-back {
        margin-right: 15px;
    }
    .btn.btn-proceed {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        min-width: 140px;
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 32px;
        cursor: pointer;
        max-height: 42px;
        border: 1px solid rgb(255, 145, 77);
        background: rgb(255, 145, 77);
        color: #fff;
    }
</style>

<!-- Month -->
<div id='month-outer-wrapper'>
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
        
        
            if(isset($_SESSION['session_temp_id'])) {
                unset($_SESSION['session_temp_id']);
            }
        
        
            // $id = $_GET['id'];
            // $session_id = $_GET['session_temp_id'];
            
            // $_SESSION['id'] = $id;
            // $_SESSION['session_temp_id'] = $session_id;
    
            $sc = new ServiceCalendar;
            // $datetimes_array = $sc->get_service_datetimes($id);
            // // $datetimes_array = $sc->get_session_datetimes($session_id);
            // $_SESSION['datetimes'] = $datetimes_array;
            // // var_dump($_SESSION['datetimes']);
                

            $month = $sc->show_service_calendar($currentMonth, $currentYear);
            echo $month;
        ?>
        
    </div>  
    <div class='error' id='datetime-error'></div>

    <style>
        .btns-wrapper {
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            margin-top: 10px;
        }
        .next-btn {                    
            max-width: 180px;
            border-radius: 1000px;
            display: flex;
            flex-direction: row;
            align-content: center;
            align-items: center;
            justify-content: space-between;
            border: none;
            padding: 12px 18px;
            font-size: 14px;
            line-height: 20px;
            min-width: 150px;
            transition: opacity .15s ease, background-color .15s ease, box-shadow .15s ease;
            display: inline-block;
            text-align: center;
            cursor: pointer;

            background: rgb(255, 145, 77);
            color: #fff;
            border-radius: 30px;
            padding: 10px 60px;
            border: 1px solid rgb(255, 145, 77);
            transition: .3s;
        }
    </style>

    <div class='btns-wrapper' style='justify-content: center;'>
        <span class='btn next-btn' onclick="save_availability()">Save</span>
    </div>
</div>



<script defer>
    function save_availability() {
        load_start();

        var formData = new FormData();
        
        formData.append('save_availability', 'true');

        fetch('./controllers/service-calendar-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            setTimeout(function() {
                load_end();
                console.log(response);
            }, 500);
        })
        .catch( err => console.log(err));
    }
</script>