<?php
namespace vms;
use api\v1\AccountAPI;

class LoginPage {

    public $messenge;

    public function __construct($param = null) {

        if (isset($_COOKIE["jwt"])) {
            $res = AccountAPI::checkJWT($_COOKIE["jwt"]);
            if ($res->status) {
                header("Location: /");
            }
        }
    }

    public function render() {
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