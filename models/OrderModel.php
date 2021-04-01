<?php
namespace models;

class OrderModel {
    
    public $customerId ;
    public $name;
    public $phone;
    public $email;
    public $promotionId;
    public $shipping;
    public $total;
    public $status;

    public function __construct($order) {
        $this->customerId = $order["customerId"];
        $this->name = $order["name"];
        $this->phone = $order["phone"];
        $this->email = $order["email"];
        $this->promotionId = $order["promotionId"];
        $this->shipping = 15000;
        $this->total = $order["total"];
        $this->status = $order["status"];
    }
}
?>