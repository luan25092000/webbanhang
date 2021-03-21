<?php
namespace models;

class AccountModel {
    public $username;
    public $password;
    public $gmail;
    public $status;
    public $fullname;
    public $sex;
    public $country;
    public $district;
    public $commune;
    public $phone;

    public function __construct($account) {
        $this->username = $account["username"];
        $this->password = $account["password"];
        $this->gmail = $account["gmail"];
        $this->status = "unverified";
        $this->fullname = $account["fullname"];
        $this->sex = $account["sex"];
        $this->country = $account["country"];
        $this->district = $account["district"];
        $this->commune = $account["commune"];
        $this->phone = $account["phone"];
    }
}
?>