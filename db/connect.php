<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/models/response.php");
Class Database {
    public static function connect_db() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";
        $false_response = new Response(false, "Lỗi kết nối đến cơ sở dữ liệu");
    
        try {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
        }
        catch(Exception $e) {
            return $false_response;
        }
        if (!$conn) {
            return $false_response;
        }
    
        return new Response(true, $conn);
    }
}
?>