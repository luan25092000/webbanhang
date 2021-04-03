<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\AccountAPI;
use api\v1\CountryAPI;

class CheckoutPage {
    public $title;
    private $account;
    private $countries;

    public function __construct($params = null) {
        $this->title  = "Thanh toán";
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

        // Get countries
        $this->countries = CountryAPI::gets();

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
    <form id="account-info-form">
        <template>
            <div class="checkout_mb-1 mb-5">
                <div class="section_form">
                    <input name="email" type="hidden" value="<?php echo $this->account["email"]; ?>">
                    <div class="single-input bg-light"><span><img src="/assets/img/checkout-mb-1/email.svg"></span>
                        <input class="hover-input bg-light" disabled type="text" placeholder="Email" value="<?php echo $this->account["email"]; ?>">
                    </div>
                    <div class="single-input">
                        <span><img src="/assets/img/checkout-mb-1/user-plus.svg"></span>
                        <input name="fullName" class="hover-input" type="text" placeholder="Họ và tên" value="<?php echo $this->account["fullName"]; ?>">
                    </div>
                    <div class="single-input">
                        <span><img src="/assets/img/checkout-mb-1/phone.svg"></span>
                        <input name="phone" class="hover-input" type="text" placeholder="Số điện thoại" value="<?php echo $this->account["phone"]; ?>">
                    </div>
                    <div class="single-input"><span><img src="/assets/img/checkout-mb-1/map.svg"></span>
                        <select name="city" id="country" class="hover-input form-control"
                            value="<?= $this->account['city'] ?>">
                            <option value="">--Chọn tỉnh thành phố--</option>
                            <?php foreach($this->countries->message as $country): ?>
                                    <option value="<?= $country['matp'] ?>"><?= $country['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="icon-dropdown"><img src="/assets/img/checkout-mb-1/arrow.svg"></div>
                    </div>
                    <div class="single-input"><span><img src="/assets/img/checkout-mb-1/map.svg"></span>
                        <select name="district" id="district" class="hover-input form-control"
                            value="<?= $this->account['district'] ?>">
                            <option value="">--Chọn quận/huyện--</option>
                        </select>
                        <div class="icon-dropdown"><img src="/assets/img/checkout-mb-1/arrow.svg"></div>
                    </div>
                    <div class="single-input"><span><img src="/assets/img/checkout-mb-1/map.svg"></span>
                        <select name="commune" id="commune" class="hover-input form-control"
                            value="<?= $this->account['commune'] ?>">
                            <option value="">--Chọn xã/phường--</option>
                        </select>
                        <div class="icon-dropdown"><img src="/assets/img/checkout-mb-1/arrow.svg"></div>
                    </div>
                    <div class="single-input"><span><img src="/assets/img/checkout-mb-1/map-1.svg"></span>
                        <input class="hover-input" type="text" placeholder="Nhập số nhà, số đường, thôn xóm (tùy chọn)">
                    </div>
                    <div class="textarea-wrap">
                        <textarea class="hover-input" placeholder="Ghi chú (tùy chọn)" style="height:94px"></textarea>
                        <img alt="" srcset="" data-ll-status="loaded" src="/assets/img/checkout-mb-1/icon-textarea.svg">
                    </div>
                </div>
                <a v-if="state == 'off'" @click="submit" class="btn_checkout-mb-1" href="/checkout-confirm">Tiếp tục</a>
                <button v-if="state == 'loading'" type="button" disabled class="btn btn-danger btn_checkout-mb-1">Loading...</button>
            </div>
        </template>
    </form>
</div>
<script src="/assets/js/vue.js"></script>
<script>
var vm = new Vue({
    el: "#account-info-form",
    data: {
        state: "off",
        id: <?php echo $this->account["id"]; ?>,
    },
    methods: {
        submit: function(e) {
            e.preventDefault();
            this.state = "loading";
            $.ajax({
                type: "POST",
                url: "/api/v1/account/put/" + this.id,
                data: $("#account-info-form").serialize(),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
                },
                dataType: "json",
            }).done((data) => {
                if(data.status) {
                    window.location.href = "/checkout-confirm";
                } else {
                    console.log(data.message);
                    displayMessageModal(data.message, "danger");
                }
            }).fail((err) => {
                displayMessageModal("Có lỗi xảy ra", "danger");
            }).always(() => {
                this.state = "off";
            })
        },
    },
});
</script>
<?php }}