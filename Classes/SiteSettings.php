<?php
/*
    show_user_profile()
*/

class SiteSettings extends Db {
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
    public function sitename() {
        $site_settings = $this->site_settings();
        $sitename = $site_settings['sitename'];
        return $sitename;
    }
    public function title_tag() {
        $site_settings = $this->site_settings();
        $title_tag = $site_settings['title_tag'];
        return $title_tag;
    }
    public function meta_description() {
        $site_settings = $this->site_settings();
        $meta_description = $site_settings['meta_description'];
        return $meta_description;
    }
    public function copyright_text() {
        $site_settings = $this->site_settings();
        $copyright_text = $site_settings['copyright_text'];
        return $copyright_text;
    }
    public function contact() {
        $site_settings = $this->site_settings();
        $contact = $site_settings['contact'];
        return $contact;
    }
    public function updateForm() {
        $site_settings = $this->site_settings();
        return "
        <form autocomplete='off' id='demo_form' class ='demo_form' method='POST'>    
            <h4 class='form-title'>Site Settings</h4>                       
            <input type='hidden' name='update_site_settings' id='update_site_settings' value='true'>
            <div class ='mb-3'>
                <label class ='form-label' for='title'>Site Name: </label>
                <input type='text' name='sitename' id='sitename' class ='form-control' placeholder='Site Name' value='{$site_settings['sitename']}'>
            </div>
            <div class ='mb-3'>
                <label for='tags' class ='form-label'>Title Tag: </label>
                <input type='text' name='title_tag' id='title_tag' class ='form-control' placeholder='Title Tag' value='{$site_settings['title_tag']}'>
            </div>
            <div class ='mb-3'>
                <label for='tags' class ='form-label'>Meta Description: </label>
                <input type='text' name='meta_description' id='meta_description' class ='form-control' placeholder='Meta Description' value='{$site_settings['meta_description']}'>
            </div>
            <div class ='mb-3'>
                <label for='tags' class ='form-label'>Copyright Text: </label>
                <input type='text' name='copyright_text' id='copyright_text' class ='form-control' placeholder='Copyright Text' value='{$site_settings['copyright_text']}'>
            </div> 
            <div class ='mb-3'>
                <label for='contact' class ='form-label'>Copyright Text: </label>
                <input type='text' name='contact' id='contact' class ='form-control' placeholder='Copyright Text' value='{$site_settings['contact']}'>
            </div> 
            <div>
                <span style='margin-top: 10px;' onclick='return update_site_settings(event)' type='submit' class ='btn btn-primary'>Submit</span>  
            </div>
            <div id='msg-response'></div>
        </form>";
    }

    public function site_settings() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM site_settings WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach ($data as $row):
                    $site_settings = array (
                        'sitename' => $row['sitename'],
                        'title_tag' => $row['title_tag'],
                        'meta_description' => $row['meta_description'],
                        'copyright_text' => $row['copyright_text'],
                        'contact' => $row['contact']
                    );
                endforeach;
            }
        }
        return $site_settings;
    }
    public function update() {
        $id = 1;

        $sitename = $_POST['sitename'];
        $title_tag = $_POST['title_tag'];
        $meta_description = $_POST['meta_description'];
        $copyright_text = $_POST['copyright_text'];
        $contact = $_POST['contact'];

        
        $stmt = $this->con->prepare("UPDATE site_settings SET sitename=?, title_tag=?, meta_description=?, copyright_text=?, contact=? WHERE id=?");
        $stmt->bind_param('sssssi', $sitename, $title_tag, $meta_description, $copyright_text, $contact, $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
}