<?php
namespace models;

class CategoryModel {
    
    public $title;
    public $slug;
    public $content;

    public function __construct($product) {
        $this->title = $product["title"];
        $this->slug = $product["slug"];
    }
}
?>