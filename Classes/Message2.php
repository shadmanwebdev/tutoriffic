<?php
/*
    _doHttpGet($url)
    get_products()
    products()
    updateForm()
*/
class Message2 extends Db {
    public function __construct() {
        $this->con = $this->con();
    }
    public function startSession() {
        ob_start();
        session_start();
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    public function datetime_array($datetime_str) { // '2023-04-06T22:48:00.000Z'
        $date = new DateTime($datetime_str, new DateTimeZone('UTC'));

        $date_formatted = $date->format('F j, Y'); // Output: April 6, 2023
        $time_formatted = $date->format('g:ia'); // Output: 10:48pm

        return array(
            'date' => $date_formatted,
            'time' => $time_formatted
        );
    }
    public function get_message($id) {
        $stmt = $this->con->prepare("SELECT * FROM msgs WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(count($data) > 0) {
            foreach($data as $row):
                $message_array = array(
                    "id" => $row['id'],
                    "firstname" => $row['firstname'],
                    "lastname" => $row['lastname'],
                    "email" => $row['email'],
                    "msg_subject" => $row['msg_subject'],
                    "msg" => nl2br($row['msg']),
                    "created_at" => $row['created_at'],
                    'date' => $this->datetime_array($row['created_at'])['date'],
                    'time' => $this->datetime_array($row['created_at'])['time']
                );
            endforeach;
        }
        return $message_array;
    }
    public function get_messages() {
        $stmt = $this->con->prepare("SELECT * FROM msgs ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $messages_array = array();
        if(count($data) > 0) {
            foreach($data as $row):
                $message_array = array(
                    "id" => $row['id'],
                    "firstname" => $row['firstname'],
                    "lastname" => $row['lastname'],
                    "email" => $row['email'],
                    "msg_subject" => $row['msg_subject'],
                    "msg" => nl2br($row['msg']),
                    "created_at" => $row['created_at'],
                    'date' => $this->datetime_array($row['created_at'])['date'],
                    'time' => $this->datetime_array($row['created_at'])['time']
                );
                array_push($messages_array, $message_array);
            endforeach;
        }
        return $messages_array;
    }
    public function message($msg_id) {
        // <hr>
        // <input type='hidden' name='email' id='email' value={$msg_array['email']} />
        // <div class='form-group p-t-15 w-100'>
        //     <textarea class='w-100 p-20 l-border-1' name='reply' id='reply' cols='30' rows='5' placeholder=\"It's really an amazing.I want to know more about it..!\"></textarea>
        //     <div class='error' id='replyError'></div>
        // </div>

        // <div class=''>
        //     <div class='text-right'>
        //         <span onclick='reply(event);' class='btn btn-primary w-md m-b-30'>Send</span>
        //     </div>
        //     <div id='message-response'></div>
        // </div>
        
        $msg_array = $this->get_message($msg_id);

        $datetime_array = datetime_array($msg_array['created_at']);
        $date = $datetime_array['date'];
        $time = $datetime_array['time'];

        $msg = paragraphs($msg_array['msg']);

        echo "<div class='read-content'>
            <div class='media'>
                <div class='media-body'>
                    <h5 class='m-b-3'>{$msg_array['firstname']} {$msg_array['lastname']}</h5>
                    <p style='margin: 0;'>{$date} {$time}</p>
                </div>  
            </div>
            <hr>
            <div class='media mb-4 mt-1'>
                <div class='media-body'>
                    <h4 class='m-0 text-primary'>{$msg_array['msg_subject']}</h4><small class='text-muted'>To: Me, smartlyclean.com</small>
                </div>
            </div>
            <p style='margin-bottom: 1rem;'>Email: {$msg_array['email']}</p>
            $msg







        </div>
        ";
    }
    function msgs_table_header() {
        return "<table class='table table-hover my-0'>
            <thead>
                <tr>
                    <th class='d-none'>Name</th>
                    <th class='d-none'>Email</th>
                    <th class='d-none'>Date & Time</th>
                </tr>
            </thead>
            <tbody>";
    }
    function msgs_table_footer() {
        return "</tbody>
            </table>";
    }
    function msgs_row_html($msg_array) {
        $datetime_array = datetime_array($msg_array['created_at']);
        $date = $datetime_array['date'];
        $time = $datetime_array['time'];
        return "<tr onclick=\"goto('./message?id={$msg_array['id']}')\">
            <td class='d-none'>{$msg_array['firstname']} {$msg_array['lastname']}</td>
            <td class='d-none'>{$msg_array['email']}</td>
            <td class='d-none'>{$date} {$time}</td>
        </tr>";
    }
    public function messages() {
        /*

        ========================================================
            Alter:
            1. $msgs_array = $this->get_messages();
            2. $num_of_rows = count($msgs_array);
            3. $msg_array = $msgs_array[$x];
            4. $contentStr .= $this->_table_footer();
            5. $contentStr .= $this->_row_html($msg_array);
            6. $contentStr .= $this->_table_footer();
        ========================================================

        */

        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);

        // Get array of arrays
        $msgs_array = $this->get_messages();

        $num_of_rows = count($msgs_array);

        $results_per_page = 5;

        // Number of total pages available
        $num_of_pages = ceil($num_of_rows/$results_per_page);


        // Determine which page user is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;

        $starting_limit_number = ($page-1)*$results_per_page;

        $contentStr = "";
        $contentStr .= $this->msgs_table_header();
        for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
            if($x < $num_of_rows) {
                // Get item array
                $msg_array = $msgs_array[$x];

                // Create the html to be appended for each item
                $contentStr .= $this->msgs_row_html($msg_array);
            }
        }
        $contentStr .= $this->msgs_table_footer();

        // Previous & next page
        $prev = ($page == 1) ? $page : ($page - 1);
        $next = ($page == $num_of_pages) ? $page : ($page + 1);





        $paging = "<div class='pagination'>
        <div>
            <a class='page-num arrow' href='./$pagename?page=" . ($page > 1 ? ($page - 1) : 1) . "'>
                <i class='fas fa-arrow-left'></i>
            </a>
        </div>
        <div class='pagination-links'>";

        // Show links only if there is more than one page
        if ($num_of_pages > 1) {
            // Show the current page and links for next 2 pages
            for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
                if ($p != $page) {
                    $paging .= "<a class='page-num' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
                } else {
                    $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
                }
            }
            // Skip links for 2 pages
            if ($page + 5 < $num_of_pages) {
                $paging .= "<span>...</span> ";
            }
            // Show the link for the 6th page if available
            if ($page + 4 < $num_of_pages) {
                $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 4) . "'>" . ($page + 4) . "</a> ";
            } 
            else if ($page + 3 < $num_of_pages) {
                $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 3) . "'>" . ($page + 3) . "</a> ";
            }
        } else {
            // If there's only one page, show the link for the current page and previous/next page links
            $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $page . "'>" . $page . "</a> ";
        }

        $paging .= "</div>
            <div>
                <a class='page-num arrow' href='./$pagename?page=" . ($page < $num_of_pages ? ($page + 1) : $num_of_pages) . "'>
                    <i class='fas fa-arrow-right'></i>
                </a>
            </div>
        </div>";

        $contentStr .= $paging;
        echo $contentStr;
    }
    public function create() {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $msg_subject = $_POST['topic'];
        $message = $_POST['message'];   

        $created_at = datetime_now();
        
        $stmt = $this->con->prepare("INSERT INTO msgs (firstname, lastname, email, msg_subject, msg, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $msg_subject, $message, $created_at);
        if($stmt->execute()) {
            // $smtp_details = $this->smtp_details();
            
            // $subject = "Email from SmartlyClean";
            // $msgBody .= "<p>Hi. Thank you for contacting us. This email was sent to confirm that we've recieved your message. We'll contact you with a detailed response about your inquiry soon via this email address or your provided phone number. </p>";
            // // var_dump($smtp_details, $email, $subject, $msgBody);
            // // sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $to, $subject, $msgBody);
            // sendEmailSwiftMailer($smtp_details['smtp_host'], $smtp_details['smtp_port'], $smtp_details['smtp_encryption'], $smtp_details['username'], $smtp_details['pwd'], $_POST['email'], $subject, $msgBody);
            $status = "1";
        } else {
            $status = "0";
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
    public function reply() {
        $reply = $_POST['reply'];
        $email = $_POST['email'];
        $smtp_details = $this->smtp_details();

        $subject = 'Message from Hobby Shop';
        $msgBody = "<p>$reply</p>";
        
        sendEmailSwiftMailer($smtp_details['smtp_host'], $smtp_details['smtp_port'], $smtp_details['smtp_encryption'], $smtp_details['username'], $smtp_details['pwd'], $email, $subject, $msgBody);

        echo '1';
    }
    public function get_contact_details() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM contact_details WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $contact_details_array = array(
                'address' => $row['addr'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'website' => $row['website']
            );
        endforeach;
        $stmt->close();

        return $contact_details_array;
    }
    public function contact_details() {
        $contact_details = $this->get_contact_details();

        $contactStr = "<ul class='contact-info'>
            <li><strong>Address: </strong> {$contact_details['address']}</li>
            <li><strong>Phone: </strong>{$contact_details['phone']}</li>
            <li><strong>Email: </strong><a href='#'>{$contact_details['email']}</a></li>
            <li><strong>Website: </strong><a href='#'>{$contact_details['website']}</a></li>
        </ul>";

        echo $contactStr;
    }
    public function updateForm() {
        $contact_details = $this->get_contact_details();
        return "
        <form autocomplete='off' id='update_contact_details_form' class='update_contact_details_form' method='POST'>       
            <h4 class='form-title'>Contact Details</h4>                   
            <input type='hidden' name='update_contact_details' id='update_contact_details' value='true'>
            <div class='mb-3'>
                <label class='form-label' for='name'>Address: </label>
                <input type='text' name='address' id='address' class='form-control' placeholder='Address' value='{$contact_details['address']}'>
                <div class='error' id='addressError'></div>
            </div>
            <div class='mb-3'>
                <label class='form-label' for='phone'>Phone: </label>
                <input type='text' name='phone' id='phone' class='form-control' placeholder='Phone' value='{$contact_details['phone']}'>
                <div class='error' id='phoneError'></div>
            </div>     
            <div class='mb-3'>
                <label class='form-label' for='email'>Email: </label>
                <input type='text' name='email' id='email' class='form-control' placeholder='Email' value='{$contact_details['email']}'>
                <div class='error' id='emailError'></div>
            </div>     
            <div class='mb-3'>
                <label class='form-label' for='website'>Website: </label>
                <input type='text' name='website' id='website' class='form-control' placeholder='Website' value='{$contact_details['website']}'>
                <div class='error' id='websiteError'></div>
            </div>     
            <div>
                <span style='margin-top: 10px;' onclick='return update_contact_details(event)' type='submit' name='update_contact_details' class='btn btn-primary'>Submit</span>  
            </div>
            <div class='message-response' id='message-response-1'></div>
        </form>";
    }
    public function update_contact_details() {
        $id = 1;
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        
        $stmt = $this->con->prepare("UPDATE contact_details SET addr=?, phone=?, email=?, website=? WHERE id=?");
        $stmt->bind_param('ssssi', $address, $phone, $email, $website , $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }



    public function updateContactPageForm() {
        $contact_page_array = $this->get_contact_page();

        return "
        <form autocomplete='off' id='contact_update_form' class='contact_update_form' method='POST'>                          
            <input type='hidden' name='update_contact_page' id='update_contact_page' value='true'>
            <div class='mb-3'>
                <label class='form-label' for='title'>Title: </label>
                <input type='text' title='title' id='title' class='form-control' placeholder='title' value='{$contact_page_array['title']}'>
                <div class='error' id='titleError'></div>
            </div>
            <div class='mb-3'>
                <label for='subtitle' class='form-label'>Subtitle: </label>
                <textarea class='form-control' name='subtitle' id='subtitle' rows='5'>{$contact_page_array['subtitle']}</textarea>
                <div class='error' id='subtitleError'></div>
            </div> 
            <div>
                <span style='margin-top: 10px;' onclick='return update_contact_page()' type='submit' name='update_contact_page' class='btn btn-primary'>Submit</span>  
            </div>
            <div id='message-response'></div>
        </form>";
    }
    public function update_contact_page() {
        $id = 1;

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        
        $stmt = $this->con->prepare("UPDATE contact_page SET title=?, subtitle=? WHERE id=?");
        $stmt->bind_param('ssi', $title, $subtitle, $id);
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