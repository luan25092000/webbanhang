<?php
namespace models;

class ProductModel {
    // public $id;
    public $title;
    public $price;
    public $quantity;
    // public $createdAt;
    // public $updatedAt;
    public $catId;
    public $imgPath;
    public $sex;
    // public $priceOld;

    public function __construct($product) {
        $this->title = $product["title"];
        $this->price = $product["price"];
        $this->quantity = $product["quantity"];
        $this->catId = $product["catId"];
        $this->imgPath = "chua lam";
        $this->sex = $product["sex"];
    }
}
?>