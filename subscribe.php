<?php
    include './partials/header.php';

?>
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>

<link rel="stylesheet" href="css/schedule.css">



<!-- Payment buttons popup -->
<style>
    #gpay-container {
        width: 240px; 
        height: 40px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 50px auto 0 auto;
    }
    img#gpay-container-img {
        position: absolute;
        top: 10px;
        z-index: 100;
        width: 120px;
        height: 20px;
        cursor: pointer
    }
    #gpay-container iframe {
        position: absolute;
        bottom: -40px;
    }
</style>

<div id='payment-btns' class='popup hide_popup'>
    
    <div id='gpay-container'>
        <img src="img/en.svg" alt="" id='gpay-container-img'>
    </div>

</div>



<style>
    @media (min-width: 992px) {
        .card {
            min-width: 360px;
            padding: 40px 40px 24px;
        }
    }
</style>


<!-- Boards -->
<style>
    .ad-subject-boards {
        display: flex;
        font-size: 15px;
        flex-flow: row wrap;
    }
    .ad-subject-name {
        text-align: left;
    }
    .ad-subject-boards > div {
        margin-right: 10px;
        font-size: 13px;
        color: gray;
        font-weight: 500;
    }
    .boards {
        margin-bottom: 25px;
    }
    .popup-input-heading {
        margin-bottom: 15px;
    }
    .boards-row {
        display: flex;
        flex-flow: row wrap;
    }
    /* Checkbox */
    .custom-checkbox {
        padding: 8px 20px 8px 0px;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .custom-checkbox-inner {
        display: flex;
        align-items: center;
        margin-right: 10px;
    }

    /* Hide the default checkbox */
    input[type="checkbox"] {
        display: none;
    }

    /* Style the label to create a custom checkbox */
    label {
        display: inline-block;
        position: relative;
        padding: 10px; /* Adjust the padding as needed */
        border: 2px solid #ccc; /* Default border color */
        border-radius: 8px;
        width: 20px; /* Set the width and height for the custom checkbox */
        height: 20px;
        background-color: #f0f0f0; /* Default background color */
        margin-bottom: 0;
    }

    /* Style the label when the checkbox is checked */
    input[type="checkbox"]:checked + label {
        color: #fff; /* Background color when checked */
        background-color: rgb(255, 145, 77); /* Background color when checked */
        border-color: rgb(255, 145, 77); /* Green border color when checked */
    }

    /* Add some inner content or icons to the label to indicate the checkbox */
    label::before {
        content: '\2713'; /* Unicode checkmark symbol */
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;  /* Green color for the checkmark when checked */
        font-size: 14px; /* Adjust the size of the checkmark */
        opacity: 0; /* Hide the checkmark by default */
    }

    /* Style the label when the checkbox is not checked */
    input[type="checkbox"] + label {
        transition: background-color 0.3s, border-color 0.3s; /* Add a smooth transition effect */
    }

    /* Show the checkmark when the checkbox is checked */
    input[type="checkbox"]:checked + label::before {
        opacity: 1;
    }
    .checkbox-text {
        font-size: 15px;
        font-weight: 500;
        color: #121212;
        display: inline-block;
    }
</style>


<!-- Display subject by level -->
<style>
    .sub-wrapper {
        margin-bottom: 25px;
    }
    .gcse-subjects-row, .a-level-subjects-row {
        display: flex;
        flex-flow: row nowrap;
    }
    .sub-row-title {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 15px;
    }
    .gcse-subjects-row > .subject-item,
    .a-level-subjects-row > .subject-item {
        font-weight: 600;
        color: #222;
        /* text-shadow: 0 0 0.15px #222, 0 0 0.15px #222; */
        background-color: white;
        border: 1px solid rgba(34, 34, 32, 0.1);

        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        font-style: normal;
        color: #666666;
        margin-bottom: 0;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background-color: #fff;
        cursor: pointer;

        -webkit-transition: .3s all;
        transition: .3s all;
    }
    .gcse-subjects-row > .subject-item:hover,
    .a-level-subjects-row > .subject-item:hover {
        -webkit-box-shadow: 0 0 15px 0 rgba(34,34,32,0.1);
        box-shadow: 0 0 15px 0 rgba(34,34,32,0.1);
    }

    .selected-ad-subject {
        color: rgb(255,145,77) !important;
        background-color: #fff !important;
        border: 1px solid rgb(255,145,77) !important;
    }
    /* Selected subject boards */
    .selected-ad-subject > .ad-subject-boards > div {
        color: rgb(255,145,77);
        background-color: #fff;
    }
</style>

<!-- Select -->
<style>
    /* Apply styles to the custom-selector container */
    .custom-selector {
        position: relative;
        margin-bottom: 20px;
    }

    /* Apply styles to the custom-select-wrapper */
    .custom-select-wrapper {
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
        position: relative;
        width: 100%;
        text-align: left;
        border-radius: 5px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    /* Apply styles when the custom-select-wrapper has focus */
    .custom-select-wrapper:focus {
        border-color: #444;
    }

    /* Apply styles to the custom-options when the custom-select-wrapper has focus */
    .custom-select-wrapper:focus .custom-options {
        border-color: #444;
        max-height: 180px;
        overflow-y: scroll;
    }

    /* Apply styles to the triangle icon after the selected label when the custom-select-wrapper has focus */
    .custom-select-wrapper:focus .selected-label:after {
        transition: all 0.3s ease;
        border-color: #444 transparent transparent transparent;
        transform: translateY(-50%) rotate(-180deg);
    }

    /* Apply styles to the selected label */
    .selected-label {
        color: #999;
        width: 100%;
        display: inline-block;
        padding: 18px 10.4px 18px 20px;
        box-sizing: border-box;
    }

    /* Apply styles to the selected label when it is focused */
    .selected-label.already {
        color: #444;
    }

    /* Apply styles to the triangle icon after the selected label */
    .selected-label:after {
        content: "";
        transition: all 0.3s ease;
        width: 0;
        height: 0;
        position: absolute;
        right: 20px;
        top: 50%;
        transform-origin: 50% 50%;
        transform: translateY(-50%) rotate(0deg);
        border-style: solid;
        border-width: 6px 4.5px 0 4.5px;
        border-color: #d8d8d8 transparent transparent transparent;
    }

    /* Apply styles to the custom-options */
    .custom-options {
        position: absolute;
        top: calc(100% - 15px);
        left: -1px;
        width: calc(100% + 2px);
        list-style: none;
        border: 1px solid #e0e0e0;
        border-top-color: #fff !important;
        border-radius: 0 0 5px 5px;
        padding: 0 10px 10px 10px;
        overflow: hidden;
        cursor: pointer;
        z-index: 100;
    }

    /* Apply styles to the custom-options and custom-options li */
    .custom-options,
    .custom-options li {
        background-color: #fff;
        box-sizing: border-box;
    }

    /* Apply styles to the custom-options li */
    .custom-options li {
        transition: all 0.3s ease;
        width: 100%;
        padding: 10px 0 10px 10px;
        border-radius: 5px;
        color: #999;
    }

    /* Apply styles to the custom-options li when hovering or having the cursor on it */
    .custom-options li.cursorOn,
    .custom-options li:hover {
        background-color: #f7f7f7;
        color: #fff;
        color: #444;
    }

    /* Apply styles to the selected option in the custom-options */
    .custom-options li.selected {
        color: #444;
    }
    .custom-options:not(.active) {
        display: none;
    }
    .custom-options.active {
        display: block;
        max-height: 180px;
        overflow-y: scroll;
    }
    .custom-options:not(.active) + .selected-label:after {
        width: 0;
        height: 0;
        border: none;
    }
    .custom-options li {
        transition: all 0.3s ease;
        width: 100%;
        padding: 10px 0 10px 10px;
        border-radius: 5px;
        color: #999;
    }
    .custom-options li.cursorOn,
    .custom-options li:hover {
        background-color: #f7f7f7;
        color: #fff;
        color: #444;
    }
    .custom-options li.selected {
        color: #444;
    }

    .custom-selector.invalid .custom-select-wrapper {
        margin-bottom: 0;
    }
    .custom-selector.invalid .error {
        margin-bottom: 15px;
    }
</style>


<style>
    #subjects-wrapper-outer.invalid .sub-wrapper:nth-child(2) {
        margin-bottom: 10px;
    }
</style>


<div class='container page-wrapper schedule'>
    <div class='row'>
        <?php
            $ad = new Ad();
            $ad->profile_column(1);  
        ?>



        <div class='col-lg-8 col-md-12'>
            <div class='schedule tab tab-1 active-tab'>
            <!-- <div class='schedule tab tab-1'> -->
                <div class='schedule-title'>
                    <h1>Schedule</h1>
                    <h2>Your first class with Vishal</h2>
                </div>

                <!-- Ad id -->
                <input type="hidden" id='ad_id' name='ad_id' value="<?= $_GET['id']; ?>">

                <!-- Message -->
                <div class="message-wrapper" id="message-wrapper-outer">
                    <h3 class='msg-label'>
                        Your message
                        <span class="optional"></span>
                    </h3>
                    <textarea id='msg_student' class="textarea auto-resize" name="msg_student" placeholder="Tell Vishal a little bit more about your search for courses, your availability etc... The more information you give to your teacher, the more likely they will be to accept your request." rows="8" cols="80">Hello Vishal,
My name is Shadman and I am looking for a English teacher.
I would like to take lessons at your place or mine.
Ideally, I would like to start classes as soon as possible.
Would that work for you? Could you contact me so that we can discuss it further?
Have a great day,
See you soon, Shadman</textarea>

                    <div class='error' id='messageError'></div>

                </div>



                <!-- Expectations -->
                <div class="message-wrapper" id='expectations-wrapper-outer'>
                    <h3 class='msg-label'>
                        What are your expectations from this lesson?
                        <span class="optional"></span>
                    </h3>
                    <textarea onkeyup='insertTypedText(this.value, "lesson_expectations-2")' class="textarea auto-resize" id='lesson_expectations' name="lesson_expectations" placeholder="Tell Vishal a little bit more about your expectation from this lesson, what you hope to achieve etc... The more information you give to your teacher, the more likely they will be to accept your request." rows="8" cols="80"></textarea>
                    <div class='error' id='expectationsError'></div>
                </div>



                <!-- Subjects -->
                <div id='subjects-wrapper-outer'>
                    <?php
                        $ad->displaySubjectsByLevel(1);
                    ?>
                    <div id='subjectsError' class='error'></div>
                </div>



                <div class='btns-wrapper'>
                    <span class='btn next-btn' onclick="switchTabSchedule('tab', 'tab-2', 'active-tab')">Next</span>
                </div>
                
                
            </div>

            <style>
                .card-title {
                    margin-bottom: 8px;
                    font-size: 18px;
                    font-weight: 800;
                }
                #subjects-2 {
                    margin-top: 10px;
                }
                div.subject-summary[data-subject-id] {
                    display: flex;
                    flex-flow: row nowrap;
                    margin-bottom: 15px;
                }
                .subject-name {
                    margin-right: 20px;
                    font-weight: bold;
                }
                .selected-boards {
                    display: flex;
                    flex-flow: row nowrap;
                    margin-right: 20px;
                }
                .selected-boards > .comma {
                    margin-right: 5px;
                }
            </style>
            <!-- <div class='schedule tab tab-2 active-tab'> -->
            <div class='schedule tab tab-2'>
                <!-- Lesson expectations -->
                <!-- <div class='card' style='border-radius: 8px; margin-bottom: 25px;'>

                </div> -->

                <div class='card' style='border-radius: 8px; margin-bottom: 25px;'>
                    <!-- Expectations -->
                    <div class="card-title">
                        Expectations
                    </div>
                    <div id='lesson_expectations-2' style='margin-bottom: 16px;'>
                    </div>

                    <!-- Subjects -->
                    <div class="card-title">
                        Subjects
                    </div>
                    <div id='subjects-2' style='margin-bottom: 16px;'>
                    </div>

                    <!-- Price -->
                    <div class="card-title">
                        Total price
                    </div>
                    <div id="price-total" style="margin-bottom: 16px;">

                    </div>

                </div>

                <!-- <div class="check_radio" style='width: 100%;'>
                    <h3 class="MER_mt30" style='margin-bottom: 15px;'>Type of payment</h3>
                    <div class="MER_form" style='background-color: #f7f7f7; border-radius: 32px; padding: 5px;'>

                        <label onclick='selectCard();' for="Face" class="component-checkbox-register checkbox checked"  style='width: 50%; text-align: center; border-radius: 32px; padding: 15px 20px;'>
                        <input type="radio" class="js-showWhere" name="pay_method" value="card" id="card" checked="checked">
                            Card
                        </label>

                        <label onclick='selectStripe();' for="Webcam" class="component-checkbox-register checkbox"  style='width: 50%; text-align: center; border-radius: 32px; padding: 15px 20px;'>
                        <input type="radio" class="js-hideWhere" name="pay_method" value="stripe" id="stripe">
                            Stripe
                        </label>
                    </div>
                </div> -->

                <?php
                    // Tutor
                    $ad = new Ad;
                    $ad_array = $ad->get_single_ad($_GET['id']);
                    $tutor_uid  = $ad_array['tutor_uid'];

                    // Connected Account Id
                    $ss = new StripeSubscription();
                    $connected_account_id = $ss->get_account_id($tutor_uid) 
                ?>

                <div id='account-wrapper-outer'>
                    <input type='hidden' name='connected_account_id' id='connected_account_id' value='<?= $connected_account_id; ?>'>
                    <div class='error' id='accountError' style='text-align: center;'></div>
                </div>


                <div class='btns-wrapper' style='display: flex; justify-content: center;'>
                    <span style='margin-right: 5px; color: rgb(255, 145, 77);
    background-color: #fff; border: 1px solid rgb(255, 145, 77);' class='btn next-btn' onclick="paymentPopup('payment-btns')">Book lesson</span>
                    <span class='btn next-btn' onclick="createFreeLessonRequest()">Book free intro lesson</span>
                </div>


                <!-- <div class='btns-wrapper'> -->
                    <?php
                        // $sp = new StripeSubscription;
                        // $sp->stripe_btn($_GET['id']);
                    ?>
                    <!-- <span class='btn btn-light-gray' style='display: flex; align-items: center; margin-right: 10px;' onclick="switchTab('tab', 'tab-1', 'active-tab')">Back</span> -->
                    <!-- <a class='btn stripe-btn' style='display: none;' href="./stripe-connect/payment?account_id=">Pay with Stripe</a> -->
                    <!-- <span class='' onclick='pay_with_stripe();'>Pay with Stripe</span> -->
                    <!-- <span class='btn next-btn' onclick='create_request();'>Send Request</span>
                </div> -->
            </div>
        </div>

    </div>
