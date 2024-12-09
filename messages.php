<?php
    include './partials/header.php';
?>
<link rel="stylesheet" href="css/message.css?v=42">

<?php include './partials/nav-2.php'; ?>


<?php
    include './template-parts/account-navigation.php';
?>




<!-- POPUP WRAPPER -->
<div id='popup-wrapper'></div>

<!-- Select Ads Pop Up -->
<div id='select-ads-popup-wrapper'></div>

<style>
    .card {
        max-width: 1200px;
    }
    .message {
        max-width: 700px;
        margin: 50px auto;
    }
    .message .msg-content p {
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: break-word;
        -webkit-hyphens: auto;
        hyphens: auto;
        position: relative;
        font-weight: 500;
        font-size: 14px;
        line-height: 24px;
    }
    .images-wrapper {
        width: 100%;
        display: flex;
        flex-flow: row wrap;
    }
    .img-wrapper {
        margin-right: 10px;
        margin-bottom: 10px;
        width: 80px;
        height: 80px;
        overflow: hidden;
    }
    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .msg-main {
        background-color: #fff;
    }
    .msg-header {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        padding: 15px 20px;
    }
    .msg-content {
        padding: 0px 20px 15px 20px;
    }
    .msg-footer {
        padding:  0px 20px 15px 20px;
    }
    .msg-header .msg-details > div:not(div:last-child),
    .msg-header .msg-datetime > div:not(div:last-child) {
        margin-bottom: 5px;
    }
    .msg-media-wrapper {
        padding:  0px 20px 15px 20px;
    }
</style>

