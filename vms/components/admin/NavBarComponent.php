<?php
namespace vms\components\admin;

class NavBarComponent {
    public function __construct($params = null) {}

    public function render() {
?>
<nav class="navbar navbar-dark fixed-top bg-pink flex-md-nowrap p-0 shadow">
    <div class="col-md-2"><img class="img-logo" src="/assets/img/logo/logo.png" alt="logo" /></div>
</nav>

<?php }}