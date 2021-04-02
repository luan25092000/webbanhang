<?php
namespace api\v1\controllers;
use api\v1\CartAPI;
use api\v1\AccountAPI;
use models\ResponseModel;

class CartController {
    public function __construct() {}

    public function render($method, $params) {
        // Check request
        $account_id = "";
        $res = AccountAPI::checkAuthRequest();
        if(!$res->status) {
            echo (new ResponseModel(false, "Bạn chưa đăng nhập"))->to_json();
            return;
        }
        $account_id = $res->message["id"];

        // Nếu có params
        if(count($params)) {
            // Xóa item
            if($params[0] == "delete" && $method === "POST") {
                $cart_item_id = $_POST["cart_item_id"];
                $res = CartAPI::delete($account_id, $cart_item_id);
                echo($res->to_json());
                return;
            }
            // Cập nhật số lượng
            if($params[0] == "put" && $method === "POST") {
                $product_id = $_POST["product_id"];
                $product_quantity = $_POST["product_quantity"];
                $res = CartAPI::update($account_id, $product_id, $product_quantity);
                echo($res->to_json());
                return;
            }
        } else { // Không có params
            // Thêm vào
            if($method === "POST") {
                $product_id = $_POST["product_id"];
                $product_quantity = $_POST["product_quantity"];
                $res = CartAPI::create($account_id, $product_id, $product_quantity);
                echo($res->to_json());
                return;
            }
            // Lấy thông tin
            if($method === "GET") {
                $res = CartAPI::read($account_id);
                echo($res->to_json());
                return;
            }
        }
    }
}