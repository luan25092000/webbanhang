<?php
namespace vms;
use api\v1\ProductAPI;
use vms\templates\ContainerTemplate;

class ProductDetailPage {
    public $title;
    private $rows;
    private $product;
    
    public function __construct($params = null) {
        // Set title
        $this->title  = "Sản phẩm";
        // Tất cả sản phẩm
        $this->rows = ProductAPI::getBySex("Nữ");
        // Sản phẩm cụ thể
        $this->product = ProductAPI::getById($params[0]);
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
    <div class="row">
        <div class="col-lg-3">
            <div class="menu-about">
                <h4>
                    <span>
                        Chính sách bán hàng
                    </span>
                </h4>
                <ul class="box-sales-policy">
                    <li>
                        <span>1</span>Giao hàng TOÀN QUỐC
                    </li>
                    <li>
                        <span>2</span>Thanh toán khi nhận hàng
                    </li>
                    <li>
                        <span>3</span>Đổi trả trong
                        <span class="color-pink">15 ngày</span>
                    </li>
                    <li>
                        <span>4</span>Hoàn ngay tiền mặt
                    </li>
                    <li>
                        <span>5</span>Chất lượng đảm bảo
                    </li>
                    <li>
                        <span>6</span>Miễn phí vận chuyển:
                        <span class="color-pink">Đơn hàng từ 3 món trở lên</span>
                    </li>
                </ul>
                <div class="buy-guide">
                    <h3>Hướng Dẫn Mua Hàng</h3>
                    <ul class="buy-guide-policy">
                        <li>
                            <span>1</span>Mua hàng trực tiếp tại website
                            <b>http://www.runtime.vn</b>
                        </li>
                        <li>
                            <span>2</span>Gọi điện thoại
                            <b class="color-pink">033 918 1998</b> để mua hàng
                        </li>
                        <li>
                            <span>3</span>Mua tại Trung tâm CSKH:
                            <b class="color-pink">5/12A Quang Trung, P.14, Q.Gò Vấp, Tp.HCM</b>
                        </li>
                        <li>
                            <span>4</span>Mua sỉ/buôn xin gọi
                            <b>0908 77 00 95</b> để được hỗ trợ.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu-about">
                <h4>
                    <span>
                        SẢN PHẨM HOT
                    </span>
                </h4>
                <div class="row">
                    <?php foreach($this->rows->message as $row): ?>
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-image">
                                <a href="/product-detail/<?= $row['id'] ?>">
                                    <img src=<?= $row['imgPath'] ?> class="card-img-top" alt="<?= $row['title'] ?>" />
                                </a>
                            </div>
                        </div>
                        <div class="box-product-block">
                            <div class="name text-center">
                                <a href="/product-detail/<?= $row['id'] ?>" title="<?= $row['title'] ?>">
                                    <b><?= $row['title'] ?></b>
                                </a>
                            </div>
                        </div>
                        <div class="price text-center">
                            <span class="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫</span>
                        </div>
                        <div class="btn-buy text-center">
                            <button class="btn btn-default">Mua ngay</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <div class="col-lg-9">
            <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <a
                    href="./product" class="text-dark">Sản phẩm</a>
                <i class="fas fa-angle-double-right"></i> <span class="introduce">Chi tiết sản
                    phẩm</span></small>
            <div class="row mt-4">
                <?php foreach($this->product->message as $row): ?>
                <div class="col-md-6 sp-large">
                    <a href="/product-detail/<?= $row['id'] ?>"><img src=<?= $row['imgPath'] ?>
                            alt="<?= $row['title'] ?>"></a>
                </div>
                <div class="col-md-6 describe">
                    <h2 class="ng-binding"><?= $row['title'] ?></h2>
                    <div class="price">
                        <span class="price-new ng-binding"><?= number_format($row['price'], 0, '', ',') ?>₫</span>
                    </div>
                    <span class="product-code ng-binding"><b>Mã SP:</b> </span>
                    <p class="describe-detail">
                        <?= $row['title'] ?> – Kiểu Dáng Thời Trang, Chất Liệu Tơ Gân Mềm Mịn, Gam Màu
                        Tươi Tắn – Mang Đến Vẻ Ngoài Trẻ Trung, Duyên Dáng Cho Bạn Gái.</p>
                    <iframe
                        src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fluankma&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=415196006363533"
                        width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    
                    <form class="add-to-cart">
                        <div class="product-detail-quantity">
                            <input type="hidden" value="<?php echo $row['id']; ?>" name="product_id">
                            <h5>Số lượng:</h5>
                            <div style="display: flex; flex-direction: row; ">
                                <button type="button" class="quantity-btn" data-quantity-minus="" onclick="addQuantity(-1)">
                                    <svg viewBox="0 0 409.6 409.6"><g><g><path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z"></path></g></g></svg>
                                </button>
                                <input id="product-detail-quantity-input" class="quantity-input" type="number" value="1" class="text ng-valid ng-dirty ng-valid-number ng-touched"
                                    ng-model="InputQuantity" ng-init="InputQuantity=1" name="product_quantity">
                                <button type="button" class="quantity-btn" data-quantity-plus="" onclick="addQuantity(1)">
                                    <svg viewBox="0 0 426.66667 426.66667"><path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div class="btn-buy mt-4">
                            <button type="submit" class="btn btn-danger btn-add-to-cart">
                                <i class="fas fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </form>

                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-12">
                <div class="menu-about">
                    <h4>
                        <span>
                            Chi tiết sản phẩm
                        </span>
                    </h4>
                    <div class="content-describe">
                        - Áo công sở được thiết kế đơn giản, nhưng không kém phần tinh tế, với form áo vừa vặn,
                        cổ bẻ, điểm nhấn ở phần tay búp sen được may cách điệu, đẹp mắt. <br />
                        Điểm nổi bật
                        - Chất liệu tơ gân mềm mịn, thông thoáng và thấm hút mồ hôi tốt, nên tạo được cảm giác
                        thoải mái cho người mặc
                        - Ba gam màu: hồng, xanh, trắng tươi tắn, trẻ trung, rất dễ để kết hợp với chân váy công
                        sở, quần tây, jeans,… tạo vẻ ngoài chỉn chu khi đi làm. <br>
                        - Trọng lượng gói hàng cả bao bì: 150 gram <br>

                        Điều kiện <br>
                        - Hotdeal giao sản phẩm theo màu đến tận tay khách hàng. <br>
                        + Đối với khu vực TP.HCM: Miễn phí. <br>
                        + Đối với các tỉnh thành khác: Chuyển phát nhanh theo phí bưu điện. <br>
                        - Áp dụng cho Áo công sở tay búp sang trọng <br>
                        - Màu sắc: hồng, xanh, trắng <br>
                        - Kích cỡ: Freesize <br>
                        - Thời gian cuối giao sản phẩm đến hết 23/05/2015, không giao sản phẩm ngày chủ nhật.
                        <br>
                        - Khách hàng không bù thêm tiền khi nhận sản phẩm. <br>
                        - Khách hàng vui lòng kiểm tra sản phẩm trước khi nhận hàng, Hotdeal không chịu trách
                        nhiệm đổi trả sản phẩm sau khi giao hàng. <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function addQuantity(quan) {
    let sum = parseInt($("#product-detail-quantity-input").val()) + parseInt(quan);
    if(sum < 1) {
        $("#product-detail-quantity-input").val(1);
    } else {
        $("#product-detail-quantity-input").val(sum);
    }
}
</script>
<?php }}