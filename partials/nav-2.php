btn<style>
    .menu-items-flex {
        display: flex; 
        flex-flow: row nowrap;
        justify-content: flex-end;
    }
    @media screen and (max-width: 1280px) {
        .menu-items-flex {
            position: relative;
        }
    }
</style>
<!-- Header overly cart_quantity -->
<style>
    /*--------------------------------------------------------------
    # Header #01292a; rgba(1, 41, 42, 0.9)
    --------------------------------------------------------------*/
    #header {
        height: auto;
        transition: all 0.5s;
        z-index: 997;
        transition: all 0.5s;
        padding: 15px 0;
        --color: #4d4d4d;
        --color-2: #000;
        z-index: 10;
    }

    #header.header-scrolled {
        background: #fff;
        height: auto;
        padding: 15px 0;
    }


    /* @media (min-width: 1500px) {
        .container {
            max-width: 1140px;
        }
    } */
    @media screen and (min-width: 1500px) {
        
        #header .container {
            max-width: 90% !important;
            margin: 0 auto; 
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
            margin-top: 0;
        }
    }
    @media screen and (max-width: 992px) {
        header .container {
            max-width: 100vw !important; 
        }
    }

    /*--------------------------------------------------------------
    # Navigation Menu
    --------------------------------------------------------------*/
    /* Desktop Navigation */
    .nav-menu, .nav-menu * {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    /* .nav-menu > ul {
        display: flex;
        flex-flow: row nowrap;
    } */

    @media (min-width: 992px) {
        .nav-menu.d-lg-block {
            display: none !important;
        }
    }
    @media (min-width: 1280px) {
        .nav-menu.d-lg-block {
            display: block !important;
        }
    }

    .nav-menu > ul > li {
        position: relative;
        white-space: nowrap;
        float: left;
    }

    .nav-menu a {
        display: block;
        color: #000;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 15px;
        transition: 0.3s;
    }

    .nav-menu a:hover, 
    .nav-menu .active > a, 
    .nav-menu li:hover > a {
        /* color: #9cd5ce; */
        color: #000;
        text-decoration: none;
    }

    #header.header-scrolled .nav-menu a {
        color: #000;
        text-decoration: none;
    }

    .nav-menu .drop-down ul {
        display: block;
        position: absolute;
        left: 0;
        top: calc(100% - 30px);
        z-index: 99;
        opacity: 0;
        visibility: hidden;
        padding: 10px 0;
        background: #fff;
        box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
        transition: ease all 0.3s;
    }

    .nav-menu .drop-down:hover > ul {
        opacity: 1;
        top: 100%;
        visibility: visible;
    }

    .nav-menu .drop-down li {
        min-width: 180px;
        position: relative;
    }

    .nav-menu .drop-down ul a {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        text-transform: none;
        color: var(--color);
    }

    .nav-menu .drop-down ul a:hover, .nav-menu .drop-down ul .active > a, .nav-menu .drop-down ul li:hover > a {
        color: var(--color-2);
    }

    .nav-menu .drop-down > a:after {
        content: "\ea99";
        font-family: IcoFont;
        padding-left: 5px;
    }

    .nav-menu .drop-down .drop-down ul {
        top: 0;
        left: calc(100% - 30px);
    }

    .nav-menu .drop-down .drop-down:hover > ul {
        opacity: 1;
        top: 0;
        left: 100%;
    }

    .nav-menu .drop-down .drop-down > a {
        padding-right: 35px;
    }

    .nav-menu .drop-down .drop-down > a:after {
        content: "\eaa0";
        font-family: IcoFont;
        position: absolute;
        right: 15px;
    }

    @media (max-width: 1366px) {
        .nav-menu .drop-down .drop-down ul {
            left: -90%;
        }
        .nav-menu .drop-down .drop-down:hover > ul {
            left: -100%;
        }
        .nav-menu .drop-down .drop-down > a:after {
            content: "\ea9d";
        }
    }

    /* Mobile Navigation */
    .mobile-nav {
        position: fixed;
        top: 0;
        bottom: 0;
        z-index: 9999;
        overflow-y: auto;
        left: -300px;
        width: 300px;
        padding-top: 30px;
        background: #fff;
        transition: 0.4s;
    }

    .mobile-nav * {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .mobile-nav a {
        display: block;
        padding: 10px 20px;
        text-align: center;

        display: block;
        color: #000;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s;
    }

    .mobile-nav a:hover, .mobile-nav .active > a, .mobile-nav li:hover > a {
        color: var(--color-2);
        text-decoration: none;
    }

    .mobile-nav .drop-down > a:after {
        content: "\ea99";
        font-family: IcoFont;
        padding-left: 10px;
        position: absolute;
        right: 15px;
    }

    .mobile-nav .active.drop-down > a:after {
        content: "\eaa0";
    }

    .mobile-nav .drop-down > a {
        padding-right: 35px;
    }

    .mobile-nav .drop-down ul {
        display: none;
        overflow: hidden;
    }

    .mobile-nav .drop-down li {
        padding-left: 20px;
    }

    .mobile-nav-toggle {
        position: fixed;
        right: 15px;
        top: 15px;
        z-index: 9998;
        border: 0;
        background: none;
        font-size: 24px;
        transition: all 0.4s;
        outline: none !important;
        line-height: 1;
        cursor: pointer;
        text-align: right;
    }

    .mobile-nav-toggle i {
        color: #fff;
    }

    .mobile-nav-overly {
        width: 100%;
        height: 100%;
        z-index: 1;
        top: 0;
        left: 0;
        position: fixed;
        background-color: rgba(0, 0, 0, .5);
        overflow: hidden;
        display: none;
    }

    .mobile-nav-active {
        overflow: hidden;
    }

    .mobile-nav-active .mobile-nav {
        left: 0;
    }

    .mobile-nav-active .mobile-nav-toggle i {
        color: #fff;
    }
    @media screen and (max-width: 1280px) {
        #header {
            height: auto;
        }
    }


    
    /* Login / Register */
    .signup-btn {
        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
        margin-top: 20px;
        margin-left: 0px;
    }

    #nav-login, #nav-register {
        border-radius: 30px;
        padding: 10px 30px;
        display: flex;
        flex-flow: row nowrap;
        text-align: center;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        font-weight: 500;
        border: none;
        font-weight: bold;
    }
    #nav-login {
        width: 70%;
        margin: 0 auto 10px auto;

        color: #000;
        background-color: #fff;
        border: 1px solid #fff;
    }
    #nav-register {
        width: 70%;
        margin: 0 auto 10px auto;

        color: #000;
        background-color: #fff;
        border: 1px solid #fff;
    }
    #nav-login:hover {
      color: #fff;
      background: rgb(255,145,77);
      border: 1px solid rgb(255,145,77);
    }
    #nav-register:hover {
        color: #fff;
        background: rgb(255,145,77);
        border: 1px solid rgb(255,145,77);
    }

    /* Change button color on scroll */
    #header.header-scrolled #nav-login {
        color: #fff;
        background: rgb(255,145,77);
        border: 1px solid rgb(255,145,77);
    }
    #header.header-scrolled  #nav-register {
        color: #fff;
        background: rgb(255,145,77);
        border: 1px solid rgb(255,145,77);
    }

    @media screen and (min-width: 1280px) {
        .signup-btn {
            display: flex;
            flex-flow: row nowrap;
            margin: 0 0 0 30px;
        }
        #nav-login {
            width: auto;
            margin-left: 0;
            margin-right: 10px;
            margin-bottom: 0px;
        }
        #nav-register {
            width: auto;
            margin-left: 0;
            margin-right: 10px;
            margin-bottom: 0px;
        }
    }

    /* Mobile navigation button */
    #navBtn {
        position: absolute;
        z-index: 10001;
        top: 12px;
        right: 10px;
        display: grid;
        grid-template-rows: auto;
        grid-template-columns: 1fr;
        row-gap: 5px;
        cursor: pointer;
        width: 28px;
    }
    #navBtn span {
        width: 28px;
        height: 2px;
        background-color: #000;
    }
    /* Rotate */
    #navBtn span.rotate-left, #navBtn span.rotate-right {
        transition: .5s;
        position: absolute;
        top: 6px;
        z-index: 10001;
        background-color: #fff;
    }
    .rotate-left {
        transform: rotateZ(45deg);
    }
    .rotate-right {
        transform: rotateZ(-45deg);
    }
    .rotate-left-rev {
        transform-origin: center;
        animation: .5s ani-rev-left ease-in-out forwards;
    } 
    .rotate-right-rev {
        transform-origin: center;
        animation: .5s ani-rev-right ease-in-out forwards;
    }
    /* Animate */
    @keyframes ani-rev-left {
        0% {
            transform: rotateZ(45deg);
        }
        100% {
            transform: rotateZ(0deg);
        }
    }
    @keyframes ani-rev-right {
        0% {
            transform: rotateZ(-45deg);
        }
        100% {
            transform: rotateZ(0deg);
        }
    }
    .hide {
        opacity: 0;
    }
    .show {
        opacity: 1;
    }

    /* Change mobile menu color on scroll */
    #header.header-scrolled #navBtn span {
        background-color: #000;
    }

    /* Change which logo to display (light/dark) on scroll */
    #header .logo {
        display: flex;
        align-items: center;
        width: 250px;
    }
    #header .logo a {
      display: block;
      width: inherit;
    }
    #header .logo img {
        width: inherit;
    }
    #header .logo-dark {
        display: none;
    }
    #header.header-scrolled .logo {
        display: none !important;
    }
    #header.header-scrolled .logo-dark {
        display: flex !important;
    }
    @media screen and (min-width: 1280px) {
        #navBtn {
            display: none;
        }
    }
