<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\PromotionModel;

class PromotionAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from promotion");
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
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from promotion WHERE id=$id");
        return $res;
    }

    public static function post(PromotionModel $promotion) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "INSERT INTO `promotion`(`title`, `code`, `price`, `quantity`) 
                  VALUES ('$promotion->title','$promotion->code',$promotion->price,$promotion->quantity)";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }
    
    public static function update(PromotionModel $promotion, $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "UPDATE `promotion` SET `title`='$promotion->title',`code`='$promotion->code',`price`=$promotion->price,`quantity`=$promotion->quantity WHERE `id`=$id";
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
        $query = "DELETE FROM `promotion` WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

}
?>