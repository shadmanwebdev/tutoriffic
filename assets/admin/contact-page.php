<?php
    include './includes/header.php';
?>


<style>
    .message {
        position: relative;
        display: block;
        height: 50px;
        line-height: 50px;
        cursor: default;
        transition-duration: 0.3s;
    }
    a {
        text-decoration: none;
        transition: all 0.4s ease-in-out;
        color: #76838f;
    }
    a:hover {   
        color: #7571f9;
        text-decoration: none;
    }
    .message .col-mail {
        display: flex;
        flex-flow: row nowrap;
    }
    .message .col-mail-2 .subject {
        overflow: hidden;
        white-space: nowrap;
    }
    .message .col-mail-2 .date {
        width: 170px;
        /* padding-left: 80px; */
    }
    a.del-link {
        text-decoration: none;
        transition: all 0.4s ease-in-out;
        color: #d80000;
    }
</style>


<main class='main'>

    <?php
        include './includes/sidebar.php';
    ?>

    <div class="container-fluid">

    <div class='py-4 px-3 px-md-4'>
        <?php
            $message = new Message();
            echo $message->updateContactPageForm();
        ?>
    </div>





                    
    </div>

</main>


<script>
    function fireButton(event) {
         ;
        document.getElementById('image').click();
    }
    $("#image").change(function() {
        var imageSrc = document.getElementById('image').value;
        var imageSrcArr = imageSrc.split('\\');
        var imgName = imageSrcArr.at(-1);
        var imgNameArr = imgName.split('.');
        var imgType = imgName.at(-1);
        document.getElementById('image-name-1').style.display = 'block';
        document.getElementById('image-name-1').textContent = imgName;
    });
</script>

<?php
    include './includes/footer.php';
?>