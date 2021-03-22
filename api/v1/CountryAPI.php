<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\ResponseModel;

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

    public static function getAddress(String $city, $district, $commune) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Query
        $resCity = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from devvn_tinhthanhpho WHERE matp=$city");
        $resDistrict = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from devvn_quanhuyen WHERE maqh=$district");
        $resCommune = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from devvn_xaphuongthitran WHERE xaid=$commune");
        if(!$resCity->status || !$resDistrict->status || !$resCommune->status) {
            return new ResponseModel(false, "Address 404");
        }
        $address = "{$resCommune->message[0]["name"]}, {$resDistrict->message[0]["name"]}, {$resCity->message[0]["name"]}";
        return new ResponseModel(true, $address);
    }
}