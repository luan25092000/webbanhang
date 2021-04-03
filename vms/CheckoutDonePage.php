<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\AccountAPI;
use api\v1\CountryAPI;
use api\v1\CheckoutAPI;

class CheckoutDonePage {
    public $title;
    private $account;
    private $message;
    private $order_id;
    private $order;
    
    public function __construct($params = null) {
        $this->title  = "Hoàn tất";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
          // Check auth
          $res = AccountAPI::checkAuthRequest();
          if(!$res->status) {
               header("Location: /login");
               return;
          }
          $this->account = $res->message;

          // Checkout cart return lading code if success
          $res = CheckoutAPI::done($this->account["id"]);
          if(!$res->status) {
               $this->message = $res->message;
          } else {
               $this->order_id = $res->message;
          }

          // Get order if success
          if($this->order_id) {
               $res = CheckoutAPI::read($this->order_id);
               if($res->status) {
                    if(count($res->message))
                         $this->order = $res->message[0];
                    else $this->message = $res->message;
               } else $this->message = $res->message;
          }

          $template = new ContainerTemplate();
          $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>

<section class="product-4 mb-5 mt-5">
     <?php if($this->order) { ?>
     <div class="container">
          <div class="row d-flex justify-content-center">
               <div class="col-md-6">
                    <div class="checkout-detail">
                         <div class="checkout__list">
                              <div class="list-img"><img src="/assets/img/checkout-mb-1/Group.png" alt=""></div>
                              <h5 class="title-complete">Đặt Hàng Thành Công </h5>
                              <p class="descrip-pay">Vui lòng chuẩn bị số tiền cần thanh toán</p>
                              <p class="total-pay"> <span><?= number_format($this->order["total"]) ?>đ</span></p>
                              <p class="code-product">Mã Đơn Hàng <span class="code"><?= $this->order["code"] ?>. </span></p>
                              <p class="info-product">Xem thông tin đơn hàng <span> <a href="/account">tại đây</a></span></p>
                              <div class="support-check">
                                   <p class="info-cont">Để được hỗ trợ vui lòng gọi vào hotline <span class="number-phone">0909259719</span></p>
                                   <p class="info-cont">hoặc Zalo <span class="number-phone">0909259719 </span></p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <?php } else {?>
          <div class="alert alert-danger" role="alert">
               <?= $this->message ?>
          </div>
     <?php } ?>
</section>

<?php }}