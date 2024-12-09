<?php
/*
=================================================================
    TIMES POP UP

=================================================================  
*/

class ServiceCalendar {
    public $con;
    public $ad;

    private static $instance = null;
    
    public function __construct() {
        $this->con = Db::getInstance()->con();
        $this->ad = Ad::getInstance();
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function save_availability() {
        $user_id = get_uid();

        // Dalete Old Availability
        $sql = "DELETE FROM user_availability WHERE user_id = ?";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        $stmt->bind_param("i", $user_id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        
        $stmt->close();



        // Get the datetimes
        $datetimes = json_decode($_SESSION['datetimes'], true);

        // Datetimes Loop
        foreach ($datetimes as $datetime) {
            // Date
            $selected_day = $datetime['date'];

            // Times for Date
            foreach ($datetime['times'] as $time) {
                $selected_time = trim($time['time']);

                // Insert Availability Row
                $sql = "INSERT INTO user_availability (user_id, selected_day, selected_time) VALUES (?, ?, ?)";
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param('iss', $user_id, $selected_day, $selected_time);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    
    // User availability
    function get_availability($user_id) {
        $sql = "SELECT selected_day, selected_time FROM user_availability WHERE user_id=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $availabilities = [];
        while ($row = $result->fetch_assoc()) {
            $date = $row['selected_day'];
            $time = trim($row['selected_time']);
            
            // Find the index of the date in the availabilities array
            $dateIndex = array_search($date, array_column($availabilities, 'date'));
            
            // If the date is not in the array, add it
            if ($dateIndex === false) {
                $availabilities[] = [
                    'date' => $date,
                    'times' => [
                        ['time' => $time]
                    ]
                ];
            } else {
                // If the date is already in the array, add the time to the existing times array
                $availabilities[$dateIndex]['times'][] = ['time' => $time];
            }
        }
        
        return $availabilities;
    }
    // Month Name   
    function month_label($m, $y) {
        $timezone = new DateTimeZone('Europe/London');
        $date = new DateTime("$y-$m", $timezone);

        // Change format
        $month = $date->format('F');
        $year = $date->format('Y');


        return $month . ' ' . $year;
    }
    // Next / Prev Month Onclick
    function generate_month_onclick_text($direction, $m, $y) {
        if ($direction !== -1 && $direction !== 1) {
            return false; // Invalid direction
        }
        $timezone = new DateTimeZone('Europe/London');
        // Create a new DateTime object for the current date
        $date = new DateTime("$y-$m", $timezone);

        // Adjust the date based on the direction
        $date->modify("{$direction} month");
        // Get previous or next month
        $month = $date->format('n');
        // Get year for previous or next month
        $year = $date->format('Y');


        // $selected_datetimes_json = json_encode($selected_array, true);

        // var_dump($month, $year);
        return "onclick='get_month(event, {$month}, {$year})'";
    }
    // Generate Month HTML
    function generate_calendar_month_html($month_array, $m, $y) {
        // var_dump($_SESSION['datetimes_2']);
        $html = '';
        $currentDate = new DateTime();

        $monthMap = [
            'Jan' => '1',
            'Feb' => '2',
            'Mar' => '3',
            'Apr' => '4',
            'May' => '5',
            'Jun' => '6',
            'Jul' => '7',
            'Aug' => '8',
            'Sep' => '9',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12'
        ];

        $pagename = get_pagename();

        $ad_id = (isset($_GET['ad_id'])) ? $_GET['ad_id'] : $_SESSION['ad_id'];

        if($pagename === 'schedule.php' || $pagename === 'schedule') {
            $user_id = $this->ad->get_single_ad($ad_id)['tutor_uid'];
        } else if($pagename === 'tutor-profile.php' || $pagename === 'tutor-profile') {
            $user_id = $this->ad->get_single_ad($_GET['a'])['tutor_uid'];
        } else {
            $user_id = get_uid();
        }
        
        // if(isset($_SESSION['datetimes'])) {
        //     unset($_SESSION['datetimes']);
        // }
        // var_dump($_SESSION['datetimes']);
        if(!isset($_SESSION['datetimes'])) {
            $availabilities = $this->get_availability($user_id);
            $_SESSION['datetimes'] = json_encode($availabilities, true);
        }
        
        $days_times = json_decode($_SESSION['datetimes'], true);
    
        foreach ($month_array as $week) {
            $html .= "<div class='' style='width: 100%;'>";
            $html .= "<div class='inner'>";
            
            foreach ($week as $day) {
                // Month in 'n' format
                $monthAbbrv = $day['month'];
                $month = $monthMap[$monthAbbrv];

                $date = $day['year'] . '-' . $month . '-' . $day['date'];
                $dataDate =  $day['date'] . '-' . $month . '-' . $day['year'];
                
                $class = ($day['year'] == $y && $day['date'] >= 1 && $day['date'] <= 31)
                    ? ''
                    : ' prev-or-next-month';
    
                $dayOnClass = '';
                $onClick = "";
    
                // Check if the day is a past date
                $isPastDate = new DateTime($date) < $currentDate;
            
                $dayOnClass = ($day['year'] == $y && !$isPastDate) ? ' day-on' : 'day-off';
                
                $onClick = (!$isPastDate) ? " onclick='set_date(event, {$day['date']}, {$month}, {$day['year']})'" : '';
                $sbAvailableDateClass = (!$isPastDate) ? ' sb-available-date' : ' day-off';
                
                $dateFormat2 = $day['date'] . '-' . $month . '-' . $day['year'];
                $dateSelectedClass = "";
    

                if(isset($_SESSION['datetimes'])) {
                    if ($day['year'] == $y && !$isPastDate && isset($_SESSION['datetimes'])) {
                        $datetimes_array = json_decode($_SESSION['datetimes'], true);
                        foreach ($datetimes_array as $datetime) {
                            // var_dump($date_obj['date'], $dataDate);
                            if ($datetime['date'] == $dataDate) {
                                $dateSelectedClass = 'date-selected';
                                break; // Stop checking once a match is found
                            }
                        }
                    }
                } 
                
                $customerDateSelectedClass = '';
                if(isset($_SESSION['datetimes_2'])) {
                    $datetimes_array_2 = json_decode($_SESSION['datetimes_2'], true);
                    // var_dump($datetimes_array_2);
                    
                        if ($datetimes_array_2["date"] === $dateFormat2) {
                            $customerDateSelectedClass = 'customer-date-selected';
                        }
                }




                if($month < $m) {
                    $hide = 'past-month-date';
                } else if ($month > $m) {
                    $hide = 'future-month-date';
                } else {
                    $hide = 'current-month-date';
                }
    
                $html .= "<div class='date $dateSelectedClass $customerDateSelectedClass $dayOnClass $hide' data-date='$dataDate' $onClick>";
                $html .= "<a class='$class $sbAvailableDateClass'>" . $day['date'] . "</a>";
                $html .= "</div>";
            }
    
            $html .= "</div>";
            $html .= "</div>";
        }
    
        return $html;
    }
    
    // Get Dates of Month
    function get_month($month, $year) {
        /* 
            Gets current month by default, 
            Prev and next months when the arrows are clicked
        */
        // Initialize the result array
        $result = array();

        // Create the first day of the month
        $firstDay = new DateTime("$year-$month-01");

        // Find the Monday of the week of the first day
        $firstDay->modify('monday this week');

        // Loop through the weeks
        for ($week = 0; $week < 6; $week++) {
            // Initialize the week array
            $monthArray = array();

            // Loop through the next 7 days (Monday to Sunday)
            for ($i = 0; $i < 7; $i++) {
                // Add the current date and month to the week array
                $monthArray[$i]['date'] = $firstDay->format("j");  // Use "j" for day without leading zero
                $monthArray[$i]['month'] = $firstDay->format("M");
                $monthArray[$i]['year'] = $firstDay->format("Y");
                $monthArray[$i]['dayOfWeek'] = $firstDay->format("D");

                // Move to the next day
                $firstDay->modify('+1 day');
            }

            // Add the week array to the result array
            $result[] = $monthArray;
        }

        return $result;
    }

    // Display
    function show_service_calendar($m, $y) {
        $month_array = $this->get_month($m, $y);

        $month_html = $this->generate_calendar_month_html($month_array, $m, $y);

        // Month label
        $month_label = $this->month_label($m, $y);

        // Previous month
        $prev_month_onclick = $this->generate_month_onclick_text(-1, $m, $y);
        // Next month
        $next_month_onclick = $this->generate_month_onclick_text(1, $m, $y);

        return "
            <div id='sb_dateview_container' class='section'>
                <div class='section-pd'>
                    <div class='top-date-select'>
                        <div class='header clearfix'>
                            <div class='row row-eq-height'>
                                <div class='col-xs-3'>
                                    <div class='txt-left'>
                                        <div $prev_month_onclick id='sb_prev_month' role='button' tabindex='0'>
                                            <span title='left arrow icon' class='fa fa-angle-left' aria-hidden='true'></span>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-xs-6'>
                                    <div class='txt-center'>
                                        <div>
                                            $month_label
                                        </div>
                                    </div>
                                </div>
                                <div class='col-xs-3'>
                                    <div class='txt-right'>
                                        <div $next_month_onclick id='sb_next_month' role='button' tabindex='0'>
                                            <span title='right arrow icon' class='fa fa-angle-right' aria-hidden='true'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='calendar' translate='no'>
                            <div class='weeks-name row-no-padding clearfix' style='display: flex;'>
                                <div class='' style='width: 100%;'>
                                    <div class='inner'>
                                        <div class='name'>Mon</div>
                                        <div class='name'>Tue</div>
                                        <div class='name'>Wed</div>
                                        <div class='name'>Thu</div>
                                        <div class='name'>Fri</div>
                                        <div class='name is-holiday'>Sat</div>
                                        <div class='name is-holiday'>Sun</div>
                                    </div>
                                </div>
                            </div>
                            <div class='weeks-date row-no-padding clearfix'>
                                $month_html
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    /*
    =================================================================
        TIMES POP UP
    =================================================================  
    */
    function merchant_time_slot_popup($date, $time_slots_array) {
        // Session is already set
        if(isset($_SESSION['datetimes'])) {
            // var_dump($_SESSION['datetimes']);
            $datetimes_array = json_decode($_SESSION['datetimes'], true);
        } else {
            $datetimes_array = array();
        }
        // var_dump($datetimes_array);
        /*
            1. We send the date to a php script and show selectable times popup
            2. To set availability the time slots will be all possible time slots
            3. To select booking the time slots will be slots selected by the merchant for that date
            4. We then show the pop up
        */
    
        // Check if date is not a past date
        $currentDate = new DateTime();
        $isPastDate = new DateTime($date) < $currentDate;
    
        // Date is not past date
        if(!$isPastDate) {
            // Time slots html
            $html = '';
            $html .= '<div class="day-container">';
            $html .= '<div class="date" id="date-for-times">' . $date . '</div>';
            $html .= '<div class="time-container">';
            $html .= '<div class="daily_time_slots_container">';
            foreach($time_slots_array as $time_slot) {
                $matchingTimeFound = false;
                if(count($datetimes_array) > 0) {
                    // var_dump($datetimes_array);
                    foreach ($datetimes_array as &$item) {
                        // var_dump($item);
                        $dateParts = explode('-', $item["date"]);
                    
                        if (count($dateParts) === 3) {
                            $day = intval($dateParts[0]);
                            $month = intval($dateParts[1]);
                            $year = intval($dateParts[2]);
                    
                            if (checkdate($month, $day, $year)) {
                                $formattedDate = $day . '-' . $month . '-' . $year;
                                $item["date"] = $formattedDate;
                            } else {
                                // Invalid date, handle accordingly
                            }
                        } else {
                            // Incorrect date format, handle accordingly
                        }
                    }
                    // Check if the provided date exists in the array
                    $filteredDates = array_filter($datetimes_array, function($item) use ($date) {
                        return $item['date'] == $date;
                    });
        
                        
                    // Check if the provided time exists in the filtered dates
                    $matchingTimeFound = false;
                    foreach ($filteredDates as $filteredDate) {
                        $ts = array_column($filteredDate['times'], 'time');
                        $trimmedTimesArray = array_map('trim', $ts);
                        // var_dump($time_slot['time'], $ts);
                        $matchingTimeFound = in_array($time_slot['time'], $trimmedTimesArray);
                        // var_dump($matchingTimeFound);
                        if ($matchingTimeFound) {
                            break;
                        }
                    }
                    
                    $selectedTimeClass = ($matchingTimeFound != false) ? 'merchant-time-selected' : '';
                } else {
                    $selectedTimeClass = '';
                }
        
                // $formattedTime = date('H:i', $time_slot['time']);
        
                $full_datetime = $date. ' '.$time_slot['time'];
        
                $html .= "<div onclick=\"highlight5(this);\" class='time-slot free $selectedTimeClass' data-timeslot=\"$full_datetime\">
                    <a class='cell sb-cell free'>
                        {$time_slot['time']}
                    </a>
                </div>";
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        
            echo "<div class='popup hide_popup' id='times-popup'>
                <div class='popup-inner-div'>
                    <h2 class='popup-heading'>Select Time Slots</h2>
                           
                    $html
        
                    <div class='btns-wrapper' style='margin-top: 45px;'>
                        <span class='btn btn-back' onclick='closePopup()'>Cancel</span>
                        <span class='btn btn-proceed' onclick='update_datetimes_session($date);'>Save</span>
                    </div>
                </div>
            </div>";
        }
    }
    function customer_time_slot_popup($date, $time_slots_array) {
        // Session is already set
        if(isset($_SESSION['datetimes'])) {
            $datetimes_array = json_decode($_SESSION['datetimes'], true);
        } else {
            $datetimes_array = array();
        }

        if(isset($_SESSION['datetimes_2'])) {
            $datetimes_array_2 = json_decode($_SESSION['datetimes_2'], true);
        } else {
            $datetimes_array_2 = array();
        }
        // var_dump($datetimes_array);
        /*
            1. We send the date to a php script and show selectable times popup
            2. To set availability the time slots will be all possible time slots
            3. To select booking the time slots will be slots selected by the merchant for that date
            4. We then show the pop up
        */
    
        // Check if date is not a past date
        $currentDate = new DateTime();
        $isPastDate = new DateTime($date) < $currentDate;
    
        // Date is not past date
        if(!$isPastDate) {
            // Time slots html
            $html = '';
            $html .= '<div class="day-container">';
            $html .= '<div class="date" id="date-for-times">' . $date . '</div>';
            $html .= '<div class="time-container">';
            $html .= '<div class="daily_time_slots_container">';
            foreach($time_slots_array as $time_slot) {
                $matchingTimeFound = false;
                if(count($datetimes_array) > 0) {
                    // var_dump($datetimes_array);
                    foreach ($datetimes_array as &$item) {
                        // var_dump($item);
                        $dateParts = explode('-', $item["date"]);
                    
                        if (count($dateParts) === 3) {
                            $day = intval($dateParts[0]);
                            $month = intval($dateParts[1]);
                            $year = intval($dateParts[2]);
                    
                            if (checkdate($month, $day, $year)) {
                                $formattedDate = $day . '-' . $month . '-' . $year;
                                $item["date"] = $formattedDate;
                            } else {
                                // Invalid date, handle accordingly
                            }
                        } else {
                            // Incorrect date format, handle accordingly
                        }
                    }
                    // Check if the provided date exists in the array
                    $filteredDates = array_filter($datetimes_array, function($item) use ($date) {
                        return $item['date'] == $date;
                    });
        
                        
                    // Check if the provided time exists in the filtered dates
                    $matchingTimeFound = false;
                    foreach ($filteredDates as $filteredDate) {
                        $ts = array_column($filteredDate['times'], 'time');
                        $trimmedTimesArray = array_map('trim', $ts);
                        // var_dump($time_slot['time'], $ts);
                        $matchingTimeFound = in_array($time_slot['time'], $trimmedTimesArray);
                        // var_dump($matchingTimeFound);
                        if ($matchingTimeFound) {
                            break;
                        }
                    }
                    
                    $selectedTimeClass = ($matchingTimeFound != false) ? 'merchant-time-selected' : '';
                } else {
                    $selectedTimeClass = '';
                }

                // var_dump($datetimes_array_2);
                if(is_array($datetimes_array_2)) {
                    $matchingTimeFound2 = false;
                    if(isset($datetimes_array_2['date'])) {
                        $dateParts = explode('-', $datetimes_array_2['date']);
                
                        if (count($dateParts) === 3) {
                            $day = intval($dateParts[0]);
                            $month = intval($dateParts[1]);
                            $year = intval($dateParts[2]);
                    
                            if (checkdate($month, $day, $year)) {
                                $formattedDate = $day . '-' . $month . '-' . $year;
                                $datetimes_array_2["date"] = $formattedDate;
                            } else {
                                // Invalid date, handle accordingly
                            }
                        }
                        
                        $filteredDates2 = ($datetimes_array_2['date'] == $date) ? $datetimes_array_2 : null;
            
                            
                        // Check if the provided time exists in the filtered dates
                        
                        if (isset($filteredDates2['time'])) {
                            $trimmedTime2 = trim($filteredDates2['time']);
                            // Check if the provided time matches the stored time
                            $matchingTimeFound2 = ($time_slot['time'] == $trimmedTime2);
                        }
                        
                    }
                    
                    $selectedTimeClassCustomer = ($matchingTimeFound2 != false) ? 'customer-select' : '';
                } else {
                    $selectedTimeClassCustomer = '';
                }
        
        
                // $formattedTime = date('H:i', $time_slot['time']);
        
                $full_datetime = $date. ' '.$time_slot['time'];
        
                $html .= "<div onclick=\"highlight4(this);\" class='time-slot free $selectedTimeClass $selectedTimeClassCustomer' data-timeslot=\"$full_datetime\">
                    <a class='cell sb-cell free'>
                        {$time_slot['time']}
                    </a>
                </div>";
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        
            echo "<div class='popup hide_popup' id='times-popup'>
                <div class='popup-inner-div'>
                    <h2 class='popup-heading'>Select Time Slots</h2>
                           
                    $html
        
                    <div class='btns-wrapper' style='margin-top: 25px;'>
                        <span class='btn btn-back' onclick='closePopup()'>Cancel</span>
                        <span class='btn btn-proceed' onclick='update_datetimes_session_customer($date);'>Save</span>
                    </div>
                </div>
            </div>";
        }
    }

    /*
    =================================================================
        Available Datetimes
    =================================================================  
    */
    public function get_gig_datetimes($gig_id) {

        $sql = "SELECT session_id FROM gig_sessions WHERE gig_id = ?";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        $stmt->bind_param("i", $gig_id);
        
        if($stmt->execute()) {
            $result = $stmt->get_result();
            // Initialize variables
            $sessionData = array();
    
            while ($row = $result->fetch_assoc()) {
                // Session Id
                $session_id = $row['session_id'];
    
                // Fetch data from the database
                $sql2 = "SELECT session_id, selected_day, selected_time FROM session_availability WHERE session_id=?";
                $stmt2 = $this->con->prepare($sql2);
                $stmt2->bind_param('i', $session_id);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
    
                if ($result2->num_rows > 0) {
                    // Initialize temporary array to store dates
                    $dates = array();
    
                    // Loop through each row
                    while($row2 = $result2->fetch_assoc()) {
                        $day = $row2['selected_day'];
                        $time = trim($row2['selected_time']); // Removing extra spaces
    
                        // Check if date already exists
                        $dateExists = false;
                        foreach ($dates as &$date) {
                            if ($date['date'] == $day) {
                                $date['times'][] = array('time' => $time);
                                $dateExists = true;
                                break;
                            }
                        }
                        unset($date);
    
                        // If date doesn't exist, add it to the array
                        if (!$dateExists) {
                            $dates[] = array(
                                'date' => $day,
                                'times' => array(
                                    array('time' => $time)
                                )
                            );
                        }
                    }
    
                    // Add session data to the array
                    $sessionData[] = array(
                        'session_temp_id' => $session_id,
                        'dts' => $dates
                    );
                }
    
                // Close
                $stmt2->close();
            }
            
        } else {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
    
        // Close
        $stmt->close();
    
        // Convert array to JSON
        $jsonData = json_encode($sessionData, true);
    
        return $jsonData;
    }

    /*
    =================================================================
        CUSTOMER
    =================================================================  
    */
    function merchant_datetimes_session($date, $times) {
        
        $datetimes_array = array();
        if(isset($_SESSION['datetimes'])) {
            // unset($_SESSION['datetimes']);
            $datetimes_array = json_decode($_SESSION['datetimes'], true);
            // var_dump($_SESSION['datetimes']);
        }

        // Decode json formatted times
        $times = json_decode($times, true);

        $times_array = array();
    
        foreach ($times as $time) {
            $time_array = array (
                'time' => $time
            );
            array_push($times_array, $time_array);
        }
        
        $new_datetime_array = array (
            'date' => $date,
            'times' => $times_array
        );

        $dateFound = false;
        
        foreach ($datetimes_array as $key => $datetime_array) {
            if($datetime_array['date'] == $date) {
                if(count($times_array) == 0) {
                    unset($datetimes_array[$key]);
                } else {
                    $datetimes_array[$key] = $new_datetime_array;
                }
                $dateFound = true;
                break;
            }
        }

        if(!$dateFound) {
            array_push($datetimes_array, $new_datetime_array);
        }
        
        // var_dump($datetimes_array);

        $_SESSION['datetimes'] = json_encode($datetimes_array);
        
    }
    function customer_datetimes_session($date, $time) {
        if(isset($_SESSION['datetimes_2'])) {
            unset($_SESSION['datetimes_2']);
        }
        
        $datetime_array = array (
            'date' => $date,
            'time' => $time
        );
        
        $_SESSION['datetimes_2'] = json_encode($datetime_array);
    
        
        var_dump($_SESSION['datetimes_2']);
    }
    function get_customer_datetimes_session() {
        if(isset($_SESSION['datetimes_2'])) {
            echo $_SESSION['datetimes_2'];
        } else {
            echo '';
        }
        
    }
    function remove_datetimes_session($session_temp_ids_json) {
        $session_temp_ids = json_decode($session_temp_ids_json, true);
    
        if(isset($_SESSION['datetimes'])) {
            var_dump('remove datetimes', $_SESSION['datetimes']);
            
            $datetimes = json_decode($_SESSION['datetimes'], true);
            foreach ($datetimes as $key => $session) {
                $session_temp_id = $session['session_temp_id'];
                // Check if the session name exists in $session_temp_ids
                if (!in_array($session_temp_id, $session_temp_ids)) {
                    // Remove the session from $datetimes
                    unset($datetimes[$key]);
                }
            }
            $_SESSION['datetimes'] = json_encode($datetimes);
        } else {

            $datetimes = $this->get_gig_datetimes($gig_id);
            foreach ($datetimes as $key => $session) {
                $session_temp_id = $session['session_temp_id'];
                // Check if the session name exists in $session_temp_ids
                if (!in_array($session_temp_id, $session_temp_ids)) {
                    // Remove the session from $datetimes
                    unset($datetimes[$key]);
                }
            }
            $_SESSION['datetimes'] = json_encode($datetimes);
        }
        var_dump($_SESSION['datetimes']);
    }
}

?>