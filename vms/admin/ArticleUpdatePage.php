<?php
namespace vms\admin;

use api\v1\ArticleAPI;
use models\ArticleModel;
use vms\templates\ContainerAdminTemplate;

class ArticleUpdatePage {
    private $article;
    private $message;

    public function __construct($param = null) {
        if($param) {
            $res = ArticleAPI::get($param[0]);
            if($res->status) {
                $this->article = $res->message[0];
            } else {
                $this->message = $res->message;
            }
        }

        if(isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["content"])) {
            $article = new ArticleModel($_POST["id"], $_POST["title"], $_POST["content"]);

            $res = ArticleAPI::update($article);
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
        if($this->article) {
            ?>
            <form action="" method="POST" class="mt-3">
                <input type="hidden" name="id" value="<?= $this->article["id"] ?>">
                <div class="input-group mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Title*" value="<?= $this->article["title"] ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="content" id="editor" placeholder="Content">
                        <?= html_entity_decode(htmlspecialchars_decode($this->article["content"])) ?>
                    </textarea>
                </div>
            </form>
            <?php
        }
?>
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
