<?php
if(!isset($_SESSION)) { 
    ob_start();
    session_start(); 
}
// var_dump()


/*
================================================================
    Month and weeks
================================================================
*/

function month_label($m, $y) {
    $timezone = new DateTimeZone('Europe/London');
    $date = new DateTime("$y-$m", $timezone);

    // Change format
    $month = $date->format('F');
    $year = $date->format('Y');


    return $month . ' ' . $year;
}
function generate_month_onclick_text($direction, $m, $y, $json_encoded_array) {
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
    return "onclick='get_month(event, {$month}, {$year}, {$json_encoded_array})'";
}
function generate_month_html($month_array, $m, $y, $preselected_array=array(), $json_encoded_array=null) {

    $html = '';
    $currentDate = new DateTime();

    foreach ($month_array as $week) {
        $html .= "<div class='col-md-12 col-sm-12'>";
        $html .= "<div class='inner'>";
        
        foreach ($week as $day) {
            $month = DateTime::createFromFormat('M', $day['month'])->format('n');
            $date = $day['year'] . '-' . $month . '-' . $day['date'];

            $dataDate =  $day['date'] . '-' . $month . '-' . $day['year'];
            
            $class = ($day['year'] == $y && $day['date'] >= 1 && $day['date'] <= 31)
                ? ''
                : ' prev-or-next-month';

            $dayOnClass = '';
            $onClick = "";

            // Check if the day is a past date
            $isPastDate = new DateTime($date) < $currentDate;

            // Add 'day-off' class for Saturdays and Sundays
            if ($day['dayOfWeek'] == 'Sat' || $day['dayOfWeek'] == 'Sun') {
                $class .= ' day-off';
            } else {
                // Add 'day-on' and 'sb-available-date' classes conditionally
                $dayOnClass = ($day['year'] == $y && !$isPastDate) ? ' day-on' . " onclick='get_week(event, {$day['date']}, {$month}, {$day['year']})'" : '';
                $onClick = (!$isPastDate) ? " onclick='set_date(event, {$day['date']}, {$month}, {$day['year']})'" : '';
                $sbAvailableDateClass = (!$isPastDate) ? ' sb-available-date' : ' day-off';
            }

            $dateFormat2 = $day['date'] . '-' . $month . '-' . $day['year'];


            if($json_encoded_array != null) {
                $preselected_array == json_decode($json_encoded_array, true);
            }
            if(count($preselected_array) > 0) {
                // Check if the provided date exists in the array
                $filteredDates = array_filter($preselected_array, function($item) use ($dateFormat2) {
                    

                    // Format the date to be consistent with the date being compared to
                    $dateParts = explode('-', $item['date']);

                    if (count($dateParts) === 3) {
                        // Assuming day, month, year format
                        $day = intval($dateParts[0]);
                        $month = intval($dateParts[1]);
                        $year = intval($dateParts[2]);

                        if (checkdate($month, $day, $year)) {
                            // Date is valid
                            $itemDate = $day . '-' . $month . '-' . $year;
                        }
                    }
                    // var_dump($item['date'], $dateFormat2);
                    // echo '</br></br>';
                    return $itemDate == $dateFormat2;
                });


                
                $dateSelectedClass = (count($filteredDates) > 0) ? 'date-selected' : '';
            } else {
                $dateSelectedClass = "";
            }

            
 

            


            $html .= "<div class='date $dateSelectedClass' data-date='$dataDate' $onClick>";
            $html .= "<a class='$class $dayOnClass $sbAvailableDateClass'>" . $day['date'] . "</a>";
            $html .= "</div>";
        }

        $html .= "</div>";
        $html .= "</div>";
    }

    return $html;
}
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
function show_month($m, $y, $preselected=array(), $json_encoded_array=null) {
    $month_array = get_month($m, $y);

    // var_dump($preselected);
    
    // Decode the selected dates from json
    if(isset($_SESSION['datetimes'])) {
        // echo 'datetimes exists';
        $preselected_array = json_decode($_SESSION['datetimes'], true);
    } else {
        if($json_encoded_array != null) {
            $preselected_array = json_decode($json_encoded_array, true);
        } else {
            if(count($preselected) > 0) {
                $preselected_array = $preselected;
            } else {
                $preselected_array = array();
            }
        }
    }

    // var_dump($preselected_array);

    $month_html = generate_month_html($month_array, $m, $y, $preselected_array);

    // Re-encode
    $preselected_json = json_encode($preselected_array, true);


    // Month label
    $month_label = month_label($m, $y);

    // Previous month
    $prev_month_onclick = generate_month_onclick_text(-1, $m, $y, $preselected_json);
    // Next month
    $next_month_onclick = generate_month_onclick_text(1, $m, $y, $preselected_json);

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
                            <div class='col-md-12 col-sm-12'>
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
function merchant_time_slot_popup($date, $time_slots_array) {
    // Session is already set
    if(isset($_SESSION['datetimes'])) {
        // echo 'datetimes exists';
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
                
                $selectedTimeClass = ($matchingTimeFound != false) ? 'time-selected' : '';
            } else {
                $selectedTimeClass = '';
            }
    
            // $formattedTime = date('H:i', $time_slot['time']);
    
            $full_datetime = $date. ' '.$time_slot['time'];
    
            // highlight3() is for merchants. It allows adding multiple time slots
            // highlight2() is for customers that only allows selecting a single time slot
            $html .= "<div onclick=\"highlight3(this);booking_slot('$full_datetime');\" class='time-slot free $selectedTimeClass' data-timeslot=\"$full_datetime\">
                <a class='cell sb-cell free'>
                    {$time_slot['time']}
                </a>
            </div>";
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        // array(
        //     array(
        //         'date' => '13-3-2024',
        //         'times' => array(
        //             array(
        //                 'time' => '6:00'
        //             ),
        //             array(
        //                 'time' => '6:30'
        //             ),
        //             array(
        //                 'time' => '7:00'
        //             ),
        //         )
        //     ),
        //     array(
        //         'date' => '14-3-2024',
        //         'times' => array(
        //             array(
        //                 'time' => '6:00'
        //             ),
        //             array(
        //                 'time' => '6:30'
        //             ),
        //             array(
        //                 'time' => '7:00'
        //             ),
        //         )
        //     ),
        // )
    
        // update_datetimes_session() will be different for customers
        // We'll only save a single date and time instead of multiple ones that merchants are allowed to
        echo "<div class='popup hide_popup' id='times-popup'>
            <div class='popup-inner-div'>
                <h2 class='popup-heading'>Select Time Slots</h2>
                       
                $html
    
                <div class='btns-wrapper' style='margin-top: 45px;'>
                    <span class='btn btn-back' onclick='closePopUp()'>Cancel</span>
                    <span class='btn btn-proceed' onclick='update_datetimes_session($date);'>Save</span>
                </div>
            </div>
        </div>";
    }
}

