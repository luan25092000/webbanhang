<?php
namespace api\v1\controllers;
use models\ResponseModel;

class NotFoundController {
    public function __construct() {}
    
    public function render($method, $params) {
        echo (new ResponseModel(false, "Not found 404"))->to_json();
    }
}