<?php
namespace api\v1\controllers;
use api\v1\AccountAPI;
use api\v1\CheckoutAPI;

class CheckoutController {
    public function __construct() {}
    
    public function render($method, $params) {
        // Check request
        $account_id = "";
        $res = AccountAPI::checkAuthRequest();
        if(!$res->status) {
            echo (new ResponseModel(false, "Access denied"))->to_json();
            return;
        }
        $account_id = $res->message["id"];
        
        if(!count($params)) {
        } else {
            // Thêm mã promotion vào cart
            if(isset($_POST["promotion_code"]) && !strcmp($params[0], "promotion")) {
                $res = CheckoutAPI::addPromotion($account_id, $_POST["promotion_code"]);
                echo $res->to_json();
            }
        }

        
    }
}