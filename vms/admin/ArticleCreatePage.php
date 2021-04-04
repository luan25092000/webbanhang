<?php
namespace vms\admin;

use api\v1\ArticleAPI;
use models\ArticleModel;
use vms\templates\ContainerAdminTemplate;

class ArticleCreatePage {
    private $rows;
    private $message;

    public function __construct($param = null) {
        if(isset($_POST["title"]) and isset($_POST["content"])) {
            $article = new ArticleModel();
            $article->title = $_POST["title"];
            $article->content = $_POST["content"];

            $res = ArticleAPI::create($article);
            if($res->status) {
                header("Location: /admin/articles");
            } else {
                $this->message = $res->message;
            }
        }
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render()
    {
        $template = new ContainerAdminTemplate();
        $template->renderChild($this);
    }

    public function __render()
    {
        if($this->message) {
            ?>
            <div class="alert alert-danger"><?= $this->message ?></div>
            <?php
        }
?>
<form action="" method="POST">
    <div class="input-group mb-3">
    <input type="text" name="title" class="form-control" placeholder="Title*">
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    </div>
    <div class="input-group">
        <textarea class="form-control" name="content" id="editor" placeholder="Content"></textarea>
    </div>
</form>


<script src="/assets/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor', {
      height: 350
    });
</script>
<style>
    .ck-editor {
        width: 100%!important;
    }
</style>
<?php }
}