</style>


<style>
    .menu-icons {
        display: flex;
        flex-flow: row nowrap;
    }
    @media screen and (max-width: 1280px) {
        .menu-icons {
            position: relative;
            right: 50px;
        }
    }
</style>


<!-- Profile dropdown -->
<style>
    .profile-btn {
        /* padding-top: 5px; */
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .profile-btn .avatar {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .profile-btn .picture {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
        background-color: rgb(255,145,77) !important;
    }
    .profile-btn .user-no-picture {
        font-size: 40px;
        width: 100%;
        height: 100%;
        /* background-color: rgb(255,145,77); */
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
    }
    .profile-dropdown-wrapper {
        float: right;
        width: 38px;
        position: relative;
        margin-left: 20px;
        /* min-width: 100px; */
    }
    .profile-dropdown {
        width: 240px;
        height: auto;
        -webkit-border-radius: 24px;
        border-radius: 16px;
        /* display: block; */
        background-color: #fff;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        padding: 15px 10px;
        border: 1px solid #d9d9d9;
        transition: .3s;

        display: none;
        position: absolute;
        z-index: 2;
        right: -20px;
    }
    .profile-dropdown.show-profile-dropdown {
        display: block;
        position: absolute;
        top: 130%;
        z-index: 1000;
    }
    .profile-dropdown .item {
        display: flex;
        align-items: center;
        border-radius: 5px;
        transition: .3s;
        font-weight: 600;
        font-size: 14px;
    }
    .profile-dropdown .item a {
        font-size: 14px;
        color: #000;
        display: block;
        padding: 0;
        padding: 10px 20px 10px 20px;
    }
    .profile-dropdown .item:hover {
        background-color: #edf5ff;
        cursor: pointer;
    }

    

    /* Change user icon color on scroll */
    #header.header-scrolled .picture i  {
        color: #000;
    }
</style>


<!-- Cart -->
<style>
    
    .cart-wrapper {
        float: right;
        width: 38px;
        position: relative;
        margin-left: 0px;
    }
    #header-cart-btn {
        cursor: pointer;
        overflow: visible;
    }
    .cart-list {
        background-color: #fff;
        box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
        -webkit-transition-duration: 750ms;
        transition-duration: 750ms;
        border-radius: 0;
        display: none;
        position: absolute;
        right: -44px;
        top: 48px;
        width: 280px;
        z-index: 120;
        padding: 10px;
    }
    .cart-list li {
        border-bottom: 1px solid #ebebeb;
        padding: 20px 15px;
        display: flex;
        flex-flow: row nowrap;
        position: relative;
    }
    .cart-list li .image {
        width: 50px;
        height: 50px;
    }
    .cart-list .image > img {
        width: 50px;
        height: 50px;
    }
    .cart-item-desc {
        padding-left: 15px;
        line-height: 1;
    }
    .cart-item-desc h6 {
        line-height: 1;
        font-size: 14px;
    }
    .cart-item-desc > p {
        font-size: 14px;
        margin: 0;
    }
    .dropdown-product-remove {
        position: absolute;
        right: 15px;
        top: 17px;
        line-height: 1;
        cursor: pointer;
    }
    .dropdown-product-remove i:before {
        font-size: 13px;
    }
    .dropdown-product-remove {
        color: #000;
    }
    .dropdown-product-remove {
        color: #000;
    }
    .cart-list li .btn-checkout, 
    .cart-list li .btn-cart {
        border-radius: 0;
        color: #fff;
        font-size: 13px;
    }
    .cart-list li .btn-checkout {
        background-color: #000;
    }
    .cart-list li .btn-cart {
        color: #3a3a3a;
        border: 1px solid #3a3a3a;
        margin-left: 5px;
    }
    .btn-group-sm > .btn, .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .cart > a {
        position: relative;
        z-index: 1;
        padding: 0;
        
        /* background-color: rgb(255,145,77); */
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
    }
    .cart > a > i.icon-shopping-cart {
        font-size: 20px;
        width: 100%;
        height: 100%;
        /* background-color: rgb(255,145,77); */
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
    }
    .cart > a > i.icon-shopping-cart {
        color: #fff;
    }
    .cart_quantity {
        border: 1px solid #000;
        background-color: #fff;
        border-radius: 50%;
        color: #000;
        font-size: 10px;
        height: 20px;
        line-height: 20px;
        position: absolute;
        right: -3px;
        bottom: 0px;
        text-align: center;
        width: 20px;
        z-index: 2;
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        font-weight: 600;
    }
    #cart-dropdown.cart-data-open {
        display: block;
    }

    h6 a,
    .cart-item-desc p,
    .cart-item-desc p span {
        color: #000;
    }
    .cart-item-desc p {
        margin-bottom: 5px;
    }
    .cart-list li.cart-btns {
        /* border-bottom: 1px solid #ebebeb; */
        border: none;
        padding: 0px 15px;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    /* Change cart icon color on scroll */
    #header.header-scrolled .cart > a > i.icon-shopping-cart  {
        color: #000;
    }
    .cart-list .cart-total {
        margin: 0 auto;
        color: #000;
    }
    @media (max-width: 1280px) {   
        .cart-wrapper {
            margin-left: 0px;
        }
    }
    @media (max-width: 992px) {   
        .cart-list {
            right: 0;
        }
    }
