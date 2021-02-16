<?php
namespace vms;
use vms\templates\ContainerTemplate;

class NewPromotionPage {
    public $title;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Tin khuyến mãi";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="row mb-4 mt-4 mb-4">
    <div class="col-lg-3 col-md-12">
        <div class="menu-news">
            <h5 class="new-title">TIN TỨC</h5>
            <ul>
                <li><i class="fas fa-arrow-circle-right"></i> <a href="./new-promotion">TIN KHUYẾN
                        MÃI</a></li>
                <hr />
                <li><i class="fas fa-arrow-circle-right"></i> <a href="./new-market">TIN THỊ TRƯỜNG</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-9 col-md-12">
        <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <a
                href="./new.php" class="text-dark">Tin tức</a> <i class="fas fa-angle-double-right"></i> <span
                class="introduce">Tin khuyến mãi</span></small>
        <div class="news-content">
            <div classs="news-block">
                <div class="news-item news-item-promotion">
                    <div class="row">
                        <div class="col-lg-4 image-box-container-2">
                            <img src="./assets/img/news/1.jpg" alt="" class="image-box" />
                        </div>
                        <div class="col-lg-8 title-news">
                            <a href="./new-detail">NHỮNG CÔ NÀNG TRẺ TRUNG TRONG COMBO MÙA HÈ</a>
                            <p><small>04/02/2021</small></p>
                            <p>
                                Áo Công Sở Tay Búp Sang Trọng – Kiểu Dáng Thời Trang, Chất Liệu Tơ Gân Mềm
                                Mịn, Gam Màu Tươi Tắn – Mang Đến Vẻ Ngoài Trẻ Trung, Duyên Dáng Cho Bạn Gái.
                                Giá 210.000 VNĐ, Còn 125.000 VNĐ, Giảm 40%.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="news-item news-item-promotion">
                    <div class="row">
                        <div class="col-lg-4 image-box-container-2">
                            <img src="./assets/img/news/2.jpg" alt="" class="image-box" />
                        </div>
                        <div class="col-lg-8 title-news">
                            <a href="./new-detail">NHỮNG GÓC KHUẤT CỦA NGHỀ STYLIST CHO SAO
                                HOLLYWOOD</a>
                            <p><small>04/02/2021</small></p>
                            <p>
                                Áo Công Sở Tay Búp Sang Trọng – Kiểu Dáng Thời Trang, Chất Liệu Tơ Gân Mềm
                                Mịn, Gam Màu Tươi Tắn – Mang Đến Vẻ Ngoài Trẻ Trung, Duyên Dáng Cho Bạn Gái.
                                Giá 210.000 VNĐ, Còn 125.000 VNĐ, Giảm 40%.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }}