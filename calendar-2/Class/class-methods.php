<?php

function get_availability_by_gig_id($gig_id) {
    $sql = "SELECT selected_day, selected_time FROM gig_availability WHERE gig_id = ?";
    
    $stmt = $this->con->prepare($sql);
    if (!$stmt) {
        die('prepare() failed: ' . htmlspecialchars($this->con->error));
    }
    $stmt->bind_param("i", $gig_id);
    
    if($stmt->execute()) {
        $result = $stmt->get_result();
        $availability = array();
        
        while ($row = $result->fetch_assoc()) {
            $date = date('d-n-Y', strtotime($row['selected_day']));
            $time = date('g:i', strtotime($row['selected_time']));
            
            $found = false;
            foreach ($availability as &$item) {
                if ($item['date'] == $date) {
                    $found = true;
                    $item['times'][] = array('time' => $time);
                    break;
                }
            }
            if (!$found) {
                $availability[] = array(
                    'date' => $date,
                    'times' => array(array('time' => $time))
                );
            }
        }
        
        return $availability;
    } else {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
    
    $stmt->close();
}
function delete_gig_availability_by_gig_id($gig_id) {
    $sql = "DELETE FROM gig_availability WHERE gig_id = ?";
    
    $stmt = $this->con->prepare($sql);
    if (!$stmt) {
        die('prepare() failed: ' . htmlspecialchars($this->con->error));
    }
    $stmt->bind_param("i", $gig_id);
    
    if($stmt->execute()) {
        $status = '1';
    } else {
        $status = '0';
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
    
    $stmt->close();
    
    return $status;
}

function edit_form() {
    // Set the timezone
    $timezone = new DateTimeZone('Europe/London');
    // Create a new DateTime object with the specified timezone
    $date = new DateTime('now', $timezone);
    $currentDayOfWeek = $date->format("D");
    // Sat or Sun
    if($currentDayOfWeek == 'Sat') {
        $date->modify('+2 days');
    } else if($currentDayOfWeek == 'Sun') {
        $date->modify('+1 day');
    }

    // Get current date in numerical format (day)
    $currentDay = $date->format('d');
    // Get current month in numerical format
    $currentMonth = $date->format('n');
    // Get current year
    $currentYear = $date->format('Y');
    // Get current day of week
    $currentDayOfWeek = $date->format("D");

    // Get preselected dates
    $datetimes_array = $this->get_availability_by_gig_id($gig_id);

    if(isset($_SESSION['datetimes'])) {
        unset($_SESSION['datetimes']);
    }

    $json_encoded_array = json_encode($datetimes_array, true);
    $_SESSION['datetimes'] = $json_encoded_array;
    

    $month = show_month($currentMonth, $currentYear, array(), $json_encoded_array);
}

function update() {
    // Delete old ones
    $this->delete_gig_availability_by_gig_id($gig_id);

    // Get the datetimes
    $datetimes = json_decode($_SESSION['datetimes'], true);

    // Insert into 'gig_availability' table
    foreach ($datetimes as $item) {
        $selected_day = $item['date'];
    
        foreach ($item['times'] as $timeItem) {
            $selected_time = $timeItem['time'];
    
            $sql = "INSERT INTO gig_availability (gig_id, selected_day, selected_time) VALUES (?, ?, ?)";
            $stmt = $this->con->prepare($sql);
    
            if (!$stmt) {
                die("Error in SQL: " . $this->con->error);
            }
    
            $stmt->bind_param('iss', $gig_id, $selected_day, $selected_time);
            $stmt->execute();
            $stmt->close();
        }
    }
}