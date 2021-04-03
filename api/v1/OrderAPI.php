<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use api\v1\ProductAPI;
use api\v1\PromotionAPI;
use models\CategoryModel;
use models\ResponseModel;

class OrderAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM `order`");
        
        return $res;
    }
    
    public static function getById(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from order WHERE id=$id");
        return $res;
    }

    public static function getProducts(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from order_item WHERE orderId=$id");
        return $res;
    }

    public static function getProductsbyCustomer(String $customerid) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from `order` WHERE customerId=$customerid");
        $result = array();
        
        if ($res->status) {
            foreach ($res->message as $key => $value) {

                $id = $value["id"];
                $res2 = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from order_item WHERE orderId=$id");
                if ($res2->status) {
                    foreach ($res2->message as $keyProduct => $valueProduct) {

                        $nameProduct = ProductAPI::getById($valueProduct["productId"])->message[0]["title"];
                        $promotionOrder = PromotionAPI::getById($value["promotionId"])->message[0]["price"];

                        $res2->message[$keyProduct]["name"] = $nameProduct;
                        $res2->message[$keyProduct]["code"] = $value["code"];
                        $res2->message[$keyProduct]["total"] = $value["total"];
                        $res2->message[$keyProduct]["promotion"] = $promotionOrder;
                        
                    }
                    array_push($result, $res2->message);
                }
                
                $res2 = null;
            }
            return $result;
        }
        return new ResponseModel(false);
    }

    public static function post(CategoryModel $category) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "INSERT INTO `order`(`customerId`, `name`, `phone`, `email`, `promotionId`, `shipping`, `total`, `status`) 
                  VALUES ('$category->title','$category->slug','$category->content')";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }
    
    public static function delete(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "DELETE FROM `order` WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

    public static function pay(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "UPDATE `order` SET `status`=1 WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }
}
?>