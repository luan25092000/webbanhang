<?php
    $dsn = "mysql:host=mysql;dbname=shop";
    $username = "root";
    $password = "kaito";

    try {
        $connection = new PDO($dsn,  $username, $password);
    } catch (PDOException $err) {
        die($err);
    }

?>