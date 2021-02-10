<?php
// Template.php
namespace vms;

class Template {
    // Khai báo child và hàm render child view-model
    private $child;
    public function renderChild($child) {
        $this->child = $child;
        $this->render();
    }

    public function __construct($params = null) {}

    public function render() {
?>

Start template<br>

<?php $this->child->__render(); ?>

<br>End template

<?php }}