function customer_datetimes_session($date, $times) {
    if(isset($_SESSION['datetimes'])) {
        unset($_SESSION['datetimes']);
    }
    $times_array = array();
    foreach ($times as $time) {
        $time_array = array (
            'time' => $time
        );
        array_push($times_array, $time_array);
    }

    
    $datetime_array = array (
        'date' => $date,
        'times' => $times_array
    );

    // var_dump($product_data);
    array_push($datetimes_array, $datetime_array);

    
    $_SESSION['datetimes'] = json_encode($datetimes_array);
}
function merchant_datetimes_session($date, $times) {
    // var_dump($date, $times);

    // Decode times json
    $times = json_decode($times, true);
    // var_dump($times);

    // unset($_SESSION['datetimes']);
    // var_dump($_SESSION['cart']);

    // Session is already set
    if(isset($_SESSION['datetimes'])) {
        // echo 'atetimes exists';

        $datetimes_array = json_decode($_SESSION['datetimes'], true);

        var_dump($datetimes_array);

        $date_exists = false;

        if(count($datetimes_array) > 0) {
            foreach ($datetimes_array as $cart_datetimes_key => &$datetime) {
                // Date already exists
                if ($datetime['date'] == $date) {
                    if(count($times) > 0) {
                        $date_exists = true;
                        $times_array = array();
                        foreach ($times as $time) {
                            $time_array = array (
                                'time' => $time
                            );
                            array_push($times_array, $time_array);
    
                            $datetime['times'] = $times_array;
                        }
                    } else {
                        // Find the index of the value in the array
                        $index = array_search($datetime, $datetimes_array);
                        unset($datetimes_array[$index]);
                    }
                } 
            }
            unset($datetime);
        }


        // Add new product to cart if not found
        if(!$date_exists) { 

            $times_array = array();
            foreach ($times as $time) {
                $time_array = array (
                    'time' => $time
                );
                array_push($times_array, $time_array);
            }

            
            $datetime_array = array (
                'date' => $date,
                'times' => $times_array
            );

            // var_dump($product_data);
            array_push($datetimes_array, $datetime_array);
        }
        
        $_SESSION['datetimes'] = json_encode($datetimes_array);


    } else {
        $datetimes_array = array();
        $times_array = array();

        foreach ($times as $time) {
            $time_array = array (
                'time' => $time
            );
            array_push($times_array, $time_array);
        }

        
        $datetime_array = array (
            'date' => $date,
            'times' => $times_array
        );

        array_push($datetimes_array, $datetime_array);

        $_SESSION['datetimes'] = json_encode($datetimes_array);
    }
    var_dump($_SESSION['datetimes']);
}

