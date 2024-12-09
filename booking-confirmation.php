<?php
    include './partials/header.php';
?>
<?php 
    include './partials/navigation.php'; 
?>

<!-- Pop up -->
<style>
    .popup {
        padding: 0px;
        top: 5%;
        margin-top: 0;
    }
</style>

<!-- Modal dialog -->
<style>
    .modal-dialog {
        padding: 0;
        max-width: 600px !important;
        margin: 0 !important;
    }
    @media (min-width: 576px) {

        .modal-dialog {
            max-width: 600px !important;
            margin: 0;
        }
    }
    .modal-dialog .modal-content .modal-header {
        background: #fff;
        color: #333652;
    }
    .modal-dialog .modal-content .modal-header {
        border-radius: 2px 2px 0 0;
        text-align: center;
        width: 100%;
        min-height: 40px;
        padding: 10px;
        padding-right: 50px;
        position: relative;
        border-bottom: none;
    }

    .close-full-info, .modal-dialog .modal-content button.close {
        position: absolute;
        right: 0;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background: transparent;
        border: 0;
        font-size: 18px;
        margin-top: 0;
        outline: none;
        top: 0;
        transform: translate(0);
        text-shadow: none;
    }

    /* Heading */
    
    .modal-dialog .modal-content .modal-header .modal-title {
        font-weight: 400;
        margin-bottom: 0;
    }
    .modal-dialog .modal-content .modal-header .modal-title {
        font-size: 24px;
        text-align: left;
        padding: 0 0 0 20px;
    }
    @media (max-width: 1366px) {
        .modal-dialog .modal-content .modal-header .modal-title {
            padding: 0 0 0 10px;
        }
    }
    
    @media (max-width: 1024px) {
        .modal-dialog .modal-content .modal-header .modal-title {
            padding: 0 0 0 5px;
        }
    }
    /* Text */
    .modal-body {
        padding: 0;
    }
    .tab-pd {
        padding: 30px;
    }
    @media (max-width: 1366px) {
        .tab-pd {
            padding: 20px;
        }
    }
    @media (max-width: 1024px) {
        .tab-pd {
            padding: 15px;
        }
    }
    .modal-footer {
        padding: 0;
        border-top: none;
    }
    /* Button */
    .btn, .modal-dialog .modal-content .modal-footer .btn, .sb-widget-form .buttons .send-message-button, #reviews-view .add-review .form .send-btn-container button, .payment-modal #sb_pay_btn, .togg-membership-filters-service, #sb_accept_cookies, .modal-dialog.modal-cancellation-reason .modal-content button.close {
        background: rgb(255, 145, 77);
        color: #ffffff;
    }
    .modal-dialog .modal-content .modal-footer #cancellation_cancel {
        background: #fff;
        color: #111;
        border: 2px solid #111;
        box-sizing: border-box;
        transition: all .32s ease-in-out;
    }



</style>

