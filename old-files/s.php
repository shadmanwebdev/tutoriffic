<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
    // $user = new User();
    // $user->ads();
    // var_dump($_POST);
?>
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>

<!-- Range -->
<style>
    #range-container {
        margin: 20px;
    }
    .ui-widget.ui-widget-content {
        margin-bottom: 10px;
        height: 7px;
        background: #e9ecef;
        border: none;
    }
    .ui-state-default, .ui-widget-content .ui-state-default, 
    .ui-widget-header .ui-state-default, .ui-button, 
    html .ui-button.ui-state-disabled:hover, 
    html .ui-button.ui-state-disabled:active {
        background: #fff !important;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 3px solid rgb(255,145,77);
        border-radius: 50%;
        height: 20px;
        width: 20px;
        outline: none;
    }
    .ui-slider-horizontal .ui-slider-range {
        box-shadow: none;
        height: 7px;
        background: rgb(255,145,77);
        border: none;
    }
</style>

<!-- Listing -->
<style>
    .s-page-wrapper {
        /* max-width: 900px; */
        margin: 150px auto;
    }
    @media screen and (max-width: 1200px) {
        .s-page-wrapper {
            padding: 0 20px;
        }
    }

    .listing-item {
        border-radius: 32px;
        border: 1px solid #d9d9d9;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .img-wrapper {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }
    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform-origin: center;
    }
    .img-wrapper.m-on img {
        animation: .3s animateImg ease-in-out forwards;
    }
    .img-wrapper.m-off img {
        animation: .3s animateImgBack ease-in-out forwards;
    }
    @keyframes animateImg {
        0% {    
            transform: scale(1);
        }
        100% { 
            transform: scale(1.2);
        }
    }
    @keyframes animateImgBack {
        0% {    
            transform: scale(1.2);
        }
        100% { 
            transform: scale(1);
        }
    }
    .listing-body {
        padding: 20px 30px 30px 30px;
    }
    .review {
        font-size: 15px;
        margin-bottom: 10px;
    }
    .icon-star2 {
        color: rgb(255, 181, 0);
    }
    p.summary {
        margin-bottom: 15px;
        font-size: 15px;
        line-height: 1.8;
    }
    .price span {
        padding: 5px 12px;
        color: rgb(255,145,77);
        background-color: #FFEDE3;
        font-size: 14px;
        border-radius: 16px;
    }

    .listing-header {
        position: relative;
    }
    .img-wrapper:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #000;
        opacity: .3;
        z-index: 10;
    }
    .listing-meta {
        padding: 20px 30px; 
        position: absolute; 
        z-index: 10; 
        bottom: 0; 
        color: #fff;
    }
    .listing-meta .fname {
        font-size: 20px; 
        color: #fff; 
        font-weight: bold; 
        margin-bottom: 0px; 
        line-height: 1.6;
    }
    .listing-meta span {
        font-size: 14px;
    }
</style>

