<?php
namespace vms;
use api\v1\AccountAPI;
use vms\templates\ContainerTemplate;
use libs\Common;
use route\Router;

class LoginPage {

    public $messenge;

    public function __construct($param = null) {
    }

    public function render() {
        $redirect = new Router();
        if (isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if(AccountAPI::login($username, $password)){
                AccountAPI::createJWT($username);
                $redirect->map("/", "GET");
            } else {
                $this->messenge = "Username/Password is invalid";
                $redirect->map("/login", "GET");
            }
        }
    ?>
    <div>
        <form method="POST" action="/login">
            <span>Username</span>
            <input type="text" name="username"></input>
            <span>Password</span>
            <input type="password" name="password"></input>
            <button type=submit>Submit</button>
        </form>
    </div>
<?php }}