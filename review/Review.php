<?php
/*
=================================================================
    SESSIONS & COOKIES
    CRUD (create, read, update, delete, login)
    DISPLAY
=================================================================  

*/


class Review extends Db {
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
        session_unset();
        session_destroy();
    }
    public function get_reviews($ad_id) {
        $sql = "SELECT
            users.firstname AS student_firstname,
            users.lastname AS student_lastname,
            users.photo AS student_photo,
            reviews.review_id,
            reviews.ad_id,
            reviews.student_id,
            reviews.review_content,
            reviews.rating
        FROM reviews 
        LEFT JOIN
            users ON reviews.student_id = users.id
        WHERE ad_id=?";

        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        $stmt->bind_param('i', $ad_id);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
    }
    public function create_review() {
        $this->startSession();
        // var_dump($_POST);
        $ad_id = $_POST['ad_id'];
        $tutor_id = $_POST['tutor_id'];
        $student_id = get_uid();
        $rating = $_POST['rating'];
        $review_content = $_POST['review'];
        $created_at = datetime_now();

        // var_dump($ad_id, $tutor_id, $student_id, $rating, $review_content, $created_at);

        $stmt = $this->con->prepare("INSERT INTO reviews (
            ad_id, tutor_id, student_id, rating, review_content, created_at)
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiiss', $ad_id, $tutor_id, $student_id, $rating, $review_content, $created_at);
        if($stmt->execute()) {
            $review_id = $stmt->insert_id;
            $stmt->close();

            $revStr = $this->single_review($review_id);
        }
        echo $revStr;
    }
    public function reviews($ad_id) {
        $reviews = $this->get_reviews($ad_id);

        if (!empty($reviews)) {
            $num_reviews = count($reviews);

            $totalRating = 0;
            foreach ($reviews as $review) {
                $totalRating += $review['rating'];
            }
            $avg_rating_full = $num_reviews > 0 ? $totalRating / $num_reviews : 0;

            $avg_rating = number_format($avg_rating_full, 1);
        } else {
            $num_reviews = 0;
            $avg_rating = 0;
        }



        $revStr = "<div class='row' id='reviews'>
            <div class='col-md-8 review-title-wrapper'>
                <h2>Review</h2>
                <div class='rating-wrapper'>
                    <div class='rating'>
                        <span><i class='icon icon-star2'></i></span>
                        <span>$avg_rating ($num_reviews reviews)</span>
                    </div>
                </div>
            </div>
            <ul class='list col-md-8'>";
            if(count($reviews) > 0) {
                foreach($reviews as $review) {

                    if(!empty($review['student_photo'])) {
                        $student_photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$review['student_photo']}' />";
                    } else {
                        $str = $review['student_firstname'];
                        $fChar = $str[0];
                        $student_photo = "<div class='user-no-picture'>$fChar</div>";
                    }

                    $revStr .= "<li class='review-item'>
                        <div class='user-infos'>
                            <div class='avatar'>
                                <div class='picture'>
                                    $student_photo
                                </div>
                                <p>{$review['student_firstname']} {$review['student_lastname']}</p>
                            </div>
                            <div class='rating'>
                                <span><i class='icon icon-star2'></i></span>
                                <span>{$review['rating']}</span>
                            </div>
                        </div>
                        <p class='main-text'>{$review['review_content']}</p>
                    </li>";
                }
            } else {
                $revStr .= "<li class='review-item' style='display:none; padding: 0; margin: 0;'></li>";
            }
        
        $revStr .= "</ul>
        </div>";

        echo $revStr;
    }
    public function get_review($review_id) {
        $sql = "SELECT
            users.firstname AS student_firstname,
            users.lastname AS student_lastname,
            users.photo AS student_photo,
            reviews.review_id,
            reviews.ad_id,
            reviews.student_id,
            reviews.review_content,
            reviews.rating
        FROM reviews 
        LEFT JOIN
            users ON reviews.student_id = users.id
        WHERE review_id=? LIMIT 1";

        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        $stmt->bind_param('i', $review_id);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
    }
    public function single_review($review_id) {
        $review = $this->get_review($review_id)[0];

        if(!empty($review['student_photo'])) {
            $student_photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$review['student_photo']}' />";
        } else {
            $str = $review['student_firstname'];
            $fChar = $str[0];
            $student_photo = "<div class='user-no-picture'>$fChar</div>";
        }

        
        $revStr = "<li class='review-item'>
            <div class='user-infos'>
                <div class='avatar'>
                    <div class='picture'>
                        $student_photo
                    </div>
                    <p>{$review['student_firstname']} {$review['student_lastname']}</p>
                </div>
                <div class='rating'>
                    <span><i class='icon icon-star2'></i></span>
                    <span>{$review['rating']}</span>
                </div>
            </div>
            <p class='main-text'>{$review['review_content']}</p>
        </li>";

        return $revStr;
    }
    public function review_exists_for_student($student_id) {
        $sql = "SELECT * FROM reviews WHERE student_id=? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
}