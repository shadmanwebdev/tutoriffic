<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    include './calendar-functions.php';


    // Time slots
    $time_slots_array = array(
        array (
            'time_id' => 1,
            'time' => '6:00'
        ),
        array (
            'time_id' => 2,
            'time' => '6:15'
        ),
        array (
            'time_id' => 3,
            'time' => '6:30'
        ),
        array (
            'time_id' => 4,
            'time' => '6:45'
        ),
        array (
            'time_id' => 5,
            'time' => '7:00'
        )
    );
    // $time_slots_array = array(
    //     array (
    //         'time_id' => 1,
    //         'time' => '09:00'
    //     ),
    //     array (
    //         'time_id' => 2,
    //         'time' => '10:00'
    //     ),
    //     array (
    //         'time_id' => 3,
    //         'time' => '11:00'
    //     ),
    //     array (
    //         'time_id' => 4,
    //         'time' => '12:00'
    //     ),
    //     array (
    //         'time_id' => 5,
    //         'time' => '13:00'
    //     ),
    //     array (
    //         'time_id' => 6,
    //         'time' => '14:00'
    //     ),
    //     array (
    //         'time_id' => 7,
    //         'time' => '15:00'
    //     ),
    //     array (
    //         'time_id' => 8,
    //         'time' => '16:00'
    //     ),
    //     array (
    //         'time_id' => 9,
    //         'time' => '17:00'
    //     )
    // );
    

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

    merchant_time_slot_popup($_GET['date'], $time_slots_array);


?>