</style>

<?php
    $a = 1;
    $page = get_pagename();
    if(
        $page != '' && $page != 'index'
    ) {
?>
    <style>
        #header {
            background-color: #fff;
            border-bottom: 1px solid #e8e8e8;
        }
        .nav-menu li a {
            color: #000;
        }

        .nav-menu li a:hover, 
        .nav-menu li.active > a, 
        .nav-menu li:hover > a {
            color: #000;
        }
        /* Change which logo to display (light/dark) on scroll */
        #header .logo {
            display: none;
            align-items: center;
        }
        #header .logo-dark {
            display: flex;
        }
        #header.header-scrolled .logo {
            display: none !important;
        }
        #header.header-scrolled .logo-dark {
            display: flex !important;
        }

        /* Change user icon color on scroll */
        #header .picture i  {
            color: #000;
        }
        #header.header-scrolled .picture i  {
            color: #000;
        }

        /* Change cart icon color on scroll */
        #header .cart > a > i.icon-shopping-cart  {
            color: #000;
        }
        #header.header-scrolled .cart > a > i.icon-shopping-cart  {
            color: #000;
        }



        #nav-login {
            color: #fff;
            background: rgb(255,145,77);
            border: 1px solid rgb(255,145,77);
        }
        #nav-register {
            color: #fff;
            background: rgb(255,145,77);
            border: 1px solid rgb(255,145,77);
        }


    </style>

