<?php
namespace vms\admin;
use api\v1\AccountAPI;
use api\v1\OrderAPI;

class CustomerDetailPage {

    public $username;
    public $userId;
    public $row;

    public function __construct($param = null) {
        $this->username = $param[0];
        $this->userId = AccountAPI::get_by_username($this->username)->message[0]["id"];
        $this->row = OrderAPI::getProductsbyCustomer($this->userId);
        echo json_encode($this->row);
    }

    public function render() {
        
    ?>
      
<?php }}