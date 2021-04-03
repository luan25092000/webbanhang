<?php

namespace vms;

use api\v1\ProductAPI;
use vms\templates\ContainerTemplate;

class ProductPage
{
    public $title;
    private $rows;

    public function __construct($params = null)
    {
        // Set title
        $this->title  = "Sản phẩm";
        // Tất cả sản phẩm
        // $this->rows = null;
        if (isset($_POST["filter"])) {
            if (isset($_POST["key"])) {
                if ($_POST["filter"] != 0) {
                    $this->rows = ProductAPI::filter($_POST["filter"], $_POST["key"]);
                } else {
                    $this->rows = ProductAPI::getProductByKey($_POST["key"]);
                }
            } else {
                if ($_POST["filter"] != 0) {
                    $this->rows = ProductAPI::filter($_POST["filter"]);
                } else {
                    $this->rows = ProductAPI::gets();
                }
            }
        } else if (isset($_POST["key"])) {
            $this->rows = ProductAPI::getProductByKey($_POST["key"]);
            // echo ("<script>location.href = 'product#form-select-filter';</script>");
        } else {
            $this->rows = ProductAPI::gets();
        }
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render()
    {

        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render()
    {

?>
        <div class="container mt-4 mb-4">
            <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span class="introduce">Sản phẩm</span></small>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="menu-about">
                        <div class="heading-lg mb-3">
                            <h1>SẢN PHẨM <?php if(isset($_POST["key"])) { ?>
                                : TÌM KIẾM VỚI TỪ KHÓA "<?= strtoupper($_POST["key"]) ?>"
                                <input id="key" type="hidden" value="<?= strtoupper($_POST["key"]) ?>"/>
                            <?php } ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <!-- <span>Sản phẩm/trang </span><select class="form-select">
                        <option selected>12</option>
                        <option value="1">20</option>
                        <option value="2">50</option>
                        <option value="3">100</option>
                    </select> -->
                </div>
                <div class="col-md-6 text-right mb-3">
                    <span>Sắp xếp </span><select class="form-select" id="form-select-filter">
                        <option value="0" selected>Mặc định</option>
                        <option value="1">Giá giảm dần</option>
                        <option value="2">Giá tăng dần</option>
                        <option value="3">Tên sản phẩm A - Z</option>
                        <option value="4">Tên sản phẩm Z - A</option>
                    </select>
                </div>
            </div>
            <div class="row" id="body-product">
                <?php foreach ($this->rows->message as $row) : ?>
                    <div class="col-lg-3">
                        <div class="product-item-box">
                            <div class="product-item">
                                <div class="image">
                                    <a href="/product-detail/<?= $row['id'] ?>">
                                        <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>" width="100%" height="100%" name="product-image" class="product-image" />
                                    </a>
                                    <a href="/product-detail/<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i> XEM THÊM</a>
                                </div>
                                <a href="/product-detail/<?= $row['id'] ?>" class="product-name mt-4"><?= $row['title'] ?></a>
                                <div class="price-new" name="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫</div>
                            </div>
                        </div>
                        <form class="add-to-cart mb-5" action="" method="POST">
                            <div class="col text-center">
                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>" />
                                <input type="hidden" name="product_quantity" value="1" />
                                <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i> Mua</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php }
}
