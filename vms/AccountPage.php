<?php

namespace vms;

use api\v1\AccountAPI;

class AccountPage
{

    public $username = "";

    public function __construct($params = null)
    {
        if (isset($_COOKIE["jwt"])) {
            $this->username = AccountAPI::checkJWT($_COOKIE["jwt"])->message;
        }
    }

    public function render()
    {
        echo $this->username;
?>
    
<?php }
}
