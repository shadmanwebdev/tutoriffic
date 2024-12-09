<?php
    $type = $_GET['type'];
    $id = $_GET['id'];
?>

<div id='bookingPopupInner'>   
    <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
    <input type="hidden" name='del_id' id='del_id' value='<?= $id; ?>'>
    <div id='cross' onclick='closePopup()'>
        <i class='icon-close2'></i>
    </div>
    <div>
        <div id="popup-heading">
            Are you sure you'd like to delete this item? 
        </div>
        <div id='btnLockedOuterWrapper'>
            <span class='del-popup-btn' id="close-btn" onclick='closePopup()'>No</span>
            <span class='del-popup-btn' id="confirm-btn" onclick='confirm_delete()'>Yes</span>
        </div>

        <div class='message-response' id='message-response-1'></div>
    </div>
</div>