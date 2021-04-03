<?php
namespace vms\admin;

use api\v1\ArticleAPI;
use vms\templates\ContainerAdminTemplate;

class ArticlePage
{
    private $rows;
    private $message;

    public function __construct($param = null) {
        if(isset($_POST["delete_id"])) {
            $res = ArticleAPI::delete($_POST["delete_id"]);
            if(!$res->status) {
                $this->message = $res->message;
            }
        }

        $res = ArticleAPI::gets();
        if(!$res->status) {
            $this->message = $res->message;
        }
        $this->rows = $res->message;
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render()
    {
        $template = new ContainerAdminTemplate();
        $template->renderChild($this);
    }

    public function __render()
    {
?>
        <div class="row">
            <div class="col-10">
                <h2>Manage Articles</h2>
            </div>
            <div class="col-2">
                <a href="/admin/articles/create" class="btn btn-sm btn-primary">Add article</a>
            </div>
        </div>

        <?php if($this->message) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->message ?>
            </div>
        <?php } if($this->rows) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($this->rows as $row) : ?>
                            <tr id="category-<?= $row["id"] ?>">
                                <td><?= $row['id'] ?></td>
                                <td><a><?= $row['title'] ?></a></td>
                                <td>
                                    <a href="/admin/articles/update/<?= $row["id"] ?>" class="btn btn-sm btn-info">Edit</a>
                                    <button onclick="deleteArticle(<?= $row['id'] ?>)" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </thead>
                </table>
            </div>
            <script>
                function deleteArticle(id) {
                    let res = confirm("Chắc chắn xóa bài viết?");
                    if(res) {
                        var newForm = $('<form>', {
                            'action': '/admin/articles',
                            'method': 'POST'
                        }).append($('<input>', {
                            'name': 'delete_id',
                            'value': id,
                            'type': 'hidden'
                        })).appendTo('body').submit();
                    }
                }
            </script>
        <?php } ?>
<?php }
}