<style>
    .section-pd {
        padding: 40px;
    }

    @media (max-width: 1366px){
        .section-pd {
            padding: 30px;
        }
    }
    .confirm .section-pd {
        height: 100%;
    }
    .cap {
        line-height: 1.1;
    }
    .current-booking-info .mg {
        margin-bottom: 10px;
    }
    .current-booking-info .cap.mg {
        font-weight: 400;
        font-size: 30px;
        text-align: center;
        margin-bottom: 30px;
    }
    @media (max-width: 1024px) {
        .current-booking-info .cap.mg {
            font-size: 26px;
            margin-top: 20px;
        }
    }


    table {
        caption-side: bottom;
        border-collapse: collapse;
    }
    .current-booking-info table {
        font-size: 15px;
    }
    .current-booking-info table {
        width: 100%;
        font-size: 16px;
    }
    .current-booking-info .label {
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 600;
        display: block;
        width: 130px;
        padding-right: 10px;
        margin-bottom: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .current-booking-info .info {
        font-weight: 400;
        text-align: right;
    }
    /* Buttons */
    .confirm .btn.btn-with-icon {
        padding: 0;
    }
    .booking-btns .row .col-sm-12 .btn {
        border-radius: 1px;
        margin: 5px;
        min-width: 140px;
        width: calc(50% - 10px);
    }
    .btn {
        height: 50px;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        margin-bottom: 0;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        border: 1px solid transparent;
        white-space: normal;
        padding: 0 12px;
        font-size: 15px;
        line-height: 1.2;
        border-radius: 1px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .btn.btn-with-icon a, .btn.btn-with-icon span {
        position: relative;
        z-index: 1;
        display: -ms-flexbox;
        display: flex;
        text-shadow: none;
        width: 100%;
        height: 100%;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        white-space: normal;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0 15px!important;
        line-height: 1.2;
    }
    .btn.btn-with-icon.sb_cancel_btn span {
        color: #a94442!important;
        background: #ffffff!important;
        border: 1px solid #a94442!important;
    }
    .btn.sb-book a.sb_book_again {
        color: rgb(255, 145, 77)!important;
        background: #ffffff!important;
        border: 1px solid rgb(255, 145, 77)!important;
    }
</style>


<!-- Cancel popup -->
<div class='popup hide_popup' id='cancel-booking-popup'>


    <div class="modal-dialog modal-cancellation-reason" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button onclick='closePopup();' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="modal-close-button" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </span>
                </button>
                <h4 class="modal-title">Cancel booking</h4>
            </div>

            <div class="modal-body cancellation-dialog-body">
                <div class="tab-pd">
                    <p>Please confirm cancellation of this appointment.</p>
                </div>
            </div>

            <div class="modal-footer">
                <div class="tab-pd">
                    <button onclick='closePopup();' type="button" class="btn btn-primary" id="cancellation_cancel" data-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary" id="cancellation_confirm">Confirm</button>
                </div>
            </div>
            <div class="message-response" id="message-response-cancel">
            </div>

        </div>
    </div>

</div>



<style>
    .confirm {
        margin: 0 auto;
        position: relative;
        max-width: 600px;
        box-shadow: 0 8px 15px rgba(0,0,0,.2);
        margin-top: 0;
        margin-bottom: 36px;
        background: #fff;
        padding: 0;
    }
    @media (max-width: 680px) {
        .confirm {
            width: 95%;
        }
    }
    .confirm .section-pd {
        height: 100%;
    }
    .booking-overview {
        width: 100%;
    }

    .info .date-line {
        -ms-flex-pack: end;
        justify-content: flex-end;
    }
    .info .date-line {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: baseline;
        align-items: baseline;
        gap: 12px;
    }



    .booking-btns .row .col-sm-12 {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        position: static;
    }

    .booking-btns .row .col-sm-12 .btn {
        border-radius: 1px;
        margin: 5px;
        min-width: 140px;
        width: calc(50% - 10px);
    }
    .btn.btn-with-icon a, 
    .btn.btn-with-icon span {
        position: relative;
        z-index: 1;
        display: -ms-flexbox;
        display: flex;
        text-shadow: none;
        width: 100%;
        height: 100%;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        white-space: normal;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0 15px!important;
        line-height: 1.2;
    }

    .confirm .btn.btn-with-icon {
        padding: 0;
    }
    .btn.btn-with-icon.sb_cancel_btn span {
        color: #a94442!important;
        background: #ffffff!important;
        border: 1px solid #a94442!important;
    }
    .btn.sb-book a.sb_book_again {
        color: rgb(255, 145, 77)!important;
        background: #ffffff!important;
        border: 1px solid rgb(255, 145, 77)!important;
    }
</style>

<!-- Confirmation -->
<div class="generating-area visite-padding2" style='margin-top: 160px; margin-bottom: 160px; padding-bottom: 0;'>

    <div class="confirm">
        <div class="section-pd">
            <div class="current-booking-info">
                <div class="service-name cap mg">
                    Laundry (Wash, Dry &amp; Fold) - Clothes
                </div>
                <div class="booking-info mg">
                    <div class="booking-overview">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="label">Date:</td>
                                    <td class="info">
                                        <div class="date-line">
                                            <span class="datetime date-line--caption"></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label">Provider:</td>
                                    <td class="info">
                                        smartlyclean
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label">Booking code:</td>
                                    <td class="info booking-code"></td>
                                </tr>
                                <tr>
                                    <td class="label">Status:</td>
                                    <td class="info booking-status"></td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="mg">
                </div>
                <div class="booking-btns">
                    <div class="row">
                        <div class="col-sm-12">

                            <div onclick="popup('cancel-booking-popup')" class="btn custom btn-with-icon sb_cancel_btn" role="button" tabindex="0">
                                <span>
                                    Cancel Booking
                                </span>
                            </div>
                            <div class="btn custom btn-with-icon sb-book">
                                <a href="./services" class="sb_book_again">
                                    Book More
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<!-- Footer -->
<style>
    /*=======================================

        FOOTER

    =========================================*/
    footer {
        background: #e4f8ff;
    }
    .footer-area {
        padding-top: 50px;
    }
    footer .logo {
        width: 210px;
        margin-bottom: 15px;
    }
    .header-bottom .main-menu ul {
        padding: 0;
        margin: 20px 0 40px 50px;
        display: flex;
        justify-content: center;
    }
    .header-bottom .main-menu ul li {
        /* display: inline-block; */
        position: relative;
        z-index: 1;
    }
    .header-bottom .main-menu ul li a {
        font-size: 16px;
        color: #121212;
        display: inline-block;
        padding: 0px 22px;
        display: block;
        font-size: 16px;
        text-decoration: transparent;
        font-weight: 500;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }

    footer .header-bottom3 .header-info {
        margin-left: 0;
        margin-right: 0;
    }


    .footer-bottom-area .footer-border {
        padding: 0px;
    }
    .footer-bottom-area .footer-copy-right p {
        color: #121212;
        font-weight: 500;
        font-size: 16px;
        line-height: 2;
        margin-bottom: 0px;
    }

    footer .header-bottom {
        border-top: none;
    }
    .footer-bottom-area {
        padding-bottom: 50px;
    }
    @media (max-width: 1200px) {
        .header-bottom .main-menu ul {
            padding: 0;
            margin: 20px 0px 40px 0px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .header-bottom .main-menu ul li {
            margin-bottom: 0px;
        }
        footer .header-bottom .main-menu ul li a {
            padding: 5px 12px;
        }
    }
</style>


<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding">
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top text-center" style='display: flex; justify-content: center;'>
                    <!-- logo -->
                    <div class="logo">
                        <a href="./">
                            <!-- <img src="assets/smartlyclean-logo-resized.png" alt="" class="img-fluid"> -->
                            <img src="assets/High Transparent Logo.png" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="header-bottom header-bottom2 ">
       
                    <!-- Main-menu -->
                    <div class="main-menu text-center">
                        <nav>                                                
                            <ul>   
                                <li><a href="./">Home</a></li>
                                <li><a href="./services">Services</a></li>
                                <li onclick="scroll_to_element('faq', event)"><a href="#faq">FAQ</a></li>
                                <li><a href="./about-us">About Us</a></li>
                                <li><a href="./contact-us">Contact Us</a></li>
                                <li><a href="./join-team">Join our team</a></li>
                            </ul>
                        </nav>
                    </div>
                            
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-9 col-lg-8">
                        <div class="footer-copy-right text-center">
                            <p class="text-center text-md-end text-xl-start"> 
                                Copyright by SmartlyPromote
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>



<?php
    include './partials/footer.php';
?>