<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\ArticleAPI;

class NewPage {
    public $title;
    private $rows;
    private $message;

    public function __construct($params = null) {
        // Set title
        $this->title  = "Tin tức";
        $res = ArticleAPI::gets();
        if(!$res->status) {
            $this->message = $res->message;
        } else {
            $this->rows = $res->message;
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
<div class="row mb-4 mt-4">
    <div class="col-lg-9 col-md-12">
        <small><a href="/" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span
                class="introduce">Tin tức</span></small>
        <div class="heading-lg mt-3 mb-3">
          <h1>TIN TỨC</h1>
        </div>
        <?php if($this->message) { ?>
            <div class="alert alert-danger"><?= $this->message ?></div>
        <?php } ?>
        <?php if($this->rows) { ?>
            <div class="news-content">
                <div classs="news-block">
                    <?php foreach($this->rows as $row) { ?>
                    <div class="news-item">
                        <div class="row">
                            <div class="col-lg-12 title-news">
                                <h4><a href="/news-detail/<?= $row["id"] ?>"><?= $row["title"] ?></a></h4>
                                <small><?= $row["created_at"] ?></small>
                                <p class="text-justify"><?= strip_tags(html_entity_decode(htmlspecialchars_decode(substr($row["content"], 0, 500)))) ?>...</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php }}