/*
================================================================
    Weekly time slots
================================================================
*/
function generate_html($data) {
    $html = '';

    // var_dump($data);

    foreach ($data as $day) {

        // Holiday
        $holidayClass = '';
        if($day['dayOfWeek'] == 'Sat' || $day['dayOfWeek'] == 'Sun') {
            $holidayClass .= ' is-holiday';
        }

        $html .= '<div class="data-col">';
        $html .= '<div class="day-container'.$holidayClass.'">';
        $html .= '<div class="date">' . $day['date'] . '</div>';
        $html .= '<div class="border"></div>';
        $html .= '<div class="day">' . $day['dayOfWeek'] . '</div>';
        $html .= '</div>';
        $html .= '<div class="time-container">';
        $html .= '<div class="sb_time_slots_weekly_day_container">';

        // Assuming time slots from 9:00 AM to 5:00 PM
        $startTime = strtotime('09:00');
        $endTime = strtotime('17:00');


        // Generate time slots
        for ($time = $startTime; $time <= $endTime; $time += 3600) {
            $formattedTime = date('H:i', $time);

            $full_datetime = $day['day'].'-'.$day['month_num'].'-'.$day['year']. ' '.$formattedTime;

            if($day['dayOfWeek'] != 'Sat' && $day['dayOfWeek'] != 'Sun') {
                $html .= "<div onclick=\"highlight2(this);booking_slot('$full_datetime');\" class='time-slot free' data-timeslot=\"{$day['day']}-{$day['month_num']}-{$day['year']} $formattedTime\" style='height: 52px;'>
                    <a class='cell sb-cell free'>
                        $formattedTime
                    </a>
                </div>";
            } else {
                // $html .= '-';
            }
        }

        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
    }

    return $html;
}
function format_date_range($data) {
    // Parse the start and end dates using a custom format
    $start_date = DateTime::createFromFormat('M d Y', $data[0]['date'] . ' ' . $data[0]['year']);
    $end_date = DateTime::createFromFormat('M d Y', end($data)['date'] . ' ' . end($data)['year']);

    // Format the dates
    $formatted_start_date = $start_date->format('j F');
    $formatted_end_date = $end_date->format('j F');

    return $formatted_start_date . ' — ' . $formatted_end_date;
}
function get_previous_or_next_week($direction, $data) {
    // Validate the direction parameter
    if ($direction !== -1 && $direction !== 1) {
        return false; // Invalid direction
    }

    // Extract the year, month, and day from the first item in the data array
    $year = $data[0]['year'];
    $month = DateTime::createFromFormat('M d', $data[0]['date'])->format('n');
    $day = DateTime::createFromFormat('M d', $data[0]['date'])->format('j');

    // Create a new DateTime object for the current date
    $current_date = new DateTime("$year-$month-$day");

    // Adjust the date based on the direction
    $current_date->modify("{$direction} week");

    // Get the data for the new week
    $new_data = get_week($current_date->format('j'), $current_date->format('n'), $current_date->format('Y'));

    return $new_data;
}
function generate_onclick_text($week) {
    $day_of_month = DateTime::createFromFormat('M d', $week[0]['date'])->format('d');
    $month = DateTime::createFromFormat('M d', $week[0]['date'])->format('n');

    return "onclick=\"get_week(event, '{$day_of_month}', '{$month}', '{$week[0]['year']}')\"";
}

