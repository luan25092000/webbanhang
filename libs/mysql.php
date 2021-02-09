<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/webbanhang/models/response.php");

class Mysqllib {
    public static function mysql_get_data_from_query($conn, String $sql) {
        $result = $conn->query($sql);
        // Catch error
        if(!$result) {
            return new Response(false, "Error: " . $sql . "<br>" . mysqli_error($conn));
        }
        // Return data
        $rows = array();
        if ($result->num_rows > 0) {
            // output dữ liệu trên trang
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return new Response(true, $rows);
    }
    
    public static function mysql_post_data_from_query($conn, String $sql) {
        $result = $conn->query($sql);
        // Catch error
        if(!$result) {
            return new Response(false, "Error: " . $sql . "<br>" . mysqli_error($conn));
        }
        // Return message
        return new Response(true);
    }
}
?>