<?php
namespace vms;
use vms\templates\ContainerTemplate;

class LoginPage {
    public function __construct($params = null) {
        $this->title  = "Đăng nhập";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    public function __render() {
?>

<div class="container">
     <div class="heading-link mt-3">
          <ul class="item">
               <li class="home">
                    <a href="/">Trang chủ</a>
               </li>
               <li class="icon active">
                    <a>Đăng nhập</a>
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
                              Đăng nhập
                         </a>
                    </li>
                    <li>
                         <a href="/register">
                              <i class="fas fa-sign-in-alt"></i>
                              Đăng ký
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
                    <h1>ĐĂNG NHẬP HỆ THỐNG</h1>
               </div>
               <form class="form-horizontal mt-4" action="/action_page.php">
                    <div class="form-group">
                         <label class="control-label col-sm-2" for="email">Email:</label>
                         <div class="col-sm-10">
                              <input type="email" class="form-control" id="email" placeholder="Nhập email">
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="control-label col-sm-2" for="pwd">Password:</label>
                         <div class="col-sm-10">
                              <input type="password" class="form-control" id="pwd" placeholder="Nhập password">
                         </div>
                    </div>
                    <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn-login">Đăng nhập</button>
                              <a href="">Quên mật khẩu</a>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</div>

<?php }}