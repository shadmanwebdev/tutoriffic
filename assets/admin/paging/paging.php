<?php
function _table_header() {
    return "<table class='table table-hover my-0'>
        <thead>
            <tr>
                <th>Subscription Id</th>
                <th class='d-none'>Name</th>
                <th class='d-none'>Status</th>
                <th class='d-none'>Amount</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>";
}
function _table_footer() {
    return "</tbody>
        </table>";
}
function _row_html($subscription_array) {
    $datetime_array = datetime_array($subscription_array['payment_created_at']);
    $date = $datetime_array['date'];
    $time = $datetime_array['time'];
    return "<tr>
        <td>
            <a href=\"subscription?sid={$subscription_array['subscription_id']}\">{$subscription_array['subscription_id']}</a>
        </td>
        <td class='d-none'>{$subscription_array['payment_name']}</td>
        <td class='d-none'>{$subscription_array['payment_status']}</td>
        <td class='d-none'>{$subscription_array['payment_amount']}</td>
        <td>{$date}</td>
    </tr>";
}










/*

========================================================
    Alter:
    1. $users_array = $this->get_users();
    2. $num_of_rows = count($users_array);
    3. $user_array = $users_array[$x];
    4. $contentStr .= $this->_table_footer();
    5. $contentStr .= $this->_row_html($user_array);
    6. $contentStr .= $this->_table_footer();
========================================================

*/

// Get page name
$pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);

// Get array of arrays
$users_array = $this->get_users();

$num_of_rows = count($users_array);

$results_per_page = 5;

// Number of total pages available
$num_of_pages = ceil($num_of_rows/$results_per_page);


// Determine which page user is currently on
$page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;

$starting_limit_number = ($page-1)*$results_per_page;

$contentStr = "";
$contentStr .= $this->_table_header();
for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
    if($x < $num_of_rows) {
        // Get item array
        $user_array = $users_array[$x];

        // Create the html to be appended for each item
        $contentStr .= $this->_row_html($user_array);
    }
}
$contentStr .= $this->_table_footer();

// Previous & next page
$prev = ($page == 1) ? $page : ($page - 1);
$next = ($page == $num_of_pages) ? $page : ($page + 1);





$paging = "<div class='pagination'>
<div>
    <a class='page-num arrow' href='./$pagename?page=" . ($page > 1 ? ($page - 1) : 1) . "'>
        <i class='fas fa-arrow-left'></i>
    </a>
</div>
<div class='pagination-links'>";

// Show links only if there is more than one page
if ($num_of_pages > 1) {
    // Show the current page and links for next 2 pages
    for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
        if ($p != $page) {
            $paging .= "<a class='page-num' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
        } else {
            $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
        }
    }
    // Skip links for 2 pages
    if ($page + 5 < $num_of_pages) {
        $paging .= "<span>...</span> ";
    }
    // Show the link for the 6th page if available
    if ($page + 4 < $num_of_pages) {
        $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 4) . "'>" . ($page + 4) . "</a> ";
    } 
    else if ($page + 3 < $num_of_pages) {
        $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 3) . "'>" . ($page + 3) . "</a> ";
    }
} else {
    // If there's only one page, show the link for the current page and previous/next page links
    $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $page . "'>" . $page . "</a> ";
}

$paging .= "</div>
    <div>
        <a class='page-num arrow' href='./$pagename?page=" . ($page < $num_of_pages ? ($page + 1) : $num_of_pages) . "'>
            <i class='fas fa-arrow-right'></i>
        </a>
    </div>
</div>";

$contentStr .= $paging;
echo $contentStr;
