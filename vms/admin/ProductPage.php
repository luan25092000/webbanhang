<?php

namespace vms\admin;

use api\v1\ProductAPI;
use api\v1\CategoryAPI;
use vms\templates\ContainerAdminTemplate;
use libs\PHPUpload;
use models\ProductModel;

class ProductPage
{

    public $title;
    private $rows;
    private $categories;

    public function __construct($param = null)
    {
        $this->rows = ProductAPI::gets();
        $this->categories = CategoryAPI::gets();
        $this->test = CategoryAPI::getById(2);
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
                case 'Add Product':
                    PHPUpload::upload($_FILES);
                    ProductAPI::post(new ProductModel($_POST), $_FILES["fileToUpload"]["name"]);
                    echo ("<script>location.href = '/admin/products';</script>");
                    break;

                case 'Edit Product':

                    if ($_FILES["fileToUpload"]['name'] !== "") {
                        PHPUpload::upload($_FILES);
                    }

                    ProductAPI::update($_POST["edit_product"], new ProductModel($_POST), $_FILES["fileToUpload"]["name"]);
                    echo ("<script>location.href = '/admin/products';</script>");
                    break;

                case 'Delete Product':
                    ProductAPI::delete($_POST["id"]);
                    break;

                default:
                    echo ("<script>location.href = '/admin/products';</script>");
                    break;
            }
        }

?>

        <div class="row">
            <div class="col-10">
                <h2>Product List</h2>
            </div>
            <div class="col-2">
                <a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Add Product</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Sex</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($this->rows->message as $row) : ?>
                        <tr class="product-item-admin" id="product-<?= $row["id"] ?>">
                            <td style="font-size:0.9rem;font-weight:400"><?= $row['id'] ?></td>
                            <td style="font-size:0.9rem;font-weight:400"><?= $row['title'] ?></td>
                            <td>
                                <img class="img-product" src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>">
                            </td>
                            <td style="font-size:0.9rem;font-weight:400"><?= number_format($row['price'], 0, '', ',') ?>₫</td>
                            <td style="font-size:0.9rem;font-weight:400">
                                <?= CategoryAPI::getById($row['catId'])->message[0]["title"] ?></td>
                            <td style="font-size:0.9rem;font-weight:400"><?= $row['sex'] ?></td>
                            <td>
                                <a style="width:40%" href="#myModal" data-id=<?= $row["id"] ?> data-toggle="modal" data-target="#edit_product_modal" class="btn btn-sm btn-info">Edit</a>
                                <button data-id="<?= $row["id"] ?>" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </thead>
            </table>
        </div>
        </main>
        </div>
        </div>



        <!-- Add Product Modal start -->
        <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-product-form" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Product Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select class="form-control category_list" name="catId">
                                            <?php foreach ($this->categories->message as $category) : ?>
                                                <option value=<?= $category["id"] ?>><?= $category["title"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Sex</label>
                                        <select class="form-control sex_list" name="sex">
                                            <option value="Nam">Nam</option>
                                            <option value="Nũ">Nữ</option>
                                            <option value="Unisex">Unisex</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Product Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="Enter Product Price">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Product Image <small>(format: jpg, jpeg, png)</small></label>
                                        <input type="file" name="fileToUpload" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="add_product" value="1">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-primary add-product" value="Add Product" name="submit"></input>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Product Modal end -->

        <!-- Edit Product Modal start -->
        <div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-product-form" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select class="form-control category_list" name="catId">
                                            <?php foreach ($this->categories->message as $category) : ?>
                                                <option value=<?= $category["id"] ?>><?= $category["title"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Sex</label>
                                        <select class="form-control sex_list" name="sex">
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                            <option value="Unisex">Unisex</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Product Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="Enter Product Price">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Product Image <small>(format: jpg, jpeg, png)</small></label>
                                        <div name="imagePath"></div>
                                        <input type="file" name="fileToUpload" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="edit_product">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-primary submit-edit-product" name="submit" value="Edit Product"></input>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="/assets/js/admin/product.js"></script>
        <style>
            .product-item-admin td {
                vertical-align: middle;
            }
        </style>
<?php }
}
