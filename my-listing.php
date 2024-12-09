<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';ad_title onclick children
?>

<?php include './partials/nav-2.php'; ?>


<style>
    #my-listing {
        max-width: 600px;
        margin: 150px auto;
    }
    @media screen and (max-width: 992px) {
        #my-listing {
            padding: 20px;
        }
    }
    .step {
        position: absolute;
        opacity: 0;
        z-index: -100;
    }
    #my-listing .step.current-step {
        position: static;
        opacity: 1;
    }
    .step-rows {
        padding-left: 30px;
        padding-right: 30px;
        height: 600px;
        overflow-y: scroll;
    }
    
    .step-header {
        margin-bottom: 30px;
    }
    .step-header .subt {
        font-size: 14px;
        font-weight: normal;
        /* margin: 0 0 30px 0!important; */
    }
    #my-listing h2.p-left {
        padding-left: 30px;
    }
    #elementA {
        /* margin-right: 100px; */
        /* margin-bottom: 100px; */
    }
    #elementA > div {
        position: relative;
        z-index: 5;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        flex-flow: row nowrap;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
        min-height: 72px;
        height: 100%;
        max-height: 80px;
        margin-bottom: 8px;
        padding: 8px 16px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border: none;
        border-radius: 16px;
        font-weight: 600;
        outline: none;
        cursor: pointer;
        -webkit-transition: all .15s;
        transition: all .15s;


        background: rgb(255,145,77);
        cursor: pointer;
        
        color: #fff;
    }
    #elementA > div:last-child {
        margin-bottom: 100px;
    }
    #elementA > div:hover {

        -webkit-transform: scale(1.03);
        transform: scale(1.03);
    }
    #elementB li a {
        position: relative;
        z-index: 5;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        flex-flow: row nowrap;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
        min-height: 72px;
        height: 100%;
        max-height: 80px;
        margin-bottom: 8px;
        padding: 8px 16px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border: none;
        border-radius: 16px;
        background: #f7f7f7;
        color: #121212;
        font-weight: 600;
        outline: none;
        cursor: pointer;
        -webkit-transition: all .15s;
        transition: all .15s;
    }
    #elementB li:hover > a {
        background: rgb(255,145,77);
        cursor: pointer;
        -webkit-transform: scale(1.03);
        transform: scale(1.03);
        
        color: #fff;
    }
    li a.selected-item + ul {
        display: block;
    }
</style>


<style>
    /* CSS styles */
    #container {
        display: flex;
    }
    #elementA {
        flex: 1;
    }
    #elementB {
        flex: 1;
    }
    ul {
        display: block; /* Set the outer ul to be visible by default */
    }
    ul ul {
        display: none; /* Hide inner ul elements */
    }
</style>
    
<style>
    #elementB > ul > li > ul {
        margin-bottom: 60px;
    }
    .inner-list-title {
        font-size: 24px;
        margin: 40px 8px 24px;
    }
</style>


<style>
    #elementB li a.selected-item {
        color: #fff;
        background: rgb(255, 145, 77);
    }
    .btns-wrapper {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        margin-top: 80px;
    }
    .btn {
        border-radius: 30px;
        padding: 10px 60px;
    }
    .btn-proceed {
        background: rgb(255, 145, 77);
        color: #fff;
    }
    .btn-back {
        background: #f7f7f7;
        margin-right: 10px;
    }
</style>



<!-- User Avatar -->
<style>
    /* Profile pic */
    .choose-photo {
        width: 250px;
        height: 250px;
        margin: 0 auto;
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        row-gap: 30px;
        border-radius: 20px;
        overflow: hidden;
        box-sizing: content-box;
        border: 1px solid rgba(200, 200, 200, .5);
    }
    /* .choose-photo svg {
        margin-bottom: -40px;
        color: rgba(200, 200, 200, .5);
    } */
    #selected-img {
        position: relative;
        width: 250px;
        height: 250px;
        display: none;
        margin: 0 auto;
        border-radius: 20px;
        overflow: hidden;
    }
    #selected-img img {
        width: inherit;
        height: inherit;
        object-fit: cover;
    }
    #selected-img img.img-success {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        right: 5px;
    }
    .profile-placeholder {
        width: 250px;
        height: 250px;
        overflow: hidden;
        margin: 0 auto;
        border-radius: 20px;
    }
    .profile-placeholder img {
        width: 100%;
        height: 100%;    
        object-fit: cover;
    }
    .register-btn-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #pfpBtn {
        width: 250px;
        color: #1B68FF;
        background-color: #fff;
        padding: 8px 0;
        text-align: center;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        border: none;
        border: 1px solid #1B68FF;
    }
    .profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #err {
        display: none;
        padding: 5px 15px;
        border-radius: 30px;
        background: #D70000;
        margin: 0 auto;
        font-size: 16px;
        position: absolute;
        color: #fff;
    }
    #err.s {
        display: block;
    }
    .selected-option {
        font-weight: 500;
    }
    textarea#description {
        font-weight: 500;
    }
    #img-error .error {
        color: #ff6060;
        font-size: 12px;
        letter-spacing: .6px;
        line-height: 20px;
        padding: 0 12px;
        text-align: center;
        margin-bottom: 10px;
    }
    /* #selected-img img.img-success {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        right: 5px;
    } */
</style>


<!-- Search input -->
<style>
    input.search-input {
        height: 54px;
        width: 100%;
        border: none;
        outline: none;
        /* padding: 0px; */
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        border: solid 1px #000;
    }
    input.search-input:focus {
        border: solid 1px rgb(255, 145, 77);
        box-shadow: 0 0 3px rgba(255, 145, 77, 0.7);
    }
    textarea.form-control {
        height: 120px;
        width: 100%;
        border: none;
        outline: none;
        /* padding: 0px; */
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        border: solid 1px #000;
    }
    textarea.form-control:focus {
        border: solid 1px rgb(255, 145, 77);
        box-shadow: 0 0 3px rgba(255, 145, 77, 0.7);
    }
    /* Styles for the custom dropdown */
    .custom-dropdown {
        width: 100%;
        display: none;
        position: absolute;
        top: 60px;
        list-style: none;
        padding: 10px;
        margin: 0;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .custom-dropdown li {
        padding: 10px;
        cursor: pointer;
    }

    .custom-dropdown li:hover {
        background-color: #f0f0f0;
    }

    /* Additional styles for better appearance */
    .form-control {
        width: 100%;
    }

    .input-wrapper {
        width: 100%;
    }
    #selectedSubjects, 
    #selectedSubjects2,
    #selectedLanguages {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .selected-subject .close-button,
    .selected-language  .close-button {
        cursor: pointer;
    }

    .selected-subject, .selected-language {
        width: 100%;
        position: relative;
        background-color: rgb(255 255 255);
        border: 1px solid #000;
        color: #000;
        border-radius: 16px;
        padding: 30px 50px 30px 50px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }
    .selected-language .radio-container {
        margin-top: 10px;
        display: flex;
        flex-direction: row;
    }
    .selected-subject span,
    .selected-language span {
        margin-right: 8px;
    }
    .selected-subject span:first-child,
    .selected-language span:first-child {
        border-radius: 4px;
        background: rgb(255, 145, 77);
        color: #fff;
        padding: 4px 4px 4px 12px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .selected-subject .close-button,
    .selected-language .close-button {
        cursor: pointer;
        position: absolute;
        right: 5px;
        top: 5px;
    }
    .selected-subject .checkbox-container-wrapper {
        margin-top: 3px;
        display: flex;
        flex-flow: row nowrap;
    }
    .selected-subject .custom-checkbox {
        padding: 8px 20px 8px 0px;
        display: flex;
        align-items: center;
        margin-bottom: 0px;
        border-radius: 5px;
    }
    .subject-price {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
    }
    .subject-price input {
        padding: 5px;
        /* margin-left: 10px; */
    }
</style>
<style>
    #gcse-subjects.hidden, #alevel-subjects.hidden {
        display: none;
    }
    #gcse-subjects.visible, #alevel-subjects.visible {
        display: block;
    }
