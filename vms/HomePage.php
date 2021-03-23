<?php
namespace vms;
use api\v1\ProductAPI;
use vms\templates\ContainerTemplate;

class HomePage {
    private $female_products;
    private $male_products;
    public $title;

    public function __construct($params = null) {
        $this->title  = "Trang chủ";
        $this->female_products = ProductAPI::getBySex('Nữ');
        $this->male_products = ProductAPI::getBySex('Nam');
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
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
                    <img src="/assets/img/slides/1.jpg" alt="1">
                </div>
                <div class="carousel-item">
                    <img src="/assets/img/slides/2.jpg" alt="2">
                </div>
                <div class="carousel-item">
                    <img src="/assets/img/slides/3.jpg" alt="3">
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
                    <img src="/assets/img/banner/1.png" class="img-responsive" />
                </a>
                <a href="#">
                    <img src="/assets/img/banner/2.png" class="img-responsive mt-2" />
                </a>
                <a href="#">
                    <img src="/assets/img/banner/3.png" class="img-responsive mt-2" />
                </a>
            </div>
        </div>
    </div>
</div>
<div class="banners-2 row mt-4 mb-4">
    <div class="col-lg-4">
        <a href="">
            <img src="/assets/img/banner/4.png" />
        </a>
    </div>
    <div class="col-lg-4">
        <a href="">
            <img src="/assets/img/banner/5.png" />
        </a>
    </div>
    <div class="col-lg-4">
        <a href="">
            <img src="/assets/img/banner/6.png" />
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
    <?php foreach($this->female_products->message as $row): ?>
    <div class="col-lg-3">
        <div class="product-item-box">
            <div class="product-item">
                <div class="image">
                    <a href="/product-detail/<?= $row['id'] ?>">
                        <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>" width="100%" height="100%" name="product-image"
                            class="product-image" />
                    </a>
                    <a href="/product-detail/<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i> XEM THÊM</a>
                </div>
                <a href="/product-detail/<?= $row['id'] ?>" class="product-name mt-4" name="product-name"><?= $row['title'] ?></a>
                <div class="price-new" name="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫ <span class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span></div>
            </div>
        </div>
        <form class="add-to-cart" action="" method="POST">
            <div class="col text-center">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>"/>
                <input type="hidden" name="product_quantity" value="1"/>
                <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i> Mua</button>
            </div>
        </form>
    </div>
    <?php endforeach; ?>
</div>
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
        <div class="product-item-box">
            <div class="product-item">
                <div class="image">
                    <a href="/product-detail/<?= $row['id'] ?>">
                        <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>" width="100%" height="100%"
                            name="product-image" class="product-image" />
                    </a>
                    <a href="/product-detail/<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i> XEM THÊM</a>
                </div>
                <a href="/product-detail/<?= $row['id'] ?>" class="product-name mt-4"><?= $row['title'] ?></a>
                <div class="price-new" name="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫ <span class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span></div>
            </div>
        </div>
        <form class="add-to-cart" action="" method="POST">
            <div class="col text-center">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>"/>
                <input type="hidden" name="product_quantity" value="1"/>
                <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i> Mua</button>
            </div>
        </form>
    </div>
    <?php endforeach; ?>
</div>
<div class="row mb-4">
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
<?php }}