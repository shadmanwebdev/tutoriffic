<?php
    include './partials/header.php';
?>

<?php include './partials/nav-2.php'; ?>


<?php
    include './template-parts/account-navigation.php';
?>

<?php
    include './template-parts/sub-bar-requests.php';
?>

<style>
    body {
        background-color: #f7f7f7;
    }
    .card {
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
    }
    .card:hover {
        -webkit-box-shadow: 0 20px 50px 0 rgba(0,0,0,.1);
        box-shadow: 0 20px 50px 0 rgba(0,0,0,.1);
    }
    .card-body {
        padding: 2.5rem 2rem;
    }
</style>



    <style>
        .card {
            min-width: 360px;
            /* padding: 40px 66px 24px; */
            -webkit-box-shadow: 0px 4px 16px rgba(96,97,112,0.08);
            box-shadow: 0px 4px 16px rgba(96,97,112,0.08);
            -webkit-border-radius: 20px;
            border-radius: 20px;
            margin-bottom: 16px;
        }
        .header-demands {
            padding: 30px 40px;
        }
        .img-wrapper {
            margin: 0 auto 16px;
            width: 140px;
            height: 140px;
            overflow: hidden;
            border-radius: 32px;
        }
        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center;
        }
        .profile-infos {
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            position: relative;
            padding: 50px 40px 40px 40px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .profile-infos .name {
            margin: 20px 0 0 0;
            font-size: 26px;
            font-weight: 700;
            color: #393939;
            line-height: normal;
            letter-spacing: normal;
            text-align: center;
        }
        .profile-infos .adress {
            margin: 10px 0 0 0;
            font-size: 18px;
            font-weight: 600;
            color: #b1b1b1;
            line-height: 1.4;
            letter-spacing: normal;
            text-align: center;
        }
        ul.messages {
            margin: 0;
        }
    </style>

    <style>
        .user-no-picture {
            width: 100%;
            height: 100%;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: rgb(255,145,77);
        }
    </style>

    <div class='container dashboard-container'>
        <div class='row'>

            <!-- Column 1 -->
            <div class='col-md-4'>
                <?php
                    $user = new User;
                    $user->dashboard_profile();
                ?>
            </div>


            <style>
                .header-demands h1 {
                    font-size: 20px;
                    font-weight: 700;
                    color: #222;
                    margin: 0;
                }
                .one-demand:last-child {
                    border-bottom: 2px solid #f7f7f7;
                }
                .one-demand {
                    -webkit-transition: all .3s ease;
                    transition: all .3s ease;
                    padding: 30px;
                    position: relative;
                    border-top: 2px solid #f7f7f7;
                    font-size: 13px;
                    font-weight: 400;
                    color: #999;
                    line-height: 1.54;
                    white-space: nowrap;
                    cursor: pointer;
                }
                .one-demand-inner {
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                }
                .one-demand .infos-container {
                    height: 100%;
                    width: calc(100% - 100px);
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    vertical-align: middle;
                    position: relative;

                }
                .avatar {
                    display: inline-block;
                    width: 50px;
                    height: 50px;
                    background-color: #d7d7d7;
                    border-radius: 100%;
                    overflow: hidden;
                }
                .avatar img {
                    width: 100%;
                    height: 100%;
                }
                .one-demand .infos-container>* {
                    vertical-align: middle;
                    margin: 0 10px;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                }
                .one-demand .firstname {
                    font-weight: 700;
                    color: #222;
                    margin: 0;
                    line-height: 1.5;
                }
                .one-demand p {
                    margin: 0;
                    font-size: 14px;
                    line-height: 1.5;
                }
            </style>

            <!-- Column 2 -->
            <div class='col-md-8'>
                <div class='card mb-4'>
                    <div class="header-demands">
                        <h1><span data-label="Mes messages">My Lessons</span></h1>
                    </div>
                    <?php

                        $user_account_type_id = user_account_type_id();
  
                        // Student
                        if($user_account_type_id == 2) {
                            $request = new Request;
                            $request->my_requests('student', 'free');
                        }

                        // Tutor
                        if($user_account_type_id == 3) {
                            $request = new Request;
                            $request->my_requests('tutor', 'free');     
                        }
                    ?>
                </div>
                <!-- <div class='card mb-4'>
                    <div class="header-demands">
                        <h1><span data-label="Mes messages">My Ads</span></h1>
                    </div>
                    
                </div> -->
            </div>
        </div>
    </div>



</body>
</html>