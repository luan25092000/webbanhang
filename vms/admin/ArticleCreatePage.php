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
