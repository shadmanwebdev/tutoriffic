
<!-- Calendar CSS -->
<link rel="stylesheet" href="css/custom-calendar.css?v=12">


<!-- Times Pop Up -->
<div id='times-popup-wrapper'></div>


<!-- Calendar -->
<style>
    #month-outer-wrapper {
        display: flex;
        flex-flow: column;
        align-items: center;
        margin: 50px 0 20px 0;
    }
    #month-wrapper {
        max-width: 400px;
        margin: 0px 0 20px 0;
    }
    .container, .col-sm-12 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .time-slot {
        display: flex;
        margin-bottom: 10px;
    }
</style>


                

<div id='month-outer-wrapper'>
    <div class='input-label' style='margin-bottom: .8rem;'>Select Availability</div>
    <div class='container' id='month-wrapper'>
            
        <?php
            include './calendar-functions.php';

            // Set the timezone
            $timezone = new DateTimeZone('Europe/London');
            // Create a new DateTime object with the specified timezone
            $date = new DateTime('now', $timezone);
            $currentDayOfWeek = $date->format("D");
            // Sat or Sun
            if($currentDayOfWeek == 'Sat') {
                $date->modify('+2 days');
            } else if($currentDayOfWeek == 'Sun') {
                $date->modify('+1 day');
            }

            // Get current date in numerical format (day)
            $currentDay = $date->format('d');
            // Get current month in numerical format
            $currentMonth = $date->format('n');
            // Get current year
            $currentYear = $date->format('Y');
            // Get current day of week
            
            if(isset($_SESSION['datetimes'])) {
                unset($_SESSION['datetimes']);
            }

            $month = show_month($currentMonth, $currentYear);
            echo $month;
        ?>
    </div>  
    <div class='error' id='datetime-error'></div>

    
    <div class='stripe-checkout-form' style='display: flex; justify-content: center; margin: 0px auto 50px auto; padding-left: 15px; padding-right: 15px;'>
        <span style='min-width: 180px;' onclick="switchTab2('el-group', 'tab-4', 'active-tab')" class='btn select'>Next</span>
    </div>
</div>



<script defer>

    function create_gig() {


        // Build the URL with query parameters
        var url1 = `controllers/booking-handler.php?check_availability_session=true`;
        var dates_json = '';

        fetch(url1)
            .then(response1 => response1.text())
            .then(response1 => {
                console.log(response1);
                if (response1 != '0') {
                    dates_json = response1;
                    var dates_array = JSON.parse(response1);
                    console.log(dates_array);
                    // Check if array has items
                    if (dates_array.length > 0) {
                        var valid_dates_array = hasDatesInNextThreeMonths(dates_array);
                        if (valid_dates_array) {
                            console.log('avcvfsdsdfsd');
                            $('#datetime-error').html('');
                            // Move the code here that depends on valid_dates_array
                            // Start the gig creation process here
                            createGigWithValidDates(valid_dates_array);
                        } else {
                            console.log('aasdasd');
                            $('#datetime-error').html('<div>Select availability dates for at least next 3 months</div>');
                        }
                    } else {
                        var valid_dates_array = false;
                        $('#datetime-error').html('<div>Select dates to continue</div>');
                    }
                } else {

                    var valid_dates_array = false;
                    $('#datetime-error').html('<div>Select dates to continue</div>');
                }
            })
            .catch(err => console.log(err));


        
        // Define a function to create gig with valid dates
        function createGigWithValidDates(valid_dates_array) {
            
            console.log(valid_dates_array);

            if (valid_dates_array) {
                const formData = new FormData();

                // Datetimes
                formData.append('datetimes', dates_json);

                fetch('./controllers/gig-handler', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        return response.text()
                    })
                    .then(response => {
                        setTimeout(function() {
                            load_end();

                            window.location.href = './my-gigs';

                            // console.log(response);
                            // if($.trim(response) == '1') {
                            //     $('#message-response').html("<div class='success'>Profile information updated!</div></div>");
                            // } else {
                            //     $('#message-response').html("<div class='error'>There was an error</div>");
                            // }
                        }, 500);
                    })
                    .catch(err => console.log(err));
                       
            } else {
                console.log('Invalid dates');
            }
        }
    }

</script>


<!-- Calendar JS -->
<script src="js/custom-calendar.js?v=12" defer></script>



