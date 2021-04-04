<?php
spl_autoload_register(function ($class_name) {
    $filename = __DIR__ . '/' . $class_name . '.php';
    $filename = str_replace('\\', '/', $filename);
    if (file_exists($filename)) {
        include_once $filename;
    }
});

use db\Database;
use libs\Mysqllib;

// Connect db
$conn_resp = Database::connect_db();
if(!$conn_resp->status) {
    return $conn_resp;
}
$conn = $conn_resp->message;
$query = file_get_contents(".docker/mysql/shop.sql");
// Query
$res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM customer");
if($res->status) {
    header("Location: /");
} else {
    echo $res->message;
}