<?php require 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="./css/pc.css" media="all" />
    <link rel="stylesheet" href="./css/tablet.css" media="all and (max-width:1024px) and (min-width:768px)" />
    <link rel="stylesheet" href="./css/mobile.css" media="all and (max-width:767px)" />
    <!-- Title -->
    <link rel="shortcut icon" type="image/png" href="./img/favicon.ico" />
    <!-- Owl carousel -->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.css">
</head>

<body>
    <div class="wrapper">
        <?php 
            include 'header.php';
            include 'body.php';
            include 'footer.php';
            require_once("connect.php");
        ?>
    </div>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Owl carousel -->
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>