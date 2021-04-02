<?php
namespace models;

class ProductModel {
    public $title;
    public $price;
    public $catId;
    public $imgPath;
    public $sex;

    public function __construct($product) {
        $this->title = $product["title"];
        $this->price = $product["price"];
        $this->catId = $product["catId"];
        $this->imgPath = "chua lam";
        $this->sex = $product["sex"];
    }
}
?>