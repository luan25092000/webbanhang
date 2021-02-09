<?php
namespace vms;
use api\v1\ProductAPI;
use vms\components\HeaderComponent;
use vms\components\FooterComponent;

class Home {
    private $female_products;
    private $male_products;

    public function __construct() {
        $this->female_products = ProductAPI::getBySex('Nữ');
        $this->male_products = ProductAPI::getBySex('Nam');
        $this->render();
    }

    public function render() {
?>

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
        <?php new HeaderComponent(); ?>
        <div class="container">
            <div class="row banner-container">
                <div class="col-lg-9">
                    <div id="banner" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#banner" data-slide-to="0" class="active"></li>
                            <li data-target="#banner" data-slide-to="1"></li>
                            <li data-target="#banner" data-slide-to="2"></li>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./img/slides/1.jpg" alt="1">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/slides/2.jpg" alt="2">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/slides/3.jpg" alt="3">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#banner" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#banner" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box-banner">
                        <div class="banners">
                            <a href="#">
                                <img src="./img/banner/1.png" class="img-responsive" />
                            </a>
                            <a href="#">
                                <img src="./img/banner/2.png" class="img-responsive mt-2" />
                            </a>
                            <a href="#">
                                <img src="./img/banner/3.png" class="img-responsive mt-2" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-lg-4">
                    <a href="">
                        <img src="./img/banner/4.png" />
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="">
                        <img src="./img/banner/5.png" />
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="">
                        <img src="./img/banner/6.png" />
                    </a>
                </div>
            </div>
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active female-product" data-toggle="tab" href="#">THỜI TRANG NỮ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link female-product" data-toggle="tab" href="#">Áo Thun Nữ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link female-product" data-toggle="tab" href="#">Áo Sơ Mi Nữ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link female-product" data-toggle="tab" href="#">Váy Nữ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link female-product" data-toggle="tab" href="#">Quần Nữ</a>
                </li>
            </ul>
            <div class="row">
                <?php var_dump($this->female_products->message); ?>
                <?php foreach($this->female_products->message as $row): ?>
                <div class="col-lg-3">
                    <form action="" method="post">
                        <div class="product-item-box">
                            <div class="product-item">
                                <div class="image">
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>">
                                        <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>" width="100%" height="100%" name="product-image"
                                            class="product-image" />
                                    </a>
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i> XEM THÊM</a>
                                </div>
                                <a href="./product-detail.php?id=<?= $row['id'] ?>" class="product-name mt-4" name="product-name"><?= $row['title'] ?></a>
                                <div class="price-new" name="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫ <span class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span></div>
                            </div>
                        </div>
                        <input type="hidden" name="price" value="<?= $row['price'] ?>" />
                        <input type="hidden" name="title" value="<?= $row['title'] ?>" />
                        <input type="hidden" name="quantity" value="<?= $row['quantity'] ?>" />
                        <div class="col text-center">
                            <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i> Mua</button>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
                <ul class="nav nav-tabs mb-4 mt-4">
                    <li class="nav-item">
                        <a class="nav-link active female-product" data-toggle="tab" href="#">THỜI TRANG NAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link female-product" data-toggle="tab" href="#">Áo Thun Nam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link female-product" data-toggle="tab" href="#">Áo Sơ Mi Nam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link female-product" data-toggle="tab" href="#">Quần Nam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link female-product" data-toggle="tab" href="#">Áo Khoác Nam</a>
                    </li>
                </ul>
                <div class="row mb-4">
                    <?php foreach($this->male_products->message as $row): ?>
                    <div class="col-lg-3">
                        <form action="" method="post">
                            <div class="product-item-box">
                                <div class="product-item">
                                    <div class="image">
                                        <a href="./product-detail.php?id=<?= $row['id'] ?>">
                                            <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>" width="100%" height="100%"
                                                name="product-image" class="product-image" />
                                        </a>
                                        <a href="./product-detail.php?id=<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i> XEM THÊM</a>
                                    </div>
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>" class="product-name mt-4"><?= $row['title'] ?></a>
                                    <div class="price-new" name="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫ <span class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="price" value="<?= $row['price'] ?>" />
                            <input type="hidden" name="title" value="<?= $row['title'] ?>" />
                            <input type="hidden" name="quantity" value="<?= $row['quantity'] ?>" />
                            <div class="col text-center">
                                <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i> Mua</button>
                            </div>
                        </form>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-lg-3">
                        <div class="sale-policy-block">
                            <i class="fas fa-sync-alt"></i> HOÀN TRẢ TRONG VÒNG 30 NGÀY
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sale-policy-block">
                            <i class="fas fa-truck"></i> GIAO HÀNG MIỄN PHÍ
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sale-policy-block">
                            <i class="fas fa-shopping-basket"></i> THANH TOÁN LINH HOẠT
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sale-policy-block">
                            <i class="fas fa-users"></i> HỖ TRỢ KHÁCH HÀNG
                        </div>
                    </div>
                </div>
            </div>
            <?php new FooterComponent(); ?>
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

<?php }} ?>