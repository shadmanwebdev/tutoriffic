<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    $fileDir = dirname(__FILE__);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/User.php');
    include('./Classes/Ad.php');
    include('./Classes/ServiceCalendar.php');


    if(isset($_GET['get_month'])) {
        $sc = new ServiceCalendar;
        $month = $sc->show_service_calendar($_GET['month'], $_GET['year']);
        echo $month;
    }

?>