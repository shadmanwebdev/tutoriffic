<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';ad_title
?>
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
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
    

<form id='my-listing-form'>
    <input type="hidden" name="create_ad" id="create_ad" value='true'>
    <div id="my-listing">

        <!-- Step 1 -->
        <div class="inner-div step current-step" id='step-1'>
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
        </div>

        <!-- Step 2 -->
        <style>
            .textarea-container textarea {
                width: 100%;
                padding: 16px;
                background-color: #f7f7f7;
                resize: none;
                border: solid 2px #fff;
                outline: none;
                font-size: 16px;
                font-weight: normal;
                border-radius: 16px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                background-clip: padding-box;
                -webkit-transition: all .15s;
                transition: all .15s;
            }
            .inpreq {
                font-size: 16px;
                color: gray;
            }
        </style>

        <div class="inner-div step" id='step-2'>
            <div class='step-header'>
                <h2>Title of your ad <span class='inpreq'>(12 words minimum)</span></h2>
            </div>
            <div id="elementC">
                <div class='textarea-container'>
                    <textarea id="ad_title" name="ad_title" placeholder="E.g. Graduate from the Conservatory, teaches singing and guitar for all levels. Personalised methodology to meet your individual needs!" style="height: 128px;"></textarea>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="inner-div step" id='step-3'>
        
            <div class='step-header'>
                <h2>About your lessons <span class='inpreq'>(40 words minimum)</span></h2>
            </div>
            <div id="elementC">
                <div class='textarea-container'>
                    <textarea id="about_lesson" name="about_lesson" placeholder="Now is the time to convince future students of your personal approach to private tutoring." style="height: 278px;"></textarea>
                </div>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="inner-div step" id='step-4'>
            <div class='step-header'>
                <h2>About you <span class='inpreq'>(40 words minimum)</span></h2>
            </div>
            <div id="elementC">
                <div class='textarea-container'>
                    <textarea id="about_tutor" name="about_tutor" placeholder="Tell your future students who you are and why you want to teach." style="height: 278px;"></textarea>
                </div>
            </div>
        </div>

        <!-- Step 5 -->
        <style>
            .input-container input {
                height: 64px;
                width: 100%;
                border: none;
                outline: none;
                /* padding: 0px; */
                padding: 10px 20px;
                font-size: 16px;
                font-weight: 600;
                border: solid 1px #000;
            }
            .input-container input:focus {
                background-color: #fff;
                border: solid 2px #000;
                box-shadow: none;
            }

            #elementF li a {
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
            #elementF li:hover > a {
                background: rgb(255,145,77);
                cursor: pointer;
                -webkit-transform: scale(1.03);
                transform: scale(1.03);
                
                color: #fff;
            }
            #elementF li > a.selected-item {
                background: rgb(255,145,77);             
                color: #fff;
            }
        </style>

        <div class="inner-div step" id='step-5'>
            <div class='step-header'>
                <h2>Lesson location</h2>
            </div>
            <div id="elementE">
                <div class='input-container'>
                    <input type="text" id="location" id="location" name="location" placeholder="15 Northwood" autocomplete="off" class="form-control address-exist pac-target-input" data-label="15 Northwood">
                </div>
            </div>
            <div id="elementF" style='margin-top: 60px;'>
                <h4>Where can your lessons be held?</h4>
                <ul>
                    <li>
                        <a class="list-item">
                            Your Home<input name='home' id='home' type="checkbox" style="display: none;">
                        </a>
                    </li>
                    <li>
                        <a class="list-item">
                            You can travel<input name='travel' id='travel' type="checkbox" style="display: none;"> 
                        </a>
                    </li>
                    <li>
                        <a class="list-item">
                            Online<input name='online' id='online' type="checkbox" style="display: none;"> 
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Step 6 -->
        <div class="inner-div step" id='step-6'>
            <div class='step-header'>
                <h2 class=''>Hourly rate</h2>
                <p class='subt'>Info: The average price for maths lessons in Oxford is $10</p>
            </div>
            <div id="elementE">
                <div class='input-container'>
                    <input type="text" name="price" id="price" placeholder="10.00" autocomplete="off" class="form-control address-exist pac-target-input" data-label="$10">
                </div>
            </div>
        </div>

        <!-- Step 7 -->
        <div class="inner-div step" id='step-7'>
            <div class='step-header'>
                <h2 class=''>Phone number</h2>
                <p class='subt'>Your number never appears on the site, it is only shared with students to whom you agree to teach.</p>
            </div>
            <div id="elementE">
                <div class='input-container'>
                    <input type="text" name="phone" id="phone" placeholder="07400 123456" autocomplete="off" class="form-control address-exist pac-target-input" data-label="$10">
                </div>
            </div>
        </div>

        <!-- Step 8 -->
        <div class="inner-div step" id='step-8'>
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
        </div>

        <div class='btns-wrapper'>
            <span class='btn btn-back' onclick="prevStep()">Back</span>
            <span class='btn btn-proceed' onclick="nextStep()">Next</span>
        </div>
    </div>
