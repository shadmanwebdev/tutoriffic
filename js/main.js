function scroll_to_element(id, event) {
     ;
    var element = document.getElementById(id);
    if(window.innerWidth > 900) {
        element.scrollIntoView({ behavior: 'smooth', block: "start", inline: "nearest"});
    } else {
        element.scrollIntoView({ behavior: 'smooth', block: "start", inline: "nearest"});
    }
}
function get_page() {
    var path = window.location.pathname;
    var page = path.split("/").pop();
    return page;
}
function page_params() {
    // Page Parameters
    const urlParams = new URLSearchParams(window.location.search);
    for (const [key, value] of urlParams) {
        if(key == 'id') {
            var p = value;
        }
    }
}

function numInputs() {
    var numInps = document.querySelectorAll('input[type=number]');
    var invalidChars = ["-", "+", "e"];
    numInps.forEach(el => {
        el.addEventListener("keydown", function(e) {
            if (invalidChars.includes(e.key)) {
                e.preventDefault();
            }
        });
    });
}
function hideCards() {
    var cardNodelist = document.querySelectorAll('.form-card');   
    for (let i = 0; i < cardNodelist.length; i++) {
        cardNodelist[i].style.position = 'absolute';
        cardNodelist[i].style.top = 0;
        cardNodelist[i].style.zIndex = -10;
        cardNodelist[i].style.opacity = 0;
    }
}
function showCards() {
    document.getElementById('form-card-1').style.position = 'static';
    document.getElementById('form-card-1').style.opacity = 1;
}
function prevCard(i) {
    hideCards();
    document.getElementById('form-card-'+i).style.position = 'static';
    document.getElementById('form-card-'+i).style.opacity = 1;
}
function nextCard(i) {
    hideCards();
    document.getElementById('form-card-'+i).style.position = 'static';
    document.getElementById('form-card-'+i).style.opacity = 1;
}
// numInputs();
function goto(url) {
    window.location.href = url;
}

function load_start() {
    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');
    var popBg = document.getElementById('popBg');
    if(!popBg.classList.contains('dark')) {
        if(popBg.classList.contains('light')) {
            popBg.classList.remove('light');
        }
        popBg.classList.add('dark');
    }
}
function load_end() {
    loader.classList.remove('loader-animation');
    var popBg = document.getElementById('popBg');
    if(popBg.classList.contains('dark')) {
        popBg.classList.remove('dark');
    }
    popBg.classList.add('light');
}

function toggleClassOnMouseOver(className) {
    // Get all elements with the specified class name
    var elements = document.getElementsByClassName(className);


    // Add event listeners to each element
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];

        element.addEventListener('mouseover', function () {
            // Check if the element has the 'm-off' class
            if (this.classList.contains('m-off')) {
                this.classList.remove('m-off');
            }
            this.classList.add('m-on');
        });

        element.addEventListener('mouseout', function () {
            // Check if the element has the 'm-on' class
            if (this.classList.contains('m-on')) {
                this.classList.remove('m-on');
            }
            this.classList.add('m-off');
        });
    }
}
function classOnClick(commonClass, selectedClass) {
    /*
        Remove a certain class from all elements of a specified class 
        and add the first class only to the element of the second class 
        that has been clicked
    */

    const container = document.body; // You can change this to the actual container element

    container.addEventListener('click', function (event) {
        const clickedElement = event.target;

        // Check if the clicked element has the specified class
        if (clickedElement.classList.contains(commonClass)) {
            // Remove selectedClass class from all elements with the specified class
            document.querySelectorAll('.' + commonClass).forEach(element => {
                element.classList.remove(selectedClass);
            });

            // Add selectedClass class to the clicked element
            clickedElement.classList.add(selectedClass);
        }
    });
}
function switchTab(defaultClass, switchTo, activeClass) {
    /*
        Loop through all tabs and remove active class
        Add active class to the tab we want to show
    */
    var tabs = document.getElementsByClassName(defaultClass);
    const switchToTab = document.querySelector('.' + switchTo);

    for (var i = 0; i < tabs.length; i++) {
        var tab = tabs[i];
        tab.classList.remove(activeClass);
    }
    switchToTab.classList.add(activeClass);
}

function custom_select() {
    document.addEventListener("DOMContentLoaded", function () {
        // const selectWrappers = document.querySelectorAll(".custom-select-wrapper");

        document.querySelectorAll(".custom-select-wrapper").forEach((selectWrapper) => {
            const selectedLabel = selectWrapper.querySelector(".selected-label");
            const customOptions = selectWrapper.querySelector(".custom-options");

            selectWrapper.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                customOptions.classList.toggle("active");
            });

            // Close the dropdown when clicking outside of it
            document.addEventListener("click", function (event) {
                if (!selectWrapper.contains(event.target)) {
                    customOptions.classList.remove("active");
                }
            });
            
            // Update label text for selected item
            customOptions.querySelectorAll("li").forEach((option) => {
                option.addEventListener("click", function () {
                    const value = option.getAttribute("data-value");
                    const label = option.querySelector("span").getAttribute("data-label");
                    selectedLabel.textContent = label;
                    selectedLabel.setAttribute('data-selected-value', value);
                    console.log(selectedLabel);
                });
            });
        });
    });
}

function createSession(key, value) {
    // Set a cookie with the key-value pair
    document.cookie = `${key}=${value}; path=/`;
}
  
function getSession(key) {
    // Get all cookies and split them into individual key-value pairs
    const cookies = document.cookie.split(';');
  
    // Loop through the cookies to find the one with the specified key
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
    
        // Check if the cookie starts with the specified key
        if (cookie.startsWith(`${key}=`)) {
            // Return the value of the cookie
            return cookie.substring(key.length + 1);
        }
    }
  
    // If the key is not found, return null
    return null;
}
  

function insertTypedText(val, el2Id) {
    $('#'+el2Id).text(val);
} 



