<?php

namespace vms;

use api\v1\AccountAPI;
use vms\templates\ContainerTemplate;

class ResetPasswordPage
{

     public $messenge;
     public $token;

     public function __construct($param = null)
     {
          $this->title  = "Reset Password";
          $this->token = $param[0];
     }

     public function render()
     {
          $template = new ContainerTemplate();
          if (!empty($this->token) && isset($_COOKIE["email"]) && isset($_POST["password"])) {
               if ($_POST["password"] === $_POST["repeatpassword"]) {
                    $email = $_COOKIE["email"];
                    $res = AccountAPI::checkTokenReset($email);

                    if ($res->status && $res->message[0]["token"] == $this->token) {
                         AccountAPI::changePass($res->message[0]["username"], $_POST["password"]);
                         $jwt = AccountAPI::createJWT($res->message[0]["username"]);
                         AccountAPI::setcookieJWT($jwt);
                         header("Location: /");
                    } else {
                         $this->messenge = "Token is invalid";
                    }
               }else{
                    $this->messenge = "Password not match";
               }
          }
          $template->renderChild($this);
     }
     public function __render()
     {
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
                              <h1>RESET PASSWORD</h1>
                         </div>
                         <form class="form-horizontal mt-4" method="post">
                              <div class="form-group">
                                   <label class="control-label col-sm-2" for="username">Password:</label>
                                   <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Nhập password">
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="control-label col-sm-2" for="password">Nhập lại Password:</label>
                                   <div class="col-sm-10">
                                        <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Nhập lại password">
                                   </div>
                              </div>
                              <div class="form-group">
                                   <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn-login">Đăng nhập</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>

<?php }
}
