<?php
    include './partials/header.php';
    require 'vendor/autoload.php';
?>

<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>
    

<link rel="stylesheet" href="css/index.css">



<!-- COVER -->
<div id='find-a-tutor' class='site-block-cover overlay d-flex align-items-center justify-content-center' id='home-section'>
    <div class='inner-div'>
        <div class='row d-flex align-items-center' style='justify-content: space-between;'>
            <div class='cover-wrapper col-md-5 col-lg-5'>


                <h1 class='typed-words'>
                    Find Your <br>Perfect Tutor
                </h1>

                <div class='search-form-wrapper'>          
                    <div>

                        <div class='form-search-wrap p-2' data-aos='fade-up' data-aos-delay='200'>
                            


                            <form method='post' action='./tutor-listings'>
                                <input type='hidden' name='account_type' value='tutor' />
                                <div class='form-inner-div'>
                                    <span class='icon icon-search search-span'></span>
                                    <div class='input-wrapper no-sm-border border-right'>
                                        <div class='wrap-icon' style='position: relative;'>
                                            <input type="hidden" class='selected-id' name='tutor_subject_id' id='tutor_subject_id'>
                                            <input name='subject' type='text' class='form-control search-input' placeholder='Subject' data-dropdown='subject'>
                                            <ul class='custom-dropdown' id='subjectDropdown' style='max-height: 250px; overflow: scroll; overflow-x: hidden;'>
                                                <!-- Dropdown items for Subject -->
                                                <!-- <li>Maths</li>
                                                <li>English</li>
                                                <li>Spanish</li> -->

                                                <?php
                                                    $ad = new Ad;
                                                    $ad->search_dropdown_subjects();
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='input-wrapper'>
                                        <div class='wrap-icon' style='position: relative;'>
                                            <input type="hidden" class='selected-id' name='tutor_level_id' id='tutor_level_id'>
                                            <input name='level' style='padding-left: 20px;' type='text' class='form-control search-input' placeholder='Level' data-dropdown='level'>
                                            <ul class='custom-dropdown' id='levelDropdown'>
                                                <!-- Dropdown items for Level -->
                                                <!-- <li>GCSE</li>
                                                <li>A-Level</li> -->
                                                <?php
                                                    $ad->search_dropdown_levels();
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                            
                                    <input name='search' type='submit' class='form-btn btn text-white' value='Search'>
                                </div>
                            </form>
                    

                        </div>



                    </div>
                </div>        
            
            </div>
            <div class='cover-wrapper col-md-5 col-lg-5'>


                <h1 class='typed-words'>
                    Find Your <br>Perfect Student
                </h1>

                <div class='search-form-wrapper'>          
                    <div>

                        <div class='form-search-wrap p-2' data-aos='fade-up' data-aos-delay='200'>
                            
                            <form method='post' action='./student-listings'>
                                <input type='hidden' name='account_type' value='student' />
                                <div class='form-inner-div'>
                                    <span class='icon icon-search search-span'></span>
                                    <div class='input-wrapper no-sm-border border-right'>
                                        <div class='wrap-icon' style='position: relative;'>
                                            <input type="hidden" class='selected-id' name='student_subject_id' id='student_subject_id'>
                                            <input name='subject' type='text' class='form-control search-input' placeholder='Subject' data-dropdown='subject2'>
                                            <ul class='custom-dropdown' id='subject2Dropdown' style='max-height: 250px; overflow: scroll; overflow-x: hidden;'>
                                                <!-- Dropdown items for Subject -->
                                                <!-- <li>Maths</li>
                                                <li>English</li>
                                                <li>Spanish</li> -->

                                                <?php
                                                    $ad = new Ad;
                                                    $ad->search_dropdown_subjects();
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='input-wrapper'>
                                        <div class='wrap-icon' style='position: relative;'>
                                            <input type="hidden" class='selected-id' name='student_level_id' id='student_level_id'>
                                            <input name='level' style='padding-left: 20px;' type='text' class='form-control search-input' placeholder='Level' data-dropdown='level2'>
                                            <ul class='custom-dropdown' id='level2Dropdown'>
                                                <!-- Dropdown items for Level -->                                                 <!-- Dropdown items for Level -->
                                                <!-- <li>GCSE</li>
                                                <li>A-Level</li> -->
                                                <?php
                                                    $ad->search_dropdown_levels();
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                            
                                    <input name='search' type='submit' class='form-btn btn text-white' value='Search'>
                                </div>
                            </form>
                


                    
                        </div>



                    </div>
                </div>



                    
            
            </div>
        </div>
    </div>
