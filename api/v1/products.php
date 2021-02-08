<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/db/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/libs/mysql.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/models/product.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/models/response.php");

class ProductAPI {
    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product");
        return $res;
    }
    
    public static function get(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from product WHERE id=".$id."");
        return $res;
    }
    
    public static function post(Product $product) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = `
            INSERT INTO product(\`title\`, \`price\`, \`quantity\`, \`createdAt\`, \`updatedAt\`)
                VALUES(\``.$product->title.`\`, \``.$product->price.`\`, \``.$product->quantity.`\`, \``.date("Y-m-d H:i:s").`\`, \``.date("Y-m-d H:i:s").`\`)
        `;
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        print $res;
    }
    
    public static function update(Product $product) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = `
            UPDATE product
                SET \`title\`=\``.$product->title.`\`, \`price\`=\``.$product->price.`\`, \`quantity\`=\``.$product->quantity.`\`, \`updatedAt\`=\``.date("Y-m-d H:i:s").`\`
                WHERE \`id\`=\``.$product->id.`\`
        `;
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        print $res;
    }
    
    public static function delete(String $id) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = `
            DELETE FROM product WHERE \`id\`=\``.$id.`\`
        `;
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        print $res;
    }
}

if(empty($_GET) && empty($_POST)) {
    print "Hello";
    die();
}

if(isset($_GET["getall"])) {
    // error_reporting(E_ERROR | E_PARSE); // Hide warning
    print ProductAPI::gets()->to_json();
    die();
}
?>