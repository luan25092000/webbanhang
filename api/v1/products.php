<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/webbanhang/db/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/webbanhang/libs/mysql.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/webbanhang/models/product.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/webbanhang/models/response.php");

class ProductAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product");
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
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE id=$id");
        return $res;
    }
    
    public static function getBySex(String $sex){
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE sex='$sex'");
        return $res;
    }

    public static function post(Product $product) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "INSERT INTO `product`(`title`, `price`, `quantity`, `createdAt`, `updatedAt`, `catId`, `imgPath`, `sex`, `priceOld`) 
                  VALUES ('$product->title',$product->price,$product->quantity,'$product->createdAt','$product->updatedAt',$product->catId,'$product->imgPath','$product->sex',$product->priceOld)";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        print $res;
    }
    
    public static function update(Product $product) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "UPDATE `product` SET `title`='$product->title',`price`=$product->price,`quantity`=$product->quantity,`updatedAt`= date('Y-m-d H:i:s'),`catId`=$product->catId,`imgPath`=$product->imgPath,`sex`=$product->sex,`priceOld`=$product->priceOld WHERE `id`=$product->id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        print $res;
    }
    
    public static function delete(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "DELETE FROM `product` WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        print $res;
    }

    public static function getProductByKey(String $key){
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE title LIKE '%$key%'");
        return $res;
    }
}
?>