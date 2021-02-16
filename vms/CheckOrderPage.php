<?php
namespace vms;
use vms\templates\ContainerTemplate;

class CheckOrderPage {
    public $title;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Kiểm tra đơn hàng";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
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
        <h5 class="mt-3">KIỂM TRA ĐƠN HÀNG</h5>
        <form action="" method="get">
            <div class="form-group">
                <label>Nhập mã đơn hàng</label>
                <input type="number" placeholder="Mã số đơn hàng" name="cartId" class="form-control form-control-sm" />
            </div>
            <button type="submit" class="btn btn-sm btn-primary">XEM NGAY</button>
        </form>
    </div>
</div>
<?php }}