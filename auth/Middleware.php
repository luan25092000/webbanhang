<?php
namespace auth;

use api\v1\AccountAPI;
use models\ResponseModel;

Class Middleware {

    public static function check_router(String $url) {
        if (isset($_COOKIE["jwt"])) {
            $res = AccountAPI::checkJWT($_COOKIE["jwt"]);
            if ($res->status) {
                if (count($res->message)) {
                    return $res;
                }
            }
            return new ResponseModel(false);
        }
        return new ResponseModel(false);
    }
}
?>