</div>


<div id='ad-subject-popup-wrapper'></div>



<!-- Selection input -->
<script defer>
    custom_select();
</script>

<script>
    
    function paymentPopup(popEl) {
        // Connected Account Id
        var connected_account_id = document.getElementById('connected_account_id').value;
        
        if(connected_account_id) {

            $('#account-wrapper-outer').removeClass('invalid');
            $('#accountError').html('');


            var popup = document.getElementById(popEl);
            var popBg = document.getElementById('popBg');
    
            var popupNodelist = document.querySelectorAll('.popup');   
            for (let i = 0; i < popupNodelist.length; i++) {
                if(popupNodelist[i].classList.contains('show_popup')) {
                    popupNodelist[i].classList.remove('show_popup');
                    popupNodelist[i].classList.add('hide_popup');
                    if(popBg.classList.contains('dark')) {
                        popBg.classList.remove('dark');
                    }
                    popBg.classList.add('light');
                }
            }
            
            if(popup.classList.contains('hide_popup')) {
                popup.classList.remove('hide_popup');
                popup.classList.add('show_popup');
                if(popBg.classList.contains('light')) {
                    popBg.classList.remove('light');
                }
                popBg.classList.add('dark');
                return;
            }
        } else {
            $('#account-wrapper-outer').addClass('invalid');
            $('#accountError').html('<div>Account Is not connected</div>');
        } 
    }
    function switchTabSchedule(defaultClass, switchTo, activeClass) {
        /*
            The switchTabSchedule() is a mutated form of our original switchTab()
            It combines swtiching tabs according to the function arguments we provide
            with the validations necessary before the switch
        */
        
        // Validate
        var isSubject = document.querySelector('.selected-ad-subject') !== null;
        var expectation = document.getElementById('lesson_expectations').value;
        var message = document.getElementById('msg_student').value;
        var isLessonLengthSelected = document.querySelector('.component-checkbox-register.checked') !== null;
        var lesLength = document.querySelector('.component-checkbox-register.checked');

        var day = document.getElementById('day').textContent;
        var time = document.getElementById('time').textContent;

        console.log(day, time);

        if (lesLength) {
            var lengthValue = lesLength.querySelector('input').value;
            console.log('Lesson length id: ' + lengthValue);
        } else {
            console.log('Lesson length not selected');
        }




        // Message
        if(message) {
            $('#message-wrapper-outer').removeClass('invalid');
            $('#messageError').html('');
        }
        // Subject
        if(isSubject) {
            $('#subjects-wrapper-outer').removeClass('invalid');
            $('#subjectsError').html('');
        }
        // Expectation
        if(expectation) {
            $('#expectations-wrapper-outer').removeClass('invalid');
            $('#expectationsError').html('');
        }
        // Day
        if(day != 'Select Day') {
            $('#day-selector').removeClass('invalid');
            $('#dayError').html('');
        }
        // Time
        if(time != 'Select Time') {
            $('#time-selector').removeClass('invalid');
            $('#timeError').html('');
        }





        if (
            isSubject && expectation && isLessonLengthSelected && 
            day != 'Select Day' &&
            time != 'Select Time'
        ) {




            // Subjects
            subIds = [];

            var subjectElems = document.querySelectorAll('div[data-subject-id]');

            subjectElems.forEach(subElem => {
                var subId = subElem.getAttribute('data-subject-id');
                subIds.push(subId);
            });
            
            var subJson = JSON.stringify(subIds);



            // Day Id
            var day = document.getElementById('day');
            var dayId = day.getAttribute('data-selected-value');

            // Time Id
            var time = document.getElementById('time');
            var timeId = time.getAttribute('data-selected-value');

            // Lesson Length
            var lesLengthChecked = document.querySelector('.component-checkbox-register.checked');
            var lesson_length = lesLengthChecked.getAttribute('data-length');
        
            console.log(message, expectation, subJson, dayId, timeId, lesson_length);

            // Switch
            var tabs = document.getElementsByClassName(defaultClass);
            const switchToTab = document.querySelector('.' + switchTo);
            /*
                Loop through all tabs and remove active class
                Add active class to the tab we want to show
            */
            for (var i = 0; i < tabs.length; i++) {
                var tab = tabs[i];
                tab.classList.remove(activeClass);
            }
            switchToTab.classList.add(activeClass);
        } else {
            // Message
            if(!message) {
                $('#message-wrapper-outer').addClass('invalid');
                $('#messageError').html('<div>Field cannot be blank</div>');
            }
            // Subject
            if(!isSubject) {
                $('#subjects-wrapper-outer').addClass('invalid');
                $('#subjectsError').html('<div>Select a subject</div>');
            }
            // Expectation
            if(!expectation) {
                $('#expectations-wrapper-outer').addClass('invalid');
                $('#expectationsError').html('<div>Field cannot be blank</div>');
            }
            // Day
            if(day == 'Select Day') {
                $('#day-selector').addClass('invalid');
                $('#dayError').html('<div>Select a day</div>');
            }
            // Time
            if(time == 'Select Time') {
                $('#time-selector').addClass('invalid');
                $('#timeError').html('<div>Select a time</div>');
            }
            
            console.log('error');
        }
    }

