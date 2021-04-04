<?php
namespace vms\templates;

use vms\components\admin\HeaderComponent;
use vms\components\admin\TopComponent;
use vms\components\admin\SideBarComponent;
use vms\components\admin\NavBarComponent;
use vms\components\admin\FooterComponent;

class ContainerAdminTemplate {
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
    <link rel="stylesheet" href="/assets/css/admin/dashboard.css">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">
</head>

<body>
    <?php (new TopComponent())->render(); ?>
    <?php (new NavBarComponent())->render(); ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <?php (new SideBarComponent())->render(); ?>
            <?php $this->child->__render(); ?>
            <?php (new FooterComponent())->render(); ?>
        </div>
    </div>
</body>

</html>

<?php }}