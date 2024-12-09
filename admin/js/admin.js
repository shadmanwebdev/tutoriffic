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

function goto(url) {
    window.location.href = url;
}

function pop(node) {
    return confirm("Are you sure you want to delete this? Click OK to continue or CANCEL to quit.");
}

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const navBtn = document.getElementById("navBtn");

    if(window.innerWidth > 991) {
        if (
            !sidebar.classList.contains("show_sidebar") &&
            !sidebar.classList.contains("hide_sidebar")
        ) {
            sidebar.classList.add("hide_sidebar");
        } else {
            if (sidebar.classList.contains("show_sidebar")) {
                sidebar.classList.remove("show_sidebar");
                sidebar.classList.add("hide_sidebar");
            } else {
                sidebar.classList.remove("hide_sidebar");
                sidebar.classList.add("show_sidebar");
            }
        }
    } else {
        if (
            !sidebar.classList.contains("show_sidebar") &&
            !sidebar.classList.contains("hide_sidebar")
        ) {
            sidebar.classList.add("show_sidebar");
        } else {
            if (sidebar.classList.contains("show_sidebar")) {
                sidebar.classList.remove("show_sidebar");
                sidebar.classList.add("hide_sidebar");
            } else {
                sidebar.classList.remove("hide_sidebar");
                sidebar.classList.add("show_sidebar");
            }
        }
    }

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

function add_field(event) {
    // Create the HTML elements
    var row = document.createElement('div');
    row.classList.add('row', 'info-row', 'mb-2');
  
    var col = document.createElement('div');
    col.classList.add('col-md-4', 'col-sm-12');
  
    var innerRow = document.createElement('div');
    innerRow.classList.add('row');
  
    var labelCol = document.createElement('div');
    labelCol.classList.add('col-6');
  
    var labelInput = document.createElement('input');
    labelInput.type = 'text';
    labelInput.name = 'info_label';
    labelInput.classList.add('info-label', 'form-control');
    labelInput.placeholder = 'Feature';
  
    var labelError = document.createElement('div');
    labelError.id = 'infoLabelError';
    labelError.classList.add('error');
  
    // var valueCol = document.createElement('div');
    // valueCol.classList.add('col-6');
  
    // var valueInput = document.createElement('input');
    // valueInput.type = 'text';
    // valueInput.name = 'info_value';
    // valueInput.classList.add('info-value', 'form-control');
    // valueInput.placeholder = 'Value';
  
    // var valueError = document.createElement('div');
    // valueError.id = 'infoValueError';
    // valueError.classList.add('error');
  
    // Append the HTML elements
    row.appendChild(col);
    col.appendChild(innerRow);
    innerRow.appendChild(labelCol);
    labelCol.appendChild(labelInput);
    labelCol.appendChild(labelError);
    // innerRow.appendChild(valueCol);
    // valueCol.appendChild(valueInput);
    // valueCol.appendChild(valueError);
  
    // Get the div with class 'additional-info-inputs'
    var additionalInfoDiv = document.querySelector('.additional-info-inputs');
  
    // Append the new elements to the div
    additionalInfoDiv.appendChild(row);
  
    // Prevent the default behavior of the button click event
    event.preventDefault();
}
  
function remove_field(event) {
    // Get all the div elements with the class 'info-row'
    var infoRows = document.querySelectorAll('.info-row'); 
    // Check if there is more than one 'info-row' div
    if (infoRows.length > 1) {
        // Get the last 'info-row' div
        var lastInfoRow = infoRows[infoRows.length - 1];
    
        // Remove the last 'info-row' div
        lastInfoRow.parentNode.removeChild(lastInfoRow);
    }
    // Prevent the default behavior of the button click event
    event.preventDefault();
}


function elemFocusToggle(elemClass, mouseoverClass, mouseoutClass) {
    $('.'+elemClass).on('mouseover', function () {
        $(this).addClass(mouseoverClass);
        $(this).removeClass(mouseoutClass);
    });
    $('.'+elemClass).on('mouseout', function () {
        $(this).removeClass(mouseoverClass);
        $(this).addClass(mouseoutClass);
    });
}

// Function to get the current page name from the URL
function getCurrentPageName() {
    // Get the full URL
    var url = window.location.href;

    // Use the URL to extract the page name
    var pageName = url.split('/').pop();

    return pageName;
}