<!-- Dropdown -->
<style>
    .triggers {
        display: flex;
        flex-flow: row wrap;
    }

    .dropdown-container {
        position: relative;
        min-width: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
    }


    .trigger, span.filter-trigger {
        padding: 10px 20px;
        color: #fff;
        color: rgb(255,145,77);
        background-color: #fff;
        font-size: 14px;
        border-radius: 32px;
        margin-right: 10px;
        border: 1px solid rgb(255,145,77);
        cursor: pointer;
    }
    
    .trigger {
        cursor: pointer;
        width: 100%;
        text-align: center;
    }
    span.filter-trigger {
        text-align: center;
        min-width: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .filter-dropdown {
        width: 408px;
        height: auto;
        -webkit-border-radius: 32px;
        border-radius: 32px;
        /* display: block; */
        background-color: #fff;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        padding: 30px;
        border: 1px solid #d9d9d9;
    }

    .dropdown {
        display: none;
        position: absolute;
        z-index: 2;
        top: 100%; /* Position below the filter option */
        left: 0;
    }
    /* Active */
    .trigger.active {
        display: block;
        position: absolute;
        z-index: 1000;
    }
    .dropdown.active {
        display: block;
        position: absolute;
        top: 50px;
        z-index: 1000;
    }
    .trigger.filtering {
        background: rgb(255, 145, 77);
        color: #fff;
    }
</style>

<!-- Checkbox -->
<style>
    .custom-checkbox {
        padding: 8px 20px;
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

<div class='s-page-wrapper'>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class='triggers'>
                    <div class='dropdown-container'>
                        <div class='trigger price-trigger'>Price</div>
                        <div class='filter-dropdown dropdown'>

                            <div id="range-container">
                                <div id="range"></div>
                                <p id='price' id="rangeValues">$<span id="priceMinValue"></span> - <span id="priceMaxValue"></span></p>
                            </div>

                            <div class='btns-wrapper' style='margin-top: 10px;'>
                                <span class='btn btn-light-gray' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('price-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>

                    <div class='dropdown-container'>
                        <div class='trigger subject-trigger'>Subject</div>
                        <div class='filter-dropdown dropdown'>

                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-subject-id='1' type="checkbox" id="custom-checkbox">
                                    <label for="custom-checkbox"></label>
                                </div>
                                <div class='checkbox-text'>
                                    All
                                </div>
                            </div>
                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-subject-id='2' type="checkbox" id="custom-checkbox-2">
                                    <label for="custom-checkbox-2"></label>
                                </div>
                                <div class='checkbox-text'>
                                    Maths
                                </div>
                            </div>
                            <div class='custom-checkbox'>
                                <div class='custom-checkbox-inner'>
                                    <input data-subject-id='3' type="checkbox" id="custom-checkbox-3">
                                    <label for="custom-checkbox-3"></label>
                                </div>
                                <div class='checkbox-text'>
                                    English
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
                                <span class='btn btn-light-gray' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('subject-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>
                            
                    <style>
                        .filter-trigger.active {
                            background: rgb(255, 145, 77);
                            color: #fff;
                        }
                    </style>
                    
                    <span class='filter-trigger' data-key='location_1' data-value='1' onclick="select_filter(this)">Online</span>
                    <span class='filter-trigger' data-key='location_2' data-value='2' onclick="select_filter(this)">In person</span>
                            


                    <div class='dropdown-container'>
                        <div class='trigger rating-trigger'>Rating</div>
                        <div class='filter-dropdown dropdown'>

                            <div id="range-container">
                                <div id="range2"></div>
                                <p id='rating' id="rangeValues"><span id="ratingMinValue"></span> - <span id="ratingMaxValue"></span></p>
                            </div>

                            <div class='btns-wrapper' style='margin-top: 10px;'>
                                <span class='btn btn-light-gray' onclick="prevStep()">Cancel</span>
                                <span class='btn btn-validate' onclick="apply_filter('rating-trigger')">Apply</span>
                            </div>
                        
                        </div>
                    </div>

                    
                    <span class='filter-trigger' data-key='location_3' data-value='3' onclick="select_filter(this)">Recorded Lesson</span>


                </div>
            </div>
        </div>

        <div class="row" id='listings-row'>
            <?php
                if(!isset($_POST['search'])) {
                    $ad = new Ad();
                    $ad->ads();
                } else {
                    if(isset($_POST['account_type'])) {
                        if($_POST['account_type'] == 'tutor') {
                            $ad = new Ad();
                            $ad->searched_ads($_POST['subject']);
                        } else if($_POST['account_type'] == 'student') {
                            $user = new User();
                            $user->searched_students($_POST['subject']);
                        }
                    }
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

        // Add 'filtering' class when a filter input is applied
        if(!$('.'+className).hasClass('filtering')) {
            $('.'+className).addClass('filtering');
        }

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

    popBg.addEventListener('click', function (event) {
        closeAllDropdowns();
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