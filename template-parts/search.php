<style>
    .search-form-wrapper {
        max-width: 600px;
        display: flex; 
        flex-flow: column nowrap; 
        /* justify-content: center; 
        align-items: center;
        text-align: center; */
        margin: 0;
    }
    .form-search-wrap {
        background: #fff;
        padding: 3px 12px !important;
        /* -webkit-box-shadow: 0px 14px 24px rgb(255 221 200);
        box-shadow: 0px 14px 24px rgb(255 221 200); */
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 24px;
    }
    .form-inner-div {
        position: relative; 
        display: flex; 
        flex-flow: row nowrap; 
        align-items: center;
    }
    
    .search-span {
        width: 40px;
        height: 100%;
        border-right: 1px solid #dee2e6 !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .search-form-wrapper > div {
        width: 100%;
    }
    .input-wrapper {
        width: 195px;
        margin: 0;
    }
    
    .form-search-wrap .btn {
        /* width: 120px;
        border-radius: 30px;
        padding: 10px 30px;  */

        width: 100px;
        border-radius: 30px;
        padding: 5px 20px;
    }
    input:focus {
        box-shadow: none !important;
        border: none !important;
        outline: none !important;
    }
    .form-btn {
        background: rgb(255,145,77);
    }
    .form-btn:hover {
        /* color: rgb(255,145,77); */
        background: #FF914D;
    }



    .select-wrap .icon, .wrap-icon .icon {
        position: absolute;
        right: 20px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 22px;
    }

    .form-search-wrap .form-control {
        padding: 4px 10px;
        border: none; 
    }
    
    @media (max-width: 1199.98px) {
        .form-search-wrap .form-control {
            height: 45px; 
        } 
    }
    @media (max-width: 1199.98px) {
        .form-search-wrap .btn {
            display: block; 
        } 
    }

    @media screen and (max-width: 768px) {
        .search-form-wrapper {
            margin-bottom: 30px;
        }
        .site-block-cover .inner-div {
            width: 100% !important;
            padding: 10px;
        }
        #find-a-tutor .cover-wrapper {
            padding: 0;
        }
        
    }
    @media screen and (max-width: 592px) {
        .search-form-wrapper > div {
            width: 100%;
        }
        
    }
</style>

<style>
    /* Styles for the custom dropdown */
    .custom-dropdown {
        width: 100%;
        display: none;
        position: absolute;
        top: 45px;
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

    /* .no-sm-border {
        border: 1px solid #ddd;
    } */

    .border-right {
        border-right: 1px solid #ddd;
    }

</style>

<!-- Search -->
<div class='search-form-wrapper'>          
    <div>

        <div class='form-search-wrap p-2' data-aos='fade-up' data-aos-delay='200'>
            <form method='post' action='./search-results.php'>
                <input type='hidden' name='account_type' value='tutor' />
                <div class='form-inner-div'>
                    <span class='icon icon-search search-span'></span>
                    <div class='input-wrapper no-sm-border border-right'>
                        <div class='wrap-icon' style='position: relative;'>
                            <input name='subject' id='subject' type='text' class='form-control search-input' placeholder='Subject' data-dropdown='subject'>
                            <ul class='custom-dropdown' id='subjectDropdown' style='height: 250px; overflow: scroll; overflow-x: hidden;'>
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
                            <input name='level' id='level' style='padding-left: 20px;' type='text' class='form-control search-input' placeholder='Level' data-dropdown='level'>
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
            
                    <input onclick='search_results(event)' name='search' type='submit' class='form-btn btn text-white' value='Search'>
                </div>
            </form>
        </div>

    </div>
</div>


<script defer>
    const subjects = [
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
    const levels = ['GCSE', 'A-Level'];

    // Get the element with data-dropdown='subject'
    const elementWithDataAttribute = document.querySelector('[data-dropdown="subject"]');
    const elementWithDataAttribute2 = document.querySelector('[data-dropdown="level"]');

    elementWithDataAttribute.addEventListener('keyup', (event) => {
        const input = event.target;

        // Check if the input is a search input
        if (input.classList.contains('search-input')) {
            handleInput(input, subjects);
        }
    });

    elementWithDataAttribute2.addEventListener('keyup', (event) => {
        const input = event.target;

        // Check if the input is a search input
        if (input.classList.contains('search-input')) {
            handleInput(input, levels);
        }
    });

    function handleInput(input, array) {
        const inputValue = input.value.toLowerCase();
        const dropdown = input.nextElementSibling; // Selecting the dropdown based on the next sibling

        // Clear previous suggestions
        dropdown.innerHTML = '';

        // Filter subjects based on input
        const matchingItems = array.filter(item =>
            item.toLowerCase().includes(inputValue)
        );

        // Populate dropdown with matching subjects
        matchingItems.forEach(match => {
            const suggestion = document.createElement('li');
            suggestion.textContent = match;
            // suggestion.addEventListener('click', () =>(match));
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
        var input = item.closest(".wrap-icon").querySelector("input");
        input.value = item.textContent;
        hideAllDropdowns();
    }

</script>

<script defer>
    function search_results(event) {
         ;
        
        var formData = new FormData();

        const subject = $('#subject').val();
        const level = $('#level').val();
        // const user_account_type_id = $('#user_account_type_id').val();

        console.log(subject, level);


        load_start();

        formData.append('subject', subject);
        formData.append('level', level);
        formData.append('search', 'true');


        fetch('./search-results.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            setTimeout(function() {

                load_end();
                console.log(response);
                $('#listings-row').html(response);

            }, 500);
        })
        .catch( err => console.log(err));
        
    }
</script>