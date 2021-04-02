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
                        <?= $this->article["content"] ?>
                    </textarea>
                </div>
            </form>
            <?php
        }
?>
<script src="/assets/ckeditor5/ckeditor.js"></script>
<script>
	var ceditor = ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            ckfinder: {
                options: {
                    height: 500,
                    width: "100%"
                }
		    },
            width: "100%",
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

    ceditor.Width = "100%";
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }

    .ck-editor {
        width: 100%!important;
    }
</style>
<?php }
}