</div>



<!-- What we do -->
<div class='container' id='what-we-do-section'>
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-12 heading-section text-left ftco-animate">
            <h2 class="mb-4 mr-5"><span>What<br></span><span>we do</span></h2>
        </div>
        <div class="col-lg-9 col-md-12 what-we-do-col">
            <div class='what-we-do'>
                <div class='text'>
                    <p class='title'>Find a tutor</p>
                    <ul class='features'>
                        <li>Tutors from around the world</li>
                        <li>Schedule with us</li>
                        <li>Qualified & experienced</li>
                        <li><span>Trust <i class='ion-ios-arrow-thin-right'></i></span> Backgrounds checked & terms and conditions signed</li>
                        <li>Filter to find the perfect tutor</li>
                        <li><span>Help from us <i class='ion-ios-arrow-thin-right'></i></span> Customer service support</li>
                    </ul>
                </div>
                <div class='what-we-do-image'>
                    <img src="./assets/what-we-do-1.jpg" alt="Tutor">
                </div>
            </div>
            <div class='what-we-do'>
                <div class='text'>
                    <p class='title'>Find a student</p>
                    <ul class='features'>
                        <li>Sign up as a student, then let tutors find you (Don't worry we won't your pic, just your first name)</li>
                        <li>We think tutor reaching out to students can be better. Also helps tutors to be found from 1000's of tutors</li>
                        <li>All students are verified</li>
                    </ul>
                </div>
                <div class='what-we-do-image'>
                    <img src="./assets/what-we-do-2.png" alt="Tutor">
                </div>
            </div>
            <div class='what-we-do'>
                <div class='text'>
                    <p class='title'>Find a tution centre</p>
                    <ul class='features'>
                        <li>Find a centre near you in your price range</li>
                        <li>Schedule with us</li>
                        <li>Tution owners get access to tutors & students that are verified</li>
                    </ul>
                </div>
                <div class='what-we-do-image'>
                    <img src="./assets/what-we-do-3.jpg" alt="Tutor">
                </div>
            </div>
        </div>
    </div>
</div>
    

