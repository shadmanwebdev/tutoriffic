<?php

class Question extends Db {
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
    public function create_question() {
        $topic = $_POST['topic'];
        $question = $_POST['question'];
        $priority_lvl = $_POST['priority'];
        
        $tutor_id = $_POST['tutor_id'];
        $student_id = get_uid();
        $created_at = datetime_now();
    
        $stmt = $this->con->prepare("INSERT INTO personal_subject_expert (
            topic, question, priority_lvl, tutor_id, student_id, created_at)
            VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }   
        $stmt->bind_param('sssiis', $topic, $question, $priority_lvl, $tutor_id, $student_id, $created_at);
    
        if($stmt->execute()) {
            $question_id = $stmt->insert_id;
            $stmt->close();
    
            if(isset($_FILES['image'])) {
                $filename = $_FILES['image']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                // Generate a unique filename
                $uniquesavename = time() . uniqid(rand(10, 20));
                $tempname = $_FILES['image']['tmp_name'];
                $destFile = "../img/" . $uniquesavename . '.' . $ext;

                // Move the uploaded file to the destination directory
                if (move_uploaded_file($tempname, $destFile)) {
                    // File moved successfully
                    $attachment_id = $this->insert_file($question_id, $filename, $ext, $created_at);

                    $stmt_img = $this->con->prepare("UPDATE personal_subject_expert SET attachment_id=? WHERE question_id=?");
                    $stmt_img->bind_param('ii', $attachment_id, $question_id);
                    if($stmt_img->execute()) {
                        $status = '1';
                    } else {
                        $status = '0';
                    }
                    $stmt_img->close();
                } else {
                    $status = '0';
                    echo 'Error moving the file.';
                }
            }
    
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        echo $status;
    }
    

    public function insert_file($file_question_id, $filename, $file_type, $uploaded_at) {
        // var_dump($file_question_id, $filename, $file_type, $uploaded_at);

        $stmtimg = $this->con->prepare("INSERT INTO question_files (
        file_question_id, flname, file_type, uploaded_at) VALUES (?, ?, ?, ?)");
        $stmtimg->bind_param('isss', $file_question_id, $filename, $file_type, $uploaded_at);
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
}