<?php

// use App\Interfaces\DataOperations;

// class Faq extends Db implements DataOperations {
class Faq extends Db {
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
    public function createForm() {
        echo "<form autocomplete='off' id='faq_form' class ='faq_form' method='POST'>                 
            <h4 class='form-title'>New FAQ</h4>                      
            <input type='hidden' name='create_faq' id='create_faq' value='true'>
            <div class ='mb-3' id='question-wrapper'>
                <label class ='form-label' for='title'>Question</label>
                <input type='text' name='question' id='question' class ='form-control' placeholder='Question' value=''>
                <div id='question-error' class='error'></div>
            </div>
            <div class ='mb-3' id='answer-wrapper'>
                <label for='answer' class ='form-label'>Answer</label>
                <textarea name='answer' id='answer' class='form-control' rows='4' placeholder='Answer'></textarea>
                <div id='answer-error' class='error'></div>
            </div> 
            <div>
                <span style='margin-top: 10px;' onclick='return create_faq(event)' type='submit' class ='btn btn-primary'>Submit</span>  
            </div>
            <div class='message-response' id='message-response-1'></div>  
        </form>";
    }
    public function editForm($id) {
        $faq_array = $this->get_faq($id);
        echo "<form autocomplete='off' id='faq_form' class ='faq_form' method='POST'>                 
            <h4 class='form-title'>Edit FAQ</h4>                      
            <input type='hidden' name='update_faq' id='update_faq' value='true'>
            <input type='hidden' name='faq_id' id='faq_id' value='{$faq_array['id']}'>
            <div class ='mb-3' id='question-wrapper'>
                <label class ='form-label' for='title'>Question</label>
                <input type='text' name='question' id='question' class ='form-control' placeholder='Question' value='{$faq_array['question']}'>
                <div id='question-error' class='error'></div>
            </div>
            <div class ='mb-3' id='answer-wrapper'>
                <label for='answer' class ='form-label'>Answer</label>
                <textarea name='answer' id='answer' class='form-control' rows='4' placeholder='Answer'>{$faq_array['answer']}</textarea>
                <div id='answer-error' class='error'></div>
            </div> 
            <div>
                <span style='margin-top: 10px;' onclick='return update_faq(event)' type='submit' class ='btn btn-primary'>Submit</span>  
            </div>
            <div class='message-response' id='message-response-1'></div>  
        </form>";
    }
    public function create() {  
        $q = $_POST['question'];
        $a = $_POST['answer'];
        
        $stmt = $this->con->prepare("INSERT INTO faqs(question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $q, $a);
        
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
    public function update($id) {
        $q = $_POST['question'];
        $a = $_POST['answer'];
        
        $stmt = $this->con->prepare("UPDATE faqs SET question=?, answer=? WHERE id=?");
        $stmt->bind_param('ssi', $q, $a, $id);
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
    public function get_faq($id) {
        $stmt = $this->con->prepare("SELECT * FROM faqs WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $faq_array = array(
                        'id' => $row['id'],
                        'question' => $row['question'],
                        'answer' => $row['answer']
                    );        
                endforeach;
            } 
        }
        $stmt->close();
        return $faq_array;
    }
    public function get_faqs() {
        $faqs_array = array();
        $stmt = $this->con->prepare("SELECT * FROM faqs ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $faq_array = array(
                        'id' => $row['id'],
                        'question' => $row['question'],
                        'answer' => $row['answer']
                    );
                    array_push($faqs_array, $faq_array);          
                endforeach;
            } 
        }
        $stmt->close();
        return $faqs_array;
    }
    public function faqs() {
        $faqs_array = $this->get_faqs();
        $faqs = "";
        $n = 0;
        foreach($faqs_array as $faq_array):

            $expanded = ($n==0) ? 'true' : 'false';
            $collapsed = ($n==0) ? '' : 'collapsed';
            $collapse = ($n==0) ? 'collapse show' : 'collapse';

            $faqs .= "<div class='accordion-item mb-1-2'>
                <h2 class='accordion-header' id='heading1'>
                    <button class='accordion-button $collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse{$faq_array['id']}' aria-expanded='$expanded' aria-controls='collapse{$faq_array['id']}'><span>{$faq_array['question']}</span></button>
                </h2>
                <div class='accordion-collapse $collapse' id='collapse{$faq_array['id']}' aria-labelledby='heading{$faq_array['id']}' data-bs-parent='#accordionExample'>
                    <div class='accordion-body bg-100'>{$faq_array['answer']}</div>
                </div>
            </div>";

            $n += 1;

        endforeach;
        echo $faqs;
    }
    public function faqs_admin() {
        $faqs_array = $this->get_faqs();
        $faqs = "";
        foreach($faqs_array as $faq_array):
            $ans_summary = segment($faq_array['answer'], 40);
            $ques_summary = segment($faq_array['question'], 15);
            $faqs .= "<tr class='clickable-row' data-href='./post-edit?id={$faq_array['id']}' style='cursor:pointer;'>
                <td>
                    $ques_summary
                </td>
                <td>
                    $ans_summary
                </td>
                <td class ='table-action'>
                    <a href='./edit-faq?id={$faq_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class ='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                    <a onclick='return pop(this)' href='../controllers/faq-handler?del_faq={$faq_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class ='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                </td>
            </tr>";
        endforeach;
        echo $faqs;
    }
    public function delete($id) {
        $stmt = $this->con->prepare("DELETE FROM faqs WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/faqs');
    }
}