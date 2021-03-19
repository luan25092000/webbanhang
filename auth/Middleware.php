<?php
namespace auth;

use api\v1\AccountAPI;
use models\ResponseModel;

Class Middleware {

    private $secret = "kaito";

    public static function check_router(String $url) {
        if (isset($_COOKIE["jwt"])) {
            $res = AccountAPI::checkJWT($_COOKIE["jwt"]);
            return $res;
        }
        return false;
    }
}
?>