
<style>
    .sub-bar-account {
        --header-height: 88px;
        --navigation-height: 57px;
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
      $page == 'my-account'
    ) {
        $myAccountHighlight = "link-exact-active";
        $receiptsHighlight = "";
        $paymentsHighlight = "";
    } else if(
        $page == 'my-receipts'
    ) {
        $myAccountHighlight = "";
        $receiptsHighlight = "link-exact-active";
        $paymentsHighlight = "";
    } else if(
        $page == 'my-payments' || $page == 'payment-method'
    ) {
        $myAccountHighlight = "";
        $receiptsHighlight = "";
        $paymentsHighlight = "link-exact-active";
    }
?>

<div class="sub-bar-account">
    <div class="wrapper">
        <a href="./my-account" class="<?= $myAccountHighlight; ?>" data-label="My profile">My profile</a>
        <a href="./my-receipts" class="<?= $receiptsHighlight; ?>" data-label="My Receipts">My Receipts</a>
        <a href="./payment-method" class="<?= $paymentsHighlight; ?>" data-label="My Payments">My Payments</a>
    </div>
</div>