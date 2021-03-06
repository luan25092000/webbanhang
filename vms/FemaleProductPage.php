<?php
namespace vms;
use api\v1\ProductAPI;
use vms\templates\ContainerTemplate;

class FemaleProductPage {
    public $title;
    private $rows;
    
    public function __construct($params = null) {
        // Set title
        $this->title  = "Thời trang nữ";
        // Tất cả sản phẩm
        $this->rows = ProductAPI::getBySex("Nữ");
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="container mt-4 mb-4">
    <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span
            class="introduce">Thời trang nữ</span></small>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="menu-about">
                <h4>
                    <span>
                        THỜI TRANG NỮ
                    </span>
                </h4>
            </div>
        </div>
        <div class="col-md-6">
            <span>Sản phẩm/ trang </span><select class="form-select">
                <option selected>12</option>
                <option value="1">20</option>
                <option value="2">50</option>
                <option value="3">100</option>
            </select>
        </div>
        <div class="col-md-6 text-right">
            <span>Sắp xếp </span><select class="form-select">
                <option selected>Mặc định</option>
                <option value="1">Giá giảm dần</option>
                <option value="2">Giá tăng dần</option>
                <option value="3">Tên sản phẩm A - Z</option>
                <option value="4">Tên sản phẩm Z - A</option>
            </select>
        </div>
    </div>
    <div class="row">
        <?php foreach($this->rows->message as $row):?>
        <div class="col-lg-3 mt-3">
            <form action="" method="get">
                <div class="product-item-box">
                    <div class="product-item">
                        <div class="image">
                            <a href="./product-detail/<?= $row['id'] ?>">
                                <img src="<?= $row['imgPath'] ?>" alt="2" width="100%" height="100%"
                                    class="product-image product-image360" />
                            </a>
                            <a href="./product-detail/<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i>
                                XEM THÊM</a>
                            <div class="discount">-10%</div>
                        </div>
                        <a href="./product-detail/<?= $row['id'] ?>" class="product-name mt-4"
                            name="product-name"><?= $row['title'] ?></a>
                        <div class="price-new" name="price-new"><?= number_format($row['price'] * 0.9, 0, '', ',') ?>₫<span
                                class="price-old"><?= number_format($row['price'], 0, '', ',') ?>₫</span>
                        </div>
                    </div>
                </div>
                <div class="col text-center mt-3">
                    <button class="btn btn-buy-product" type="submit"><i
                            class="fas fa-shopping-cart mr-2"></i>Mua</button>
                </div>
            </form>

        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php }}