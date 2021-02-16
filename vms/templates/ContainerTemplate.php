<?php
namespace vms\templates;

use vms\components\HeaderComponent;
use vms\components\FooterComponent;

class ContainerTemplate {
    // Khai báo child và hàm render child view-model
    private $child;
    public function renderChild($child) {
        $this->child = $child;
        $this->render();
    }

    public function __construct($params = null) {}

    public function render() {
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php print $this->child->title; ?> - WOMEN STORE</title>
         <!-- Title -->
        <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Css -->
        <link rel="stylesheet" href="/assets/css/pc.css" media="all" />
        <link rel="stylesheet" href="/assets/css/tablet.css" media="all and (max-width:1024px) and (min-width:768px)" />
        <link rel="stylesheet" href="/assets/css/mobile.css" media="all and (max-width:767px)" />
        <!-- Owl carousel -->
        <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="/assets/css/owl.theme.default.css">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
        <div class="wrapper">
            <?php (new HeaderComponent())->render(); ?>
            <div class="container">
                <?php $this->child->__render(); ?>
                <?php (new FooterComponent())->render(); ?>
            </div>

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- Owl carousel -->
            <script src="/assets/js/owl.carousel.min.js"></script>
            <script src="/assets/js/script.js"></script>
        </div>
    </body>
</html>

<?php }}