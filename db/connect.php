<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/webbanhang/models/response.php");
Class Database {
    public static function connect_db() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";
        $false_response = new Response(false, "Connection failed: ".mysqli_connect_error());
    
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