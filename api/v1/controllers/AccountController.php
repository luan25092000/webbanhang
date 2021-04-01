<?php
namespace api\v1\controllers;
use models\AccountModel;
use models\ResponseModel;
use api\v1\AccountAPI;

class AccountController {
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


        // Update thông tin account
        if(strpos($params[0], "put/") === 0 && $method == "POST") {
            // Get and check account id
            $id = substr($params[0], strlen("put/"));
            if(strcmp($account_id, $id)) {
                echo (new ResponseModel(false, "Access denied"))->to_json();
                return;
            }

            // Get info
            $account = new AccountModel();
            $account->email = $_POST["email"];
            $account->phone = $_POST["phone"];
            $account->fullName = $_POST["fullName"];
            $account->city = $_POST["city"];
            $account->district = $_POST["district"];
            $account->commune = $_POST["commune"];

            // Check null
            if(
                !strlen($account->email)
                || !strlen($account->phone)
                || !strlen($account->fullName)
                || !strlen($account->city)
                || !strlen($account->district)
                || !strlen($account->commune)
            ) {
                echo (new ResponseModel(false, "Vui lòng nhập hết các trường bắt buộc"))->to_json();
                return;
            }

            // Update info
            $res = AccountAPI::update($account_id, $account);
            echo $res->to_json();
        }
    }
}