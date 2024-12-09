<?php
    include './header.php';
    // require 'vendor/autoload.php';
?>

<style>
    .card {
        max-width: 900px;
    }
    @media screen and (max-width: 576px) {
        .card {
            max-width: 90%;
        }
        .d-none {
            display: none;
        }
    }
</style>

<style>
    .td-thumb {
        width: 80px;
        height: 100px;
        overflow: hidden;
    }
    .td-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .table-action a {
        color: #6c757d;
    }
    .table-action .feather {
        width: 18px;
        height: 18px;
    }
    .table-action a:hover {
        color: #212529;
    }
</style>



<div class='wrapper'>

    <?php
        include './sidebar.php';
    ?>

    <div class='main'>
        <?php
            include './topbar.php';
        ?>
        <div class='admin-form-outer'>
            <div class='admin-form-wrapper'>


            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">FAQs</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Question</th>
                                <th class="d-none d-xl-table-cell">Answer</th>
                                <th class="d-none d-md-table-cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $faq = new Faq;
                                $faq->faqs_admin();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>



            </div>
        </div>
    </div>



</div>

