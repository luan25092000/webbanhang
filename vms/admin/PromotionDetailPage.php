<?php
namespace vms\admin;
use api\v1\PromotionAPI;

class PromotionDetailPage {

    public $pageId;
    public $row;

    public function __construct($param = null) {
        $this->pageId = $param[0];
        $this->row = PromotionAPI::getById($this->pageId);
        echo json_encode($this->row);
    }

    public function render() {
        
    ?>
      
<?php }}