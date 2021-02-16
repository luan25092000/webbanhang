<?php
namespace vms;
use vms\templates\ContainerTemplate;

class FieldPage {
    public $title;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Lĩnh vực hoạt động";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="row mt-4 mb-4">
    <div class="col-lg-3">
        <div class="menu-about">
            <h3>
                <span>
                    Giới thiệu
                </span>
            </h3>
            <ul>
                <li><i class="fas fa-angle-double-right"></i> <a href="./introduce">Về chúng tôi</a>
                </li>
                <li><i class="fas fa-angle-double-right"></i> <a href="./field">Lĩnh vực hoạt động</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="menu-header-introduce">
            <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i>
                <span class="introduce">Giới thiệu</span></small>
            <h5 class="mt-3">LĨNH VỰC HOẠT ĐỘNG</h5>
            <div class="content">
                <p>Dưới đây là nội dung mẫu của chúng tôi. Nội dung này chỉ mang tính chất minh họa:</p>

                <p>Royal Hotel - Khách sạn Hoàng Gia nằm giữa tuyến đường chính của khu du lịch, bên bờ vịnh
                    Cát Bà xinh đẹp, có vị trí thuận tiện về giao thông, chỉ cách bến tàu cao tốc 50 m cách
                    bến xe ô tô 20 m.
                    Khách sạn có 698 phòng nghỉ được thiết kế hài hòa trang nhã,trang thiết bị sang trọng,
                    hiện đại đạt tiêu chuẩn Quốc tế 5 sao.
                    Trong đó có 150 phòng đặc biệt, 200 phòng cao cấp 100 phòng hạng sang, 150 phòng tiêu
                    chuẩn.</p>

                <p>Hệ thống nhà hàng sang trọng, không gian thoáng đãng, tươi mới, hiện đại phục vụ được
                    trên 10.000 thực khách. Nhà hàng nằm trên tầng 21 của khách sạn là nơi có tầm nhìn lý
                    tưởng bao quát khu du lịch, chuyên phục các món ăn Âu, Trung Quốc và Việt nam và trên
                    toàn thế giới với các món ăn ngon được chế biến từ các đầu bếp chuyên nghiệp cùng với
                    phong cảnh thiên nhiên kỳ vĩ mà thiên nhiên ban tặng chắc chắn sẽ làm quý khách hài
                    lòng.
                    Vườn Thượng uyển trên tầng 13 là nơi tổ chức các bữa tiệc ngoài trời, các chương trình
                    Ga la, hát karaoke theo yêu cầu của quý khách.</p>


                <p>Khách sạn Royal Hotel có một phòng hội nghị lớn diện tích gần 200m2 ở tầng 6 với số lượng
                    lên đến 10000 người và 98 phòng họp khác có sức chứa từ 5000 đến 8000 người có thể được
                    bố trí và sắp xếp thành các phòng đa chức năng tuỳ theo yêu cầu của quý khách.
                    Ngoài ra, khách sạn Royal Hotel có hội trường tầng 10 với sức chứa từ 70-100 khách. Được
                    bố trí theo hình lớp học hoặc chữ U theo yêu cầu của quý khách, được thiết kế trang
                    trọng với hệ thống âm thanh ánh sáng hiện đại sẽ đáp ứng hoàn hảo cho các cuộc họp ,hội
                    nghị, tiệc hoặc sự kiện đặc biệt của quý khách.
                    Câu lạc bộ sức khỏe nằm trên tầng 30 của khách sạn với hệ thống các phòng massage VIP,
                    SPA, Foot massage,... làm cho quý khách được thư giãn sau một ngày mệt mỏi. Dịch vụ giải
                    trí và thư giãn đa dạng và phong phú đáp ứng mọi nhu cầu của mọi đối tượng khách hàng.
                </p>

                <p>Với đội ngũ nhân viên nhiệt tình và hiếu khách, phong cách phục vụ chuyên nghiệp chắc
                    chắn sẽ đem lại cho quý khách một ấn tượng tuyệt vời!</p>
            </div>
        </div>
    </div>
</div>
<?php }}