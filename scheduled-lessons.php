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


    <div class='container dashboard-container'>
        <div class='row'>

            <!-- Column 1 -->
            <div class='col-md-4'>
                <?php
                    $user = new User;
                    $user->dashboard_profile();
                ?>
            </div>




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
                            $request->my_requests('student', 'all');
                        }

                        // Tutor
                        if($user_account_type_id == 3) {
                            $request = new Request;
                            $request->my_requests('tutor', 'all');     
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