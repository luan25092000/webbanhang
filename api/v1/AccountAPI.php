<?php
namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\AccountModel;
use auth\JWT;
use auth\SendMail;
use models\ResponseModel;

class AccountAPI {

    public static function gets() {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM customer");
        return $res;
    }

    public static function get_by_username($username) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * FROM customer WHERE username=$username LIMIT 1");
        return $res;
    }

    public static function post(AccountModel $account) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        $password_hash = password_hash($account->password, PASSWORD_DEFAULT);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $rand_chars = rand();
        $token = base64_encode(str_shuffle($permitted_chars) . $rand_chars);
        $jwt = static::createJWT($conn->real_escape_string($account->username));
        
        // Query
        $query = sprintf("INSERT INTO `customer`(`username`, `password`, `email`, `phone`, `status`, `token`, `jwt`, `fullName`, `sex`, `city`, `district`, `commune`) VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )", 
            $conn->real_escape_string($account->username),
            $password_hash,
            $conn->real_escape_string($account->email),
            $conn->real_escape_string($account->phone),
            $account->status,
            $token,
            $jwt,
            $conn->real_escape_string($account->fullname),
            $conn->real_escape_string($account->sex),
            $conn->real_escape_string($account->country),
            $conn->real_escape_string($account->district),
            $conn->real_escape_string($account->commune)
        );

        $res = Mysqllib::mysql_post_data_from_query($conn, $query);

        if ($res->status) {
            SendMail::post($token, $conn->real_escape_string($account->username), $conn->real_escape_string($account->email));
            return new ResponseModel(true, $jwt);
        }else{
            return new ResponseModel(false);
        }
    }

    public static function login(String $username, String $password) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        $query = sprintf("SELECT password FROM customer WHERE username='%s'", $conn->real_escape_string($username));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if (password_verify($conn->real_escape_string($password), $res->message[0]["password"])) {
            return new ResponseModel(true);
        }
        return new ResponseModel(false);
    }

    public static function checkExistUsername(String $username) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        $query = sprintf("SELECT username FROM customer WHERE username='%s'", $conn->real_escape_string($username));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        if (count($res->message) === 1) {
            return new ResponseModel(false);
        }
        return new ResponseModel(true);
    }
    
    public static function createJWT(String $username) {

        $data = [
            'userName' => $username
        ];

        $jwt = JWT::encode(
            $data,
            "kaito",
            'HS512'
        );

        return $jwt;

    }

    public static function setcookieJWT(String $jwt) {

        setcookie("jwt", time() - 3600);
        setcookie("jwt", $jwt, time() + (86400 * 30), "/");

        return true;

    }



    public static function checkJWT(String $jwt) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $username = "";
        
        try {
            $user = JWT::decode($jwt, "kaito", ['HS512']);
            $username = $user->userName;
        } catch (\Throwable $th) {
            //throw $th;
            $username = "";
        }

        if ($username === "") {
            return new ResponseModel(false);
        }

        $conn = $conn_resp->message;
        $query = sprintf("SELECT username FROM customer WHERE username='%s'", $conn->real_escape_string($username));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
        
    }

    public static function checkToken(String $username) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $conn = $conn_resp->message;
        $query = sprintf("SELECT token FROM customer WHERE username='%s'", $conn->real_escape_string($username));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
        
    }


    public static function verifyEmail(String $username) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $conn = $conn_resp->message;
        $query = sprintf("UPDATE customer SET status = 'verified' WHERE username='%s'", $conn->real_escape_string($username));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
        
    }

    public static function checkAdmin(String $username) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $conn = $conn_resp->message;
        $query = sprintf("SELECT admin FROM customer WHERE username='%s'", $conn->real_escape_string($username));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
        
    }

}
?>