<?php
    } else {
?> 

<style>

</style>


<?php
    }
?>







<!-- Header -->
<header id="header" class="fixed-top">
    <div class="container" style=''>

        <div class="logo float-left">
            <a href="./">
                <img src="assets/New TUTORiffic logo (2)-cropped.png" alt="" class="img-fluid">
            </a>
        </div>
        <div class="logo logo-dark float-left">
            <a href="./">
                <img src="assets/New TUTORiffic logo (2)-cropped.png" alt="" class="img-fluid">
            </a>
        </div>

        <div class='menu-items-flex'>

            <nav class="nav-menu float-right d-none d-lg-block">
                <ul>
    
                <?php
                    if(isset($_SESSION['user'])) {
                        // var_dump($_SESSION['user']);
                        // $user = new User;
                        // $logged_in = $user->is_logged_in();
                        // if($logged_in == '1') {
                            
                    
                        // }
                    }
                ?>
    
                <?php
                    if(!isset($_SESSION['user'])) {
                        
                            
                ?>
                      <li class=""><a href="#find-a-tutor">Find a tutor</a></li>
                      <li class=""><a href="./find-a-tuition-centre">Find a tuition centre</a></li>
                      <li class=""><a href="#how-it-works">How It Works</a></li>
                      <li class=""><a href="./faq">FAQ</a></li>
                      <li class='signup-btn'>
                          <a href='./login' id='nav-login'>Log In</a>
                          <a href='./create-account' id='nav-register'>JOIN</a>
                      </li>
                
                <?php
                    
                    }
                ?>
    
    
                </ul>
            </nav><!-- .nav-menu -->

            <?php
                if(isset($_SESSION['user'])) {          
            ?>

            <div class='menu-icons'>
              <div class='profile-dropdown-wrapper'>
                <div class='profile-btn'>
                  <div class='avatar' style='width: 38px; height: 38px; cursor: pointer;'>
                    <div class='picture'>
                      <?php
                          $user->profile_image();
                      ?>
                    </div>
                  </div>
                </div>
                <div class='profile-dropdown'>
                  <div class='item'>
                    <a href="./dashboard">Dashboard</a>
                  </div>
                  <div class='item'>
                    <a href="./messages">Messages</a>
                  </div>
                  <div class='item'>
                    <a href="./my-account">My Profile</a>
                  </div>
                  <div class='item'>
                    <a href="./controllers/logout-handler">Log Out</a>
                  </div>
                </div>
              </div>
            </div>

            <?php     
                }
            ?>
            

            <!-- Mobile menu hamburger -->
            <div id="navBtn" class='mobile-nav-toggle' onclick='mobile_menu()'>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>



    </div>
