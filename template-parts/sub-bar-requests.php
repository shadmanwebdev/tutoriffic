
<style>
    .sub-bar-account {
        --header-height: 88px;
        --navigation-height: 57px;
        /* left: 0; */
        width: 100%;
        background-color: #fff;
        vertical-align: middle;
        line-height: 50px;
    }
    .sub-bar-account .wrapper {
        max-width: 1060px;
        margin: 0 auto;
    }


    
    .sub-bar-account .wrapper a {
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        color: #a6a6a6;
        margin-right: 40px;
        cursor: pointer;
    }
    .sub-bar-account .wrapper a {
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        color: #a6a6a6;
        margin-right: 40px;
        cursor: pointer;
    }

    .sub-bar-account .wrapper a.link-exact-active, .sub-bar-account .wrapper a.link-exact-active {
        color: #222;
        font-weight: 700;
    }
    .sub-bar-account .wrapper a.link-exact-active, .sub-bar-account .wrapper a.link-exact-active {
        color: #222;
        font-weight: 700;
    }
</style>


<?php
    $a = 1;
    $page = get_pagename();
    if(
      $page == 'scheduled-lessons'
    ) {
        $lessonsHighlight = "link-exact-active";
        $freeHighlight = "";
        $regularHighlight = "";
        $upcomingHighlight = "";
    } else if(
        $page == 'free-lessons'
    ) {
        $lessonsHighlight = "";
        $freeHighlight = "link-exact-active";
        $regularHighlight = "";
        $upcomingHighlight = "";
    } else if(
        $page == 'regular-lessons'
    ) {
        $lessonsHighlight = "";
        $freeHighlight = "";
        $regularHighlight = "link-exact-active";
        $upcomingHighlight = "";
    } else if(
        $page == 'upcoming-lessons'
    ) {
        $lessonsHighlight = "";
        $freeHighlight = "";
        $regularHighlight = "";
        $upcomingHighlight = "link-exact-active";
    }
?>

<div class="sub-bar-account">
    <div class="wrapper">
        <a href="./scheduled-lessons" class="<?= $lessonsHighlight; ?>" data-label="Scheduled Lessons">All Lessons</a>
        <a href="./free-lessons" class="<?= $freeHighlight; ?>" data-label="Free Lessons">Free Lessons</a>
        <a href="./regular-lessons" class="<?= $regularHighlight; ?>" data-label="Regular Lessons">Regular Lessons</a>
        <a href="./upcoming-lessons" class="<?= $upcomingHighlight; ?>" data-label="Upcoming Lessons">Upcoming Lessons</a>
    </div>
</div>