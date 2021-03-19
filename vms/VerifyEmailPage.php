<?php
namespace vms;
use api\v1\AccountAPI;
use vms\templates\ContainerTemplate;
use libs\Common;
use route\Router;
use models\AccountModel;
use auth\JWT;

class VerifyEmailPage {

    public $token;

    public function __construct($params = null) {
        $this->token = $params[0];
    }

    public function render() {
        if (isset($_COOKIE["jwt"])) {
            $res = AccountAPI::checkJWT($_COOKIE["jwt"]);
            if ($res->status) {
                $username = $res->message[0]["username"];
                $res = AccountAPI::checkToken($username);
                $token_real = $res->message[0]["token"];

                if ($this->token === $token_real) {
                    $res = AccountAPI::verifyEmail($username);
                }
            }
        }
    ?>
        
<?php }}