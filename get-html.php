<?php
    include './calendar-functions.php';


    if(isset($_GET['get_month'])) {
        $month = show_month($_GET['month'], $_GET['year'], array(), $_GET['selected']);
        echo $month;
    }
    
    if(isset($_GET['get_week'])) {
        show_week($_GET['day'], $_GET['month'], $_GET['year']);
    }




?>