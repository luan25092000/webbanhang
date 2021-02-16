<?php
namespace vms;
use vms\templates\ContainerTemplate;

class NewDetailPage {
    public $title;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Tin tức";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="row mb-4 mt-4">
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
        <div class="box-news mt-4">
            <h4><span>TIN TỨC NỔI BẬT</span></h4>
            <div class="news-content">
                <div classs="news-block">
                    <div class="news-item">
                        <div class="row">
                            <div class="col-lg-4 image-box-container-1">
                                <img src="./img/news/1.jpg" alt="" class="image-box" />
                            </div>
                            <div class="col-lg-8 title-news">
                                <a href="./new-detail">NHỮNG CÔ NÀNG TRẺ TRUNG TRONG COMBO MÙA HÈ</a>
                            </div>
                        </div>
                    </div>
                    <div class="news-item">
                        <div class="row">
                            <div class="col-lg-4 image-box-container-1">
                                <img src="./img/news/2.jpg" alt="" class="image-box" />
                            </div>
                            <div class="col-lg-8 title-news">
                                <a href="./new-detail">NHỮNG GÓC KHUẤT CỦA NGHỀ STYLIST CHO SAO
                                    HOLLYWOOD</a>
                            </div>
                        </div>
                    </div>
                    <div class="news-item">
                        <div class="row">
                            <div class="col-lg-4 image-box-container-1">
                                <img src="./img/news/3.jpg" alt="" class="image-box" />
                            </div>
                            <div class="col-lg-8 title-news">
                                <a href="./new-detail">DIỄM MY 9X GỢI Ý VÁY ÁO CHO MÙA HÈ</a>
                            </div>
                        </div>
                    </div>
                    <div class="news-item">
                        <div class="row">
                            <div class="col-lg-4 image-box-container-1">
                                <img src="./img/news/4.jpg" alt="" class="image-box" />
                            </div>
                            <div class="col-lg-8 title-news">
                                <a href="./new-detail">3 CÁCH MẶC VÁY ĐƯỢC LĂNG XÊ MẠNH HÈ 2015</a>
                            </div>
                        </div>
                    </div>
                    <div class="news-item">
                        <div class="row">
                            <div class="col-lg-4 image-box-container-1">
                                <img src="./img/news/5.jpg" alt="" class="image-box" />
                            </div>
                            <div class="col-lg-8 title-news">
                                <a href="./new-detail">NHỮNG PHONG CÁCH 'ĐÓNG KHUNG' CỦA SAO VIỆT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-12">
        <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <a
                href="./new" class="text-dark">Tin tức</a> <i class="fas fa-angle-double-right"></i> <span
                class="introduce">NHỮNG CÔ NÀNG TRẺ TRUNG TRONG
                COMBO MÙA HÈ</span></small>
        <div class="new-detail-content">
            <h5 class="mt-3">NHỮNG CÔ NÀNG TRẺ TRUNG TRONG COMBO MÙA HÈ</h5>
            <small>04/02/2021</small>
            <div class="new-detail-content-child">
                <div>Điểm nổi bật</div>
                <div>- Áo công sở được thiết kế đơn giản, nhưng không kém phần tinh tế, với form áo vừa vặn,
                    cổ bẻ, điểm nhấn ở phần tay búp sen được may cách điệu, đẹp mắt.</div>
                <div>- Chất liệu tơ gân mềm mịn, thông thoáng và thấm hút mồ hôi tốt, nên tạo được cảm giác
                    thoải mái cho người mặc</div>
                <div>- Ba gam màu: hồng, xanh, trắng tươi tắn, trẻ trung, rất dễ để kết hợp với chân váy
                    công sở, quần tây, jeans,… tạo vẻ ngoài chỉn chu khi đi làm.</div>
                <div>- Trọng lượng gói hàng cả bao bì: 150 gram</div>
            </div>
            <div class="new-detail-content-child">
                <div>Điều kiện</div>
                <div>- Hotdeal giao sản phẩm theo màu đến tận tay khách hàng.</div>
                <div>+ Đối với khu vực TP.HCM: Miễn phí.</div>
                <div>+ Đối với các tỉnh thành khác: Chuyển phát nhanh theo phí bưu điện.</div>
                <div>- Áp dụng cho Áo công sở tay búp sang trọng</div>
                <div>- Màu sắc: hồng, xanh, trắng</div>
                <div>- Kích cỡ: Freesize</div>
                <div>- Thời gian cuối giao sản phẩm đến hết 23/05/2015, không giao sản phẩm ngày chủ nhật.
                </div>
                <div>- Khách hàng không bù thêm tiền khi nhận sản phẩm.</div>
                <div>- Khách hàng vui lòng kiểm tra sản phẩm trước khi nhận hàng, Hotdeal không chịu trách
                    nhiệm đổi trả sản phẩm sau khi giao hàng.</div>
            </div>
            <iframe
                src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fluankma&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=415196006363533"
                width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowfullscreen="true"
                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
    </div>
</div>
<?php }}