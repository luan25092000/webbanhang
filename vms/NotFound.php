<?php
namespace vms;

class NotFound {
    public function __construct() {
        $this->view();
    }

    public function view() {
?>

404 - Not found

<?php
    }
}