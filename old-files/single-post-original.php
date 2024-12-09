<?php
    include './partials/header.php';
?>review
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>


<style>
    .page-wrapper {
        /* max-width: 900px; infos */
        margin: 150px auto;
    }
    .subjects {
        
        margin-bottom: 8px;
    }
    span.subject {
        padding: 5px 12px;
        color: rgb(255,145,77);
        background-color: #FFEDE3;
        font-size: 14px;
        border-radius: 16px;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    span.subject:last-child {
        margin-right: 0px;
    }
    h1 {
        font-size: 40px;
        font-weight: 600;
        margin: 0 0 40px;
        overflow-wrap: break-word;
        max-width: 680px;
    }
    h2 {
        font-size: 24px;
        font-weight: 600;
        margin: 0 0 24px;
        line-height: 32px;
    }

    /* Location */
    ul.locations  {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-flow: wrap;
        flex-flow: wrap;
    }
    ul.locations li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;

        margin: 4px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        border: solid #d9d9d9 1px;
        -webkit-border-radius: 40px;
        border-radius: 40px;
    }

    /* Card */
    .card {
        min-width: 360px;
        padding: 40px 66px 24px;
        -webkit-box-shadow: 0px 4px 16px rgba(96,97,112,0.08);
        box-shadow: 0px 4px 16px rgba(96,97,112,0.08);
        -webkit-border-radius: 40px;
        border-radius: 40px;
        margin-bottom: 16px;
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
    .name {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        margin-bottom: 8px;
        font-size: 24px;
        font-weight: 800;
        text-align: center;
    }
</style>

<style>
    .review {
        font-size: 15px;
        text-align: center;
        margin-bottom: 0 auto 10px;
    }
    .icon-star2 {
        color: rgb(255, 181, 0);
    }
    ul.infos {
        margin-top: 32px;
    }
    .infos li {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .infos li .value {
        font-size: 20px;
        font-weight: 800;
    }
    .contact-btn {
        background: rgb(255, 145, 77);
        color: #fff;    
        border-radius: 30px;
        padding: 12px 60px; 
        min-width: 100%; 
        margin: 0 auto 20px auto;
    }
</style>


<!-- Review -->
<style>
    li.review-item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        border: solid #d9d9d9 1px;
        -webkit-border-radius: 32px;
        border-radius: 32px;
        padding: 24px;
        margin-bottom: 20px;
    }
    .user-infos {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    li .avatar {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    li .user-infos .avatar .picture {
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
        width: 32px;
        height: 32px;
        margin-right: 8px;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
    }
    li .avatar p {
        font-size: 16px;
        font-weight: bold;
        margin: 0;
    }
    
    .rating {
        font-size: 15px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 0 auto 10px;
    }
    .rating .icon-star2 {
        color: rgb(255, 181, 0);
    }
    .main-text {
        font-size: 16px;
        margin: 0;
        line-height: 30px;
    }
    .review-title-wrapper {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: space-between;
    }
    .review-title-wrapper h2 {
        font-size: 24px;
        font-weight: bold;
        margin: 0 0 24px;
        line-height: 32px;
    }
    
    .rating-wrapper {
        padding: 5px 10px;
        background-color: #fff6f0;
        border-radius: 16px;
    }
    .rating-wrapper .rating {
        font-size: 14px;
    }
</style>

<style>
    .img-wrapper .user-no-picture {
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
        margin-right: 8px;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
    }
</style>


<div class='container page-wrapper'>


        <div class='row'>
            <div class='col-md-8'>

                <div class='row no-gutters subjects'>
                    
                    <span class='subject' id='subj-id-1'>
                        Mathematics
                    </span>
                    <span class='subject' id='subj-id-2'>
                        English
                    </span>


                </div>

                <div class='ad'>
                    <h1>Far far away, behind the word mountains</h1>
                    <h2>Lesson location</h2>

                    <ul class='locations'>
                        <li>Online</li>
                    </ul>

                    <div class='about-main' style='margin: 40px 0;'>
                        <h2 data-role='title'>About Tutor</h2>
                        <p class='text announce-experience-text' data-role='content'>
                            Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.

                            A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                        </p>
                        
                    </div>
                    <div class='about-main' style='margin: 40px 0;'>
                        <h2 data-role='title'>About Lesson</h2>
                        <p class='text announce-experience-text' data-role='content'>
                            Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.

                            A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                        </p>
                    </div>

                </div>

            </div>
            <div class='col-md-4'>
                <div class='card'>
                    <div class='img-wrapper'>
                    <img style='width: 100%; height: 100%;' src='./assets/avatars/c1.jpg' />
                    </div>
                    <div class='name'>
                        Elizabeth
                    </div>



                    <div class='review'>
                        <span><i class='icon icon-star2'></i></span>
                        <span>5 (3 reviews)</span>
                    </div>

                    <ul class='infos'>
                        <li>
                            <span class='label'>Hourly rate</span>
                            <span class='value'>£30</span>
                        </li>
                        <li>
                            <span class='label'>Response Time</span>
                            <span class='value'>3h</span>
                        </li>
                        <li>
                            <span class='label'>Number of students</span>
                            <span class='value'>50+</span>
                        </li>
                    </ul>
                    <div class='btns-wrapper'>
                        <a class='btn contact-btn' href='./schedule?id=1'>Contact</a>
                    </div>
                </div>
            </div>
        </div>

    <?php
        // $ad = new Ad();
        // $ad_array = $ad->get_single_ad($_GET['id'])[$_GET['id']];
        // $ad->single_ad($_GET['id']);
    ?>


<style>
    #review-form {
        margin: 50px 0;
        padding: 0;
    }
    .textarea-container textarea {
        width: 100%;
        padding: 16px;
        /* background-color: #f7f7f7; */
        resize: none;
        border: solid #d9d9d9 2px;
        outline: none;
        font-size: 16px;
        font-weight: normal;
        border-radius: 16px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        background-clip: padding-box;
        -webkit-transition: all .15s;
        transition: all .15s;
    }
    .btns-wrapper {
        display: flex;
        flex-flow: row nowrap;
        justify-content: flex-end;
        margin-top: 10px;
    }
    /* .rt-label {
        margin-bottom: 13px;
    } */
    .rt-wrapper {
        display: flex;    
        align-items: flex-start;
        margin-bottom: 20px;
        line-height: 1;
    }
    .stars {
        display: flex;
        margin-left: 10px;
    }
    .stars {
        display: flex;
        margin-left: 10px;
        line-height: 1.5;
    }
    /* .stars i {
        margin-right: 2px;
    }
    .stars i:last-child {
        margin-right: 0px;
    } */
    .ion-android-star {
        color: #f5c136;
    }
    .icon-star2 {
        color: rgb(255, 181, 0);
    }
</style>

<?php
    if(isset($_SESSION['user'])) {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $user_account_type_id = $userdata['user_account_type_id'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $user_account_type_id = $userdata['user_account_type_id'];
        }

        // Check if user is student
        if($user_account_type_id == '2') {
            

            // Check if student has a request
            $requests = $ad->get_student_request($_GET['id']);

            if(count($requests) > 0) {

                $review = new Review;
                $reviews = $review->review_exists_for_student($student_id);
            

                // Check if there are no reviews
                if(count($reviews) == 0) {

?>

<!-- Review form -->
<div id='review-form' class='col-md-8'>
    <h2 style='margin-bottom: 12px;'>Write a review</h2>
    <div class='rt-wrapper'>
        <span class='rt-label'>Your rating</span>
        <span class='stars'>

            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>
            <i class="icon icon-star_border"></i>


        </span>
    </div>
    <input type="hidden" name='ad_id' id='ad_id' value='<?= $_GET['id']; ?>'>
    <input type="hidden" name='tutor_id' id='tutor_id' value='<?= $ad_array['tutor_uid']; ?>'>
    <div class='textarea-container'>
        <textarea id="review" name="review" placeholder="E.g. Thanks! John is an amazing tutor." style="height: 128px;"></textarea>
    </div>
    <div class="btns-wrapper">
        <span class="btn btn-validate" onclick="create_review()">Post</span>
    </div>
</div>

<?php
                }
            }
        }
    }
?>


<script defer>

    function create_review() {
        var rating = $('.stars .selected').length;
        var ad_id = $('#ad_id').val();
        var tutor_id = $('#tutor_id').val();
        var review = $('#review').val();

        if(rating && review && tutor_id && ad_id) {
            var formData = new FormData();
    
            formData.append('create_review', 'true');
            formData.append('ad_id', ad_id);
            formData.append('tutor_id', tutor_id);
            formData.append('review', review);
            formData.append('rating', rating);
    
            fetch('./controllers/review-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                // Select the last element with the 'comment' class
                var lastReview = $('.review-item:first');
                // New HTML content to be inserted after the last 'review' element
                var newReview = response;
                // Insert the new review after the last 'review' element
                lastReview.before(newReview);
                $('#review').val('');
            })
            .catch( err => console.log(err));
        }
    }
    $(document).ready(function () {
        // Click function
        $('.icon').click(function () {
            if (!$(this).hasClass('selected')) {
                $(this).addClass('selected').prevAll().addClass('selected');
                $(this).nextAll().removeClass('selected');

                // Remove star_border class and add icon-star2 class
                $(this).removeClass('icon-star_border').addClass('icon-star2').prevAll().removeClass('icon-star_border').addClass('icon-star2');
            } else {
                $(this).nextAll().removeClass('selected');
                $(this).nextAll().removeClass('icon-star2').addClass('icon-star_border');
            }
        });

        // Mouseover function
        $('.icon').mouseover(function () {
            if (!$(this).hasClass('selected')) {
                $(this).addClass('icon-star2').prevAll().addClass('icon-star2');
                $(this).removeClass('icon-star_border').prevAll().removeClass('icon-star_border');
            }
        });

        // Mouseout function
        $('.icon').mouseout(function () {
            if (!$(this).hasClass('selected')) {
                $(this).removeClass('icon-star2').addClass('icon-star_border');
                // Remove icon-star2 from elements without selected class
                $(this).siblings(':not(.selected)').removeClass('icon-star2');
                // Add icon-star_border to elements without selected class
                $(this).siblings(':not(.selected)').addClass('icon-star_border');
            }
        });

    });
</script>


    <?php
        $review = new Review();
        $review->reviews($_GET['id']);
    ?>


</div>









</body>
</html>