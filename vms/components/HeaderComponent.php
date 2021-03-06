<?php

namespace vms\components;

use api\v1\CartAPI;
use api\v1\AccountAPI;

class HeaderComponent
{
    private $statusLogout;
    private $account;
    private $cart;
    private $total = 0;
    private $count = 0;
    public function __construct($params = null)
    {
        // Get logged account
        $res = AccountAPI::checkAuthRequest();
        $this->statusLogout = $res->status;
        if ($res->status) {
            $this->account = $res->message;
            $res = CartAPI::read($this->account["id"]);
            if ($res->status) {
                $this->cart = $res->message[0];
                foreach ($this->cart["cart_items"] as $item) {
                    $this->total += (int)$item["quantity"] * (int)$item["price"];
                    $this->count += (int)$item["quantity"];
                }
            }
        }
    }

    public function render()
    {
?>

        <!-- A grey horizontal navbar that becomes vertical on small screens -->
        <nav class="navbar navbar-expand-lg text-white header">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-list text-white"></i>
            </button>
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link"><i class="fas fa-phone-alt"></i> Hotline:0908 77 00
                                95</a></li>
                        <?php if ($this->statusLogout) : ?>
                            <!-- <li class="nav-item"><a href="/check-order" class="nav-link"><i class="far fa-edit"></i> Kiểm tra
                                đơn hàng</a></li> -->
                            <li class="nav-item"><a href="/account" class="nav-link"><i class="far fa-edit"></i>Tài Khoản</a></li>
                            <?php if($this->account["admin"]) { ?>
                                <li class="nav-item"><a href="/admin" class="nav-link"><i class="far fa-edit"></i>Khu vực admin</a></li>
                            <?php } ?>
                            <li class="nav-item"><a href="/logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
                        <?php else : ?>
                            <li class="nav-item"><a href="/login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                            <li class="nav-item"><a href="/register" class="nav-link"><i class="fas fa-key"></i> Đăng ký</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4 mb-4 logo">
            <a href="/">
                <h1 style="font-family: 'Exo 2', sans-serif; color: gray">UNISEX 
                <span style="color: #f46164">STORE</span></h1>
            </a>
            <form method="post" action="/product" class="form-search">
                <div class="form-group d-flex">
                    <input type="text" placeholder="Tìm kiếm..." class="search-text-box" name="key" />
                    <button type="submit" class="button-search"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="cart">
                <?php if ($this->statusLogout) { ?>
                <a href="/cart" class="text-dark cart-child">
                    <img src="/assets/img/cart/cart.png" alt="cart" />
                    <span id="cart-total" class="cart-total ml-2 mr-2 mt-2"><?= $this->count ?> sp - <?= number_format($this->total) ?>đ</span>
                    <i class="fa fa-arrow-right mt-2"></i>
                </a>
                <?php } ?>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg text-white bg-dark options">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#product">
                <i class="fas fa-list text-white"></i>
            </button>
            <div class="container">
                <div class="collapse navbar-collapse" id="product">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="/" class="nav-link">TRANG CHỦ</a></li>
                        <li class="nav-item"><a href="/introduce" class="nav-link">GIỚI THIỆU</a></li>
                        <li class="nav-item"><a href="/product" class="nav-link">SẢN PHẨM</a></li>
                        <li class="nav-item"><a href="/news" class="nav-link">TIN TỨC</a></li>
                        <li class="nav-item"><a href="/contact" class="nav-link">LIÊN HỆ</a></li>
                    </ul>
                </div>
            </div>
        </nav>

<?php }
}
