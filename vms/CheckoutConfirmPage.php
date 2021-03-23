<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\AccountAPI;
use api\v1\CountryAPI;
use api\v1\CartAPI;
use api\v1\PromotionAPI;

class CheckoutConfirmPage {
    public $title;
    private $account;
    private $cart;
    private $message;
    private $address;
    private $promotion = 0;

    public function __construct($params = null) {
        $this->title  = "Xác nhận";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        // Check auth
        $res = AccountAPI::checkAuthRequest();
        if(!$res->status) {
             header("Location: /");
             return;
        }
        $this->account = $res->message;

        // Get cart
        $res = CartAPI::read($this->account["id"]);
        if(!$res->status) {
            $this->message = $res->message;
        }
        $this->cart = $res->message[0];
        $this->cart["total"] = 0;
        foreach($this->cart["cart_items"] as $item) {
            $this->cart["total"] += (int)$item["quantity"] * (int)$item["price"];
        }

        // Get promotion
        if($this->cart && $this->cart["promotionId"]) {
            $res = PromotionAPI::getById($this->cart["promotionId"]);
            if($res->status) {
                if(count($res->message)) {
                    $this->promotion = $res->message[0]["price"];
                }
            }
        }

        // Get address
        $res = CountryAPI::getAddress($this->account["city"], $this->account["district"], $this->account["commune"]);
        $this->address = $res->message;

        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>

<div class="container">
    <div class="heading-link mt-3">
        <ul class="item">
            <li class="home">
                <a href="/">Trang chủ</a>
            </li>
            <li class="icon active">
                <a>Xác nhận thông tin</a>
            </li>
        </ul>
    </div>
    <div class="heading-lg">
        <h1>XÁC NHẬN THÔNG TIN</h1>
    </div>
    <div class="step">
        <div class="step-item active">
            <div class="step-item-icon mr-0">
                <i class="fas fa-cart-plus"></i>
            </div>
            <span>GIỎ HÀNG</span>
            <div class="step-number">1</div>
        </div>
        <div class="liner mr-0"></div>
        <div class="step-item active">
            <div class="step-item-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <span>THANH TOÁN</span>
            <div class="step-number">2</div>
        </div>
        <div class="liner mr-0"></div>
        <div class="step-item active">
            <div class="step-item-icon">
                <i class="fas fa-check"></i>
            </div>
            <span>HOÀN TẤT</span>
            <div class="step-number">3</div>
        </div>
    </div>
    <div class="section-checkout__content">
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout-mb-2">
                    <div class="checkout-headding">
                        <h1>Thông tin người nhận</h1>
                    </div>
                    <div class="liner"></div>
                    <table class="checkout-infor">
                        <tr class="infor-item align-items-center">
                            <td><div class="item_icon"><i class="fas fa-user-plus"></i></div></td>
                            <td><div class="item_content"><?= $this->account["fullName"] ?></div></td>
                        </tr>
                        <tr class="infor-item align-items-center">
                            <td><div class="item_icon"><i class="fas fa-phone-alt"></i></div></td>
                            <td><div class="item_content"><?= $this->account["phone"] ?></div></td>
                        </tr>
                        <tr class="infor-item align-items-center">
                            <td><div class="item_icon"><i class="fas fa-map-marker-alt"></i></div></td>
                            <td><div class="item_content"><?= $this->address ?></div></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-checkout__right">
                    <div class="checkout-headding">
                        <h1>Thông tin đơn hàng</h1>
                    </div>
                    <div class="liner"></div>
                    <div class="section-checkout__right-content">
                        <ul class="section-checkout__right-list">
                            <li class="section-checkout__right-item"><b>Tạm tính:</b><span><?= number_format($this->cart["total"]) ?>đ</span></li>
                            <li class="section-checkout__right-item"><b>Phí vận chuyển:</b><span><?= number_format($this->cart["shipping"]) ?>đ</span></li>
                            <li class="section-checkout__right-item"><b>Giảm giá:</b><span class="discount"><?= number_format($this->promotion) ?>đ</span></li>
                            <!-- Nhập mã giảm -->
                            <div class="input-group mb-3 mt-3">
                                <input name="promotion_code" type="text" class="form-control" placeholder="Nhập mã giảm giá">
                                <div class="input-group-append">
                                    <button id="add-promotion" onclick="addPromotion()" class="btn btn-primary" type="text">Thêm mã</button>
                                </div>
                            </div>
                            <li class="section-checkout__right-item section-checkout__right-item--money"><b>Thành tiền:</b><span class="money"><?= number_format($this->cart["total"] + 25000 - $this->promotion) ?>đ</span></li>
                        </ul>
                        <div class="desc-btn">
                            <p class="desc">Bằng việc nhấn thanh toán, bạn đồng ý với <a href="">Các điều khoản khách hàng </a>của Nhà xuất bản Xây Dựng</p>
                            <a class="btn-pay" href="/checkout-done">Thanh toán bằng tiền mặt</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function addPromotion() {
    let promotion_code = $("input[name='promotion_code']").val();
    $.ajax({
        url: "/api/v1/checkout/promotion",
        type: "POST",
        data: { promotion_code },
        dataType: "json",
    }).done((data) => {
        if(data.status) {
            window.location.reload(false);
        } else {
            displayMessageModal(data.message, "danger");
        }
    }).fail((err) => {
        displayMessageModal("Có lỗi xảy ra", "danger");
    });
}
</script>
<?php }}