<?php
/*
=================================================================
    SESSIONS & COOKIES
    CRUD (create, read, update, delete, login)
    DISPLAY
    MY ACCOUNT AREA
    LOGIN
    profile_dropdown()general_info_form()
=================================================================  

*/


class User {
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
    public function startSession() {
        if(!isset($_SESSION)) {
            ob_start();
            session_start();
        }
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    function users_table_header() {
        return "<table class='table table-hover my-0'>
            <thead>
                <tr>
                    <th class=''>Firstname</th>
                    <th class='d-none'>Lastname</th>
                    <th class='d-none'>Date & time</th>
                    <th class='d-none'>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";
    }
    function users_table_footer() {
        return "</tbody>
            </table>";
    }
    function users_row_html($user_array) {
        $datetime_array = datetime_array($user_array['created_at']);
        $date = $datetime_array['date'];
        $time = $datetime_array['time'];

        // var_dump($user_array['gig']);
    
        return "<tr onclick='goto(\"user-details?bid={$user_array['id']}\")'>
            <td>{$user_array['firstname']}</td>
            <td class='d-none'>{$user_array['lastname']}</td>
            <td class='d-none'>{$date} {$time}</td>
            <td class='d-none'>{$user_array['account_status']}</td>
            <td class='table-action'>
                <a target='_blank' href='./user-details?bid={$user_array['id']}' class='table-link'><i class='icon-external-link'></i></a>
                <span onclick='get_popup_content(\"{$user_array['id']}\")'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></span>
            </td>
        </tr>";
    }
    public function users_admin() {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Get array of arrays
        $users_array = $this->get_users();
    
        $num_of_rows = count($users_array);
    
        $results_per_page = 5;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page user is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        $contentStr .= $this->users_table_header();
        foreach(array_slice($users_array, $starting_limit_number, $results_per_page) as $key => $value) {
        // for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
            // if($x < $num_of_rows) {
                // Get item array
                // $gig_array = $gigs_array[$x];
                $user_array = $value;
    
                if ($user_array['user_status'] != 'Canceled') {
                    // Create the html to be appended for each item
                    $contentStr .= $this->users_row_html($user_array);
                }
            // }
        }
        $contentStr .= $this->users_table_footer();
    
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
            } else if ($page + 3 < $num_of_pages) {
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
    function new_users_admin($limit) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);

        // Get array of arrays
        $users_array = $this->get_users();

        $num_of_rows = count($users_array);

        // Check if number of rows is less than the limit
        $limit = ($limit > $num_of_rows) ? $num_of_rows : $limit;


        $contentStr = "";
        $contentStr .= $this->users_table_header();
        for($x=0; $x<$limit; $x++) {
            // Get item array
            $user_array = $users_array[$x];
            // Create the html to be appended for each item
            $contentStr .= $this->users_row_html($user_array);
        }
        $contentStr .= $this->users_table_footer();

       
        echo $contentStr;
    }
    // Prelaunch sign up
    public function prelaunch_sign_up($fname, $lname, $email, $phone, $questions, $user_account_type, $other_account_type_details, $social_media, $other_social_details) {
        $sql = "INSERT INTO user_data (first_name, last_name, email, phone, questions, account_type, other_account_type_details, social_media, other_social_details) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssssssss", $fname, $lname, $email, $phone, $questions, $user_account_type, $other_account_type_details, $social_media, $other_social_details);

        // Execute the statement
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();