<!-- How it works -->
<div class='container' id='how-it-works'>
    <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-left ftco-animate">
            <h2 class="mb-4">How It Works</h2>
        </div>
    </div>
    <div class='row d-flex justify-content-end'>
        <div class="col-lg-5 col-md-12 how-it-works-col">
            <div class="how-it-works-box" style='margin-bottom: 20px;'>
                <div class="steps-text">
                    <span>1. Search</span>
                    <p>View profiles freely and contact fantastic tutors according to your needs (prices, qualifications, reviews, lessons at home or by webcam)</p>
                </div>
    
                <div class="box1">
                    <div class="box-wrapper">
                        <div class="box2"><h2></h2></div>
                        <div class="box3" style='display: flex; align-items: center; justify-content: center;'>
                            <span style='color: #fff;' class="icon icon-search"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="how-it-works-box d-lg-none">

                <div class="steps-text">
                    <span>2. Message</span>
                    <p>Tutors will get back to you within hours! And if you can't find the perfect tutor our team is here to help.</p>
                </div>
                <style>
                    .mbox {
                        display: flex; 
                        flex-flow: row nowrap; 
                        align-items: end;
                    }
                    .circle {
                        width: 18px;
                        height: 18px;
                        border-radius: 50%;
                        margin-bottom: 10px;
                    }
                    .mbox1 .circle {
                        background-color: rgb(255,74,82);
                        margin-right: 10px;
                    }
                    .mbox2 .circle {
                        background-color: rgb(1,112,255);
                        margin-left: 10px;
                    }
                    .mbox3 .circle {
                        background-color: rgb(255,74,82);
                        margin-right: 10px;
                    }
                </style>
                <div class="mes-ani-wrapper">
                    <div class="cropped-wrapper" >
                        <div class="mbox1 mbox">
                            <span class='circle'></span>
                            <i class="fas icon-chat"></i>
                        </div>
                        <div class="mbox2 mbox">
                            <i class="fas icon-chat"></i>
                            <span class='circle'></span>
                        </div>
                        <div class="mbox3 mbox">
                            <span class='circle'></span>
                            <i class="fas icon-chat"></i>
                        </div>
                    </div>
                </div>


            </div>
            <div class="how-it-works-box">
                
                <div class="steps-text">
                    <span>3. Organise</span>
                    <p>Schedule your lessons with your tutor or coach from your dashboard.</p>
                </div>


                <style>
                    #boxA {
                        width: 300px;
                        height: 300px;
                        background-color: rgb(255,238,241);
                        position: relative;
                        border-radius: 24px;
                        overflow: hidden;
                    }
                    
                    #boxB {
                        width: 100px;
                        height: 100px;
                        background-color: red;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        margin-left: -50px;
                        margin-top: -50px;
                        z-index: 10000;
                        transform: scale(0);
                        opacity: 0;
                        animation: 6s a1 infinite;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: #fff;
                        font-size: 25px;
                        font-weight: bold;
                        border-radius: 24px;
                    }
                    #ques {
                        border: 1px solid red;
                        background-color: transparent;
                        color: red;
                        width: 30px;
                        height: 30px;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        margin-left: -15px;
                        margin-top: -15px;
                        z-index: 10000;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;

                        transform: translateX(-200px);
                        opacity: 0;
                        animation: 6s a2 infinite;
                    }

                    @keyframes a2 {
                        /* 
                            question starts from left with opacity 0;
                        */
                        0% {
                            
                            transform: translateX(-200px);
                            opacity: 1;
                        }
                        /* 
                            question remains where it is thus giving time for the box to appear
                        */
                        10% {
                            transform: translateX(-200px);
                            opacity: 1;
                        }
                        /* 
                            10% -25%
                            question moves to the right
                        */
                        25% {
                            transform: translateX(-80px);
                        }
                        /* 
                            25% - 50%
                            question moves further to the right
                        */
                        50% {
                            transform: scale(1) translateX(-50px);
                        }
                        /* 
                            50% - 75%
                            question moves back to the left
                        */
                        75% {
                            transform: scale(1) translateX(-70px);
                            opacity: 1;
                        }
                        /* 
                            75% - 76%
                            question disappears
                        */
                        76% {
                            opacity: 0;
                        }
                        /* 
                            76% - 100%
                            question moves to the starting point
                        */
                        100% {            
                            transform: scale(1) translateX(-200px);
                            opacity: 0;
                        }
                    }
                    @keyframes a1 {
                        0% {
                            background-color: red;
                            transform: scale(0) translateX(0px);
                            opacity: 0;
                        }
                        25% {
                            background-color: red;
                            transform: scale(1) translateX(0px);
                            opacity: 1;
                        }
                        40% {
                            background-color: red;
                            transform: scale(1 translateX(0px));
                            opacity: 1;
                        }
                        50% {
                            background-color: red ;
                            transform: scale(1) translateX(30px);
                            opacity: 1;
                        }
                        75% {

                            
                            background-color: green;
                            transform: scale(1) translateX(-50px);
                            opacity: 1;
                        }
                        100% {        
                            
                            background-color: green;    
                            transform: scale(0) translateX(50px);
                            opacity: 0;
                        }
                    }
                </style>

                <div id="boxA">
                    <div id="ques">?</div>
                    <div id="boxB">08</div>
                    <div class="circle"></div>
                </div>

                
            </div>
        </div>
        <div class="col-lg-5 px-5 how-it-works-col d-lg-block">
            <div class="how-it-works-box">

                <div class="steps-text">
                    <span>2. Message</span>
                    <p>Tutors will get back to you within hours! And if you can't find the perfect tutor our team is here to help.</p>
                </div>
                <style>
                    .mbox {
                        display: flex; 
                        flex-flow: row nowrap; 
                        align-items: end;
                    }
                    .circle {
                        width: 18px;
                        height: 18px;
                        border-radius: 50%;
                        margin-bottom: 10px;
                    }
                    .mbox1 .circle {
                        background-color: rgb(255,74,82);
                        margin-right: 10px;
                    }
                    .mbox2 .circle {
                        background-color: rgb(1,112,255);
                        margin-left: 10px;
                    }
                    .mbox3 .circle {
                        background-color: rgb(255,74,82);
                        margin-right: 10px;
                    }
                </style>
                <div class="mes-ani-wrapper">
                    <div class="cropped-wrapper" >
                        <div class="mbox1 mbox">
                            <span class='circle'></span>
                            <i class="fas icon-chat"></i>
                        </div>
                        <div class="mbox2 mbox">
                            <i class="fas icon-chat"></i>
                            <span class='circle'></span>
                        </div>
                        <div class="mbox3 mbox">
                            <span class='circle'></span>
                            <i class="fas icon-chat"></i>
                        </div>
                    </div>
                </div>

                
            </div>
            
        </div>
    </div>