</form>

    <!-- Step 8 -->
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
            if(curStepNum == 8) {

                const input =  $('input#image')[0];
                var errElement = document.getElementById('err');

                const file =  $('input#image')[0].files[0];
                const reader = new FileReader();
                if (input.files && input.files[0] && !errElement.classList.contains('s')) {
                    reader.onload = function(e) {
                        const img = new Image();
                        img.src = e.target.result;

                        img.onload = function() {
                            // Calculate new dimensions for resizing
                            const maxWidth = 500; // Change this to your desired width
                            const maxHeight = 500; // Change this to your desired height

                            let newWidth = img.width;
                            let newHeight = img.height;

                            if (img.width > maxWidth) {
                                newWidth = maxWidth;
                                newHeight = (img.height * maxWidth) / img.width;
                            }

                            if (newHeight > maxHeight) {
                                newHeight = maxHeight;
                                newWidth = (img.width * maxHeight) / img.height;
                            }

                            // Create a canvas and resize the image
                            const canvas = document.createElement('canvas');
                            canvas.width = newWidth;
                            canvas.height = newHeight;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, newWidth, newHeight);

                            // Convert the canvas data to a Blob
                            canvas.toBlob(function(blob) {

                                var form = $('#my-listing-form')[0];
                                var formData = new FormData(form);

                                // Append the resized image blob to the original formData object
                                formData.append('photo', blob, 'resized_image.webp');


                                
                                fetch('./controllers/user-handler', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => {
                                    return response.text();
                                })
                                .then(response => {
                                    // console.log(response);
                                    window.location.href = './my-listing-confirmation';
                                })
                                .catch(err => console.log(err));

                            }, 'image/webp', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                        };
                    };

                    reader.readAsDataURL(file);
                }
                
            } else {

                var nextStepNum = parseInt(idArr[1]) + 1;
                var nextStep = document.getElementById('step-' + nextStepNum);
                curStep.classList.remove('current-step');
                nextStep.classList.add('current-step');
            }

        }
    </script>


    <script>
        // JavaScript code
        const elementA = document.getElementById('elementA');
        const listItems = document.querySelectorAll('.list-item');
        const innerListItems = document.querySelectorAll('.inner-list-item');
        const ulElements = document.querySelectorAll('#elementB ul');
        const selectedItems = new Set(); // Store selected items to prevent duplicates
        const selectedInnerItems = new Set(); // Store selected inner items to prevent duplicates

        listItems.forEach((item, index) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                item.classList.add('selected-item');

                if (!selectedItems.has(item)) {
                    // Add the text of the list item to elementA
                    const selectedText = item.textContent;
                    const listItem = document.createElement('div');
                    listItem.appendChild(document.createTextNode(selectedText));
                    elementA.appendChild(listItem);

                    // Create an identifiable checkbox
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = `checkbox_${selectedText}`;
                    checkbox.id = `checkbox_${selectedText}`;
                    checkbox.checked = true; // Initial checkbox state
                    listItem.appendChild(checkbox);

                    // // Show the corresponding unordered list
                    // ulElements.forEach((ul, i) => {
                    //     if (i === index + 1) {
                    //         ul.style.display = 'block';
                    //     }
                    // });

                    // Mark the item as selected
                    selectedItems.add(item);
                }
            });
        });

        innerListItems.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();  

                item.classList.add('selected-item');

                if (!selectedInnerItems.has(item)) {
                    const selectedText = item.textContent;
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = `checkbox_${selectedText}`;
                    checkbox.id = `checkbox_${selectedText}`;
                    checkbox.checked = true; // Initial checkbox state
                    const listItem = document.createElement('div');
                    listItem.appendChild(document.createTextNode(selectedText));
                    listItem.appendChild(checkbox);
                    elementA.appendChild(listItem);

                    // Mark the inner item as selected
                    selectedInnerItems.add(item);
                }
            });
        });

        elementA.addEventListener('change', (e) => {
            if (e.target.type === 'checkbox') {
                if (!e.target.checked) {
                    // When a checkbox in elementA is unchecked, remove it from elementA
                    const listItemText = e.target.parentNode.textContent.trim();
                    e.target.parentNode.remove();

                    // Allow the item to be selected again in elementB
                    listItems.forEach((item) => {
                        if (item.textContent === listItemText) {
                            item.classList.remove('selected-item');
                            selectedItems.delete(item);
                        }
                    });
                    innerListItems.forEach((item) => {
                        if (item.textContent === listItemText) {
                            item.classList.remove('selected-item');
                            selectedInnerItems.delete(item);
                        }
                    });
                }
            }
        });
    </script>


    <script>
        const elementF = document.getElementById("elementF");
        const liItems = elementF.querySelectorAll(".list-item");

        // Add click event listeners to each list item
        liItems.forEach((l) => {
            const checkbox = l.querySelector("input[type='checkbox']");

            l.addEventListener("click", () => {
                if (checkbox.style.display === "none" && !checkbox.checked) {
                    // Display the checkbox, check it, and add the "selected-item" class
                    checkbox.style.display = "inline";
                    checkbox.checked = true;
                    l.classList.add("selected-item");
                } else {
                    // Hide the checkbox, uncheck it, and remove the "selected-item" class
                    checkbox.checked = false;
                    checkbox.style.display = "none";
                    l.classList.remove("selected-item");
                }
            });

            // Prevent the checkbox click event from bubbling up to the list item
            checkbox.addEventListener("click", (e) => {
                e.stopPropagation();
            });
        });
    </script>


</body>
</html>