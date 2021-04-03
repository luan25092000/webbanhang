<?php

namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\ProductModel;

class ProductAPI
{
    public static function gets()
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product");
        return $res;
    }

    public static function getById(String $id)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE id=$id");
        return $res;
    }

    public static function getBySex(String $sex)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE sex='$sex'");
        return $res;
    }

    public static function post(ProductModel $product, String $imgPath)
    {

        $path = "/assets/img/product/" . $imgPath;
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "INSERT INTO `product`(`title`, `price`, `catId`, `imgPath`, `sex`) 
                  VALUES ('$product->title',$product->price,$product->catId,'$path','$product->sex')";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

    public static function update($id, ProductModel $product, String $imgPath = "")
    {

        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "UPDATE `product` SET `title`='$product->title',`price`=$product->price,`catId`=$product->catId,`sex`='$product->sex' WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);

        if ($res->status && $imgPath !== "") {
            $path = "/assets/img/product/" . $imgPath;
            $query = "UPDATE `product` SET `imgPath`='$path' WHERE `id`=$id";
            $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        }
        return $res;
    }

    public static function delete(String $id)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "DELETE FROM `product` WHERE `id`=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

    public static function getProductByKey(String $key)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE title LIKE '%$key%'");
        return $res;
    }

    public static function getByCategory(String $category)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE catId = ( SELECT id FROM category WHERE title LIKE '%$category%' )");
        return $res;
    }

    public static function filter(String $type, String $key = null)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query

        $query = null;
        switch ($type) {
            case 1:
                $query = "SELECT * from product WHERE price > 0 " . ($key ? " AND title LIKE '%$key%' " : "") . " ORDER BY price DESC";
                break;

            case 2:
                $query = "SELECT * from product WHERE price > 0 " . ($key ? " AND title LIKE '%$key%' " : "") . " ORDER BY price ASC";
                break;

            case 3:
                $query = "SELECT * from product WHERE price > 0 " . ($key ? " AND title LIKE '%$key%' " : "") . " ORDER BY title ASC";
                break;

            case 4:
                $query = "SELECT * from product WHERE price > 0 " . ($key ? " AND title LIKE '%$key%' " : "") . " ORDER BY title DESC";
                break;

            default:
                $query = "SELECT * from product " . ($key ? ` WHERE title LIKE '%$key%' ` : ``);
                break;
        }

        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
    }
}
