<?php
/*
=================================================================
    SESSIONS & COOKIES ad_locations
    CRUD
    DISPLAY
    LEVELS
    SCHEDULE
    SUBJECTS
    get_subject_popup_edit_ad(this)
    get_lesson_locations() my_ad()ad_subject_options_edit_ad(
=================================================================
*/


// Ads
class Ad {
    public $con;
    private static $instance = null;
    
    public function __construct() {
        $this->con = Db::getInstance()->con(); 
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function update_ad_subjects() {
        // $ad_id = $_POST['ad_id'];
        // $ad_array = $this->get_my_selected_ad($ad_id)[$ad_id];
        // $subj_ids = json_decode($_POST['subjects']);

        // // Retrieve existing subject IDs for the given ad_id
        // $existingSubjects = array_column($ad_array['subjects'], 'subj_id');

        // foreach ($subj_ids as $subj_id) {
        //     // Check if the subject ID is not already in the existing subjects array
        //     if (!in_array($subj_id, $existingSubjects)) {
        //         // Insert the subject ID into the database
        //         $stmt = $this->con->prepare("INSERT INTO ad_subjects (subj_id, ad_id) VALUES (?, ?)");
        //         $stmt->bind_param("ii", $subj_id, $ad_id);
        //         $stmt->execute();
        //     }
        // }



        // Assuming $this->con is your MySQLi connection

        // Decode the JSON payload from AJAX
        // $subject_data = json_decode($_POST['subject_data_json'], true);
        $subject_options = json_decode($_POST['subject_options_temp'], true);

        // // Extract values from JSON
        // $subj_id = $subject_data['subj_id'];
        // $subject_name = $subject_data['subject_name'];
        // $previously_selected = $subject_data['previously_selected'];
        // $ad_subject_details = json_encode($subject_data['ad_subject_details']);


        foreach($subject_options as $subject_option) {
            $subj_id = $subject_option['subj_id'];
            $ad_id = $subject_option['ad_id'];
            $subject_name = $subject_option['subject_name'];
            $previously_selected = $subject_option['previously_selected'];
    
            $edexcel = $subject_option['boards']['edexcel'];
            $aqa = $subject_option['boards']['aqa'];
            $ocr = $subject_option['boards']['ocr'];
            $gcse = $subject_option['levels']['gcse'];
            $alevel = $subject_option['levels']['alevel'];
            $price = $subject_option['price'];

            $subject_level = ($alevel =='yes') ? 'A-Level' : 'GCSE';

            if($previously_selected == 'no') {
                $stmt = $this->con->prepare("INSERT INTO ad_subjects (subj_id, ad_id, edexcel, aqa, ocr, gcse, subject_level, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('iisssss', $subj_id, $ad_id, $edexcel, $aqa, $ocr, $subject_level, $price);

                if($stmt->execute()) {   
                    $status = '1';
                } else {
                    $status = '0';
                    die('prepare() failed: ' . htmlspecialchars($this->con->error));
                    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }

                $stmt->close();
            }
        }




    }
    
    public function update_ad_locations() {
        $ad_id = $_POST['ad_id'];
        $lesson_location_ids = json_decode($_POST['selected_locations_json'], true);

        // var_dump($lesson_location_ids);

        // Delete previous ad locations for the specified ad
        $stmt = $this->con->prepare("DELETE FROM ad_locations WHERE ad_id = ?");
        $stmt->bind_param("i", $ad_id);
        $stmt->execute();
        $stmt->close();

        // Insert new ad locations
        $stmt = $this->con->prepare("INSERT INTO ad_locations (ad_id, lesson_location_id) VALUES (?, ?)");
        

        // Assuming you have an array of lesson_location_ids
        foreach ($lesson_location_ids as $lesson_location_id) {
            $stmt->bind_param("ii", $ad_id, $lesson_location_id);
            $stmt->execute();
        }

        $stmt->close();

        echo '1';
    }
    /*
    =================================================================
        DISPLAY
    =================================================================
    */
    
    public function tutur_ads_options($tutor_id) {
        $ads_array = $this->get_tutor_ads($tutor_id);

        $adsPopup = "<div class='popup hide_popup' id='select-ads-popup'>
            <h4 class='popup-title' style='font-size: 20px; margin-bottom: 20px;'>
                Select an ad to continue
            </h4>
            <div class='select-ads-wrapper'>
            <div class='radios-wrapper lesson-type-wrapper'>
                <div class='radios' style='position: relative;'>";

        foreach ($ads_array as $ad) {
            $ad_id = $ad['ad_id'];

            $subjects = $ad['subjects'];

            // var_dump($subjects);

                
            $gcseSubjects = [];
            $aLevelSubjects = [];
    
            foreach ($subjects as $subject) {
                if ($subject["subject_level"] === "GCSE") {
                    $gcseSubjects[] = $subject;
                } elseif ($subject["subject_level"] === "A-Level") {
                    $aLevelSubjects[] = $subject;
                }
            }

            $gcseSubjectsStr = "GCSE - ";
            $aLevelSubjectsStr = "A-Level - ";
            foreach($gcseSubjects as $gcseSubject) {
                $gcseSubjectsStr .= $gcseSubject['subject_name'];
            }
            foreach($aLevelSubjects as $aLevelSubject) {
                $aLevelSubjectsStr .= $aLevelSubject['subject_name'];
            }
            

            $adsPopup .= "<div class='radio-option'>
                <div class='radio-input-group'>
                    <div class='radio-input-inner'>
                        <input name='ad' id='ad' type='radio' value='{$ad_id}' checked>
                        <label class='radio-label radio-label-4 selected' for='free' onclick='select_tutor_ad(this)'></label>
                    </div>
                    <div>$gcseSubjectsStr, $aLevelSubjectsStr</div>
                </div>
            </div>";
        }
        // User is either student or tutor
        $account_type_id = user_account_type_id();
        if($account_type_id == 2) {
            // User is student
            $onClick = "onclick='select_ad_and_proceed()'";
        } else if($account_type_id == 3) {
            // User is tutor
            $student_id = $_GET['student_id'];
            $onClick = "onclick='select_ad_and_proceed($student_id)'";
        }

        $adsPopup .= "</div></div></div>
            <div class='booking-btns'>
                <div class='col-left'>
                    <button onclick='closePopup();' class='btn reject'>Cancel</button>
                </div>
                <div class='col-right'>
                    <button $onClick class='btn accept'>Continue</button>
                </div>
            </div>
        </div>";

        return $adsPopup;

    }
    public function profile_column($ad_id) {
        $adsArray = $this->get_single_ad($ad_id);

        $subjs = $adsArray['subjects'];
        
        $subjsStr = "";
        foreach ($subjs as $subj) {
            $subjsStr .= "<span class='subject' id='subj-id-{$subj['subj_id']}'>
                {$subj['subject_name']}
            </span>";
        }

        
        if(!empty($adsArray['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$adsArray['photo']}' />";
        } else {
            $str = $adsArray['firstname'];
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        // $price_int = intval($adsArray['price']);
        $price_int = 10;

        echo "<div class='card'>
            <div class='img-wrapper'>
                $photo
                <div class='annonce_price'>£{$price_int}</div>
            </div>

            <div class='name'>
                {$adsArray['firstname']}
            </div>

            <div class='review'>
                <span><i class='icon icon-star2'></i></span>
                <span>{$adsArray['avg_rating']} ({$adsArray['num_reviews']} reviews)</span>
            </div>




            <div class='check_radio' style='margin-top: 20px;'>
                <div class='MER_form' style='display: flex; flex-flow: row nowrap;'>
            
                    <label data-length='30 min' for='leslen1' class='component-checkbox-register checkbox'>
                    <input type='radio' class='js-showWhere' name='where' value='1' id='leslen1'>
                        30 min
                    </label>
            
                    <label data-length='1 hour' for='leslen2' class='component-checkbox-register checkbox checked'>
                    <input type='radio' class='js-hideWhere' name='where' value='2' id='leslen2' checked='checked'>
                        1 hour
                    </label>
            
                </div>
            </div>

        
        
            <script defer>
                classOnClick('checkbox', 'checked');
            </script>




        </div>";
    }
    public function tutor_profile($ad_id) {

        $ad = $this->get_single_ad($ad_id);

        $tutor_id = $ad['tutor_uid'];

        // $ad_schedules = $this->displayAdSchedulesHTML($tutor_id);


        // Subjects & Levels
        $subjs = $ad['subjects'];
        $ad_subjects = "";
        $aLevel = false;
        $gcse = false;
        $subject_level = "";

        // Subjects 
        foreach ($subjs as $subj) {
            $ad_subjects .= "<span class='subject' id='subj-id-{$subj['subj_id']}'>
                {$subj['subject_name']}
            </span>";

            // Levels
            if($gcse == false) {
                if ($subj["subject_level"] === "GCSE") {
                    $subject_level .= "<span class='subject'>
                        GCSE
                    </span>";
                    $gcse = true;
                }
            }
            if($aLevel == false) {
                if ($subj["subject_level"] === "A-Level") {
                    $subject_level .= "<span class='subject'>
                        A-Level
                    </span>";
                    $aLevel = true;
                }
            }
        }


        // $ad['typical_lessons']
        $typical_lessons = paragraphs($ad['typical_lessons']);
        $experiences = paragraphs($ad['experiences']);

        
        if(!empty($ad['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$ad['photo']}' />";
        } else {
            $str = $ad['firstname'];
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }


        /* 
            Contact button 
            
            only displayed if user viewing it
            isn't the same type of account as the profile
            being viewed

            3 = student account
        */
        $user_account_type_id = user_account_type_id();

        $contactBtn = "";
        if($user_account_type_id == '3') {
            $contactBtn = "<a class='btn contact-btn' href=\"./schedule?id={$ad['ad_id']}\">Contact</a>";
        }


        $tutor_profile = "<div class='content-row'>
            <div class='row no-gutters subjects'>          
                $subject_level
                $ad_subjects
            </div>
        </div>
        <div class='content-row'>
            <h2 data-role='title'>{$ad['firstname']}</h2>
        </div>
        <div class='content-row'>

            <div class='col-left'>
                <div class='col-left-inner'>
                    <div class='col-img'>
                        
                        <div class='img-wrapper'>
                            $photo
                        </div>

                    </div>

                    <div class='col-main-content'>

                        <div class='ad'>

                            <!-- <h1>Far far away, behind the word mountains</h1>
                            <h2>Lesson location</h2> -->


                            <div class='about-main'>
                                <h2 data-role='title'>About Lesson</h2>
                                <div class='text announce-experience-text' data-role='content'>
                                    $typical_lessons
                                </div>    
                            </div>
                            
                            <!-- <ul class='locations'>
                                <li>Online</li>
                            </ul> -->

                        </div>

                    </div>
                </div>
                <div class='content-middle'>

                    <ul class='profile-menu'>        
                        <li class=''><a href='#experience'>About me</a></li>
                        <li class=''><a href='#schedule'>Schedule</a></li>
                        <li class=''><a href='#'>Price</a></li>
                        <li class=''><a href='#reviews'>Reviews</a></li>
                        <li class=''><a href='#'>Videos</a></li>    
                    </ul>

                    <div id='experience' class='about-main' style='margin: 40px 120px 40px 0px;'>
                        <h2 data-role='title'>About Tutor</h2>
                        <div class='text announce-experience-text' data-role='content'>
                            $experiences
                        </div>      
                    </div>


                </div>
            </div>


            <div class='col-video'>

                <div style='width: 350px; height: 200px;'>
                    <iframe style='width: 350px; height: 197px;' src='https://www.youtube.com/embed/Df_bX6t7zuU?si=xvboBdfF4GbKAx4G' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>
                </div>


                <ul class='infos'>
                    <li>
                        <span class='label'>Hourly rate</span>
                        <span class='value'>£30</span>
                    </li>
                    <li>
                        <span class='label'>Response Time</span>
                        <span class='value'>3h</span>
                    </li>
                </ul>

                <div class='btns-wrapper'>
                    $contactBtn
                    <a class='btn favorite-btn' onclick='add_to_list()'>Add to Shortlist</a>
                    <a class='btn report-btn' onclick='popup(\"report-popup\")'>Report</a>
                </div>

            </div>
        </div>";

        echo $tutor_profile;
    }
    public function student_profile($user_id) {

        $student = $this->get_student_profile($user_id);

        // Subjects
        $subjs = $student['subjects'];
        $subjs_count = count($subjs);

        $subjsStr = "";
        foreach ($subjs as $subj) {
            $subjsStr .= "<span class='subject' id='subj-id-{$subj['subj_id']}'>
                {$subj['subject_name']}
            </span>";
        }


        // Levels
        $levels = $student['levels'];
        $levels_count = count($levels);

        $levelsStr = '';
        foreach ($levels as $level) {
            $levelsStr .= "<span class='subject'>
                {$level['level_name']}
            </span>";
        }


        if(!empty($student['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$student['photo']}' />";
        } else {
            $str = $student['firstname'];
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }



        $tutor_profile = "<div class='content-row'>
            <div class='row no-gutters subjects'>          
                $levelsStr
                $subjsStr
            </div>
        </div>
        <div class='content-row'>
            <h2 data-role='title'>{$student['firstname']}</h2>
        </div>
        <div class='content-row'>

            <div class='col-left'>
                <div class='col-left-inner'>
                    <div class='col-img'>
                        
                        <div class='img-wrapper'>
                            $photo
                        </div>

                        
                        <ul class='infos'>
                            <li>
                                <span class='label'>Response Time</span>
                                <span class='value'>3h</span>
                            </li>
                        </ul>

                        <div class='btns-wrapper'>
                            <a class='btn contact-btn' href=\"./schedule?id={$student['user_id']}\">Message</a>
                        </div>

                        <div class='btns-wrapper'>
                            <a class='btn favorite-btn' onclick='add_to_list()'>Add to Shortlist</a>
                        </div>

                    </div>
                </div>
            </div>


        </div>";

        echo $tutor_profile;
    }
    public function ad_str($ad) {
        $levelsStr = "";
        $l = $ad['ad_levels'][0];
        if(!empty($l['ad_level_1'])) {
            $levelsStr .= $l['ad_level_1'];
        }
        if(!empty($l['ad_level_1']) && !empty($l['ad_level_2'])) {
            $levelsStr .=  ', ';
        }
        if(!empty($l['ad_level_2'])) {
            $levelsStr .=  $l['ad_level_2'];
        }
        

        // // Lesson locations
        // if(count($ad['locations']) > 0) {
        //     $locationsStr = "(";
        //     foreach($ad['locations'] as $l) {
        //         $locationsStr .= $l['location_name'];
        //         $index = array_search($l, $ad['locations']);
        //         if($index + 1 < count($ad['locations'])) {
        //             $locationsStr .= ', ';
        //         }
        //     }
        //     $locationsStr .= ")";
        // }

        // $about_tutor = segment($ad['about_tutor'], 80);


        if(!empty($ad['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$ad['photo']}' />";
        } else {
            $str = $ad['firstname'];
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        return "
            <div class='profile-infos'>

                <div class='profile-header'>
                    <div class='fullname'>
                        <div class='firstname'>
                            <a href='./tutor-profile?a={$ad['ad_id']}' style='color: #000; text-decoration: underline;'>
                                {$ad['firstname']}
                            </a>
                        </div>
                        <div class='lastname'>
                            {$ad['lastname']}
                        </div>
                    </div>
                    <div class='header-icons'>
                        <a href='./schedule?id={$ad['ad_id']}'>
                            <i style='color: #616368; font-size: 28px; margin-right: 3px;' class='ion-ios-chatbubble-outline'></i>
                        </a>
                        <i style='font-size: 25px; margin-top: -3px;' class='icofont-heart'></i>
                    </div>
                </div>
                
                <div class='middle'>
                    <div class='img-wrapper'>
                        $photo
                    </div>
                    <div class='details'>
                        <div class='hourly-price'>
                            <span class='value'>£25/hr</span>
                        </div>
                        <div class='review'>
                            <div class='rating'>
                                <i class='icon icon-star2'></i>
                                <div>{$ad['avg_rating']}</div>
                            </div>
                            <div class='num-of-reviews'>
                                <div>
                                    <div>{$ad['num_reviews']}</div>
                                    <div>reviews</div>
                                </div>
                            </div>
                        </div>

                        <div class='middle-icons'>
                            <span style='color: #fff; background: #28a745'>
                                <i class='ion-ios-videocam-outline'></i>
                            </span>
                            <span style='color: #fff; background: rgb(253,197,0) /* background: rgb(277, 0, 0); */'>
                                <i class='ion-calendar'></i>
                            </span>
                        </div>

                    </div>
                </div>

                <div class='user-details'>
                    <div class='info-row'>
                        <div class='info-icon'>
                            <i class='fa fa-graduation-cap'></i>
                        </div>
                        <div class='degree'>$levelsStr</div>
                    </div>
                    <div class='info-row'>
                        <div class='info-icon'>
                            <i class='icofont-black-board'></i>
                        </div>
                        <div class='degree'>
                            {$ad['teaching_style']}
                        </div>
                    </div>
                    <div class='info-row'>
                        <div class='info-icon'>
                            <i class='icon icon-star2'></i>
                        </div>
                        <div class='degree'>
                            Motivation
                        </div>
                    </div>
                    <div class='info-row'>
                        <div class='info-icon'>
                            <i class='fa fa-road'></i>
                        </div>
                        <div class='degree'>
                            Future aspiration
                        </div>
                    </div>
                </div>

                <div class='btns-footer'>
                    <a href='schedule?id={$ad['ad_id']}' class='btn-validate'>Book free lesson</a>
                    <a href='schedule?id={$ad['ad_id']}' class='btn-validate btn-2' style='max-width: 120px;'>Message</a>
                </div>

            </div>
        ";

    }
    public function ads() {
        $ads = $this->get_ads();
        $adsStr = "";
        foreach($ads as $ad) {
            $adsStr .= $this->ad_str($ad);
        }
        echo $adsStr;
    }   
    public function searched_ads($subject, $level) {
        $ads = $this->get_searched_ads($subject, $level);
        $adsStr = "";
        foreach($ads as $ad) {
            $adsStr .= $this->ad_str($ad);
        }
        echo $adsStr;
    }
    public function single_ad($ad_id) {
        $adsArray = $this->get_single_ad($ad_id);

        $subjs = $adsArray[$ad_id]['subjects'];
        
        $subjsStr = "";
        foreach ($subjs as $subj) {
            $subjsStr .= "<span class='subject' id='subj-id-{$subj['subj_id']}'>
                {$subj['subject_name']}
            </span>";
        }

        
        if(!empty($adsArray[$ad_id]['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$adsArray[$ad_id]['photo']}' />";
        } else {
            $str = $adsArray[$ad_id]['firstname'];
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        echo "<div class='row'>
            <div class='col-md-8'>

                <div class='row no-gutters subjects'>
                    $subjsStr
                </div>

                <div class='ad'>
                    <h1>{$adsArray[$ad_id]['ad_title']}</h1>
                    <h2>Lesson location</h2>

                    <ul class='locations'>
                        <li>Online</li>
                    </ul>

                    <div class='about-main' style='margin: 40px 0;'>
                        <h2 data-role='title'>About Tutor</h2>
                        <p class='text announce-experience-text' data-role='content'>
                            {$adsArray[$ad_id]['about_lesson']}
                        </p>
                        
                    </div>
                    <div class='about-main' style='margin: 40px 0;'>
                        <h2 data-role='title'>About Lesson</h2>
                        <p class='text announce-experience-text' data-role='content'>
                            {$adsArray[$ad_id]['about_tutor']}
                        </p>
                    </div>

                </div>

            </div>
            <div class='col-md-4'>
                <div class='card'>
                    <div class='img-wrapper'>
                        $photo
                    </div>
                    <div class='name'>
                        {$adsArray[$ad_id]['firstname']}
                    </div>



                    <div class='review'>
                        <span><i class='icon icon-star2'></i></span>
                        <span>{$adsArray[$ad_id]['avg_rating']} ({$adsArray[$ad_id]['num_reviews']} reviews)</span>
                    </div>

                    <ul class='infos'>
                        <li>
                            <span class='label'>Hourly rate</span>
                            <span class='value'>£{$adsArray[$ad_id]['price']}</span>
                        </li>
                        <li>
                            <span class='label'>Response Time</span>
                            <span class='value'>3h</span>
                        </li>
                        <li>
                            <span class='label'>Number of students</span>
                            <span class='value'>50+</span>
                        </li>
                    </ul>
                    <div class='btns-wrapper'>
                        <a class='btn contact-btn' href='./schedule?id=$ad_id'>Contact</a>
                    </div>
                </div>
            </div>
        </div>";
    } 
    

    // Students
    public function get_student_profiles() {
        $stmt = $this->con->prepare("SELECT
                users.id as user_id,
                users.firstname,
                users.lastname,
                users.email,
                users.pwd,
                users.photo as user_photo,
                users.user_status,
                users.account_status,
                users.user_account_type_id,
                users.gender,
                users.date_of_birth,
                users.phone,
                users.skype_id,
                users.postal_address,
                users.certificate_file,
                users.identification_file,
                users.created_at,
                users.updated_at,
                reviews.review_id,
                reviews.ad_id,
                reviews.tutor_id,
                reviews.student_id,
                reviews.rating,
                reviews.review_content,
                reviews.created_at as review_created_at,
                student_levels.student_level_id as student_level_id,
                student_levels.level_id as level_id,
                student_levels.student_id as student_level_user_id,
                levels.level_name as level_name,
                student_languages.student_language_id,
                student_languages.language_id as language_id,
                student_languages.student_id as student_language_user_id,
                student_languages.fluency,
                student_subjects.id as student_subject_id,
                student_subjects.subj_id as student_subject_subj_id,
                subjects.subject_name
            FROM
                users
            LEFT JOIN
                reviews ON users.id = reviews.student_id
            LEFT JOIN
                student_levels ON users.id = student_levels.student_id
            LEFT JOIN
                levels ON student_levels.level_id = levels.level_id
            LEFT JOIN
                student_languages ON users.id = student_languages.student_id
            LEFT JOIN
                student_subjects ON users.id = student_subjects.student_id
            LEFT JOIN
                subjects ON student_subjects.subj_id = subjects.subj_id
            WHERE
                users.user_account_type_id = 2
            ORDER BY
                users.id
        ");
    
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }  
    
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();

         
        // All ids inserted are unique so we can always check for duplicates
        $std_level_ids = array();
        $std_language_ids = array();
        $std_subject_ids = array();
        $std_reviews_ids = array();
        
        while ($row = $result->fetch_assoc()) {
            $userId = $row['user_id'];
        
            // Check if the user is already in the result array
            if (!isset($data[$userId])) {
                // If not, add the user with basic information
                $data[$userId] = array(
                    'user_id' => $userId,
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'email' => $row['email'],
                    'pwd' => $row['pwd'],
                    'photo' => $row['user_photo'],
                    'user_status' => $row['user_status'],
                    'account_status' => $row['account_status'],
                    'user_account_type_id' => $row['user_account_type_id'],
                    'gender' => $row['gender'],
                    'date_of_birth' => $row['date_of_birth'],
                    'phone' => $row['phone'],
                    'skype_id' => $row['skype_id'],
                    'postal_address' => $row['postal_address'],
                    'certificate_file' => $row['certificate_file'],
                    'identification_file' => $row['identification_file'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                    'reviews' => array(),
                    'languages' => array(),
                    'levels' => array(),
                    'subjects' => array()
                );
            }
            
            // Add reviews data
            if(!in_array($row['review_id'], $std_reviews_ids)) {
                $data[$userId]['reviews'][] = array(
                    'review_id' => $row['review_id'],
                    'ad_id' => $row['ad_id'],
                    'tutor_id' => $row['tutor_id'],
                    'student_id' => $row['student_id'],
                    'rating' => $row['rating'],
                    'review_content' => $row['review_content'],
                    'review_created_at' => $row['review_created_at']
                );
                array_push($std_reviews_ids, $row['review_id']);
            }
    
            // Add student levels data
            if(!in_array($row['student_level_id'], $std_level_ids)) {
                $data[$userId]['levels'][] = array(
                    'student_level_id' => $row['student_level_id'],
                    'level_id' => $row['level_id'],
                    'level_name' => $row['level_name']
                );
                array_push($std_level_ids, $row['student_level_id']);
            }
            
            // var_dump($std_level_ids );
            
            // Add student languages data
            if(!in_array($row['student_language_id'], $std_language_ids)) {
                $data[$userId]['languages'][] = array(
                    'student_language_id' => $row['student_language_id'],
                    'language_id' => $row['language_id'],
                    'fluency' => $row['fluency']
                );
                array_push($std_language_ids, $row['student_language_id']);
            }
    
            // Add student subjects data with subject_name
            if(!in_array($row['student_subject_id'], $std_subject_ids)) {
                $data[$userId]['subjects'][] = array(
                    'student_subject_id' => $row['student_subject_id'],
                    'subj_id' => $row['student_subject_subj_id'],
                    'subject_name' => $row['subject_name']
                );
                array_push($std_subject_ids, $row['student_subject_id']);
            }
        }
    
        return $data;
    }
    public function get_student_profile($user_id) {
        $students = $this->get_student_profiles($user_id);
        foreach($students as $student) {
            $stdId = $student['user_id'];
            if($stdId == $user_id) {
                return $student;
            }
        }
    }
    

    public function student_listing_item($ad) {

        // var_dump($ad);
        
        // Subjects
        $subjs = $ad['subjects'];
        $subjs_count = count($subjs);

        $s = 1;
        $subjsStr = '';
        foreach ($subjs as $subj) {
            $subjsStr .= $subj['subject_name'];

            if($s < $subjs_count) {
                $subjsStr .= ', ';
            }
            $s += 1;
        }


        // Levels
        $levels = $ad['levels'];
        $levels_count = count($levels);

        $l = 1;
        $levelsStr = '';
        foreach ($levels as $level) {
            $levelsStr .= $level['level_name'];

            if($l < $levels_count) {
                $levelsStr .= ', ';
            }
            $l += 1;
        }


        if(!empty($ad['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$ad['photo']}' />";
        } else {
            $str = $ad['firstname'];
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        return "
            <div class='profile-infos'>

                <div class='profile-header'>
                    <div class='fullname'>
                        <div class='firstname'>
                            <a href='./student-profile?s={$ad['user_id']}' style='color: #000; text-decoration: underline;'>
                                {$ad['firstname']}
                            </a>
                        </div>
                        <div class='lastname'>
                            {$ad['lastname']}
                        </div>
                    </div>
                    <div class='header-icons'>
                        <a href='./student-profile?s={$ad['user_id']}'>
                            <i style='color: #616368; font-size: 28px; margin-right: 3px;' class='ion-ios-chatbubble-outline'></i>
                        </a>
                        <i style='font-size: 25px; margin-top: -3px;' class='icofont-heart'></i>
                    </div>
                </div>
                
                <div class='middle'>
                    <div class='img-wrapper'>
                        $photo
                    </div>
                    <div class='details'>
                        

                    </div>
                </div>

                <div class='user-details'>
                    <div class='info-row'>
                        <div class='info-icon' style='font-size: 15px; margin-top: 5px;'>
                            Level: 
                        </div>
                        <div class='degree'>$levelsStr</div>
                    </div>
                    <div class='info-row'>
                        <div class='info-icon' style='font-size: 15px; margin-top: 5px;'>
                            Subjects: 
                        </div>
                        <div class='degree'>$subjsStr</div>
                    </div>
                </div>

                <div class='btns-footer'>
                    <a href='./student-profile?s={$ad['user_id']}' class='btn-validate btn-2' style='max-width: 120px;'>Message</a>
                </div>

            </div>
        ";

    }
    public function student_listing() {
        $stds = $this->get_student_profiles();
        $stdsStr = "";
        foreach($stds as $std) {
            $stdsStr .= $this->student_listing_item($std);
        }
        echo $stdsStr;
    }  
    public function get_searched_student_profiles($subject_id, $level_id) {
        $stdArray = $this->get_student_profiles();
    
        if ($subject_id != '') {
            $subject_array = $this->get_subject($subject_id);
            $subject_name = $subject_array[0]['subject_name'];
        } else {
            $subject_name = '';
        }
    
        if ($level_id != '') {
            $level_array = $this->get_level($level_id);
            $level_name = $level_array[0]['level_name'];
        } else {
            $level_name = '';
        }
    
        // Convert the subject name to lowercase
        $lowercaseSubjectName = strtolower($subject_name);
    
        // Filter the array based on the given subject name and level
        $filteredAds = array_filter($stdArray, function ($std) use ($lowercaseSubjectName, $level_name) {
            // Check if the subject is not empty and there is a match
            $subjectMatch = empty($lowercaseSubjectName) || in_array($lowercaseSubjectName, array_map('strtolower', array_column($std['subjects'], 'subject_name')));
    
            // Check if the level is not empty and there is a match in the 'ad_levels' array
            $levelMatch = empty($level_name) || array_filter($std['levels'], function ($stdLevel) use ($level_name) {
                return in_array($level_name, $stdLevel); // Fix the variable name here
            });
    
            // Return true if either subject or level matches (or both, depending on whether they are empty or not)
            return $subjectMatch && $levelMatch;
        });
    
        return $filteredAds;
    }
    public function search_student_profiles($subject, $level) {
        // Get all searched students
        $students_array = $this->get_searched_student_profiles($subject, $level);
        $stdsStr = "";

        // Loop
        foreach($students_array as $student_array) {
            $stdsStr .= $this->student_listing_item($student_array);
        }

        
        echo $stdsStr;
    }

    /*
    =================================================================
        CRUD (create, read, update, delete)
    =================================================================
    */
    public function create_ad_2() {

        $levels = $_POST['levels'];
        $alevel_subjects = $_POST['alevel_subjects'];
        $gcse_subjects = $_POST['gcse_subjects'];
        $languages = $_POST['languages'];
        $preferred = $_POST['preferred'];
        $recorded_lesson = $_POST['recorded_lesson'];
        $exam_board = $_POST['exam_board'];
        $free_lessons = $_POST['free_lessons'];
        $teaching_style = $_POST['teaching_style'];
        $highest_qualification_level = $_POST['highest_qualification_level'];
        $lengths = $_POST['lengths'];
        $schedule = $_POST['schedule'];
        $experiences = $_POST['experiences'];
        $current_activity = $_POST['current_activity'];
        $aspirations = $_POST['aspirations'];
        $motivations = $_POST['motivations'];
        $typical_lesson = $_POST['typical_lesson'];

        $tutor_uid = 1; // get_uid()

        // var_dump($preferred, $recorded_lesson, $exam_board, $free_lessons, $teaching_style, $highest_qualification_level, $experiences, $current_activity, $aspirations, $motivations, $typical_lesson);
        

        // Insert data into the ads table
        $sqlAds = "INSERT INTO ads (preferred, recorded_lesson, exam_board, free_lessons, teaching_style, highest_qualification_level, experiences, current_activity, aspirations, motivations, typical_lessons, tutor_uid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtAds = $this->con->prepare($sqlAds);
        if (!$stmtAds) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmtAds->bind_param("sssssssssssi", $preferred, $recorded_lesson, $exam_board, $free_lessons, $teaching_style, $highest_qualification_level, $experiences, $current_activity, $aspirations, $motivations, $typical_lesson, $tutor_uid);
        if($stmtAds->execute()) {
            $status = '1';
        } else {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }

        // Get the ad_id of the inserted ad
        $ad_id = $stmtAds->insert_id;

        // Insert data into the ad_levels table
        $levelsArray = explode(',', $levels);
        $sqlAdLevels = "INSERT INTO ad_levels (ad_id, ad_level_1, ad_level_2) VALUES (?, ?, ?)";
        if (!$sqlAdLevels) {
            die("Prepare failed: " . $this->con->error);
        } 
        $stmtAdLevels = $this->con->prepare($sqlAdLevels);
        $stmtAdLevels->bind_param("iss", $ad_id, $ad_level_1, $ad_level_2);

        foreach ($levelsArray as $level) {
            $ad_level_1 = ($level == 'a-level') ? $level : null;
            $ad_level_2 = ($level == 'gcse') ? $level : null;
            $stmtAdLevels->execute();
        }

        // Insert data into the subjects table
        $alevelSubjectsArray = json_decode($alevel_subjects, true);
        $gcseSubjectsArray = json_decode($gcse_subjects, true);

        $sqlAdSubjects = "INSERT INTO ad_subjects (ad_id, subj_id, edexcel, aqa, ocr, subject_level, price_hourly) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if (!$sqlAdSubjects) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmtAdSubjects = $this->con->prepare($sqlAdSubjects);
        $stmtAdSubjects->bind_param("iisssss", $ad_id, $subj_id, $edexcel, $aqa, $ocr, $subject_level, $price_hourly);

        foreach ($alevelSubjectsArray as $subject) {
            // var_dump($subject['boardNames']);
            
            $subject_level = 'A-Level';
            $subj_id = $subject['subjectId'];
            $edexcel = (in_array('Edexcel', $subject['boardNames'])) ? 'yes' : 'no';
            $aqa = (in_array('AQA', $subject['boardNames'])) ? 'yes' : 'no';
            $ocr = (in_array('OCR', $subject['boardNames'])) ? 'yes' : 'no';
            $price_hourly = $subject['price'];
            $stmtAdSubjects->execute();
        }

        foreach ($gcseSubjectsArray as $subject) {
            $subject_level = 'GCSE';
            $subj_id = $subject['subjectId'];
            $edexcel = (in_array('Edexcel', $subject['boardNames'])) ? 'yes' : 'no';
            $aqa = (in_array('AQA', $subject['boardNames'])) ? 'yes' : 'no';
            $ocr = (in_array('OCR', $subject['boardNames'])) ? 'yes' : 'no';
            $price_hourly = $subject['price'];
            $stmtAdSubjects->execute();
        }

        // var_dump($ad_id, $language_id, $fluency);

        // Insert data into the languages table
        $languagesArray = json_decode($languages, true);
        $sqlAdLanguages = "INSERT INTO ad_languages (ad_id, language_id, fluency) VALUES (?, ?, ?)";
        if (!$sqlAdLanguages) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmtAdLanguages = $this->con->prepare($sqlAdLanguages);
        $stmtAdLanguages->bind_param("iis", $ad_id, $language_id, $fluency);

        foreach ($languagesArray as $language) {
            $language_id = $language['languageId'];
            $fluency = $language['fluency'];
            $stmtAdLanguages->execute();
        }

        // Insert data into the ad_schedule table
        $scheduleArray = json_decode($schedule, true);
        $sqlAdSchedule = "INSERT INTO ad_schedule (ad_id, day_of_week, time_1, time_2, time_3, time_4) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtAdSchedule = $this->con->prepare($sqlAdSchedule);
        if (!$stmtAdSchedule) {
            die("Prepare failed: " . $this->con->error);
        } 
        $stmtAdSchedule->bind_param("isssss", $ad_id, $day_of_week, $time_1, $time_2, $time_3, $time_4);

        foreach ($scheduleArray as $scheduleItem) {
            $day_of_week = $scheduleItem['dayId'];
            $timeIds = $scheduleItem['timeIds'];
            $time_1 = (in_array('1', $timeIds)) ? 'morning (7am - 12pm)' : null;
            $time_2 = (in_array('2', $timeIds)) ? 'afternoon (12pm - 5pm)' : null;
            $time_3 = (in_array('3', $timeIds)) ? 'evening (5pm-10pm)' : null;
            $time_4 = (in_array('4', $timeIds)) ? 'night (11pm - 7am)' : null;
            $stmtAdSchedule->execute();
        }

        // Insert data into the ad_lesson_lengths table
        $lengthsArray = json_decode($lengths, true);
        $sqlAdLessonLengths = "INSERT INTO ad_lesson_lengths (ad_id, lesson_length) VALUES (?, ?)";
        $stmtAdLessonLengths = $this->con->prepare($sqlAdLessonLengths);
        if (!$stmtAdLessonLengths) {
            die("Prepare failed: " . $this->con->error);
        } 
        $stmtAdLessonLengths->bind_param("is", $ad_id, $lesson_length);

        foreach ($lengthsArray as $length) {
            $lesson_length = $length['value'];
            $stmtAdLessonLengths->execute();
        }

        // Close prepared statements
        $stmtAds->close();
        $stmtAdLevels->close();
        $stmtAdSubjects->close();
        $stmtAdLanguages->close();
        $stmtAdSchedule->close();
        $stmtAdLessonLengths->close();

    }
    public function create_ad() {
        
        // Given data in separate variables
        $ad_title = $_POST["ad_title"];
        $about_lesson = $_POST["about_lesson"];
        $about_tutor = $_POST["about_tutor"];
        $location = $_POST["location"];
        $price = $_POST["price"];

        $home = isset($_POST["home"]) ? true : false;
        $travel = isset($_POST["travel"]) ? true : false;

        $phone = $_POST["phone"];

        

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['photo']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../assets/ads/'; // Update this path to your desired directory
        
            // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
            $newFilename = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
        
            // Construct the full path to save the image
            $imagePath = $imageDirectory . $newFilename;
        
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $imagePath)) {
                // Image uploaded successfully
            } else {
                // Handle the case where the image could not be moved
                $newFilename = '';
            }
        } else {
            // Handle the case where no image was provided
            $newFilename = '';
        }

        
        // SQL statement for insertion into your_table_name
        $sql = "INSERT INTO ads (ad_title, about_lesson, about_tutor, ad_location, phone, price, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $this->con->prepare($sql);
        
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        
        // Bind the parameters
        $stmt->bind_param("sssssss", $ad_title, $about_lesson, $about_tutor, $location, $phone, $price, $newFilename);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Get the last inserted ad_id
            $adId = $this->con->insert_id;
            

            $subjectCheckboxes = [];
            foreach ($_POST as $name => $value) {
                if (strpos($name, 'checkbox_') === 0) {
                    $subjectName = substr($name, 9); // Remove "checkbox_" prefix
                    $subjectCheckboxes[$subjectName] = $value;
                }
            }

            foreach ($subjectCheckboxes as $subjectName => $checkbox) {
                if ($checkbox === "on") {
                    // Check if the subject exists in the "subjects" table
                    $sql = "SELECT subj_id FROM subjects WHERE subject_name = ?";
                    $stmt = $this->con->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("s", $subjectName);
                        $stmt->execute();
                        $stmt->bind_result($subjId);
                        $stmt->fetch();
                        $stmt->close();

                        if ($subjId) {
                            // Insert into "ad_subjects" table
                            $sql = "INSERT INTO ad_subjects (subj_id, ad_id) VALUES (?, ?)";
                            $stmt = $this->con->prepare($sql);

                            if ($stmt) {
                                $stmt->bind_param("ii", $subjId, $adId);
                                $stmt->execute();
                            }
                        }
                    }
                }
            }

            echo "Data inserted successfully.";




        
            // Check and insert locations into ad_locations table
            $locations = [];
            if ($home) {
                $locations[] = 1; // Assuming 1 is the ID for 'home' in lesson_locations
            }
            if ($travel) {
                $locations[] = 2; // Assuming 2 is the ID for 'travel' in lesson_locations
            }
        
            foreach ($locations as $locationId) {
                $sql = "INSERT INTO ad_locations (ad_id, lesson_location_id) VALUES (?, ?)";
                $stmt = $this->con->prepare($sql);
        
                if ($stmt) {
                    $stmt->bind_param("ii", $adId, $locationId);
                    $stmt->execute();
                }
            }
        
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement and the database connection
        $stmt->close();
        
    }
    public function get_tutor_ads($tutor_uid) {
        $stmt = $this->con->prepare("SELECT
                ads.ad_id,
                ads.preferred,
                ads.recorded_lesson,
                ads.exam_board,
                ads.free_lessons,
                ads.teaching_style,
                ads.highest_qualification_level,
                ads.experiences,
                ads.current_activity,
                ads.aspirations,
                ads.motivations,
                ads.typical_lessons,
                ads.tutor_uid,
                ad_subjects.ad_subject_id,
                ad_subjects.subject_level,
                ad_subjects.price_hourly,
                ad_subjects.edexcel,
                ad_subjects.aqa,
                ad_subjects.ocr,
                subjects.subj_id,
                subjects.subject_name,
                lesson_locations.lesson_location_id,
                lesson_locations.location_name,
                users.firstname,
                users.lastname,
                users.photo,
                users.photo as user_photo,
                reviews.review_id,
                reviews.rating,
                ad_levels.ad_level_1,
                ad_levels.ad_level_2,
                ad_languages.language_id,
                ad_languages.fluency,
                ad_schedule.schedule_id,
                ad_schedule.day_of_week,
                ad_schedule.time_1,
                ad_schedule.time_2,
                ad_schedule.time_3,
                ad_schedule.time_4
            FROM
                ads
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            LEFT JOIN
                reviews ON ads.ad_id = reviews.ad_id
            LEFT JOIN
                ad_subjects ON ads.ad_id = ad_subjects.ad_id
            LEFT JOIN
                subjects ON ad_subjects.subj_id = subjects.subj_id
            LEFT JOIN
                ad_locations ON ads.ad_id = ad_locations.ad_id
            LEFT JOIN
                lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
            LEFT JOIN
                ad_levels ON ads.ad_id = ad_levels.ad_id
            LEFT JOIN
                ad_languages ON ads.ad_id = ad_languages.ad_id
            LEFT JOIN
                ad_schedule ON ads.ad_id = ad_schedule.ad_id
            WHERE
                ads.tutor_uid = ?
            ORDER BY ads.ad_id, subjects.subject_name, lesson_locations.location_name
        ");
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmt->bind_param('i', $tutor_uid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();
        
        while ($row = $result->fetch_assoc()) {
            $adId = $row['ad_id'];
        
            // Check if the ad is already in the result array
            if (!isset($data[$adId])) {
                // If not, add the ad with basic information
                $data[$adId] = array(
                    'ad_id' => $adId,
                    'preferred' => $row['preferred'],
                    'recorded_lesson' => $row['recorded_lesson'],
                    'exam_board' => $row['exam_board'],
                    'free_lessons' => $row['free_lessons'],
                    'teaching_style' => $row['teaching_style'],
                    'highest_qualification_level' => $row['highest_qualification_level'],
                    'experiences' => $row['experiences'],
                    'current_activity' => $row['current_activity'],
                    'aspirations' => $row['aspirations'],
                    'motivations' => $row['motivations'],
                    'typical_lessons' => $row['typical_lessons'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'photo' => $row['photo'],
                    'tutor_uid' => $row['tutor_uid'],
                    'subjects' => array(),
                    'locations' => array(),
                    'reviews' => array(),
                    'num_reviews' => 0,
                    'avg_rating' => 0,
                    'ad_levels' => array(),
                    'ad_languages' => array(),
                    'ad_schedule' => array(),
                );
            }
    
            // Check if this review has not been counted for this ad
            if (!isset($processedReviews[$row['review_id']]) && $row['review_id'] !== null) {
                // Add the review to the reviews array for this ad
                $data[$adId]['reviews'][] = array(
                    'review_id' => $row['review_id'],
                    'rating' => $row['rating'],
                );
    
                // Mark this review as processed
                $processedReviews[$row['review_id']] = true;
            }
    
            // Update the number of reviews for this ad only if there are reviews
            if (!empty($data[$adId]['reviews'])) {
                $data[$adId]['num_reviews'] = count($data[$adId]['reviews']);
    
                // Calculate the average rating for this ad
                $totalRating = 0;
                foreach ($data[$adId]['reviews'] as $review) {
                    $totalRating += $review['rating'];
                }
                $data[$adId]['avg_rating'] = $data[$adId]['num_reviews'] > 0 ? $totalRating / $data[$adId]['num_reviews'] : 0;
            }
    
            // Add ad_levels data
            $data[$adId]['ad_levels'][] = array(
                'ad_level_1' => $row['ad_level_1'],
                'ad_level_2' => $row['ad_level_2'],
            );
    
            // Add ad_languages data
            $data[$adId]['ad_languages'][] = array(
                'language_id' => $row['language_id'],
                'fluency' => $row['fluency'],
            );
    
            // Add ad_schedule data
            $data[$adId]['ad_schedule'][] = array(
                'schedule_id' => $row['schedule_id'],
                'day_of_week' => $row['day_of_week'],
                'time_1' => $row['time_1'],
                'time_2' => $row['time_2'],
                'time_3' => $row['time_3'],
                'time_4' => $row['time_4'],
            );
    
            // Create a unique subject identifier
            $subjectIdentifier = $row['subj_id'] . '-' . $row['subject_name'];
    
            if (!isset($data[$adId]['subject_identifiers'][$subjectIdentifier])) {
                // Add subject to the subjects array as a sub-array
                $subject = array(
                    'subj_id' => $row['subj_id'],
                    'subject_name' => $row['subject_name'],
                    'ad_subject_id' => $row['ad_subject_id'],
                    'subject_level' => $row['subject_level'],
                    'price_hourly' => $row['price_hourly'],
                    'edexcel' => $row['edexcel'],
                    'aqa' => $row['aqa'],
                    'ocr' => $row['ocr']
                );
    
                $data[$adId]['subjects'][] = $subject;
    
                // Mark this subject as added for this ad
                $data[$adId]['subject_identifiers'][$subjectIdentifier] = true;
            }
    
            // Create a unique location identifier
            $locationIdentifier = $row['lesson_location_id'] . '-' . $row['location_name'];
    
            // Check if the location is not already added for this ad
            if (!isset($data[$adId]['location_identifiers'][$locationIdentifier])) {
                // Add location to the locations array as a sub-array
                $location = array(
                    'lesson_location_id' => $row['lesson_location_id'],
                    'location_name' => $row['location_name']
                );
    
                $data[$adId]['locations'][] = $location;
    
                // Mark this location as added for this ad
                $data[$adId]['location_identifiers'][$locationIdentifier] = true;
            }
        }
        // var_dump($data);
        return $data;
    } 
    public function get_ads() {
        $stmt = $this->con->prepare("SELECT
                ads.ad_id,
                ads.preferred,
                ads.recorded_lesson,
                ads.exam_board,
                ads.free_lessons,
                ads.teaching_style,
                ads.highest_qualification_level,
                ads.experiences,
                ads.current_activity,
                ads.aspirations,
                ads.motivations,
                ads.typical_lessons,
                ads.tutor_uid,
                ad_subjects.ad_subject_id,
                ad_subjects.subject_level,
                ad_subjects.price_hourly,
                ad_subjects.edexcel,
                ad_subjects.aqa,
                ad_subjects.ocr,
                subjects.subj_id,
                subjects.subject_name,
                lesson_locations.lesson_location_id,
                lesson_locations.location_name,
                users.firstname,
                users.lastname,
                users.photo,
                users.photo as user_photo,
                reviews.review_id,
                reviews.rating,
                ad_levels.ad_level_1,
                ad_levels.ad_level_2,
                ad_languages.language_id,
                ad_languages.fluency,
                ad_schedule.schedule_id,
                ad_schedule.day_of_week,
                ad_schedule.time_1,
                ad_schedule.time_2,
                ad_schedule.time_3,
                ad_schedule.time_4
            FROM
                ads
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            LEFT JOIN
                reviews ON ads.ad_id = reviews.ad_id
            LEFT JOIN
                ad_subjects ON ads.ad_id = ad_subjects.ad_id
            LEFT JOIN
                subjects ON ad_subjects.subj_id = subjects.subj_id
            LEFT JOIN
                ad_locations ON ads.ad_id = ad_locations.ad_id
            LEFT JOIN
                lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
            LEFT JOIN
                ad_levels ON ads.ad_id = ad_levels.ad_id
            LEFT JOIN
                ad_languages ON ads.ad_id = ad_languages.ad_id
            LEFT JOIN
                ad_schedule ON ads.ad_id = ad_schedule.ad_id
            ORDER BY ads.ad_id, subjects.subject_name, lesson_locations.location_name
        ");
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();
        
        while ($row = $result->fetch_assoc()) {
            $adId = $row['ad_id'];
        
            // Check if the ad is already in the result array
            if (!isset($data[$adId])) {
                // If not, add the ad with basic information
                $data[$adId] = array(
                    'ad_id' => $adId,
                    'preferred' => $row['preferred'],
                    'recorded_lesson' => $row['recorded_lesson'],
                    'exam_board' => $row['exam_board'],
                    'free_lessons' => $row['free_lessons'],
                    'teaching_style' => $row['teaching_style'],
                    'highest_qualification_level' => $row['highest_qualification_level'],
                    'experiences' => $row['experiences'],
                    'current_activity' => $row['current_activity'],
                    'aspirations' => $row['aspirations'],
                    'motivations' => $row['motivations'],
                    'typical_lessons' => $row['typical_lessons'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'photo' => $row['photo'],
                    'tutor_uid' => $row['tutor_uid'],
                    'subjects' => array(),
                    'locations' => array(),
                    'reviews' => array(),
                    'num_reviews' => 0,
                    'avg_rating' => 0,
                    'ad_levels' => array(),
                    'ad_languages' => array(),
                    'ad_schedule' => array(),
                );
            }
    
            // Check if this review has not been counted for this ad
            if (!isset($processedReviews[$row['review_id']]) && $row['review_id'] !== null) {
                // Add the review to the reviews array for this ad
                $data[$adId]['reviews'][] = array(
                    'review_id' => $row['review_id'],
                    'rating' => $row['rating'],
                );
    
                // Mark this review as processed
                $processedReviews[$row['review_id']] = true;
            }
    
            // Update the number of reviews for this ad only if there are reviews
            if (!empty($data[$adId]['reviews'])) {
                $data[$adId]['num_reviews'] = count($data[$adId]['reviews']);
    
                // Calculate the average rating for this ad
                $totalRating = 0;
                foreach ($data[$adId]['reviews'] as $review) {
                    $totalRating += $review['rating'];
                }
                $data[$adId]['avg_rating'] = $data[$adId]['num_reviews'] > 0 ? $totalRating / $data[$adId]['num_reviews'] : 0;
            }
    
            // Add ad_levels data
            $data[$adId]['ad_levels'][] = array(
                'ad_level_1' => $row['ad_level_1'],
                'ad_level_2' => $row['ad_level_2'],
            );
    
            // Add ad_languages data
            $data[$adId]['ad_languages'][] = array(
                'language_id' => $row['language_id'],
                'fluency' => $row['fluency'],
            );
    
            // Add ad_schedule data
            $data[$adId]['ad_schedule'][] = array(
                'schedule_id' => $row['schedule_id'],
                'day_of_week' => $row['day_of_week'],
                'time_1' => $row['time_1'],
                'time_2' => $row['time_2'],
                'time_3' => $row['time_3'],
                'time_4' => $row['time_4'],
            );
    
            // Create a unique subject identifier
            $subjectIdentifier = $row['subj_id'] . '-' . $row['subject_name'];
    
            if (!isset($data[$adId]['subject_identifiers'][$subjectIdentifier])) {
                // Add subject to the subjects array as a sub-array
                $subject = array(
                    'subj_id' => $row['subj_id'],
                    'subject_name' => $row['subject_name'],
                    'ad_subject_id' => $row['ad_subject_id'],
                    'subject_level' => $row['subject_level'],
                    'price_hourly' => $row['price_hourly'],
                    'edexcel' => $row['edexcel'],
                    'aqa' => $row['aqa'],
                    'ocr' => $row['ocr']
                );
    
                $data[$adId]['subjects'][] = $subject;
    
                // Mark this subject as added for this ad
                $data[$adId]['subject_identifiers'][$subjectIdentifier] = true;
            }
    
            // Create a unique location identifier
            $locationIdentifier = $row['lesson_location_id'] . '-' . $row['location_name'];
    
            // Check if the location is not already added for this ad
            if (!isset($data[$adId]['location_identifiers'][$locationIdentifier])) {
                // Add location to the locations array as a sub-array
                $location = array(
                    'lesson_location_id' => $row['lesson_location_id'],
                    'location_name' => $row['location_name']
                );
    
                $data[$adId]['locations'][] = $location;
    
                // Mark this location as added for this ad
                $data[$adId]['location_identifiers'][$locationIdentifier] = true;
            }
        }
        // var_dump($data);
        return $data;
    }  
    
    
    public function get_my_ads() {
        $tutor_id = get_uid();
        $stmt = $this->con->prepare("SELECT
                ads.ad_id,
                ads.preferred,
                ads.recorded_lesson,
                ads.exam_board,
                ads.free_lessons,
                ads.teaching_style,
                ads.highest_qualification_level,
                ads.experiences,
                ads.current_activity,
                ads.aspirations,
                ads.motivations,
                ads.typical_lessons,
                ads.tutor_uid,
                ad_subjects.ad_subject_id,
                ad_subjects.subject_level,
                ad_subjects.price_hourly,
                ad_subjects.edexcel,
                ad_subjects.aqa,
                ad_subjects.ocr,
                subjects.subj_id,
                subjects.subject_name,
                lesson_locations.lesson_location_id,
                lesson_locations.location_name,
                users.firstname,
                users.lastname,
                users.photo,
                users.photo as user_photo,
                reviews.review_id,
                reviews.rating,
                ad_levels.ad_level_1,
                ad_levels.ad_level_2,
                ad_languages.language_id,
                ad_languages.fluency,
                ad_schedule.schedule_id,
                ad_schedule.day_of_week,
                ad_schedule.time_1,
                ad_schedule.time_2,
                ad_schedule.time_3,
                ad_schedule.time_4
            FROM
                ads
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            LEFT JOIN
                reviews ON ads.ad_id = reviews.ad_id
            LEFT JOIN
                ad_subjects ON ads.ad_id = ad_subjects.ad_id
            LEFT JOIN
                subjects ON ad_subjects.subj_id = subjects.subj_id
            LEFT JOIN
                ad_locations ON ads.ad_id = ad_locations.ad_id
            LEFT JOIN
                lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
            LEFT JOIN
                ad_levels ON ads.ad_id = ad_levels.ad_id
            LEFT JOIN
                ad_languages ON ads.ad_id = ad_languages.ad_id
            LEFT JOIN
                ad_schedule ON ads.ad_id = ad_schedule.ad_id
            WHERE
                ads.tutor_uid = ?
            ORDER BY 
                ads.ad_id DESC
        ");
        
        $stmt->bind_param('i', $tutor_id);
        $stmt->execute();
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();
        
        while ($row = $result->fetch_assoc()) {
            $adId = $row['ad_id'];
        
            // Check if the ad is already in the result array
            if (!isset($data[$adId])) {
                // If not, add the ad with basic information
                $data[$adId] = array(
                    'ad_id' => $adId,
                    'preferred' => $row['preferred'],
                    'recorded_lesson' => $row['recorded_lesson'],
                    'exam_board' => $row['exam_board'],
                    'free_lessons' => $row['free_lessons'],
                    'teaching_style' => $row['teaching_style'],
                    'highest_qualification_level' => $row['highest_qualification_level'],
                    'experiences' => $row['experiences'],
                    'current_activity' => $row['current_activity'],
                    'aspirations' => $row['aspirations'],
                    'motivations' => $row['motivations'],
                    'typical_lessons' => $row['typical_lessons'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'photo' => $row['photo'],
                    'tutor_uid' => $row['tutor_uid'],
                    'subjects' => array(),
                    'locations' => array(),
                    'reviews' => array(),
                    'num_reviews' => 0,
                    'avg_rating' => 0,
                    'ad_levels' => array(),
                    'ad_languages' => array(),
                    'ad_schedule' => array(),
                );
            }
    
            // Check if this review has not been counted for this ad
            if (!isset($processedReviews[$row['review_id']]) && $row['review_id'] !== null) {
                // Add the review to the reviews array for this ad
                $data[$adId]['reviews'][] = array(
                    'review_id' => $row['review_id'],
                    'rating' => $row['rating'],
                );
    
                // Mark this review as processed
                $processedReviews[$row['review_id']] = true;
            }
    
            // Update the number of reviews for this ad only if there are reviews
            if (!empty($data[$adId]['reviews'])) {
                $data[$adId]['num_reviews'] = count($data[$adId]['reviews']);
    
                // Calculate the average rating for this ad
                $totalRating = 0;
                foreach ($data[$adId]['reviews'] as $review) {
                    $totalRating += $review['rating'];
                }
                $data[$adId]['avg_rating'] = $data[$adId]['num_reviews'] > 0 ? $totalRating / $data[$adId]['num_reviews'] : 0;
            }
    
            // Add ad_levels data
            $data[$adId]['ad_levels'][] = array(
                'ad_level_1' => $row['ad_level_1'],
                'ad_level_2' => $row['ad_level_2'],
            );
    
            // Add ad_languages data
            $data[$adId]['ad_languages'][] = array(
                'language_id' => $row['language_id'],
                'fluency' => $row['fluency'],
            );
    
            // Add ad_schedule data
            $data[$adId]['ad_schedule'][] = array(
                'schedule_id' => $row['schedule_id'],
                'day_of_week' => $row['day_of_week'],
                'time_1' => $row['time_1'],
                'time_2' => $row['time_2'],
                'time_3' => $row['time_3'],
                'time_4' => $row['time_4'],
            );
    
            // Create a unique subject identifier
            $subjectIdentifier = $row['subj_id'] . '-' . $row['subject_name'];
    
            if (!isset($data[$adId]['subject_identifiers'][$subjectIdentifier])) {
                // Add subject to the subjects array as a sub-array
                $subject = array(
                    'subj_id' => $row['subj_id'],
                    'subject_name' => $row['subject_name'],
                    'ad_subject_id' => $row['ad_subject_id'],
                    'subject_level' => $row['subject_level'],
                    'price_hourly' => $row['price_hourly'],
                    'edexcel' => $row['edexcel'],
                    'aqa' => $row['aqa'],
                    'ocr' => $row['ocr']
                );
    
                $data[$adId]['subjects'][] = $subject;
    
                // Mark this subject as added for this ad
                $data[$adId]['subject_identifiers'][$subjectIdentifier] = true;
            }
    
            // Create a unique location identifier
            $locationIdentifier = $row['lesson_location_id'] . '-' . $row['location_name'];
    
            // Check if the location is not already added for this ad
            if (!isset($data[$adId]['location_identifiers'][$locationIdentifier])) {
                // Add location to the locations array as a sub-array
                $location = array(
                    'lesson_location_id' => $row['lesson_location_id'],
                    'location_name' => $row['location_name']
                );
    
                $data[$adId]['locations'][] = $location;
    
                // Mark this location as added for this ad
                $data[$adId]['location_identifiers'][$locationIdentifier] = true;
            }
        }
        // var_dump($data);
        return $data;
    }  
    public function get_single_ad($ad_id) {
        $ads = $this->get_ads($ad_id);
        foreach($ads as $ad) {
            $adId = $ad['ad_id'];
            if($adId == $ad_id) {
                return $ad;
            }
        }
    }


    /*
    =================================================================
        LEVELS
    =================================================================  
    */ 
    public function get_ad_subject_details($ad_id, $subject_id) { 
        $stmt = $this->con->prepare("SELECT * FROM ad_subjects WHERE ad_id=? AND subj_id=? ");  
        $stmt->bind_param('ii', $ad_id, $subject_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data; 
    }
    public function get_levels() {
        $stmt = $this->con->prepare("SELECT * FROM levels ORDER BY level_id ASC"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    public function get_level($level) {
        $stmt = $this->con->prepare("SELECT * FROM levels WHERE level_id=? LIMIT 1"); 
        $stmt->bind_param('i', $level);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data; 
    }
    // Search
    public function search_dropdown_levels() {
        /*
            Dropdown items for search feature in home and listings pages
        */
        $levels = $this->get_levels();

        $dropdownLevels = "";

        foreach ($levels as $level) {
            $dropdownLevels .= "<li data-level-id='{$level['level_id']}'>{$level['level_name']}</li>";
        }

        echo $dropdownLevels;
    }
    
    /*
    =================================================================
        SUBJECTS
    =================================================================  
    */
    public function get_subjects() {
        $stmt = $this->con->prepare("SELECT * FROM subjects ORDER BY subj_id ASC"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    public function get_subject($subject) {
        $stmt = $this->con->prepare("SELECT * FROM subjects WHERE subj_id=? LIMIT 1"); 
        $stmt->bind_param('i', $subject);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    public function subject_filter_items() {
        // Assuming $data is an array containing your subject data
        $data = $this->get_subjects();

        // Function to create the string of dropdown items
        $subjects = $data;

        $dropdownString = "";

        foreach ($subjects as $subject) {
            $dropdownString .= "
                <div class='custom-checkbox'>
                    <div class='custom-checkbox-inner'>
                        <input data-subjects-id='{$subject['subj_id']}' value={$subject['subject_name']} type='checkbox' id='custom-checkbox-{$subject['subj_id']}'>
                        <label for='custom-checkbox-{$subject['subj_id']}'></label>
                    </div>
                    <div class='checkbox-text'>
                        {$subject['subject_name']}
                    </div>
                </div>
            ";
        }

        echo $dropdownString;
    }
    public function ad_subject_options_edit_ad($subject_data_json, $subject_options_temp_json) {
        $subject_data = json_decode($subject_data_json, true);
        $subject_options_temp = json_decode($subject_options_temp_json, true); // Decode the temporary subject options
        $subject = $this->get_subject($subject_data['subj_id']);
    
        // Default checkbox states
        $checked_gcse = '';
        $checked_alevel = '';
        $edexcelchecked = '';
        $aqachecked = '';
        $ocrchecked = '';

        $price = '';
    
        // Check if the subject exists in the temporary subject options
        $isInTempOptions = false;
        foreach ($subject_options_temp as $tempSubject) {
            if ($tempSubject['subj_id'] == $subject_data['subj_id']) {
                $isInTempOptions = true;
    
                // Set checkbox states based on the temporary data
                if ($tempSubject['boards']['edexcel'] == 'yes') {
                    $edexcelchecked = 'checked';
                }
                if ($tempSubject['boards']['aqa'] == 'yes') {
                    $aqachecked = 'checked';
                }
                if ($tempSubject['boards']['ocr'] == 'yes') {
                    $ocrchecked = 'checked';
                }
    
                if ($tempSubject['levels']['gcse'] == 'yes') {
                    $checked_gcse = 'checked';
                    $checked_alevel = '';
                } elseif ($tempSubject['levels']['alevel'] == 'yes') {
                    $checked_gcse = '';
                    $checked_alevel = 'checked';
                }

                $price = $tempSubject['price'];
    
                break; // Exit loop once found
            }
        }
    
        // If the subject was not in the temporary options, check the previously selected state
        if ($subject_data["previously_selected"] == 'yes' && !$isInTempOptions) {
            if ($subject_data['ad_subject_details']['edexcel'] == 'yes') {
                $edexcelchecked = 'checked';
            }
            if ($subject_data['ad_subject_details']['aqa'] == 'yes') {
                $aqachecked = 'checked';
            }
            if ($subject_data['ad_subject_details']['ocr'] == 'yes') {
                $ocrchecked = 'checked';
            }
    
            if ($subject_data['ad_subject_details']['subject_level'] == 'A-Level') {
                $checked_gcse = '';
                $checked_alevel = 'checked';
            } else if ($subject_data['ad_subject_details']['subject_level'] == 'GCSE') {
                $checked_gcse = 'checked';
                $checked_alevel = '';
            }

            $price = $subject_data['price'];
        }
    
        // Build the checkbox HTML
        $boards = "
            <div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='201' value='Edexcel' type='checkbox' id='custom-checkbox-201' $edexcelchecked>
                    <label for='custom-checkbox-201'></label>
                </div>
                <div class='checkbox-text'>Edexcel</div>
            </div>
            <div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='202' value='AQA' type='checkbox' id='custom-checkbox-202' $aqachecked>
                    <label for='custom-checkbox-202'></label>
                </div>
                <div class='checkbox-text'>AQA</div>
            </div>
            <div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='203' value='OCR' type='checkbox' id='custom-checkbox-203' $ocrchecked>
                    <label for='custom-checkbox-203'></label>
                </div>
                <div class='checkbox-text'>OCR</div>
            </div>";
    
        $levels = "
            <div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-levels-id='301' value='GCSE' type='checkbox' id='custom-checkbox-301' $checked_gcse>
                    <label for='custom-checkbox-301'></label>
                </div>
                <div class='checkbox-text'>GCSE</div>
            </div>
            <div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-levels-id='302' value='A-level' type='checkbox' id='custom-checkbox-302' $checked_alevel>
                    <label for='custom-checkbox-302'></label>
                </div>
                <div class='checkbox-text'>A-level</div>
            </div>";
    
        echo "
        <style>
            .btns-wrapper {
                width: 100%; 
                padding: 8px 20px 0 20px !important; 
                margin: 30px 0 0px 0;
                display: flex; 
                flex-flow: row nowrap; 
                justify-content: flex-end; 
                margin-top: 20px;
            }
            .btn-validate {
                background: rgb(255, 145, 77);
                color: #fff;
                border-radius: 30px;
                padding: 10px 50px;
                font-size: 15px;
            }
            .btn-light-gray {
                border-radius: 30px;
                padding: 10px 50px;
                color: #fff;
                background: rgb(247,247,247);
                color: #121212;
                font-size: 15px;
            }
        </style>
    
        <div class='popup hide_popup' id='ad-subject-popup'>
            <h4 class='popup-title' style='font-size: 20px; margin-bottom: 20px;' data-subject-name-id='{$subject_data['subj_id']}'>{$subject_data['subject_name']}</h4>
            <input type='hidden' id='subject_data_json' name='subject_data_json' value='$subject_data_json' />
    
            <div class='boards'>
                <h6 class='popup-input-heading'>Boards</h6>
                <div class='boards-row'>  
                    $boards
                </div>
            </div>
    
            <div class='levels'>
                <h6 class='popup-input-heading'>Levels</h6>
                <div class='levels-row'>
                    $levels
                </div>
            </div>
    
            <div class='price'>  
                <h6 class='popup-input-heading'>Hourly Price</h6>
                <div class='amount'>  
                    <div class='textarea-container'>
                        <span style='margin-right: 10px;'>£</span> <input style='width: 150px; padding: 8px; border-radius: 4px;' id='price' name='price' value='$price'>
                    </div>
                </div>
            </div>
    
            <div class='btns-container'>
                <div class='col-left'>
                    <button onclick='closePopup();' class='btn reject'>Cancel</button>
                </div>
                <div class='col-right'>
                    <button class='btn accept' onclick='save_subject_options_edit_ad()'>Done</button>
                </div>
            </div>
        </div>";
    }
    

    public function my_ad($ad_id=null, $is_last=false) {
        if($is_last == false) {
            $ad_array = $this->get_my_selected_ad($ad_id)[$ad_id];
            if($ad_array != null) {
                $ad_profile = $this->my_ad_profile($ad_id);
            }
        } else {
            $ad_array = $this->get_my_latest_ad();
            // var_dump($ad_array);
            if($ad_array != null) {
                $ad_profile = $this->my_ad_profile($ad_array['ad_id']);
            }
        }

        $str = "";
        if($ad_array != null) {
            $subStr = "<div class='subjects'>";
            if (count($ad_array['subjects']) > 0) {
                foreach($ad_array['subjects'] as $subject) {

                    $subStr .= "<div class='subject-name' id='{$subject['subject_name']}-{$subject['subj_id']}'>
                        {$subject['subject_name']}
                    </div>";

                }
            }
            $subStr .= "</div>";

            $locStr = "<div class='locations'>";
            if (count($ad_array['locations']) > 0) {
                foreach($ad_array['locations'] as $loc) {

                    $locStr .= "<div class='location-name' id='{$loc['location_name']}-{$loc['lesson_location_id']}'>
                        {$loc['location_name']}
                    </div>";

                }
            }
            $locStr .= "</div>";


            $subjects_all = $this->get_subjects();
            // var_dump($subjects_all);

            $subject_ids = [];

            foreach($ad_array['subjects'] as $subject) {
                $subject_ids[] = $subject['subj_id'];
            }
            // var_dump($subject_ids);

            $subj_checkboxes = "";

            foreach ($subjects_all as $s) {
                $ad_subject_details = array();
                if (in_array($s["subj_id"], $subject_ids)) {
                    $check = 'checked';
                    $previously_selected = 'yes';

                    $ad_subject_details = $this->get_ad_subject_details($ad_array['ad_id'], $s["subj_id"]);
                } else {
                    $check = '';
                    $previously_selected = 'no';
                }
                
                $args_array = array (
                    'subj_id' => $s['subj_id'],
                    'subject_name' => $s['subject_name'],
                    'previously_selected' => $previously_selected,
                    'ad_subject_details' => (count($ad_subject_details) > 0) ? $ad_subject_details[0] : array()
                );

                $args_json = json_encode($args_array, true);

                $subj_checkboxes .= "<div class='custom-checkbox'>
                    <div class='custom-checkbox-inner'>
                        <input data-subject-id='{$s['subj_id']}' type='checkbox' id='custom-checkbox-{$s['subj_id']}' $check onclick=\"toggleCheckbox(event, 'custom-checkbox-201')\">
                        <label onclick='get_subject_popup_edit_ad($args_json)' for='custom-checkbox-{$s['subj_id']}'></label>
                    </div>
                    <div class='checkbox-text'>
                        {$s['subject_name']}
                    </div>
                </div>";
            }

            $subjs = "<div class='subjects'>
                $subj_checkboxes
            </div>";




            $str .= "
            <div class='myad'>
                <button class='back-btn' onclick='backToAdRows()'>
                    <i class='ion-ios-arrow-thin-left'></i>
                    <span></span>
                </button>
                <div class='infos-block'>
                    <input type='hidden' name='ad_id' id='ad_id' value='{$ad_array['ad_id']}' />
                    <h2 class='ad_l'>
                        Ad Title
                    </h2>
                    <div onclick='get_ad_column_popup(this)' class='infos-container' data-column='ad_title' data-adid='{$ad_array['ad_id']}'>
                        {$ad_array['ad_title']}
                    </div>
                    <h2 class='ad_l'>
                        About Lesson
                    </h2>
                    <div onclick='get_ad_column_popup(this)' class='infos-container' data-column='about_lesson' data-adid='{$ad_array['ad_id']}'>
                        {$ad_array['about_lesson']}
                    </div>
                    <h2 class='ad_l'>
                        Locations
                    </h2>
                    <div onclick='get_ad_column_popup(this)' class='infos-container' data-column='locations' data-adid='{$ad_array['ad_id']}'>
                        $locStr
                    </div>
                    <h2 class='ad_l'>
                        About you
                    </h2>
                    <div onclick='get_ad_column_popup(this)' class='infos-container' data-column='about_tutor' data-adid='{$ad_array['ad_id']}'>
                        {$ad_array['about_tutor']}
                    </div>
                    
                    <h2 class='ad_l'>
                        Subjects
                    </h2>
                    $subjs
                </div>
            </div>
            <div class='ad-profile'>
                $ad_profile
            </div>
            ";
        }
        echo $str;
    }
    public function ad_subject_options($ad_subject_id, $boards) {
        $subject = $this->get_ad_subject($ad_subject_id);

        $boards_array = ($boards) ? json_decode($boards, true)["boards"] : array();
        // var_dump($boards_array);

        $boards = "";
        if($subject['edexcel'] == 'yes') {
            $checked = '';
            if(count($boards_array) > 0) {
                if(in_array('Edexcel', $boards_array)) {
                    $checked = 'checked';
                }
            }
            $boards .= "<div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='201' value='Edexcel' type='checkbox' id='custom-checkbox-201' $checked>
                    <label for='custom-checkbox-201'></label>
                </div>
                <div class='checkbox-text'>
                    Edexcel
                </div>
            </div>";
        }
        if($subject['aqa'] == 'yes') {
            $checked = '';
            if(count($boards_array) > 0) {
                if(in_array('AQA', $boards_array)) {
                    $checked = 'checked';
                }
            }
            $boards .= "<div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='202' value='AQA' type='checkbox' id='custom-checkbox-202' $checked>
                    <label for='custom-checkbox-202'></label>
                </div>
                <div class='checkbox-text'>
                    AQA
                </div>
            </div>";
        }
        if($subject['ocr'] == 'yes') {
            $checked = '';
            if(count($boards_array) > 0) {
                if(in_array('OCR', $boards_array)) {
                    $checked = 'checked';
                }
            }
            $boards .= "<div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='203' value='OCR' type='checkbox' id='custom-checkbox-203' $checked>
                    <label for='custom-checkbox-203'></label>
                </div>
                <div class='checkbox-text'>
                    OCR
                </div>
            </div>";
        }

        echo "
        <style>
            .btns-wrapper {
                width: 100%; 
                padding: 8px 20px 0 20px !important; 
                margin: 30px 0 0px 0;
                display: flex; 
                flex-flow: row nowrap; 
                justify-content: flex-end; 
                margin-top: 20px;
            }
            .btn-validate {
                background: rgb(255, 145, 77);
                color: #fff;
                border-radius: 30px;
                padding: 10px 50px;
                font-size: 15px;
            }
            .btn-light-gray {
                border-radius: 30px;
                padding: 10px 50px;
                color: #fff;
                background: rgb(247,247,247);
                color: #121212;
                font-size: 15px;
            }
        </style>

        <div class='popup hide_popup' id='ad-subject-popup'>
            <h4 class='popup-title' style='font-size: 20px; margin-bottom: 20px;' data-subject-name-id='{$subject['ad_subject_id']}'>{$subject['subject_name']}</h4>
            <input type='hidden' id='ad_subject_id' name='ad_subject_id' value='{$subject['ad_subject_id']}' />
            <div class='boards'>
                <h6 class='popup-input-heading'>
                    Boards
                </h6>
                <div class='boards-row'>  
                    $boards
                </div>
            </div>
            <div class='price'>  
                <h6 class='popup-input-heading'>
                    Hourly Price
                </h6>
                <div class='amount' data-subject-price-id='{$subject['ad_subject_id']}'>  
                    £"."{$subject['price_hourly']}
                </div>
            </div>
            <div class='btns-container'>

                <div class='col-left'>
                    <button onclick='closePopup();' class='btn reject'>Cancel</button>
                </div>
                <div class='col-right'>
                    <button class='btn accept' onclick='save_subject_options()'>Done</button>
                </div>
            </div>

        </div>";

    }
    public function get_ad_subject($ad_subject_id) {
        // var_dump($ad_subject_id);
        $sql = "SELECT   	
            ad_subjects.ad_subject_id,
            ad_subjects.subj_id,
            ad_subjects.ad_id,
            ad_subjects.edexcel,
            ad_subjects.aqa,
            ad_subjects.ocr,
            ad_subjects.subject_level,
            ad_subjects.price_hourly,
            subjects.subject_name 
        FROM 
            ad_subjects 
        LEFT JOIN
            subjects ON ad_subjects.subj_id = subjects.subj_id
        WHERE 
            ad_subjects.ad_subject_id=? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $ad_subject_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $ad_subject_array = array(
            'ad_subject_id' => $row['ad_subject_id'],
            'subj_id' => $row['subj_id'],
            'subject_name' => $row['subject_name'],
            'ad_id' => $row['ad_id'],
            'edexcel' => $row['edexcel'],
            'aqa' => $row['aqa'],
            'ocr' => $row['ocr'],
            'subject_level' => $row['subject_level'],
            'price_hourly' => $row['price_hourly']
        );

        $stmt->close();
        return $ad_subject_array;
    }
    public function displaySubjectsByLevel($ad_id) {
        $ad_array = $this->get_single_ad($ad_id);
        $subjects = $ad_array['subjects'];

        $gcseSubjects = [];
        $aLevelSubjects = [];
    
        foreach ($subjects as $subject) {
            if ($subject["subject_level"] === "GCSE") {
                $gcseSubjects[] = $subject;
            } elseif ($subject["subject_level"] === "A-Level") {
                $aLevelSubjects[] = $subject;
            }
        }
        

        $subHtml = "";
    
        $subHtml .= '<div class="sub-wrapper">';
        $subHtml .= '<div class="sub-row-title">GCSE</div>';
        $subHtml .= '<div class="gcse-subjects-row">';
        foreach ($gcseSubjects as $gcseSubject) {
            $subHtml .= "<div onclick='get_subject_popup(this);' class='subject-item' data-ad-subj-id='{$gcseSubject['ad_subject_id']}'>
                <div class='ad-subject-name'>{$gcseSubject['subject_name']}</div>
                <div class='ad-subject-boards'>
                
                </div>
            </div>";
        }
        $subHtml .= '</div>';
        $subHtml .= '</div>';
    

        $subHtml .= '<div class="sub-wrapper">';
        $subHtml .= '<div class="sub-row-title">A-Level</div>';
        $subHtml .= '<div class="a-level-subjects-row">';
        foreach ($aLevelSubjects as $aLevelSubject) {
            $subHtml .= "<div onclick='get_subject_popup(this);' class='subject-item' data-ad-subj-id='{$aLevelSubject['ad_subject_id']}'>
                <div class='ad-subject-name'>{$aLevelSubject['subject_name']}</div>
                <div class='ad-subject-boards'>
                
                </div>
            </div>";
        }
        $subHtml .= '</div>';
        $subHtml .= '</div>';

        return $subHtml;

    }

    public function update_ad_title() {
        $ad_id = $_POST['ad_id'];
        $ad_title = $_POST['ad_title'];

        $stmt = $this->con->prepare("UPDATE ads SET ad_title=? WHERE ad_id=?");
        $stmt->bind_param('si', $ad_title, $ad_id);
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        echo $status;
    }
    public function update_about_lesson() {
        $ad_id = $_POST['ad_id'];
        $about_lesson = $_POST['about_lesson'];

        $stmt = $this->con->prepare("UPDATE ads SET about_lesson=? WHERE ad_id=?");
        $stmt->bind_param('si', $about_lesson, $ad_id);
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        echo $status;
    }
    public function update_about_tutor() {
        $ad_id = $_POST['ad_id'];
        $about_tutor = $_POST['about_tutor'];

        $stmt = $this->con->prepare("UPDATE ads SET about_tutor=? WHERE ad_id=?");
        $stmt->bind_param('si', $about_tutor, $ad_id);
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        echo $status;
    }

    public function displaySubjectsByLevelRequest($ad_id, $request_subjects) {
        $ad_array = $this->get_single_ad($ad_id);
        $ad_subjects = $ad_array['subjects'];

        $gcseSubjects = [];
        $aLevelSubjects = [];
    
        foreach ($ad_subjects as $subject) {
            if ($subject["subject_level"] === "GCSE") {
                $gcseSubjects[] = $subject;
            } elseif ($subject["subject_level"] === "A-Level") {
                $aLevelSubjects[] = $subject;
            }
        }
        

        $subHtml = "";
    
        $subHtml .= '<div class="sub-wrapper">';
        $subHtml .= '<div class="sub-row-title">GCSE</div>';
        $subHtml .= '<div class="gcse-subjects-row">';
        foreach ($gcseSubjects as $gcseSubject) {
            $matched = false; // Flag to prevent duplicate entries
            foreach ($request_subjects as $id => $subject) {
                if($id == $gcseSubject['ad_subject_id']) {
                    $subHtml .= '
                    <div onclick="get_subject_popup(this);" class="subject-item selected-ad-subject" data-ad-subj-id="' . $id . '">
                        <div class="ad-subject-name">' . htmlspecialchars($subject['name']) . '</div>
                        <div class="ad-subject-boards">';
        
                    // Loop through the boards and append them to the HTML string
                    foreach ($subject['boards'] as $board) {
                        $subHtml .= '<div data-subject-board-id="' . htmlspecialchars($board['boardId']) . '">' . htmlspecialchars($board['value']) . '</div>';
                    }
        
                    $subHtml .= '
                        </div>
                        <div data-price-id="' . $id . '">' . trim($subject['price']) . '</div>
                    </div>';
                    $matched = true; // A match was found
                    break; // Stop checking after finding the match
                }
            }
            
            // Only add the non-matching item once, outside the inner loop
            if (!$matched) {
                $subHtml .= "<div onclick='get_subject_popup_request(this);' class='subject-item' data-ad-subj-id='{$gcseSubject['ad_subject_id']}'>
                    <div class='ad-subject-name'>{$gcseSubject['subject_name']}</div>
                    <div class='ad-subject-boards'>
                    </div>
                </div>";
            }
        }
        $subHtml .= '</div>';
        $subHtml .= '</div>';
    

        $subHtml .= '<div class="sub-wrapper">';
        $subHtml .= '<div class="sub-row-title">A-Level</div>';
        $subHtml .= '<div class="a-level-subjects-row">';
        foreach ($aLevelSubjects as $aLevelSubject) {
            $matched = false; // Flag to prevent duplicate entries
            foreach ($request_subjects as $id => $subject) {
                if($id == $aLevelSubject['ad_subject_id']) {
                    $subHtml .= '
                    <div onclick="get_subject_popup(this);" class="subject-item selected-ad-subject" data-ad-subj-id="' . $id . '">
                        <div class="ad-subject-name">' . htmlspecialchars($subject['name']) . '</div>
                        <div class="ad-subject-boards">';
        
                    // Loop through the boards and append them to the HTML string
                    foreach ($subject['boards'] as $board) {
                        $subHtml .= '<div data-subject-board-id="' . htmlspecialchars($board['boardId']) . '">' . htmlspecialchars($board['value']) . '</div>';
                    }
        
                    $subHtml .= '
                        </div>
                        <div data-price-id="' . $id . '">' . trim($subject['price']) . '</div>
                    </div>';
                    $matched = true; // A match was found
                    break; // Stop checking after finding the match
                }
            }
            
            // Only add the non-matching item once, outside the inner loop
            if (!$matched) {
                $subHtml .= "<div onclick='get_subject_popup_request(this);' class='subject-item' data-ad-subj-id='{$aLevelSubject['ad_subject_id']}'>
                    <div class='ad-subject-name'>{$aLevelSubject['subject_name']}</div>
                    <div class='ad-subject-boards'>
                    </div>
                </div>";
            }
        }
        $subHtml .= '</div>';
        $subHtml .= '</div>';

        return $subHtml;

    }
    // Search
    public function search_dropdown_subjects() {
        /*
            Dropdown items for search feature in home and listings pages
        */
        $subjects = $this->get_subjects();

        $dropdownSubjects = "";

        foreach ($subjects as $subject) {
            $dropdownSubjects .= "<li data-subject-id='{$subject['subj_id']}'>{$subject['subject_name']}</li>";
        }

        echo $dropdownSubjects;
    }

    /*
    =================================================================
        SCHEDULE
    =================================================================  
    */
    function getTutorAdSchedules($tutorId) {
        $adSchedules = array();
    
        $stmt = $this->con->prepare("SELECT
            ads.ad_id,
            ads.tutor_uid,
            ad_schedule.time_1,
            ad_schedule.time_2,
            ad_schedule.time_3,
            ad_schedule.time_4,
            days_of_week.day_of_week
        FROM
            ads
        LEFT JOIN
            ad_schedule ON ads.ad_id = ad_schedule.ad_id
        LEFT JOIN
            days_of_week ON days_of_week.day_id = ad_schedule.day_of_week
        WHERE
            ads.tutor_uid = ? LIMIT 1");

        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        } 
        $stmt->bind_param('i', $tutorId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $adId = $row['ad_id'];
    
            // Check if the ad schedule is already in the result array
            if (!isset($adSchedules[$adId])) {
                // If not, add the ad schedule with basic information
                $adSchedules[$adId] = array(
                    'ad_id' => $adId,
                    'tutor_uid' => $row['tutor_uid'],
                    'schedules' => array(),
                );
            }


    
            $adSchedules[$adId]['schedules'][] = array(
                'day_of_week' => $row['day_of_week'],
                'time_1' => $row['time_1'],
                'time_2' => $row['time_2'],
                'time_3' => $row['time_3'],
                'time_4' => $row['time_4'],
            );
        }
        // var_dump($adSchedules);
    
        return $adSchedules;
    }
    function displayAdSchedulesHTML($tutorId) {
        $tutorAdSchedules = $this->getTutorAdSchedules($tutorId);
        // var_dump($tutorAdSchedules);
        $seven_days = next_seven_days();
    
        $str = "";
        foreach ($seven_days as $day) {
            $str .= "<div class='sch-dow'>
                    <div class='sch-dow-inner'>
                        <p class='d'>{$day['day_of_week']}</p>
                        <p class='dow'>{$day['day']}</p>";
    
            // Check if there are ad schedules for the current day
            if (isset($tutorAdSchedules) && is_array($tutorAdSchedules)) {
                foreach ($tutorAdSchedules as $adId => $adData) {
                    $adSchedules = $adData['schedules'];
                    foreach ($adSchedules as $adSchedule) {
                        // var_dump($adSchedule['day_of_week'], $day['day_of_week']);
                        if ($adSchedule['day_of_week'] === $day['day_of_week']) {
                            $str .= "<div class='times'>
                                <p>{$adSchedule['time_1']}</p>
                                <p>{$adSchedule['time_2']}</p>
                                <p>{$adSchedule['time_3']}</p>
                                <p>{$adSchedule['time_4']}</p>
                            </div>";
                        }
                    }
                }
            }
    
            $str .= "</div>
                </div>";
        }

        return $str;
    }
    /*
    =================================================================
        DAYS & TIMES
    =================================================================  
    */
    public function get_days_of_week() {
        $stmt = $this->con->prepare("SELECT * FROM days_of_week ORDER BY day_id ASC"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    public function get_times_of_day() {
        $stmt = $this->con->prepare("SELECT * FROM times_of_day ORDER BY time_id ASC"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    public function get_daytimes() {
        $stmt = $this->con->prepare("SELECT * FROM daytimes ORDER BY id ASC"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    public function show_day_and_times() {
        $days = $this->get_days_of_week();
        $times = $this->get_times_of_day();


        $ds = "<div class='days'>";
        foreach($days as $day) {
            $ds .= "<div data-day-id=\"{$day['day_id']}\" class='item' onclick=\"selectDay(this, '{$day['day_of_week']}')\">{$day['day_of_week']}</div>";
        }
        $ds .= "</div>";  

        
        $ts = "<div class='times'>";
        foreach($times as $time) {
            $ts .= "<div data-time-id=\"{$time['time_id']}\" class='item' onclick=\"selectTime(this, '{$time['time_of_day']}')\">{$time['time_of_day']}</div>";
        }
        $ts .= "</div>";

        echo "<div class='daytime-container'>
            <h5 style='font-size: 18px; margin-bottom: 20px; line-height: 28px;'>
                I'm available
            </h5>
            $ds
            $ts
            <div class='selected-schedule'></div>
        </div>";

    }
    public function show_day_and_times_filter() {
        $days = $this->get_days_of_week();
        $times = $this->get_times_of_day();


        $ds = "<div class='days'>";
        foreach($days as $day) {
            $ds .= "<div data-day-id=\"{$day['day_id']}\" class='item' onclick=\"filterDay(this, '{$day['day_of_week']}')\">{$day['day_of_week']}</div>";
        }
        $ds .= "</div>";  

        
        $ts = "<div class='times'>";
        foreach($times as $time) {
            $ts .= "<div data-time-id=\"{$time['time_id']}\" class='item' onclick=\"filterTime(this, '{$time['time_of_day']}')\">{$time['time_of_day']}</div>";
        }
        $ts .= "</div>";

        echo "<div class='daytime-container'>
            <h5 style='font-size: 18px; margin-bottom: 20px; line-height: 28px;'>
                I'm available
            </h5>
            $ds
            $ts
            <div class='selected-schedule'></div>
        </div>";

    }
    public function get_lesson_locations() {
        $stmt = $this->con->prepare("SELECT * FROM lesson_locations ORDER BY lesson_location_id ASC"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    
    public function my_ads_sidebar() {
        $ads = $this->get_my_ads();

        // var_dump($ads);

        $adsStr = "";
        foreach($ads as $ad) {
            if(count($ad['subjects']) > 0) {
                $subject_name = $ad['subjects'][0]['subject_name'];
                // foreach($ad['subjects'] as $subject) {
                //     $ad['subjects']
                // }
            }
            $adsStr .= "
            <div class='card-ad-wrapper' data-adid='{$ad['ad_id']}'>
                <div class='infos-wrapper'>
                    <div class='avatar-wrapper'>
                        <img src='assets/avatars/{$ad['photo']}' alt='avatar' class='avatar'>
                        <span class='i-circle selected active'></span>
                    </div>
                    <div class='subject-status-wrapper'>
                        <p>$subject_name</p>
                        <div class='status-ad active'>
                            <p>Online</p>
                        </div>
                    </div>
                </div>
            </div>";
        }
        echo $adsStr;
    }
    public function ad_locations($ad_id) {
        $stmt2 = $this->con->prepare("SELECT
            lesson_locations.lesson_location_id,
            lesson_locations.location_name,
            ad_locations.ad_location_id,
            ad_locations.ad_id as lesson_ad_id,
            ad_locations.lesson_location_id as ad_lesson_location_id
        
        FROM
            ads
        LEFT JOIN
            ad_locations ON ads.ad_id = ad_locations.ad_id
        LEFT JOIN
            lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
        WHERE
            ads.ad_id = ?");

        $stmt2->bind_param('i', $ad_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $data2 = $result2->fetch_all(MYSQLI_ASSOC);
        $stmt2->close();
        return $data2;
    }
    public function get_my_selected_ad($ad_id) {
        $stmt = $this->con->prepare("SELECT
                ads.ad_id,
                ads.ad_title,
                ads.about_lesson,
                ads.about_tutor,
                ads.photo,
                ads.tutor_uid,
                subjects.subj_id,
                subjects.subject_name,
                ad_subjects.ad_subject_id,
                ad_subjects.edexcel,
                ad_subjects.aqa,
                ad_subjects.ocr,
                ad_subjects.price_hourly,
                lesson_locations.lesson_location_id,
                lesson_locations.location_name,
                ad_locations.ad_location_id,
                ad_locations.ad_id as lesson_ad_id,
                ad_locations.lesson_location_id as ad_lesson_location_id,
                users.firstname,
                users.lastname,
                users.photo,
                reviews.review_id,
                reviews.rating
            FROM
                ads
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            LEFT JOIN
                reviews ON ads.ad_id = reviews.ad_id
            LEFT JOIN
                ad_subjects ON ads.ad_id = ad_subjects.ad_id
            LEFT JOIN
                subjects ON ad_subjects.subj_id = subjects.subj_id
            LEFT JOIN
                ad_locations ON ads.ad_id = ad_locations.ad_id
            LEFT JOIN
                lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
            WHERE
                ads.ad_id = ?");

        $stmt->bind_param('i', $ad_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // var_dump($result);

        $data = array();

        while ($row = $result->fetch_assoc()) {
            $adId = $row['ad_id'];
            // echo $row['location_name'];

            // Check if the ad is already in the result array
            if (!isset($data[$adId])) {
                // If not, add the ad with basic information
                $data[$adId] = array(
                    'ad_id' => $adId,
                    'ad_title' => $row['ad_title'],
                    'about_lesson' => $row['about_lesson'],
                    'about_tutor' => $row['about_tutor'],
                    'photo' => $row['photo'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'tutor_uid' => $row['tutor_uid'],
                    'subjects' => array(),
                    'locations' => array(),
                    'reviews' => array(),
                    'num_reviews' => 0,
                    'avg_rating' => 0,
                );
            }



            // Check if this review has not been counted for this ad
            if (!isset($processedReviews[$row['review_id']]) && $row['review_id'] !== null) {
                // Add the review to the reviews array for this ad
                $data[$adId]['reviews'][] = array(
                    'review_id' => $row['review_id'],
                    'rating' => $row['rating'],
                );

                // Mark this review as processed
                $processedReviews[$row['review_id']] = true;
            }

            // Update the number of reviews for this ad only if there are reviews
            if (!empty($data[$adId]['reviews'])) {
                $data[$adId]['num_reviews'] = count($data[$adId]['reviews']);

                // Calculate the average rating for this ad
                $totalRating = 0;
                foreach ($data[$adId]['reviews'] as $review) {
                    $totalRating += $review['rating'];
                }
                $data[$adId]['avg_rating'] = $data[$adId]['num_reviews'] > 0 ? $totalRating / $data[$adId]['num_reviews'] : 0;
            }



            // Create a unique subject identifier
            $subjectIdentifier = $row['subj_id'] . '-' . $row['subject_name'];

            if (!isset($data[$adId]['subject_identifiers'][$subjectIdentifier])) {
                // Add subject to the subjects array as a sub-array
                $subject = array(
                    'ad_subject_id' => $row['ad_subject_id'],
                    'subj_id' => $row['subj_id'],
                    'subject_name' => $row['subject_name'],
                    'edexcel' => $row['edexcel'],
                    'aqa' => $row['aqa'],
                    'ocr' => $row['ocr'],
                    'price_hourly' => $row['price_hourly']
                );

                $data[$adId]['subjects'][] = $subject;

                // Mark this subject as added for this ad
                $data[$adId]['subject_identifiers'][$subjectIdentifier] = true;
            }

            // Create a unique location identifier
            $locationIdentifier = $row['lesson_location_id'] . '-' . $row['location_name'];

            // Add location to the locations array as a sub-array


            
            if (!isset($data[$adId]['location_identifiers'][$locationIdentifier])) {
                // Add location to the locations array as a sub-array
                $location = array(
                    'ad_location_id' => $row['ad_location_id'],
                    'lesson_location_id' => $row['lesson_location_id'],
                    'location_name' => $row['location_name']
                );

                $data[$adId]['locations'][] = $location;

                // Mark this subject as added for this ad
                $data[$adId]['location_identifiers'][$locationIdentifier] = true;
            }

        }

        // var_dump($data[$adId]['location_identifiers']);
        // var_dump($data[$adId]['locations']);

        return $data;
    }
    public function get_my_latest_ad() {
        $uid = get_uid();
        $stmt = $this->con->prepare("SELECT
                ads.ad_id,
                ads.ad_title,
                ads.about_lesson,
                ads.about_tutor,
                ads.photo,
                ads.tutor_uid,
                subjects.subj_id,
                subjects.subject_name,
                ad_subjects.ad_subject_id,
                ad_subjects.edexcel,
                ad_subjects.aqa,
                ad_subjects.ocr,
                ad_subjects.price_hourly,
                lesson_locations.lesson_location_id,
                lesson_locations.location_name,
                ad_locations.ad_location_id,
                ad_locations.ad_id as lesson_ad_id,
                ad_locations.lesson_location_id as ad_lesson_location_id,
                users.firstname,
                users.lastname,
                users.photo,
                reviews.review_id,
                reviews.rating
            FROM
                ads
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            LEFT JOIN
                reviews ON ads.ad_id = reviews.ad_id
            LEFT JOIN
                ad_subjects ON ads.ad_id = ad_subjects.ad_id
            LEFT JOIN
                subjects ON ad_subjects.subj_id = subjects.subj_id
            LEFT JOIN
                ad_locations ON ads.ad_id = ad_locations.ad_id
            LEFT JOIN
                lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
            WHERE
                tutor_uid = ?
        ");

        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        // var_dump($result);

        $data = array();

        while ($row = $result->fetch_assoc()) {
            $adId = $row['ad_id'];

            // Check if the ad is already in the result array
            if (!isset($data[$adId])) {
                // If not, add the ad with basic information
                $data[$adId] = array(
                    'ad_id' => $adId,
                    'ad_title' => $row['ad_title'],
                    'about_lesson' => $row['about_lesson'],
                    'about_tutor' => $row['about_tutor'],
                    'photo' => $row['photo'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'tutor_uid' => $row['tutor_uid'],
                    'subjects' => array(),
                    'locations' => array(),
                    'reviews' => array(),
                    'num_reviews' => 0,
                    'avg_rating' => 0,
                );
            }



            // Check if this review has not been counted for this ad
            if (!isset($processedReviews[$row['review_id']]) && $row['review_id'] !== null) {
                // Add the review to the reviews array for this ad
                $data[$adId]['reviews'][] = array(
                    'review_id' => $row['review_id'],
                    'rating' => $row['rating'],
                );

                // Mark this review as processed
                $processedReviews[$row['review_id']] = true;
            }

            // Update the number of reviews for this ad only if there are reviews
            if (!empty($data[$adId]['reviews'])) {
                $data[$adId]['num_reviews'] = count($data[$adId]['reviews']);

                // Calculate the average rating for this ad
                $totalRating = 0;
                foreach ($data[$adId]['reviews'] as $review) {
                    $totalRating += $review['rating'];
                }
                $data[$adId]['avg_rating'] = $data[$adId]['num_reviews'] > 0 ? $totalRating / $data[$adId]['num_reviews'] : 0;
            }


            // Create a unique location identifier
            $subjectIdentifier = $row['subj_id'] . '-' . $row['subject_name'];

            if (!isset($data[$adId]['subject_identifiers'][$subjectIdentifier])) {
                // Add subject to the subjects array as a sub-array
                $subject = array(
                    'ad_subject_id' => $row['ad_subject_id'],
                    'subj_id' => $row['subj_id'],
                    'subject_name' => $row['subject_name'],
                    'edexcel' => $row['edexcel'],
                    'aqa' => $row['aqa'],
                    'ocr' => $row['ocr'],
                    'price_hourly' => $row['price_hourly']
                );

                $data[$adId]['subjects'][] = $subject;

                // Mark this subject as added for this ad
                $data[$adId]['subject_identifiers'][$subjectIdentifier] = true;
            }

            // Create a unique location identifier
            $locationIdentifier = $row['lesson_location_id'] . '-' . $row['location_name'];

            if (!isset($data[$adId]['location_identifiers'][$locationIdentifier])) {
                // Add location to the locations array as a sub-array
                $location = array(
                    'ad_location_id' => $row['ad_location_id'],
                    'lesson_location_id' => $row['lesson_location_id'],
                    'location_name' => $row['location_name']
                );

                $data[$adId]['locations'][] = $location;

                // Mark this subject as added for this ad
                $data[$adId]['location_identifiers'][$locationIdentifier] = true;
            }
        }

        // var_dump($data[$adId]['subject_identifiers']);

        if(count($data) > 0) {
            return $data[$adId];
        } else {
            return null;
        }
        
    }
    public function my_ad_profile($ad_id) {
        $uid = get_uid();
        $ad_array = $this->get_my_selected_ad($ad_id)[$ad_id];

        if(!empty($ad_array['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$ad_array['photo']}' />";
        } else {     
            $fname = get_firstname();
            $fChar = $fname[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        return "<div class='profile-infos'>

            <div class='img-wrapper'>
                $photo
            </div>
            <div class='name'>
                {$ad_array['firstname']}
            </div>

            <div data-v-8d148bb2='' class='details-part'>
                <p class='hourly-label'>Hourly rate</p>
                <div data-v-6e56b942='' data-v-8d148bb2='' class='edit-wrapper'>
                    <h6 data-v-8d148bb2='' data-v-6e56b942='' class='details-value'>
                        {$ad_array['subjects'][0]['price_hourly']}
                        <small>£</small>
                    </h6>
                </div>
            </div>

        </div>";

    }
    // public function filterAds($priceMin, $priceMax, $ratingMin, $ratingMax, $location_1 = null, $location_2 = null, $location_3 = null, $subjects = array()) {
    //     // Call the get_ads function to retrieve the array
    //     $adsArray = $this->get_ads();
    
    //     // Filter the array based on the given conditions
    //     $filteredAds = array_filter($adsArray, function ($ad) use ($priceMin, $priceMax, $ratingMin, $ratingMax, $location_1, $location_2, $location_3, $subjects) {
    //         // Check price condition
    //         if ($priceMin <= $ad['price'] && $ad['price'] <= $priceMax) {
    //             // Check rating condition
    //             if ($ad['avg_rating'] <= $ratingMax && $ad['avg_rating'] >= $ratingMin) {
    //                 // Check location conditions only if any of the locations is not null
    //                 if ($location_1 !== null || $location_2 !== null || $location_3 !== null) {
    //                     $locationIds = array_column($ad['locations'], 'lesson_location_id');
    //                     $matchingLocations = array_intersect([$location_1, $location_2, $location_3], $locationIds);
                        
    //                     // If there's at least one matching location, check subjects
    //                     if (!empty($matchingLocations)) {
    //                         // Check subjects condition only if $subjects is not empty
    //                         if (!empty($subjects)) {
    //                             // Check if there are matching subjects
    //                             $adSubjects = array_column($ad['subjects'], 'subj_id');
    //                             $matchingSubjects = array_intersect($adSubjects, $subjects);

    //                             // Return true only if there are matching subjects
    //                             if (empty($matchingSubjects)) {
    //                                 return false;
    //                             }
    //                         }
    //                         return true;
    //                     }
    //                 } else {
    //                     // Check subjects condition only if $subjects is not empty
    //                     if (!empty($subjects)) {
    //                         // Check if there are matching subjects
    //                         $adSubjects = array_column($ad['subjects'], 'subj_id');
    //                         $matchingSubjects = array_intersect($adSubjects, $subjects);

    //                         // Return true only if there are matching subjects
    //                         if (empty($matchingSubjects)) {
    //                             return false;
    //                         }
    //                     }
    //                     return true;
    //                 }
    //             }
    //         }
    
    //         return false;
    //     });
    
    //     return $filteredAds;
    // }
    public function filterAdsBySubjects($subjects = array()) {
        // Call the get_ads function to retrieve the array
        $adsArray = $this->get_ads();
    
        // Filter the array based on the given subjects
        $filteredAds = array_filter($adsArray, function ($ad) use ($subjects) {
            // Check subjects condition only if $subjects is not empty
            if (!empty($subjects)) {
                // Check if there are matching subjects

                // $adSubjects = array_column($ad['subjects'], 'subject_name');
                // var_dump($subjects);
                // echo '<br>';
                // var_dump($adSubjects);
                // $matchingSubjects = array_intersect($adSubjects, $subjects);


                $adSubjects = array_column($ad['subjects'], 'subject_name');
                $subjectValues = array_column($subjects, 'value');
                $matchingSubjects = array_intersect($adSubjects, $subjectValues);
    
                // Return true only if there are matching subjects
                return !empty($matchingSubjects);
            }
    
            // If $subjects is empty, include the ad in the result
            return true;
        });

        // var_dump($filteredAds);

        return $filteredAds;
    }
    public function showFilteredAds($subjects_json) {
        $subjects = json_decode($subjects_json, true);
        $ads = $this->filterAdsBySubjects($subjects);
        $adsStr = "";
        foreach($ads as $ad) {

            // Levels
            $levelsStr = "";
            $l = $ad['ad_levels'][0];
            if(!empty($l['ad_level_1'])) {
                $levelsStr .= $l['ad_level_1'];
            }
            if(!empty($l['ad_level_1']) && !empty($l['ad_level_2'])) {
                $levelsStr .=  ', ';
            }
            if(!empty($l['ad_level_2'])) {
                $levelsStr .=  $l['ad_level_2'];
            }

            $adsStr .= "
                <div class='profile-infos'>

                    <div class='profile-header'>
                        <div class='fullname'>
                            <div class='firstname'>
                                {$ad['firstname']}
                            </div>
                            <div class='lastname'>
                                {$ad['lastname']}
                            </div>
                        </div>
                        <div class='header-icons'>
                            <i style='font-size: 28px; margin-right: 3px;' class='ion-ios-chatbubble-outline'></i>
                            <i style='font-size: 25px; margin-top: -3px;' class='icofont-heart'></i>
                        </div>
                    </div>
                    
                    <div class='middle'>
                        <div class='img-wrapper'>
                            <img style='width: 100%; height: 100%;' src='./assets/avatars/{$ad['photo']}' />
                        </div>
                        <div class='details'>
                            <div class='hourly-price'>
                                <span class='value'>£25/hr</span>
                            </div>
                            <div class='review'>
                                <div class='rating'>
                                    <i class='icon icon-star2'></i>
                                    <div>{$ad['avg_rating']}</div>
                                </div>
                                <div class='num-of-reviews'>
                                    <div>
                                        <div>{$ad['num_reviews']}</div>
                                        <div>reviews</div>
                                    </div>
                                </div>
                            </div>

                            <div class='middle-icons'>
                                <span style='color: #fff; background: #28a745'>
                                    <i class='ion-ios-videocam-outline'></i>
                                </span>
                                <span style='color: #fff; background: rgb(253,197,0) /* background: rgb(277, 0, 0); */'>
                                    <i class='ion-calendar'></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class='user-details'>
                        <div class='info-row'>
                            <div class='info-icon'>
                                <i class='fa fa-graduation-cap'></i>
                            </div>
                            <div class='degree'>$levelsStr</div>
                        </div>
                        <div class='info-row'>
                            <div class='info-icon'>
                                <i class='icofont-black-board'></i>
                            </div>
                            <div class='degree'>
                                {$ad['teaching_style']}
                            </div>
                        </div>
                        <div class='info-row'>
                            <div class='info-icon'>
                                <i class='icon icon-star2'></i>
                            </div>
                            <div class='degree'>
                                Motivation
                            </div>
                        </div>
                        <div class='info-row'>
                            <div class='info-icon'>
                                <i class='fa fa-road'></i>
                            </div>
                            <div class='degree'>
                                Future aspiration
                            </div>
                        </div>
                    </div>

                    <div class='btns-footer'>
                        <a class='btn-validate'>Book free lesson</a>
                        <a class='btn-validate btn-2' style='max-width: 120px;'>Message</a>
                    </div>

                </div>
            ";
        }
        echo $adsStr;
    }
    public function get_searched_ads($subject_id, $level_id) {
        $adsArray = $this->get_ads();

        // var_dump($subject_id, $level_id);

        if($subject_id != '') {

            $subject_array = $this->get_subject($subject_id);
            // var_dump($subject_array);
            $subject_name = $subject_array[0]['subject_name'];
        } else {
            $subject_name = '';
        }
        
        if($level_id != '') {
            $level_array = $this->get_level($level_id);
            // var_dump($level_array);
            $level_name = $level_array[0]['level_name'];
        } else {
            $level_name = '';
        }

        
        // Convert the subject name to lowercase
        $lowercaseSubjectName = strtolower($subject_name);
        // var_dump($lowercaseSubjectName);
    
        // Filter the array based on the given subject name and level
        $filteredAds = array_filter($adsArray, function ($ad) use ($lowercaseSubjectName, $level_name) {
            // var_dump(array_column($ad['subjects'], 'subject_name'));
            // Check if the subject is not empty and there is a match
            $subjectMatch = empty($lowercaseSubjectName) || in_array($lowercaseSubjectName, array_map('strtolower', array_column($ad['subjects'], 'subject_name')));
    
            // Check if the level is not empty and there is a match in the 'ad_levels' array
            $levelMatch = empty($level_name) || array_filter($ad['ad_levels'], function ($adLevel) use ($level_name) {
                return in_array($level_name, $adLevel);
            });
    
            // Return true if either subject or level matches (or both, depending on whether they are empty or not)
            return $subjectMatch && $levelMatch;
        });
    
        return $filteredAds;
    }
}