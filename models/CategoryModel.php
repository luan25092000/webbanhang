<?php
namespace models;

class CategoryModel {
    
    public $title;
    public $slug;

    public function __construct($product) {
        $this->title = $product["title"];
        $this->slug = $product["slug"];
    }
}
?>