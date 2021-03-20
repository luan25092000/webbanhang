<?php
namespace vms;
use vms\templates\ContainerTemplate;

class RegisterPage {
    public function __construct($params = null) {
        $this->title  = "Đăng ký";
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
                    <a>Đăng ký</a>
               </li>
          </ul>
     </div>
     <div class="row">
          <div class="col-md-3 mt-1 mb-3">
               <div class="heading-lg">
                    <h1>TÀI KHOẢN</h1>
               </div>
               <ul>
                    <li>
                         <a>
                              <i class="fas fa-sign-in-alt"></i>
                              Đăng ký
                         </a>
                    </li>
                    <li>
                         <a href="/login">
                              <i class="fas fa-sign-in-alt"></i>
                              Đăng nhập
                         </a>
                    </li>
                    <li>
                         <a href="/reset-password">
                              <i class="fas fa-sign-in-alt"></i>
                              Quên mật khẩu
                         </a>
                    </li>
               </ul>
          </div>
          <div class="col-md-9 mt-1 mb-3">
               <div class="heading-lg">
                    <h1>ĐĂNG KÝ TÀI KHOẢN</h1>
               </div>
               <div class="form-checkout">
                    <form action="">
                         <h2>THÔNG TIN TÀI KHOẢN</h2>
                         <div class="form-group">
                              <div class="row mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Tài khoản
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Email
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Mật khẩu
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3 ">Nhập lại mật khẩu
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                         </div>
                         <h2>THÔNG TIN CÁ NHÂN</h2>
                         <div class="form-group">
                              <div class="row mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Họ tên
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3 col-12">Giới tính</label>
                                   <select name="gioi-tinh" id="gioitinh" class=" col-12 col-sm-9 form-control">
                                        <option value="nu">Nữ</option>
                                        <option value="nam">Nam</option>
                                   </select>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">ngày sinh</label>
                                   <input type="date" id="birthday" name="birthday" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Điện thoại (+84)</label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Địa chỉ</label>
                                   <input type="text" class="col-sm-9 form-control">
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Tỉnh/TP</label>
                                   <select name="gioi-tinh" id="gioitinh" class="col-sm-9  form-control">
                                        <option value="nu">TPHCM</option>
                                        <option value="nam">Hà Nội</option>
                                   </select>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Quận huyện</label>
                                   <select name="gioi-tinh" id="gioitinh" class="col-sm-9  form-control">
                                        <option value="nu">Quận 1</option>
                                        <option value="nam">Quận 2</option>
                                   </select>
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="col-sm-8">
                                   <button class="btn-checkout">Đăng kí</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<?php }}