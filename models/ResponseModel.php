<?php
namespace models;

class ResponseModel {
    public $status;
    public $message;

    public function __construct($status, $message = "") {
        $this->status = $status;
        $this->message = $message;
    }

    public function to_json() {
        return json_encode(get_object_vars($this));
    }
}
?>