<style>

    .header-demands h1 {
        font-size: 20px;
        font-weight: 700;
        color: #222;
        margin: 0;
    }
    .one-demand:last-child {
        border-bottom: 2px solid #f7f7f7;
    }
    .one-demand {
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        padding: 35px;
        position: relative;
        /* border-top: 2px solid #f7f7f7; */
        border: 1px solid #cdcdcd;
        font-size: 13px;
        font-weight: 400;
        color: #999;
        line-height: 1.54;
        white-space: nowrap;
        cursor: pointer;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    .one-demand-inner {
        display: flex;
        flex-flow: row nowrap;
        align-items: start;
    }
    .one-demand .infos-container {
        height: 100%;
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        align-items: start;
        vertical-align: middle;
        position: relative;

    }
    .avatar {
        display: block;
        min-width: 50px;
        min-height: 50px;
        max-width: 50px;
        max-height: 50px;
        background-color: #d7d7d7;
        border-radius: 100%;
        overflow: hidden;
        margin-right: 20px;
    }
    .avatar img {
        width: 100%;
        height: 100%;
    }
    .one-demand .infos-container>* {
        vertical-align: middle;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    .one-demand .firstname {
        font-size: 16px;
        font-weight: 500;
        color: #222;
        margin: 0;
        line-height: 1.5;
    }
    .one-demand p {
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
    }
</style>

<style>
    .request-details {
        font-weight: 400;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 5px;
    }
    .request-details .label {
        color: #222;
    }
    .subjects-wrapper {
        margin: 10px 0;
    }
    .subject-label {
        color: #222;
    }
    .subjects {
        margin: 0;
    }
    .expectation {
        margin: 10px 0;
        text-wrap: wrap;
    }
    .datetime {
        display: flex;
        flex-flow: row nowrap;
        align-items: start;
    }
    .datetime .date {
        margin-right: 10px;
    }
    .booking-btns {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: start;
        margin-top: 30px;
    }
    .booking-btns button:not(button:last-child){
        
    }
    .btn {
        border-radius: 30px;
        padding: 7px 20px;
        transition: .3s;
        font-size: 14px;
    }
    .btn.accept {
        background: rgb(51 155 88);
        color: #fff;
        border: 1px solid rgb(51 155 88);
    }
    .btn.reject {
        background: rgb(223 223 223);
        color: #000000;
        border: 1px solid rgb(223 223 223);
    }
    .btn.modify {
        background: rgb(129 129 129);
        color: #ffffff;
        border: 1px solid rgb(129 129 129);
        margin-right: 5px;
    }
</style>


<style>
    .fn {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        margin-left: 10px;
    }
    .btn.schedule {
        font-size: 12px;
        background: rgb(51 155 88);
        color: #fff;
        border: 1px solid rgb(51 155 88);
    }
</style>

<style>
    .select-ads-wrapper {   
        margin-top: 30px;
        margin-bottom: 0px;
    }
    .radios {
        display: flex;
        flex-flow: column nowrap;
    }
    .radio-option:first-child {
        margin-right: 20px;
    }
    .radio-input-group {
        display: flex;
        flex-flow: row nowrap;
    }
    .radio-input-inner {
        margin-right: 5px;
    }
    .radio-input-inner + div {
        margin-top: -2px;
    }
    /* Style for the radio inputs */
    input[type="radio"] {
        display: none; /* Hide the default radio input */
    }

    /* Style for the radio label */
    .radio-label {
        display: inline-block;
        width: 20px;
        height: 20px;
        padding: 2px; /* Adjust the padding to add spacing */
        border: 2px solid #ccc;
        color: rgb(255, 145, 77);
        cursor: pointer;
        border-radius: 50%;
        position: relative; /* Add this line */
    }

    /* Style for the selected radio label */
    .radio-label.selected {
        background-color: white;
        color: white;
        border: 2px solid rgb(255, 145, 77);
    }
    /* Style for the inner circle of the selected radio label */
    .radio-label.selected::before {
        content: "";
        display: block;
        width: 10px;
        height: 10px;
        background-color: rgb(255, 145, 77);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 1;
    }
</style>

<?php
    $currentUserId = get_uid(); 
    $msg = new Message;
    $msg->display_user_list('msg_id', 'ASC', $currentUserId, null);
?>


<script src="./js/message.js?v=35" defer></script>

<script defer>
    function userRow() {
        const userRows = document.querySelectorAll('.user-row');
        const messageContainer = document.querySelector('.msgbox-body-inner');
        const msgOuter = document.querySelector('.msgbox-body-outer'); // Get the .msg-outer element

        const to_id = document.getElementById('to_id');

        userRows.forEach(userRow => {
            userRow.addEventListener('click', () => {
                const selectedUserId = userRow.getAttribute('data-userid');

                // Make an AJAX call to fetch messages for the selected user
                fetch(`./user-msg?user=${selectedUserId}`)
                    .then(response => response.text())
                    .then(messageHtml => {
                        // Replace the message container's content with the fetched messages
                        messageContainer.innerHTML = messageHtml;

                        // Scroll to the bottom of the .msg-outer element
                        msgOuter.scrollTop = msgOuter.scrollHeight;

                        // Add id of selected user to the form input
                        to_id.value = selectedUserId;


                        $('.timer').each(function () {
                            // Get the id, data-duration, and data-created attributes
                            const timerId = $(this).attr('id');
                            const duration = $(this).data('duration');
                            const created = $(this).data('created');
                            console.log(timerId, duration, created);    
                            // Run your JavaScript code for each element
                            updateTimer(timerId, created, convertTimeToCountdown(duration));
                        });
                        
                    })
                    .catch(error => console.error('Error fetching messages:', error));
            });
        });
    }

    userRow();


    $(document).ready(function() {
        if(window.innerWidth < 768) {
            $('.user-list').on('click', function() {
                // Move user-list to the left (hidden) and show msgbox
                $('.user-list').css('transform', 'translateX(-100%)');
                $('.msgbox').css('transform', 'translateX(-100%)');
            });
    
            $('#resetButton').on('click', function() {
                // Reset the positions to their original state
                $('.user-list').css('transform', 'translateX(0)');
                $('.msgbox').css('transform', 'translateX(100%)');
            });
        }
    });

</script>




</body>
</html>