</script>





<script defer>
    classOnClick('checkbox', 'checked');
    function selectStripe() {
        $('.stripe-btn').css('display', 'block');
        $('.back-btn').css('display', 'none');
        $('.next-btn').css('display', 'none');
    }
    function selectCard() {
        $('.stripe-btn').css('display', 'none');
        $('.back-btn').css('display', 'block');
        $('.next-btn').css('display', 'block');
    }
    function create_request() {
        const msg_student = $('#msg_student').val();
        const address = $('#address').val();
        const phone = $('#phone').val();
        const ad_id = $('#ad_id').val();
        const lesson_location_id = $('input[name="where"]:checked').val();
        
        var formData = new FormData();

        formData.append('create_request', 'true');
        formData.append('msg_student', msg_student);
        formData.append('ad_id', ad_id);
        formData.append('address', address);
        formData.append('phone', phone);
        formData.append('lesson_location_id', lesson_location_id);

        console.log(msg_student, address, phone, ad_id, lesson_location_id);

        fetch('./controllers/request-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            console.log(response);
            // window.location.href = './my-listing-confirmation';
        })
        .catch(err => console.log(err));
    }
</script>






<script defer>
    /**
     * Define the version of the Google Pay API referenced when creating your
     * configuration
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
     */
    const baseRequest = {
        apiVersion: 2,
        apiVersionMinor: 0
    };

    /**
     * Card networks supported by your site and your gateway
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     * @todo confirm card networks supported by your site and gateway
     */
    const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];

    /**
     * Card authentication methods supported by your site and your gateway
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     * @todo confirm your processor supports Android device tokens for your
     * supported card networks
     */
    const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

    /**
     * Identify your gateway and your site's gateway merchant identifier
     *
     * The Google Pay API response will return an encrypted payment method capable
     * of being charged by a supported gateway after payer authorization
     *
     * @todo check with your gateway on the parameters to pass
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
     */
    const tokenizationSpecification = {
        type: 'PAYMENT_GATEWAY',
        parameters: {
            "gateway": "stripe",
            "stripe:version": "2018-10-31",
            "stripe:publishableKey": "pk_test_51HaRBvH4rZ2esk0gHmBSga6Ol6eZuBPWgCEFGpFhYYCj3jdr56FZ3amU8NKSHad9DzM947vK1vUML0cwPWLmkQD900SJRjXf6g"
            // 'gateway': 'pk_test_51HaRBvH4rZ2esk0gHmBSga6Ol6eZuBPWgCEFGpFhYYCj3jdr56FZ3amU8NKSHad9DzM947vK1vUML0cwPWLmkQD900SJRjXf6g',
            // 'gatewayMerchantId': 'sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9'
        }
    };

    /**
     * Describe your site's support for the CARD payment method and its required
     * fields
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     */
    const baseCardPaymentMethod = {
        type: 'CARD',
        parameters: {
            allowedAuthMethods: allowedCardAuthMethods,
            allowedCardNetworks: allowedCardNetworks
        }
    };

    /**
     * Describe your site's support for the CARD payment method including optional
     * fields
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     */
    const cardPaymentMethod = Object.assign(
        {},
        baseCardPaymentMethod,
        {
            tokenizationSpecification: tokenizationSpecification
        }
    );

    /**
     * An initialized google.payments.api.PaymentsClient object or null if not yet set
     *
     * @see {@link getGooglePaymentsClient}
     */
    let paymentsClient = null;

    /**
     * Configure your site's support for payment methods supported by the Google Pay
     * API.
     *
     * Each member of allowedPaymentMethods should contain only the required fields,
     * allowing reuse of this base request when determining a viewer's ability
     * to pay and later requesting a supported payment method
     *
     * @returns {object} Google Pay API version, payment methods supported by the site
     */
    function getGoogleIsReadyToPayRequest() {
        return Object.assign(
            {},
            baseRequest,
            {
                allowedPaymentMethods: [baseCardPaymentMethod]
            }
        );
    }

    /**
     * Configure support for the Google Pay API
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
     * @returns {object} PaymentDataRequest fields
     */
    function getGooglePaymentDataRequest() {
        const paymentDataRequest = Object.assign({}, baseRequest);
        paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
        paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
        paymentDataRequest.merchantInfo = {
            // @todo a merchant ID is available for a production environment after approval by Google
            // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
            // merchantId: '12345678901234567890',
            merchantName: 'Example Merchant'
        };
        console.log(paymentDataRequest);
        return paymentDataRequest;
    }

    /**
     * Return an active PaymentsClient or initialize
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
     * @returns {google.payments.api.PaymentsClient} Google Pay API client
     */
    function getGooglePaymentsClient() {
        if ( paymentsClient === null ) {
            paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
        }
        
        console.log(paymentsClient);
        return paymentsClient;
    }

    /**
     * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
     *
     * Display a Google Pay payment button after confirmation of the viewer's
     * ability to pay.
     */
    function onGooglePayLoaded() {
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
            .then(function(response) {
                if (response.result) {
                    console.log(response.result);
                    addGooglePayButton();
                    // @todo prefetch payment data to improve performance after confirming site functionality
                    // prefetchGooglePaymentData();
                }
            })
            .catch(function(err) {
                // show error in developer console for debugging
                console.error(err);
            });
    }

    /**
     * Add a Google Pay purchase button alongside an existing checkout button
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
     * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
     */
    function addGooglePayButton() {
        const paymentsClient = getGooglePaymentsClient();
        const button =
            paymentsClient.createButton({
                onClick: onGooglePaymentButtonClicked,
                allowedPaymentMethods: [baseCardPaymentMethod]
            });
        document.getElementById('gpay-container').appendChild(button);
    }

    /**
     * Provide Google Pay API with a payment amount, currency, and amount status
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
     * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
     */
    function getGoogleTransactionInfo() {
        return {
            countryCode: 'US',
            currencyCode: 'USD',
            totalPriceStatus: 'FINAL',
            // set to cart total
            totalPrice: '1.00'
        };
    }

    /**
     * Prefetch payment data to improve performance
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/client#prefetchPaymentData|prefetchPaymentData()}
     */
    function prefetchGooglePaymentData() {
        const paymentDataRequest = getGooglePaymentDataRequest();
        // transactionInfo must be set but does not affect cache
        paymentDataRequest.transactionInfo = {
            totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
            currencyCode: 'USD'
        };
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.prefetchPaymentData(paymentDataRequest);
    }

    /**
     * Show Google Pay payment sheet when Google Pay payment button is clicked
     */
    function onGooglePaymentButtonClicked() {
        const paymentDataRequest = getGooglePaymentDataRequest();
        paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.loadPaymentData(paymentDataRequest)
            .then(function(paymentData) {
                console.log(paymentData);
                // handle the response
                processPayment(paymentData);
            })
            .catch(function(err) {
                // show error in developer console for debugging
                console.error(err);
            });
    }
    /**
     * Process payment data returned by the Google Pay API
     *
     * @param {object} paymentData response from Google Pay API after user approves payment
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
     */
    // function processPayment(paymentData) {
    //     // show returned data in developer console for debugging
    //     console.log(paymentData);
    //     // @todo pass payment token to your gateway to process payment
    //     // @note DO NOT save the payment credentials for future transactions,
    //     // unless they're used for merchant-initiated transactions with user
    //     // consent in place.
    //     paymentToken = paymentData.paymentMethodData.tokenizationData.token;
    // }
