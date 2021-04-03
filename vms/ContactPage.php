<?php
namespace vms;
use vms\templates\ContainerTemplate;

class ContactPage {
    public $title;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Liên hệ";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="row mt-4">
    <div class="col-lg-9">
        <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span
                class="introduce">Liên hệ</span></small>
        <div class="heading-lg mt-3">
            <h1>THÔNG TIN LIÊN HỆ</h1>
        </div>
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5>NHÓM DEEP WEB</h5>
                <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: Học viện kĩ thuật mật mã</p>
                <p><i class="fas fa-phone-alt"></i> Điện thoại: (08) 89 810 3236</p>
                <p><i class="fas fa-envelope-open"></i> Mail: nguyenhuuluan17@gmail.com</p>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <h6 class="mt-4"><span>GỬI THÔNG TIN LIÊN HỆ</span></h6>
                <small class="d-block mb-3">
                    <p>Xin vui lòng điền các yêu cầu vào mẫu dưới đây và gửi cho chúng tôi. Chúng tôi sẽ trả
                        lời bạn ngay sau khi nhận được. Xin chân thành cảm ơn!</p>
                </small>
            </div>
            <div class="col-lg-6 mb-5">
                <form action="" method="get">
                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Họ tên" id="username" name="username">
                    </div>
                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Địa chỉ" id="address" name="address">
                    </div>
                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                    </div>
                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Điện thoại" id="phone" name="phone">
                    </div>
                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pager"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tiêu đề" id="title" name="title    ">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Nội dung" id="comment"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.137209327497!2d106.65496261411663!3d10.800801561698355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752937159dbd15%3A0x286f2a16b253c64b!2zSOG7jWMgVmnhu4duIEvhu7kgVGh14bqtdCBN4bqtdCBNw6M!5e0!3m2!1svi!2s!4v1612410249811!5m2!1svi!2s"
                    width="400" height="320" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <h5 class="mt-4"><span>HỖ TRỢ TRỰC TUYẾN</span></h5>
        <p>Hotline: (08) 89 810 3236</p>
    </div>
</div>
<?php }}