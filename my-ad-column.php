<?php

    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set("display_errors","On");

    $fileDir = dirname(__FILE__);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/User.php');
    include('./Classes/Ad.php');
    
    if (isset($_GET['ad'])) {
        $ad_id = $_GET['ad'];
        $ad = new Ad;
        $my_ad = $ad->get_my_selected_ad($ad_id)[$ad_id];

        if (isset($_GET['column'])) {
            $column = $_GET['column'];
            $column_value = $my_ad[$column];

            if($column == 'ad_title') {
                echo "<div class='popup hide_popup' data-popup='ad_title'>
                    <div class='popup-inner-div'>
                        <h2 class='popup-heading'>Ad Title</h2>
                        <div class='a_title'>
                        
                            <div class='textarea-container'>
                                <textarea id='ad_title' name='ad_title' style='height: 128px;'>$column_value</textarea>
                                <div class='error' id='ad-title-error'></div>
                            </div>

                        </div>
                        <div class='btns-wrapper'>
                            <span class='btn btn-back' onclick='prevStep()'>Back</span>
                            <span class='btn btn-proceed' onclick='update_ad_title(event)'>Save</span>
                        </div>
                        <div class='message-response' id='message-response-1'></div>
                    </div>
                </div>";
            }
            else if($column == 'about_lesson') {
                echo "<div class='popup hide_popup' data-popup='about_lesson'>
                    <div class='popup-inner-div'>
                        <h2 class='popup-heading'>About Lesson</h2>
                        <div class='about_lesson'>
                        
                            <div class='textarea-container'>
                                <textarea id='about_lesson' name='about_lesson' style='height: 128px;'>$column_value</textarea>
                                <div class='error' id='ad-about-lesson-error'></div>
                            </div>
                            
                        </div>
                        <div class='btns-wrapper'>
                            <span class='btn btn-back' onclick='prevStep()'>Back</span>
                            <span class='btn btn-proceed' onclick='update_ad_about_lesson(event)'>Save</span>
                        </div>
                        <div class='message-response' id='message-response-2'></div>
                    </div>
                </div>";
            } 
            else if($column == 'about_tutor') {
                echo "<div class='popup hide_popup' data-popup='about_tutor'>
                    <div class='popup-inner-div'>
                        <h2 class='popup-heading'>About Tutor</h2>
                        <div class='about_tutor'>
                        
                            <div class='textarea-container'>
                                <textarea id='about_tutor' name='about_tutor' style='height: 128px;'>$column_value</textarea>
                                <div class='error' id='ad-about-tutor-error'></div>
                            </div>
        
                        </div>
                        
                        <div class='btns-wrapper'>
                            <span class='btn btn-back' onclick='prevStep()'>Back</span>
                            <span class='btn btn-proceed' onclick='update_ad_about_tutor(event)'>Save</span>
                        </div>
                        <div class='message-response' id='message-response-3'></div>
                    </div>
                </div>";
            } 
            else if($column == 'locations') {

                $locations_all = $ad->get_lesson_locations();

                $location_ids = [];
                foreach($column_value as $location) {
                    $location_ids[] = $location['lesson_location_id'];
                }


                $loc_checkboxes = "";

                foreach ($locations_all as $l) {

                    if (in_array($l["lesson_location_id"], $location_ids)) {
                        $check = 'checked';
                    } else {
                        $check = '';
                    }

                    $loc_checkboxes .= "<div class='custom-checkbox'>
                        <div class='custom-checkbox-inner'>
                            <input data-location-id='{$l['lesson_location_id']}' type='checkbox' id='custom-checkbox-{$l['lesson_location_id']}' $check>
                            <label for='custom-checkbox-{$l['lesson_location_id']}'></label>
                        </div>
                        <div class='checkbox-text'>
                            {$l['location_name']}
                        </div>
                    </div>";
                }
                echo "<div class='popup hide_popup' data-popup='locations'>
                    <div class='popup-inner-div'>
                        <h2 class='popup-heading'>Locations</h2>
                        <div class='locations'>

                            $loc_checkboxes

                        </div>
                        <div class='btns-wrapper'>
                            <span class='btn btn-back' onclick='prevStep()'>Back</span>
                            <span class='btn btn-proceed' onclick='save_lesson_locations()'>Save</span>
                        </div>
                    </div>
                </div>";
            } 
            else if($column == 'price') {
                echo "<div class='popup hide_popup' data-popup='price'>
                    <div class='popup-inner-div'>
                        <div class='price'>

                            <h2 class='popup-heading'>Price</h2>
                        
                            <div class='textarea-container'>
                                <input id='price' name='price' value='$column_value'>
                            </div>

                            
                            <div class='btns-wrapper'>
                                <span class='btn btn-back' onclick='prevStep()'>Back</span>
                                <span class='btn btn-proceed' onclick='nextStep()'>Next</span>
                            </div>


                        </div>
                    </div>
                </div>";
            }

        }
    }

?>