</div>



<!-- Trusty tutors -->
<div class='container trusty-tutors'>
    <div class="row justify-content-center pb-4">
        <div class="col-md-12 heading-section text-left ftco-animate">
            <h2 class="mb-4">Trusty Tutors</h2>
            <p class="color-black-opacity-5">(Certified & Reviewed)</p>
        </div>
    </div>
    <div class='row d-flex'>
        <div class='group-wrapper col-lg-4 col-md-12'>
            <div class='group'>
                <div class='group-main'>
                    <div class='rating'>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star_half'></i>
                    </div>
                    <p class="color-black-opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
                <div class='review-by'>Trust Pilot</div>
            </div>
        </div>
        <div class='group-wrapper col-lg-4 col-md-12'>
            <div class='group'>
                <div class='group-main'>
                    <div class='rating'>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star_half'></i>
                    </div>
                    <p class="color-black-opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
                <div class='review-by'>Google</div>
            </div>
        </div>
        <div class='group-wrapper col-lg-4 col-md-12'>
            <div class='group'>
                <div class='group-main'>
                    <div class='rating'>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                        <i class='icon icon-star2'></i>
                    </div>
                    <p class="color-black-opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
                <div class='review-by'>Tutoriffic</div>
            </div>
        </div>
    </div>
    <div class='row d-flex mt-5'>
        <div class='group-wrapper col-lg-4 col-md-12'>
            <div class='group'>
                <div class='group-main'>
                    <p class="color-black-opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
        <div class='group-wrapper col-lg-4 col-md-12'>
            <div class='group'>
                <div class='group-main'>
                    <p class="color-black-opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
        <div class='group-wrapper col-lg-4 col-md-12'>
            <div class='group'>
                <div class='group-main'>
                    <p class="color-black-opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Footer -->
<footer class="site-footer">
    <div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
        <div class="row">
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">About</h2>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Reviews</a></li>
                </ul>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
            <h2 class="footer-heading mb-4">Quick Links</h2>
            <ul class="list-unstyled">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Create Account</a></li>
            </ul>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
            <h2 class="footer-heading mb-4">Help</h2>
            <ul class="list-unstyled">
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
            <h2 class="footer-heading mb-4">Follow Us</h2>
            <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
        </div>
        </div>
    </div>
    <div class="row pt-5 mt-5">
        <div class="col-12 text-md-center text-left">
            <p class="text-center text-md-end text-xl-start"> 
            All Rights Reserved
            </p>
        </div>
    </div>
    </div>
