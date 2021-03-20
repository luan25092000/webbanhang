<?php
namespace vms;
use vms\templates\ContainerTemplate;

class CheckoutConfirmPage {
    public $title;
    public function __construct($params = null) {
        $this->title  = "Xác nhận";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
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
                            <td><div class="item_content">Hoàng Đức Tuấn</div></td>
                        </tr>
                        <tr class="infor-item align-items-center">
                            <td><div class="item_icon"><i class="fas fa-phone-alt"></i></div></td>
                            <td><div class="item_content">+84 936 255 358</div></td>
                        </tr>
                        <tr class="infor-item align-items-center">
                            <td><div class="item_icon"><i class="fas fa-map-marker-alt"></i></div></td>
                            <td><div class="item_content">Tòa A Hồ Gươm plaza, Vũ Trọng Khánh, Phường Mộ Lao, Quận Hà Đông, Hà Nội</div></td>
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
                            <li class="section-checkout__right-item"><b>Tạm tính:</b><span>900.000đ</span></li>
                            <li class="section-checkout__right-item"><b>Phí vận chuyển:</b><span>25.000đ</span></li>
                            <li class="section-checkout__right-item"><b>Giảm giá:</b><span class="discount">-25.000đ</span></li>
                            <li class="section-checkout__right-item section-checkout__right-item--money"><b>Thành tiền:</b><span class="money">900.000đ</span></li>
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

<?php }}