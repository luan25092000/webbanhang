<?php
namespace vms\admin;

use api\v1\ArticleAPI;
use vms\templates\ContainerAdminTemplate;

class ArticleEditPage {
    private $rows;
    private $message;

    public function __construct($param = null) {
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

        if (isset($_POST["submit"])) {

            switch ($_POST["submit"]) {
                case 'Add Category':
                    CategoryAPI::post(new CategoryModel($_POST));
                    echo ("<script>location.href = '/admin/categories';</script>");
                    break;

                case 'Edit Category':
                    CategoryAPI::update(new CategoryModel($_POST), $_POST["edit_category"]);
                    echo ("<script>location.href = '/admin/categories';</script>");
                    break;

                case 'Delete Category':
                    CategoryAPI::delete($_POST["id"]);
                    break;

                default:
                    // echo ("<script>location.href = '/admin/categories';</script>");
                    break;
            }
        }

?>
        <div class="row">
            <div class="col-10">
                <h2>Manage Articles</h2>
            </div>
            <div class="col-2">
                <a href="#" data-toggle="modal" data-target="#add_category_modal" class="btn btn-primary btn-sm">Add article</a>
            </div>
        </div>

        <?php if($this->message != NULL) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $message ?>
            </div>
        <?php } else { ?>
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
                                <td><?= $row['title'] ?></td>
                                <td>
                                    <a href="#myModal" data-id=<?= $row["id"] ?> data-toggle="modal" data-target="#edit_category_modal" class="btn btn-sm btn-info">Edit</a>
                                    <button data-id="<?= $row["id"] ?>" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </thead>
                </table>
            </div>
        <?php } ?>
        <script type="text/javascript" src="/assets/js/admin/category.js"></script>

<?php }
}
