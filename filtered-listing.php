<?php

    // var_dump($_POST);

    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/Ad.php');

    // $_POST['location_1'] = isset($_POST['location_1']) ? $_POST['location_1'] : NULL;
    // $_POST['location_2'] = isset($_POST['location_2']) ? $_POST['location_2'] : NULL;
    // $_POST['location_3'] = isset($_POST['location_3']) ? $_POST['location_3'] : NULL;
    // $subjects = isset($_POST['subjects']) ? json_decode($_POST['subjects'], true) : array();

    // var_dump($subjects);
    $ad = new Ad();
    // $user->showFilteredAds($_POST['price_min'], $_POST['price_max'], $_POST['rating_min'], $_POST['rating_max'], $_POST['location_1'], $_POST['location_2'], $_POST['location_3'], $subjects)
    $ad->showFilteredAds($_POST['subjects'])

?>