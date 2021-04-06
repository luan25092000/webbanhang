<?php
namespace vms;
use api\v1\AccountAPI;
use vms\templates\ContainerTemplate;

class LoginPage {

    public $messenge;

    public function __construct($param = null) {
         $this->title  = "Đăng nhập";
    }

    public function render() {
        $template = new ContainerTemplate();
        if (isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $res = AccountAPI::login($username, $password);
            if($res->status){
                $jwt = AccountAPI::createJWT($username);
                AccountAPI::setcookieJWT($jwt);
                
                header("Location: /");
            } else {
                $this->messenge = "Username/Password is invalid";      
            }
        }
        $template->renderChild($this);
    }
    public function __render() {
     
     if ($this->messenge) {
          echo '<script type="text/javascript">
          $(document).ready(function () {
               displayMessageModal("' . $this->messenge . '", "danger");
          });
          </script>';
     }

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
                         <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id=164347036653-ktgchofs0isrkp6fdpombkirmvdhvsmk.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fstore.kaito.ninja%2Flogin-with-google.php&state&scope=email%20profile&approval_prompt=auto">
                              <i class="fas fa-sign-in-alt"></i>
                              Đăng nhập với Google
                         </a>
                    </li>
                    <li>
                         <a href="https://www.facebook.com/v2.10/dialog/oauth?client_id=446677652971923&state=17258e491c73a929ff58a5d16993198d&response_type=code&sdk=php-sdk-5.7.0&redirect_uri=https%3A%2F%2Fstore.kaito.ninja%2Flogin-with-fb.php&scope=email">
                              <i class="fas fa-sign-in-alt"></i>
                              Đăng nhập với FB
                         </a>
                    </li>
                    <li>
                         <a href="/register">
                              <i class="fas fa-sign-in-alt"></i>
                              Đăng ký
                         </a>
                    </li>
                    <li>
                         <a href="/forgetpassword">
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
                    <div class="ml-3">
                         <span style="line-height: 3rem; vertical-align: top;">Hoặc đăng nhập với </span>
                         <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id=164347036653-ktgchofs0isrkp6fdpombkirmvdhvsmk.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fstore.kaito.ninja%2Flogin-with-google.php&state&scope=email%20profile&approval_prompt=auto">
                         <div id="logo">
                              <div class="g-line"></div>
                              <span class="red"></span>
                              <span class="yellow"></span>
                              <span class="green"></span>
                              <span class="blue"></span>
                         </div>
                         </a>
                         <!-- https://www.facebook.com/v2.10/dialog/oauth?client_id=921130358246916&state=fb7fba695614825d17acaf52cddb2880&response_type=code&sdk=php-sdk-5.7.0&redirect_uri=https%3A%2F%2Fstore.kaito.ninja%2F&scope=email -->
                    </div>
               </form>
               
               
          </div>
     </div>
</div>
<style>
#logo {
  display: inline-block;
  position: relative;
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
  margin-left: auto;
  margin-right: auto;
  overflow: hidden;
  border: .2rem solid #f1f1f1;
  box-shadow: 0 0px 4px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.24);
}
#logo::after {
    position: absolute;
    content: '';
    display: block;
    width: 60%;
    height: 60%;
    border-radius: 50%;
    background: #f1f1f1;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    z-index: 4;
  }
  #logo::before{
    position: absolute;
    content: '';
    display: block;
    width: 35%;
    height: 32%;
    background: #f1f1f1;
    right: 0;
    z-index: 10;
    bottom: 50%;
    transform: rotateZ(45deg);
    -webkit-transform: rotateZ(45deg);
  }
  #logo .g-line{
    width: 50%;
    height: 20%;
    background: #0091ea;
    position: absolute;
    right: 0;
    margin: auto;
    border-bottom-right-radius: 4px 20px;
    top: 0;
    bottom: 0;
    z-index: 15;
  }
  
  #logo .yellow{
    width: 40%;
    height: 40%;
    position: absolute;
    left: -15%;
    bottom: 32%;
    margin: auto;
    background:  #ffc107;
    transform: rotateZ(-48deg);
    -webkit-transform: rotateZ(-48deg);
    z-index: 3;
  }
  #logo .green{
    position: absolute;
    width: 100%;
    height: 50%;
    bottom: 0;
    border-radius: 0 0 100% 100%;
    background: #4caf50;
    z-index: 2;
  }
  #logo .blue{
    position: absolute;
    width: 0px;
    height: 0px;
    right: 0;
    z-index: 30;
    top: 50%;   
    z-index: 2;
    width: 35%;
    height: 32%;
    background: #0091ea;
    right: 0;
    z-index: 2;
    transform: rotateZ(45deg);
    -webkit-transform: rotateZ(45deg);
  }  
  #logo .red{
    width: 81%;
    height: 50%;
    position: absolute;
    top: 0px;
    background: #f44336;
  }
</style>
<?php }}