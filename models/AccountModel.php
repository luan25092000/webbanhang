<?php
namespace models;

class AccountModel {
    public $username;
    public $password;
    public $email;
    public $status;
    public $fullname;
    public $sex;
    public $country;
    public $district;
    public $commune;
    public $phone;

    public function __construct($account = null) {
        if($account) {
            $this->username = $account["username"];
            $this->password = $account["password"];
            $this->email = $account["email"];
            $this->status = "unverified";
            $this->fullname = $account["fullname"];
            $this->sex = $account["sex"];
            $this->country = $account["country"];
            $this->district = $account["district"];
            $this->commune = $account["commune"];
            $this->phone = $account["phone"];
        }
    }
}
?>