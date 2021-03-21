<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\ResponseModel;

class CartAPI {
    public static function read(String $account_id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get cart of customer
        $query = "SELECT * from cart WHERE customerId=$account_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        // If doesn't exist cart of customer
        // Then recreate a new one
        if(!count($res->message)) {
            $res = Mysqllib::mysql_post_data_from_query($conn, "INSERT INTO `cart`(`customerId`) 
                VALUES ($account_id)");
            if($res->status) {
                $res = Mysqllib::mysql_get_data_from_query($conn, $query);
            }
        }
        return $res;
    }

    public static function create(String $account_id, String $product_id, String $quantity) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get the cart of customer
        $query = "SELECT * from cart WHERE customerId=$account_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the cart doesn't exists
            return new ResponseModel(false, "Not found the cart");
        }
        $cart = $res->message[0];

        // Get the product info
        $query = "SELECT * from product WHERE id=$product_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the product doesn't exists
            return new ResponseModel(false, "Not found the product");
        }
        $product = $res->message[0];

        // Get the item in the cart
        $query = "SELECT * from cart_item WHERE cartId={$cart["id"]} AND productId=$product_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the item doesn't exist in the cart, then add it
            $query = "INSERT INTO cart_item(`productId`, `cartId`, `price`, `quantity`) 
                VALUES({$product["id"]}, {$cart["id"]}, {$product["price"]}, {$product["quantity"]})";
            $res = Mysqllib::mysql_post_data_from_query($conn, $query);
            if(!$res->status) {
                $res->message = "Error while adding the product";
            }
            return $res;
        } else { // Increase the quantity
            $cart_item = $res->message[0];
            $new_quantity = $cart_item->quantity + $quantity;
            $query = "UPDATE cart_item SET quantity=$new_quantity
                WHERE id={$cart_item["id"]}";
            $res = Mysqllib::mysql_post_data_from_query($conn, $query);
            if(!$res->status) {
                $res->message = "Error while adding the product";
            }
            return $res;
        }
    }

    public static function update(String $account_id, String $product_id, String $quantity) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get the cart of customer
        $query = "SELECT * from cart WHERE customerId=$account_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the cart doesn't exists
            return new ResponseModel(false, "Not found the cart");
        }
        $cart = $res->message[0];

        // Get the product info
        $query = "SELECT * from product WHERE id=$product_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the product doesn't exists
            return new ResponseModel(false, "Not found the product");
        }
        $product = $res->message[0];

        // Get the item in the cart
        $query = "SELECT * from cart_item WHERE cartId={$cart["id"]} AND productId=$product_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the item doesn't exist in the cart, then add it
            $query = "INSERT INTO cart_item(`productId`, `cartId`, `price`, `quantity`) 
                VALUES({$product["id"]}, {$cart["id"]}, {$product["price"]}, {$product["quantity"]})";
            $res = Mysqllib::mysql_post_data_from_query($conn, $query);
            if(!$res->status) {
                $res->message = "Error while adding the product";
            }
            return $res;
        } else { // Increase the quantity
            $cart_item = $res->message[0];
            $query = "UPDATE cart_item SET quantity=$quantity
                WHERE id={$cart_item["id"]}";
            $res = Mysqllib::mysql_post_data_from_query($conn, $query);
            if(!$res->status) {
                $res->message = "Error while adding the product";
            }
            return $res;
        }
    }

    public static function delete(String $account_id, String $product_id, String $quantity) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get the cart of customer
        $query = "SELECT * from cart WHERE customerId=$account_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the cart doesn't exists
            return new ResponseModel(false, "Not found the cart");
        }
        $cart = $res->message[0];

        // Get the product info
        $query = "SELECT * from product WHERE id=$product_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) { // If the product doesn't exists
            return new ResponseModel(false, "Not found the product");
        }
        $product = $res->message[0];

        // Get the item in the cart
        $query = "SELECT * from cart_item WHERE cartId={$cart["id"]} AND productId=$product_id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(count($res->message)) { // Remove the item from the cart
            $cart_item = $res->message[0];
            $query = "DELETE FROM cart_item WHERE id={$cart_item["id"]}";
            $res = Mysqllib::mysql_post_data_from_query($conn, $query);
            if(!$res->status) {
                $res->message = "Error while removing the product";
            }
            return $res;
        }
    }
}
?>