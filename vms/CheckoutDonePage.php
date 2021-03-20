<?php
namespace vms;
use vms\templates\ContainerTemplate;

class CheckoutDonePage {
    public $title;
    public function __construct($params = null) {
        $this->title  = "Hoàn tất";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>

<section class="product-4 mb-5 mt-5">
     <div class="container">
          <div class="row d-flex justify-content-center">
               <div class="col-md-6">
                    <div class="checkout-detail">
                         <div class="checkout__list">
                              <div class="list-img"><img src="/assets/img/checkout-mb-1/Group.png" alt=""></div>
                              <h5 class="title-complete">Đặt Hàng Thành Công </h5>
                              <p class="descrip-pay">Vui lòng chuẩn bị số tiền cần thanh toán</p>
                              <p class="total-pay"> <span>900.000 đ </span></p>
                              <p class="code-product">Mã Đơn Hàng <span class="code">D90283-020293. </span></p>
                              <p class="info-product">Xem thông tin đơn hàng <span> <a href="#">tại đây</a></span></p>
                              <div class="support-check">
                                   <p class="info-cont">Để được hỗ trợ vui lòng gọi vào hotline <span class="number-phone">1111111111</span></p>
                                   <p class="info-cont">hoặc Zalo <span class="number-phone">22222222222 </span></p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

<?php }}