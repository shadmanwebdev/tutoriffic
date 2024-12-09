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




<div class="col-12 col-lg-8 col-xxl-9 d-flex">
    <div class="card flex-fill">
        <div class="card-header">
             <h5 class="card-title mb-0">Latest Projects</h5>
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="d-none d-xl-table-cell">Start Date</th>
                    <th class="d-none d-xl-table-cell">End Date</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Assignee</th>
                </tr>
            </thead>
            <tbody>
                <tr class="clickable-row" data-href="./project-edit?id=7" style="cursor:pointer;">
                    <td>Project Nitro</td>
                    <td class="d-none d-xl-table-cell">01/01/2020</td>
                    <td class="d-none d-xl-table-cell">31/06/2020</td>
                    <td><span class="badge bg-warning">In progress</span></td>
                    <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                </tr>
                <tr class="clickable-row" data-href="./project-edit?id=6" style="cursor:pointer;">
                    <td>Project Wombat</td>
                    <td class="d-none d-xl-table-cell">01/01/2020</td>
                    <td class="d-none d-xl-table-cell">31/06/2020</td>
                    <td><span class="badge bg-success">Done</span></td>
                    <td class="d-none d-md-table-cell">William Harris</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


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

<?php
$posts_array = $this->get_posts();
$str = "";
if(count($posts_array)) {
    foreach($posts_array as $post_array):
    
        $str .= "<tr class='clickable-row' data-href='./post-edit?id={$post_array['post_id']}' style='cursor:pointer;'>
                    <td>
                        <div class='td-thumb'>
                            <img src='../assets/280390361_345900077532956_6109531186004670207_n.jpg' alt=''>
                        </div>
                    </td>
                    <td class='d-none d-xl-table-cell'>1</td>
                    <td class='d-none d-xl-table-cell'>2</td>
                    <td><span class='badge bg-warning'>Published</span></td>
                    <td class='d-none d-md-table-cell'>Free</td>
                    <td class='d-none d-md-table-cell'>April 5, 2023</td>
                    <td class='table-action'>
                        <a href='./post-edit?id={$post_array['post_id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                        <a onclick='return pop(this)' href='../controllers/post-handler?delpost=1'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                    </td>
                </tr>";
    endforeach;
}
echo $str;
?>
<div class="col-12 col-lg-8 col-xxl-9 d-flex">
    <div class="card flex-fill">
        <div class="card-header">
            <h5 class="card-title mb-0">Latest Posts</h5>
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th class="d-none d-xl-table-cell">Images</th>
                    <th class="d-none d-xl-table-cell">Videos</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Tier</th>
                    <th class="d-none d-md-table-cell">Date</th>
                    <th class="d-none d-md-table-cell"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="clickable-row" data-href="./post-edit?id={$post_array['post_id']}" style="cursor:pointer;">
                    <td>
                        <div class='td-thumb'>
                            <img src="../assets/280390361_345900077532956_6109531186004670207_n.jpg" alt="">
                        </div>
                    </td>
                    <td class='d-none d-xl-table-cell'>1</td>
                    <td class='d-none d-xl-table-cell'>2</td>
                    <td><span class='badge bg-warning'>Published</span></td>
                    <td class='d-none d-md-table-cell'>Free</td>
                    <td class='d-none d-md-table-cell'>April 5, 2023</td>
                    <td class='table-action'>
                        <a href='./post-edit?id={$post_array['post_id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                        <a onclick='return pop(this)' href='../controllers/post-handler?delpost=1'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>