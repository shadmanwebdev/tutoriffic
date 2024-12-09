<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    $fileDir = dirname(__FILE__);
    // $parentDir = dirname($fileDir);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/Ad.php');
    include('./Classes/ServiceCalendar.php');


    // Initialize the array
    $time_slots_array = array();

    // Start time
    $start_time = strtotime('00:00');
    $end_time = strtotime('23:45');

    // Loop through each 15-minute interval
    while ($start_time <= $end_time) {
        // Push formatted time into the array
        $time_slots_array[] = array(
            'time_id' => count($time_slots_array) + 1,
            'time' => date('H:i', $start_time)
        );

        // Move to the next 15-minute interval
        $start_time += 15 * 60; // 15 minutes in seconds
    }


    
    // Time slots
    $time_slots_array = array();
    $time_id = 1;

    for ($hour = 0; $hour < 24; $hour++) {
        for ($minute = 0; $minute < 60; $minute += 30) {
            $time = sprintf('%02d:%02d', $hour, $minute);
            $time_slots_array[] = array(
                'time_id' => $time_id,
                'time' => $time
            );
            $time_id++;
        }
    }


    $sc = new ServiceCalendar;
    $sc->customer_time_slot_popup($_GET['date'], $time_slots_array);



?>