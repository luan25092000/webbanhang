<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\CategoryModel;

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

    public static function post(CategoryModel $category) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "INSERT INTO `category`(`title`, `slug`) 
                  VALUES ('$category->title','$category->slug')";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }
    
    public static function update(CategoryModel $category, $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "UPDATE `category` SET `title`='$category->title',`slug`='$category->slug' WHERE `id`=$id";
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
        $query = "DELETE FROM `category` WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }
}
