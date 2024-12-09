
<!-- button -->
<style>
  .rotate-left {
    transform: rotateZ(45deg);
    transition: .5s;
    position: absolute;
    top: 0px;
  }
  .rotate-left-rev {
      transform-origin: center;
      animation: .5s ani-rev-left ease-in-out forwards;
  }
  @keyframes ani-rev-left {
      0% {
          transform: rotateZ(45deg);
      }
      100% {
          transform: rotateZ(0deg);
      }
  }
  .rotate-right {
      transform: rotateZ(-45deg);
      transition: .5s;
      position: absolute;
      top: 0px;
  }
  .rotate-right-rev {
      transform-origin: center;
      animation: .5s ani-rev-right ease-in-out forwards;
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
  #navBtn {
    position: fixed !important;    
    z-index: 10003 !important;
      display: none;
      top: 30px;
      right: 10px !important;
  }
  @media screen and (max-width: 1280px) {
      #navBtn {
          display: grid;
          grid-template-rows: auto;
          grid-template-columns: 1fr;
          row-gap: 7px;
          cursor: pointer;
          width: 28px;
          height: 19px;
          /* position: relative;
          z-index: 0; */
      }
      #navBtn span {
          width: 28px;
          height: 2px;
          background-color: #000;
      }
      #navBtn span.rotate-left {
          z-index: 10001;
        background-color: #fff;
      }
      #navBtn span.rotate-right {
          z-index: 10001;
        background-color: #fff;
      }
  }
</style>




    

    <style>

        /*--------------------------------------------------------------
        # Header #01292a; rgba(1, 41, 42, 0.9)
        --------------------------------------------------------------*/
        #header {
            height: 80px;
            transition: all 0.5s;
            z-index: 997;
            transition: all 0.5s;
            padding: 20px 0;
            /* background: #2d6760; */
            --color: #4d4d4d;
            --color-2: #000;
            z-index: 10;
        }

        #header.header-scrolled {
          /* background: #1d443f; */
          background: #fff;
          height: 60px;
          padding: 10px 0;
        }

        
        header .container {
          max-width: 98vw !important; 
          margin: 0 auto; 
          padding-left: 0px !important; 
          padding-right: 0px !important;
        }
        @media screen and (max-width: 992px) {
          header .container {
            max-width: 100vw !important; 
          }
        }

        #header .logo h1 {
          font-size: 30px;
          margin: 0;
          padding: 0;
          line-height: 1;
          font-weight: 700;
          letter-spacing: 1px;
        }

        #header .logo h1 a, #header .logo h1 a:hover {
          color: #fff;
          text-decoration: none;
        }

        #header .logo img {
          padding: 0;
          margin: 0;
          max-height: 40px;
        }

        @media (max-width: 768px) {
          #header .logo h1 {
              font-size: 28px;
              padding: 8px 0;
          }
        }

        #main {
          margin-top: 80px;
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

        .nav-menu > ul > li {
        position: relative;
        white-space: nowrap;
        float: left;
        }

        .nav-menu a {
          display: block;
          position: relative;
          /* color: #d2ece9; * */
          color: var( --color);
          /* color: #000; */
          padding: 10px 15px;
          transition: 0.3s;
          font-size: 14px;
          font-family: "Open Sans", sans-serif;
        }

        .nav-menu a:hover, 
        .nav-menu .active > a, 
        .nav-menu li:hover > a {
          /* color: #9cd5ce; */
          color: var( --color-2);
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
          left: -260px;
          width: 260px;
          padding-top: 18px;
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
          position: relative;
          color: var(--color);
          padding: 10px 20px;
          font-weight: 500;
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
          z-index: 9997;
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

    </style>

<?php
    $a = 1;
    $page = get_pagename();
    // var_dump($page);
    if(
      $page != '' && $page != 'index'
    ) {
  ?>
<style>
  #header {
    background-color: #fff;
    border-bottom: 1px solid #e8e8e8;
  }
</style>

<?php
  } else {
    ?> 
<style>
  #header {
  }
</style>



<style>
  .signup-btn {
    display: flex;
    flex-flow: row nowrap;
    column-gap: 10px;
    margin-left: 30px;
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
    color: #000;
    background-color: #fff;
      border: 1px solid #fff;
      /* color: rgb(255,145,77);
      background-color: transparent;
      border: 1px solid rgb(255,145,77); */
  }
    #nav-register {
    color: #000;
    background-color: #fff;
      border: 1px solid #fff;
      /* color: #fff;
      background: rgb(255,145,77);
      border: 1px solid rgb(255,145,77);
      margin-right: 10px; */
    }
    #nav-login:hover, #nav-register:hover {
      color: #fff;
      background: rgb(255,145,77);
      border: 1px solid rgb(255,145,77);
    }
