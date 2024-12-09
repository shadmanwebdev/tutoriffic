<?php
    include './partials/header.php';
?>
<link rel="stylesheet" href="css/message.css?v=33">

<?php include './partials/nav-2.php'; ?>


<?php
    include './template-parts/account-navigation.php';
?>


<!-- POPUP WRAPPER -->
<div id='popup-wrapper'></div>




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


<?php
    $currentUserId = get_uid(); 
    $msg = new Message;
    $msg->display_user_list('msg_id', 'ASC', $currentUserId, null);
?>


<script src="./js/message.js?v=33" defer></script>

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