<?php
namespace api\v1;
use libs\Mysqllib;
use db\Database;
use models\ArticleModel;

class ArticleAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Get cart of customer
        $query = "SELECT * from article";
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if(!$res->status) {
            return new ResponseModel(false, "Error");
        }

        return $res;
    }
}