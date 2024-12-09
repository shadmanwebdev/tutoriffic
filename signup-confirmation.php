<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<?php include './partials/nav-2.php'; ?>



    <?php
        if(isset($_GET['status'])) {
            if(isset($_GET['code'])) {
                if( $_GET['code'] == 1 | $_GET['code'] == 2 ) {
                    if ($_GET['code'] == 1) {
                        $status_text = "Success!";
                        $status_msg = "Please check your email for verification";
                        $icon = "<div class='icon check'>
                            <i class='fa fa-check'></i>
                        </div>";

                        $firstname = get_firstname();
                        $lastname = get_lastname();
                        $user_email = get_user_email();
                    } else {
                        $status_text = "Error!";
                        $icon = "<div class='icon cross'>
                            <i class='ion-android-close'></i>
                        </div>";
                        $status_msg = "The sign up attempt failed";
                    }
                } else {
                    $status_text = "Error!";
                    $icon = "<div class='icon cross'>
                        <i class='ion-android-close'></i>
                    </div>";
                    $status_msg = "The sign up attempt failed";
                }
            } else {
                $status_text = "Error!";
                $icon = "<div class='icon cross'>
                    <i class='ion-android-close'></i>
                </div>";
                $status_msg = "The sign up attempt failed";
            }
        } else {
            $status_text = "Error!";
            $icon = "<div class='icon cross'>
                <i class='ion-android-close'></i>
            </div>";
            $status_msg = "The sign up attempt failed";
        }
    ?>






<style>
    .confirmation-container h4 {
        max-width: 400px;
        margin: 0;
        text-align: center;
        font-size: 30px;
        font-weight: 800;
    }
    .confirmation-container {
        margin: 150px auto;
        overflow: scroll;
        max-width: 800px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        max-height: 100%;
    }
    .confirmation-container .card-infos-container[data-v-22de3638] {
        position: relative;
        width: 550px;
    }
    .confirmation-container .card-infos-container svg[data-v-22de3638]:first-child {
        top: 15px;
        left: -50px;
    }
    .confirmation-container .card-infos-container svg[data-v-22de3638] {
        z-index: 9;
        position: absolute;
    }
    .confirmation-container .card[data-v-22de3638] {
        position: relative;
        z-index: 10;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        flex-flow: row nowrap;
        -ms-flex-pack: distribute;
        justify-content: space-around;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 550px;
        margin: 40px auto;
        padding: 24px 40px;
        background: #fff;
        border-radius: 16px;
        -webkit-box-shadow: 0 10px 12px -12px #d9d9d9;
        box-shadow: 0 10px 12px -12px #d9d9d9;
    }


    .confirmation-container .card .avatar[data-v-22de3638] {
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50%;
        height: 80px;
        width: 80px;
    }

    .confirmation-container .card .infos[data-v-22de3638] {
        margin-right: auto;
        max-width: 75%;
    }
    .confirmation-container .card h5[data-v-22de3638], .confirmation-container .card p[data-v-22de3638] {
        margin: 8px;
        margin-left: 16px;
    }

    .confirmation-container h5[data-v-22de3638] {
        font-size: 24px;
        font-weight: 800;
    }

    .confirmation-container .card .chip.check[data-v-22de3638] {
        background-color: #5bca8d;
    }

    .confirmation-container .card .chip .icon.check[data-v-22de3638] {
        margin-top: 2px;
        width: 26px;
        height: auto;
    }
    .confirmation-container .card .chip[data-v-22de3638] {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 40px;
        width: 40px;
        border-radius: 100%;
    }
    .confirmation-container .card .chip .icon[data-v-22de3638] {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: 16px;
        width: 16px;
        color: #fff;
    }
    .confirmation-container .card .chip .icon.check[data-v-22de3638] {
        margin-top: 2px;
        width: 26px;
        height: auto;
    }



    /* Text */
    .confirmation-container .text[data-v-22de3638] {
        width: 70%;
        line-height: 24px;
        text-align: center;
        font-weight: normal;
    }
    .confirmation-container p[data-v-22de3638] {
        margin: 0;
        font-size: 16px;
    }

</style>


<div class='container confirmation-container'>

    <h4>Your account has been created!</h4>
    <div data-v-22de3638="" class="card-infos-container">
        <svg data-v-22de3638="" width="162" height="174" viewBox="0 0 162 174" fill="none" xmlns="http://www.w3.org/2000/svg"><path data-v-22de3638="" d="M93.8128 2.81309C83.3128 -2.68691 69.3128 1.31309 60.3128 2.81309C13.313 16.8131 3.31278 83.8131 0.312776 106.813C-2.68722 129.813 16.3128 149.813 39.3128 165.813C62.3128 181.813 108.313 172.313 144.813 154.813C181.313 137.313 145.813 68.8131 144.813 53.3131C143.813 37.8131 104.313 8.31309 93.8128 2.81309Z" fill="rgb(255,145,77)"></path></svg>
        <div data-v-22de3638="" class="card">
            <!-- <span data-v-22de3638="" class="avatar" style="background-image: url(&quot;https://c.superprof.com/i/a/28470192/12712177/140/20231105213657/sadasd-sada-ssad-sadasd-sada-ssadsadasd-sada-ssadsadasd-sada-ssadsadasd-sada-ssadsadasd-sada-ssadsadasd-sada-ssadsadasd-sada.jpg&quot;);"></span> -->
            <div data-v-22de3638="" class="infos">
                <h5 data-v-22de3638=""><?= $firstname; ?> <?= $lastname; ?></h5>
                <p data-v-22de3638=""><?= $user_email; ?></p>
            </div>
                
            <span data-v-22de3638="" class="chip check">
                <i data-v-07452373="" data-v-22de3638="" data-name="check" data-tags="" data-type="check" class="icon check feather feather--check">
                <svg data-v-07452373="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check feather__content">
                    <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </i>
            </span>
        </div>
    </div>
    <p data-v-22de3638="" class="text" data-label="ad_c_step_10_demand_reco">
        <b>Congratulations!</b> You've completed <b>1 of 3 steps</b> in creating your tutor profile</b> Click the button below to go to the next step.
    </p>
    <a href="./my-listing-2" style='margin-top: 50px;' class='form-btn btn btn-validate'>Next Step</a>
</div>




</body>
</html>

