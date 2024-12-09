<?php

    /*

    =================================================================
        CRUD
        FORMS
        IMAGE & VIDEOS
        DISPLAY
        DATA MANIPULATION
    =================================================================  
    */

    class Message {
        public $con;
        public $request;
        public $ad;
    
        private static $instance = null; 

        public function __construct()
        {
            $this->con = Db::getInstance()->con(); 
            $this->request = Request::getInstance();
            $this->ad = Ad::getInstance();
        }
    
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function startSession() {
            if(!isset($_SESSION)) {
                ob_start();
                session_start();
            }
        }
        public function endSession() {
            if(isset($_SESSION)) {
                session_unset();
                session_destroy();
            }
        }
        public function create_message() {
            $msg_content = $_POST['content'];
            
            $from_id = get_uid();
            $to_id = $_POST['to_id'];
            $msg_created_at = datetime_now();

            $account_type_id = $this->get_account_type_id($from_id);
            if($account_type_id == '3') {
                $canTutorMessage = $this->canTutorMessage($from_id);
                // var_dump($canTutorMessage);
            } else {
                $canTutorMessage = true;
            }
            
            if($canTutorMessage) {
                $stmt = $this->con->prepare("INSERT INTO msgs (
                msg_content, from_id, to_id, msg_created_at)
                VALUES (?, ?, ?, ?)");
                $stmt->bind_param('siis', $msg_content, $from_id, $to_id, $msg_created_at);
                if($stmt->execute()) {
                    $msg_id = $stmt->insert_id;
                    $stmt->close();
    
    
                    if (isset($_FILES['image'])) {
                        // Loop through each file
                        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
                            
                            // Get the original filename
                            $filename = $_FILES['image']['name'][$key];
                            
                            // Check if the input file is not empty
                            if (!empty($filename)) {
                                // Extract the file extension
                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                
                                // Generate a unique filename
                                $uniquesavename = time() . uniqid(rand(10, 20));
                                $new_filename = $uniquesavename . '.' . $ext;
                    
                                $destFile = "../uploads/msg/files/" . $new_filename;
                                $tempname = $_FILES['image']['tmp_name'][$key];
                                
                                // Check if file is uploaded before moving it
                                if (is_uploaded_file($tempname)) {
                                    if (move_uploaded_file($tempname, $destFile)) {
                                        // File moved successfully
                                        // After all versions of an image are uploaded, pass the array to your function
                                        $this->insert_file($msg_id, $new_filename, $ext, $msg_created_at);
                                    } else {
                                        echo 'Error moving the file.';
                                    }
                                } else {
                                    echo 'File upload error.';
                                }
                            }
                        }
                    }
                    
    
                    // Call the message function to display the newly created message
                    $message = $this->message($msg_id);
                    
                    $status = '1';
                } else {
                    $status = '0';
                    die('prepare() failed: ' . htmlspecialchars($this->con->error));
                    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }
                echo $message;
            } else {
                echo 'message limit exceeded';
            }
        }
        public function get_msg_by_id($msg_id) {
            $sql = "SELECT
                msgs.msg_id,
                msgs.msg_content,
                msgs.from_id,
                msgs.to_id,
                msgs.msg_created_at,
                msg_files.file_id,
                msg_files.msg_filename,
                msg_files.msg_file_type,
                from_user.photo AS from_photo,
                from_user.firstname AS from_firstname,
                from_user.lastname AS from_lastname,
                to_user.photo AS to_photo,
                to_user.firstname AS to_firstname,
                to_user.lastname AS to_lastname
            FROM 
                msgs
            LEFT JOIN 
                users AS from_user ON msgs.from_id = from_user.id
            LEFT JOIN 
                users AS to_user ON msgs.to_id = to_user.id
            LEFT JOIN 
                msg_files ON msgs.msg_id = msg_files.file_msg_id
            WHERE 
                msgs.msg_id = ?;";

            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $msg_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $messages = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msgId = $row['msg_id'];
                    if (!isset($messages[$msgId])) {
                        $messages[$msgId] = [
                            "msg_id" => $row['msg_id'],
                            "msg_content" => $row['msg_content'],
                            "from_id" => $row['from_id'],
                            "to_id" => $row['to_id'],
                            "msg_created_at" => $row['msg_created_at'],
                            "from_photo" => $row['from_photo'],
                            "from_firstname" => $row['from_firstname'],
                            "from_lastname" => $row['from_lastname'],
                            "to_photo" => $row['to_photo'],
                            "to_firstname" => $row['to_firstname'],
                            "to_lastname" => $row['to_lastname'],
                            "files" => []
                        ];
                    }

                    if (!empty($row['file_id'])) {
                        $file = [
                            "file_id" => $row['file_id'],
                            "msg_filename" => $row['msg_filename'],
                            "msg_file_type" => $row['msg_file_type'],
                        ];
                        // var_dump($file);
                        $messages[$msgId]["files"][] = $file;
                    }
                }
            }

            $stmt->close();

            return $messages;
        }
        public function get_single_msg($msg_id) {
            $msg_array = $this->get_msg_by_id($msg_id);
            return $msg_array;
        }
        public function get_messages($orderBy, $direction, $limit = null) {
            $sql = "SELECT
                msgs.msg_id,
                msgs.msg_content,
                msgs.from_id,
                msgs.to_id,
                msgs.msg_created_at,
                msg_files.file_id,
                msg_files.msg_filename,
                msg_files.msg_file_type,
                from_user.photo AS from_photo,
                from_user.firstname AS from_firstname,
                from_user.lastname AS from_lastname,
                to_user.photo AS to_photo,
                to_user.firstname AS to_firstname,
                to_user.lastname AS to_lastname
            FROM 
                msgs
            LEFT JOIN 
                users AS from_user ON msgs.from_id = from_user.id
            LEFT JOIN 
                users AS to_user ON msgs.to_id = to_user.id
            LEFT JOIN 
                msg_files ON msgs.msg_id = msg_files.file_msg_id
            ORDER BY m.$orderBy $direction";
            $sql .= ($limit != null) ? " LIMIT $limit" : '';
        
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                die("Prepare error: " . $this->con->error); // Print out the error message
            }
            $stmt->execute();
            
            $result = $stmt->get_result();
            $messages = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $msgId = $row['msg_id'];
                    if (!isset($messages[$msgId])) {
                        $messages[$msgId] = [
                            "msg_id" => $row['msg_id'],
                            "msg_content" => $row['msg_content'],
                            "from_id" => $row['from_id'],
                            "to_id" => $row['to_id'],
                            "msg_created_at" => $row['msg_created_at'],
                            "from_photo" => $row['from_photo'],
                            "from_firstname" => $row['from_firstname'],
                            "from_lastname" => $row['from_lastname'],
                            "to_photo" => $row['to_photo'],
                            "to_firstname" => $row['to_firstname'],
                            "to_lastname" => $row['to_lastname'],
                            "files" => []
                        ];
                    }

                    if (!empty($row['file_id'])) {
                        $file = [
                            "file_id" => $row['file_id'],
                            "msg_filename" => $row['msg_filename'],
                            "msg_file_type" => $row['msg_file_type'],
                        ];
                        $message["files"][] = $file;
                    }

                    $messages[] = $message;
                }
            }

            $stmt->close();

            return $messages;
        }
        public function get_user_list($orderBy, $direction, $userId, $limit = null) {  
            $sql = "SELECT
                msgs.msg_id,
                msgs.msg_content,
                msgs.from_id,
                msgs.to_id,
                msgs.msg_created_at,
                msg_files.file_id,
                msg_files.msg_filename,
                msg_files.msg_file_type,
                from_user.photo AS from_photo,
                from_user.firstname AS from_firstname,
                from_user.lastname AS from_lastname,
                to_user.photo AS to_photo,
                to_user.firstname AS to_firstname,
                to_user.lastname AS to_lastname
            FROM 
                msgs
            LEFT JOIN
                users AS from_user ON msgs.from_id = from_user.id
            LEFT JOIN 
                users AS to_user ON msgs.to_id = to_user.id
            LEFT JOIN 
                msg_files ON msgs.msg_id = msg_files.file_msg_id
            WHERE 
                (msgs.from_id = ? OR msgs.to_id = ?)";
        
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                die("Prepare error: " . $this->con->error);
            }
            $stmt->bind_param('ii', $userId, $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            $messages = [];
            $uniqueUsers = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    if ($row['from_id'] != $userId) {
                        $uniqueUsers[$row['from_id']] = true;
                    }
                    if ($row['to_id'] != $userId) {
                        $uniqueUsers[$row['to_id']] = true;
                    }
            
                    $msgId = $row['msg_id'];
                    if (!isset($messages[$msgId])) {
                        $messages[$msgId] = [
                            "msg_id" => $row['msg_id'],
                            "msg_content" => $row['msg_content'],
                            "from_id" => $row['from_id'],
                            "to_id" => $row['to_id'],
                            "msg_created_at" => $row['msg_created_at'],
                            "from_photo" => $row['from_photo'],
                            "from_firstname" => $row['from_firstname'],
                            "from_lastname" => $row['from_lastname'],
                            "to_photo" => $row['to_photo'],
                            "to_firstname" => $row['to_firstname'],
                            "to_lastname" => $row['to_lastname'],
                            "files" => []
                        ];
                    }

                    if (!empty($row['file_id'])) {
                        $file = [
                            "file_id" => $row['file_id'],
                            "msg_filename" => $row['msg_filename'],
                            "msg_file_type" => $row['msg_file_type'],
                        ];
                        $message["files"][] = $file;
                    }

                    $messages[] = $message;
                }
            }

            $stmt->close();

            return [$messages, $uniqueUsers];
        }  

        public function get_combined_messages_and_requests($currentUserId, $selectedUserId) {
            // Fetch messages
            $messages = $this->get_messages_for_user($currentUserId, $selectedUserId);
            
            // Fetch requests
            $requests = $this->request->get_requests_for_users($currentUserId, $selectedUserId);
        
            // Merge messages and requests into one array
            $combined = array_merge($messages, $requests);
        
            // Sort combined array by effective time (msg_created_at for messages and effective_time for requests)
            usort($combined, function ($a, $b) {
                $timeA = isset($a["msg_created_at"]) ? strtotime($a["msg_created_at"]) : strtotime($a["effective_time"]);
                $timeB = isset($b["msg_created_at"]) ? strtotime($b["msg_created_at"]) : strtotime($b["effective_time"]);
                return $timeA <=> $timeB;
            });
        
            return $combined;
        }
        

        public function request($request) {
            $fname = $request['tutor']['firstname'];
            $lname = $request['tutor']['lastname'];
            $pfp = $request['tutor']['photo'];

            $subj_ids_array = json_decode($request['subjects'], true); 
            // var_dump($subj_ids_array);

            // var_dump($request['subjects']);
            $num_of_subjects = count($subj_ids_array);

            
            $subjectsStr = "<div class='subjects-wrapper'>
                <div class='subject-label'>Subjects:</div> 
                <div class='subjects'>";

            $i = 1;

            foreach($subj_ids_array as $id => $subj_id) {
                $ad_subject = $this->ad->get_ad_subject($id);

                // Boards
                $boardsStr = "<div class='boards'>
                    <span>";
                $boards_array = array();
                if($ad_subject['edexcel'] == 'yes') {
                    array_push($boards_array, 'edexcel');
                }
                if($ad_subject['aqa'] == 'yes') {
                    array_push($boards_array, 'aqa');
                }
                if($ad_subject['ocr'] == 'yes') {
                    array_push($boards_array, 'ocr');
                }

                $b = 1;
                $num_of_boards = count($boards_array);
                foreach($boards_array as $board_name) {
                    $boardsStr .= $board_name;
                    if($num_of_boards > $b) {
                        $boardsStr .= ', ';
                    }
                    $b += 1;
                }
                $boardsStr .= "</span></div>";

                $subjectsStr .= "<div class='subject'>
                    <span>{$ad_subject['subject_name']}</span> 
                    $boardsStr
                    <div class='price'>
                        <span>USD {$ad_subject['price_hourly']} / hour</span> 
                    </div>
                </div>";



                if($num_of_subjects > $i) {
                    $subjectsStr .= ', ';
                }

                $i += 1;
            }

            $subjectsStr .= "</div></div>";
            
            $lessonLengthStr = "<div class='lesson_length'>
                <span class='label'>Duration: </span> 
                <span>{$request['lesson_length']}</span> 
            </div>";

                        
            $expectationStr = "<div class='expectation'>
                <span class='label'>Expectation: </span> 
                <span>{$request['expectation']}</span> 
            </div>";

            $dtStr = $request['booking_date'] . ' ' . $request['booking_time'];
            $dt = datetime_mjy($dtStr);
                        
            $dateStr = "<div class='date'>
                <span class='label'>Lesson Date: </span> 
                <span>{$dt}<</span> 
            </div>";    
                       
            $bookingStr = "<div class='booking-type'>
                <span class='label'>Request Type: </span> 
                <span>Free intro call</span> 
            </div>"; 
            
            $user_id = get_uid();
            $request_created_by = $request['request_created_by'];
            $request_id = $request['request_id'];
            if($request_created_by == $user_id) {
                $btns = "<div class='booking-btns'>
                    <div class='col-left'>
                        <button onclick='cancel_request(event, $request_id)' class='btn reject'>Cancel</button>
                    </div>
                    <div class='col-right'>
                        <button onclick='goto(\"./schedule-modify?rid={$request['request_id']}\")' style='margin-right: 0px;' class='btn modify'>Modify</button>
                    </div>
                </div>";
            } else {
                $btns = "<div class='booking-btns'>
                    <div class='col-left'>
                        <button onclick='goto(\"./schedule-modify?rid={$request['request_id']}\")' class='btn modify'>Modify</button>
                        <button onclick='cancel_request(event, $request_id)' class='btn reject'>Reject</button>
                    </div>
                    <div class='col-right'>
                        <button onclick='accept_request(event, $request_id)' class='btn accept'>Accept</button>
                    </div>
                </div>";
            }


                       
            // Photo
            if(!empty($pfp)) {
                $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$pfp}' alt='avatar'>";
            } else {
                $str = $fname;
                $fChar = $str[0];
                $photo = "<div class='user-no-picture'>$fChar</div>";
            }
    
    
            $requestStr = "<ul class='messages'>";
            
            $f = substr($fname, 0, 1);
    
            echo "<div class='one-demand' id='request-{$request['request_id']}'>
                <div class='one-demand-inner'>
                    <div class='image-container'>
                        <div class='avatar img-40'>
                            $photo
                        </div>
                    </div>
                    
                    <div class='infos-outer'>
                        <div class='infos-container'>
                            <div class='sender-infos'>
                                <p class='firstname'>{$fname}</p>
                                <p class='mat-name'>Maths tutor</p>
                                <div class='request-details'>
                                    $subjectsStr
                                    $lessonLengthStr
                                    <div class='datetime'>
                                        $dateStr
                                    </div>
                                    $expectationStr
                                    $bookingStr
                                </div>
                            </div>
                            <div class='float-state-container'>
                                <span class='new waiting-payment'> Awaiting payment </span>
                                <br>
                                <p class='date'>{$request['elapsed']}</p>
                            </div>
                        </div>
                        $btns
                    </div>
                </div>
            </div>";
    
        }

        public function get_messages_for_user($currentUserId, $selectedUserId) {
            $sql = "SELECT
                msgs.msg_id,
                msgs.msg_content,
                msgs.from_id,
                msgs.to_id,
                msgs.msg_created_at,
                msg_files.file_id,
                msg_files.msg_filename,
                msg_files.msg_file_type,
                from_user.photo AS from_photo,
                from_user.firstname AS from_firstname,
                from_user.lastname AS from_lastname,
                to_user.photo AS to_photo,
                to_user.firstname AS to_firstname,
                to_user.lastname AS to_lastname
            FROM 
                msgs
            LEFT JOIN
                users AS from_user ON msgs.from_id = from_user.id
            LEFT JOIN 
                users AS to_user ON msgs.to_id = to_user.id
            LEFT JOIN 
                msg_files ON msgs.msg_id = msg_files.file_msg_id
            WHERE 
                (msgs.from_id = ? AND msgs.to_id = ?) OR (msgs.from_id = ? AND msgs.to_id = ?)
            ORDER BY 
                msgs.msg_id ASC";

            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                die("Prepare error: " . $this->con->error);
            }
            $stmt->bind_param('iiii', $currentUserId, $selectedUserId, $selectedUserId, $currentUserId);
            $stmt->execute();
            $result = $stmt->get_result();

            $messages = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $msgId = $row['msg_id'];
                    if (!isset($messages[$msgId])) {
                        $messages[$msgId] = [
                            "msg_id" => $row['msg_id'],
                            "msg_content" => $row['msg_content'],
                            "from_id" => $row['from_id'],
                            "to_id" => $row['to_id'],
                            "msg_created_at" => $row['msg_created_at'],
                            "from_photo" => $row['from_photo'],
                            "from_firstname" => $row['from_firstname'],
                            "from_lastname" => $row['from_lastname'],
                            "to_photo" => $row['to_photo'],
                            "to_firstname" => $row['to_firstname'],
                            "to_lastname" => $row['to_lastname'],
                            "files" => [],
                            'type' => 'message'
                        ];
                    }

                    if (!empty($row['file_id'])) {
                        $file = [
                            "file_id" => $row['file_id'],
                            "msg_filename" => $row['msg_filename'],
                            "msg_file_type" => $row['msg_file_type'],
                        ];
                        $message["files"][] = $file;
                    }

                }
            }

            $stmt->close();

            return $messages;
        }
        /**
            * Check if at least one message to or from a user has msg_for set to 'individual'
            *
            * @param int $userId User ID to check
            * @param int $otherUserId Other user ID to check against
            * @return bool True if at least one message has msg_for set to 'individual', false otherwise
        */
        private function hasIndividualMessage($userId, $otherUserId) {
            $sql = "SELECT COUNT(*) as count FROM msgs WHERE (from_id = ? OR to_id = ?) AND msg_for = 'individual'";
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                die("Prepare error: " . $this->con->error);
            }
            $stmt->bind_param('ii', $userId, $otherUserId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        }   
        private function getAssociatedUser($userId) {
            $sql = "SELECT
                id,
                firstname,
                lastname,
                photo
            FROM users
            WHERE id = ? LIMIT 1";
        
            $stmtuser2 = $this->con->prepare($sql);
            if (!$stmtuser2) {
                die("Prepare error: " . $this->con->error);
            }
        
            $stmtuser2->bind_param('i', $userId);
            $stmtuser2->execute();
        
            $resultuser2 = $stmtuser2->get_result();
            $from = $resultuser2->fetch_all(MYSQLI_ASSOC);
        
            return $from[0];
        }
        /*
        =================================================================
            DISPLAY
        =================================================================  
        */
        public function display_messages() {
            $msgs_array = $this->get_messages('msg_id', 'DESC');
            $str = "";
            
            if (count($msgs_array)) {
                foreach ($msgs_array as $msg_array) {
                    $msg_content = segment($msg_array['msg_content'], 30);
        
                    $num_of_files = count($msg_array['files']);
        
                    $str .= "<tr class='clickable-row' data-href='./message?id={$msg_array['msg_id']}' style='cursor:pointer;'>
                        <td class='d-none d-xl-table-cell'>{$msg_array['msg_id']}</td>
                        <td class='d-none d-md-table-cell'>$num_of_files</td>
                        <td>{$msg_array['msg_created_at']}</td>
                        <td class='table-action'>
                            <a onclick='return pop(this)' href='../controllers/msg-handler?delmsg={$msg_array['msg_id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                        </td>
                    </tr>";
                }
            }
            
            echo $str;
        }
                
        public function get_account_type_id($user_id) {
            $stmt = $this->con->prepare("SELECT user_account_type_id FROM users WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['user_account_type_id'];
            }
        }
        function makeLinksClickable($text) {
            // Regex to match URLs
            return preg_replace(
                '/(https?:\/\/[^\s]+)/',
                '<a href="$1" target="_blank">$1</a>',
                $text
            );
        }
        function canTutorMessage($tutorId) {
            // Get the current date minus 30 days
            $dateLimit = date('Y-m-d H:i:s', strtotime('-30 days'));
        
            // Prepare SQL to count unique student IDs the tutor has messaged in the last 30 days
            $sql = "SELECT COUNT(DISTINCT to_id) AS unique_students 
                FROM msgs 
                WHERE from_id = ? 
                AND msg_created_at >= ?
                AND EXISTS (SELECT 1 FROM users WHERE id = to_id AND user_account_type_id = 3)";

            $stmt = $this->con->prepare($sql);
        
            // Bind parameters and execute the statement
            $stmt->bind_param("is", $tutorId, $dateLimit);
            $stmt->execute();
            $result = $stmt->get_result();
        
            // Fetch the unique student count
            $row = $result->fetch_assoc();
            return $row['unique_students'] < 10;
        }
        
        public function message($msg_id) {
            /*
                1. Get the message
                2. Turn the text content into paragraphs
            */
            $msg_array = $this->get_msg_by_id($msg_id)[$msg_id];
            // var_dump($msg_array);
            $user_id = get_uid();
            $user_account_type_id = $this->get_account_type_id($user_id);
            $from_id = $msg_array['from_id'];
            $to_id = $msg_array['to_id'];

            $scheduleBtn = "";

            /*
                Show `schedule` button for messages 
                that aren't from the logged in user

                if logged in user is tutor 
                show the button that allows tutor 
                to send booking request to student

                if logged in user is student 
                show the button that allows student 
                to send booking request to tutor
            */

            if($user_account_type_id == '2') {
                // Student
                if($user_id == $from_id) {
                    $scheduleBtn .= "";
                } else if($user_id == $to_id) {
                    $scheduleBtn .= "<span onclick=\"select_ads_popup(event, {$from_id})\" class='btn schedule'>
                        Schedule
                    </span>";
                }
            } else if($user_account_type_id == '3') {
                // Tutor
                if($user_id == $from_id) {
                    $scheduleBtn .= "";
                } else if($user_id == $to_id) {
                    $scheduleBtn .= "<span onclick=\"select_ads_popup(event, {$to_id}, {$from_id})\" class='btn schedule'>
                        Schedule
                    </span>";
                }
            }


            $msg_content = segment($msg_array['msg_content'], 30);

            $num_of_files = count($msg_array['files']);

            $msg_content = $this->makeLinksClickable($msg_array['msg_content']);
            $content = paragraphs($msg_content);


            $datetime_array = datetime_array($msg_array['msg_created_at']);
            $date = $datetime_array['date'];
            $time = $datetime_array['time'];


            $flStr = "";
            if ($num_of_files > 0) {
                $flStr .= "<div class='files-wrapper'>";
                foreach($msg_array['files'] as $file) {
                    
                    // $flStr .= "<div class='file-wrapper'>
                    //     <a style='word-break: break-all;' target='_blank' href='./uploads/msg/files/{$file['msg_filename']}'>
                    //         http://localhost/tutoriffic/messages/uploads/msg/files/{$file['msg_filename']}
                    //     </a>
                    // </div>";
                    $flStr .= "
                    <div class='file-wrapper'>
                        <a href='./uploads/msg/files/{$file['msg_filename']}' download='{$file['msg_filename']}'>
                            <i class='icon-file-o'></i>
                            <span>Download</span>
                        </a>
                    </div>";
                }
                $flStr .= "</div>";
            }
        
            
            if(isset($msg_array['from_photo'])) {
                $from_avatar = "<img src='./assets/avatars/{$msg_array['from_photo']}'>";
            } else {
                $fs = substr($msg_array['from_firstname'], 0, 1);
                $from_avatar = "<span>$fs</span>";
            }
            

            $str = "<div class='message' id='msg-{$msg_array['msg_id']}'>
                <div class='msg-main'>
            
                    <div class='msgbox-header'>
                        <div class='msg-col-left'>
                            <div class='msg-col-1'>
                                <div class='msg-photo'>
                                    $from_avatar 
                                </div>
                            </div>
                            <div class='msg-col-2'>
                                <div class='msg-from'>
                                    <div>{$msg_array['from_firstname']} {$msg_array['from_lastname']}</div>
                                </div>
                                <div class='msg-datetime'>
                                    <div>$date $time</div>
                                </div>
                            </div>
                        </div>
                        <div class='msg-col-right'>
                            $scheduleBtn
                        </div>
                    </div>
                    <div class='msgbox-body'>
                        <div class='msgbox-body-inner'>
                            <div class='msg-content'>
                                {$content}
                            </div>
                            <div class='msg-files-wrapper'>
                                $flStr
                            </div>
                        </div>
                    </div>
  
                </div>
            </div>";

            echo $str;
        }
        public function display_user_messages($currentUserId, $selectedUserId) {
            // Get messages between $currentUserId and $selectedUserId
            // $messages = $this->get_messages_for_user($currentUserId, $selectedUserId);
            $combined = $this->get_combined_messages_and_requests($currentUserId, $selectedUserId);
            echo '';
            // foreach ($messages as $msg) {
            //     $this->message($msg['msg_id']);
            // }
            
            foreach ($combined as $item) {

                // Display message
                if ($item['type'] === 'message') {
                    $this->message($item['msg_id']);
                }

                // Display request
                if ($item['type'] === 'request') {
                    $this->request($item);
                }

            }
            echo "<div class='message'></div>";
        }    
        public function display_user_list($orderBy, $direction, $userId2, $limit = null) {
            $outer_array = $this->get_user_list($orderBy, $direction, $userId2, $limit);            
            $msgs_array = $outer_array[0];
            $uniqueUsers = $outer_array[1];
            $user_account_type_id = user_account_type_id();

            // Generate the user list
            $userListHtml = '<div class="user-list">';
            foreach ($uniqueUsers as $userId => $value) {
            
                $user = $this->getAssociatedUser($userId);            
                $scheduleBtn = "";
                /*
                    Show `schedule` button for messages 
                    that aren't from the logged in user
    
                    if logged in user is tutor 
                    show the button that allows tutor 
                    to send booking request to student
    
                    if logged in user is student 
                    show the button that allows student 
                    to send booking request to tutor
                */
    
                if($user_account_type_id == '2') {
                    // Student
                    $student_id = $userId2;
                    $tutor_id = $userId;
                    $scheduleBtn .= "<span onclick=\"select_ads_popup(event, {$tutor_id})\" class='btn schedule'>
                        Schedule
                    </span>";
                } else if($user_account_type_id == '3') {
                    // Tutor
                    $student_id = $userId;
                    $tutor_id = $userId2;
                    $scheduleBtn .= "<span onclick=\"select_ads_popup(event, {$tutor_id}, {$student_id})\" class='btn schedule'>
                        Schedule
                    </span>";
                }
                
                $userListHtml .= "<div class='user-row' data-userid='$userId'>
                    <div class='msg-photo'>
                        <img src='./assets/avatars/{$user['photo']}'>
                    </div>
                    <div class='fn'>
                        <span class='name'>
                            {$user['firstname']} {$user['lastname']}
                        </span>
                        $scheduleBtn
                    </div>
                </div>";
                    
            }
            $userListHtml .= '</div>';

            // Message Form
            $msgForm = $this->message_form();


            // Generate the message display area
            $messageDisplayHtml = "
            <div class='msgbox'>
                <div class='msgbox-header-main'>
                    <i id='resetButton' class='ion-ios-arrow-back'></i>
                    <span>Messages</span>
                </div>
                <div class='msgbox-body-outer'>
                    
                    <div class='msgbox-body-inner'>

                    </div>
                    $msgForm
                </div>
            </div>";

            // Output the user list and message display area
            echo '<div class="msg-outer">'.$userListHtml . $messageDisplayHtml.'</div>';
        }  
        /*
        =================================================================
            FORMS
        =================================================================  
        */
        public function message_form() {
            $file_str = "<input class='input post-img-input' id='image' type='file' name='image[]' value='' style='display: none;' multiple>
            <div class='file-trigger' onclick='return fireButton(event);'>
                <i class='ion-android-attach'></i>
                <span id='image-name-1'></span>
            </div>";

            return "
            <form autocomplete='off' id='msg_create_form' class='col-md-12 msg_create_form' method='msg' enctype='multipart/form-data'>    
                <input type='hidden' name='create_msg' id='create_msg' value='true'>
                <input type='hidden' name='to_id' id='to_id' value=''>

                <div class='mb-3'>
                    <label for='msg_content' class='form-label'>Send message: </label>
                    <textarea class='form-control' name='msg_content' id='msg_content' rows='3'></textarea>
                    <div class='error-text' id='contentError'></div>
                    <div>
                        <input type='hidden' name='to_id' id='to_id' value=''>
                        <div class='error-text' id='toError'></div>
                    </div>
                </div>
 
            
                <div class='media-input-row'>
                    <div class='mb-3'>
                        $file_str
                    </div>
                </div>

                <div style='display: flex; justify-content: flex-end;'>
                    <span onclick='create_message(event)' onclick='create_message(event)' type='submit' name='update_event' class='h-btn'>Send</span>
                </div>
                <div id='message-response'></div>
            </form>";
        }
        /*
        =================================================================
            IMAGE & VIDEOS
        =================================================================  
        */ 
        public function insert_file($file_msg_id, $msg_filename, $msg_file_type, $file_uploaded_at) {

            $stmtimg = $this->con->prepare("INSERT INTO msg_files (
            file_msg_id, msg_filename, msg_file_type, file_uploaded_at) VALUES (?, ?, ?, ?)");
            $stmtimg->bind_param('isss', $file_msg_id, $msg_filename, $msg_file_type, $file_uploaded_at);
            if($stmtimg->execute()) {
                $img_id = $stmtimg->insert_id;
                $stmtimg->close();
                $status = '1';
            } else {
                $status = '0';
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmtimg->error));
                die('execute() failed: ' . htmlspecialchars($stmtimg->error));
            }
            return $img_id;
        }  
        public function del_file($file, $id) {
            unlink("../msg/files/$file");
            $stmt = $this->con->prepare("DELETE FROM msg_files WHERE file_id=?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmt->close();
            echo $status;
        }
    }


?>