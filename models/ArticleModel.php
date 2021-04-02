<?php
namespace models;
class ArticleModel {
    public $id;
    public $title;
    public $content;
    public function __construct($id = null, $title = null, $content = null) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }
}