</header>



<!-- Mobile menu -->
<script defer>
    function mobile_menu() {
        var body = document.querySelectorAll('body')[0];
        var navBtn = document.getElementById('navBtn');
        var navSpansAll = document.querySelectorAll('#navBtn > span');

        if(body.classList.contains('mobile-nav-active')) {
            console.log('1');
            navBtn.style.height = "18px";
            navSpansAll.forEach(element => {

                if(element = navSpansAll[0]) {
                    navSpansAll[0].classList.remove('rotate-left');
                    navSpansAll[0].classList.add('rotate-left-rev');
                }
                if(element = navSpansAll[1]) {
                    navSpansAll[1].classList.remove('hide');
                    navSpansAll[1].classList.add('show');
                }
                if(element = navSpansAll[2]) {
                    navSpansAll[2].classList.remove('rotate-right');
                    navSpansAll[2].classList.add('rotate-right-rev');
                }
            });

            return;
        } else {
            console.log('2');
            navBtn.style.height = "18px";
            navSpansAll.forEach(element => {
                if(element = navSpansAll[0]) {
                    navSpansAll[0].classList.remove('rotate-left-rev');
                    navSpansAll[0].classList.add('rotate-left');
                }
                if(element = navSpansAll[1]) {
                    navSpansAll[1].classList.remove('show');
                    navSpansAll[1].classList.add('hide');
                }
                if(element = navSpansAll[2]) {
                    navSpansAll[2].classList.remove('rotate-right-rev');
                    navSpansAll[2].classList.add('rotate-right');
                }
            });
            return;
        }
    }
</script>

