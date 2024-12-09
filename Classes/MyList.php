<?php
/*
=================================================================
    CRUD (create, read, update, delete)
    DISPLAY
    VALIDATION
=================================================================  
*/
class MyList extends Db {
    public function __construct() {
        $this->con = $this->con();
    }
    /*
    =================================================================
        CRUD (create, read, update, delete)
    =================================================================  
    */    
    public function add_to_list() {  
        startSession();
        $ad_id = $_POST['profile_id'];
        $created_by_id = $this->get_uid();

        if(isset($created_by_id)) {
            // Check if the user has already added this ad to his list
            $item_exists = $this->item_exists($ad_id, $created_by_id);
            if($item_exists == '0') {
                $created_at = datetime_now();
                
                $stmt = $this->con->prepare("INSERT INTO mylist(ad_id, created_by_id, created_at) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $ad_id, $created_by_id, $created_at);
                if($stmt->execute()) {   
                    $status = '1';
                } else {
                    $status = '0';
                    die('prepare() failed: ' . htmlspecialchars($this->con->error));
                    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }
                $stmt->close();
            } else {
                $stmt = $this->con->prepare("DELETE FROM mylist WHERE ad_id=? AND created_by_id=?");
                $stmt->bind_param('ii', $ad_id, $created_by_id);
                $stmt->execute();
                $stmt->close();
                $status = '0';
            }
        } else {
            $status = '3';
        }
        
        echo $status;
    }
    public function get_list_item($id) {
        $stmt = $this->con->prepare("SELECT * FROM mylist WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }
    public function get_user_list_items($id) {
        $stmt = $this->con->prepare("SELECT * FROM mylist WHERE created_by_id=? ORDER BY id DESC");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function get_mylist() {
        /* 
            We join the 3 tables in this function
            which are referenced in our mylist columns
            id (mylist item), ad_id (tutor's ad), created_by_id (student)
        */
        $created_by_id = $this->get_uid();
        $mylist_items = array();

        // SQL statement
        $sql = "SELECT 
            mylist.created_by_id,
            mylist.created_at,
            mylist.ad_id,
            ads.tutor_id,
            users.firstname,
            users.lastname,
            users.email
        FROM 
            mylist 
        LEFT JOIN
            ads ON mylist.ad_id = ads.ad_id
        LEFT JOIN
            users ON ads.tutor_id = users.id
        WHERE 
            mylist.created_by_id=?";

        // Prepare the SQL statement with the JOIN clause
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        $stmt->bind_param("i", $created_by_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(intval($result->num_rows) > 0) {
                foreach($data as $row) {
                    // Get interval between now and account creation
                    $elapsed = elapsed($row['created_at']);

                    $mylist_item = array(
                        'id' => $row['id'],
                        'created_by_id' => $row['created_by_id'],
                        'ad_id' => $row['ad_id'],
                        'tutor_id' => $row['tutor_id'],
                        'firstname' => $row['firstname'],
                        'lastname' => $row['lastname'],
                        'email' => $row['email']
                    );
                    array_push($mylist_items, $mylist_item);
                }
            }
        }
        return $mylist_items;
    }
    /*
    =================================================================
        DISPLAY
    =================================================================  
    */
    public function mylist() {
        $mylist_items = $this->get_mylist();
        
        $num_of_rows = count($mylist_items);


        $mylistStr = "";


        if($num_of_rows > 0) {
            echo $mylistStr;
        } else {
            echo '</div>Nothing found</div>';
        }
    }
    /*
    =================================================================
        VALIDATION
    =================================================================  
    */
    function item_exists($ad_id, $created_by_id) {
        $stmt = $this->con->prepare("SELECT COUNT(*) as count FROM mylist WHERE ad_id = ? AND created_by_id = ?");
        $stmt->bind_param("ii", $ad_id, $created_by_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0 ? '1' : '0';
    }
}