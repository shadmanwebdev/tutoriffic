<?php
/*
    create()
    update()
    delete()
    reply_form()
    create_ticket_form()
    support_accounts_admin()
    support_tickets_admin()
    create_ticket_form()ticket_replies(
*/

class Support extends Db {
    public function __construct() {
        $this->con = $this->con();
    }
    private function startSession() {
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }
    }
    private function endSession() {
        if(isset($_SESSION)) { 
            session_unset();
            session_destroy();
        }
    }
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
    public function get_support_id() {
        if(isset($_COOKIE['support_account'])) {
            $userdata = json_decode($_COOKIE['support_account'], true);
            $support_account_id = $userdata['support_account_id'];
            return $support_account_id;
        } else if(isset($_SESSION['support_account'])) {
            $userdata = json_decode($_SESSION['support_account'], true);
            $support_account_id = $userdata['support_account_id'];
            return $support_account_id;
        }
    }
    public function create_report() {
        $reported_ad_id = intval($_POST['reported_ad_id']);
        $reported_by = intval($_POST['reported_by']);
        $msg = $_POST['msg'];
        $created_at = datetime_now(); // Assuming datetime_now() is a function that returns current datetime
    
        // Insert the data into the reports table
        $stmt = $this->con->prepare("INSERT INTO reports (reported_ad_id, reported_by, message, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $reported_ad_id, $reported_by, $msg, $created_at);
    
        if ($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        echo $status;
    }
    
    public function create_ticket() {

        $ticket_by = get_uid();
        $ticket_subject = $_POST['ticket_subject'];
        $msg = $_POST['msg'];

        if(isset($_FILES['files'])) {
            $files = $_FILES['files']['name'];
            // var_dump(count($files));
            if(count($files) > 1 || (count($files) == 1 && !empty($files[0]))) {
                $screenshots = $this->add_screenshots('files');
            } else {
                $screenshots = '';
            }
        }
        
        $created_at = datetime_now();
        
        // var_dump($screenshots);
        // var_dump($support_id, $domain_name, $ticket_subject, $msg, $screenshots, $ticket_status, $created_at);

        $stmt = $this->con->prepare("INSERT INTO support_tickets(ticket_by, ticket_subject, msg, screenshots, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $ticket_by, $ticket_subject, $msg, $screenshots, $created_at);

        if($stmt->execute()) {
            // $smtp_details = $this->smtp_details();
            // $email = $this->support_email($support_id);
            // $subject = "Email from Armoury Design";
            // $msgBody .= "<p>Hi. Thank you for contacting us. This email was sent to confirm that we've recieved your message. We'll contact you with a detailed response about your ticket. </p>";
            // // var_dump($smtp_details, $email, $subject, $msgBody);
            // // sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $to, $subject, $msgBody);
            // sendEmailSwiftMailer($smtp_details['smtp_host'], $smtp_details['smtp_port'], $smtp_details['smtp_encryption'], $smtp_details['username'], $smtp_details['pwd'], $email, $subject, $msgBody);
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        echo $status;
    }
    public function create_reply() {
        $support_ticket_id = intval($_POST['support_ticket_id']);
        $ticket_by = get_uid();
        $msg = $_POST['msg'];

        $user_status = get_user_status();
        $reply_type = $user_status;
        

        $screenshots = '';
        if(isset($_FILES['files'])) {
            $files = $_FILES['files']['name'];
            // var_dump(count($files));
            if(count($files) > 1 || (count($files) == 1 && !empty($files[0]))) {
                $screenshots = $this->add_screenshots('files');
            }
        }
        
        $created_at = datetime_now();

        // var_dump($screenshots);
        // var_dump($reply_type, $support_ticket_id, $support_id, $msg, $screenshots, $created_at);

        
        $stmt = $this->con->prepare("INSERT INTO ticket_replies(reply_type, support_ticket_id, ticket_by, msg, screenshots, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siisss", $reply_type, $support_ticket_id, $ticket_by, $msg, $screenshots, $created_at);
        
        if($stmt->execute()) {
            $status = '1';
            $ticket_reply_id = $stmt->insert_id;
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        $reply_html = $this->ticket_reply($ticket_reply_id);

        $response = array(
            'status' => $status,
            'reply_origin' => $_POST['reply_origin'],
            'html' => $reply_html
        );

        echo json_encode($response, true);
    }
    public function get_ticket_status($ticket_id) {
        $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $ticket_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):
                    $ticket_status = $row['ticket_status'];       
                endforeach;
            } 
        }
        return $ticket_status;
    }
    public function get_support_ticket($ticket_id) {
        $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $ticket_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):
                    $createdMjYDate = datetime_mjy($row['created_at']);
                    if(!empty($row['updated_at']) && $row['updated_at'] != null) {
                        $updatedMjYDate = datetime_mjy($row['updated_at']);
                    } else {
                        $updatedMjYDate = '';
                    }
                    $ticket_array = array(
                        'ticket_id' => $row['id'],
                        'ticket_by' => $row['ticket_by'],
                        'ticket_subject' => $row['ticket_subject'],
                        'msg' => $row['msg'],
                        'screenshots' => $row['screenshots'],
                        'ticket_status' => $row['ticket_status'],
                        'created_at' => $row['created_at'],
                        'created_mjy_date' => $createdMjYDate,
                        'updated_at' => $row['updated_at'],
                        'updated_mjy_date' => $updatedMjYDate
                    );        
                endforeach;
            } 
        }
        return $ticket_array;
    }
    public function last_reply_date($ticket_id) {
        $tickets_array = array();
        $stmt = $this->con->prepare("SELECT * FROM ticket_replies WHERE support_ticket_id=? ORDER BY ticket_reply_id DESC LIMIT 1");
        $stmt->bind_param('i', $ticket_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $createdMjYDate = datetime_mjy($row['created_at']);  
                endforeach;
            } else {
                $stmt->close();
                $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE id=? LIMIT 1");
                $stmt->bind_param('i', $ticket_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                if(isset($data)) {
                    if(count($data) > 0) {
                        foreach($data as $row):
                            $createdMjYDate = datetime_mjy($row['created_at']);       
                        endforeach;
                    } 
                }
            }
        } else {
            $stmt->close();
            $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $ticket_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(isset($data)) {
                if(count($data) > 0) {
                    foreach($data as $row):
                        $createdMjYDate = datetime_mjy($row['created_at']);       
                    endforeach;
                } 
            }
        }
        return $createdMjYDate;
    }
    public function ticket_by_email($ticket_by) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param('i', $ticket_by);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row['email'];
            }
        }
    }
    public function support_ticket($ticket_id) {
        $support_ticket = $this->get_support_ticket($ticket_id);

        $ticket_by_email = $this->ticket_by_email($support_ticket['ticket_by']);

        // Screenshots
        $screenshots_array = json_decode($support_ticket['screenshots']);
        $screenshots_str = "";
        if(gettype($screenshots_array) == 'array') {
            $screenshots_str .= "<div style='display: flex; flex-flow: row wrap; margin-top: 20px;'>";
            if(count($screenshots_array) > 0) {
                foreach ($screenshots_array as $screenshot) {
                    $screenshots_str .= "<div style='margin-right: 10px; margin-bottom: 10px;'>
                        <a href='./img/$screenshot'>
                            <img style='width: 80px; height: auto;' src='./img/$screenshot'>
                        </a>
                    </div>";
                }
            }
            $screenshots_str .= "</div>";
        }

        $msg = nl2br($support_ticket['msg']);

        $ticket_str = "<div class='ticket-header'>
                <div class='columns'>
                    <h2>Support Ticket #{$support_ticket['ticket_id']}</h2>
                </div>
                <div class='columns text-right'>
                    <h2>Created: {$support_ticket['created_mjy_date']}</h2>
                </div>
            </div>

            <hr>

            <div class='row follow3'>
                <div class='columns'>
                    <h3 class='supporth3'>{$support_ticket['ticket_subject']}</h3>
                </div>        
            </div>
            
            <div class='row reply'>
                <div class='columns'>
                    <div class='columns clientblock'>
                        <div class='row'>
                            <div class='columns'>
                                <span class='titletext'>{$ticket_by_email} </span>
                                <span class='timestamp' title='{$support_ticket['created_mjy_date']} '>{$support_ticket['created_mjy_date']}</span>
                                <hr style='border=top: 1px solid #EEE; margin-bottom: 0.8rem;'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='columns'>
                                <div class='message clienttext'>
                                    $msg
                                    $screenshots_str
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        return $ticket_str;
    }
    public function support_ticket_admin($ticket_id) {
        $support_ticket = $this->get_support_ticket($ticket_id);

        // Screenshots
        $screenshots_array = json_decode($support_ticket['screenshots']);
        $screenshots_str = "";
        if(gettype($screenshots_array) == 'array') {
            $screenshots_str .= "<div style='display: flex; flex-flow: row wrap; margin-top: 20px;'>";
            if(count($screenshots_array) > 0) {
                foreach ($screenshots_array as $screenshot) {
                    $screenshots_str .= "<div style='margin-right: 10px; margin-bottom: 10px;'>
                        <a target='_blank' href='../img/$screenshot'>
                            <img style='width: 80px; height: auto;' src='../img/$screenshot'>
                        </a>
                    </div>";
                }
            }
            $screenshots_str .= "</div>";
        }

        $ticket_str = "<div class='row reply'>
            <div class='support'>
                <div class='row'>
                    <div class='small-6 columns'>
                        <h2>Support Ticket #{$support_ticket['ticket_id']}</h2>
                    </div>
                    <div class='small-6 columns text-right'>
                        <h2>Created: {$support_ticket['created_mjy_date']}</h2>
                    </div>
                </div>

                <hr>

                <div class='row follow3'>
                    <div class='small-12 columns'>
                        <h3 class='supporth3'>{$support_ticket['ticket_subject']}</h3>
                    </div>        
                </div>
                
                <div class='row reply'>
                    <div class='small-12 columns'>
                        <div class='small-11 columns clientblock'>
                            <div class='row'>
                                <div class='small-12 columns'>
                                    <span class='titletext'>{$support_ticket['support_email']} </span>
                                    <span class='timestamp' title='{$support_ticket['created_mjy_date']} '>{$support_ticket['created_mjy_date']}</span>
                                    <hr style='border=top: 1px solid #EEE; margin-bottom: 0.8rem;'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='small-12 columns'>
                                    <div class='message clienttext'>
                                        {$support_ticket['msg']}
                                        $screenshots_str
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        return $ticket_str;
    }
    public function get_support_tickets($ticket_status='all', $limit=null) {
        $tickets_array = array();
        if($limit == null) {
            if($ticket_status == 'all') {
                $stmt = $this->con->prepare("SELECT * FROM support_tickets ORDER BY ticket_id DESC");
            } else {
                $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE ticket_status=? ORDER BY ticket_id DESC");
                $stmt->bind_param('s', $ticket_status);
            }
        } else {
            if($ticket_status == 'all') {
                $stmt = $this->con->prepare("SELECT * FROM support_tickets ORDER BY ticket_id DESC LIMIT $limit");
            } else {
                $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE ticket_status=? ORDER BY ticket_id DESC LIMIT $limit");
                $stmt->bind_param('s', $ticket_status);
            }
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $createdMjYDate = datetime_mjy($row['created_at']);
                    if(!empty($row['updated_at']) && $row['updated_at'] != null) {
                        $updatedMjYDate = datetime_mjy($row['updated_at']);
                    } else {
                        $updatedMjYDate = '';
                    }

                    $ticket_array = array(
                        'ticket_id' => $row['id'],
                        'ticket_by' => $row['ticket_by'],
                        'domain_name' => $row['domain_name'],
                        'ticket_subject' => $row['ticket_subject'],
                        'msg' => $row['msg'],
                        'screenshots' => $row['screenshots'],
                        'ticket_status' => $row['ticket_status'],
                        'created_at' => $row['created_at'],
                        'created_mjy_date' => $createdMjYDate,
                        'updated_at' => $row['updated_at'],
                        'updated_mjy_date' => $updatedMjYDate
                    );     
                    array_push($tickets_array, $ticket_array);    
                endforeach;
            } 
        }
        return $tickets_array;
    }
    public function get_support_tickets_by_account($ticket_by, $limit=null) {
        $tickets_array = array();
        if($limit == null) {
            $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE ticket_by=?");
        } else {
            $stmt = $this->con->prepare("SELECT * FROM support_tickets WHERE ticket_by=? LIMIT $limit");
        }
        $stmt->bind_param('i', $ticket_by);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $createdMjYDate = datetime_mjy($row['created_at']);
                    if(!empty($row['updated_at']) && $row['updated_at'] != null) {
                        $updatedMjYDate = datetime_mjy($row['updated_at']);
                    } else {
                        $updatedMjYDate = '';
                    }

                    $ticket_array = array(
                        'ticket_id' => $row['id'],
                        'ticket_by' => $row['ticket_by'],
                        'ticket_subject' => $row['ticket_subject'],
                        'msg' => $row['msg'],
                        'screenshots' => $row['screenshots'],
                        'ticket_status' => $row['ticket_status'],
                        'created_at' => $row['created_at'],
                        'created_mjy_date' => $createdMjYDate,
                        'updated_at' => $row['updated_at'],
                        'updated_mjy_date' => $updatedMjYDate
                    );     
                    array_push($tickets_array, $ticket_array);    
                endforeach;
            } 
        }
        return $tickets_array;
    }
    public function support_tickets_admin($ticket_status='all', $limit=null) {
        $tickets_array = $this->get_support_tickets($ticket_status, $limit);
        // $pagename = get_pagename();

        // <span>October 6, 2022, 2:51 pm </span>
        $tickets_str = "";
        foreach($tickets_array as $ticket_array): 
            if($ticket_status == 'all') {
                $ticket_action_links = "<a href='../controllers/support-handler?ticket_close={$ticket_array['ticket_id']}&org=admin-tickets'>Close</a>
                <a class='open-btn' href='../controllers/support-handler?ticket_open={$ticket_array['ticket_id']}&org=admin-tickets'>Open</a>";
            } else if($ticket_status == 'open') {
                $ticket_action_links = "<a href='../controllers/support-handler?ticket_close={$ticket_array['ticket_id']}&org=admin-tickets-open'>Close</a>
                <a class='open-btn' href='../controllers/support-handler?ticket_open={$ticket_array['ticket_id']}&org=admin-tickets-open'>Open</a>";
            } else if($ticket_status == 'closed') {
                $ticket_action_links = "<a href='../controllers/support-handler?ticket_close={$ticket_array['ticket_id']}&org=admin-tickets-closed'>Close</a>
                <a class='open-btn' href='../controllers/support-handler?ticket_open={$ticket_array['ticket_id']}&org=admin-tickets-closed'>Open</a>";
            }
            if($ticket_array['ticket_status'] == 'open') {
                $ticket_status_str = "<span class='status escalated' style='text-transform: capitalize; color:green'>{$ticket_array['ticket_status']}</span>";
            } else {
                $ticket_status_str = "<span class='status escalated' style='text-transform: capitalize; color:gray'>{$ticket_array['ticket_status']}</span>";
            }
            $tickets_str .= "<tr>
                <td>
                    <a href='./ticket?id={$ticket_array['ticket_id']}'>#{$ticket_array['ticket_id']} {$ticket_array['ticket_subject']}</a>
                </td>
                <td class='small-4 d-none d-xl-table-cell'>
                    <span>{$ticket_array['created_mjy_date']} </span>
                </td>
                <td class='small-2' style='text-align:left;'>
                    $ticket_status_str
                </td>
                <td class='table-action'>
                    $ticket_action_links
                </td>
            </tr>";  
        endforeach;
       return $tickets_str;
    }
    public function support_tickets_by_account($user_id, $limit=null) {
        $tickets_array = $this->get_support_tickets_by_account($user_id);
        // <span>October 6, 2022, 2:51 pm </span>
        $tickets_str = "";
        if(count($tickets_array) > 0) {
            $tickets_str .= "<div class='small-12 columns box-content support topless'>
                <div class='row'>
                    <div class='small-11 small-centered columns'>";
        
            foreach($tickets_array as $ticket_array):       
                if($ticket_array['ticket_status'] == 'open') {
                    $ticket_status_str = "<span class='status escalated' style='text-transform: capitalize; color:green'>{$ticket_array['ticket_status']}</span>";
                } else {
                    $ticket_status_str = "<span class='status escalated' style='text-transform: capitalize; color:gray'>{$ticket_array['ticket_status']}</span>";
                }
                $last_reply_date = $this->last_reply_date($ticket_array['ticket_id']);
                $tickets_str .= "<tr class='ticket-row'>
                    <td>
                        <a href='./ticket?id={$ticket_array['ticket_id']}'>#{$ticket_array['ticket_id']} {$ticket_array['ticket_subject']}</a>
                    </td>
                    <td class='elapsed'>
                        <span>$last_reply_date </span>
                    </td>
                    <td class='ticket-status'>
                        $ticket_status_str
                    </td>
                </tr>";  
            endforeach;
            
            $tickets_str .= "</div>
                </div>
            </div>";
        }
       return $tickets_str;
    }
    public function get_ticket_replies($ticket_id, $limit=null) {
        $tickets_array = array();
        if($limit == null) {
            $stmt = $this->con->prepare("SELECT * FROM ticket_replies WHERE support_ticket_id=? ORDER BY ticket_reply_id ASC");
        } else {
            $stmt = $this->con->prepare("SELECT * FROM ticket_replies WHERE support_ticket_id=? ORDER BY ticket_reply_id ASC LIMIT $limit");
        }
        $stmt->bind_param('i', $ticket_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $createdMjYDate = datetime_mjy($row['created_at']);
                    if(!empty($row['updated_at']) && $row['updated_at'] != null) {
                        $updatedMjYDate = datetime_mjy($row['updated_at']);
                    } else {
                        $updatedMjYDate = '';
                    }
                    
                    $ticket_array = array(
                        'ticket_reply_id' => $row['ticket_reply_id'],
                        'reply_type' => $row['reply_type'],
                        'support_ticket_id' => $row['support_ticket_id'],
                        'ticket_by' => $row['ticket_by'],
                        'msg' => $row['msg'],
                        'screenshots' => $row['screenshots'],
                        'created_at' => $row['created_at'],
                        'created_mjy_date' => $createdMjYDate,
                        'created_at_elapsed' => elapsed($row['created_at']),
                        'updated_at' => $row['updated_at'],
                        'updated_mjy_date' => $updatedMjYDate,
                        'updated_at_elapsed' => ($row['updated_at'] != null) ? elapsed($row['updated_at']) : ''
                    );     
                    array_push($tickets_array, $ticket_array);    
                endforeach;
            } 
        }
        return $tickets_array;
    }
    public function ticket_replies($ticket_id, $limit=null) {
        $ticket_replies_array = $this->get_ticket_replies($ticket_id, $limit=null);
        // var_dump($ticket_replies_array);
        $ticket_replies = "<div class='replies'>";
        foreach($ticket_replies_array as $ticket_reply_array):
            // Screenshots
            $screenshots_array = json_decode($ticket_reply_array['screenshots']);
            $screenshots_str = "";
            if(gettype($screenshots_array) == 'array') {
                $screenshots_str .= "<div style='display: flex; flex-flow: row wrap; margin-top: 20px;'>";
                if(count($screenshots_array) > 0) {
                    foreach ($screenshots_array as $screenshot) {
                        $screenshots_str .= "<div style='margin-right: 10px; margin-bottom: 10px;'>
                            <a href='./img/$screenshot'>
                                <img style='width: 80px; height: auto;' src='./img/$screenshot'>
                            </a>
                        </div>";
                    }
                }
                $screenshots_str .= "</div>";
            }

            $msg = nl2br($ticket_reply_array['msg']);


            if($ticket_reply_array['reply_type'] == 'client') {
                $reply_by = $this->support_email($ticket_reply_array['support_id']);
                $divClass = 'clientblock';
                $divClass2 = 'clienttext';
            } else {
                $reply_by = 'Support Operator';
                $divClass = 'supportblock';
                $divClass2 = 'supporttext';
            }
            $ticket_replies .= "<div class='row reply'>
                <div class='columns'>
                    <div class='columns $divClass'>
                        <div class='row'>
                            <div class='columns'>
                                <span class='titletext'>$reply_by</span>
                                <span class='timestamp' title='{$ticket_reply_array['created_mjy_date']}'>{$ticket_reply_array['created_mjy_date']}</span>
                                <hr style='border=top: 1px solid #EEE; margin-bottom: 0.8rem;'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='columns'>
                                <div class='message $divClass2'>
                                    $msg
                                    $screenshots_str
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>";
        endforeach;
        $ticket_replies .= "</div>";
        return $ticket_replies;
    }
    public function get_ticket_reply($ticket_reply_id) {
        $stmt = $this->con->prepare("SELECT * FROM ticket_replies WHERE ticket_reply_id=?");
        $stmt->bind_param('i', $ticket_reply_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $createdMjYDate = datetime_mjy($row['created_at']);
                    if(!empty($row['updated_at']) && $row['updated_at'] != null) {
                        $updatedMjYDate = datetime_mjy($row['updated_at']);
                    } else {
                        $updatedMjYDate = '';
                    }
                    
                    $ticket_array = array(
                        'ticket_reply_id' => $row['ticket_reply_id'],
                        'reply_type' => $row['reply_type'],
                        'support_ticket_id' => $row['support_ticket_id'],
                        'ticket_by' => $row['ticket_by'],
                        'msg' => $row['msg'],
                        'screenshots' => $row['screenshots'],
                        'created_at' => $row['created_at'],
                        'created_mjy_date' => $createdMjYDate,
                        'updated_at' => $row['updated_at'],
                        'updated_mjy_date' => $updatedMjYDate
                    );  
                endforeach;
            } 
        }
        return $ticket_array;
    }
    public function ticket_reply($ticket_reply_id) {
        $ticket_reply_array = $this->get_ticket_reply($ticket_reply_id);
        // var_dump($ticket_reply_array);
        $ticket_replies = "";

        // Screenshots
        $screenshots_array = json_decode($ticket_reply_array['screenshots']);
        $screenshots_str = "";
        if(gettype($screenshots_array) == 'array') {
            $screenshots_str .= "<div style='display: flex; flex-flow: row wrap; margin-top: 20px;'>";
            if(count($screenshots_array) > 0) {
                foreach ($screenshots_array as $screenshot) {
                    $screenshots_str .= "<div style='margin-right: 10px; margin-bottom: 10px;'>
                        <a href='./img/$screenshot'>
                            <img style='width: 80px; height: auto;' src='./img/$screenshot'>
                        </a>
                    </div>";
                }
            }
            $screenshots_str .= "</div>";
        }

        $msg = nl2br($ticket_reply_array['msg']);


        if($ticket_reply_array['reply_type'] == 'client') {
            $reply_by = $this->support_email($ticket_reply_array['support_id']);
            $divClass = 'clientblock';
            $divClass2 = 'clienttext';
        } else {
            $reply_by = 'Support Operator';
            $divClass = 'supportblock';
            $divClass2 = 'supporttext';
        }
        $ticket_replies .= "<div class='row reply'>
            <div class='columns'>
                <div class='columns $divClass'>
                    <div class='row'>
                        <div class='columns'>
                            <span class='titletext'>$reply_by</span>
                            <span class='timestamp' title='{$ticket_reply_array['created_mjy_date']}'>{$ticket_reply_array['created_mjy_date']}</span>
                            <hr style='border=top: 1px solid #EEE; margin-bottom: 0.8rem;'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='columns'>
                            <div class='message $divClass2'>
                                $msg
                                $screenshots_str
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>";
        
        return $ticket_replies;
    }
    public function ticket_replies_admin($ticket_id, $limit=null) {
        $ticket_replies_array = $this->get_ticket_replies($ticket_id, $limit=null);
        // var_dump($ticket_replies_array);
        $ticket_replies = "";
        foreach($ticket_replies_array as $ticket_reply_array):
            // Screenshots
            $screenshots_array = json_decode($ticket_reply_array['screenshots']);
            $screenshots_str = "";
            if(gettype($screenshots_array) == 'array') {
                $screenshots_str .= "<div style='display: flex; flex-flow: row wrap; margin-top: 20px;'>";
                if(count($screenshots_array) > 0) {
                    foreach ($screenshots_array as $screenshot) {
                        $screenshots_str .= "<div style='margin-right: 10px; margin-bottom: 10px;'>
                            <a target='_blank' href='../img/$screenshot'>
                                <img style='width: 80px; height: auto;' src='../img/$screenshot'>
                            </a>
                        </div>";
                    }
                }
                $screenshots_str .= "</div>";
            }


            if($ticket_reply_array['reply_type'] == 'member') {
                $reply_by = $this->support_email($ticket_reply_array['support_id']);
                $divClass = 'clientblock';
                $divClass2 = 'clienttext';
            } else {
                $reply_by = 'Support Operator';
                $divClass = 'supportblock';
                $divClass2 = 'supporttext';
            }
            $ticket_replies .= "
            <div class='support'>
                <div class='row reply'>
                    <div class='columns'>
                        <div class='small-11 columns $divClass'>
                            <div class='row'>
                                <div class='small-12 columns'>
                                    <span class='titletext'>$reply_by</span>
                                    <span class='timestamp' title='{$ticket_reply_array['created_mjy_date']}'>{$ticket_reply_array['created_mjy_date']}</span>
                                    <hr style='border=top: 1px solid #EEE; margin-bottom: 0.8rem;'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='small-12 columns'>
                                    <div class='message $divClass2'>
                                        {$ticket_reply_array['msg']}
                                        $screenshots_str
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>";
        endforeach;
        return $ticket_replies;
    }
    public function create_ticket_form($support_id) {
        return "
        <div class='small-11 small-centered columns'>
            <div class='form-header'>
                <h2 style='margin-bottom: 20px;' class=''>Create Support Ticket</h2>
                <p>You may submit a support ticket by filling out the fields below.  Please do not submit multiple tickets for the same inquiry, but please feel free to submit additional replies onto an open ticket.</p>
                <p>Please be thoroughly descriptive with your inquiry so that we may assist you as rapidly as possible. Include any applicable data with your request.</p>
            </div>
            <form autocomplete='off' id='reply_form' class='custom'>
                <input type='hidden' name='create_ticket' id='create_ticket' value='true'>

                <div class='row collapse but-pad'>
                    <div class='small-12 columns'>
                        <input type='text' name='ticket_subject' value='' placeholder='Brief ticket subject.' id='ticket_subject' class='small-12'>
                    </div>
                </div>

                <div style='margin-bottom: 20px;' class='row collapse but-pad'>
                    <div class='small-12 columns'>
                        <textarea placeholder='Enter a message here for our support staff.' class='animated message large' name='msg' id='msg' style='min-height: 200px; overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 300px;'></textarea>
                    </div>
                </div>
                
                <div class='btns-wrapper' style='margin-bottom: 20px;'>
                    <div style='display: grid; grid-template-columns: repeat(2, auto); justify-content: flex-start;'>
                        <span onclick='create_ticket(event)' style='margin-right: 10px;' class='btn accept' id='message-reply-submit'>Submit Ticket</span>
                        <input type='BUTTON' class='btn reject' value='Add screenshot' id='pickWatermark' onclick='pickMark()'>
                        <input title='Screenshots' class='input' id='files' type='file' name='files[]' value='' style='display: none;' multiple='multiple'>
                    </div>

                    <div class=''>
                        <a href='./support' class='btn reject' style='text-decoration: none;'>Back</a>
                    </div>
                </div>

                <div class='message-response' id='message-response-1'></div>
                
            </form>
        </div>";
        // onclick='return create_faq(event)'
    }

    public function create_report_form($ad_id) {
        $reported_by = get_uid();

        return "
        <div class='small-centered columns'>
            <div class='form-header'>
                <h2 style='margin-bottom: 10px;' class=''>Report ad</h2>
                <p>Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports</p>
            </div>
            <form autocomplete='off' id='reply_form' class='custom' method='POST' action='./controllers/support-handler' style='margin-bottom: 0px;' enctype='multipart/form-data'>
                <input type='hidden' name='create_report' id='create_report' value='true'>
                <input type='hidden' name='reported_ad_id' id='reported_ad_id' value='$ad_id'>
                <input type='hidden' name='reported_by' id='reported_by' value='$reported_by'>

                <div class='row collapse but-pad'>
                    <div class='small-12 columns'>
                        <textarea placeholder='Enter a message here for our support staff.' class='animated message large' name='msg' id='msg' style='min-height: 200px; overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 300px;'></textarea>
                    </div>
                </div>
                <div class='row'>
                    <div class='btns-wrapper'>
                        <a style='color: #fff; margin-bottom: 0px;' onclick='report(event)' class='btn contact-btn'>Report</a>
                    </div>
                </div>
                <div class='message-response' id='message-response-1'></div>
            </form>
        </div>";
        // onclick='return create_faq(event)'
    }
    public function reply_form($support_ticket_id, $support_id, $reply_type='client') {
        $ticket_status = $this->get_ticket_status($support_ticket_id);
        if($ticket_status != 'closed') {
            return "<form autocomplete='off' id='reply_form' class='custom' method='POST' action='./controllers/support-handler' style='margin-bottom: 0px;' enctype='multipart/form-data'>  
                <div style='display:none'>
                </div>
                <input type='hidden' name='create_reply' id='create_reply' value='true'>
                <input type='hidden' name='reply_origin' id='reply_origin' value='user'>
                <input type='hidden' name='support_ticket_id' id='support_ticket_id' value='$support_ticket_id'>
                <div class='row'>
                    <div class='columns'>
                        <textarea placeholder='Enter a message here to reply.' class='animated message' name='msg' id='msg' style='min-height: 250px; overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 250px;' name='message' id='message'></textarea>
                    </div>
                </div>

                <div class='columns btns-wrapper' style='margin-bottom: 20px;'>
                    <div style='display: grid; grid-template-columns: repeat(2, auto); justify-content: flex-start;'>
                        <span onclick='create_ticket_reply(event)' style='margin-right: 10px;' class='btn accept' id='message-reply-submit'>Send Reply</span>
                        <input type='BUTTON' class='btn reject' value='Add screenshot' id='pickWatermark' onclick='pickMark()'>
                        <input title='Screenshots' class='input' id='files' type='file' name='files[]' value='' style='display: none;' multiple='multiple'>
                    </div>
                    <div class=''>
                        <a href='./controllers/support-handler?ticket_id=$support_ticket_id&closed=true&org=client' class='btn reject' style='text-decoration: none;'>Close Ticket</a>
                    </div>
                </div>
            </form>";
        } else {
            return;
        }
    }
    public function reply_form_admin($support_ticket_id, $support_id, $reply_type='support') {
        $ticket_status = $this->get_ticket_status($support_ticket_id);
        if($ticket_status != 'closed') {
            return "<form autocomplete='off' id='reply_form' class='custom' method='POST' action='../controllers/support-handler' style='margin-bottom: 0px;' enctype='multipart/form-data'>  
                <div style='display:none'>
                </div>
                <input type='hidden' name='create_reply' id='create_reply' value='true'>
                <input type='hidden' name='reply_origin' id='reply_origin' value='admin'>
                <input type='hidden' name='support_ticket_id' id='support_ticket_id' value='$support_ticket_id'>

                <div class='row'>
                    <div class='small-12 columns'>
                        <textarea placeholder='Enter a message here to reply.' class='animated message' name='msg' id='msg' style='min-height: 250px; overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 250px;' name='message' id='message'></textarea>
                    </div>
                </div>
                <div class='row follow' id='message-reply-submit'>
                    <div class='small-6 columns' style='padding-top: 7px;'>
                        <input type='submit' name='reply' value='Send Reply' class='small imp button'>       
                        <input type='BUTTON' class='small imp button' value='Add screenshot' id='pickWatermark' onclick='pickMark()'>
                        <input class='input' id='files' type='file' name='files[]' value='' style='display: none;' multiple='multiple'>
                    </div>
                    <div class='small-6 columns text-right' style='padding-top: 7px;'>
                        <a href='../controllers/support-handler?ticket_id=$support_ticket_id&closed=true&org=support' class='small imp alert button close-btn' style='text-decoration: none;'>Close Ticket</a>
                    </div>
                </div>
            </form>";
        } else {
            return;
        }
    }
    // <form name='close' action='./controllers/support-handler?ticket_id=$support_ticket_id&closed=true' method='get' accept-charset='utf-8' id='tc-form' class='custom'>
    //     <div style='display:none'>
    //         <input type='hidden' name='id' value='830002'>
    //     </div>

    //     <div class='small-6 columns text-right' style='padding-top: 7px;'>
    //         <input type='submit' id='do_close' value='Close Ticket' class='small imp alert button' onclick='close_ticket(event)'>
    //     </div>
    // </form>

    private function add_screenshots($n) {
        // $img = $_FILES['image']['name'];
        $screenshots_array = array();
        $images = $_FILES[$n]['name'];
        $total_count = count($_FILES[$n]['name']);
        // CHECK IF INPUT IS EMPTY

        for( $i=0 ; $i < $total_count ; $i++ ) {
            $allowed = array('png', 'jpg', 'jpeg', 'webp');
            $ext = pathinfo($images[$i], PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                $staus = '2';
                exit();
            } else {
                $imagePath = '../img/';
                
                $uniquesavename = microtime(TRUE);
                $destFile = $imagePath . $uniquesavename . '.'.$ext;
                $tempname = $_FILES['files']['tmp_name'][$i];
                move_uploaded_file($tempname,  $destFile);
                $img = $uniquesavename . '.'.$ext;
            }
            array_push($screenshots_array, $img);
        }
        $screenshots = json_encode($screenshots_array, true);
        return $screenshots;
    }

    public function editForm($id) {
        $project_array = $this->get_project($id);
        if($project_array['project_status'] == 'Done') {
            $statusOptions = "<option>Cancelled</option>
            <option>In progress</option>";
        } elseif ($project_array['project_status'] == 'Cancelled') {
            $statusOptions = "<option>Done</option>
            <option>In progress</option>";
        } elseif ($project_array['project_status'] == 'In progress') {
            $statusOptions = "<option>Done</option>
            <option>Cancelled</option>";
        }
        return "<form autocomplete='off' id='project_form' class='project_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='update_project' id='update_project' value='true'>
            <input type='hidden' name='project_id' id='project_id' value='{$project_array['id']}'>
            <div class='mb-3'>
                <label class='form-label'>Name</label>
                <input name='project_name' id='project_name' type='text' class='form-control' placeholder='Name' value='{$project_array['project_name']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Start Date</label>
                <input class='form-control' type='text' name='start_date' id='start_date' placeholder='Start Date' value='{$project_array['sdate']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>End Date</label>
                <input class='form-control' type='text' name='end_date' id='end_date' placeholder='End Date' value='{$project_array['edate']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Status</label>
                <select class='form-control' name='status' id='project_status'>
                    <option selected=''>{$project_array['project_status']}</option>
                    $statusOptions
                </select>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Assignee</label>
                <input name='assignee' id='assignee' type='text' class='form-control' placeholder='Assignee' value='{$project_array['assignee']}'>
            </div>
            <span onclick='return update_project(event)' type='submit' class='btn btn-primary'>Submit</span>
            <a onclick='return pop(this)' href='../controllers/project-handler?del_project={$project_array['id']}' class='btn btn-danger'>Delete</a>
        </form>";
    }

    public function update($id) {  
        $project_name = $_POST['project_name'];

        $sdate = $_POST['start_date'];
        $edate = $_POST['end_date'];
        $project_status = $_POST['project_status'];
        $assignee = $_POST['assignee'];

        // var_dump($project_name, $sdate, $edate, $project_status, $assignee);
        
        $stmt = $this->con->prepare("UPDATE projects SET project_name=?, sdate=?, edate=?, project_status=?, assignee=? WHERE id=?");
        $stmt->bind_param('sssssi', $project_name, $sdate, $edate, $project_status, $assignee, $id);
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
    // public function change_ticket_status($ticket_id, $ticket_status) {
    //     $stmt = $this->con->prepare("UPDATE support_tickets SET ticket_status=? WHERE ticket_id=?");
    //     $stmt->bind_param('si', $ticket_status, $ticket_id);
    //     if($stmt->execute()) {
    //         $status = '1';
    //         header('location: ../ticket?id='.$ticket_id);
    //     } else {
    //         $status = '0';
    //         die('prepare() failed: ' . htmlspecialchars($this->con->error));
    //         die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    //         die('execute() failed: ' . htmlspecialchars($stmt->error));
    //     }
    //     $stmt->close();
    //     echo $status;
    // }
    public function close_ticket($ticket_id, $origin) {
        $ticket_status = 'closed';
        $stmt = $this->con->prepare("UPDATE support_tickets SET ticket_status=? WHERE ticket_id=?");
        $stmt->bind_param('si', $ticket_status, $ticket_id);
        if($stmt->execute()) {
            $status = '1';
            if($origin == 'client') {
                header('location: ../ticket?id='.$ticket_id);
            } else if($origin == 'support') {
                header('location: ../admin/ticket?id='.$ticket_id);
            } else if($origin == 'admin-tickets') {
                header('location: ../admin/tickets');
            } else if($origin == 'admin-tickets-open') {
                header('location: ../admin/tickets-open');
            } else if($origin == 'admin-tickets-closed') {
                header('location: ../admin/tickets-closed');
            }
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        if($origin == 'client') {
            header('location: ../ticket?id='.$ticket_id);
        } else if($origin == 'support') {
            header('location: ../admin/ticket?id='.$ticket_id);
        } else if($origin == 'admin-tickets') {
            header('location: ../admin/tickets');
        } else if($origin == 'admin-tickets-open') {
            header('location: ../admin/tickets-open');
        } else if($origin == 'admin-tickets-closed') {
            header('location: ../admin/tickets-closed');
        }
        // echo $status;
    }
    public function open_ticket($ticket_id, $origin) {
        $ticket_status = 'open';
        $stmt = $this->con->prepare("UPDATE support_tickets SET ticket_status=? WHERE ticket_id=?");
        $stmt->bind_param('si', $ticket_status, $ticket_id);
        if($stmt->execute()) {
            $status = '1';
            if($origin == 'admin-tickets') {
                header('location: ../admin/tickets');
            } else if($origin == 'admin-tickets-open') {
                header('location: ../admin/tickets-open');
            } else if($origin == 'admin-tickets-closed') {
                header('location: ../admin/tickets-closed');
            }
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        if($origin == 'admin-tickets') {
            header('location: ../admin/tickets');
        } else if($origin == 'admin-tickets-open') {
            header('location: ../admin/tickets-open');
        } else if($origin == 'admin-tickets-closed') {
            header('location: ../admin/tickets-closed');
        }
        // echo $status;
    }
    // public function delete($id) {
    //     $stmt = $this->con->prepare("DELETE FROM projects WHERE id=?");
    //     $stmt->bind_param('i', $id);
    //     if($stmt->execute()) {
    //         $status = '1';
    //     } else {
    //         $status = '0';
    //     }
    //     $stmt->close();
    //     // return $status;
    //     header('location: ../admin/projects');
    // }
}