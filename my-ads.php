<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>

<link rel="stylesheet" href="css/my-ads.css?v=6">

<?php
    include './template-parts/account-navigation.php';
?>


<style>
    .textarea-container textarea, 
    .textarea-container input {
        border: solid #d9d9d9 1px;
    }   
</style>

<!-- Popup -->
<style>
    #ad-subject-popup {
        position: fixed;
        top: 15%;
        left: 50%;
        background-color: #fff;
        padding: 50px;
        width: 500px;
        margin-top: 0px;
        margin-left: -250px;
        z-index: 1000;
    }  
    @media screen and (max-width: 576px) {
        #ad-subject-popup {
            top: 15%;
            left: 2.5%;
            padding: 35px;
            width: 95%;
            margin-left: 0;
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
        margin-bottom: 12px;
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

<!-- Levels -->
<style>
    .levels {
        margin-bottom: 12px;
    }
    .levels-row {
        display: flex;
        font-size: 15px;
        flex-flow: row wrap;
    }
</style>

<!-- Radio -->
<style>
    .lesson-type-wrapper {   
        margin-bottom: 40px;
    }
    .radios {
        display: flex;
        flex-flow: row nowrap; 
    }
    .radio-option:first-child {
        margin-right: 20px;
    }
    .radio-input-group {
        display: flex;
        flex-flow: row nowrap;
    }
    .radio-input-inner {
        margin-right: 5px;
    }
    /* Style for the radio inputs */
    input[type="radio"] {
        display: none; /* Hide the default radio input */
    }

    /* Style for the radio label */
    .radio-label {
        display: inline-block;
        width: 20px;
        height: 20px;
        padding: 2px; /* Adjust the padding to add spacing */
        border: 2px solid #ccc;
        color: rgb(255, 145, 77);
        cursor: pointer;
        border-radius: 50%;
        position: relative; /* Add this line */
    }

    /* Style for the selected radio label */
    .radio-label.selected {
        background-color: white;
        color: white;
        border: 2px solid rgb(255, 145, 77);
    }
    /* Style for the inner circle of the selected radio label */
    .radio-label.selected::before {
        content: "";
        display: block;
        width: 10px;
        height: 10px;
        background-color: rgb(255, 145, 77);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 1;
    }
</style>


<!-- Subject Popup Buttons -->
<style>
    .btns-container {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: start;
        margin-top: 30px;
    }
    .booking-btns button:not(button:last-child){
        
    }
    .btn {
        border-radius: 30px;
        padding: 7px 20px;
        transition: .3s;
        font-size: 14px;
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





<div class='popup-container' style='height: 0;'></div>



<div id='ad-subject-popup-wrapper'></div>



<style>        
    .back-btn {
        padding: 0;
        margin: 0 0 20px 0;
        border: none;
        outline: none;
        box-shadow: none;
        display: none;
        align-items: center;
        justify-content: center;
        background-color: #afafaf;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
    .back-btn i {
        font-size: 20px;
        margin-right: 0px;
        color: #fff;
    }
    @media screen and (max-width: 1200px) {
        .back-btn {
            display: flex;
        }
        .my-ads-container {
            width: 1100px;
        }
        .list-ad-wrapper {
            display: block;
            min-width: 100%;
        }
        .my-ad {
            display: none;
            min-width: 100%;
        }
    }
</style>




<!-- Ads Container -->
<div class='my-ads-container'>

    <div class='list-ad-wrapper'>
        <?php
            $ad = new Ad;
            $ad->my_ads_sidebar();
        ?>
    </div>


    <div class='my-ad' style='min-height: 700px;'>
        <div class='ad-body-outer'>
            <div class='ad-body-inner'>
                <?php
                    $ad->my_ad(null, true);
                ?>
                
            </div>
        </div>
    </div>
    
</div>


<script src="js/ad.js?v=19" defer></script>


<script defer>

    function editAdPopup(popEl) {
        // Get the popup element using the data-popup attribute
        var popup = document.querySelector('[data-popup="' + popEl + '"]');
        var popBg = document.getElementById('popBg');

        // Use forEach for NodeList iteration
        document.querySelectorAll('.popup.show_popup').forEach(function (popupNode) {
            popupNode.classList.remove('show_popup');
            popupNode.classList.add('hide_popup');

            if (popBg.classList.contains('dark')) {
                popBg.classList.remove('dark');
            }
            popBg.classList.add('light');
        });

        if (popup.classList.contains('hide_popup')) {
            popup.classList.remove('hide_popup');
            popup.classList.add('show_popup');

            if (popBg.classList.contains('light')) {
                popBg.classList.remove('light');
            }
            popBg.classList.add('dark');
        }
    }
    function hidePopupBg() {
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
    }
</script>



<script defer>
    function update_ad_title(event) {
        event.preventDefault();

        const ad_id = document.getElementById('ad_id').value;
        const ad_title = document.getElementById('ad_title').value;


        if(ad_title) {
            // load_start();
            
            var formData = new FormData();

            formData.append('update_ad_title', 'true');
            formData.append('ad_id', ad_id);
            formData.append('ad_title', ad_title);

            $('ad-title-error').html('');

            fetch('./controllers/ad-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    // load_end();
                    console.log(response);
                    
                    if($.trim(response) == '1') {
                        $('#message-response-1').html("<div class='success'>Updated!</div>");
                    } else {
                        $('#message-response-1').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Ad Title
            if(ad_title) {
                $('#ad-title-error').html('');
            } else {
                $('#ad-title-error').html('<div>Field cannot be blank</div>');
            }
        }
    }
    function update_ad_about_lesson(event) {
        event.preventDefault();

        const ad_id = document.getElementById('ad_id').value;
        const about_lesson = document.getElementById('about_lesson').value;


        if(about_lesson) {
            // load_start();
            
            var formData = new FormData();

            formData.append('update_about_lesson', 'true');
            formData.append('ad_id', ad_id);
            formData.append('about_lesson', about_lesson);

            $('ad-title-error').html('');

            fetch('./controllers/ad-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    // load_end();
                    console.log(response);
                    
                    if($.trim(response) == '1') {
                        $('#message-response-2').html("<div class='success'>Updated!</div>");
                    } else {
                        $('#message-response-2').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Ad Title
            if(about_lesson) {
                $('#ad-about-lesson-error').html('');
            } else {
                $('#ad-about-lesson-error').html('<div>Field cannot be blank</div>');
            }
        }
    }
    function update_ad_about_tutor(event) {
        event.preventDefault();

        const ad_id = document.getElementById('ad_id').value;
        const about_tutor = document.getElementById('about_tutor').value;


        if(about_tutor) {
            // load_start();
            
            var formData = new FormData();

            formData.append('update_about_tutor', 'true');
            formData.append('ad_id', ad_id);
            formData.append('about_tutor', about_tutor);

            $('ad-title-error').html('');

            fetch('./controllers/ad-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    // load_end();
                    console.log(response);
                    
                    if($.trim(response) == '1') {
                        $('#message-response-3').html("<div class='success'>Updated!</div>");
                    } else {
                        $('#message-response-3').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Ad Title
            if(about_tutor) {
                $('#ad-about-tutor-error').html('');
            } else {
                $('#ad-about-tutor-error').html('<div>Field cannot be blank</div>');
            }
        }
    }
</script>


<script defer>
    function adRow() {
        const adRows = document.querySelectorAll('.card-ad-wrapper');
        const adContainer = document.querySelector('.ad-body-inner');

        const to_id = document.getElementById('to_id');

        adRows.forEach(adRow => {
            adRow.addEventListener('click', () => {
                const selectedadId = adRow.getAttribute('data-adid');

                // Make an AJAX call to fetch ads for the selected ad
                fetch(`./my-ad?ad=${selectedadId}`)
                    .then(response => response.text())
                    .then(adHtml => {

                        if(window.innerWidth < 1200) {

                            const listAdWrapper = document.querySelector('.list-ad-wrapper');
                            listAdWrapper.style.display = 'none';
                            const myAd = document.querySelector('.my-ad');
                            myAd.style.display = 'block';
                        }


                        adContainer.innerHTML = adHtml;

                    })
                    .catch(error => console.error('Error fetching messages:', error));
            });
        });
    }

    adRow();

    function backToAdRows() {
        const listAdWrapper = document.querySelector('.list-ad-wrapper');
        listAdWrapper.style.display = 'block';
        const myAd = document.querySelector('.my-ad');
        myAd.style.display = 'none';

    }


    function get_ad_column_popup(infoContainer) {
        const infoContainers = document.querySelectorAll('.infos-container');
        const popupContainer = document.querySelector('.popup-container');

            
        const column = infoContainer.getAttribute('data-column');
        const ad_id = infoContainer.getAttribute('data-adid');

        fetch(`./my-ad-column?ad=${ad_id}&column=${column}`)
        .then(response => response.text())
        .then(response => {
            // Replace the ad container's content with the fetched ads
            popupContainer.innerHTML = response;

            if(column == 'subjects') {
                editAdPopup('subjects');
            }
            else if(column == 'ad_title') {
                editAdPopup('ad_title');
            }
            else if(column == 'about_tutor') {
                editAdPopup('about_tutor');
            }
            else if(column == 'about_lesson') {
                editAdPopup('about_lesson');
            }
            else if(column == 'locations') {
                editAdPopup('locations');
            }
            else if(column == 'price') {
                editAdPopup('price');
            }
            

            // // Add id of selected ad to the form input
            // to_id.value = selectedadId;

            console.log(response);
        })
        .catch(error => console.error('Error fetching messages:', error));
            
    }


    document.getElementById('popBg').addEventListener('click', () => {
        document.querySelector('.popup-container').innerHTML = '';
    });


    // $(document).ready(function() {
    //     if(window.innerWidth < 768) {
    //         $('.list-ad-wrapper').on('click', function() {
    //             // Move list-ad-wrapper to the left (hidden) and show ad
    //             $('.list-ad-wrapper').css('transform', 'translateX(-100%)');
    //             $('.ad').css('transform', 'translateX(-100%)');
    //         });
    
    //         $('#resetButton').on('click', function() {
    //             // Reset the positions to their original state
    //             $('.list-ad-wrapper').css('transform', 'translateX(0)');
    //             $('.ad').css('transform', 'translateX(100%)');
    //         });
    //     }
    // });

</script>


</body>
</html>