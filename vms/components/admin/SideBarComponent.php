<?php
namespace vms\components\admin;

class SideBarComponent {
    public function __construct($params = null) {}

    public function render() {
?>

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

          <?php 


            $uri = $_SERVER['REQUEST_URI']; 
            $uriAr = explode("/", $uri);
            $page = end($uriAr);

          ?>


          <li class="nav-item">
            <a class="nav-link" href="/admin">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/orders">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/products">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/categories">
              <span data-feather="shopping-cart"></span>
              Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/promotions">
              <span data-feather="shopping-cart"></span>
              Promotions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/customers">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
        </ul>

       
      </div>
    </nav>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

<?php }}
