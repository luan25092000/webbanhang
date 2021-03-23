<?php
namespace api\v1\controllers;

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
        
        if($method == "GET") {
            if(count($params)) {
                // Checkout cart
                if($params[0] == "done") {

                }
            }
        }
    }
}