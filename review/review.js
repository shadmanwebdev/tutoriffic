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