<?php
    include './partials/header.php';
?>
<?php
    include './template-parts/login-popup.php';
    include './template-parts/join-popup.php';
?>

<?php include './partials/nav-2.php'; ?>

<link rel="stylesheet" href="css/tutor.css">

<style>
    .user-no-picture {
        width: 100%;
        height: 100%;
        font-size: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: rgb(255,145,77);
    }
</style>

<div class='page-wrapper main-content'>
    
    <style>
        .schedule {
            margin-right: 100px;
        }
        .scheduling-days {
            display: flex;
            flex-flow: row wrap;
            width: 100%;
        }
        .sch-dow {
            align-self: flex-start;
            flex: 1 0;
            padding: 0;
            text-align: center;
        }
        .sch-dow {
            border-top: 4px solid rgb(255, 145, 77);
        }
        .sch-dow-inner {
            align-items: center;
            color: #384047;
            display: flex;
            flex-direction: column;
            font-size: 16px;
            line-height: 1.5;
            padding: 16px 0;
        }
        .sch-dow + .sch-dow {
            margin-left: 4px;
        }
        .d {
            margin-bottom: 0;
        }
        .dow {
            margin-bottom: 0;
        }
        .times {
            margin-top: 20px;
        }
    </style>

    <?php
        $ad = new Ad();
        $user_id = $_GET['s'];
        $ad->student_profile($user_id)
    ?>








</div>





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



</body>
</html>