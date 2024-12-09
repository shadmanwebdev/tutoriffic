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
    .open-ticket-wrapper {
        max-width: 900px;
        margin: 80px auto;
    }
    .small-11 {
        width: 100%;
        padding-top: 1.9375rem;
        padding-bottom: 1.9375rem;  
        padding-left: 2.9375rem;
        padding-right: 2.9375rem;  
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .row {
        margin-right: 0px;
        margin-left: 0px;
    }
    /* .box-content {
        padding: 25px;
    } */
    .column.small-centered, .columns.small-centered {
        position: relative;
        margin-left: auto;
        margin-right: auto;
        float: none !important;
    }
    /* .form-header {
    } */
    .column, .columns {
        position: relative;
        float: left;
    }
    .box-content h2 {
        font-size: 24px;
        font-weight: 300;
        margin: 0.84em 0 0 0;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    .row .row.but-pad {
        margin: 0;
    }

    .row .row.collapse {
        display: flex;
        width: 100%;
        /* width: auto; */
        margin: 0;
        max-width: none;
        *zoom: 1;
    }
    .small-12.columns {
        
        display: flex;
        width: 100%;
    }
    .collapse:not(.show) {
        display: block;
    }
    input[type="text"], input[type="password"], 
    input[type="date"], input[type="datetime"], 
    input[type="datetime-local"], input[type="month"], 
    input[type="week"], input[type="email"], 
    input[type="number"], input[type="search"], 
    input[type="tel"], input[type="time"], input[type="url"], textarea {
        width: 100%;
        color: rgb(60, 60, 60);
        font-family: 'Open Sans', 'Calibri', Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 300;
        line-height: 22px;
        margin: 0 0 3px 0;
        padding: 0.625em 0.625em 0.625em;
    }
    input[type="text"], 
    input[type="password"], 
    input[type="date"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="month"], 
    input[type="week"], 
    input[type="email"], 
    input[type="number"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="time"], 
    input[type="url"], 
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
    }
    @media (max-width: 768px) {
        .open-ticket-wrapper {
            max-width: 95%;
            margin: 50px auto;
        }
        .small-11 {
            width: 100%;
            padding-top: 0.9375rem;
            padding-bottom: 0.9375rem;
            padding-left: 1.9375rem;
            padding-right: 1.9375rem;
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
    }
</style>


<style>
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
        display: flex;
        align-items: center;
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


<div class='open-ticket-wrapper'>
    <div class="row">
        <div class="small-12 columns box-content support">

            <div class="row">

                <?php
                    $support = new Support;
                    $support_id = $support->get_support_id();
                    echo $support->create_ticket_form($support_id);
                ?>

            </div>
        </div>

    </div>
</div>










</div>





<script>
    function pickMark() {
        console.log('a');
        event.preventDefault();
        document.getElementById('files').click();
    }
</script>

<script defer>
    function create_ticket(event) {
        event.preventDefault();

        const ticketSubject = document.getElementById('ticket_subject').value;
        const message = document.getElementById('msg').value;
        const files = document.getElementById('files').files;

        if (!ticketSubject.trim() || !message.trim()) {
            alert("Please enter both a subject and a message.");
            return;
        }

        const formData = new FormData();
        formData.append('create_ticket', 'true');
        formData.append('ticket_subject', ticketSubject);
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
                return response.text();
            } else {
                throw new Error('Failed to submit the support ticket.');
            }
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#message-response-1').html("<div class='success' style='margin-top: 0px;'>Your ticket was submitted successfully</div>");
            } else {
                $('#message-response-1').html("<div class='error' style='margin-top: 0px;'>There was an issue submitting your ticket</div>");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the support ticket.');
        });
    }
</script>

