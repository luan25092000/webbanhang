<?php
namespace vms\components\admin;

class NavBarComponent {
    public function __construct($params = null) {}

    public function render() {
?>
<nav class="navbar navbar-dark fixed-top bg-pink flex-md-nowrap p-0 shadow">
    <div class="col-md-12 mt-2 bg-pink">
        <a href="/">
            <h1 style="font-family: 'Exo 2', sans-serif; color: gray; font-size: 2rem">UNISEX 
            <span style="color: #f46164">STORE</span></h1>
        </a>
    </div>
</nav>

<?php }}