function get_week($day, $month, $year) {
    // Convert input to a DateTime object
    $date = new DateTime("$year-$month-$day");

    // Find the Monday of the week
    $date->modify('monday this week');

    // Initialize the result array
    $result = array();

    // Loop through the next 7 days (Monday to Sunday)
    for ($i = 0; $i < 7; $i++) {
        // Add the current date to the result array
        $result[$i]['day'] = $date->format("j");
        $result[$i]['date'] = $date->format("M j");
        $result[$i]['month'] = $date->format("M");
        $result[$i]['month_num'] = $date->format('n');
        $result[$i]['year'] = $date->format("Y");
        $result[$i]['dayOfWeek'] = $date->format("D");

        // Move to the next day
        $date->modify('+1 day');
    }
    // var_dump($result);
    return $result;
}
function show_week($d, $m, $y) {
    /*
        Takes day, month, year values as input and returns html
        for the week this date belongs to as output
    */

    $week_array = get_week($d, $m, $y);

    // var_dump($week_array);

    $week_columns = generate_html($week_array);


    $date_range = format_date_range($week_array);


    // Previous Week
    $previous_week = get_previous_or_next_week(-1, $week_array);
    $prev_week_onclick = generate_onclick_text($previous_week);
    // Next week
    $next_week = get_previous_or_next_week(1, $week_array);
    $next_week_onclick = generate_onclick_text($next_week);


    echo "<div class='col-sm-12'>
        <div class='row'>
    
    
            <div class='col-md-9 col-md-12 '>
                <div id='sb_group_booking_container' class='classes-plugin-group'></div>
                <div id='sb_timeview_container' class='section-wrapper'>
                    <div>
                        <div class='slots-weekly-view'>
                            <section class='slots-weekly-view-section section'>
                                <div class='timeline-wrapper'>
                                    <div class='tab-pd'>
                                        <div class='header'>
                                            <div class='row row-eq-height'>
                                                <div class='col-xs-3'>
                                                    <div class='txt-left'>
                                                        <div>
                                                            <a $prev_week_onclick class='sb-date-navigate'>
                                                                <span title='left arrow icon' class='fa fa-angle-left' aria-hidden='true'></span>
                                                                <span class='txt'>
                                                                    Prev week
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-xs-6'>
                                                    <div class='txt-center'>
                                                        <div>
                                                            $date_range
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-xs-3'>
                                                    <div class='txt-right'>
                                                        <div>
                                                            <a $next_week_onclick class='sb-date-navigate'>
                                                                <span class='txt'>
                                                                    Next week
                                                                </span>
                                                                <span title='right arrow icon' class='fa fa-angle-right' aria-hidden='true'></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div id='sb_time_slots_weekly_container' class='slots-weekly-timeline timeframe-60 fixed-scrollbar hide_unavailable-on '>
                                            $week_columns
                                        </div>
    
                                        <!-- <div class='time-legend'>
    
    
    
                                            <div class='available'>
                                                <div class='circle'></div> - Available
                                            </div>
    
    
    
                                        </div> -->
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
    
    
    
        </div>
    </div>";
}





?>