<?php
namespace models;

class PromotionModel {
    
    public $title ;
    public $code;
    public $price;
    public $quantity;

    public function __construct($order) {
        $this->title = $order["title"];
        $this->code = $order["code"];
        $this->price = $order["price"];
        $this->quantity = $order["quantity"];
    }
}
?>