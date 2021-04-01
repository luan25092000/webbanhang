<?php
// Child.php
namespace vms;
use vms\ExampleTemplatePage;

class ExampleChildPage {
    public function __construct($params = null) {}

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ExampleTemplatePage();
        $template->renderChild($this);
    }

    public function __render() {
?>

Child content

<?php }}