</style>


<!-- Radio inputs -->
<style>
    .radios {
        display: flex;
        flex-flow: row nowrap;
    }
    .radio-option:first-child {
        margin-right: 15px;
    }
    .radio-input-group {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .radio-input-inner {
        margin-right: 6px;
        display: flex;
        align-items: center;
    }
    .radio-label {
        margin-bottom: 3px;
    }
    /* Style for the radio inputs */
    input[type="radio"] {
        display: none; /* Hide the default radio input */
    }

    /* Style for the radio label */
    .radio-label {
        display: inline-block;
        width: 16px;
        height: 16px;
        padding: 2px; /* Adjust the padding to add spacing */
        /* border: 2px solid rgb(255, 145, 77);
        color: rgb(255, 145, 77); */
        border: 2px solid #ccc;
        cursor: pointer;
        border-radius: 50%;
        position: relative;
    }

    /* Style for the selected radio label */
    .radio-label.selected {
        background-color: white;
        color: white;
    }
    /* Style for the inner circle of the selected radio label */
    .radio-label.selected::before {
        content: "";
        display: block;
        width: 7px;
        height: 7px;
        background-color: rgb(255, 145, 77);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>


<!-- Checkbox -->
<style>
    .subjects {
        display: flex;
        flex-flow: row wrap;
    }
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
    .custom-checkbox label {
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
    .custom-checkbox input[type="checkbox"]:checked + label {
        color: #fff; /* Background color when checked */
        background-color: rgb(255, 145, 77); /* Background color when checked */
        border-color: rgb(255, 145, 77); /* Green border color when checked */
    }

    /* Add some inner content or icons to the label to indicate the checkbox */
    .custom-checkbox label::before {
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
    .custom-checkbox input[type="checkbox"] + label {
        transition: background-color 0.3s, border-color 0.3s; /* Add a smooth transition effect */
    }

    /* Show the checkmark when the checkbox is checked */
    .custom-checkbox input[type="checkbox"]:checked + label::before {
        opacity: 1;
    }
    .custom-checkbox .checkbox-text {
        font-size: 15px;
        font-weight: 500;
        color: #121212;
        display: inline-block;
    }
</style>

<!-- Availibility -->
<style>
    .daytime-container {
        display: flex; 
        flex-flow: column nowrap;
    }

    .days, .times {
        display: flex; 
        flex-flow: row nowrap;
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



<form id='my-listing-form'>
    <input type="hidden" name="create_ad" id="create_ad" value='true'>
    <div id="my-listing">

        <!-- Step 1 -->
        <!-- <div class="inner-div step current-step" id='step-1'>
            <div class='step-header'>
                <h2 class='p-left'>Which subjects do you teach?</h2>
            </div>
            <div class="step-rows" >
                <div id="elementA"></div>
                <div id="elementB">
                    <ul>
                        <li>
                            <a href="#" class="list-item">Maths</a>
                            <ul>
                                <h3 class='inner-list-title'>Add associated subjects</h3>
                                <li><a href="#" class="inner-list-item">Algebra</a></li>
                                <li><a href="#" class="inner-list-item">Trigonometry</a></li>
                                <li><a href="#" class="inner-list-item">Calculus</a></li>
                                <li><a href="#" class="inner-list-item">Statistics</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="list-item">English</a>
                            <ul>
                                <h3 class='inner-list-title'>Add associated subjects</h3>
                                <li><a href="#" class="inner-list-item">Literature</a></li>
                                <li><a href="#" class="inner-list-item">Grammar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="list-item">Piano</a>
                        </li>
                        <li>
                            <a href="#" class="list-item">Sports</a>
                            <ul>
                                <h3 class='inner-list-title'>Add associated subjects</h3>
                                <li><a href="#" class="inner-list-item">Squash</a></li>
                                <li><a href="#" class="inner-list-item">Tennis</a></li>
                                <li><a href="#" class="inner-list-item">Badminton</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#" class="list-item">Chemistry</a>
                        </li>
                        <li>
                            <a href="#" class="list-item">Spanish</a>
                        </li>
                        <li>
                            <a href="#" class="list-item">French</a>
                        </li>
                        
                        <li>
                            <a href="#" class="list-item">Singing</a>
                            <ul>
                                <h3 class='inner-list-title'>Add associated subjects</h3>
                                <li><a href="#" class="inner-list-item">Opera Singing</a></li>
                                <li><a href="#" class="inner-list-item">Vocal Coaching</a></li>
                                <li><a href="#" class="inner-list-item">Musical education</a></li>
                                <li><a href="#" class="inner-list-item">Keyboard</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->

        
        <!-- Step 1 -->
        <div class="inner-div step current-step" id='step-1'>

            <!-- Lesson Length -->
            <div class='input-wrapper' style=' margin-bottom: 20px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    Length of lessons offered?
                </h5>

                <div class='subjects'>

                    <div class='custom-checkbox'>
                        <div class='custom-checkbox-inner'>
                            <input data-length-id='1' type="checkbox" id="custom-checkbox-length-1" value='30 min'>
                            <label for="custom-checkbox-length-1"></label>
                        </div>
                        <div class='checkbox-text'>
                            30 min
                        </div>
                    </div>
                    <div class='custom-checkbox'>
                        <div class='custom-checkbox-inner'>
                            <input data-length-id='2' type="checkbox" id="custom-checkbox-length-2" value='1 hour'>
                            <label for="custom-checkbox-length-2"></label>
                        </div>
                        <div class='checkbox-text'>
                            1 hour
                        </div>
                    </div>
                    <div class='custom-checkbox'>
                        <div class='custom-checkbox-inner'>
                            <input data-length-id='3' type="checkbox" id="custom-checkbox-length-3" value='2 hours'>
                            <label for="custom-checkbox-length-3"></label>
                        </div>
                        <div class='checkbox-text'>
                            2 hours
                        </div>
                    </div>

                </div>

            </div>


            <!-- Levels -->
            <div class='input-wrapper' style=' margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    Levels
                </h5>

                <div class='subjects'>

                    <div class='custom-checkbox'>
                        <div class='custom-checkbox-inner'>
                            <input type="checkbox" id="custom-checkbox" data-level='a-level' value='a-level'>
                            <label for="custom-checkbox" onclick='toggleAlevelnputGroup()'></label>
                        </div>
                        <div class='checkbox-text'>
                            A-Level
                        </div>
                    </div>
                    <div class='custom-checkbox'>
                        <div class='custom-checkbox-inner'>
                            <input type="checkbox" id="custom-checkbox-2" data-level='gcse' value='gcse'>
                            <label for="custom-checkbox-2" onclick='toggleGcseInputGroup()'></label>
                        </div>
                        <div class='checkbox-text'>
                            GCSE
                        </div>
                    </div>

                </div>

            </div>


            <!-- A-Level Subjects -->
            <div class='input-wrapper hidden' id='alevel-subjects'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>A-Level Subjects</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <input name='subject' id='subject' type='text' class='form-control search-input' placeholder='Subject' data-dropdown='subject'>
                    <ul class='custom-dropdown' id='subjectDropdown'>
                        <li data-subject-id='1'>Mathematics</li>
                        <li data-subject-id='2'>English</li>
                        <li data-subject-id='3'>Sciences</li>
                        <li data-subject-id='4'>Biology</li>
                        <li data-subject-id='5'>Chemistry</li>
                        <li data-subject-id='6'>Physics</li>
                        <li data-subject-id='7'>Psychology</li>
                        <li data-subject-id='8'>Business</li>
                        <li data-subject-id='9'>Economics</li>
                        <li data-subject-id='10'>Sociology</li>
                        <li data-subject-id='11'>History</li>
                        <li data-subject-id='12'>Geography</li>
                        <li data-subject-id='13'>Religious Education</li>
                        <li data-subject-id='14'>Computer Science</li>
                        <li data-subject-id='15'>Art</li>
                        <li data-subject-id='16'>Physical Education</li>
                        <li data-subject-id='17'>Languages</li>
                        <li data-subject-id='18'>Spanish</li>
                        <li data-subject-id='19'>French</li>
                    </ul>
                </div>
                <div id='selectedSubjects'></div>
            </div>


            <!-- GCSE Subjects -->
            <div class='input-wrapper hidden' id='gcse-subjects'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>GCSE Subjects</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <input name='subject2' id='subject2' type='text' class='form-control search-input' placeholder='Subject' data-dropdown='subject2'>
                    <ul class='custom-dropdown' id='subject2Dropdown'>
                        <li data-subject-id='1'>Mathematics</li>
                        <li data-subject-id='2'>English</li>
                        <li data-subject-id='3'>Sciences</li>
                        <li data-subject-id='4'>Biology</li>
                        <li data-subject-id='5'>Chemistry</li>
                        <li data-subject-id='6'>Physics</li>
                        <li data-subject-id='7'>Psychology</li>
                        <li data-subject-id='8'>Business</li>
                        <li data-subject-id='9'>Economics</li>
                        <li data-subject-id='10'>Sociology</li>
                        <li data-subject-id='11'>History</li>
                        <li data-subject-id='12'>Geography</li>
                        <li data-subject-id='13'>Religious Education</li>
                        <li data-subject-id='14'>Computer Science</li>
                        <li data-subject-id='15'>Art</li>
                        <li data-subject-id='16'>Physical Education</li>
                        <li data-subject-id='17'>Languages</li>
                        <li data-subject-id='18'>Spanish</li>
                        <li data-subject-id='19'>French</li>
                    </ul>
                </div>
                <div id='selectedSubjects2'></div>
            </div>


            <!-- Languages -->
            <div class='input-wrapper' id='languagesSelectionWrapper'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>Languages</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <input name='languages' id='languages' type='text' class='form-control search-input' placeholder='Language' data-dropdown='languages'>
                    <ul class='custom-dropdown' id='languagesDropdown'>
                        <li data-languge-id='1'>English</li>
                        <li data-languge-id='2'>Spanish</li>
                        <li data-languge-id='3'>French</li>
                        <li data-languge-id='4'>German</li>
                    </ul>
                </div>
                <div id='selectedLanguages'></div>
            </div>


        </div>

        <!-- Step 2 -->
        <div class="inner-div step" id='step-2'>

            <!-- GCSE/A-Level -->
            <div class='input-wrapper' style='margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    Do you hold a GCSE/A-Level in each of the subjects you've mentioned you can teach? - Not necessary to have this but preferred.
                </h5>

                <div class='radios' style='margin-top: 20px;'>
                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="preferred" id="preferred-yes" type="radio" value="yes" checked>
                                <label class="radio-label" for="preferred-yes" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Yes</div>
                        </div>
                    </div>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="preferred" id="preferred-no" type="radio" value="no">
                                <label class="radio-label" for="preferred-no" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>No</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Recorded lessons -->
            <div class='input-wrapper' style=' margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    Recorded lessons
                </h5>

                <div class='radios' style='margin-top: 20px;'>
                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="recorded-lesson" id="recorded-yes" type="radio" value="yes" checked>
                                <label class="radio-label" for="recorded-yes" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Yes</div>
                        </div>
                    </div>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="recorded-lesson" id="recorded-no" type="radio" value="no">
                                <label class="radio-label" for="recorded-no" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>No</div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Exam board -->
            <div class='input-wrapper' style=' margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                Exam board:
                </h5>

                <div class='radios' style='margin-top: 20px;'>
                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="exam-board" id="edexcel" type="radio" value="edexcel" checked>
                                <label class="radio-label" for="edexcel" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Edexcel</div>
                        </div>
                    </div>

                    <div class="radio-option" style='margin-right: 15px;'>
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="exam-board" id="aqa" type="radio" value="aqa">
                                <label class="radio-label" for="aqa" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>AQA</div>
                        </div>
                    </div>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="exam-board" id="ocr" type="radio" value="ocr">
                                <label class="radio-label" for="ocr" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>OCR</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- First lesson free -->
            <div class='input-wrapper' style=' margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    First lesson free?
                </h5>

                <div class='radios' style='margin-top: 20px;'>
                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="free-lessons" id="lessons-free" type="radio" value="free" checked>
                                <label class="radio-label" for="lessons-free" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Yes</div>
                        </div>
                    </div>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="free-lessons" id="lessons-paid" type="radio" value="paid">
                                <label class="radio-label" for="lessons-paid" onclick="handleRadioSelection(this)" for="paid"></label>
                            </div>
                            <div>No</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Teaching style -->
            <div class='input-wrapper' style=' margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    Teaching style
                </h5>

                <div class='radios' style='margin-top: 20px;'>
                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="teaching-style" id="teacher-centered" type="radio" value="Teacher-centred" checked>
                                <label class="radio-label" for="teacher-centered" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Teacher-centred</div>
                        </div>
                    </div>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="teaching-style" id="student-centered" type="radio" value="Student-centred">
                                <label class="radio-label" for="student-centered" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Student-centred</div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Highest qualification level -->
            <div class='input-wrapper' style=' margin-bottom: 30px;'>
                <h5 style='font-size: 18px; margin-bottom: 10px; line-height: 28px;'>
                    Highest qualification level
                </h5>

                <div class='radios' style='margin-top: 20px;'>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="qualification-level" id="degree" type="radio" value="degree" checked>
                                <label class="radio-label" for="degree" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>Degree</div>
                        </div>
                    </div>

                    <div class="radio-option" style='margin-right: 15px;'>
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="qualification-level" id="a-level" type="radio" value="a-level">
                                <label class="radio-label" for="a-level" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>A-level</div>
                        </div>
                    </div>

                    <div class="radio-option">
                        <div class='radio-input-group'>
                            <div class='radio-input-inner'>
                                <input name="qualification-level" id="gcse" type="radio" value="gcse">
                                <label class="radio-label" for="gcse" onclick="handleRadioSelection(this)"></label>
                            </div>
                            <div>GCSE</div>
                        </div>
                    </div>


                </div>
            </div>




        </div>

        <!-- Step 3 -->
        <div class="inner-div step" id='step-3'>
            
            <?php
                $ad = new Ad;
                $ad->show_day_and_times();
            ?>
        </div>

        <!-- Step 4 -->
        <div class="inner-div step" id='step-4'>

            <!-- Your experiences -->
            <div class='input-wrapper'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>Tell them a bit about you, Your experiences, Why you want to teach?</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <textarea name="experiences" id="experiences" class='form-control search-input' placeholder='Your experiences'></textarea>
                </div>
            </div>
            

            <!-- Currently doing -->
            <div class='input-wrapper'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>What are you currently doing?</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <textarea name="current_activity" id="current_activity" class='form-control search-input' placeholder='Current activity'></textarea>
                </div>
            </div>


            <!-- Aspirations -->
            <div class='input-wrapper'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>What are your aspirations?</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <textarea name="aspirations" id="aspirations" class='form-control search-input' placeholder='Aspirations'></textarea>
                </div>
            </div>


            <!-- Aspirations -->
            <div class='input-wrapper'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>What are your motivations to teach?</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <textarea name="motivations" id="motivations" class='form-control search-input' placeholder='Motivations'></textarea>
                </div>
            </div>


            <!-- Aspirations -->
            <div class='input-wrapper'>
                <h5 style='font-size: 18px; margin-bottom: 10px;'>What does a typical lesson look like?</h5>
                <div class='wrap-icon' style='position: relative;'>
                    <textarea name="typical_lesson" id="typical_lesson" class='form-control search-input' placeholder='Typical lesson'></textarea>
                </div>
            </div>
        </div>

        <!-- Step 8 -->
        <!-- <div class="inner-div step" id='step-8'>
            <div class='step-header'>
                <h2>Profile Picture</h2>
            </div>
            <div id="elementE">
                <div class="choose-photo" style='margin-bottom: 10px;'>
                    <div class="profile-placeholder">
                        <div id="err">Error</div>
                        <img src="./assets/placeholders/avi.png" alt="">
                    </div>   
                    <div id="selected-img">
                        <img id="img-preview" src="" alt="" />     
                    </div>  
                </div>
                <div id="img-error"></div>
                <div class="register-btn-wrapper" style='margin-bottom: 30px;'>
                    <button class='btn btn-proceed' onclick="return fireButton(event);">Choose File</button>      
                    <input class="input" id="image" type="file" name="image" style="display: none;">
                </div>
            </div>
        </div> -->

        <div class='btns-wrapper'>
            <span class='btn btn-back' onclick="prevStep()">Back</span>
            <span class='btn btn-proceed' onclick="nextStep()">Next</span>
        </div>
    </div>
</form>






    <script defer>

        // Function to process selected subjects
        function selectedSubjectsByLevel(containerId) {
            /*

                1. All these subject blocks will be divided into two main blocks 
                of html. One inside id='gcse-subjects' and another inside  
                id='alevel-subjects' so we run the main code twice and create two 
                different main array one for each block and the html and data 
                inside them

                2. Loop through the subject elements using javascript and for each 
                subject get the data-selected-subject-id="1" the board names that 
                have the same data-board-subject-id="1" value as the data-selected-subject-id="1" 
                and price for that have the same " data-price-subject-id="1" value 
                as the data-selected-subject-id="1" . 
                
                3. As we loop through we'll create 
                a list of each of these blocks with key/value pairs with the subject id, 
                an array with the board names and the price value. once we have these 
                append them to the main array. After that json encode them so we can 
                append them to our form

            */

            // Main array to store results
            var subjectsData = [];

            // Select all elements with the class 'selected-subject' inside the specified container
            var selectedSubjects = document.querySelectorAll('#' + containerId + ' .selected-subject');

            // Iterate through each selected subject
            selectedSubjects.forEach(function (subjectElement) {
                // Get the data-selected-subject-id attribute value
                var subjectId = subjectElement.querySelector('span').getAttribute('data-selected-subject-id');

                // Array to store board names
                var boardNames = [];

                // Array to store prices
                var prices = [];

                // Select all checkboxes with the same data-board-subject-id value
                var checkboxes = subjectElement.querySelectorAll('input[data-board-subject-id="' + subjectId + '"]:checked');

                // Iterate through each checked checkbox
                checkboxes.forEach(function (checkbox) {
                    // Get the data-board-name attribute value
                    var boardName = checkbox.getAttribute('data-board-name');
                    boardNames.push(boardName);
                });

                // Get the price value
                var priceInput = subjectElement.querySelector('input[data-price-subject-id="' + subjectId + '"]');
                var priceValue = priceInput.value;

                // Create an object with the collected information
                var subjectData = {
                    subjectId: subjectId,
                    boardNames: boardNames,
                    price: priceValue
                };

                // Push the object to the main array
                subjectsData.push(subjectData);
            });

            // Convert the array to JSON
            var subjectsJson = JSON.stringify(subjectsData);

            return subjectsJson;
            // // Log the result or send it to your form
            // console.log(containerId + ' Subjects JSON:', subjectsJson);
        }


        // Function to process language blocks
        function selectedLanguages() {
            // Main array to store results
            var languageData = [];

            // Select all language blocks
            var languageBlocks = document.querySelectorAll('.selected-language');

            // Iterate through each language block
            languageBlocks.forEach(function (languageBlock) {
                // Get the data-selected-language-id attribute value
                var languageId = languageBlock.querySelector('span').getAttribute('data-selected-language-id');

                // Get the checked radio input value with the name 'fluency'
                var fluencyInput = languageBlock.querySelector('input[name="fluency"]:checked');

                // Check if the fluencyInput is not null (i.e., a radio input is checked)
                if (fluencyInput) {
                    // Create an object with key/value pairs for language id and fluency value
                    var languageEntry = {
                        languageId: languageId,
                        fluency: fluencyInput.value
                    };

                    // Push the object to the main array
                    languageData.push(languageEntry);
                }
            });

            var languagesJson = JSON.stringify(languageData);

            return languagesJson;

            // // Log the result or use it as needed
            // console.log("Language data:", languageData);
        }

        // Use jQuery to get checked input values
        function create_ad_2() {

            // Levels
            var checkedValues = $('input[data-level]:checked').map(function () {
                return this.value;
            }).get();
            console.log(checkedValues);


            // Call the function to process A-Level subjects
            const alevelSubjects = selectedSubjectsByLevel('alevel-subjects');
            // Call the function to process GCSE subjects
            const gcseSubjects = selectedSubjectsByLevel('gcse-subjects');
            // Call the function to process GCSE subjects
            const languages = selectedLanguages();

            console.log('A-Level', alevelSubjects);
            console.log('GCSE', gcseSubjects);
            console.log('languages', languages);
            
            
            const preferred = $("input[name='preferred']:checked").val();
            console.log(preferred);
            
            const recordedLesson = $("input[name='recorded-lesson']:checked").val();
            console.log(recordedLesson);

            const examBoard = $("input[name='exam-board']:checked").val();
            console.log(examBoard);

            const freeLessons = $("input[name='free-lessons']:checked").val();
            console.log(freeLessons);

            const teachingStyle = $("input[name='teaching-style']:checked").val();
            console.log(teachingStyle);

            const qualificationLevel = $("input[name='qualification-level']:checked").val();
            console.log(qualificationLevel);


            // Main array to store results
            var lengthCheckboxesData = [];
            // Select all checkboxes with the data-length-id attribute
            var lengthCheckboxes = document.querySelectorAll('input[data-length-id]');
            // Iterate through each checkbox
            lengthCheckboxes.forEach(function (checkbox) {
                // Check if the checkbox is checked
                if (checkbox.checked) {
                    // Get the data-length-id attribute value
                    var lengthId = checkbox.getAttribute('data-length-id');

                    // Create an array with key/value for data-length-id and checkbox value
                    var checkboxData = {
                        lengthId: lengthId,
                        value: checkbox.value
                    };

                    // Push the array to the main array
                    lengthCheckboxesData.push(checkboxData);
                }
            });

            var lengthJson = JSON.stringify(lengthCheckboxesData);

            console.log(lengthJson);


            // Main array to store results
            var scheduleData = [];

            // Select all elements with the class "selected"
            var selectedElements = document.querySelectorAll('.selected-schedule-inner');

            // Iterate through each "selected" element
            selectedElements.forEach(function(selectedElement, index) {
                console.log(selectedElement);
                // Get the day id from the "data-selected-day-id" attribute
                var dayElement = selectedElement.querySelector('.item[data-selected-day-id]');
                var dayId = dayElement ? dayElement.dataset.selectedDayId : null;

                // Array to store time data for the current "selected" element
                var timeData = [];

                // Select all elements with the class "item" inside the current "selected" element
                var timeElements = selectedElement.querySelectorAll('.item[data-selected-time-id]');

                // Iterate through each "item" element to extract time ids
                timeElements.forEach(function(timeElement, timeIndex) {
                    // Get the time id from the "data-selected-time-id" attribute
                    var timeId = timeElement.dataset.selectedTimeId;

                    // Log information to identify the issue
                    console.log(`Element ${index + 1}, Time Element ${timeIndex + 1}:`, dayId, timeId);

                    // Ensure that timeId is not null or undefined before pushing
                    if (timeId !== undefined) {
                        // Push the time id to the timeData array
                        timeData.push(timeId);
                    }
                });

                // Log information about the current "selected" element
                console.log(`Element ${index + 1}, Result:`, { dayId, timeData });

                // Create an object with day id and time ids for the current "selected" element
                var selectedData = {
                    dayId: dayId,
                    timeIds: timeData
                };

                // Push the selectedData object to the main array
                scheduleData.push(selectedData);
            });

            // Output the result
            console.log(scheduleData);


            var scheduleJson = JSON.stringify(scheduleData);
            // console.log(scheduleJson);

            // Output the result
            // console.log(scheduleJson);


            var experiences = $('#experiences').val();
            var current_activity = $('#current_activity').val();
            var aspirations = $('#aspirations').val();
            var motivations = $('#motivations').val();
            var typical_lesson = $('#typical_lesson').val();

            // Create FormData object
            var formData = new FormData();

            load_start();

            // Append data to FormData
            formData.append('create_ad', 'true'); // Assuming checkedValues is an array
            formData.append('levels', checkedValues.join(',')); // Assuming checkedValues is an array
            formData.append('alevel_subjects', alevelSubjects);
            formData.append('gcse_subjects', gcseSubjects);
            formData.append('languages', languages);
            formData.append('preferred', preferred);
            formData.append('recorded_lesson', recordedLesson);
            formData.append('exam_board', examBoard);
            formData.append('free_lessons', freeLessons);
            formData.append('teaching_style', teachingStyle);
            formData.append('highest_qualification_level', qualificationLevel);
            formData.append('lengths', lengthJson);
            formData.append('schedule', scheduleJson);

            formData.append('experiences', experiences);
            formData.append('current_activity', current_activity);
            formData.append('aspirations', aspirations);
            formData.append('motivations', motivations);
            formData.append('typical_lesson', typical_lesson);

            // Use fetch to send a POST request
            fetch('controllers/ad-handler.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                setTimeout(() => {
                    load_end();
                    // Handle the success response
                    console.log('Success:', data);
                    window.location.href = 'profile-picture';
                }, 1000);
            })
            .catch(error => {
                // Handle the error
                console.error('Error:', error);
            });
            

        }

    </script>

    <!-- Toggle Subject selection -->
    <script defer>
        function toggleAlevelnputGroup() {
            $('#alevel-subjects').toggleClass('hidden');
            $('#alevel-subjects').toggleClass('visisble');
        }
        function toggleGcseInputGroup() {
            $('#gcse-subjects').toggleClass('hidden');
            $('#gcse-subjects').toggleClass('visisble');
        }
    </script>

    <!-- Subjects select filter and dropdown -->
    <script defer>
        const subjectsArray = [
            'Mathematics',
            'English',
            'Sciences',
            'Biology',
            'Chemistry',
            'Physics',
            'Psychology',
            'Business',
            'Economics',
            'Sociology',
            'History',
            'Geography',
            'Religious Education',
            'Computer Science',
            'Art',
            'Physical Education',
            'Languages',
            'Spanish',
            'French'
        ];

        initializeDropdown('subject', subjectsArray, 'selectedSubjects');
        initializeDropdown('subject2', subjectsArray, 'selectedSubjects2');

        function initializeDropdown(dropdownType, array, selectedDivId) {
            console.log(selectedDivId);

            const elementWithDataAttribute = document.querySelector(`[data-dropdown="${dropdownType}"]`);

            elementWithDataAttribute.addEventListener('focus', function () {
                showDropdown(elementWithDataAttribute.getAttribute('data-dropdown'));
            });

            elementWithDataAttribute.addEventListener('click', function () {
                const dropdown = document.getElementById(elementWithDataAttribute.getAttribute('data-dropdown') + 'Dropdown');
                if (elementWithDataAttribute.value.trim() === '') {
                    showDropdown(elementWithDataAttribute.getAttribute('data-dropdown'));
                }
            });

            document.addEventListener('click', function (event) {
                const dropdowns = document.querySelectorAll('.custom-dropdown');
                dropdowns.forEach(function (dropdown) {
                    const relatedInput = document.querySelector(`input[data-dropdown="${dropdown.id.replace('Dropdown', '')}"]`);
                    if (!relatedInput.contains(event.target) && !dropdown.contains(event.target)) {
                        hideDropdown(dropdown);
                    }
                });
            });

            document.querySelectorAll('#'+dropdownType+' + '+'.custom-dropdown li').forEach(function (item) {
                item.addEventListener('click', function () {
                    selectDropdownItem(dropdownType, item, selectedDivId);
                });
            });

            elementWithDataAttribute.addEventListener('keyup', function (event) {
                const input = event.target;
                if (input.classList.contains('search-input')) {
                    handleInput(input, array, selectedDivId);
                }
            });
        }

        function handleInput(input, array, selectedDivId) {
            const inputValue = input.value.toLowerCase();
            const dropdown = input.nextElementSibling;

            dropdown.innerHTML = '';

            const matchingItems = array.filter(item => item.toLowerCase().includes(inputValue));

            matchingItems.forEach(match => {
                const suggestion = document.createElement('li');
                suggestion.textContent = match;
                suggestion.addEventListener('click', () => selectSubject(match, input, selectedDivId));
                dropdown.appendChild(suggestion);
            });

            dropdown.style.display = matchingItems.length > 0 ? 'block' : 'none';
        }

        function showDropdown(dropdownId) {
            hideAllDropdowns();
            document.getElementById(dropdownId + 'Dropdown').style.display = 'block';
        }

        function hideDropdown(dropdown) {
            dropdown.style.display = 'none';
        }

        function hideAllDropdowns() {
            document.querySelectorAll('.custom-dropdown').forEach(function (dropdown) {
                hideDropdown(dropdown);
            });
        }

        function selectDropdownItem(dropdownType, item, selectedDivId) {
            const input = item.closest('.wrap-icon').querySelector('input');
            const inputValue = input.value.trim();

            if (inputValue !== '') {
                input.value = item.textContent;
            }

            var subject_id = item.getAttribute('data-subject-id');
            console.log(subject_id);

            if (inputValue === '') {
                const dropdownId = input.getAttribute('data-dropdown');
                const relatedInput = document.querySelector(`input[data-dropdown="${dropdownId}"]`);
                selectSubject(dropdownType, item.textContent, relatedInput, subject_id, selectedDivId);
            }

            hideAllDropdowns();
        }

        function selectSubject(dropdownType, selectedSubject, input, subject_id, selectedDivId) {
            const selectedDiv = document.getElementById(selectedDivId);

            // Check for duplicates based on text content
            let isDuplicate = false;

            if(selectedDiv.children) {
                for (const child of selectedDiv.children) {
                    const textContent = child.querySelector('span').textContent;
                    console.log(textContent);
                    
                    if (textContent === selectedSubject) {
                        isDuplicate = true;
                        break;
                    }
                }
            }

            if (!isDuplicate) {
                // Add wrapping div around pricing label and input
                const boardsContainer = document.createElement('div');
                boardsContainer.classList.add('boards');

                const selectedOption = document.createElement('div');
                selectedOption.className = 'selected-subject';

                const text = document.createElement('span');
                text.textContent = selectedSubject;
                text.setAttribute('data-selected-subject-id', subject_id);

                selectedOption.appendChild(text);
                

                // Add label for checkboxes
                const label = document.createElement('label');
                label.textContent = 'Boards';

                // Create a container div for checkboxes
                const checkboxContainerWrapper = document.createElement('div');
                checkboxContainerWrapper.className = 'checkbox-container-wrapper';

                const boards = ['Edexcel', 'AQA', 'OCR'];
                const numberOfBoards = boards.length;


                // Add checkboxes with unique identifiers
                for (let i = 1; i <= numberOfBoards; i++) {
                    const checkboxContainer = document.createElement('div');
                    checkboxContainer.className = 'custom-checkbox';

                    const checkboxInner = document.createElement('div');
                    checkboxInner.className = 'custom-checkbox-inner';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `${dropdownType}_board_${selectedSubject}_${i}`; // Unique identifier for each checkbox
                    checkbox.name = `${dropdownType}_boards_${selectedSubject}`; // Group checkboxes by subject
                    checkbox.setAttribute('data-board-subject-id', subject_id); // Add subject id as data attribute
                    checkbox.setAttribute('data-board-name', boards[i - 1]); // Add subject id as data attribute

                    const checkboxLabel = document.createElement('label');
                    checkboxLabel.setAttribute('for', `${dropdownType}_board_${selectedSubject}_${i}`);

                    const checkboxText = document.createElement('div');
                    checkboxText.className = 'checkbox-text';
                    checkboxText.textContent = boards[i - 1]; // Adjusted to use boards array

                    checkboxInner.appendChild(checkbox);
                    checkboxInner.appendChild(checkboxLabel);

                    checkboxContainer.appendChild(checkboxInner);
                    checkboxContainer.appendChild(checkboxText);

                    label.appendChild(checkboxContainer);

                    checkboxContainerWrapper.appendChild(checkboxContainer);
                }

                // Append the checkbox container wrapper to the label
                label.appendChild(checkboxContainerWrapper);

                // Add wrapping div around pricing label and input
                const priceContainer = document.createElement('div');
                priceContainer.classList.add('subject-price');

                const priceLabel = document.createElement('label');
                priceLabel.textContent = 'Hourly rate (£/hr)';

                const priceInput = document.createElement('input');
                priceInput.type = 'text';
                priceInput.id = `${dropdownType}_price_${selectedSubject}`;
                priceInput.name = `${dropdownType}_prices_${selectedSubject}`;
                priceInput.placeholder = 'Enter price';    
                priceInput.setAttribute('data-price-subject-id', subject_id);

                priceContainer.appendChild(priceLabel);
                priceContainer.appendChild(priceInput);


                selectedOption.appendChild(label);
                selectedOption.appendChild(priceContainer);

                const closeButton = document.createElement('span');
                closeButton.className = 'close-button';
                closeButton.textContent = 'x';
                closeButton.addEventListener('click', () => removeSelectedOption(selectedOption, input));
                selectedOption.appendChild(closeButton);

                selectedDiv.appendChild(selectedOption);

            }

            input.value = '';
            hideAllDropdowns();
        }


        function removeSelectedOption(selectedOption, input) {
            const selectedDiv = selectedOption.parentNode;
            selectedDiv.removeChild(selectedOption);

            input.value = '';
        }
    </script>

    <!-- Languages select filter dropdown -->
    <script defer>

        initializeDropdown2('languages', ['English', 'Spanish', 'French', 'German'], 'selectedLanguages');

        function initializeDropdown2(dropdownType, array, selectedDivId) {
            const elementWithDataAttribute = document.querySelector(`[data-dropdown="${dropdownType}"]`);

            elementWithDataAttribute.addEventListener('focus', function () {
                showDropdown2(elementWithDataAttribute.getAttribute('data-dropdown'));
            });

            elementWithDataAttribute.addEventListener('click', function () {
                const dropdown = document.getElementById(elementWithDataAttribute.getAttribute('data-dropdown') + 'Dropdown');
                if (elementWithDataAttribute.value.trim() === '') {
                    showDropdown2(elementWithDataAttribute.getAttribute('data-dropdown'));
                }
            });

            document.addEventListener('click', function (event) {
                const dropdowns = document.querySelectorAll('.custom-dropdown');
                dropdowns.forEach(function (dropdown) {
                    const relatedInput = document.querySelector(`input[data-dropdown="${dropdown.id.replace('Dropdown', '')}"]`);
                    if (!relatedInput.contains(event.target) && !dropdown.contains(event.target)) {
                        hideDropdown2(dropdown);
                    }
                });
            });

            document.querySelectorAll('#' + dropdownType + ' + ' + '.custom-dropdown li').forEach(function (item) {
                item.addEventListener('click', function () {
                    selectDropdownItem2(dropdownType, item, selectedDivId);
                });
            });

            elementWithDataAttribute.addEventListener('keyup', function (event) {
                const input = event.target;
                if (input.classList.contains('search-input')) {
                    handleInput2(input, array, selectedDivId);
                }
            });
        }

        function handleInput2(input, array, selectedDivId) {
            const inputValue = input.value.toLowerCase();
            const dropdown = input.nextElementSibling;

            dropdown.innerHTML = '';

            const matchingItems = array.filter(item => item.toLowerCase().includes(inputValue));

            matchingItems.forEach(match => {
                const suggestion = document.createElement('li');
                suggestion.textContent = match;
                suggestion.addEventListener('click', () => selectSubject(dropdownType, match, input, selectedDivId));
                dropdown.appendChild(suggestion);
            });

            dropdown.style.display = matchingItems.length > 0 ? 'block' : 'none';
        }

        function showDropdown2(dropdownId) {
            hideAllDropdowns2();
            document.getElementById(dropdownId + 'Dropdown').style.display = 'block';
        }

        function hideDropdown2(dropdown) {
            dropdown.style.display = 'none';
        }

        function hideAllDropdowns2() {
            document.querySelectorAll('.custom-dropdown').forEach(function (dropdown) {
                hideDropdown2(dropdown);
            });
        }

        function selectDropdownItem2(dropdownType, item, selectedDivId) {
            const input = item.closest('.wrap-icon').querySelector('input');
            const inputValue = input.value.trim();

            if (inputValue !== '') {
                input.value = item.textContent;
            }
            var language_id = item.getAttribute('data-languge-id');
            console.log(language_id);

            if (inputValue === '') {
                const dropdownId = input.getAttribute('data-dropdown');
                const relatedInput = document.querySelector(`input[data-dropdown="${dropdownId}"]`);
                selectLanguages(dropdownType, item.textContent, relatedInput, language_id, selectedDivId);
            }

            hideAllDropdowns2();
        }

        function selectLanguages(inputType, selectedSubject, input, language_id, selectedDivId) {
            const selectedDiv = document.getElementById(selectedDivId);

            // Check for duplicates based on text content
            let isDuplicate = false;

            for (const child of selectedDiv.children) {
                const textContent = child.querySelector('span').textContent;
                if (textContent === selectedSubject) {
                    isDuplicate = true;
                    break;
                }
            }

            if (!isDuplicate) {
                const selectedOption = document.createElement('div');
                selectedOption.className = 'selected-language';

                const text = document.createElement('span');
                text.textContent = selectedSubject;
                text.setAttribute('data-selected-language-id', language_id);

                selectedOption.appendChild(text);

                // Add label for radio inputs
                const label = document.createElement('label');
                label.textContent = 'Fluency';

                // Add radio inputs for "Native" and "Fluent"
                const radioContainer = document.createElement('div');
                radioContainer.className = 'radio-container radios';

                const nativeRadio = createRadioInput(`${inputType}_native_${selectedSubject}`, 'Native', true);
                const fluentRadio = createRadioInput(`${inputType}_fluent_${selectedSubject}`, 'Fluent', false);

                radioContainer.appendChild(nativeRadio);
                radioContainer.appendChild(fluentRadio);

                label.appendChild(radioContainer);

                selectedOption.appendChild(label);

                const closeButton = document.createElement('span');
                closeButton.className = 'close-button';
                closeButton.textContent = 'x';
                closeButton.addEventListener('click', () => removeSelectedOption2(selectedOption, input));
                selectedOption.appendChild(closeButton);

                selectedDiv.appendChild(selectedOption);
            }

            input.value = '';
            hideAllDropdowns2();
        }

        function createRadioInput(id, label, checked) {
            const radioContainer = document.createElement('div');
            radioContainer.className = 'radio-option';

            const radioInputGroup = document.createElement('div');
            radioInputGroup.className = 'radio-input-group';

            const radioInputInner = document.createElement('div');
            radioInputInner.className = 'radio-input-inner';

            const radioInput = document.createElement('input');
            radioInput.type = 'radio';
            radioInput.id = id;
            radioInput.name = 'fluency';
            radioInput.value = label.toLowerCase();
            radioInput.checked = checked;

            const radioInputLabel = document.createElement('label');
            radioInputLabel.className = 'radio-label';
            radioInputLabel.setAttribute('for', id);
            radioInputLabel.addEventListener('click', () => handleRadioSelection(radioInputLabel));

            radioInputInner.appendChild(radioInput);
            radioInputInner.appendChild(radioInputLabel);

            const radioText = document.createElement('div');
            radioText.textContent = label;

            radioInputGroup.appendChild(radioInputInner);
            radioInputGroup.appendChild(radioText);

            radioContainer.appendChild(radioInputGroup);

            return radioContainer;
        }

        function removeSelectedOption2(selectedOption, input) {
            const selectedDiv = selectedOption.parentNode;
            selectedDiv.removeChild(selectedOption);

            input.value = '';
        }

    </script>

    <!-- Radio Input -->
    <script defer>
        function handleRadioSelection(label) {
            const radioInput = label.previousElementSibling;

            // Get the closest ancestor with the class 'radios'
            const radiosContainer = radioInput.closest('.radios');
            // console.log(radiosContainer);

            // Query only for labels inside the radiosContainer
            const allLabels = radiosContainer.querySelectorAll('.radio-label');

            // Unselect all labels
            allLabels.forEach((label) => {
                label.classList.remove('selected');
                label.previousElementSibling.checked = false;
            });

            // Select the clicked label
            label.classList.add('selected');

            // Update the radio input's checked property
            radioInput.checked = true;
        }
    </script>

    <!-- Availibility (day and time) -->
    <script>
        function selectDay(element, day) {
            const selectedDays = document.querySelector('.selected-schedule');

            // Check if the day is already selected
            const dayExists = Array.from(selectedDays.querySelectorAll('.item')).some(item => item.textContent.trim() === day);
            // console.log(element, day);
            const dayId = element.getAttribute('data-day-id');

            if (!dayExists) {
                const selectedDayItemInner = document.createElement('div');
                selectedDayItemInner.classList.add('selected-schedule-inner');
                const selectedDayItem = document.createElement('div');
                selectedDayItem.classList.add('item');
                selectedDayItem.textContent = day;
                selectedDayItem.setAttribute('data-selected-day-id', dayId);

                // Add extra span with '-'
                const dashSpan = document.createElement('span');
                dashSpan.textContent = '-';
                selectedDayItemInner.appendChild(selectedDayItem);
                selectedDayItemInner.appendChild(dashSpan);

                selectedDays.appendChild(selectedDayItemInner);
            } else {
                // Handle the case where the day is already selected
                alert(`The day '${day}' is already selected.`);
            }
        }


        function selectTime(element, time) {
            const selectedDays = document.querySelector('.selected-schedule');
            const lastSelectedDayItem = selectedDays.lastChild;

            if (lastSelectedDayItem) {
            // Check if the time already exists for the selected day
            const existingTimes = lastSelectedDayItem.querySelectorAll('.item');
            const timeExists = Array.from(existingTimes).some(item => item.textContent === time);

            const timeId = element.getAttribute('data-time-id');

            if (!timeExists) {
                const selectedTimeItem = document.createElement('div');
                selectedTimeItem.classList.add('item');
                selectedTimeItem.textContent = time;
                selectedTimeItem.setAttribute('data-selected-time-id', timeId);
                lastSelectedDayItem.appendChild(selectedTimeItem);
            } else {
                // Handle the case where the time already exists for the selected day
                alert(`The time '${time}' already exists for this day.`);
            }
            } else {
            // Handle the case where no day is selected
            alert('Please select a day first.');
            }
        }
    </script>

    <!-- Image upload -->
    <script defer>


        // Click
        function fireButton(event) {
             ;
            document.getElementById('image').click()
        }

        // Preview Profile Photo
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                    $('.profile-placeholder').css({"display":"none"});
                    $('#selected-img').css({"display":"block"});
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Image validation
        $("#image").change(function () {
            var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
            var imageInput = document.getElementById('image');
            var imgErrorElement = document.getElementById('img-error');
            var errElement = document.getElementById('err');

            if (imageInput.files.length === 0) {
                imgErrorElement.innerHTML = '';
                errElement.classList.remove('s');
                return;
            }

            var file = imageInput.files[0];
            var imgType = file.name.split('.').pop(); // Get the file extension
            var imgSize = file.size; // Get the file size in bytes

            if (!allowed.includes(imgType)) {
                errElement.classList.add('s');
                imgErrorElement.innerHTML = '<div class="error">Incorrect File Type</div>';
            } else if (imgSize > 1500000) { // 1.5MB in bytes
                errElement.classList.add('s');
                imgErrorElement.innerHTML = '<div class="error">Image is too large (max 1.5MB)</div>';
            } else {
                errElement.classList.remove('s');
                imgErrorElement.innerHTML = '';
                readURL(this); // Assuming readURL is a function to handle image preview
            }
        });
    </script>


    <script defer>
        function prevStep() {
            var curStep = document.querySelector('.current-step');
            var curStepId = curStep.id;
            var idArr = curStepId.split('-');
            var curStepNum = parseInt(idArr[1]);
            if(curStepNum != 1) {
                var prevStepNum = curStepNum - 1;
                var prevStep = document.getElementById('step-' + prevStepNum);
                curStep.classList.remove('current-step');
                prevStep.classList.add('current-step');
            }
        }
        function nextStep() {

            var curStep = document.querySelector('.current-step');
            console.log(curStep);
            var curStepId = curStep.id;               
            var idArr = curStepId.split('-');
            var curStepNum = parseInt(idArr[1]);
            if(curStepNum == 4) {
                create_ad_2();
                // const input =  $('input#image')[0];
                // var errElement = document.getElementById('err');

                // const file =  $('input#image')[0].files[0];
                // const reader = new FileReader();
                // if (input.files && input.files[0] && !errElement.classList.contains('s')) {
                //     reader.onload = function(e) {
                //         const img = new Image();
                //         img.src = e.target.result;

                //         img.onload = function() {
                //             // Calculate new dimensions for resizing
                //             const maxWidth = 500; // Change this to your desired width
                //             const maxHeight = 500; // Change this to your desired height

                //             let newWidth = img.width;
                //             let newHeight = img.height;

                //             if (img.width > maxWidth) {
                //                 newWidth = maxWidth;
                //                 newHeight = (img.height * maxWidth) / img.width;
                //             }

                //             if (newHeight > maxHeight) {
                //                 newHeight = maxHeight;
                //                 newWidth = (img.width * maxHeight) / img.height;
                //             }

                //             // Create a canvas and resize the image
                //             const canvas = document.createElement('canvas');
                //             canvas.width = newWidth;
                //             canvas.height = newHeight;
                //             const ctx = canvas.getContext('2d');
                //             ctx.drawImage(img, 0, 0, newWidth, newHeight);

                //             // Convert the canvas data to a Blob
                //             canvas.toBlob(function(blob) {

                //                 var form = $('#my-listing-form')[0];
                //                 var formData = new FormData(form);

                //                 // Append the resized image blob to the original formData object
                //                 formData.append('photo', blob, 'resized_image.webp');


                                
                //                 fetch('./controllers/user-handler', {
                //                     method: 'POST',
                //                     body: formData
                //                 })
                //                 .then(response => {
                //                     return response.text();
                //                 })
                //                 .then(response => {
                //                     // console.log(response);
                //                     window.location.href = './my-listing-confirmation';
                //                 })
                //                 .catch(err => console.log(err));

                //             }, 'image/webp', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                //         };
                //     };

                //     reader.readAsDataURL(file);
                // }
                
            } else {

                var nextStepNum = parseInt(idArr[1]) + 1;
                var nextStep = document.getElementById('step-' + nextStepNum);
                curStep.classList.remove('current-step');
                nextStep.classList.add('current-step');
            }

        }
    </script>






</body>
</html>