<?php
/*
=================================================================
    SESSIONS & COOKIES
    CRUD (create, read, update, delete, login)
    DISPLAY my_requests()
=================================================================  

*/


class Request {
    public $con;
    public $user;
    public $ad;

    private static $instance = null;
    
    public function __construct() {
        $this->con = Db::getInstance()->con();
        $this->user = User::getInstance();
        $this->ad = Ad::getInstance();
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function schedule($ad_id) {
        $ad_details = $this->ad->get_single_ad($ad_id);

        $tutor_id = $ad_details["tutor_uid"];

        $tutor_fname = $ad_details['firstname'];
        $tutor_lname = $ad_details['lastname'];
        $tutor_pfp = $ad_details['photo'];

        $adIdInput = "<input type='hidden' id='ad_id' name='ad_id' value='$ad_id'>";

        $account_type_id = user_account_type_id();
        
        if($account_type_id == 2) {
            // User is student
            $student_id = get_uid();

            $to_name = $tutor_fname;

            $student = $this->user->get_user($student_id)[$student_id];

            $student_fname = $student['firstname'];
            $student_lname = $student['lastname'];
            $student_pfp = $student['photo'];
            
            $from_name = $student_fname;

            $schedule_header = "<div class='schedule-title'>
                <h1>Schedule</h1>
                <h2>Book your class with $to_name</h2>
            </div>";
        } else if($account_type_id == 3) {
            // User is tutor
            $from_name = $tutor_fname;
            $student_id = $_GET['student_id'];
            $student = $this->user->get_user($student_id)[$student_id];

            $student_fname = $student['firstname'];
            $student_lname = $student['lastname'];
            $student_pfp = $student['photo'];
        
            $to_name = $student_fname;

            $schedule_header = "<div class='schedule-title'>
                <h1>Schedule</h1>
                <h2>Book your class with $to_name</h2>
            </div>";
        }



        $message = "Hello $to_name,

My name is $from_name and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?

Have a great day,

See you soon, Shadman";

        $message_placeholder = "Tell $to_name a little bit more about your search for courses, your availability etc... The more information you give to your teacher, the more likely they will be to accept your request.";
        $expectation_placeholder = "Tell $to_name little bit more about your expectation from this lesson, what you hope to achieve etc... The more information you give to your teacher, the more likely they will be to accept your request.";

        $ad_subjects_by_level = $this->ad->displaySubjectsByLevel($ad_id);
        

        /*
            If user is tutor we create the hidden input with student id
        */
        $studentIdInput = "";
        if($account_type_id == 3) {
            $studentIdInput = "<input type='hidden' id='student_id' name='student_id' value='$student_id'>";
        }

        echo "<div class='schedule'>
            $schedule_header

            
            $adIdInput
            $studentIdInput

            <!-- Message -->
            <div class='message-wrapper' id='message-wrapper-outer'>
                <h3 class='msg-label'>
                    Your message
                    <span class='optional'></span>
                </h3>
                <textarea id='msg_student' class='textarea auto-resize' name='msg_student' placeholder='$message_placeholder' rows='8' cols='80'>$message</textarea>

                <div class='error' id='messageError'></div>

            </div>

            <div class='message-wrapper' id='expectations-wrapper-outer'>
                <h3 class='msg-label'>
                    What are your expectations from this lesson?
                    <span class='optional'></span>
                </h3>
                <textarea onkeyup='insertTypedText(this.value, \"lesson_expectations-2\")' class='textarea auto-resize' id='lesson_expectations' name='lesson_expectations' placeholder='$expectation_placeholder' rows='8' cols='80'></textarea>
                <div class='error' id='expectationsError'></div>
            </div>

            
            <div class='radios-wrapper lesson-type-wrapper'>
                <div class='card-title'>
                    Select Lesson Type
                </div>
                <div class='radios' style='position: relative;'>
                    <div class='radio-option'>
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name='lesson_type' id='free' type='radio' value='Free intro call' checked>
                                <label class='radio-label radio-label-3 selected' for='free' onclick='select_lesson_type(this)'></label>
                            </div>
                            <div>Free intro call</div>
                        </div>
                    </div>

                    <div class='radio-option'>
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name='lesson_type' id='paid' type='radio' value='Book a lesson'>
                                <label class='radio-label radio-label-3' for='paid' onclick='select_lesson_type(this)'></label>
                            </div>
                            <div>Book a lesson</div>
                        </div>
                    </div>
                </div>
            </div>

            <div id='subjects-wrapper-outer'>
                $ad_subjects_by_level
                <div id='subjectsError' class='error'></div>
            </div>



            <div class='btns-wrapper'>
                <span class='btn next-btn' onclick=\"switchTabSchedule('tab', 'tab-3', 'active-tab')\">Next</span>
            </div>
            
        </div>";
    } 
    public function ad_subject_options_request($request_id, $ad_subject_id) {
        $subject = $this->ad->get_ad_subject($ad_subject_id);
        $request = $this->get_request($request_id);
        $request_subjects = $request['subjects'];

        var_dump($subject, $request_subjects);

        $boards = "";
        if($subject['edexcel'] == 'yes') {
            $boards .= "<div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='201' value='Edexcel' type='checkbox' id='custom-checkbox-201'>
                    <label for='custom-checkbox-201'></label>
                </div>
                <div class='checkbox-text'>
                    Edexcel
                </div>
            </div>";
        }
        if($subject['aqa'] == 'yes') {
            $boards .= "<div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='202' value='AQA' type='checkbox' id='custom-checkbox-202'>
                    <label for='custom-checkbox-202'></label>
                </div>
                <div class='checkbox-text'>
                    AQA
                </div>
            </div>";
        }
        if($subject['ocr'] == 'yes') {
            $boards .= "<div class='custom-checkbox'>
                <div class='custom-checkbox-inner'>
                    <input data-boards-id='203' value='OCR' type='checkbox' id='custom-checkbox-203'>
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
    public function modify_schedule($request_id) {
        $request = $this->get_request($request_id)[$request_id];

        // Ad id, student id and tutor id remains the same
        $ad_id = $request['ad_id'];
        $tutor_id = $request['tutor_id'];
        $student_id = $request['student_id'];
        
        $ad_details = $this->ad->get_single_ad($ad_id);

        $tutor_fname = $ad_details['firstname'];
        $tutor_lname = $ad_details['lastname'];
        $tutor_pfp = $ad_details['photo'];

        $requestIdInput = "<input type='hidden' id='request_id' name='request_id' value='$request_id'>";
        $adIdInput = "<input type='hidden' id='ad_id' name='ad_id' value='$ad_id'>";
        $studentIdInput = "<input type='hidden' id='student_id' name='student_id' value='$student_id'>";


        $account_type_id = user_account_type_id();

        if($account_type_id == 2) {

            $to_name = $tutor_fname;

            $student = $this->user->get_user($student_id)[$student_id];

            $student_fname = $student['firstname'];
            $student_lname = $student['lastname'];
            $student_pfp = $student['photo'];
            
            $from_name = $student_fname;

            $schedule_header = "<div class='schedule-title'>
                <h1>Schedule</h1>
                <h2>Modify your class with $to_name</h2>
            </div>";
        } else if($account_type_id == 3) {
            // User is tutor
            $from_name = $tutor_fname;
            $student = $this->user->get_user($student_id)[$student_id];

            $student_fname = $student['firstname'];
            $student_lname = $student['lastname'];
            $student_pfp = $student['photo'];
        
            $to_name = $student_fname;

            $schedule_header = "<div class='schedule-title'>
                <h1>Schedule</h1>
                <h2>Modify your class with $to_name</h2>
            </div>";
        }

        $message = $request['msg'];
        $expectation = $request['expectation'];

        $message_placeholder = "Tell $to_name a little bit more about your search for courses, your availability etc... The more information you give to your teacher, the more likely they will be to accept your request.";
        $expectation_placeholder = "Tell $to_name little bit more about your expectation from this lesson, what you hope to achieve etc... The more information you give to your teacher, the more likely they will be to accept your request.";

        $request_subjects = $request['subjects'];
        $ad_subjects_by_level_for_request = $this->ad->displaySubjectsByLevelRequest($ad_id, json_decode($request_subjects, true));
        
        // // Decode JSON into array
        // $data = json_decode($request_subjects, true);

        // $html = '<div class="sub-wrapper">
        //     <div class="sub-row-title">GCSE</div>
        //     <div class="gcse-subjects-row">';

        // foreach ($data as $id => $subject) {
        //     $html .= '
        //     <div onclick="get_subject_popup(this);" class="subject-item selected-ad-subject" data-ad-subj-id="' . $id . '">
        //         <div class="ad-subject-name">' . htmlspecialchars($subject['name']) . '</div>
        //         <div class="ad-subject-boards">';
            
        //     // Loop through the boards and append them to the HTML string
        //     foreach ($subject['boards'] as $board) {
        //         $html .= '<div data-subject-board-id="' . htmlspecialchars($board['boardId']) . '">' . htmlspecialchars($board['value']) . '</div>';
        //     }

        //     // Add the price and close the HTML structure
        //     $html .= '
        //         </div>
        //         <div data-price-id="' . $id . '">' . trim($subject['price']) . '</div>
        //     </div>';

        // }

        // $html .= '</div></div>';
        // // $ad_subjects_by_level_for_request

        echo "<div class='schedule'>
            $schedule_header

            $requestIdInput
            $adIdInput
            $studentIdInput

            <!-- Message -->
            <div class='message-wrapper' id='message-wrapper-outer'>
                <h3 class='msg-label'>
                    Your message
                    <span class='optional'></span>
                </h3>
                <textarea id='msg_student' class='textarea auto-resize' name='msg_student' placeholder='$message_placeholder' rows='8' cols='80'>$message</textarea>

                <div class='error' id='messageError'></div>

            </div>
            <div class='message-wrapper' id='expectations-wrapper-outer'>
                <h3 class='msg-label'>
                    What are your expectations from this lesson?
                    <span class='optional'></span>
                </h3>
                <textarea onkeyup='insertTypedText(this.value, \"lesson_expectations-2\")' class='textarea auto-resize' id='lesson_expectations' name='lesson_expectations' placeholder='$expectation_placeholder' rows='8' cols='80'>$expectation</textarea>
                <div class='error' id='expectationsError'></div>
            </div>

            
            <div class='radios-wrapper lesson-type-wrapper'>
                <div class='card-title'>
                    Select Lesson Type
                </div>
                <div class='radios' style='position: relative;'>
                    <div class='radio-option'>
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name='lesson_type' id='free' type='radio' value='Free intro call' checked>
                                <label class='radio-label radio-label-3 selected' for='free' onclick='select_lesson_type(this)'></label>
                            </div>
                            <div>Free intro call</div>
                        </div>
                    </div>

                    <div class='radio-option'>
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name='lesson_type' id='paid' type='radio' value='Book a lesson'>
                                <label class='radio-label radio-label-3' for='paid' onclick='select_lesson_type(this)'></label>
                            </div>
                            <div>Book a lesson</div>
                        </div>
                    </div>
                </div>
            </div>

            <div id='subjects-wrapper-outer'>
                $ad_subjects_by_level_for_request
                <div id='subjectsError' class='error'></div>
            </div>

            <div id='price-total' style='display: none;'></div>
            <div id='subjects-2' style='display: none;'></div>

            <div class='btns-wrapper' style='display: flex; justify-content: center;'>
                <span style='margin-right: 5px; color: rgb(255, 145, 77);
            background-color: #fff; border: 1px solid rgb(255, 145, 77);' class='btn next-btn' onclick=\"paymentPopup('payment-btns')\">Book lesson</span>
                <span class='btn next-btn' onclick=\"createFreeLessonRequest()\">Book free intro lesson</span>
            </div>
        </div>";
    } 
    public function get_requests_for_users($studentId, $tutorId) {
        $sql = "SELECT
                requests.request_id,
                requests.student_id,
                requests.tutor_id,
                requests.request_created_by,
                requests.subjects,
                requests.msg,
                requests.expectation,
                requests.booking_date,
                requests.booking_time,
                requests.lesson_length,
                requests.request_type,
                requests.request_status,
                requests.created_at,
                IFNULL(requests.updated_at, requests.created_at) AS effective_time,
                student.firstname AS student_firstname,
                student.lastname AS student_lastname,
                student.photo AS student_photo,
                tutor.firstname AS tutor_firstname,
                tutor.lastname AS tutor_lastname,
                tutor.photo AS tutor_photo
            FROM
                requests
            LEFT JOIN
                users AS student ON requests.student_id = student.id
            LEFT JOIN 
                users AS tutor ON requests.tutor_id = tutor.id
            WHERE 
                (requests.student_id = ? AND requests.tutor_id = ?)
                OR (requests.student_id = ? AND requests.tutor_id = ?)
            ORDER BY effective_time ASC";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('iiii', $studentId, $tutorId, $tutorId, $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $requests = [];
        while ($row = $result->fetch_assoc()) {
            $requests[] = [
                'request_id' => $row['request_id'],
                'student_id' => $row['student_id'],
                'tutor_id' => $row['tutor_id'],
                'request_created_by' => $row['request_created_by'],
                'subjects' => $row['subjects'],
                'msg' => $row['msg'],
                'expectation' => $row['expectation'],
                'booking_date' => $row['booking_date'],
                'booking_time' => $row['booking_time'],
                'lesson_length' => $row['lesson_length'],
                'request_type' => $row['request_type'],
                'request_status' => $row['request_status'],
                'created_at' => $row['created_at'],
                'effective_time' => $row['effective_time'],
                'elapsed' => isset($row['effective_time']) ? elapsed($row['effective_time']) : elapsed($row['created_at']),
                'type' => 'request',
                'student' => array(
                    'firstname' => $row['student_firstname'],
                    'lastname' => $row['student_lastname'],
                    'photo' => $row['student_photo'],
                ),
                'tutor' => array(
                    'firstname' => $row['tutor_firstname'],
                    'lastname' => $row['tutor_lastname'],
                    'photo' => $row['tutor_photo'],
                )
            ];
        }
        
        $stmt->close();
        return $requests;
    }
    public function create_request() {
        $ad_id = $_POST["ad_id"];
        $subjects = $_POST['subjects'];
        $msg = $_POST['message'];
        $expectation = $_POST['expectation'];
        $lesson_length = $_POST['lesson_length'];
        $request_type = $_POST['lesson_type'];
        $request_status = 'created';   

        $account_type_id = user_account_type_id();     
        if($account_type_id == 2) {
            // Student
            $student_id = get_uid();
        } else {
            // Tutor
            $student_id = $_POST['student_id'];
        }
        $created_at = datetime_now();

        // Student & Tutor Ids
        $ad_details = $this->ad->get_single_ad($ad_id);
        $tutor_id = $ad_details["tutor_uid"];

        $request_created_by = get_uid();

        // Decode the JSON string into a PHP array
        $datetime = json_decode($_SESSION['datetimes_2'], true);

        // Extract the date
        $date = $datetime['date'];
        // Extract the time and trim any unnecessary whitespace
        $time = trim($datetime['time']);

        $sql = "INSERT INTO requests (student_id, ad_id, tutor_id, request_created_by, subjects, msg, expectation, booking_date, booking_time, lesson_length, request_type, request_status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }  
        $stmt->bind_param("iiiisssssssss", $student_id, $ad_id, $tutor_id, $request_created_by, $subjects, $msg, $expectation, $date, $time, $lesson_length, $request_type, $request_status, $created_at);
        if ($stmt->execute()) {
            $requestId = $this->con->insert_id;

            $request_response = array(
                'request_id' => $requestId,
                'student_id' => $student_id,
                'ad_id' => $ad_id,
                'tutor_id' => $tutor_id,
                'subjects' => $subjects,
                'booking_date' => $date,
                'booking_time' => $time,
                'lesson_length' => $lesson_length,
                'request_type' => $request_type,
                'created_at' => $created_at,   
                'status' => '1',
                'error' => '0'
            );
        } else {
            $error_msg = htmlspecialchars($this->con->error) . ' ' . htmlspecialchars($stmt->error);
            
            $request_response = array (
                'status' => '0',
                'error' => '1',
                'error_msg' => $error_msg
            );

            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        $json_request_response = json_encode($request_response, true);
        $_SESSION['request'] = $json_request_response;

        return $_SESSION['request'];
    }
    public function get_my_requests($type, $request_type='all') {
        $uid = get_uid();

        if($type == 'student') {
            $sql = "SELECT
                requests.request_id,
                requests.student_id,
                requests.ad_id,
                requests.tutor_id,
                requests.subjects,
                requests.msg,
                requests.expectation,
                requests.booking_date,
                requests.booking_time,
                requests.lesson_length,
                requests.request_type,
                requests.request_status,
                requests.created_at,
                ads.tutor_uid,
                users.firstname AS tutor_firstname,
                users.lastname AS tutor_lastname,
                users.photo AS tutor_photo
            FROM
                requests
            LEFT JOIN
                ads ON requests.ad_id = ads.ad_id
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            WHERE 
                student_id = ?";

            // Append to sql query based on request type
            if($request_type == 'all') {
                $sql .= "";
            } else if($request_type == 'upcoming') {
                $sql .= " AND (
                    STR_TO_DATE(CONCAT(requests.booking_date, ' ', requests.booking_time), '%d-%m-%Y %H:%i:%s') > 
                    STR_TO_DATE(CONCAT(?, ' ', ?), '%d-%m-%Y %H:%i:%s')
                )";
            } else if($request_type == 'free') {
                $sql .= " AND requests.request_type=?";
            } else if($request_type == 'regular') {
                $sql .= " AND requests.request_type=?";
            }

            $sql .= "  ORDER BY request_id DESC";
            $stmt = $this->con->prepare($sql);
            
            // bind param query based on request type
            if($request_type == 'all') {
                $stmt->bind_param('i', $uid);
            } else if($request_type == 'upcoming') {
                $tz='America/New_York';
                $now = new DateTime("now", new DateTimeZone($tz) );
                $date = $now->format('d-m-Y');
                $time = $now->format('H:i:s');

                $stmt->bind_param('iss', $uid, $date, $time);
            } else if($request_type == 'free') {
                $stmt->bind_param('is', $uid, $request_type);
            } else if($request_type == 'regular') {
                $stmt->bind_param('is', $uid, $request_type);
            }

            
            $stmt->execute();
            $result = $stmt->get_result();
            
            $data = array();
            
            while ($row = $result->fetch_assoc()) {
                $requestId = $row['request_id'];
        
                if (!isset($data[$requestId])) {
                    $data[$requestId] = array (
                        'request_id' => $row['request_id'],
                        'ad_id' => $row['ad_id'],
                        'student_id' => $row['student_id'],
                        'tutor_id' => $row['tutor_id'],
                        'subjects' => $row['subjects'],
                        'msg' => $row['msg'],
                        'expectation' => $row['expectation'],
                        'booking_date' => $row['booking_date'],
                        'booking_time' => $row['booking_time'],
                        'lesson_length' => $row['lesson_length'],
                        'request_type' => $row['request_type'],
                        'request_status' => $row['request_status'],
                        'created_at' => $row['created_at'],
                        'elapsed' => elapsed($row['created_at']),
                        'tutor_uid' => $row['tutor_uid'],
                        'tutor_firstname' => $row['tutor_firstname'],
                        'tutor_lastname' => $row['tutor_lastname'],
                        'tutor_photo' => $row['tutor_photo']
                    );
                }
            }
        } else if($type == 'tutor') {
            $sql = "SELECT
                requests.request_id,
                requests.student_id,
                requests.ad_id,
                requests.tutor_id,
                requests.subjects,
                requests.msg,
                requests.expectation,
                requests.booking_date,
                requests.booking_time,
                requests.lesson_length,
                requests.request_type,
                requests.request_status,
                requests.created_at,
                ads.tutor_uid,
                users.firstname AS student_firstname,
                users.lastname AS student_lastname,
                users.photo AS student_photo
            FROM
                requests
            LEFT JOIN
                ads ON requests.ad_id = ads.ad_id
            LEFT JOIN
                users ON requests.student_id = users.id
            WHERE 
                requests.tutor_id = ?";

            // Append to sql query based on request type
            if($request_type == 'all') {
                $sql .= "";
            } else if($request_type == 'upcoming') {
                $sql .= " AND (
                    STR_TO_DATE(CONCAT(requests.booking_date, ' ', requests.booking_time), '%d-%m-%Y %H:%i:%s') > 
                    STR_TO_DATE(CONCAT(?, ' ', ?), '%d-%m-%Y %H:%i:%s')
                )";
            } else if($request_type == 'free') {
                $sql .= " AND requests.request_type=?";
            } else if($request_type == 'regular') {
                $sql .= " AND requests.request_type=?";
            }
            $sql .= "  ORDER BY request_id DESC";

            $stmt = $this->con->prepare($sql);

            // bind param query based on request type
            if($request_type == 'all') {
                $stmt->bind_param('i', $uid);
            } else if($request_type == 'upcoming') {
                $tz='America/New_York';
                $now = new DateTime("now", new DateTimeZone($tz) );
                $date = $now->format('d-m-Y');
                $time = $now->format('H:i:s');

                $stmt->bind_param('iss', $uid, $date, $time);
            } else if($request_type == 'free') {
                $stmt->bind_param('is', $uid, $request_type);
            } else if($request_type == 'regular') {
                $stmt->bind_param('is', $uid, $request_type);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            
            $data = array();
            
            while ($row = $result->fetch_assoc()) {
                $requestId = $row['request_id'];
                if (!isset($data[$requestId])) {
                    $data[$requestId] = array (
                        'request_id' => $row['request_id'],
                        'ad_id' => $row['ad_id'],
                        'student_id' => $row['student_id'],
                        'tutor_id' => $row['tutor_id'],
                        'subjects' => $row['subjects'],
                        'msg' => $row['msg'],
                        'expectation' => $row['expectation'],
                        'booking_date' => $row['booking_date'],
                        'booking_time' => $row['booking_time'],
                        'lesson_length' => $row['lesson_length'],
                        'request_type' => $row['request_type'],
                        'request_status' => $row['request_status'],
                        'created_at' => $row['created_at'],
                        'elapsed' => elapsed($row['created_at']),
                        'tutor_uid' => $row['tutor_uid'],
                        'student_firstname' => $row['student_firstname'],
                        'student_lastname' => $row['student_lastname'],
                        'student_photo' => $row['student_photo']
                    );
                }
            }
        }
        // var_dump($data);
        return $data;
            
    }
    public function get_my_request($type, $request_id) {
        if($type == 'tutor') {
            $sql = "SELECT
                requests.request_id,
                requests.student_id,
                requests.ad_id,
                requests.subjects,
                requests.msg,
                requests.expectation,
                requests.day_id,
                requests.time_id,
                requests.lesson_length,
                requests.request_type,
                requests.created_at,
                ads.tutor_uid,
                users.firstname AS student_firstname,
                users.lastname AS student_lastname,
                users.photo AS student_photo
            FROM
                requests
            LEFT JOIN
                ads ON requests.ad_id = ads.ad_id
            LEFT JOIN
                users ON requests.student_id = users.id
            WHERE
                request_id = ?";

            $stmt = $this->con->prepare($sql);

            $stmt->bind_param('i', $request_id);

            $stmt = $this->con->prepare($sql);


            
            $stmt->execute();
            $result = $stmt->get_result();
            
            $data = array();
            
            while ($row = $result->fetch_assoc()) {
                $requestId = $row['request_id'];
        
                if (!isset($data[$requestId])) {
                    $data[$requestId] = array (
                        'request_id' => $row['request_id'],
                        'ad_id' => $row['ad_id'],
                        'student_id' => $row['student_id'],
                        'subjects' => $row['subjects'],
                        'msg' => $row['msg'],
                        'expectation' => $row['expectation'],
                        'day_id' => $row['day_id'],
                        'time_id' => $row['time_id'],
                        'lesson_length' => $row['lesson_length'],
                        'request_type' => $row['request_type'],
                        'created_at' => $row['created_at'],
                        'elapsed' => elapsed($row['created_at']),
                        'tutor_uid' => $row['tutor_uid'],
                        'student_firstname' => $row['student_firstname'],
                        'student_lastname' => $row['student_lastname'],
                        'student_photo' => $row['tutor_photo']
                    );
                }
            }
        } else if($type == 'student') {
            $sql = "SELECT
                requests.request_id,
                requests.student_id,
                requests.ad_id,
                requests.subjects,
                requests.msg,
                requests.expectation,
                requests.day_id,
                requests.time_id,
                requests.lesson_length,
                requests.request_type,
                requests.created_at,
                ads.tutor_uid,
                users.firstname AS tutor_firstname,
                users.lastname AS tutor_lastname,
                users.photo AS tutor_photo
            FROM
                requests
            LEFT JOIN
                ads ON requests.ad_id = ads.ad_id
            LEFT JOIN
                users ON ads.tutor_uid = users.id
            WHERE 
                request_id = ?";

            $stmt = $this->con->prepare($sql);

            $stmt->bind_param('i', $request_id);
            
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            $data = array();
                
            while ($row = $result->fetch_assoc()) {
                $requestId = $row['request_id'];
        
                if (!isset($data[$requestId])) {
                    $data[$requestId] = array (
                        'request_id' => $row['request_id'],
                        'ad_id' => $row['ad_id'],
                        'student_id' => $row['student_id'],
                        'subjects' => $row['subjects'],
                        'msg' => $row['msg'],
                        'expectation' => $row['expectation'],
                        'day_id' => $row['day_id'],
                        'time_id' => $row['time_id'],
                        'lesson_length' => $row['lesson_length'],
                        'request_type' => $row['request_type'],
                        'created_at' => $row['created_at'],
                        'elapsed' => elapsed($row['created_at']),
                        'tutor_uid' => $row['tutor_uid'],
                        'tutor_firstname' => $row['tutor_firstname'],
                        'tutor_lastname' => $row['tutor_lastname'],
                        'tutor_photo' => $row['tutor_photo']
                    );
                }
            }
        }
        return $data;
    }
    public function get_request($request_id) {
        $sql = "SELECT
            requests.request_id,
            requests.student_id,
            requests.ad_id,
            requests.tutor_id,
            requests.subjects,
            requests.msg,
            requests.expectation,
            requests.booking_date,
            requests.booking_time,
            requests.lesson_length,
            requests.request_type,
            requests.request_status,
            requests.created_at,
            student.firstname AS student_firstname,
            student.lastname AS student_lastname,
            student.photo AS student_photo,
            tutor.firstname AS tutor_firstname,
            tutor.lastname AS tutor_lastname,
            tutor.photo AS tutor_photo
        FROM
            requests
        LEFT JOIN
            users AS student ON requests.student_id = student.id
        LEFT JOIN 
            users AS tutor ON requests.tutor_id = tutor.id
        WHERE
            request_id = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();
        
        while ($row = $result->fetch_assoc()) {
            $requestId = $row['request_id'];
    
            if (!isset($data[$requestId])) {
                $data[$requestId] = array (
                    'request_id' => $row['request_id'],
                    'student_id' => $row['student_id'],
                    'ad_id' => $row['ad_id'],
                    'tutor_id' => $row['tutor_id'],
                    'subjects' => $row['subjects'],
                    'msg' => $row['msg'],
                    'expectation' => $row['expectation'],
                    'booking_date' => $row['booking_date'],
                    'booking_time' => $row['booking_time'],
                    'lesson_length' => $row['lesson_length'],
                    'request_type' => $row['request_type'],
                    'request_status' => $row['request_status'],
                    'created_at' => $row['created_at'],
                    'student' => array(
                        'firstname' => $row['student_firstname'],
                        'lastname' => $row['student_lastname'],
                        'photo' => $row['student_photo'],
                    ),
                    'tutor' => array(
                        'firstname' => $row['tutor_firstname'],
                        'lastname' => $row['tutor_lastname'],
                        'photo' => $row['tutor_photo'],
                    )
                );
            }
        }

        return $data;
    }
    public function get_request_tutor_id($request_id) {
        $sql = "SELECT tutor_id FROM requests WHERE request_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            return $row['tutor_id'];
        }
    }
    /*
    =================================================================
        DISPLAY
    =================================================================
    */
    public function my_request($type, $request_id) {

        $reqs = $this->get_my_request($type, $request_id);

        foreach ($reqs as $req) {
            $req = $req;
        }

        // Details
        if($type == 'tutor') {
            $fname = $req['student_firstname'];
            $lname = $req['student_lastname'];
            $pfp = $req['student_photo'];
        } else if($type == 'student') {
            $fname = $req['tutor_firstname'];
            $lname = $req['tutor_lastname'];
            $pfp = $req['tutor_photo'];
        }

        // Photo
        if(!empty($req['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$pfp}' alt='avatar'>";
        } else {
            $str = $fname;
            $fChar = $str[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }


        // var_dump($req);

        $reqStr = "<ul class='messages'>";
        
        $f = substr($req['tutor_firstname'], 0, 1);

        $reqStr .= "<li class='one-demand' id='request-{$req['request_id']}'>
            <div class='infos-container'>
                <span class='avatar img-40'>
                    $photo
                </span>
                <div class='sender-infos'>
                    <p class='firstname'>{$fname}</p>
                    <p class='mat-name'>Maths tutor</p>
                </div>
                <span class='last-text has-space'></span>
            </div>
            <div class='float-state-container'>
                <span class='new waiting-payment'> Awaiting payment </span>
                <br>
                <p class='date'>{$req['elapsed']}</p>
            </div>
        </li>";
    
        $reqStr .= "</ul>";

        echo $reqStr;
    }
    public function my_requests($type, $request_type='all') {

        $reqs = $this->get_my_requests($type, $request_type);


        
        if($type == 'student') {
            $reqStr = "<ul class='messages'>";
            foreach($reqs as $req) {
                $request_id = $req['request_id'];

                
                $dt = $req['booking_date'] . ' ' . $req['booking_time'];
                $state = compare_datetime($dt);

                // Cancel Button
                $exclude_status = array('canceled', 'refunded');
                $cancelBtn = "";
                if(!in_array($req['request_status'], $exclude_status)) {
                    if($state == '0') {
                        $hours = hours_until_datetime($dt);
                        // echo "<br>";
                        if($hours > 24) {
                            $cancelBtn = "<a onclick='cancel_request(event, $request_id)' class='cancel'>Cancel</a>";
                        }
                    }
                }
                
                $linksHtml = "<div class='links'>
                    <a class='view' href='request-details?rid={$req['request_id']}'>View Details</a>
                    $cancelBtn
                </div>";
                
                $f = substr($req['tutor_firstname'], 0, 1);
    
                $reqStr .= "<li class='one-demand' id='request-{$req['request_id']}'>
                    <div class='one-demand-inner'>
                        <div class='infos-container'>
                            <span class='avatar img-40'>
                                <img class='classic' style='--letter: '$f';' src='./assets/avatars/{$req['tutor_photo']}' alt='avatar'>
                            </span>
                            <div class='sender-infos'>
                                <p class='firstname'>{$req['tutor_firstname']}</p>
                                <p class='mat-name'>Maths tutor</p>
                            </div>
                            <span class='last-text has-space'></span>
                        </div>
                        <div class='float-state-container'>
                            <span class='new waiting-payment' style='text-transform: capitalize;'> {$req['request_status']} </span>
                            <br>
                            <p class='date'>{$req['elapsed']}</p>
                        </div>
                    </div>
                    
                    $linksHtml
                </li>";
            }
            $reqStr .= "</ul>";
        } else if($type == 'tutor') {

            $reqStr = "<ul class='messages'>";
            foreach($reqs as $req) {
                $request_id = $req['request_id'];

                $dt = $req['booking_date'] . ' ' . $req['booking_time'];
                $state = compare_datetime($dt);

                // Refund Button
                $exclude_status = array('canceled', 'refunded');
                $refundBtn = "";
                if(!in_array($req['request_status'], $exclude_status)) {
                    if($state == '0') {
                        $hours = hours_since_datetime($dt);
                        // echo "<br>";
                        // if($hours > 24) {
                            $refundBtn = "<a onclick='cancel_request(event, $request_id)' class='refund'>Refund</a>";
                        // }
                    }
                }

                $linksHtml = "<div class='links'>
                    <a class='view' href='request-details?rid={$req['request_id']}'>View Details</a>
                    $refundBtn
                </div>";

                $f = substr($req['student_firstname'], 0, 1);
    
                $reqStr .= "<li class='one-demand' id='request-{$req['request_id']}'>
                    <div class='one-demand-inner'>
                        <div class='infos-container'>
                            <span class='avatar img-40'>
                                <img class='classic' style='--letter: '$f';' src='./assets/avatars/{$req['student_photo']}' alt='avatar'>
                            </span>
                            <div class='sender-infos'>
                                <p class='firstname'>{$req['student_firstname']}</p>
                                <p class='mat-name'>Maths student</p>
                            </div>
                            <span class='last-text has-space'></span>
                        </div>
                        <div class='float-state-container'>
                            <span class='new waiting-payment' style='text-transform: capitalize;'> {$req['request_status']} </span>
                            <br>
                            <p class='date'>{$req['elapsed']}</p>
                        </div>
                    </div>
                    $linksHtml
                    
                </li>";
            }
            $reqStr .= "</ul>";
        }


        echo $reqStr;
    }
    public function get_student_request($ad_id) {
        $uid = get_uid();
        $stmt = $this->con->prepare("SELECT * FROM requests WHERE ad_id = ? AND student_id = ?");
        $stmt->bind_param('ii', $ad_id, $uid);
        $stmt->execute();
        $result = $stmt->get_result();     
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;     
    }
}

?>