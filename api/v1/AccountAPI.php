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

    public static function createToken(){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $rand_chars = rand();
        $token = base64_encode(str_shuffle($permitted_chars) . $rand_chars);
        return $token;
    }

    public static function post(AccountModel $account) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        $password_hash = password_hash($account->password, PASSWORD_DEFAULT);

        $jwt = static::createJWT($conn->real_escape_string($account->username));
        $token = static::createToken();
        
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
        if($res->status) {
            if(count($res->message)) {
                if (password_verify($conn->real_escape_string($password), $res->message[0]["password"])) {
                    return new ResponseModel(true);
                }
            }
        }
        return new ResponseModel(false);
    }

    public static function updateToken($email){
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $conn = $conn_resp->message;

        $token = static::createToken();

        $query = sprintf("UPDATE customer SET token = '%s' WHERE email='%s'", $token, $conn->real_escape_string($email));
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        if ($res->status) {
            return new ResponseModel(true, $token);
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

        if ($username == "") {
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

    public static function checkTokenReset(String $email) {

        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $conn = $conn_resp->message;
        $query = sprintf("SELECT token, username FROM customer WHERE email='%s' AND status='verified'", $conn->real_escape_string($email));
        $res = Mysqllib::mysql_get_data_from_query($conn, $query);
        return $res;
        
    }

    public static function changePass(String $username, String $password)
    {
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $conn = $conn_resp->message;
        $query = sprintf("UPDATE customer SET password = '%s' WHERE username='%s'", $password_hash, $conn->real_escape_string($username));
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
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
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
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

    // Check login return account
    public static function checkAuthRequest() {
        $false_response = new ResponseModel(false, "Access denied");

        // Check cookie
        if (!isset($_COOKIE["jwt"])) {
            return $false_response;
        }
        // Check JWT
        $res = AccountAPI::checkJWT($_COOKIE["jwt"]);
        if(!$res->status) {
            return $false_response;
        }
        // Check username
        if(!count($res->message)) { // If hasn't username
            return $false_response;
        }
        $username = $res->message[0]["username"];
        $res = AccountAPI::checkExistUsername($username);
        if($res->status) { // Chỗ này hơi ngược do thằng Kaito viết
            return $false_response;
        }
        // Get account
        $res = AccountAPI::get_by_username($username);
        if(!$res->status || !count($res->message)) {
            return $false_response;
        }
        return new ResponseModel(true, $res->message[0]);
    }

    public static function update(String $id, AccountModel $account) {
        // Connect db
        $conn_resp = Database::connect_db();
        if(!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;

        $query = "UPDATE `customer` SET email='{$account->email}', phone='{$account->phone}',
            fullName='{$account->fullName}', city='{$account->city}', district='{$account->district}',
            commune='{$account->commune}' WHERE id=$id";
        $res2 = Mysqllib::mysql_post_data_from_query($conn, $query);
        if(!$res2->status) {
            $res2->message = "Error";
        }
        return $res2;
    }
}
?>
