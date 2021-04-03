<?php
namespace vms;

class LogoutPage {

    public function __construct($param = null) {
        setcookie("jwt", time() - 3600);
        header("Location: /");
    }

    public function render() {
        
    ?>
      
<?php }}