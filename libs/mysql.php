<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/libs/string.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/models/response.php");

function mysql_get_data_from_query($conn, String $sql) {
    $result = $conn->query($sql);
    // Catch error
    if(!$result) {
        return new Response(false, mysql_error());
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

function mysql_post_data_from_query($conn, String $sql) {
    $result = $conn->query($sql);
    // Catch error
    if(!$result) {
        return new Response(false, mysql_error());
    }
    // Return message
    return new Response(true);
}
?>