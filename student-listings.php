<?php
    include './partials/header.php';
?>

<?php include './partials/nav-3.php'; ?>


<link rel="stylesheet" href="css/listings.css">


<style>
    .user-no-picture {
        width: 100%;
        height: 100%;
        font-size: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: rgb(255,145,77);
    }
</style>


<div class='s-page-wrapper' style='margin-top: 120px;'>
    <div class="s-container">
        
        <div class="row mb-4" style="max-width: 1400px; display: flex; flex-flow: row wrap; margin: 0 auto;">
            <div class="col-12">


                <!-- Filter options -->
                <div class='triggers'>
                    
                    <!-- Levels -->
                    <div class='dropdown-container'>
                        <div class='trigger level-trigger'>Levels</div>
                        <div class='filter-dropdown dropdown' id='levels-dropdown'>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-levels-id='401' value='A-Level' type="checkbox" id="custom-checkbox-401">
                                    <label for="custom-checkbox-401"></label>
                                </div>
                                <div class='checkbox-text'>
                                    A-Level
                                </div>
                            </div>
                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-levels-id='402' value='GSCE' type="checkbox" id="custom-checkbox-402">
                                    <label for="custom-checkbox-402"></label>
                                </div>
                                <div class='checkbox-text'>
                                    GSCE
                                </div>
                            </div>

                            <style>
                                .btns-wrapper {
                                    width: 100%; 
                                    padding: 8px 20px; 
                                    display: flex; 
                                    flex-flow: row nowrap; 
                                    justify-content: space-between; 
                                    margin-top: 20px;
                                }
                                .btn-validate {
                                    background: rgb(255, 145, 77);
                                    color: #fff;
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    font-size: 15px;
                                }
                                .btn-light-gray {
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    color: #fff;
                                    background: rgb(247,247,247);
                                    color: #121212;
                                    font-size: 15px;
                                }
                            </style>

                            
                            <div class='btns-wrapper'>
                                <span class='btn btn-light-gray btn-close' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('subject-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>


                    <!-- Subject -->
                    <div class='dropdown-container'>
                        <div class='trigger subject-trigger'>Subject</div>
                        <div class='filter-dropdown dropdown' id='subjects-dropdown'>

                            <?php
                                $ad = new Ad;
                                $ad->subject_filter_items();
                            ?>

                            <style>
                                .btns-wrapper {
                                    width: 100%; 
                                    padding: 8px 20px; 
                                    display: flex; 
                                    flex-flow: row nowrap; 
                                    justify-content: space-between; 
                                    margin-top: 20px;
                                }
                                .btn-validate {
                                    background: rgb(255, 145, 77);
                                    color: #fff;
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    font-size: 15px;
                                }
                                .btn-light-gray {
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    color: #fff;
                                    background: rgb(247,247,247);
                                    color: #121212;
                                    font-size: 15px;
                                }
                            </style>

                            
                            <div class='btns-wrapper'>
                                <span class='btn btn-light-gray btn-close' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('subject-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>


                    
                    <!-- Exam boards -->
                    <div class='dropdown-container'>
                        <div class='trigger board-trigger'>Exam boards</div>
                        <div class='filter-dropdown dropdown' id='boards-dropdown'>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-boards-id='201' value='Edexcel' type="checkbox" id="custom-checkbox-201">
                                    <label for="custom-checkbox-201"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Edexcel
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-boards-id='202' value='AQA' type="checkbox" id="custom-checkbox-202">
                                    <label for="custom-checkbox-202"></label>
                                </div>
                                <div class='checkbox-text'>
                                    AQA
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-boards-id='203' value='OCR' type="checkbox" id="custom-checkbox-203">
                                    <label for="custom-checkbox-203"></label>
                                </div>
                                <div class='checkbox-text'>
                                    OCR
                                </div>
                            </div>

                            <style>
                                .btns-wrapper {
                                    width: 100%; 
                                    padding: 8px 20px; 
                                    display: flex; 
                                    flex-flow: row nowrap; 
                                    justify-content: space-between; 
                                    margin-top: 20px;
                                }
                                .btn-validate {
                                    background: rgb(255, 145, 77);
                                    color: #fff;
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    font-size: 15px;
                                }
                                .btn-light-gray {
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    color: #fff;
                                    background: rgb(247,247,247);
                                    color: #121212;
                                    font-size: 15px;
                                }
                            </style>

                            
                            <div class='btns-wrapper'>
                                <span class='btn btn-light-gray btn-close' onclick="closePopup();">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('teaching-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>


                    <!-- Availibility -->
                    <style>
                        .daytime-container {
                            display: flex; 
                            flex-flow: column wrap;
                        }

                        .days, .times {
                            display: flex; 
                            flex-flow: row wrap;
                        }

                        .days .item, 
                        .times .item {
                            padding: 8px 16px;
                            height: 40px;
                            display: flex; 
                            align-items: center;
                            margin-right: 10px;
                            margin-bottom: 10px;
                            background-color: #eee;
                            cursor: pointer;
                            border-radius: 16px;

                            background: #fff;
                            border: 1px solid rgb(255, 145, 77);
                            color: rgb(255, 145, 77);
                        }
                        .days .item.active, 
                        .times .item.active {
                            color: #fff;
                            border: 1px solid rgb(255, 145, 77);
                            background: rgb(255, 145, 77);
                        }
                        .times .item {
                            height: auto;
                        }

                        .selected-schedule > div.selected-schedule-inner {
                            display: flex;
                            flex-flow: row wrap;
                            margin-right: 10px;
                            margin-bottom: 10px;
                            background-color: #eee;
                            padding: 20px;

                            background: #fff;
                            border: 1px solid rgb(255, 145, 77);
                            color: rgb(255, 145, 77);
                        }
                        .selected-schedule > div > .item:first-child {
                            margin-right: 0px;
                            margin-bottom: 0px;
                            border-radius: 0px;
                            background-color: transparent;
                        }
                        .selected-schedule > div > span {
                            margin-right: 0px;
                            margin-bottom: 0px;
                            border-radius: 0px;
                        }
                        .selected-schedule .item, .selected-schedule span {
                            height: 30px;
                            display: flex; 
                            align-items: center;
                            /* background-color: #eee; */
                            cursor: pointer;
                            border-radius: 16px;
                            margin-bottom: 0;
                        }
                        /* .selected-schedule span {
                            padding: 8px 16px;
                        } */
                        .selected-schedule span {
                            background: transparent;
                        }
                        .selected-schedule .item {
                            padding: 5px;
                            border: none;
                            background: transparent;
                            color: #000;
                        }
                        .selected-schedule .item:first-child {
                            padding: 5px;
                        }

                    </style>
                    <div class='dropdown-container'>
                        <div class='trigger board-trigger'>Availibility</div>
                        <div class='filter-dropdown dropdown'>
                            <?php
                                $ad = new Ad;
                                $ad->show_day_and_times_filter();
                            ?>
                        </div>
                    </div>

                    <script defer>
                        function filterDay(element, dayOfWeek) {
                            if(!element.classList.contains('active')) {
                                element.classList.add('active');
                                return;
                            } else {
                                element.classList.remove('active');
                                return;
                            }

                        }

                        function filterTime(element, timeOfDay) {
                            if(!element.classList.contains('active')) {
                                element.classList.add('active');
                                return;
                            } else {
                                element.classList.remove('active');
                                return;
                            }
                        }
                    </script>


                    
                    
                    <!-- Price -->
                    <div class='dropdown-container'>
                        <div class='trigger price-trigger'>Price</div>
                        <div class='filter-dropdown dropdown'>

                            <div id="range-container">
                                <div id="range"></div>
                                <p id='price' id="rangeValues">$<span id="priceMinValue"></span> - <span id="priceMaxValue"></span></p>
                            </div>

                            <div class='btns-wrapper' style='margin-top: 10px;'>
                                <span class='btn btn-light-gray btn-close' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('price-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>

                    <!-- Teaching style -->
                    <div class='dropdown-container'>
                        <div class='trigger teaching-trigger'>Teaching style</div>
                        <div class='filter-dropdown dropdown' id='teaching-dropdown'>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-teaching-id='101' value='teacher-centered' type="checkbox" id="custom-checkbox-101">
                                    <label for="custom-checkbox-101"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Teacher-centered
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-teaching-id='102' value='student-centered' type="checkbox" id="custom-checkbox-102">
                                    <label for="custom-checkbox-102"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Student-centered
                                </div>
                            </div>

                            <style>
                                .btns-wrapper {
                                    width: 100%; 
                                    padding: 8px 20px; 
                                    display: flex; 
                                    flex-flow: row nowrap; 
                                    justify-content: space-between; 
                                    margin-top: 20px;
                                }
                                .btn-validate {
                                    background: rgb(255, 145, 77);
                                    color: #fff;
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    font-size: 15px;
                                }
                                .btn-light-gray {
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    color: #fff;
                                    background: rgb(247,247,247);
                                    color: #121212;
                                    font-size: 15px;
                                }
                            </style>

                            
                            <div class='btns-wrapper'>
                                <span class='btn btn-light-gray btn-close' onclick="closePopup();">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('teaching-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>
                            

                    <!-- Recorded Lesson -->
                    <span class='filter-trigger' data-key='location_3' data-value='3' onclick="select_filter(this)">Recorded Lesson</span>


                    <!-- Degree name -->
                    <div class='dropdown-container'>
                        <div class='trigger board-trigger'>Degree name</div>
                        <div class='filter-dropdown dropdown' id='degrees-dropdown'>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-degrees-id='301' value='degree' type="checkbox" id="custom-checkbox-301">
                                    <label for="custom-checkbox-301"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Degree
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-degrees-id='302' value='a-level' type="checkbox" id="custom-checkbox-302">
                                    <label for="custom-checkbox-302"></label>
                                </div>
                                <div class='checkbox-text'>
                                    A-level
                                </div>
                            </div>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-degrees-id='303' value='gcse' type="checkbox" id="custom-checkbox-303">
                                    <label for="custom-checkbox-303"></label>
                                </div>
                                <div class='checkbox-text'>
                                    GCSE
                                </div>
                            </div>

                            <style>
                                .btns-wrapper {
                                    width: 100%; 
                                    padding: 8px 20px; 
                                    display: flex; 
                                    flex-flow: row nowrap; 
                                    justify-content: space-between; 
                                    margin-top: 20px;
                                }
                                .btn-validate {
                                    background: rgb(255, 145, 77);
                                    color: #fff;
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    font-size: 15px;
                                }
                                .btn-light-gray {
                                    border-radius: 30px;
                                    padding: 10px 50px;
                                    color: #fff;
                                    background: rgb(247,247,247);
                                    color: #121212;
                                    font-size: 15px;
                                }
                            </style>

                            
                            <div class='btns-wrapper'>
                                <span class='btn btn-light-gray btn-close' onclick="closePopup();">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('teaching-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>
                            
                    <style>
                        .filter-trigger.active {
                            background: rgb(255, 145, 77);
                            color: #fff;
                        }
                    </style>
                    
                    <!-- <span class='filter-trigger' data-key='location_1' data-value='1' onclick="select_filter(this)">Online</span>
                    <span class='filter-trigger' data-key='location_2' data-value='2' onclick="select_filter(this)">In person</span> -->
                            


                    <!-- <div class='dropdown-container'>
                        <div class='trigger rating-trigger'>Rating</div>
                        <div class='filter-dropdown dropdown'>

                            <div id="range-container">
                                <div id="range2"></div>
                                <p id='rating' id="rangeValues"><span id="ratingMinValue"></span> - <span id="ratingMaxValue"></span></p>
                            </div>

                            <div class='btns-wrapper' style='margin-top: 10px;'>
                                <span class='btn btn-light-gray btn-close' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('rating-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div> -->

                    
                    


                </div>
            </div>
        </div>





        <style>
            #listings-row {
                max-width: 1600px; 
                display: flex; 
                flex-flow: row wrap; 
                margin: 0 auto;
            }
            .profile-infos {
                position: relative;
                width: 19%;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0,0,0,.125);
                margin-right: 10px;
                margin-bottom: 20px;
                border-radius: 5px;
                padding: 20px 15px 20px 15px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .profile-infos .firstname {
                margin: 0 0 5px 0;
                font-size: 18px;
                font-weight: 700;
                color: #393939;
                line-height: normal;
                letter-spacing: normal;
            }
            .profile-infos .lastname {
                margin: 0;
                font-size: 15px;
                font-weight: 500;
                color: #b1b1b1;
                line-height: normal;
                letter-spacing: normal;
            }

            /* Header icons */
            .profile-header {
                display: flex;
                flex-flow: row nowrap;
                align-items: flex-start;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .header-icons {
                display: flex;
                flex-flow: row nowrap;
                align-items: center;
                justify-content: flex-end;
            }
            .header-icons i {
                font-size: 30px;
            }
            .header-icons i.icofont-heart {    
                color: rgb(277, 0, 0);
            }
                            
            /* Middle */
            .middle {
                display: flex;
                flex-flow: row nowrap;
                align-items: center;
            }
            .details {
                padding: 20px 10px;
            }
            
            .hourly-price {
                font-size: 16px; 
                font-weight: 600;
                margin: 0px auto 5px auto;
            }
            
            .img-wrapper {
                width: 130px;
                height: 130px;
                margin-right: 10px;
                overflow: hidden;
                border-radius: 32px;
            }
            .img-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transform-origin: center;
            }

            /* Reviews */
            .review {
                display: flex;
                flex-flow: row nowrap;
                font-size: 12px;
                text-align: center;
                margin: 0px auto 10px auto;
                line-height: 1;
            }
            .rating {
                display: flex;
                flex-flow: row nowrap;
                align-items: center;
                margin-right: 10px;
                font-size: 32px;
                margin-left: -8px;
            }
            .num-of-reviews {
                display: flex;
                align-items: center;
                text-align: left;
                line-height: 1.1;
            }
            .review .icon-star2 {
                font-size: 32px;
                /* color: rgb(255, 181, 0); */
                color: rgb(255, 145, 77);
            }
            ul.infos {
                margin-top: 32px;
            }
            .infos li {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                margin-bottom: 16px;
            }
            .infos li .value {
                font-size: 20px;
                font-weight: 800;
            }

            .middle-icons {
                display: flex;
                flex-flow: row nowrap;
                border: 1px solid #fff;
            }
            .middle-icons span {
                width: 50%;
                padding: 10px 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .middle-icons span i {
                font-size: 16px;
                line-height: 1;
            }
            .middle-icons span:first-child {
                border-right: 1px solid gray;
            }
     
            .user-details {
                margin: 10px 10px 20px 10px;
            }
            .user-details .info-row {
                display: flex;
                flex-flow: row nowrap;
                align-items: center;
                font-size: 25px;
            }
            .user-details .info-row .degree {
                margin-top: 5px;
                font-size: 15px;
            }
            .info-icon {
                margin-right: 10px;
            }
            .info-icon i {
                font-size: 18px;
            }


            .btns-footer {
                padding: 10px 0px 0 0px; 
                display: flex; 
                flex-flow: row nowrap;
            }
            a.btn-validate {
                display: flex;
                height: 45px;
                color: #fff !important;
                padding: 10px 20px;
                text-align: center;
                justify-content: center;
                align-items: center;
                font-size: 13px;
                width: 180px;
            }
            a.btn-validate:first-child {
                margin-right: 5px;
            }
            a.btn-validate.btn-2 {
                width: 120px;
                border: 1px solid rgb(255, 145, 77);
                background: #fff;
                color: rgb(255, 145, 77) !important;
            }
        </style>


        <div id='listings-row'>

            <?php
                if(isset($_POST['search'])) {

                    // Check account type
                    if($_POST['account_type'] == 'student') {
                        $subject_id = $_POST['student_subject_id']; 
                        $level_id = $_POST['student_level_id'];

                        $ad = new Ad;
                        $ad->search_student_profiles($subject_id, $level_id);
                    }

                } else {
                    $ad = new Ad;
                    $ad->student_listing();
                }
            ?>

            

        </div>


    </div>



</div>







<!-- Range -->
<script>
    $(function() {
        // Initialize the slider
        $("#range").slider({
            range: true, // Enable range mode
            min: 0,
            max: 100,
            values: [25, 75], // Initial values for the handles
            slide: function(event, ui) {
                // Update displayed values
                $("#priceMinValue").text(ui.values[0]);
                $("#priceMaxValue").text(ui.values[1]);
            }
        });
        $("#range2").slider({
            range: true, // Enable range mode
            min: 0,
            max: 5,
            values: [0, 5], // Initial values for the handles
            slide: function(event, ui) {
                // Update displayed values
                $("#ratingMinValue").text(ui.values[0]);
                $("#ratingMaxValue").text(ui.values[1]);
            }
        });

        // Display initial values
        $("#priceMinValue").text($("#range").slider("values", 0));
        $("#priceMaxValue").text($("#range").slider("values", 1));
        $("#ratingMinValue").text($("#range2").slider("values", 0));
        $("#ratingMaxValue").text($("#range2").slider("values", 1));
    });
</script>

<script defer>
    function collectAndEncodeDay() {
        // Collect active days
        const activeDaysArray = [];
        const activeDayElements = document.querySelectorAll('.days .item.active');

        activeDayElements.forEach(dayElement => {
            const id = dayElement.getAttribute('data-day-id');
            const day = dayElement.textContent;
            activeDaysArray.push({ id, day });
        });

        // JSON encode the arrays
        const encodedActiveDays = JSON.stringify(activeDaysArray);
        console.log('Encoded Active Days:', encodedActiveDays);
        return encodedActiveDays;
    }
    function collectAndEncodeTime() {
        // Collect active times
        const activeTimesArray = [];
        const activeTimeElements = document.querySelectorAll('.times .item.active');

        activeTimeElements.forEach(timeElement => {
            const id = timeElement.getAttribute('data-time-id');
            const time = timeElement.textContent;
            activeTimesArray.push({ id, time });
        });

        // JSON encode the arrays
        const encodedActiveTimes = JSON.stringify(activeTimesArray);
        console.log('Encoded Active Times:', encodedActiveTimes);
        return encodedActiveTimes;
    }

    // Example usage
    // You can call collectAndEncodeDayAndTime() when you need to collect and encode the active days and times.
    // For example, you might want to call it when a submit button is clicked or during form submission.

    // Example:
    // collectAndEncodeDayAndTime();

    function collectAndEncodeValues(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]:checked');
        const valuesArray = [];

        checkboxes.forEach(checkbox => {
            valuesArray.push({
                id: checkbox.getAttribute('data-' + dropdownId.replace('-dropdown', '') + '-id'),
                value: checkbox.value
            });
        });

        const encodedValues = JSON.stringify(valuesArray);
        console.log(encodedValues);
        return encodedValues;

        // You can now append the encodedValues to a form or use it as needed
        // For example, assuming you have a form with id 'myForm'
        // document.getElementById('myForm').append('encodedValues', encodedValues);
    }

    function select_filter(el) {
        if(!el.classList.contains('active')) {
            el.classList.add('active');
            console.log(el.getAttribute(['data-value']));


            var formData = new FormData();

            // Price range
            const priceMin = $('#priceMinValue').text();
            const priceMax = $('#priceMaxValue').text();

            // Rating range
            const ratingMin = $('#ratingMinValue').text();
            const ratingMax = $('#ratingMaxValue').text();

            formData.append('price_min', priceMin);
            formData.append('price_max', priceMax);
            formData.append('rating_min', ratingMin);
            formData.append('rating_max', ratingMax);

            // Locations
            const filTriggers = $('.filter-trigger');

            for(i=0; i < filTriggers.length; i++ ) {
                if(filTriggers[i].classList.contains('active')) {
                    var key = filTriggers[i].getAttribute(['data-key']);
                    var val = filTriggers[i].getAttribute(['data-value']);
                    // console.log(key, val);
                    formData.append(key, val);
                }
            }


            // Subjects
            var subjectsArray = [];

            // Iterate over checkboxes
            $('input[type="checkbox"]').each(function() {
                if ($(this).prop('checked')) {
                    // If checkbox is checked, add data-subject-id to array
                    var subjectId = $(this).data('subject-id');
                    subjectsArray.push(subjectId);
                }
            });

            formData.append('subjects', JSON.stringify(subjectsArray));



            fetch('./filtered-listing.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                $('#listings-row').html(response);
            });
            return;
        }
        el.classList.remove('active');

        var formData = new FormData();

        // Price range
        const priceMin = $('#priceMinValue').text();
        const priceMax = $('#priceMaxValue').text();

        // Rating range
        const ratingMin = $('#ratingMinValue').text();
        const ratingMax = $('#ratingMaxValue').text();

        formData.append('price_min', priceMin);
        formData.append('price_max', priceMax);
        formData.append('rating_min', ratingMin);
        formData.append('rating_max', ratingMax);

        // Locations
        const filTriggers = $('.filter-trigger');

        for(i=0; i < filTriggers.length; i++ ) {
            if(filTriggers[i].classList.contains('active')) {
                var key = filTriggers[i].getAttribute(['data-key']);
                var val = filTriggers[i].getAttribute(['data-value']);
                // console.log(key, val);
                formData.append(key, val);
            }
        }


        // Subjects
        var subjectsArray = [];

        // Iterate over checkboxes
        $('input[type="checkbox"]').each(function() {
            if ($(this).prop('checked')) {
                // If checkbox is checked, add data-subject-id to array
                var subjectId = $(this).data('subject-id');
                subjectsArray.push(subjectId);
            }
        });

        formData.append('subjects', JSON.stringify(subjectsArray));



        fetch('./filtered-listing.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            $('#listings-row').html(response);
        });
    }

    function apply_filter(className) {

        var formData = new FormData();

        var degrees = collectAndEncodeValues('degrees-dropdown');
        var teaching = collectAndEncodeValues('teaching-dropdown');
        var boards = collectAndEncodeValues('boards-dropdown');
        var subjects = collectAndEncodeValues('subjects-dropdown');
        var levels = collectAndEncodeValues('levels-dropdown');

        var days = collectAndEncodeDay();
        var times = collectAndEncodeTime();

        // Add 'filtering' class when a filter input is applied
        if(!$('.'+className).hasClass('filtering')) {
            $('.'+className).addClass('filtering');
        }

        // Price range
        const priceMin = $('#priceMinValue').text();
        const priceMax = $('#priceMaxValue').text();

        console.log(priceMin, priceMax);


        formData.append('degrees', degrees);
        formData.append('teaching', teaching);
        formData.append('boards', boards);
        formData.append('subjects', subjects);
        formData.append('levels', levels);
        formData.append('days', days);
        formData.append('times', times);


        // formData.append('price_min', priceMin);
        // formData.append('price_max', priceMax);
        // // Locations
        // const filTriggers = $('.filter-trigger');

        // for(i=0; i < filTriggers.length; i++ ) {
        //     if(filTriggers[i].classList.contains('active')) {
        //         var key = filTriggers[i].getAttribute(['data-key']);
        //         var val = filTriggers[i].getAttribute(['data-value']);
        //         // console.log(key, val);
        //         formData.append(key, val);
        //     }
        // }


        fetch('./filtered-listing.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            $('#listings-row').html(response);
            closeAllDropdowns();
            // console.log(response);
        });
    }
    
</script>


<script defer>

    function closeAllDropdowns() {
        const dropdownTriggers = document.querySelectorAll('.trigger');
        const dropdowns = document.querySelectorAll('.dropdown');
        const popBg = document.getElementById('popBg');

        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });

        dropdownTriggers.forEach(trigger => {
            trigger.classList.remove('active');
        });

        popBg.classList.remove('dark');
        popBg.classList.add('light');
    }
    
    const dropdownTriggers = document.querySelectorAll('.trigger');
    const popBg = document.getElementById('popBg');
    const closeBtnsAll = document.querySelectorAll('.btn-close');

    popBg.addEventListener('click', function (event) {
        closeAllDropdowns();
    });


    closeBtnsAll.forEach(btn => {   
        btn.addEventListener('click', function (event) {
            closeAllDropdowns();
        });   
    });

    function dropdown() {
        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', function (event) {
                const clickedElement = event.target;
                const isFilterOption = clickedElement.classList.contains('trigger');  
    
                if (isFilterOption) {
                    const dropdown = clickedElement.nextElementSibling;
                    
                    if (dropdown.classList.contains('active')) {
                        clickedElement.classList.remove('active');
                        dropdown.classList.remove('active');
                        popBg.classList.remove('dark');
                        popBg.classList.add('light');
                    } else {
                        clickedElement.classList.add('active');
                        dropdown.classList.add('active');
                        popBg.classList.remove('light');
                        popBg.classList.add('dark');
                    }
                }
            });
        });
    }
    dropdown();


</script>

<script defer>
    // Usage: Call the function with the class name you want to target
    toggleClassOnMouseOver('img-wrapper');
</script>




</body>
</html>