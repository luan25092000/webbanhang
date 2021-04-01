<?php
namespace vms\admin;
use api\v1\CategoryAPI;

class CategoryDetailPage {

    public $pageId;
    public $row;

    public function __construct($param = null) {
        $this->pageId = $param[0];
        $this->row = CategoryAPI::getById($this->pageId);
        echo json_encode($this->row);
    }

    public function render() {
        
    ?>
      
<?php }}