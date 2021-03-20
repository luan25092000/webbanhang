<?php
namespace models;

class AccountModel {
    public $username;
    public $password;
    public $email;
    public $status;

    public function __construct($account) {
        $this->username = $account["username"];
        $this->password = $account["password"];
        $this->email = $account["email"];
        $this->status = "unverified";
    }
}
?>