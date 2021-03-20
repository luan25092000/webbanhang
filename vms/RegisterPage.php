<?php
namespace vms;
use api\v1\AccountAPI;
use route\Router;
use models\AccountModel;

class RegisterPage {

    public $messenge;

    public function __construct($param = null) {
    }

    public function render() {
        if (isset($_POST["password"])) {
            if ($_POST["password"] === $_POST["repeatpassword"]) {
                $password = $_POST["password"];
                $username = $_POST["username"];
                $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
                if(!preg_match($pattern, $password)){
                    $checkExist = AccountAPI::checkExistUsername($username);
                    if ($checkExist->status) {
                        $account = new AccountModel($_POST);
                        $result = AccountAPI::post($account);
                        
                        if ($result->status) {
                            AccountAPI::createJWT($username);
                            $reRender = new Router();
                            $reRender->map("/", "GET");
                        }
                        
                    }else{
                        $this->messenge = $username . ' is already in use';
                    }
                } else {
                    $this->messenge = "Password is not strong enough";
                    $reRender = new Router();
                    $reRender->map("/register", "GET");
                }
            }else{
                $this->messenge = "Password is not match";
            }
        }
    ?>
    <div>
        <form method="POST" action="/register">
            <span>Username</span>
            <input type="text" name="username"></input>
            <span>Gmail</span>
            <input type="text" name="gmail"></input>
            <span>Password</span>
            <input type="password" name="password"></input>
            <span>Confirm Password</span>
            <input type="password" name="repeatpassword"></input>
            <button type=submit>Submit</button>
        </form>
    </div>
<?php }}