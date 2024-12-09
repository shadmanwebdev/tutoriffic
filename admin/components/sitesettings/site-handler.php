<?php
    include '../functions.php';
// include '../Interfaces/DataOperations.php';

    include '../Classes/Db.php';
    include '../Classes/SiteSettings.php';

    $settings = new SiteSettings();
    
    if(isset($_POST['update_site_settings'])) {
        $settings->update();
    }

?>