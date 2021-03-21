<?php
namespace vms;
use api\v1\AccountAPI;
<<<<<<< HEAD
use vms\templates\ContainerTemplate;
use route\Router;
=======
>>>>>>> f550f99da737d92b01f324b01940acd2e0195fc5
use models\AccountModel;
use api\v1\CountryAPI;

class RegisterPage {

    public $title;
    public $messenge;
    public $countries;

    public function __construct($param = null) {
          $this->title  = "Đăng ký";
          $this->countries = CountryAPI::gets();
    }

    public function render() {
          $template = new ContainerTemplate();
          if (isset($_POST["password"])) {
               if ($_POST["password"] === $_POST["repeatpassword"]) {
                    $password = $_POST["password"];
                    $username = $_POST["username"];
                    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
                    if(!preg_match($pattern, $password)){
                    $checkExist = AccountAPI::checkExistUsername($username);
                    if ($checkExist->status) {
<<<<<<< HEAD
                         $account = new AccountModel($_POST);
                         $result = AccountAPI::post($account);
                         
                         if ($result->status) {
                              AccountAPI::createJWT($username);
                              $reRender = new Router();
                              $reRender->map("/", "GET");
                         }
                         
                    }else{
                         $this->messenge = $username . ' is already in use';
=======
                        $account = new AccountModel($_POST);
                        $result = AccountAPI::post($account);
                        
                        if ($result->status) {
                            AccountAPI::createJWT($username);
                            echo("<script>location.href = '/';</script>");
                        }
                        
                    }else{
                        $this->messenge = $username . ' is already in use';
                        var_dump($this);
>>>>>>> f550f99da737d92b01f324b01940acd2e0195fc5
                    }
                    } else {
                    $this->messenge = "Password is not strong enough";
<<<<<<< HEAD
                    $reRender = new Router();
                    $reRender->map("/register", "GET");
                    }
               }else{
                    $this->messenge = "Password is not match";
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
                    <form action="/register" method="POST">
                         <h2>THÔNG TIN TÀI KHOẢN</h2>
                         <div class="form-group">
                              <div class="row mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Username
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control" name="username" required>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Email
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="email" class="col-sm-9 form-control" name="gmail" required>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Mật khẩu
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="password" class="col-sm-9 form-control" name="password" required>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3 ">Nhập lại mật khẩu
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="password" class="col-sm-9 form-control" name="repeatpassword" required>
                              </div>
                         </div>
                         <h2>THÔNG TIN CÁ NHÂN</h2>
                         <div class="form-group">
                              <div class="row mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Họ tên
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="text" class="col-sm-9 form-control" name="fullname" required>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3 col-12">Giới tính
                                        <span class="warning">(*)</span>
                                   </label>
                                   <select name="sex" id="sex" class="col-12 col-sm-9 form-control">
                                        <option value="male">Nam</option>
                                        <option value="female">Nữ</option>
                                   </select>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="" class="col-sm-3">Phone
                                        <span class="warning">(*)</span>
                                   </label>
                                   <input type="tel" class="col-sm-9 form-control" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Ex: 012-345-6789" required>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="country" class="col-sm-3">Tỉnh/TP
                                        <span class="warning">(*)</span>
                                   </label>
                                   <select name="country" id="country" class="col-sm-9  form-control" required>
                                        <option value="">--Chọn tỉnh thành phố--</option>
                                        <?php foreach($this->countries->message as $country): ?>
                                             <option value="<?= $country['matp'] ?>"><?= $country['name'] ?></option>
                                        <?php endforeach; ?>
                                   </select>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="district" class="col-sm-3">Quận huyện
                                        <span class="warning">(*)</span>
                                   </label>
                                   <select name="district" id="district" class="col-sm-9  form-control" required>
                                        <option value="">--Chọn quận/huyện--</option>
                                   </select>
                              </div>
                              <div class="row mt-4 mr-auto ml-auto">
                                   <label for="commune" class="col-sm-3">Xã phường
                                        <span class="warning">(*)</span>
                                   </label>
                                   <select name="commune" id="commune" class="col-sm-9  form-control" required>
                                        <option value="">--Chọn xã/phường--</option>
                                   </select>
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="col-sm-8">
                                   <button type="submit" class="btn-checkout">Đăng kí</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

=======
                    var_dump($this);
                }
            }else{
                $this->messenge = "Password is not match";
                var_dump($this);
            }
        }
    ?>
    <div>
        <form method="POST" action="/register">
            <span>Username</span>
            <input type="text" name="username"></input>
            <span>Email</span>
            <input type="text" name="email"></input>
            <span>Password</span>
            <input type="password" name="password"></input>
            <span>Confirm Password</span>
            <input type="password" name="repeatpassword"></input>
            <button type=submit>Submit</button>
        </form>
    </div>
>>>>>>> f550f99da737d92b01f324b01940acd2e0195fc5
<?php }}