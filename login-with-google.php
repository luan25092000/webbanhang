<?php

spl_autoload_register(function ($class_name) {
    $filename = __DIR__ . '/' . $class_name . '.php';
    $filename = str_replace('\\', '/', $filename);
    if (file_exists($filename)) {
        include_once $filename;
    }
});


require_once 'libs/google/vendor/autoload.php';

use models\AccountModel;
use api\v1\AccountAPI;

define('GOOGLE_APP_ID', '164347036653-ktgchofs0isrkp6fdpombkirmvdhvsmk.apps.googleusercontent.com');
define('GOOGLE_APP_SECRET', '4hdG_4fsSuxbNb9MLRZqMoc-');
define('GOOGLE_APP_CALLBACK_URL', 'https://store.kaito.ninja/login-with-google.php');

$client = new Google_Client();
$client->setClientId(GOOGLE_APP_ID);
$client->setClientSecret(GOOGLE_APP_SECRET);
$client->setRedirectUri(GOOGLE_APP_CALLBACK_URL);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    // print_r($token);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    $AccountModel = new AccountModel();
    $AccountModel->username = $name;
    $AccountModel->password = time();
    $AccountModel->email = $email;
    $AccountModel->status = "unverified";
    $AccountModel->fullname = $name;
    $AccountModel->sex = "";
    $AccountModel->country = "";
    $AccountModel->district = "";
    $AccountModel->commune = "";
    $AccountModel->phone = "";
    $user = new AccountAPI();
    $jwt = $user->postGoogle($AccountModel);
    
    if($jwt->status){
        $user->setcookieJWT($jwt->message);
    }
    header("Location: /");
}