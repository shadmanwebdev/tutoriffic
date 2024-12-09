<?php
    /*

    =================================================================
        FILE UPLOAD
        SESSIONS & COOKIES
        DATE & TIME
        FOLDERS & DIRECTORIES
        EMAILS
        CALCULATIONS
        HTML BLOCKS
        DATA MANIPULATION & VALIDATION
        cURL
    =================================================================  

    */    
        
    function siteurl() {
        /*
            This function provides a dynamic way to determine the website's URL based on the server 
            it is being accessed from. It returns different URLs depending on whether the website is 
            running on a local server or a remote server.
        */
        $server = $_SERVER['SERVER_NAME'];
        if($server == 'localhost') {
            return "http://localhost/uncutcollege/";
        } else {
            return "https://testserver456452.rf.gd/";
        }
    }
    /*
    =================================================================

        FILE UPLOAD
    
    =================================================================  
    */
    function add_img($n) {
        // $img = $_FILES['image']['name'];
        // if($n == '') {
            $img = $_FILES[$n]['name'];
        // } else {
        //     $img = $_FILES['image'.$n]['name'];
        // }
        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../assets/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;
                // if($n == '') {
                    $tempname = $_FILES[$n]['tmp_name'];
                // } else {
                //     $tempname = $_FILES['image'.$n]['tmp_name'];
                // }
                
                list($width, $height) = getimagesize( $tempname );
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function add_user_avatar($n) {
        $img = $_FILES[$n]['name'];
        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../avatars/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;
                $tempname = $_FILES[$n]['tmp_name'];
                
                list($width, $height) = getimagesize( $tempname );
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function add_img_tempfile($tempFilePath) {

        echo $img = basename($tempFilePath); // Get the temporary file name with the "tmp" extension
        $ext = pathinfo($img, PATHINFO_EXTENSION); // Get the original file extension
        

        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../images/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;

                list($width, $height) = getimagesize($tempFilePath);
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function add_img_from_array($key) {
        $img = $_FILES['image']['name'][$key];
        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../post/img/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;

                $tempname = $_FILES['image']['tmp_name'][$key];

                list($width, $height) = getimagesize( $tempname );
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function add_video_from_array($key) {
        $video = $_FILES['video']['name'][$key];
        // CHECK IF INPUT IS EMPTY
        if(!empty($video)) {
            $allowed = array('mp4', 'avi', 'mov', 'mkv');
            $ext = pathinfo($video, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $videoPath = '../post/video/';
                $uniquesavename = time() . uniqid(rand(10, 20));
                $destFile = $videoPath . $uniquesavename . '.' . $ext;
    
                $tempname = $_FILES['video']['tmp_name'][$key];
                move_uploaded_file($tempname, $destFile);
                $filename = $uniquesavename . '.' . $ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function saveVideo($videoFile) {
        $videoPath = '../post/video/';
        $allowed = array('mp4', 'avi', 'mov', 'mkv');
    
        // CHECK IF INPUT IS EMPTY
        if (empty($videoFile)) {
            return ''; // No file provided
        }
    
        $ext = pathinfo($videoFile['name'], PATHINFO_EXTENSION);
    
        // CHECK IF FILE TYPE IS ALLOWED
        if (!in_array($ext, $allowed)) {
            return ''; // File type not allowed
        }
    
        $uniquesavename = time() . uniqid(rand(10, 20));
        $destFile = $videoPath . $uniquesavename . '.' . $ext;
    
        move_uploaded_file($videoFile['tmp_name'], $destFile);
    
        return $uniquesavename . '.' . $ext;
    }
    
    function saveThumbnail($base64ThumbnailData) {
        $imagePath = '../post/video-thumbnail/';
        $ext = 'png'; // You can adjust this based on the format you want to save (e.g., 'jpg')
    
        // Generate a unique filename for the thumbnail (you can use a UUID, timestamp, etc.)
        $uniquesavename = time() . uniqid(rand(10, 20));
        $destFile = $imagePath . $uniquesavename . '.' . $ext;
    
        // Remove the data URI prefix (e.g., "data:image/png;base64,")
        $base64ThumbnailData = preg_replace('#^data:image/[^;]+;base64,#', '', $base64ThumbnailData);
    
        // Decode the base64 data
        $thumbnailData = base64_decode($base64ThumbnailData);
    
        // Save the decoded data as an image file
        if (file_put_contents($destFile, $thumbnailData)) {
            return $uniquesavename . '.' . $ext;
        } else {
            return ''; // Error saving thumbnail
        }
    }
    
    function compress($source, $destination, $quality) {

        $info = getimagesize($source);
    
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
    
        elseif ($info['mime'] == 'image/webp') 
            $image = imagecreatefromwebp($source);
    
        imagejpeg($image, $destination, $quality);
    
        return $destination;
    }
    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $info = getimagesize($file);
        if ($info['mime'] == 'image/jpeg') 
            $src = imagecreatefromjpeg($file);
    
        elseif ($info['mime'] == 'image/gif') 
            $src = imagecreatefromgif($file);
    
        elseif ($info['mime'] == 'image/png') 
            $src = imagecreatefrompng($file);
    
        elseif ($info['mime'] == 'image/webp') 
            $src = imagecreatefromwebp($file);
    
    
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }
    function kv($arr1) {
        $arr2 = array();
        foreach ($arr1 as $key => $value) {
            if($value == 'a') {
                array_push($arr2, $key);
            }
        }
        return $arr2;
    }

    function add_msg_img_from_array($key) {
        $img = $_FILES['image']['name'][$key];
        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../msg/img/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;

                $tempname = $_FILES['image']['tmp_name'][$key];

                list($width, $height) = getimagesize( $tempname );
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function add_msg_video_from_array($key) {
        $video = $_FILES['video']['name'][$key];
        // CHECK IF INPUT IS EMPTY
        if(!empty($video)) {
            $allowed = array('mp4', 'avi', 'mov', 'mkv');
            $ext = pathinfo($video, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $videoPath = '../msg/video/';
                $uniquesavename = time() . uniqid(rand(10, 20));
                $destFile = $videoPath . $uniquesavename . '.' . $ext;
    
                $tempname = $_FILES['video']['tmp_name'][$key];
                move_uploaded_file($tempname, $destFile);
                $filename = $uniquesavename . '.' . $ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }   
    /*
    =================================================================

        SESSIONS & COOKIES
    
    =================================================================  
    */  
    function startSession() {
        if(!isset($_SESSION)) {
            ob_start();
            session_start();
        }
    }
    function endSession() {
        session_unset();
        session_destroy();
    }  
    function rememberLastPage() {
        // Save the current page to session as the 'last_page'
        if (isset($_SESSION['current_page'])) {
            $_SESSION['last_page'] = $_SESSION['current_page'];
        }
    
        // Get the current page URL
        $currentPage = get_pagename();
    
        // Save the current page to session
        $_SESSION['current_page'] = $currentPage;
    }
    
    /**
     * Function to retrieve the last visited page
     */
    function getLastPage() {
        if (isset($_SESSION['last_page'])) {
            return $_SESSION['last_page'];
        } else {
            return null; // No last page visited
        }
    }
    function user_account_type_id() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $user_account_type_id = $userdata['user_account_type_id'];
            return $user_account_type_id;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $user_account_type_id = $userdata['user_account_type_id'];
            return $user_account_type_id;
        }
        return false;
    }
    function is_logged_in() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        }
        return false;
    }
    function get_uid() {
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
    function get_user_status() {
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
    function get_account_status() {
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
    function get_firstname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $firstname = $userdata['firstname'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $firstname = $userdata['firstname'];
        }
        return $firstname;
    }
    function get_lastname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $lastname = $userdata['lastname'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $lastname = $userdata['lastname'];
        }
        return $lastname;
    }
    function fullname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $fullname = $userdata['fullname'];
            return $fullname;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $fullname = $userdata['fullname'];
            return $fullname;
        }
    }
    function get_user_photo() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $photo = $userdata['photo'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $photo = $userdata['photo'];
        }
        return $photo;
    }
    function get_user_email() {
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
    function is_subscriber() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $is_subscriber = $userdata['is_subscriber'];
            return $is_subscriber;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $is_subscriber = $userdata['is_subscriber'];
            return $is_subscriber;
        }
    }
    function subscription_id() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $subscription_id = $userdata['subscription_id'];
            return $subscription_id;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $subscription_id = $userdata['subscription_id'];
            return $subscription_id;
        }
    }
    function get_browser_name($user_agent) {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    
        return 'Other';
    }
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }  
    /*
    =================================================================

        DATE & TIME
    
    =================================================================  
    */
    function compare_datetime($datetime_str, $timezone='America/New_York') {
        // Create DateTime object from the provided datetime string with the format 'd-m-Y H:i'
        $provided_datetime = DateTime::createFromFormat('d-m-Y H:i', $datetime_str, new DateTimeZone($timezone));
        
        if (!$provided_datetime) {
            return "Invalid datetime format.";
        }

        // Create DateTime object for the current time in the given timezone
        $current_datetime = new DateTime("now", new DateTimeZone($timezone));
    
        
        // Compare the two DateTime objects
        if ($provided_datetime < $current_datetime) {
            // return "The provided datetime is in the past.";
            return "1";
        } else {
            // return "The provided datetime is in the future.";
            return "0";
        }
    }
    function hours_until_datetime($datetime_str, $timezone='America/New_York') {
        // Create DateTime object from the provided datetime string with the format 'd-m-Y H:i'
        $provided_datetime = DateTime::createFromFormat('d-m-Y H:i', $datetime_str, new DateTimeZone($timezone));
        
        if (!$provided_datetime) {
            return "Invalid datetime format.";
        }
    
        // Create DateTime object for the current time in the given timezone
        $current_datetime = new DateTime("now", new DateTimeZone($timezone));
        
        // Calculate the difference between the provided datetime and the current datetime
        $interval = $current_datetime->diff($provided_datetime);
    
        // Convert the interval to total hours
        $hours = $interval->days * 24 + $interval->h + $interval->i / 60;
    
        // If the provided datetime is in the past, return the negative hours
        if ($provided_datetime < $current_datetime) {
            return -$hours;
        }
    
        return $hours;
    }
    
    function hours_since_datetime($datetime_str, $timezone='America/New_York') {
        // Create DateTime object from the provided datetime string with the format 'd-m-Y H:i'
        $provided_datetime = DateTime::createFromFormat('d-m-Y H:i', $datetime_str, new DateTimeZone($timezone));
        
        if (!$provided_datetime) {
            return "Invalid datetime format.";
        }
    
        // Create DateTime object for the current time in the given timezone
        $current_datetime = new DateTime("now", new DateTimeZone($timezone));
        
        // Calculate the difference between the current datetime and the provided datetime
        $interval = $provided_datetime->diff($current_datetime);
    
        // Convert the interval to total hours
        $hours = $interval->days * 24 + $interval->h + $interval->i / 60;
    
        return $hours;
    }
    
    function days_ago($n) {
        $date = new DateTime("now", new DateTimeZone('America/New_York') );
        $date = $date->modify('-'.$n.' day');
        $daysAgo = $date->format('Y-m-d');
        return $daysAgo;
    }
    function date_now($tz='America/New_York') {
        $now = new DateTime("now", new DateTimeZone($tz) );
        $date = $now->format('Y-m-d');
        return $date;
    }
    function datetime_now($tz='America/New_York') {
        $now = new DateTime("now", new DateTimeZone($tz) );
        $datetime = $now->format('Y-m-d H:i:s');
        return $datetime;
    }
    function datetime_mjy($dt, $tz='America/New_York') {
        $new_dt = new DateTime($dt, new DateTimeZone('America/New_York') );
        return $new_dt->format("M j, Y h:i A");
    }
    function unix_to_datetime($timestamp, $tz='America/New_York') {
        $new_dt = new DateTime();
        $new_dt->setTimestamp($timestamp);
        $new_dt->setTimezone(new DateTimeZone($tz));
        return $new_dt->format("M j, Y h:i A");
    }
    /*
    function elapsed($dt_from, $tz='America/New_York') {
        $created_at = new DateTime($dt_from, new DateTimeZone($tz) );
        $date = new DateTime("now", new DateTimeZone($tz) );

        $interval = $date->diff($created_at);
        $elapsed_str = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
        $elapsed_array = explode(' ', $elapsed_str);
        $elapsed = '';
        if(intval($elapsed_array[0]) > 0) {
            if(intval($elapsed_array[0]) == 1) {
                $elapsed = strval($elapsed_array[0]) . ' yr ago';
            } else {
                $elapsed = strval($elapsed_array[0]) . ' yrs ago';
            }
        } elseif(intval($elapsed_array[2]) > 0) {
            if(intval($elapsed_array[2]) == 1) {
                $elapsed = strval($elapsed_array[2]) . ' month ago';
            } else {
                $elapsed = strval($elapsed_array[2]) . ' months ago';
            }
        } elseif(intval($elapsed_array[4]) > 0) {
            if(intval($elapsed_array[4]) == 1) {
                $elapsed = strval($elapsed_array[4]) . ' day ago';
            } else {
                $elapsed = strval($elapsed_array[4]) . ' days ago';
            }
        } elseif(intval($elapsed_array[6]) > 0) {
            if(intval($elapsed_array[6]) == 1) {
                $elapsed = strval($elapsed_array[6]) . ' hr ago';
            } else {
                $elapsed = strval($elapsed_array[6]) . ' hrs ago';
            }
        } elseif(intval($elapsed_array[8]) > 0) {
            if(intval($elapsed_array[8]) == 1) {
                $elapsed = strval($elapsed_array[8]) . ' min ago';
            } else {
                $elapsed = strval($elapsed_array[8]) . ' mins ago';
            }
        } elseif(intval($elapsed_array[10]) > 0) {
            if(intval($elapsed_array[10]) == 1) {
                $elapsed = strval($elapsed_array[10]) . ' second ago';
            } else {
                $elapsed = strval($elapsed_array[10]) . ' seconds ago';
            }
        }
        return $elapsed;
    }
    */
    function elapsed($dt_from, $tz = 'America/New_York') {
        $created_at = new DateTime($dt_from, new DateTimeZone($tz));
        $date = new DateTime("now", new DateTimeZone($tz));
    
        $interval = $date->diff($created_at);
    
        if ($interval->y > 0) {
            return $interval->y . ' ' . ($interval->y === 1 ? 'yr ago' : 'yrs ago');
        } elseif ($interval->m > 0) {
            return $interval->m . ' ' . ($interval->m === 1 ? 'month ago' : 'months ago');
        } elseif ($interval->d > 0) {
            return $interval->d . ' ' . ($interval->d === 1 ? 'day ago' : 'days ago');
        } elseif ($interval->h > 0) {
            return $interval->h . ' ' . ($interval->h === 1 ? 'hr ago' : 'hrs ago');
        } elseif ($interval->i > 0) {
            return $interval->i . ' ' . ($interval->i === 1 ? 'min ago' : 'mins ago');
        } elseif ($interval->s > 0) {
            return $interval->s . ' ' . ($interval->s === 1 ? 'second ago' : 'seconds ago');
        }
    
        return 'Just now';
    }
    
    function elapsed_check($dt_from, $tz='America/New_York') {
        $created_at = new DateTime($dt_from, new DateTimeZone($tz) );
        $date = new DateTime("now", new DateTimeZone($tz) );

        $interval = $date->diff($created_at);
        $elapsed_str = $interval->format('%y %m %a %h %i %s');
        $elapsed_array = explode(' ', $elapsed_str);

        $years = intval($elapsed_array[1]);
        $months = intval($elapsed_array[2]);
        $days = intval($elapsed_array[3]);
        $hours = intval($elapsed_array[4]);
        $minutes = intval($elapsed_array[5]);

        if($years == 0 && $months == 0 && $days < 5) {
            $e = 1;
        } else {
            $e = 0;
        }
        return $e;
    }
    
    function convert_date($d, $f, $zone='America/New_York') {
        $date = new DateTime($d, new DateTimeZone($zone) );
        $dte = $date->format($f);
        return $dte;
    }
    
    function formatDateTime($date, $time) {
        // Convert date to desired format: mm/dd/yyyy to Month day, yyyy
        $formattedDate = date("F j, Y", strtotime($date));
    
        // Convert time to desired format: hour:minute:am/pm to h:ia
        $formattedTime = date("g:ia", strtotime($time));
    
        // Concatenate date and time with a space in between
        $formattedDateTime = $formattedDate . " " . $formattedTime;
    
        // Return the formatted date and time
        return $formattedDateTime;
    }
    function reverseDateTimeFormat($datetime) {
        $dateTimeObj = new DateTime($datetime);
        $date = $dateTimeObj->format('m/d/Y');
        $time = $dateTimeObj->format('h:ia');
        $time = strtolower($time); // Convert time to lowercase (am/pm)
        return array('date' => $date, 'time' => $time);
    }
    
    function datetime_array($datetime_str, $tz='America/New_York') { // '2023-04-06T22:48:00.000Z'
        $date = new DateTime($datetime_str, new DateTimeZone($tz));

        // $date_formatted = $date->format('F j, Y'); // Output: April 6, 2023
        $date_formatted = $date->format('M j, Y'); // Output: April 6, 2023
        $time_formatted = $date->format('g:i A'); // Output: 10:48pm

        return array(
            'date' => $date_formatted,
            'time' => $time_formatted
        );
    }

    function compare_dates($current_datetime, $target_datetime) {
        // var_dump($date1, $date2);
        $current = new DateTime($current_datetime);
        $target = new DateTime($target_datetime);
    
        if ($current > $target) {
            // Current time > Countdown time
            return '0';
        } else {
            // Countdown time > Current time
            return '1';
        }
    }
    function combine_datetime_with_time($db_datetime, $db_time) {
        // Extract date and time components from the first datetime
        list($date, $time) = explode(' ', $db_datetime);
        list($hour, $minute, $second) = explode(':', $time);
    
        // Extract time components from the second time
        list($new_hour, $new_minute, $new_second) = explode(':', $db_time);
    
        // Calculate the new time by adding the hours, minutes, and seconds
        $new_hour = intval($hour) + intval($new_hour);
        $new_minute = intval($minute) + intval($new_minute);
        $new_second = intval($second) + intval($new_second);
    
        // Adjust the date if the new time exceeds 24 hours
        if ($new_hour >= 24) {
            $days_to_add = floor($new_hour / 24);
            $new_hour = $new_hour % 24;
            $combined_datetime = new DateTime($date . ' +' . $days_to_add . ' days');
        } else {
            $combined_datetime = new DateTime($date);
        }
    
        $combined_datetime->setTime($new_hour, $new_minute, $new_second);
    
        return $combined_datetime->format('Y-m-d H:i:s');

        // // Example usage
        // $db_datetime = '2023-09-11 22:22:43.000000';
        // $db_time = '11:10:45';
        
        // $combined_datetime = combine_datetime_with_time($db_datetime, $db_time);
        // echo $combined_datetime;
    }
    function next_seven_days() {
        // Get the current date
        $currentDate = new DateTime();
        $currentDay = $currentDate->format('d'); // Day of the month
        $currentDayOfWeek = $currentDate->format('D'); // Day of the week (abbreviated)

        // Create an array to store the date information for the next 6 days
        $next6Days = array();

        // Loop to get the date information for the next 6 days
        for ($i = 0; $i < 7; $i++) {
            $nextDay = clone $currentDate;
            $nextDay->modify("+$i day");

            $nextDayInfo = array(
                'day' => $nextDay->format('d'),
                'day_of_week' => $nextDay->format('D')
            );

            $next6Days[] = $nextDayInfo;
        }

        return $next6Days;
    }
    

    
    /*
    =================================================================

        FOLDERS & DIRECTORIES
    
    =================================================================  
    */ 
    function photoOrDefault($user_photo, $admin=null) {
        

        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $root = 'http://'.$_SERVER['SERVER_NAME'].'/'.'uncutcollege';
        } else {
            $root = 'https://'.$_SERVER['SERVER_NAME'];
        }

        $path_1 = $root.'/'.'avatars/';
        $path_2 = $root.'/'.'assets/';


        if(isset($user_photo)){
            if($user_photo == '') {
                $photoSrc = $path_2.'avi.png';
            } else {
                $photoSrc = $path_1.$user_photo;
            }
        } else {
            $photoSrc = $path_2.'avi.png';
        }
        return $photoSrc;
    }
    
    function get_pagename() {
        $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
        return $pagename;
    }
    function get_folder() {
        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
        $folder = $uriArray[1];
        return $folder;
    }
    function empty_folder() {
        $files = glob('./assets/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                unlink($file); // delete file
            }
        }
    }
    function get_server_data() {
        $server = $_SERVER['SERVER_NAME']; // localhost
        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
        $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

        
        $folder = $uriArray[1];
        if($folder === "admin") {
            $path = '../';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[2]);  
            $scriptName = $scriptFull[0];  
            // $scriptType = $scriptFull[1]; 
        } else {
            $path = './';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[1]);
            $scriptName = $scriptFull[0];
            // $scriptType = $scriptFull[1];
        }

        $s = array(
            'server' => $server,
            'uri' => $uriArray,
            'pagename' => $pagename,
            'directory' => $folder,
            'rel_path' => $path,
            'script_name' => $scriptName
            // 'script_type' => $scriptType
        );
        return $s;
    }
    function getFilenameFromURL($url) {
        $filename = basename($url);
        return $filename;
    }
    function getFullURL() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $hostname = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] != '80' ? ':' . $_SERVER['SERVER_PORT'] : '';
        $path = $_SERVER['REQUEST_URI'];
    
        return $protocol . $hostname . $port . $path;
    }
    
    function generateSlug($input) {
        $slug = strtolower($input);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }
    /*
    =================================================================

        EMAILS
    
    =================================================================  
    */ 
    function send_this_mail($email, $url) {
        $to = $email;
        $from = 'testemail6329@gmail.com';
        
        $message = "<p>Your password reset link: </p>$url";
    
        $headers = "From: $from";
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
        $subject = 'OkTnx Password Reset';

    
        $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
        $body .= $message;
        $body .= "</body></html>";
    
        $send = mail($to, $subject, $body, $headers);
    }
    function sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $to, $subject, $msgBody) {

        // Swiftmailer
        require_once 'vendor/autoload.php';
        

        // Create the Transport
        $transport = (new Swift_SmtpTransport($host, $port, $encryption))
        ->setUsername($username) // Email used to send mail
        ->setPassword($pwd) // Password
        ;

        // // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
    
        
        $message = (new Swift_Message($subject))
        ->setFrom([$username => 'LoremIpsum'])  // Email used to send mail
        ->setTo([$to])
        ->setBody($msgBody,'text/html')
        ;
        // var_dump($message);
        
        // Send the message
        // $result = $mailer->send($message);
        if ($mailer->send($message)) {
            echo '[SWIFTMAILER] sent email to ' . $to;
        } else { 
            echo '[SWIFTMAILER] not sending email: ' . $mailLogger->dump();
        }  
    }
    // function sendEmailSwiftMandril() {
    //     // require_once 'path/to/swiftmailer/lib/swift_required.php';
    //     require_once 'vendor/autoload.php';

    //     // Create the Transport
    //     $transport = (new Swift_SmtpTransport('smtp.mandrillapp.com', 587))
    //         ->setUsername('shadmanwebdev') // Use your Mandrill SMTP username
    //         ->setPassword('md-fFWMfoH6dLV6TrXiIbB1Og'); // Use your Mandrill SMTP password

    //     // Create the Mailer using your created Transport
    //     $mailer = new Swift_Mailer($transport);

    //     // Create a message
    //     $message = (new Swift_Message('Subject of the Email'))
    //         ->setFrom(['shadmanwebdev@gmail.com' => 'Your Name'])
    //         ->setTo(['synotype@gmail.com' => 'Recipient Name'])
    //         ->setBody('Hello, this is the email body.');

    //     // Send the message
    //     $result = $mailer->send($message);

    //     var_dump($result);

    //     // Check if the email was sent successfully
    //     if ($result) {
    //         echo 'Email sent successfully';
    //     } else {
    //         echo 'Failed to send email';
    //     }

    // }
    function verification_email($email) {
        // SEND THE EMAIL
        $server = $_SERVER['SERVER_NAME'];

        if($server === 'localhost') {
            return;
        } else {
            // Generate verification link
            $url = generatePwdLink($email);

            // Send email
            $to = $email;
            $subject = 'Antelov Verification Email';
            $msgBody = "<p>Verify your email by clicking link below</p>";
            $msgBody .= '<a href="'.$url.'">'.$url.'</a>';
            sendEmailSwiftMailer($to, $subject, $msgBody);  
        }
    }
    /*
    =================================================================

        CALCULATIONS
    
    =================================================================  
    */ 
    function percentage($part, $total) {
        return ( $part / $total ) * 100;
    }
    function part($part, $total) {
        return ( $total * $part ) / 100;
    }
    /*
    =================================================================

        HTML BLOCKS
    
    =================================================================  
    */ 
    function get_footer_logo() {
        return "<div class='logo footer-logo'>                
            <div class='logo-text'>
                <a href='./'>
                    LOGO
                </a>
            </div>
        </div>";
    }
    function nav_logo() {
        return "<div class='logo nav-logo' id='desktop-logo'>      
            <a href='./'>
                <img src='./img/DESKTOP_LOGO_OKTNX_WEB.png' alt=''>
            </a>
        </div>";
    }
    function nav_links() {
        echo "<div class='nav-links'>
            <a class='login-link' href='./login'>Login</a>
            <a class='signup-link' href='./register'>Sign Up</a>
        </div>";
    }
    function mob_nav_links() {
        echo "<li class='list-item'>
            <a href='./login'>Login</a>
        </li>
        <li class='list-item' style='margin-bottom: 20px;'>
            <a href='./register'>Sign Up</a>
        </li>";
    }
    
    function loggedin_dropdown() {
        echo "<div id='logged-in'>
            <div id='dropdown-trigger'>
                <div class='profile-icon'>
                    <img src='./img/svg/user-128.svg' class='filter-wh'>
                </div>
                <div>Alex</div>
            </div>
            <ul id='logged-in-dropdown' class='hidden'>
                <li><a href='./myaccount'>My Account</a></li>
                <li><a href='./signout-handler?signout=true'>Sign out</a></li>
            </ul>
        </div>";
    }

    /*
    =================================================================

        DATA MANIPULATION & VALIDATION
    
    =================================================================  
    */ 
    function parseStringToArray($string) {
        return explode("|", $string);
    }
    function parseStringToArray2($string) {
        $lines = explode("|", $string);
        $data = [];
      
        foreach ($lines as $line) {
            $line = trim($line);
      
            if (!empty($line)) {
                list($label, $value) = explode(':', $line, 2);
                $label = trim($label);
                $value = trim($value);
        
                $data[] = [
                    'label' => $label,
                    'value' => $value
                ];
            }
        }
      
        return $data;
    }
    function remove_array_item_by_key($array, $key) {
        unset($array[$key]);
    }
    function remove_array_item($array, $item) {
        $myArray = array_filter($array, function ($item) {
            return $value !== $item;
        });
    }
    function first_char($str) {
        return substr($str, 0, 1);
    }
    function sortAlphabetically($array) {
        if (!is_array($array)) {
            return false;
        }       
        sort($array, SORT_STRING | SORT_FLAG_CASE);
        return $array;
    }

    function createHTMLStringFromArray($textArray) {
        $htmlString = '';
    
        foreach ($textArray as $textItem) {
            // Escape the text item to prevent HTML injection
            $escapedTextItem = htmlspecialchars($textItem, ENT_QUOTES, 'UTF-8');
    
            // Append the HTML string for each text item to the main string
            $htmlString .= "<span class='option' id='$escapedTextItem'>$escapedTextItem</span>";
        }
    
        return $htmlString;
    }
    function getFirstParagraph($text) {
        // Split the text into paragraphs
        $paragraphs = preg_split('/\n\s*\n/', $text);
    
        // Get the first paragraph
        $firstParagraph = trim($paragraphs[0]);
    
        // Return the first paragraph
        return $firstParagraph;
    }
    function paragraphs($content) {
        $paragraphs = preg_split('/\n/', $content);

        $pStr = "";
        foreach($paragraphs as $paragraph):
            $pStr .= "<p>$paragraph</p>";
        endforeach;
        return $pStr;
    }
    function jsonToStr($a) {  
        /*
            The function takes a JSON-encoded string, decodes it into an array, 
            and then concatenates the array elements into a new string separated by commas and spaces. 
            The resulting string is returned by the function.
        */
        $new_str = '';
        $b = json_decode($a, true);
        // $new_array = explode(",", $new_array);
        if(is_array($b)) {
            if(count($b) > 0) {
                for($s=0; $s < count($b); $s++) {
                    if($s == 0) {
                        $new_str .= $b[$s];
                    } else {
                        $new_str .= ', '.$b[$s];
                    }
                }
                $new_str .= '';
            }
        }
        return $new_str;
    }
    function empty_array($arr) {
        /*
            Unsets an array and returns an empty array
        */
        unset($arr);
        $arr = array();
        return $arr;
    }
    /*
        This function takes a string of content and a desired length as input. It removes 
        any HTML or PHP tags from the content and, if necessary, truncates the content to 
        the specified length with an ellipsis. The resulting modified content is then 
        returned by the function.
    */
    function segment($content, $len) {
        $length = strlen($content);
        $content = strip_tags($content);
        if($length > $len) {
            $content = substr($content, 0, $len).'...'; 
        }  
        return $content;
    }
    function read_time($content) {
        $words = explode(' ',$content);
        $time = count($words) / 200;
        $time = explode('.', $time);
        return $time[0];
    } 
    /*
    =================================================================

        cURL
    
    =================================================================  
    */ 
    function _doHttpGet($url, $apiKey) {
        $headers = array(
            'Content-Type: application/json',
            sprintf('Authorization: Bearer %s', $apiKey)
        );
            
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        // curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($c, CURLOPT_POSTFIELDS, $body );
        // curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $responseBody = curl_exec($c);
        // var_dump($responseBody);
        curl_close($c);
        return $responseBody;
    }
    function _doHttpPost($url, $data, $apiKey) {
        $headers = array(
            'Content-Type: application/json',
            sprintf('Authorization: Bearer %s', $apiKey)
        );
            
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, 1);
        // curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($c, CURLOPT_POSTFIELDS, $body );
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $responseBody = curl_exec($c);
        // var_dump($responseBody);
        curl_close($c);
        return $responseBody;
    }
    function _doHttpPatch($url, $data, $apiKey) {
        $headers = array(
            'Content-Type: application/json',
            sprintf('Authorization: Bearer %s', $apiKey)
        );
            
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        // curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($c, CURLOPT_POSTFIELDS, $body );
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $responseBody = curl_exec($c);
        // var_dump($responseBody);
        curl_close($c);
        return $responseBody;
    }
    function _doHttpDelete($url, $apiKey) {
        $headers = array(
            'Content-Type: application/json',
            sprintf('Authorization: Bearer %s', $apiKey)
        );
            
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        $responseBody = curl_exec($c);
        curl_close($c);
        return $responseBody;
    }
?>