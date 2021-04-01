<?php
namespace api\v1;

use db\Database;
use libs\Mysqllib;
use api\v1\CartAPI;
use models\ResponseModel;

class CheckoutAPI {
    public static function done($account_id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        $err_response = new ResponseModel(false, "Error");
        // Get cart
        $res = CartAPI::read($account_id);
        if(!$res->status) {
            return $err_response;
        } if(!count($res->message)) {
            return $err_response;
        }
        $cart = $res->message[0];

        // Check cart item quantity
        if(!count($cart["cart_items"])) {
            return new ResponseModel(false, "Không có sản phẩm để thanh toán");
        }

        // Calculate total money
        $total = 0;
        foreach($cart["cart_items"] as $item) {
            $total += $item["quantity"] * $item["price"];
        }

        // Create lading code
        $lading_code = (string)$account_id . "-" . date_timestamp_get(date_create());

        // Create order
        $res = Mysqllib::mysql_post_data_from_query($conn,
            "INSERT INTO `order`(`customerId`, `code`, `promotionId`, `shipping`, `total`) VALUES ($account_id, '$lading_code', '{$cart["promotionId"]}', '{$cart["shipping"]}', $total)");
        if(!$res->status) {
            return $err_response;
        }

        // Get order id
        $order_id = $conn->insert_id;

        // Move cart items to the order
        $query = "INSERT INTO `order_item`(`productId`, `orderId`, `quantity`, `price`) VALUES ";
        foreach($cart["cart_items"] as $item) {
            $query = $query . "({$item["productId"]}, $order_id, {$item["quantity"]}, {$item["price"]}), ";
        }
        $query = substr($query, 0, -2); // Remove the last colon and space
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        if(!$res->status) {
            echo $order_id;
            return $err_response;
        }

        // Remove cart items after creating the order
        $query = "DELETE FROM `cart_item` WHERE cartId={$cart['id']}";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        if(!$res->status) {
            return $err_response;
        }

        return new ResponseModel(true, $order_id);
    }

    public static function reads($account_id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get order record
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `order` WHERE customerId=$account_id");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) {
            return new ResponseModel(false, "Error");
        }

        return $res;
    }

    public static function read($order_id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get order record
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `order` WHERE id=$order_id LIMIT 1");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) {
            return new ResponseModel(false, "Error");
        }
        
        // Get order items
        $res->message[0]["items"] = [];
        $res2 = Mysqllib::mysql_get_data_from_query($conn, "SELECT order_item.*, product.title, product.imgPath FROM `order_item` INNER JOIN `product` ON order_item.productId=product.id AND order_item.orderId=$order_id");
        if(!$res2->status) {
            return new ResponseModel(false, "Error");
        }
        if(count($res2->message)) {
            $res->message[0]["items"] = $res2->message;
        }

        return $res;
    }

    public static function checkOwned($account_id, $order_code) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get order record
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `order` WHERE code='$order_code' AND customerId=$account_id LIMIT 1");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) {
            return new ResponseModel(false, "Không tìm thấy đơn hàng trong tài khoản của bạn");
        }

        return $res;
    }

    public static function getPromotion($promotion_id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get promotion record
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `promotion` WHERE id=$promotion_id LIMIT 1");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) {
            return new ResponseModel(false, "Error");
        }

        return $res;
    }

    public static function addPromotion($account_id, $promotion_code) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get cart
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `cart` WHERE customerId=$account_id LIMIT 1");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) {
            return new ResponseModel(false, "Không tìm thấy giỏ hàng");
        }
        $cart = $res->message[0];

        // Get and check promotion
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `promotion` WHERE code='$promotion_code' LIMIT 1");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }
        if(!count($res->message)) {
            return new ResponseModel(false, "Mã khuyến mãi không tồn tại");
        }
        $promotion = $res->message[0];

        // Add promotion to cart
        $res = Mysqllib::mysql_post_data_from_query($conn, "UPDATE `cart` SET promotionId={$promotion["id"]}");
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }

        // Decrease promotion quantity, don't care
        try {
            $new_quantity = (int)$promotion["quantity"]-1;
            $res = Mysqllib::mysql_post_data_from_query($conn, "UPDATE `promotion` SET quantity=$new_quantity WHERE id={$promotion["id"]}");
        }
        catch(Exception $e) {}

        return $res;
    }
}
?>