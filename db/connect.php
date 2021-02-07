<?php
function connect_db() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        if(!$conn) {
            die(`{"message": "Lỗi kết nối đến cơ sở dữ liệu"}`);
        }
    }
    return $conn;
}
?>