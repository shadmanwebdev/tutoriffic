<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap-alt.css">
    <link rel="stylesheet" href="css/default.css?v=2"> -->

    <style>
        /* Error */
        .error {
            color: #ff6060;
            font-size: 14px;
            line-height: 2;
            padding: 0 4px;
        }
        .ms-response .error {
            text-align: center;
            line-height: 2.5;
            font-size: 14px;
            color: #ff6060;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</head>
<body id='m'>



<link rel="stylesheet" href="custom-calendar.css">


<div class='el-group tab-3 active-tab'>
    <div class='steps-btns' style='max-width: 1100px;'>
        <a onclick="switchTab2('el-group', 'tab-2', 'active-tab');" class="step-btn prev-button">
            <span>Previous</span>
        </a>
        <a onclick="switchTab2('el-group', 'tab-4', 'active-tab');" class="step-btn next-button">
            <span>Next</span>
        </a>
    </div>

    <!-- <div onclick="get_month(event, '1', '2024')">Get Month</div>
    <div onclick="get_week(event, '6', '1', '2024')">Get Week</div> -->

    <div class='container' id='month-wrapper'>
        <?php
            // Set the timezone
            $timezone = new DateTimeZone('Europe/London');
            // Create a new DateTime object with the specified timezone
            $date = new DateTime('now', $timezone);
            $currentDayOfWeek = $date->format("D");
            // Sat or Sun
            if($currentDayOfWeek == 'Sat') {
                $date->modify('+2 days');
            } else if($currentDayOfWeek == 'Sun') {
                $date->modify('+1 day');
            }


            // Get current date in numerical format (day)
            $currentDay = $date->format('d');
            // Get current month in numerical format
            $currentMonth = $date->format('n');
            // Get current year
            $currentYear = $date->format('Y');
            // Get current day of week
            $currentDayOfWeek = $date->format("D");
            
            include './calendar-functions.php';
            show_month($currentMonth, $currentYear);
        ?>
    </div>
    <div class='container' id='week-wrapper'>
        <?php

            show_week($currentDay, $currentMonth, $currentYear);
        ?>
    </div>

    
    <div id="sb_book_btn" class="btn" role="button" tabindex="0" onclick="submit('el-group', 'tab-3', 'active-tab')">
        <span>
            Next
        </span>
    </div>

</div>




<script src="js/custom-calendar.js" defer></script>




</body>
</html>