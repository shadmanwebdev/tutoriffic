<?php
    include './partials/header.php';
?>
<?php include './partials/nav-2.php'; ?>
<!-- 
    Check if user is logged in
    if not  take to the login page
    else show this page
-->
<?php
    // if(!isset($_SESSION['support_account'])) {
    //     header('location: ./support-login');
    // }
?>

<style>
    .create-btn {
        border-radius: 30px;
        padding: 7px 20px;
        transition: .3s;
        font-size: 14px;
        display: inline-block;
        text-align: center;
        background: rgb(255, 145, 77);
        color: #fff;
        border: 1px solid rgb(255, 145, 77);
        transition: .3s;
    }
    .create-btn:hover {
        color: #fff;
        opacity: .8;
    }
    .ticket-row .elapsed {
        color: #656565;
    }

    .btn.reject {
        border-radius: 30px;
        padding: 7px 20px;
        transition: .3s;
        font-size: 14px;
        background: rgb(223 223 223);
        color: #000000;
        border: 1px solid rgb(223 223 223);
        transition: .3s;
    }
    .btn.reject:hover {
        color: #000;
        opacity: .8;
    }
    .btn.reject {
        margin-right: 10px;
    }

    .follow-wrapper {
        width: 900px;
        margin: 100px auto;
        min-height: 100%;
        font-weight: 300;
    }
    .follow-wrapper .row {
        width: 900px;
        margin: 0;
    }
    table {
        width: 100%;
        border: solid 1px #ccc;
    }
    table tr {
        font-size: 15px;
        border-bottom: solid 1px #ccc;
        font-weight: 300;
        color: #181818;
        line-height: 2.3;
        vertical-align: middle;
    }
    table tr td a {
        color: #181818;
        font-weight: bold;
    }
    table tr td a:hover {
        color: #000;
    }
    table thead, table tfoot {
        background: whitesmoke;
        font-weight: bold;
    }

    table tr.even, table tr.alt, table tr:nth-of-type(even) {
        background: #f9f9f9;
    }
    th:nth-child(1) {
        width: 40%;
    }
    table.support th {
        padding: 9px 20px 9px 20px;
    }
    table.support td {
        padding: 9px 20px 9px 20px;
    }
    @media (max-width: 991px) {
        .follow-wrapper {
            width: 600px;
            margin: 80px auto;
        }
        .follow-wrapper .row {
            width: 600px;
        }
    }
    @media (max-width: 768px) {
        .follow-wrapper {
            width: 400px;
            margin: 60px auto;
        }
        .follow-wrapper .row {
            width: 400px;
        }
    }
    @media (max-width: 576px) {
        .follow-wrapper {
            width: 350px;
            margin: 60px auto;
        }
        .follow-wrapper .row {
            width: 350px;
            
        }
    }
</style>

<div class='page-wrapper'>



    <div class='follow-wrapper'>
        <div class='row follow'>
            <div class='small-12 columns'>
                <table class='small-11 small-centered columns table-text-margin support mtable'>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Last Reply Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ticket_by = get_uid();
                            $support = new Support;
                            echo $support->support_tickets_by_account($ticket_by);
                        ?>
                    </tbody>
                </table>
    
                <div style='margin-top: 20px; display: flex; justify-content: flex-end;'>
                    <a href='./' class='btn reject' style='text-decoration: none;'>Back to Home</a>
                    <a href='./open-ticket' class='btn create-btn'>Open New Ticket</a>
                </div>
            </div>
        </div>
    </div>










</div>




