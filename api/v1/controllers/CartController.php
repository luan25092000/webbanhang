<?php
namespace api\v1\controllers;
use api\v1\CartAPI;
use api\v1\AccountAPI;
use models\ResponseModel;

class CartController {
    public function __construct() {}

    public function render($method, $params) {
        $account_id = "";

        // Check cookie
        if (!isset($_COOKIE["jwt"])) {
            echo (new ResponseModel(false, "Access denied"))->to_json();
            return;
        }
        // Check JWT
        $res = AccountAPI::checkJWT($_COOKIE["jwt"]);
        if(!$res->status) {
            echo (new ResponseModel(false, "Access denied"))->to_json();
            return;
        }
        // Check username
        if(!count($res->message)) { // If hasn't username
            echo (new ResponseModel(false, "Access denied"))->to_json();
            return;
        }
        $username = $res->message[0]["username"];
        $res = AccountAPI::checkExistUsername($username);
        if($res->status) { // Chỗ này hơi ngược do thằng Kaito viết
            echo (new ResponseModel(false, "Access denied"))->to_json();
            return;
        }
        // Get account id
        $res = AccountAPI::get_by_username($username);
        if(!$res->status || !count($res->message)) {
            echo (new ResponseModel(false, "Access denied"))->to_json();
            return;
        }
        $account_id = $res->message[0]["id"];


        if($method === "GET") {
            $res = CartAPI::read($account_id);
            echo($res->to_json());
            return;
        }

        // Thêm vào
        if($method === "POST") {
            $product_id = $_POST["product_id"];
            $product_quantity = $_POST["product_quantity"];
            $res = CartAPI::create($account_id, $product_id, $product_quantity);
            echo($res->to_json());
            return;
        }

        // Cập nhật số lượng
        if($method === "PUT") {
            $product_id = $_POST["product_id"];
            $product_quantity = $_POST["product_quantity"];
            $res = CartAPI::update($account_id, $product_id, $product_quantity);
            echo($res->to_json());
            return;
        }

        // Bỏ bớt
        if($method === "DELETE") {
            $product_id = $_POST["product_id"];
            $product_quantity = $_POST["product_quantity"];
            $res = CartAPI::delete($account_id, $product_id, $product_quantity);
            echo($res->to_json());
            return;
        }
    }
}