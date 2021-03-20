<?php
namespace vms;
use vms\templates\ContainerTemplate;

class CheckoutPage {
    public $title;
    public function __construct($params = null) {
        $this->title  = "Thanh toán";
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
                <a>Thông tin người nhận</a>
            </li>
        </ul>
    </div>
    <div class="heading-lg">
        <h1>THÔNG TIN NGƯỜI NHẬN</h1>
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
        <div class="step-item">
            <div class="step-item-icon">
                <i class="fas fa-check"></i>
            </div>
            <span>HOÀN TẤT</span>
            <div class="step-number">3</div>
        </div>
    </div>
    <div class="checkout_mb-1 mb-5">
        <div class="section_form">
            <form action="">
                <div class="single-input">
                    <span><img src="/assets/img/checkout-mb-1/user-plus.svg"></span>
                    <input class="hover-input" type="text" placeholder="Họ và tên">
                </div>
                <div class="single-input">
                    <span><img src="/assets/img/checkout-mb-1/phone.svg"></span>
                    <input class="hover-input" type="text" placeholder="Số điện thoại">
                </div>
                <div class="single-input"><span><img src="/assets/img/checkout-mb-1/email.svg"></span>
                    <input class="hover-input" type="text" placeholder="Email">
                </div>
                <div class="single-input"><span><img src="/assets/img/checkout-mb-1/map.svg"></span>
                    <select class="select-option" style="color:#02010E; font-size: 16px; font-weight: 500;">
                        <option value="placeholder" selected="" disabled="">Chọn Tỉnh/TP</option>
                        <option value="dn">Đà Nắng</option>
                        <option value="tphcm">TPHCM</option>
                        <option value="hn">Hà Nội</option>
                        <option value="hue">Huế</option>
                        <option value="cantho">Cần Thơ</option>
                    </select>
                    <div class="icon-dropdown"><img src="/assets/img/checkout-mb-1/arrow.svg"></div>
                </div>
                <div class="single-input"><span><img src="/assets/img/checkout-mb-1/map-1.svg"></span>
                    <input class="hover-input" type="text" placeholder="Nhập vị trí">
                </div>
                <div class="textarea-wrap">
                    <textarea class="hover-input" placeholder="Ghi chú" style="height:94px"></textarea>
                    <img alt="" srcset="" data-ll-status="loaded" src="/assets/img/checkout-mb-1/icon-textarea.svg">
                </div>
            </form>
        </div><a class="btn_checkout-mb-1" href="/checkout-confirm">Tiếp tục</a>
    </div>
</div>

<?php }}