<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC EXAMPLE</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>


    <!-- Logo Start -->
    <div class="container-fluid">
        <h3 class="text-center py-3 fw-bold">MVC EXAMPLE</h3>
    </div>
    <!-- Logo End -->

    <!-- Menu Start-->
    <div class="container-fluid bg-light">

        <ul class="nav nav-justified py-2 nav-pills">
            <?php if (isset($_GET['page'])) : ?>
                <?php if ($_GET['page'] == "signup") : ?>
                    <li class="nav-item"><a href="index.php?page=signup" class="nav-link active">Sign Up</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="index.php?page=signup" class="nav-link">Sign Up</a></li>
                <?php endif ?>

                <?php if ($_GET['page'] == "login") : ?>
                    <li class="nav-item"><a href="index.php?page=login" class="nav-link active">Log In</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="index.php?page=login" class="nav-link">Log In</a></li>
                <?php endif ?>

                <?php if ($_GET['page'] == "crud") : ?>
                    <li class="nav-item"><a href="index.php?page=crud" class="nav-link active">CRUD</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="index.php?page=crud" class="nav-link">CRUD</a></li>
                <?php endif ?>

                <?php if ($_GET['page'] == "exit") : ?>
                    <li class="nav-item"><a href="index.php?page=exit" class="nav-link active">Exit</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="index.php?page=exit" class="nav-link">Exit</a></li>
                <?php endif ?>
            <?php else : ?>

                <li class="nav-item"><a href="index.php?page=signup" class="nav-link">Sign Up</a></li>
                <li class="nav-item"><a href="index.php?page=login" class="nav-link">Log In</a></li>
                <li class="nav-item"><a href="index.php?page=crud" class="nav-link">CRUD</a></li>
                <li class="nav-item"><a href="index.php?page=exit" class="nav-link">Exit</a></li>

            <?php endif ?>
        </ul>
    </div>
    <!-- Menu End-->

    <!-- Content Start -->
    <div class="container-fluid py-5">

        <?php
        if (isset($_GET['page'])) {
            if (
                $_GET['page'] == "signup" ||
                $_GET['page'] == "login" ||
                $_GET['page'] == "crud" ||
                $_GET['page'] == "exit"
            ) {
                include "pages/" . $_GET['page'] . ".php";
            } else {
                include "pages/404.php";
            }
        } else {
            include "pages/login.php";
        }
        ?>
    </div>
    <!-- Content End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>

</html>
