<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-lg text-white header">
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-list text-white"></i>
	</button>
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="" class="nav-link"><i class="fas fa-phone-alt"></i> Hotline:0908 77 00 95</a></li>
                <li class="nav-item"><a href="./check-order.php" class="nav-link"><i class="far fa-edit"></i> Kiểm tra đơn hàng</a></li>
                <li class="nav-item"><a href="" class="nav-link"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a></li>
                <li class="nav-item"><a href="" class="nav-link"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                <li class="nav-item"><a href="" class="nav-link"><i class="fas fa-key"></i> Đăng ký</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4 mb-4 logo">
    <a href="index.php"><img src="./img/logo/logo.png" alt="logo" /></a>
    <form method="POST" action="" enctype="multipart/form-data" class="form-search">
        <div class="form-group d-flex">
            <input type="text" placeholder="Tìm kiếm..." class="search-text-box"/>
            <button type="submit" class="button-search"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <div class="cart">
        <a href="" class="text-dark cart-child">
            <img src="./img/cart/cart.png" alt="cart" />
            <span id="cart-total" class="cart-total ml-2 mr-2 mt-2">0 sp - 0đ</span>
            <i class="fa fa-arrow-right mt-2"></i>
        </a>
    </div>
</div>
<nav class="navbar navbar-expand-lg text-white bg-dark options">
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#product">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <div class="collapse navbar-collapse" id="product">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="./index.php" class="nav-link">TRANG CHỦ</a></li>
                <li class="nav-item"><a href="./introduce.php" class="nav-link">GIỚI THIỆU</a></li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="" class="nav-link dropdown-toggle text-white" data-toggle="dropdown">SẢN PHẨM</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">NAM</a>
                            <a class="dropdown-item" href="#">NỮ</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a href="./new.php" class="nav-link">TIN TỨC</a></li>
                <li class="nav-item"><a href="./contact.php" class="nav-link">LIÊN HỆ</a></li>
            </ul>
        </div>
    </div>
</nav>