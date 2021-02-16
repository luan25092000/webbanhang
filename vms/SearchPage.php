<?php
namespace vms;
use api\v1\ProductAPI;
use vms\templates\ContainerTemplate;
use libs\Common;

class SearchPage {
    public $title;
    private $rows;

    public function __construct($params = null) {
        // Get query "q"
        $key = Common::get_query("key");
        // Set title
        $this->title  = "Tìm kiếm: ".$key;
        // Tìm kiếm
        $this->rows = ProductAPI::getProductByKey($key);
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="container mt-3 mb-3">
    <div class="row mb-4">
        <div class="col-lg-3 col-md-12">
            <div class="menu-news">
                <h5 class="new-title">SẢN PHẨM</h5>
                <ul>
                    <li><i class="fas fa-arrow-circle-right"></i> <a href="./female-product">THỜI TRANG
                            NỮ</a></li>
                    <hr />
                    <li><i class="fas fa-arrow-circle-right"></i> <a href="./male-product">THỜI TRANG
                            NAM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-12">
            <div class="row ml-4">
                <?php foreach($this->rows->message as $row): ?>
                <div class="col-md-3 mb-4">
                    <form action="" method="post">
                        <div class="product-item-box">
                            <div class="product-item">
                                <div class="image-search">
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>">
                                        <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>" width="100%"
                                            height="100%" name="product-image" class="product-image" />
                                    </a>
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>" class="more-info-search"><i
                                            class="fas fa-search"></i> XEM THÊM</a>
                                </div>
                                <a href="./product-detail.php?id=<?= $row['id'] ?>"
                                    class="product-name-search mt-4"><?= $row['title'] ?></a>
                                <div class="price-new" name="price-new">
                                    <?= number_format($row['price'], 0, '', ',') ?>₫ <span
                                        class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="price" value="<?= $row['price'] ?>" />
                        <input type="hidden" name="title" value="<?= $row['title'] ?>" />
                        <input type="hidden" name="quantity" value="<?= $row['quantity'] ?>" />
                        <div class="col text-center">
                            <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i>
                                Mua</button>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php }}