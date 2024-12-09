<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    include './functions.php';
    include './Classes/Db.php';
    include './Classes/Ad.php';
    include('./Classes/ServiceCalendar.php');

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
    $sc->merchant_time_slot_popup($_GET['date'], $time_slots_array);


?>