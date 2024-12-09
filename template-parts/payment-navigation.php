<?php
    $page = get_pagename();
    if($page == 'payment-method') {
        $paymentMethodHighlight = "link-active";
        $paymentsHighlight = "";
        $subscriptionsHighlight = "";
    } else if ($page == 'my-payments') {
        $paymentMethodHighlight = "";
        $paymentsHighlight = "link-active";
        $subscriptionsHighlight = "";
    } else if ($page == 'my-subscriptions') {
        $paymentMethodHighlight = "";
        $paymentsHighlight = "";
        $subscriptionsHighlight = "link-active";
    }
?>

<style>
    .payment-nav {
        background-color: #fff;
        padding: 30px;
        width: 100%;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border-radius: 5px;
        font-weight: 400;
    }
    .payment-nav a {
        display: block;
        position: relative;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        margin-bottom: 25px;
        color: #222;
    }
    .payment-nav a.link-active {
        color: rgb(255,145,77);
        font-weight: 700;
    }
</style>


<div class="payment-nav">
    <a href="./payment-method" class="<?= $paymentMethodHighlight; ?>" data-label="Method of Payment">Method of Payment</a>
    <a href="./my-payments" class="<?= $myPaymentsHighlight; ?>" data-label="Payments">Payments</a>
    <a href="./my-subscriptions" class="<?= $mySubscriptionsHighlight; ?>" data-label="Subscriptions">Subscriptions</a>
</div>