</script>


<!-- Custom Google Pay functions -->
<script defer>
    /**
     * Process payment data returned by the Google Pay API
     *
     * @param {object} paymentData response from Google Pay API after user approves payment
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
    */
    function processPayment(paymentData) {
        // show returned data in developer console for debugging
        console.log(paymentData);

        // Extract Google Pay payment token
        const paymentToken = paymentData.paymentMethodData.tokenizationData.token;

        // Pass payment token to your server for further processing
        sendPaymentTokenToServer(paymentToken);
    }

    // Function to send the payment token to your server
    function sendPaymentTokenToServer(paymentToken) {
        console.log(paymentToken);
        const formData = new FormData();




        // Handle request data

                /*
            The switchTabSchedule() is a mutated form of our original switchTab()
            It combines swtiching tabs according to the function arguments we provide
            with the validations necessary before the switch
        */
        
        // Validate
        var isSubject = document.querySelector('.selected-ad-subject') !== null;
        var expectation = document.getElementById('lesson_expectations').value;
        var message = document.getElementById('msg_student').value;
        var isLessonLengthSelected = document.querySelector('.component-checkbox-register.checked') !== null;
        var lesLength = document.querySelector('.component-checkbox-register.checked');
        var connected_account_id = document.getElementById('connected_account_id').value;
        
        var day = document.getElementById('day').textContent;
        var time = document.getElementById('time').textContent;

        console.log(day, time);

        if (lesLength) {
            var lengthValue = lesLength.querySelector('input').value;
            console.log('Lesson length id: ' + lengthValue);
        } else {
            console.log('Lesson length not selected');
        }




        // Message
        if(message) {
            $('#message-wrapper-outer').removeClass('invalid');
            $('#messageError').html('');
        }
        // Subject
        if(isSubject) {
            $('#subjects-wrapper-outer').removeClass('invalid');
            $('#subjectsError').html('');
        }
        // Expectation
        if(expectation) {
            $('#expectations-wrapper-outer').removeClass('invalid');
            $('#expectationsError').html('');
        }
        // Day
        if(day != 'Select Day') {
            $('#day-selector').removeClass('invalid');
            $('#dayError').html('');
        }
        // Time
        if(time != 'Select Time') {
            $('#time-selector').removeClass('invalid');
            $('#timeError').html('');
        }



        if (
            connected_account_id && isSubject && expectation && isLessonLengthSelected && 
            day != 'Select Day' &&
            time != 'Select Time'
        ) {
            
            


            // Subjects
            subIds = [];
            var subjectElems = document.querySelectorAll('div[data-subject-id]');
            subjectElems.forEach(subElem => {
                var subId = subElem.getAttribute('data-subject-id');
                subIds.push(subId);
            });
            var subJson = JSON.stringify(subIds);

            // Day Id
            var day = document.getElementById('day');
            var dayId = day.getAttribute('data-selected-value');

            // Time Id
            var time = document.getElementById('time');
            var timeId = time.getAttribute('data-selected-value');
            
            // Lesson Length
            var lesLengthChecked = document.querySelector('.component-checkbox-register.checked');
            var lesson_length = lesLengthChecked.getAttribute('data-length');
            
            // Ad Id
            var ad_id = document.getElementById('ad_id').value;
        
            // console.log(ad_id, message, expectation, subJson, dayId, timeId, lesson_length);


            formData.append('create_request', 'true');
            formData.append('request_type', 'regular');
            formData.append('ad_id', ad_id);
            formData.append('subjects', subJson);
            formData.append('message', message);
            formData.append('expectation', expectation);
            formData.append('day', dayId);
            formData.append('time', timeId);
            formData.append('lesson_length', lesson_length);


            formData.append('account_id', connected_account_id);
            formData.append('google_pay_payment_token', paymentToken);
            // Make an AJAX request to your server with the payment token
            // You can use libraries like Axios or Fetch for this purpose
            // Example using Fetch API:
            fetch('stripe-connect/subscription.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Handle the response from the server
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });



        } else {
            // Message
            if(!message) {
                $('#message-wrapper-outer').addClass('invalid');
                $('#messageError').html('<div>Field cannot be blank</div>');
            }
            // Subject
            if(!isSubject) {
                $('#subjects-wrapper-outer').addClass('invalid');
                $('#subjectsError').html('<div>Select a subject</div>');
            }
            // Expectation
            if(!expectation) {
                $('#expectations-wrapper-outer').addClass('invalid');
                $('#expectationsError').html('<div>Field cannot be blank</div>');
            }
            // Day
            if(day == 'Select Day') {
                $('#day-selector').addClass('invalid');
                $('#dayError').html('<div>Select a day</div>');
            }
            // Time
            if(time == 'Select Time') {
                $('#time-selector').addClass('invalid');
                $('#timeError').html('<div>Select a time</div>');
            }
            
            console.log('error');
        }
    }

    function createFreeLessonRequest() {
        const formData = new FormData();

        // Handle request data
        
        // Validate
        var isSubject = document.querySelector('.selected-ad-subject') !== null;
        var expectation = document.getElementById('lesson_expectations').value;
        var message = document.getElementById('msg_student').value;
        var isLessonLengthSelected = document.querySelector('.component-checkbox-register.checked') !== null;
        var lesLength = document.querySelector('.component-checkbox-register.checked');

        var day = document.getElementById('day').textContent;
        var time = document.getElementById('time').textContent;

        // console.log(day, time);

        if (lesLength) {
            var lengthValue = lesLength.querySelector('input').value;
            console.log('Lesson length id: ' + lengthValue);
        } else {
            console.log('Lesson length not selected');
        }

        // Message
        if(message) {
            $('#message-wrapper-outer').removeClass('invalid');
            $('#messageError').html('');
        }
        // Subject
        if(isSubject) {
            $('#subjects-wrapper-outer').removeClass('invalid');
            $('#subjectsError').html('');
        }
        // Expectation
        if(expectation) {
            $('#expectations-wrapper-outer').removeClass('invalid');
            $('#expectationsError').html('');
        }
        // Day
        if(day != 'Select Day') {
            $('#day-selector').removeClass('invalid');
            $('#dayError').html('');
        }
        // Time
        if(time != 'Select Time') {
            $('#time-selector').removeClass('invalid');
            $('#timeError').html('');
        }





        if (
            isSubject && expectation && isLessonLengthSelected && 
            day != 'Select Day' &&
            time != 'Select Time'
        ) {
            
            // Subjects
            subIds = [];
            var subjectElems = document.querySelectorAll('div[data-subject-id]');
            subjectElems.forEach(subElem => {
                var subId = subElem.getAttribute('data-subject-id');
                subIds.push(subId);
            });
            var subJson = JSON.stringify(subIds);


            // Day Id
            var day = document.getElementById('day');
            var dayId = day.getAttribute('data-selected-value');

            // Time Id
            var time = document.getElementById('time');
            var timeId = time.getAttribute('data-selected-value');
            
            // Lesson Length
            var lesLengthChecked = document.querySelector('.component-checkbox-register.checked');
            var lesson_length = lesLengthChecked.getAttribute('data-length');
            
            // Ad Id
            var ad_id = document.getElementById('ad_id').value;
        
            // console.log(ad_id, message, expectation, subJson, dayId, timeId, lesson_length);


            formData.append('create_request', 'true');
            formData.append('request_type', 'free');
            formData.append('ad_id', ad_id);
            formData.append('subjects', subJson);
            formData.append('message', message);
            formData.append('expectation', expectation);
            formData.append('day_id', dayId);
            formData.append('time_id', timeId);
            formData.append('lesson_length', lesson_length);

            // Make an AJAX request to your server with the payment token
            // You can use libraries like Axios or Fetch for this purpose
            // Example using Fetch API:
            fetch('controllers/request-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Handle the response from the server
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });



        } else {
            // Message
            if(!message) {
                $('#message-wrapper-outer').addClass('invalid');
                $('#messageError').html('<div>Field cannot be blank</div>');
            }
            // Subject
            if(!isSubject) {
                $('#subjects-wrapper-outer').addClass('invalid');
                $('#subjectsError').html('<div>Select a subject</div>');
            }
            // Expectation
            if(!expectation) {
                $('#expectations-wrapper-outer').addClass('invalid');
                $('#expectationsError').html('<div>Field cannot be blank</div>');
            }
            // Day
            if(day == 'Select Day') {
                $('#day-selector').addClass('invalid');
                $('#dayError').html('<div>Select a day</div>');
            }
            // Time
            if(time == 'Select Time') {
                $('#time-selector').addClass('invalid');
                $('#timeError').html('<div>Select a time</div>');
            }
            
            console.log('error');
        }
    }


    document.body.addEventListener('click', function(event) {
        if (event.target.id === 'gpay-container' || event.target.id === 'gpay-container-img') {
            console.log('Button clicked!');
            onGooglePaymentButtonClicked();
            // ... rest of the code
        }
    });
</script>


<script async
  src="https://pay.google.com/gp/p/js/pay.js"
  onload="onGooglePayLoaded()"></script>



</body>
</html>