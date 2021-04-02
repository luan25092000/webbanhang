<?php
namespace vms;
use api\v1\ArticleAPI;
use vms\templates\ContainerTemplate;

class NewDetailPage {
    public $title;
    private $article;
    private $message;

    public function __construct($params = null) {
        $this->title = "Tin tức";
        if($params) {
            $res = ArticleAPI::get($params[0]);
            if(!$res->status) {
                $this->message = $res->message;
            } else if(!count($res->message)) {
                $this->message = "Bài viết không tồn tại";
            } else {
                $this->article = $res->message[0];
                // Set title
                $this->title  = $this->article["title"];
            }
        }
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>
<div class="mb-4 mt-4">
    <?php if($this->message) { ?>
        <div class="alert alert-danger"><?= $this->message ?></div>
    <?php } if($this->article) { ?>
        <div class="col-lg-9 col-md-12">
            <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <a
                    href="/news" class="text-dark">Tin tức</a> <i class="fas fa-angle-double-right"></i> <span
                    class="introduce"><?= $this->article["title"] ?></span></small>
            <div class="new-detail-content">
                <h3 class="mt-3"><?= $this->article["title"] ?></h3><small><?= $this->article["created_at"] ?></small>
                <hr>
                <div class="new-detail-content-child">
                    <?= $this->article["content"] ?>
                </div>
                <hr>
                <iframe
                    src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fluankma&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=415196006363533"
                    width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
        </div>
    <?php } ?>
</div>
<?php }}