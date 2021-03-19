<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\ProductModel;

class CategoryAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from category");
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
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from category WHERE id=$id");
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

    public static function post(ProductModel $product) {
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
    
    public static function update(ProductModel $product) {
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
        var_dump($id);
        // $query = "DELETE FROM `product` WHERE `id`=$id";
        // $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        // print $res;
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