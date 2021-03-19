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
      PHPUpload::upload($_FILES);
      ProductAPI::post(new ProductModel($_POST), $_FILES["fileToUpload"]["name"]);
    }

    if (isset($_POST["e_submit"])) {

      if ($_FILES["fileToUpload"]['name'] !== "") {
        PHPUpload::upload($_FILES);
      }

      ProductAPI::update($_POST["edit_product"], new ProductModel($_POST), $_FILES["fileToUpload"]["name"]);
    }

    if (isset($_POST["d_submit"])) {
      ProductAPI::delete($_POST["id"]);
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
            <th>Quantity</th>
            <th>Category</th>
            <th>sex</th>
            <th>Action</th>
          </tr>
          <?php foreach ($this->rows->message as $row) : ?>
            <tr class="product-item">
              <th><?= $row['id'] ?></th>
              <th><?= $row['title'] ?></th>
              <th>
                <img class="img-product" src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>">
              </th>
              <th><?= number_format($row['price'], 0, '', ',') ?>₫</th>
              <th><?= $row['quantity'] ?></th>
              <th><?= CategoryAPI::getById($row['catId'])->message[0]["title"] ?></th>
              <th><?= $row['sex'] ?></th>
              <td>
                <a href="#myModal" data-id=<?= $row["id"] ?> data-toggle="modal" data-target="#edit_product_modal" class="btn btn-sm btn-info">Edit</a>
                <form id="add-product-form" method="post">
                  <input type="hidden" name="id" value=<?= $row["id"] ?> />
                  <input type="submit" name="d_submit" class="btn btn-sm btn-danger" value="Delete"></input>
                </form>
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
                    <label>Product Qty</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Enter Product Quantity">
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
                    <label>Product Qty</label>
                    <input type="number" name="quantity" class="form-control">
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
                  <input type="submit" class="btn btn-primary submit-edit-product" name="e_submit" value="Edit Product"></input>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="/assets/js/admin/product.js"></script>

<?php }
}
