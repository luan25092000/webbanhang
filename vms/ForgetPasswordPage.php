<?php
namespace vms;
use api\v1\AccountAPI;
use auth\SendMail;
use vms\templates\ContainerTemplate;

class ForgetPasswordPage {

    public $messenge;

    public function __construct($param = null) {
         $this->title  = "Reset Password";
    }

    public function render() {
        $template = new ContainerTemplate();
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
            $res = AccountAPI::updateToken($email);
            if($res->status){
               // echo $email;
               SendMail::post($res->message, $email, $email, "reset");
               setcookie("email", $email, time() + (86400 * 30), "/");
               // header("Location: /");
            } else {
                $this->messenge = "Email is invalid";
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
                    <h1>NHẬP EMAIL</h1>
               </div>
               <form class="form-horizontal mt-4" method="post">
                    <div class="form-group">
                         <label class="control-label col-sm-2" for="email">Email:</label>
                         <div class="col-sm-10">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email">
                         </div>
                    </div>
                    <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn-login">Gửi</button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</div>

<?php }}