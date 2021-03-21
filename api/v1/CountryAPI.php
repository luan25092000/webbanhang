<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;

class CountryAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from devvn_tinhthanhpho");
        return $res;
    }
}