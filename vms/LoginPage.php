<?php
namespace vms;
use api\v1\AccountAPI;
use vms\templates\ContainerTemplate;
use route\Router;

class LoginPage {

    public $messenge;

    public function __construct($param = null) {
         $this->title  = "Đăng nhập";
    }

    public function render() {
        $redirect = new Router();
        $template = new ContainerTemplate();
        if (isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if(AccountAPI::login($username, $password)->status){
                AccountAPI::createJWT($username);
                header("Location: /");
            } else {
                $this->messenge = "Username/Password is invalid";
                var_dump($this);
            }
        }
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
               <form class="form-horizontal mt-4" action="/login" method="post">
                    <div class="form-group">
                         <label class="control-label col-sm-2" for="username">Username:</label>
                         <div class="col-sm-10">
                              <input type="text" class="form-control" name="username" id="username" placeholder="Nhập username">
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="control-label col-sm-2" for="password">Password:</label>
                         <div class="col-sm-10">
                              <input type="password" class="form-control" id="password" name="password" placeholder="Nhập password">
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