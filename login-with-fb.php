<?php

spl_autoload_register(function ($class_name) {
    $filename = __DIR__ . '/' . $class_name . '.php';
    $filename = str_replace('\\', '/', $filename);
    if (file_exists($filename)) {
        include_once $filename;
    }
});


require_once 'libs/Facebook/autoload.php';

use models\AccountModel;
use api\v1\AccountAPI;

session_start();

$facebook = new \Facebook\Facebook([
    'app_id'      => '446677652971923',
    'app_secret'     => '416d971878b86f4a248f37be7f658fb9',
    'default_graph_version'  => 'v2.10'
]);


$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();


if (isset($_GET['code'])) {

    $access_token = $facebook_helper->getAccessToken();

    $facebook->setDefaultAccessToken($access_token);

    $graph_response = $facebook->get("/me?fields=name,email", $access_token);

    $facebook_user_info = $graph_response->getGraphUser();

    $email = "";

    if (!empty($facebook_user_info['name'])) {
        $name = $facebook_user_info['name'];
    }

    if (!empty($facebook_user_info['email'])) {
        $email = $facebook_user_info['email'];
    }

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

    if ($jwt->status) {
        // $user->setcookieJWT($jwt->message);
        echo("<script>document.cookie = 'jwt = ". $jwt->message ."'</script>");
    }
    // header("Location: /");
    echo("<script>location.href = '/';</script>");
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('https://store.kaito.ninja/login-with-fb.php', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
    echo $facebook_login_url;
}
