<?php
    include './partials/header.php';
?>
<?php include './partials/nav-2.php'; ?>

<!-- 
    Check if user is logged in
    if not  take to the login page
    else show this page
-->


<style>
    .ticket-wrapper {
        margin: 50px auto;
        max-width: 1000px;
    }
    .row {
        width: 100%;
        margin: 0 auto;
    }
    .box-content {
        background-color: #FFFFFF;
        border: 1px solid #ddd;
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        padding-bottom: 25px;
    }
    .column.small-centered, .columns.small-centered {
        position: relative;
        margin-left: auto;
        margin-right: auto;
        float: none !important;
    }
    .column, .columns {
        width: 100%;
        position: relative;
        padding-left: 0.9375rem;
        padding-right: 0.9375rem;
        float: left;
    }
    [class*="column"] + [class*="column"]:last-child {
        float: right;
    }
    .box-content h2 {
        color: #222222;
        font-size: 20px;
        font-weight: 300;
        margin: 0.84em 0 0 0;
    }
    .box-content h3 {
        font-size: 20px;
        font-weight: 300;
        margin: 0 0 0.25em 0;
    }
    .supporth3 {
        color: #666;
        font-size: 18px;
        font-style: normal;
        font-weight: 200;
        line-height: 1.2em;
        margin-bottom: 1rem !important;
        margin-top: 0.4em !important;
        text-rendering: optimizeLegibility;
    }
    .clientblock {
        background: #FDFDFD;
        border-radius: 5px;
        display: block;
        float: right;
        height: auto;
        margin-bottom: 30px;
        border: 1px solid #E4E4E4;
        width: 95%;
        float: right;
    }
    .supportblock {
        border: 1px solid #E4E4E4;
        background: #FDFDFD;
        border-radius: 5px;
        display: block;
        float: left;
        height: auto;
        margin-bottom: 30px;
        width: 95%;
        float: left;
    }
    .support .reply .message {
        color: rgb(60, 60, 60);
        font-size: 16px;
        line-height: 22px;
        word-wrap: break-word;
        width: 100%;
        padding-bottom: 20px;
    }
    .titletext {
        cursor: default;
        float: left;
        font-weight: 300;
        padding: 10px 0 10px 0;
        color: #777;
    }
    .timestamp {
        cursor: default;
        float: right;
        font-weight: 300;
        padding: 10px 0 10px 0;
        color: #777;
    }
    .clientblock hr, .supportblock hr {
        margin-top: 5px;
    }
    hr {
        border: solid #dddddd;
        border-width: 1px 0 0;
        clear: both;
        margin: 1.25rem 0 1.1875rem;
        height: 0;
    }
    textarea {
        -webkit-appearance: none;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-color: white;
        font-family: inherit;
        border: 1px solid #cccccc;
        -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        color: rgba(0, 0, 0, 0.75);
        display: block;
        font-size: 0.875rem;
        margin: 0 0 1rem 0;
        padding: 0.5rem;
        height: 2.3125rem;
        width: 100%;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: -webkit-box-shadow 0.45s, border-color 0.45s ease-in-out;
        -moz-transition: -moz-box-shadow 0.45s, border-color 0.45s ease-in-out;
        transition: box-shadow 0.45s, border-color 0.45s ease-in-out;

        min-height: 250px;
        overflow: hidden;
        overflow-wrap: break-word;
        resize: horizontal;
        height: 250px;
        color: rgb(60, 60, 60);
        font-size: 14px;
        font-weight: 300;
        line-height: 22px;
        padding: 0.5em 0.625em 0.625em;
    }
    
    @media (max-width: 768px) {
        .box-content h2 {
            margin: 0.84em 0 0 0;
        }
        .column, .columns {
            width: 100%;
            padding-left: 0.3375rem;
            padding-right: 0.3375rem;
            display: flex;
            flex-direction: column;
        }
        .titletext {
            padding: 10px 0 2px 0;
        }
        .timestamp {
            padding: 2px 0 10px 0;
        }
    }
</style>


<style>
    .ticket-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .btns-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .btn {
        border-radius: 30px;
        padding: 7px 20px;
        transition: .3s;
        font-size: 14px;
        transition: .3s;
        /* display: flex;
        align-items: center; */
    }
    .btn:hover {
        opacity: .8;
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
</style>


<div class='page-wrapper'>


<div class='ticket-wrapper'>
    <div class="row">
        <div class="columns box-content support topless">

                    <?php
                        $support = new Support;
                        echo $support->support_ticket($_GET['id']);
                        echo $support->ticket_replies($_GET['id']);
                    ?>
                    <?php 
                        $support_ticket_id = $_GET['id'];
                        $support_id = get_uid();
                        echo $support->reply_form($support_ticket_id, $support_id);
                    ?>
                    <div class="row">
                        <div class="columns">
                        </div>
                    </div>

        </div>

    </div>
</div>






<script defer>
    function create_ticket_reply(event) {
        event.preventDefault();

        const ticketSubject = document.getElementById('ticket_subject')?.value || ''; // Not present in the form, but keeping this for future use
        const message = document.getElementById('msg').value;
        const files = document.getElementById('files').files;
        
        // Get hidden fields
        const createReply = document.getElementById('create_reply').value;
        const replyOrigin = document.getElementById('reply_origin').value;
        const supportTicketId = document.getElementById('support_ticket_id').value;

        if (!message.trim()) {
            alert("Please enter a message.");
            return;
        }

        const formData = new FormData();
        formData.append('create_reply', createReply);
        formData.append('reply_origin', replyOrigin);
        formData.append('support_ticket_id', supportTicketId);
        formData.append('msg', message);

        // Append files if available
        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        fetch('./controllers/support-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Failed to submit the reply.');
            }
        })
        .then(response => {
            // console.log(response);
            if ($.trim(response.status) === '1') {
                const newReply = response.html;
                console.log(newReply);
                const replyElements = document.querySelectorAll('.reply');
                const replyElement = replyElements[replyElements.length - 1];
                replyElement.insertAdjacentHTML('afterend', newReply); 
            } else {
                // $('#message-response-1').html("<div class='error' style='margin-top: 0px;'>There was an issue submitting your reply</div>");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the reply.');
        });
    }
</script>




</div>





<script>
    function pickMark() {
        console.log('a');
        event.preventDefault();
        document.getElementById('files').click();
    }
</script>


