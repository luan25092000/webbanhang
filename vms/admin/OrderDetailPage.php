<?php
namespace vms\admin;
use api\v1\ProductAPI;
use api\v1\OrderAPI;

class OrderDetailPage {

	private $products;
	private $nameProduct;
	private $showProduct = array();

    public function __construct($param = null) {
        
        $this->products = OrderAPI::getProducts($param[0]);

        foreach ($this->products->message as $keyProduct => $product) {
            
            $this->nameProduct = ProductAPI::getById($product["productId"])->message[0]["title"];
            $this->products->message[$keyProduct]["name"] = $this->nameProduct;
            
        }

        array_push($this->showProduct, $this->products->message);
        $this->products = null;

        echo json_encode($this->showProduct);
    }

    public function render() {
        
    ?>
      
<?php }}