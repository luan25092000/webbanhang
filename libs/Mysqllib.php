<?php
namespace libs;
use models\ResponseModel;

class Mysqllib {
    public static function mysql_get_data_from_query($conn, String $sql) {
        $result = $conn->query($sql);
        // Catch error
        if(!$result) {
            return new ResponseModel(false, "Error: " . $sql . "<br>" . mysqli_error($conn));
        }

        // Return data
        $rows = array();
        if ( $result !== false && $result->num_rows > 0) {
            // output dữ liệu trên trang
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return new ResponseModel(true, $rows);
    }
    
    public static function mysql_post_data_from_query($conn, String $sql) {
        $result = $conn->query($sql);
        // Catch error
        if(!$result) {
            return new ResponseModel(false, "Error: " . $sql . "<br>" . mysqli_error($conn));
        }
        // Return message
        return new ResponseModel(true);
    }
}
?>