<!-- Scroll, Mobile Navigation -->
<script defer>
    
    // Toggle .header-scrolled class to #header when page is scrolled
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
            var navBtn = document.getElementById('navBtn');
            navBtn.style.top = '10px';
        } else {
            $('#header').removeClass('header-scrolled');
            var navBtn = document.getElementById('navBtn');
            navBtn.style.top = '10px';
        }
    });

    if ($(window).scrollTop() > 100) {
        $('#header').addClass('header-scrolled');
    }

    // Smooth scroll for the navigation menu and links with .scrollto classes
    $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            e.preventDefault();
            var target = $(this.hash);
            if (target.length) {

                var scrollto = target.offset().top;
                var scrolled = 20;

                if ($('#header').length) {
                    scrollto -= $('#header').outerHeight()

                    if (!$('#header').hasClass('header-scrolled')) {
                        scrollto += scrolled;
                    }
                }

                if ($(this).attr("href") == '#header') {
                    scrollto = 0;
                }

                $('html, body').animate({
                    scrollTop: scrollto
                }, 1500, 'easeInOutExpo');

                if ($(this).parents('.nav-menu, .mobile-nav').length) {
                    $('.nav-menu .active, .mobile-nav .active').removeClass('active');
                    $(this).closest('li').addClass('active');
                }

                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
                    $('.mobile-nav-overly').fadeOut();
                }
                return false;
            }
        }
    });

    // Mobile Navigation
    if ($('.nav-menu').length) {
        var $mobile_nav = $('.nav-menu').clone().prop({
        class: 'mobile-nav'
        });
        $('body').append($mobile_nav);
        // $('body').prepend('<button type="button" class="mobile-nav-toggle"><i class="icofont-navigation-menu"></i></button>');
        $('body').append('<div class="mobile-nav-overly"></div>');

        $(document).on('click', '.mobile-nav-toggle', function(e) {
            $('body').toggleClass('mobile-nav-active');
            $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
            $('.mobile-nav-overly').toggle();
        });

        $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
            e.preventDefault();
            $(this).next().slideToggle(300);
            $(this).parent().toggleClass('active');
        });

        $(document).click(function(e) {
            var container = $(".mobile-nav, .mobile-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
                    $('.mobile-nav-overly').fadeOut();
                }
            }
        });
    } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
        $(".mobile-nav, .mobile-nav-toggle").hide();
    }

    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    $('.back-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1500, 'easeInOutExpo');
        return false;
    });



    $('.mobile-nav-overly').on('click', function () {
        var body = document.querySelectorAll('body')[0];
        var navBtn = document.getElementById('navBtn');
        var navSpansAll = document.querySelectorAll('#navBtn > span');

        if(body.classList.contains('mobile-nav-active')) {
            navBtn.style.height = "18px";
            navSpansAll.forEach(element => {

                if(element = navSpansAll[0]) {
                    navSpansAll[0].classList.remove('rotate-left');
                    navSpansAll[0].classList.add('rotate-left-rev');
                }
                if(element = navSpansAll[1]) {
                    navSpansAll[1].classList.remove('hide');
                    navSpansAll[1].classList.add('show');
                }
                if(element = navSpansAll[2]) {
                    navSpansAll[2].classList.remove('rotate-right');
                    navSpansAll[2].classList.add('rotate-right-rev');
                }
            });
            document.querySelector('.mobile-nav-overly').style.display = 'none';

            return;
        }
    });
</script>

<!-- Profile Dropdown -->
<script defer>
    function closeProfileDropdown() {
        const profileTrigger = document.querySelector('.profile-btn');
        const profileDropdown = document.querySelector('.profile-dropdown');
        if(profileDropdown && profileDropdown != null) {
            if (profileDropdown.classList.contains('show-profile-dropdown')) {
                profileDropdown.classList.remove('show-profile-dropdown');
            }
        } else {
            console.log('profile dropdown not found');
        }
        if(profileTrigger && profileTrigger != null) {
            if (profileTrigger.classList.contains('show-profile-dropdown')) {
                profileTrigger.classList.remove('show-profile-dropdown');
            }
        } else {
            console.log('profile button not found');
        }
    }
    function profileDropdown() { 
        const profileTrigger = document.querySelector('.profile-btn'); 
        if(profileTrigger && profileTrigger != null) {
            profileTrigger.addEventListener('click', function (event) {
                const profileDropdown = document.querySelector('.profile-dropdown');      
                if(profileDropdown && profileDropdown != null) {
                    if (profileDropdown.classList.contains('show-profile-dropdown')) {
                        profileTrigger.classList.remove('show-profile-dropdown');
                        profileDropdown.classList.remove('show-profile-dropdown');
                    } else {
                        profileTrigger.classList.add('show-profile-dropdown');
                        profileDropdown.classList.add('show-profile-dropdown');
                    }
                }
            });
        }
    }
    
    const body = document.querySelector('body'); 
    body.addEventListener('click', function (event) {
        const profileTrigger = document.querySelector('.profile-btn'); 
        const profileDropdown = document.querySelector('.profile-dropdown');
        if(
            profileTrigger && profileTrigger != null &&
            profileDropdown && profileDropdown != null
        ) { 
            // Check if the target is not the element or a descendant
            if (!profileTrigger.contains(event.target) && !profileDropdown.contains(event.target)) {
                // Close the dropdown
                closeProfileDropdown();
            }
        }
    });

    profileDropdown();
</script>
