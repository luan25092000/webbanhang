<?php
namespace db;
use models\ResponseModel;

class Database {
    public static function connect_db() {
        $servername = array_key_exists("USER", $_ENV) ? "mysql" : "localhost";
        $username = "root";
        $password = array_key_exists("USER", $_ENV) ? "kaito" : "";
        $dbname = "shop";
        $false_response = new ResponseModel(false, "Connection failed: ". mysqli_connect_error());
    
        try {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
        }
        catch(Exception $e) {
            return $false_response;
        }
        if (!$conn) {
            return $false_response;
        }
    
        return new ResponseModel(true, $conn);
    }
}
?>