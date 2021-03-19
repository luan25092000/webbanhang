<?php
namespace models;

class AccountModel {
    public $username;
    public $password;
    public $gmail;
    public $status;

    public function __construct($account) {
        $this->username = $account["username"];
        $this->password = $account["password"];
        $this->gmail = $account["gmail"];
        $this->status = "unverified";
    }
}
?>