</style>



<?php
  }
?>

<style>
    header .container {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
    }
</style>

    <div id="navBtn" class='mobile-nav-toggle d-lg-none' onclick='mobile_menu()'>
      <span></span>
      <span></span>
      <span></span>
    </div>

    <header id="header" class="fixed-top">
        <div class="container" style=''>
    
            <!-- Logo -->
            <div class="logo float-left">
                <a href="./"><img src="assets/New TUTORiffic logo (2)-cropped.png" alt="" class="img-fluid"></a>
            </div>


            <!-- Search -->
            <?php
                include './template-parts/search.php';
            ?>


            <!-- Nav -->
            <nav class="nav-menu float-right d-none d-lg-block">
                <ul>

                <?php
                    if(isset($_SESSION['user'])) {
                        // var_dump($_SESSION['user']);
                        // $user = new User;
                        // $logged_in = $user->is_logged_in();
                        // if($logged_in == '1') {
                            
                ?>

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
                        cursor: pointer;
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
                        background-color: rgb(255,145,77);
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
                </style>

                <style>
                    .profile-dropdown-wrapper {
                        float: right;
                        width: 38px;
                        position: relative;
                        margin-left: 20px;
                        /* min-width: 100px; */
                    }
                    .profile-dropdown {
                        /* width: 308px; */
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
                        padding: 10px 120px 10px 20px;
                        display: flex;
                        align-items: center;
                        border-radius: 5px;
                        transition: .3s;
                        font-weight: 600;
                        font-size: 14px;
                    }
                    .profile-dropdown .item a {
                        font-size: 14px;
                    }
                    .profile-dropdown .item:hover {
                        background-color: #FFEDE3;
                    }
                    .profile-dropdown .item a {
                        padding: 0;
                    }
                </style>

                <div class='profile-dropdown-wrapper'>
                    <div class='profile-btn'>
                    <div class='avatar'>
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


                <script defer>
                    

                    function closeProfileDropdown() {
                        const profileTrigger = document.querySelector('.profile-btn');
                        const profileDropdown = document.querySelector('.profile-dropdown');
                        profileDropdown.classList.remove('show-profile-dropdown');
                        profileTrigger.classList.remove('show-profile-dropdown');
                    }
                    function profileDropdown() { 
                        const profileTrigger = document.querySelector('.profile-btn'); 
                        profileTrigger.addEventListener('click', function (event) {
                        const profileDropdown = document.querySelector('.profile-dropdown');
                            
                            if (profileDropdown.classList.contains('show-profile-dropdown')) {
                                profileTrigger.classList.remove('show-profile-dropdown');
                                profileDropdown.classList.remove('show-profile-dropdown');
                            } else {
                                profileTrigger.classList.add('show-profile-dropdown');
                                profileDropdown.classList.add('show-profile-dropdown');
                            }
                        });
                    }
                    // const body = document.querySelector('body'); 
                    // body.addEventListener('click', function (event) {
                    //   closeProfileDropdown();
                    // });
                    profileDropdown();
                </script>

                <?php
                    
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
                    <a href='./create-account' id='nav-login'>Log In</a>
                    <a href='./create-account' id='nav-register'>JOIN</a>
                </li>
                <!-- <li class="drop-down"><a href="">Students</a>
                    <ul>
                    <li><a onclick="popup('join-popup');account_type(2);">Student Sign Up</a></li>
                    <li><a href="#">Find A Tutor</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="">Tutors</a>
                    <ul>
                    <li><a onclick="popup('join-popup');account_type(3);">Tutor Sign Up</a></li>
                    <li><a href="#">Find A Student</a></li>
                    </ul>
                </li> -->

                
                <?php
                    
                    }
                ?>


                </ul>
            </nav><!-- .nav-menu -->
    
        </div>
      </header>






      <script defer>
        function account_type(id) {
          $('#user_account_type_id').val(id);
        }
       
        // Toggle .header-scrolled class to #header when page is scrolled
        $(window).scroll(function() {
          if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
            var navBtn = document.getElementById('navBtn');
            navBtn.style.top = '20px';
          } else {
            $('#header').removeClass('header-scrolled');
            var navBtn = document.getElementById('navBtn');
            navBtn.style.top = '30px';
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
            class: 'mobile-nav d-lg-none'
          });
          $('body').append($mobile_nav);
          // $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
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
                      navBtn.style.height = "19px";
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
                  }
                });
      </script>



