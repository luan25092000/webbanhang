<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\CheckoutAPI;
use api\v1\AccountAPI;

class CheckOrderPage {
    public $title;
    private $account;
    private $orders;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Kiểm tra đơn hàng";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        // Get the orders if logged
        $res = AccountAPI::checkAuthRequest();
        if($res->status) {
            $this->account = $res->message;
            $res = CheckoutAPI::reads($this->account["id"]);
            if($res->status) {
                $this->orders = $res->message;
            }
        }

        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="row check-order-container mt-4">
    <div class="col-lg-10">
        <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span
                class="introduce">Kiểm tra đơn
                hàng</span></small>

        <?php if($this->orders) { ?>
            <div class="heading-lg mt-3 mb-3">
                <h1>ĐƠN HÀNG CỦA BẠN</h1>
            </div>
            <ul class="list-group mb-5">
                <?php foreach($this->orders as $item) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="/order-detail/<?= $item["code"] ?>"><?= $item["code"] ?></a>
                        <?php if(!$item["status"]) { ?>
                            <span class="badge badge-danger badge-pill">
                                Chưa thanh toán
                            </span>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>
<?php }}