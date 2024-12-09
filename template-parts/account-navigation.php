<?php
    if(!isset($_SESSION['user'])) {
        header('location: ./');
    }
?>

<?php
    $page = get_pagename();
    if(
      $page == 'my-account' || $page == 'my-payments' || $page == 'payment-method'
    ) {
        $myAccountHighlight = "link-active";
        $messagesHighlight = "";
        $adsHighlight = "";
        $dashboardHighlight = "";
        $scheduledLessons = "";
        $availabilityLessons = "";
    } else if(
        $page == 'dashboard'
    ) {
        $myAccountHighlight = "";
        $messagesHighlight = "";
        $adsHighlight = "";
        $dashboardHighlight = "link-active";
        $scheduledLessons = "";
        $availabilityLessons = "";
    } else if(
        $page == 'my-ads'
    ) {
        $myAccountHighlight = "";
        $messagesHighlight = "";
        $adsHighlight = "link-active";
        $dashboardHighlight = "";
        $scheduledLessons = "";
        $availabilityLessons = "";
    } else if(
        $page == 'messages'
    ) {
        $myAccountHighlight = "";
        $messagesHighlight = "link-active";
        $adsHighlight = "";
        $dashboardHighlight = "";
        $scheduledLessons = "";
        $availabilityLessons = "";
    } else if(
        $page == 'scheduled-lessons' ||
        $page == 'free-lessons' ||
        $page == 'regular-lessons' ||
        $page == 'upcoming-lessons'
    ) {
        $myAccountHighlight = "";
        $messagesHighlight = "";
        $adsHighlight = "";
        $dashboardHighlight = "";
        $scheduledLessons = "link-active";
        $availabilityLessons = "";
    } else if(
        $page == 'availability'
    ) {
        $myAccountHighlight = "";
        $messagesHighlight = "";
        $adsHighlight = "";
        $dashboardHighlight = "";
        $scheduledLessons = "";
        $availabilityLessons = "link-active";
    }
?>


<style>
    /* .account-header.account-header-scrolled {
        top: 60px;
    } */
    .account-header {
        /* position: fixed; */
        /* top: 80px; */ /* Check the height of the main navbar */
        width: 100%;
        background-color: #222;
        margin-top: 50px;
        margin-bottom: 10px;
        transition: all 0.5s;
    }
    .account-header ul {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        padding: 0;
        max-width: 1060px;
        width: 95%;
        list-style: none;
    }
    .account-header ul li {
        height: 57px;
        display: flex;
        align-items: center;
        margin-right: 20px;
    }
    .account-header ul li a {
        color: #a6a6a6;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
    }
    .account-header ul li.link-active {
        border-bottom: 2px solid #fff;
    }
    .account-header ul li.link-active a {
        color: #fff;
    }
    @media screen and (max-width: 768px) {
        .account-header ul li {
            margin-right: 15px;
        }
    }
</style>



<nav class="account-header" id="account-header">
    <ul>
        <li class="<?= $dashboardHighlight; ?>"><a href="./dashboard" class="home-highlight" data-label="Dashboard" pa-marked="1">Dashboard</a></li>
        <li class="<?= $messagesHighlight; ?>"><a href="./messages" class="messages-highlight force-highlight" data-label="My Messages" pa-marked="1">My Messages</a></li>
        <li class="<?= $adsHighlight; ?>"><a href="./my-ads" class="annonces-highlight" data-label="My Ads" pa-marked="1">My Ads</a></li>
        <li class="<?= $myAccountHighlight; ?>"><a href="./my-account" class="comptes-highlight" data-label="My Account" pa-marked="1">My Account</a></li>
        <li class="<?= $scheduledLessons; ?>"><a href="./scheduled-lessons" class="comptes-highlight" data-label="Mon compte" pa-marked="1">Lessons</a></li>
        <li class="<?= $availabilityLessons; ?>"><a href="./availability" class="comptes-highlight" data-label="My Availability" pa-marked="1">My Availability</a></li>
        <!-- <li class="selected-sub-bar" style="left: 118px; width: 92px;"></li> -->
    </ul>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('account-header');
        function handleScroll() {
            if (window.scrollY > 100) {
                header.classList.add('account-header-scrolled');
            } else {
                header.classList.remove('account-header-scrolled');
            }
        }
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check
    });
</script>