</footer>











    <!-- Custom Dropdown -->
    <script defer>
        const subjects = [
            [1, 'Mathematics'],
            [2, 'English'],
            [3, 'Sciences'],
            [4, 'Biology'],
            [5, 'Chemistry'],
            [6, 'Physics'],
            [7, 'Psychology'],
            [8, 'Business'],
            [9, 'Economics'],
            [10, 'Sociology'],
            [11, 'History'],
            [12, 'Geography'],
            [13, 'Religious Education'],
            [14, 'Computer Science'],
            [15, 'Art'],
            [16, 'Physical Education'],
            [17, 'Languages'],
            [18, 'Spanish'],
            [19, 'French']
        ];

        const levels = [
            [1, 'A-Level'],
            [2, 'GCSE']
        ];

        // Get the element with data-dropdown='subject'
        const elementWithDataAttribute = document.querySelector('[data-dropdown="subject"]');
        const elementWithDataAttribute2 = document.querySelector('[data-dropdown="level"]');
        const elementWithDataAttribute3 = document.querySelector('[data-dropdown="subject2"]');
        const elementWithDataAttribute4 = document.querySelector('[data-dropdown="level2"]');

        elementWithDataAttribute.addEventListener('keyup', (event) => {
            const input = event.target;

            // Check if the input is a search input
            if (input.classList.contains('search-input')) {
                handleInput(input, subjects, 'subject');
            }
        });
        elementWithDataAttribute2.addEventListener('keyup', (event) => {
            const input = event.target;

            // Check if the input is a search input
            if (input.classList.contains('search-input')) {
                handleInput(input, levels, 'level');
            }
        });
        elementWithDataAttribute3.addEventListener('keyup', (event) => {
            const input = event.target;

            // Check if the input is a search input
            if (input.classList.contains('search-input')) {
                handleInput(input, subjects, 'subject');
            }
        });
        elementWithDataAttribute4.addEventListener('keyup', (event) => {
            const input = event.target;

            // Check if the input is a search input
            if (input.classList.contains('search-input')) {
                handleInput(input, levels, 'level');
            }
        });

        function handleInput(input, array, array_type) {
            /*
                Checks matches between typed `input` and
                the given `array`
            */
            const inputValue = input.value.toLowerCase();
            
            const dropdown = input.nextElementSibling; // Selecting the dropdown based on the next sibling

            // Clear previous suggestions
            dropdown.innerHTML = '';

            // Filter subjects based on input
            const matchingItems = array.filter(item =>
                item[1].toLowerCase().includes(inputValue) // item[1] = Subject name
            );

            // Populate dropdown with matching subjects
            matchingItems.forEach(match => {
                const suggestion = document.createElement('li');
                suggestion.textContent = match[1]; // match[1] = Subject name

                // Add data attribute based on array types
                if(array_type == 'subject') {
                    suggestion.setAttribute('data-subject-id', match[0]); // match[0] = Subject id
                } else if (array_type == 'level') {
                    suggestion.setAttribute('data-level-id', match[0]); // match[0] = Subject id
                }

                suggestion.addEventListener('click', function() {
                    selectDropdownItem(suggestion);
                });
                dropdown.appendChild(suggestion);
            });

            // Show or hide the dropdown based on matching subjects
            dropdown.style.display = matchingItems.length > 0 ? 'block' : 'none';
        }



        document.addEventListener("DOMContentLoaded", function () {
            // Add event listeners for input focus
            document.querySelectorAll("input[data-dropdown]").forEach(function (input) {
                input.addEventListener("focus", function () {
                    showDropdown(input.getAttribute("data-dropdown"));
                });
            });

            // Add event listeners for clicking outside the dropdown
            document.addEventListener("click", function (event) {
                if (!event.target.matches("input[data-dropdown]")) {
                    hideAllDropdowns();
                }
            });

            // Add event listeners for selecting dropdown items
            document.querySelectorAll(".custom-dropdown li").forEach(function (item) {
                item.addEventListener("click", function () {
                    selectDropdownItem(item);
                });
            });
        });

        function showDropdown(dropdownId) {
            hideAllDropdowns();
            document.getElementById(dropdownId + "Dropdown").style.display = "block";
        }

        function hideAllDropdowns() {
            document.querySelectorAll(".custom-dropdown").forEach(function (dropdown) {
                dropdown.style.display = "none";
            });
        }

        function selectDropdownItem(item) {
            /*
                Get the inputs
                1. To set value for our selected subject name
                2. To set value for our selected subject id
            */
            var nameInput = item.closest(".wrap-icon").querySelector("input.search-input");
            var idInput = item.closest(".wrap-icon").querySelector("input.selected-id");

            // Set name value
            nameInput.value = item.textContent;

            // Add data attribute value as the selected id value
            var dataAttributeObject = Object.keys(item.dataset); // Data attributes for this element
            var dataAttributeNames = Object.values(dataAttributeObject); // Data attributes key names array
            var k = dataAttributeNames[0]; // Data attributes first key
            console.log(item.dataset[k]);

            // Set id value
            idInput.value = item.dataset[k]; // Value for the first key
            hideAllDropdowns();
        }

    </script>






</body>
</html>