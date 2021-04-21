<div class=" row justify-content-center align-items-center">
    <div class="col-lg-10 col-md-10 text-center">
        <?php
        if (isset($_SESSION['logged'])) {
            session_destroy();
        ?>

            <p class="fs-1 fw-bolder"> SEE YOU LATER!</p>
            <img src="resourses/bye.svg" alt="bye!">


        <?php
        } else {
        ?>
            <p class="fs-1 fw-bolder text-info"> YOU DO NOT HAVE A SESSION STARTED!</p>
        <?php
        }

        ?>
    </div>
</div>
