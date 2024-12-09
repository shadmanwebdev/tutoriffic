<?php

    /*

    =================================================================
        CRUD
        FORMS
        IMAGE & VIDEOS
        DISPLAY
        DATA MANIPULATION

        from_user.lastname AS from_lastname
        --------------------------------------
        Showing messages between two users
        --------------------------------------
        1. message.php
            -> display_user_list()
        2. user-msg.php
            -> display_user_messages() 
                -> get_messages_for_user()
                -> message()
                    -> get_msg_by_id()
    =================================================================  

    */

    class Message extends Db {
        public function __construct() {
            $this->con = $this->con();
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

            $stmt = $this->con->prepare("INSERT INTO msgs (
            msg_content, from_id, to_id, msg_created_at)
            VALUES (?, ?, ?, ?)");
            $stmt->bind_param('siis', $msg_content, $from_id, $to_id, $msg_created_at);
            if($stmt->execute()) {
                $msg_id = $stmt->insert_id;
                $stmt->close();


                if(isset($_FILES['image'])) {
                    // Loop through each file
                    foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
    
                        // Check if the input file is not empty
                        if (!empty($filename)) {
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            
                            // Generate a unique filename
                            $uniquesavename = time() . uniqid(rand(10, 20));
                            $tempname = $_FILES['image']['tmp_name'][$key];

                            // Move the uploaded file to the destination directory based on size
                            $filename = $uniquesavename . '.' . $ext;

                            if (move_uploaded_file($tempname, $destFile)) {
                                // File moved successfully
                            } else {
                                echo 'Error moving the file.';
                            }
                        }
                        
                        // After all versions of an image are uploaded, pass the array to your function
                        $this->insert_file($msg_id, $filename, $ext, $msg_created_at);
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
                        $message["files"][] = $file;
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
        public function message($msg_id) {
            /*
                1. Get the message
                2. Turn the text content into paragraphs
            */
            $msg_array = $this->get_msg_by_id($msg_id)[$msg_id];

            $msg_content = segment($msg_array['msg_content'], 30);

            $num_of_files = count($msg_array['files']);

            $content = paragraphs($msg_array['msg_content']);

            $datetime_array = datetime_array($msg_array['msg_created_at']);
            $date = $datetime_array['date'];
            $time = $datetime_array['time'];


            $flStr = "";
            if ($num_of_files > 0) {
                $flStr .= "<div class='files-wrapper'>";
                foreach($msg_array['files'] as $file) {

                    $flStr .= "<div class='file-wrapper'>
                        <a target='_blank' href='../msg/files/{$file['msg_filename']}'></a>
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
            $messages = $this->get_messages_for_user($currentUserId, $selectedUserId);
            echo '';
            foreach ($messages as $msg) {
                $this->message($msg['msg_id']);
            }
            echo "<div class='message'></div>";
        }    
        public function display_user_list($orderBy, $direction, $userId2, $limit = null) {
            $outer_array = $this->get_user_list($orderBy, $direction, $userId2, $limit);            
            $msgs_array = $outer_array[0];
            $uniqueUsers = $outer_array[1];

            // Generate the user list
            $userListHtml = '<div class="user-list">';
            foreach ($uniqueUsers as $userId => $value) {
            
                $user = $this->getAssociatedUser($userId);
                
                $userListHtml .= '<div class="user-row" data-userid="' . $userId . '">';
                $userListHtml .= '<div class="msg-photo"><img src="./assets/avatars/'.$user['photo'].'"></div>';
                $userListHtml .= '<div class="fn">' . $user['firstname'] . ' ' . $user['lastname'] . '</div>';
                $userListHtml .= '</div>';
                    
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
            $stmtimg->bind_param('issss', $file_msg_id, $msg_filename, $msg_file_type, $file_uploaded_at);
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