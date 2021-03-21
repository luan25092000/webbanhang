<?php
namespace models;

class CountryModel {
    public $matp;
    public $name;
    public $type;

    public function __construct($country) {
        $this->matp = $country["matp"];
        $this->name = $country["name"];
        $this->type = $country["type"];
    }
}
?>