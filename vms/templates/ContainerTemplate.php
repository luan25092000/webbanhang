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
    <title><?php print $this->child->title; ?> - Unisex Store</title>
    <!-- Title -->
    <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- jQuery library -->
    <!-- Css -->
    <link rel="stylesheet" href="/assets/css/style.css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Owl carousel -->
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/filter.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php (new HeaderComponent())->render(); ?>
        <div class="container">
            <?php $this->child->__render(); ?>
            <?php (new FooterComponent())->render(); ?>
        </div>

        <!-- Message modal -->
        <div class="modal" id="messageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="messageModal-alert" class="alert" role="alert">
                    <h5 class="modal-title" id="messageModal-message">Modal title</h5>
                </div>
            </div>
        </div>

        <!-- <script src="/assets/js/script.js"></script> -->
    </div>
</body>

</html>

<?php }}