        echo $status;
    }
    // User
    public function get_searched_students() {
        $stmt = $this->con->prepare("SELECT
                users.id,
                users.firstname,
                users.lastname,
                users.photo
                -- reviews.review_id,
                -- reviews.rating
            FROM
                users
            WHERE user_account_type_id = 2
            -- LEFT JOIN
            --     requests ON requests.student_id = users.id
            -- LEFT JOIN
            --     ads ON ads.ad_id = requests.ad_id
            -- LEFT JOIN
            --     reviews ON users.id = reviews.student_id
            -- LEFT JOIN
            --     ad_subjects ON ads.ad_id = ad_subjects.ad_id
            -- LEFT JOIN
            --     subjects ON ad_subjects.subj_id = subjects.subj_id
            -- LEFT JOIN
            --     ad_locations ON ads.ad_id = ad_locations.ad_id
            -- LEFT JOIN
            --     lesson_locations ON ad_locations.lesson_location_id = lesson_locations.lesson_location_id
            ORDER BY users.id DESC
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();
        
        while ($row = $result->fetch_assoc()) {
            $userId = $row['id'];
        
            if (!isset($data[$userId])) {
                $data[$userId] = array(
                    'id' => $userId,
                    'photo' => $row['photo'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname']
                );
            }
        }

        // var_dump($data);
        return $data;
    }
    public function searched_students() {
        $stds = $this->get_searched_students();

        $stdsStr = "";
        foreach($stds as $std) {
            if($std['photo'] != '') {
                $img = "<img src='./assets/avatars/{$std['photo']}' class='card-img-top' alt='Placeholder Image'>";
                
            } else {
                $img = "<img src='./assets/default-avatar-350x350.png' class='card-img-top' alt='Placeholder Image'>";
            }
            $stdsStr .= "
            <div class='col-md-4'>
                <div class='listing-item' id='{$std['id']}'>
                    <div class='listing-header'>
                        <div class='img-wrapper'>
                            $img
                        </div>
                        <div class='listing-meta'>
                            <p class='fname'>{$std['firstname']}</p>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
        echo $stdsStr;
    }
    public function update_user_details() {
        $id = get_uid();

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $date_of_birth = $_POST['date_of_birth'];
        $phone = $_POST['phone'];
        $skype_id = $_POST['skype_id'];

        $updated_at = datetime_now();

        // Update User
        $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, email=?, gender=?, date_of_birth=?, phone=?, skype_id=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssssssssi', $firstname, $lastname, $email, $gender, $date_of_birth, $phone, $skype_id, $updated_at, $id);
    
        if($stmt->execute()) {
            $stmt->close();

            $status = '1';
            // Update Availibility
            if(isset($_POST['availability'])) {
                if($_POST['availability'] == 'Available') {
                    $availability_status = 1;
                } else {
                    $availability_status = 0;
                }
                
                $stmt = $this->con->prepare("UPDATE is_available  SET availability_status=? WHERE user_id=?");
                $stmt->bind_param('ii', $availability_status, $id);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            $status = '0';
        }

        echo $status;
    }
    public function update_postal_address() {
        $id = get_uid();

        $postal_address = $_POST['address'];
        $updated_at = datetime_now();

        $stmt = $this->con->prepare("UPDATE users SET postal_address=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $postal_address, $updated_at, $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function update_profile_photo() {

        $id = get_uid();

        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['profile_photo']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../assets/avatars/'; // Update this path to your desired directory
        
            // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
            $new_filename = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
        
            // Construct the full path to save the image
            $imagePath = $imageDirectory . $new_filename;
        
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $imagePath)) {
                // Image uploaded successfully
            } else {
                // Handle the case where the image could not be moved
                $new_filename = '';
            }
        } else {
            // Handle the case where no image was provided
            $new_filename = '';
        }

        $updated_at = datetime_now();

        $stmt = $this->con->prepare("UPDATE users SET photo=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $new_filename, $updated_at, $id);
    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        
        $stmt->close();
        echo $status;
    }
    public function update_user_identification() {

        $id = get_uid();

        if (isset($_FILES['identification']) && $_FILES['identification']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['identification']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../assets/identifications/'; // Update this path to your desired directory
        
            // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
            $new_filename = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
        
            // Construct the full path to save the image
            $imagePath = $imageDirectory . $new_filename;
        
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $imagePath)) {
                // Image uploaded successfully
            } else {
                // Handle the case where the image could not be moved
                $new_filename = '';
            }
        } else {
            // Handle the case where no image was provided
            $new_filename = '';
        }

        $updated_at = datetime_now();

        $stmt = $this->con->prepare("UPDATE users SET identification_file=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $new_filename, $updated_at, $id);
    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        
        $stmt->close();
        echo $status;
    }
    public function update_user_certificate() {

        $id = get_uid();

        if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['certificate']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../assets/certificates/'; // Update this path to your desired directory
        
            // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
            $new_filename = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
        
            // Construct the full path to save the image
            $imagePath = $imageDirectory . $new_filename;
        
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $imagePath)) {
                // Image uploaded successfully
            } else {
                // Handle the case where the image could not be moved
                $new_filename = '';
            }
        } else {
            // Handle the case where no image was provided
            $new_filename = '';
        }

        $updated_at = datetime_now();

        $stmt = $this->con->prepare("UPDATE users SET certificate_file=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $new_filename, $updated_at, $id);
    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        
        $stmt->close();
        echo $status;
    }
    /*
    =================================================================
        SESSIONS & COOKIES
    =================================================================
    */

    public function get_uid() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $uid = $userdata['uid'];
            return $uid;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $uid = $userdata['uid'];
            return $uid;
        }
    }
    public function is_logged_in() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        }
    }
    public function get_user_photo() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $photo = $userdata['photo'];
            return $photo;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $photo = $userdata['photo'];
            return $photo;
        }
    }
    public function get_user_status() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $user_status = $userdata['user_status'];
            return $user_status;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $user_status = $userdata['user_status'];
            return $user_status;
        }
    }
    public function get_account_status() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $account_status = $userdata['account_status'];
            return $account_status;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $account_status = $userdata['account_status'];
            return $account_status;
        }
    }
    public function get_user_email() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $email = $userdata['email'];
            return $email;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $email = $userdata['email'];
            return $email;
        }
    }  
    public function get_user_img() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $photo = $userdata['photo'];
            if(empty($photo)) {
                $photo = 'avi.png';
            }
            return $photo ;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $photo = $userdata['photo'];
            if(empty($photo)) {
                $photo = 'avi.png';
            }
            return $photo ;
        }
    }
    public function check_user_session() {
        // var_dump($_COOKIE['user'], $_SESSION['user']);
        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
        if($_SERVER['SERVER_NAME'] == 'localhost') {
            $folder = $uriArray[2];
        } else {
            $folder = $uriArray[1];
        }
        /*
            1. Folder is admin but user not logged in
            2. User is logged in but not admin
        */
        if($folder == 'admin') {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                if($userdata['user_status'] != 'admin') {
                    header('location: ../');
                    exit();
                }
            } else {
                if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
                    header('location: ../');
                    exit();
                } else {
                    $userdata = json_decode($_SESSION['user'], true);
                    if($userdata['user_status'] != 'admin') {
                        header('location: ../');
                        exit();
                    }
                }
            }
        }    
        
    }
    /*
    =================================================================
        CRUD (create, read, update, delete, login)
    =================================================================  
    */
    public function get_user($userId) {
        $sql = "SELECT 
            users.firstname,
            users.lastname,
            users.email,
            users.phone,
            users.photo,
            users.user_status,
            users.account_status,
            users.user_account_type_id,
            users.gender,
            users.date_of_birth,
            users.skype_id,
            users.postal_address,
            users.certificate_file,
            users.identification_file,
            users.created_at,
            is_available.availability_status
        FROM 
            users 
        LEFT JOIN
            is_available ON users.id = is_available.user_id
        WHERE 
            users.id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();

        while ($row = $result->fetch_assoc()) {
        
            // Check if the user is already in the result array
            if (!isset($data[$userId])) {
                // If not, add the user with basic information
                $data[$userId] = array(
                    'id' => $userId,
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'photo' => $row['photo'],
                    'user_status' => $row['user_status'],
                    'account_status' => $row['account_status'],
                    'user_account_type_id' => $row['user_account_type_id'],
                    'gender' => $row['gender'],
                    'date_of_birth' => $row['date_of_birth'],
                    'skype_id' => $row['skype_id'],
                    'postal_address' => $row['postal_address'],
                    'certificate_file' => $row['certificate_file'],
                    'identification_file' => $row['identification_file'],
                    'created_at' => $row['created_at'],
                    'availability_status' => isset($row['availability_status']) ? $row['availability_status'] : 'N/A',
                );
            }
        }
        return $data;
    }
    public function update_user() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        $fullname = $_POST['name'];
        $email = $_POST['email'];
        $updated_at = datetime_now();
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['photo']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../img/'; // Update this path to your desired directory
        
            // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
            $new_photo = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
        
            // Construct the full path to save the image
            $imagePath = $imageDirectory . $new_photo;
        
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $imagePath)) {
                // Image uploaded successfully
            } else {
                // Handle the case where the image could not be moved
                $new_photo = '';
            }
        } else {
            // Handle the case where no image was provided
            $new_photo = '';
        }
        
        if(isset($_POST['pwd'])) {
            $options = [
                'cost' => 11
            ]; 
            $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT, $options);

            $stmt = $this->con->prepare("UPDATE users SET fullname=?, email=?, pwd=?, photo=?, updated_at=? WHERE id=?");
            $stmt->bind_param('sssssi', $fullname, $email, $pwd, $new_photo, $updated_at, $id);
        } else {
            $stmt = $this->con->prepare("UPDATE users SET fullname=?, email=?, photo=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssssi', $fullname, $email, $new_photo, $updated_at, $id);
        }
        if($stmt->execute()) {
            if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $userdata2 = array(
                    'logged' => $userdata['logged'],
                    'uid' => $userdata['uid'],
                    'fullname' => $fullname,
                    'email' => $email,
                    'photo' => $new_photo,
                    'user_status' => $userdata['user_status'],
                    'account_status' => $userdata['account_status'],
                    'member_tier' => $userdata['member_tier'],
                    'is_subscriber' => $user_array['is_subscriber'],
                    'subscription_id' => isset($user_array['subscription_id']) ? $user_array['subscription_id'] : null
                );
                $_SESSION['user'] = json_encode($userdata2, true);
            }

            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function update_profile_details() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        $fullname = $_POST['name'];
        $email = $_POST['email'];
        $updated_at = datetime_now();
        // if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
        //     $photo = $user_array['photo'];
        // } else {
        //     $photo = add_user_avatar('photo');
        // }

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['photo']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../img/'; // Update this path to your desired directory
        
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
        
        $stmt = $this->con->prepare("UPDATE users SET fullname=?, email=?, photo=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssssi', $fullname, $email, $photo, $updated_at, $id);
        
        if($stmt->execute()) {
            if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $userdata2 = array(
                    'logged' => $userdata['logged'],
                    'uid' => $userdata['uid'],
                    'fullname' => $fullname,
                    'email' => $email,
                    'photo' => $photo,
                    'user_status' => $userdata['user_status'],
                    'account_status' => $userdata['account_status'],
                    'member_tier' => $userdata['member_tier'],
                    'is_subscriber' => $user_array['is_subscriber'],
                    'subscription_id' => isset($user_array['subscription_id']) ? $user_array['subscription_id'] : null
                );
                $_SESSION['user'] = json_encode($userdata2, true);
            }

            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function update_user_password() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        $updated_at = datetime_now();
        if(isset($_POST['pwd'])) {
            $options = [
                'cost' => 11
            ]; 
            $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT, $options);

            $stmt = $this->con->prepare("UPDATE users SET pwd=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssi', $pwd, $updated_at, $id);
        }
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function get_users() {
        $stmt = $this->con->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

        
    public function duplicate_email($email) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            return '1';
        } else {
            return '0';
        }
    }
    public function create() {
        $this->startSession();
        $duplicate = $this->duplicate_email($_POST['email']);
        if($duplicate == '1') {
            $status = '2';
        } else {
            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_account_type_id = $_POST['user_account_type_id'];
            $options = [
                'cost' => 11
            ];
            $pwd = password_hash($password, PASSWORD_BCRYPT, $options);


            $created_at = datetime_now();
            $updated_at = $created_at;

            // var_dump($firstname, $lastname, $email, $pwd, $created_at, $updated_at);
            
            $stmt = $this->con->prepare("INSERT INTO users(firstname, lastname, email, pwd, user_account_type_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssis", $firstname, $lastname, $email, $pwd, $user_account_type_id, $created_at, $updated_at);
            
            if($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $stmt->close();

                // Create is_available row when user is tutor
                $availability_status = 1;
                $stmt = $this->con->prepare("INSERT INTO is_available(user_id, availability_status) VALUES (?, ?)");
                $stmt->bind_param("ii", $user_id, $availability_status);
                $stmt->execute();
                $stmt->close();

                $userdata = array(
                    'logged' => 0,
                    'uid' =>  $user_id,
                    'firstname' =>  $firstname,
                    'lastname' =>  $lastname,
                    'email' =>  $email,
                    'photo' => '',
                    'user_status' => 'member',
                    'account_status' => 'pending',
                    'user_account_type_id' => $user_account_type_id
                );
                $_SESSION['user'] = json_encode($userdata, true);
                // SEND EMAIL
                $url = $this->generateVerificationLink($_POST['email']);
                $_SESSION['url'] = $url;
                // if(
                //     $_SERVER['SERVER_NAME'] != 'localhost' &&
                //     $_SERVER['SERVER_NAME'] != 'sql100.infinityfree.com'
                // ) {
                //     $check_email = $user->email_exists($_POST['email']);
                //     if($check_email == '1') {

                //         $subject = 'UncutCollege email verification';
                //         $msgBody = "<p>Your email verification link: </p>
                //         <a href='$url'>$url</a>";
            
                //         $smtp_details = $this->smtp_details();
            
                //         $host = $smtp_details['smtp_host'];
                //         $encryption = $smtp_details['smtp_encryption'];
                //         $port = $smtp_details['smtp_port'];
                //         $username = $smtp_details['username'];
                //         $pwd = $smtp_details['pwd'];
            
                //         sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $_POST['email'], $subject, $msgBody);
                //         $status = '1';
                //     } else {
                //         $status = '0';
                //     }
                // } else {
                    $status = '1';
                // }

    
            } else {
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
                $status = '2';
            }
        }
        echo $status;
    }
    public function login() {
        $this->startSession();

        $email = $_POST['email'];
        $password = $_POST['password'];     

        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):   
                    $user_id = $row['id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $photo = $row['photo'];
                    $account_status = $row['account_status'];
                    $user_account_type_id = $row['user_account_type_id'];


                    $hash = trim($row['pwd']);
                    // Check if passwords match
                    if(password_verify($password, $hash)) {

                        // Check if email is verified
                        if($row['account_status'] == 'pending') {
                            $logged = '0';
                        } else if ($row['account_status'] == 'verified') {
                            $logged = '1';
                        }

                        $userdata = array(
                            'logged' => $logged,
                            'uid' =>  $user_id,
                            'firstname' =>  $firstname,
                            'lastname' =>  $lastname,
                            'email' =>  $email,
                            'photo' => $photo,
                            'user_status' => 'member',
                            'account_status' => $account_status,
                            'user_account_type_id' => $user_account_type_id
                        );
                        $_SESSION['user'] = json_encode($userdata, true);
                        if (isset($_POST["remember"])) {
                            setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
                        }
                        if($row['user_status'] == 'admin') {
                            $status = '1';
                        } else if ($row['user_status'] == 'member') {
                            if($row['account_status'] == 'verified') {
                                $status = '7';
                            } else {
                                $status = '8';
                            }
                        } else {
                            $status = '5';
                        }
                    } else {
                        // Passwords don't match
                        $status = '3';
                    }
                endforeach;
            } else {
                // No email
                $status = '4';
            }  
        } else {
            // No email
            $status = '4';
        }      
        $stmt->close();
        
        echo $status;
    }
    public function logout() {
        $this->startSession();
        $this->endSession();
        setcookie('user', '', 1, '/');
        header('location: ../'); 
    }
    public function email_exists($email) {
        // Check if email exists
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return '1';
        } else {
            return '0';
        }
    }


    public function update_password() {
        $this->startSession();
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $repeat_password = $_POST['repeat_password'];

        $uid = get_uid();

        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $password_check = password_verify($current_password, $row['pwd']);
        endforeach;

        if($password_check == true && $new_password == $repeat_password) {
            $updated_at = datetime_now();
            $options = [
                'cost' => 11
            ]; 
            // $pwd = password_hash($password, PASSWORD_DEFAULT);
            $pwd = password_hash($new_password, PASSWORD_BCRYPT, $options);
            $stmt = $this->con->prepare("UPDATE users SET pwd=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssi', $pwd, $updated_at, $uid);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
        } else {
            $status = '0';
        }
        echo $status;
    }
    public function update_password_2() {
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $password = $_POST['new_password'];
        $password_repeat = $_POST['repeat_password'];
        
        if(empty($password) || empty($password_repeat)) {
            $status = '4';
        } else if ($password != $password_repeat) {
            $status = '5';
        } else {
            $current_date = date("U"); 
        
            // SELECT
            // var_dump($_POST);
            $stmt = $this->con->prepare("SELECT * FROM pwd_reset WHERE pwd_reset_selector=? AND pwd_reset_expires>=?");
            $stmt->bind_param('ss', $selector, $current_date);
            $stmt->execute();
            // $stmt->store_result();
            $result = $stmt->get_result();
        
            if ($result->num_rows == 0) {
                $status = '8';
            } else {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row):
                    $token_bin = hex2bin($validator);
                    $token_check = password_verify($token_bin, $row['pwd_reset_token']);
                endforeach;

                if($token_check === false) {
                    $status = '7';
                    // echo "You need to resubmit your reset request.";
                    // exit();
                } elseif($token_check === true) {
                    $token_email = $row['pwd_reset_email'];

                    // SELECT FROM users TABLE
                    $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
                    $stmt->bind_param('s', $token_email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows == 0) {
                        $status = '0';
                    } else {
                        // UPDATE PASSWORD
                        $stmt = $this->con->prepare("UPDATE users SET pwd=? WHERE email=?");
                        $pwdHash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                        $stmt->bind_param('ss', $pwdHash, $token_email);
                        $stmt->execute();    
                        // DELETE TOKEN
                        $stmt = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
                        $stmt->bind_param('s', $token_email);
                        $stmt->execute();
                        
                        $status = '1';
                    }
                    $stmt->close();
                }
            }    
        }    
        echo $status;
    }
    public function delete($user_id) {
        $this->startSession();
        $prevpage = $_SESSION['previous_page'];

        $stmt = $this->con->prepare("DELETE FROM users WHERE id=? AND user_status != 'admin'");
        $stmt->bind_param('i', $user_id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        header('location: ../admin/users?page='.$prevpage);
        // echo $status;
    }
    /*

    =================================================================
        Verification
    =================================================================  

    */
    public function verify_account($selector, $validator) {
        // $current_date = date("U");


        // Set the desired timezone (e.g., 'America/New_York')
        $timezone = 'America/New_York';
        // Create a DateTime object with the desired timezone
        $date = new DateTime('now', new DateTimeZone($timezone));
        // Get the Unix timestamp for the current time in the specified timezone
        $current_date = $date->format('U');


        $stmt = $this->con->prepare("SELECT * FROM verify_email WHERE vrf_selector=? AND vrf_expires>=?");
        $stmt->bind_param('ss', $selector, $current_date);
        // $stmt = $this->con->prepare("SELECT * FROM verify_email WHERE vrf_selector = ?");
        // $stmt->bind_param('s', $selector);
        $stmt->execute();

        
        $result = $stmt->get_result();

        // var_dump($result);
        
        if ($result->num_rows == 0) {
            $status = '8';
        } else {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            foreach($data as $row):
                $token_bin = hex2bin($validator);
                $token_check = password_verify($token_bin, $row['vrf_token']);
            endforeach;
            
            if($token_check === false) {
                $status = '7';
            } elseif($token_check === true) {
                $token_email = $row['vrf_email'];
                // SELECT FROM users TABLE
                $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
                $stmt->bind_param('s', $token_email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows == 0) {
                    $status = '0';
                } else {
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $row = $data[0];

                    // Get data for session
                    $logged = 1;
                    $uid = $row['id'];
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $photo = $row['photo'];
                    $user_status = $row['user_status'];
                    $member_tier = $row['member_tier'];
                    $subscription_id = $row['subscription_id'];
                    $is_subscriber = $row['is_subscriber'];
                    
                    $account_status = 'verified';

                    $stmt = $this->con->prepare("UPDATE users SET account_status=? WHERE email=?");
                    $stmt->bind_param('ss', $account_status, $token_email);
                    $stmt->execute();    
                    // DELETE TOKEN
                    $stmt = $this->con->prepare("DELETE FROM verify_email WHERE vrf_email=?");
                    $stmt->bind_param('s', $token_email);
                    $stmt->execute();

                    $userdata = array(
                        'logged' => $logged,
                        'uid' => $uid,
                        'fullname' => $fullname,
                        'email' => $email,
                        'photo' => $photo,
                        'user_status' => $user_status,
                        'account_status' => $account_status,
                        'member_tier'  => $member_tier,
                        'is_subscriber' => $is_subscriber,
                        'subscription_id' => $subscription_id
                    );
                    $_SESSION['user'] = json_encode($userdata, true);
                    
                    
                    $status = '1';
                }
            }
        }
        return $status;
    }
    public function generate_code($user_id) {
        // Generate a 6-digit code
        $code = mt_rand(100000, 999999);
        
        // Calculate the expiration time (30 minutes from now)
        $expires = date("U") + 1800;
        
        // Prepare the SQL statement
        $stmt = $this->con->prepare("INSERT INTO login_verify (user_id, code, expires) VALUES (?, ?, ?)");
        
        // Bind parameters to the statement
        $stmt->bind_param("iss", $user_id, $code, $expires);
        
        // Execute the statement
        $stmt->execute();
        
        // Close the statement and database connection
        $stmt->close();
        
        // Return the generated code
        return $code;
    }
    public function generateVerificationLink($email) {
        // GENERATE PASSWORD LINK
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        
        // This link will be sent to the user by email
        $url = "https://testserver456452.rf.gd/verification?selector=".$selector."&validator=".bin2hex($token);
        // Expiration date for token (1800ms = 1hr)
        $expires = date("U") + 1800;

        // Insert token in the database (we'll need a new table for this)
        // DELETE EXISTING TOKENS
        $stmt = $this->con->prepare("DELETE FROM verify_email WHERE vrf_email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();

        // INSERT NEW TOKEN
        $stmt = $this->con->prepare("INSERT INTO verify_email (vrf_email, vrf_selector, vrf_token, vrf_expires) VALUES (?, ?, ?, ?);");
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $email, $selector, $hashedToken, $expires);
        $stmt->execute();
        $stmt->close();

        return $url;
        
    }
    public function verify_login() {
        $this->startSession();

        if($_SERVER['SERVER_NAME'] != 'localhost') {
            // Get the user ID from the get_uid() function
            $user_id = $this->get_uid(); // Assuming you have implemented the get_uid() function
            
            // Get the verification code from the $_POST['code'] variable
            $verification_code = $_POST['code']; // Assuming the verification code is sent via POST
            
            // Get the current timestamp
            $current = date("U"); 
            
            
            // Prepare the SELECT statement to fetch the matching row
            $stmt = $this->con->prepare("SELECT * FROM login_verify WHERE user_id = ? AND code = ? AND expires >= ? LIMIT 1");
            $stmt->bind_param('iss', $user_id, $verification_code, $current);
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Fetch the row
                $row = $result->fetch_assoc();
                
                // Check if the verification code matches
                if ($verification_code === $row['code']) {
                    // Check if the current timestamp is smaller than or equal to the expiration timestamp
                    if ($current <= $row['expires']) {
                        // Update the session data
                        $userdata = json_decode($_SESSION['user'], true);
                        $userdata['logged'] = 1;
                        
                        // Update the user cookie if it is set
                        if (isset($_COOKIE['user'])) {
                            $cookieData = json_decode($_COOKIE['user'], true);
                            $cookieData['logged'] = 1;
                            setcookie("user", json_encode($cookieData), time() + (10 * 365 * 24 * 60 * 60), '/');
                        }
                        
                        // Set the new user session data
                        $_SESSION['user'] = json_encode($userdata);

                        $status = '1';
                    } else {
                        $status = '2';
                    }
                } else {
                    $status = '3';
                }
            } else {
                $status = '4';
            }
            // Close the statement
            $stmt->close();
            
            // Delete rows with the matching user ID
            $stmt = $this->con->prepare("DELETE FROM login_verify WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->close();
        } else {
            $status = '1';
        }

        echo $status;
    }
    // public function update_verfication_status() {

    // }
    public function smtp_details() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM smtp_email_setup WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $smtp_details = array(
                        'smtp_host' => $row['smtp_host'],
                        'smtp_encryption' => $row['smtp_encryption'],
                        'smtp_port' => $row['smtp_port'],
                        'username' => $row['username'],
                        'pwd' => $row['pwd']
                    );
                endforeach;
            } 
        }
        $stmt->close();
        return $smtp_details;
    }
    public function profile_photo() {
        $photo = $this->get_user_img();
        $username = $this->username();
        $fname = $this->firstname();
        $lname = $this->lastname();
        if(!empty($photo)) {
            $profile_photo = "<img src='../img/$photo' class ='avatar img-fluid rounded mr-1' alt='$fname $lname' /> <span class ='text-dark'>$fname $lname</span>";
        } else {
            $profile_photo = "<img src='../img/avi.png' class ='avatar img-fluid rounded mr-1' alt='$fname $lname' /> <span class ='text-dark'>$fname $lname</span>";
        }
        echo $profile_photo;
    }
    public function smtpEmailForm() {
        $smtp_details = $this->smtp_details();
        if($smtp_details['smtp_encryption'] == 'SSL') {
            $opts = "<option value='SSL' selected>SSL</option>
            <option value='TLS'>TLS</option>";
        } else if ($smtp_details['smtp_encryption'] == 'TLS') {
            $opts = "<option value='TLS' selected>TLS</option>
            <option value='SSL'>SSL</option>";
        } else {
            $opts = "<option selected=''>Select Encryption</option>
            <option value='SSL'>SSL</option>
            <option value='TLS'>TLS</option>";
        }
        return "<form autocomplete='off' method='POST' class ='add-post-form update-user-form' id='update-user-form'  enctype='multipart/form-data'>
        <div id='msg-response'></div>
            <input type='hidden' name='email_setup' id='email_setup' value='true'>
            <div class ='mb-3'>
                <label for='smtp_host' class ='form-label'>SMTP Host</label>
                <input name='smtp_host' id='smtp_host' type='text' class ='form-control' placeholder='SMTP Host' value='{$smtp_details['smtp_host']}'>
            </div>
            <div class ='mb-3'>
                <label class ='form-label'>Encryption</label>
                <select class ='form-control' name='smtp_encryption' id='smtp_encryption'>
                    $opts
                </select>
            </div>
            <div class ='mb-3'>
                <label for='smtp_port' class ='form-label'>SMTP Port</label>
                <input name='smtp_port' id='smtp_port' type='text' class ='form-control' placeholder='SMTP Port' value='{$smtp_details['smtp_port']}'>
            </div>
            <div class ='mb-3'>
                <label for='username' class ='form-label'>Username</label>
                <input name='username' id='username' type='text' class ='form-control' placeholder='Username' value='{$smtp_details['username']}'>
            </div>
            <div class ='mb-3'>
                <label class ='form-label'>Password</label>
                <input name='password' id='password' type='password' class ='form-control' placeholder='Password' value='{$smtp_details['pwd']}'>
            </div>
            <div>
                <span onclick='return email_setup(event)' type='submit' class ='btn btn-primary'>Submit</span>
            </div>
        </form>";
    }
    public function update_email_details() {
        $id = 1;
        $smtp_host = $_POST['smtp_host'];
        $smtp_encryption = $_POST['smtp_encryption'];
        $smtp_port = $_POST['smtp_port'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $stmt = $this->con->prepare("UPDATE smtp_email_setup SET smtp_host=?, smtp_encryption=?, smtp_port=?, username=?, pwd=? WHERE id=?");
        $stmt->bind_param('sssssi', $smtp_host, $smtp_encryption, $smtp_port, $username, $pwd, $id);    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    /*

    =================================================================
        Admin
    =================================================================  

    */ 
    function display_user_details($user_id) {
        $user = $this->get_user($user_id);
        
        $subscription_id = $user['subscription_id'];


        $photoSrc = photoOrDefault($user['photo'], 'true');

        if($user['is_subscriber'] == '1') {
            $subscriptionStatus = getSubscriptionStatus($subscription_id);
            $subscriptionStr = "<li class ='li-group'>
                <div><strong>Subscription Status</strong></div>
                <div>{$subscriptionStatus}</div>
            </li>
            <li class ='li-group'>
                <div><strong>Subscription Id</strong></div>
                <div>{$subscription_id}</div>
            </li>";
        } else {
            $subscriptionStr = "<li class ='li-group'>
                <div><strong>Subscription</strong></div>
                <div>Not a subscriber</div>
            </li>";
        }

        

        $userDetailsStr = "
        <div class='card flex-fill'>
            <ul class ='subscription'>
                <li class ='li-group'>
                    <div class='td-thumb'>
                        <img src='$photoSrc' alt='Profile Photo'>
                    </div>
                </li>
                <li class ='li-group'>
                    <div><strong>Id</strong></div>
                    <div>{$user['id']}</div>
                </li>
                <li class ='li-group'>
                    <div><strong>Name</strong></div>
                    <div>{$user['fullname']}</div>
                </li>
                <li class ='li-group'>
                    <div><strong>Email</strong></div>
                    <div>{$user['email']}</div>
                </li>
                <li class ='li-group'>
                    <div><strong>User status</strong></div>
                    <div>{$user['email']}</div>
                </li>
                <li class ='li-group'>
                    <div><strong>User Status</strong></div>
                    <div style='text-transform: capitalize;'>{$user['user_status']}</div>
                </li>
                <li class ='li-group'>
                    <div><strong>Account Status</strong></div>
                    <div style='text-transform: capitalize;'>{$user['account_status']}</div>
                </li>
                $subscriptionStr
                <li class ='li-group'>
                    <div><strong>Created</strong></div>
                    <div>{$user['created_at']}</div>
                </li>
                <li class ='li-group'>
                    <div><strong>Last update</strong></div>
                    <div>{$user['updated_at']}</div>
                </li>
            </ul>
        </div>";
        echo $userDetailsStr;
    } 


    /*
    =================================================================
        MY ACCOUNT AREA
    =================================================================  
    */
    public function dashboard_profile() {
        $uid = get_uid();
        $user = $this->get_user($uid)[$uid];

        if(!empty($user['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$user['photo']}' />";
        } else {     
            $fname = get_firstname();
            $fChar = $fname[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        echo "<div class='card mb-4'>
            <div class='profile-infos'>

                <div class='img-wrapper'>
                    $photo
                </div>
                <div class='name'>
                    {$user['firstname']}
                </div>

                <div class='adress'>{$user['postal_address']}</div>
            </div>
        </div>";
    }
    public function profile_image() {
        $pht = get_user_photo();

        if(!empty($pht)) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$pht}' />";
        } else {     
            $fname = get_firstname();
            $fChar = $fname[0];
            $photo = "<div class='user-no-picture' style='font-size: 15px;'>$fChar</div>";
        }

        echo $photo;
    }


    public function general_info_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];


        // Availibity
        if($user['availability_status'] !== 'N/A') {
            if($user['availability_status'] == 1) {
                $label = 'Available';
            } else {
                $label = 'Not Available';
            }
            $ava = "<div class='custom-selector'>
                <div class='custom-select-wrapper'>
                    <span  data-selected-value='' class='selected-label' id='availability'>$label</span>
                    <ul class='custom-options'>
                        <li data-value='1'><span data-label='Available'>Yes</span></li>
                        <li data-value='0'><span data-label='Not Available'>No</span></li>
                    </ul>
                </div>
            </div>";
        } else {
            $ava = "<div class='custom-selector'>
                <div class='custom-select-wrapper'>
                    <span  data-selected-value='' class='selected-label' id='availability'>Availability</span>
                    <ul class='custom-options'>
                        <li data-value='1'><span data-label='Available'>Yes</span></li>
                        <li data-value='0'><span data-label='Not Available'>No</span></li>
                    </ul>
                </div>
            </div>";
        }

        // Gender
        if($user['gender'] != '') {
            if($user['gender'] == 'Male') {
                $label = 'Male';
            } else {
                $label = 'Female';
            }
            $gen = "
            <div class='custom-selector'>
                <div class='custom-select-wrapper'>
                    <span  data-selected-value='' class='selected-label' id='gender'>$label</span>
                    <ul class='custom-options'>
                        <li data-value='M'><span data-label='Male'>Male</span></li>
                        <li data-value='F'><span data-label='Female'>Female</span></li>
                    </ul>
                </div>
            </div>";
        } else {
            $gen = "
            <div class='custom-selector'>
                <div class='custom-select-wrapper'>
                    <span  data-selected-value='' class='selected-label' id='gender'>Gender</span>
                    <ul class='custom-options'>
                        <li data-value='M'><span data-label='Male'>Male</span></li>
                        <li data-value='F'><span data-label='Female'>Female</span></li>
                    </ul>
                </div>
            </div>";
        }

        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center mb-4'>General Information 🙂</h6>
                

                $gen

                <div>
                    <input value='{$user['firstname']}' type='text' class='custom-input' data-rule='success' data-label='firstname' name='firstname' id='firstname' placeholder='First name'>
                </div>
                <div>
                    <input value='{$user['lastname']}' type='text' class='custom-input' data-rule='success' data-label='lastname' name='lastname' id='lastname' placeholder='Last name'>
                </div>
                <div>
                    <input value='{$user['date_of_birth']}' type='date' class='custom-input' data-rule='success' data-label='date_of_birth' name='date_of_birth' id='date_of_birth'>
                </div>
                <div>
                    <input value='{$user['email']}' type='text' class='custom-input' data-rule='success' data-label='email' placeholder='Email' name='email' id='email'>
                </div>
                <div>
                    <input value='{$user['phone']}' type='text' class='custom-input' data-rule='success' data-label='phone' placeholder='Phone' name='phone' id='phone'>
                </div>
                <div>
                    <input value='{$user['skype_id']}' type='text' class='custom-input' data-rule='success' data-label='skype_id' placeholder='Skype ID' name='skype_id' id='skype_id'>
                </div>

                
                $ava

                <div class='row justify-content-center'>
                    <input onclick='update_user_details(event)' style='margin: 10px auto 0 auto;' type='submit' class='form-btn btn btn-validate' value='Save'>
                </div>
                <div class='message-response' id='message-response'></div>
            </div>
        </div>";
    }

    public function certificate_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['certificate_file'] != '') {
            $ph = "<img src='./assets/certificates/{$user['certificate_file']}' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072517.png' alt=''>";
        }

        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Certificate</h6>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 20px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-1'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-1' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-2'></div>
            </div>
        </div>";
    }
    
    public function identification_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['identification_file'] != '') {
            $ph = "<img src='./assets/identifications/{$user['identification_file']}' alt=''>";
            // $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        }

        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Identification</h6>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 20px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-2'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-2' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-3'></div>
            </div>
        </div>";
    }
    
    public function profile_photo_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['photo'] != '') {
            $ph = "<img src='./assets/avatars/{$user['photo']}' alt=''>";
            // $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072743.png' alt=''>";
        }

        echo "
        <div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Profile Photo</h6>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 20px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-3'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-3' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-4'></div>
            </div>
        </div>";
    }
    public function profile_photo_form_2() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['photo'] != '') {
            $ph = "<img src='./assets/avatars/{$user['photo']}' alt=''>";
            // $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072743.png' alt=''>";
        }

        echo "
        <div class='mb-4'>
            <div class='card-body'>
                <h3 class='card-title text-center'>Profile Photo</h3>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 30px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-3'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper' style='margin-top: 30px;'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-3' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-4'></div>
            </div>
        </div>";
    }
    public function postal_address_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];


        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Postal Address</h6>
                <div>
                    <input value='{$user['postal_address']}' type='text' class='custom-input' data-rule='success' id='address' data-label='address' placeholder='133 Houndsditch, London EC3A 7...'>
                </div>

                <div class='row justify-content-center'>
                    <input onclick='update_postal_address(event)' style='margin: 10px auto 0 auto;' type='submit' class='form-btn btn btn-validate' value='Save'>
                </div>
                <div class='message-response' id='message-response-5'></div>
            </div>
        </div>";
    }
}