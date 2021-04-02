<?php
namespace api\v1;
use libs\Mysqllib;
use db\Database;
use models\ArticleModel;
use models\ResponseModel;

class ArticleAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        $query = "SELECT * from article";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }

        return $res;
    }

    public static function get(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        $query = "SELECT * from article WHERE id=$id LIMIT 1";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
    }

    public static function create(ArticleModel $article) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        $query = "INSERT INTO article (title, content) VALUES ('{$article->title}', '{$article->content}')";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

    public static function update(ArticleModel $article) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        $query = "UPDATE article SET title='{$article->title}', content='{$article->content}' WHERE id=$article->id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

    public static function delete($id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        $query = "DELETE FROM article WHERE id=$id";
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }
}