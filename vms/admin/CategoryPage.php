<?php

namespace vms\admin;

use api\v1\CategoryAPI;
use vms\templates\ContainerAdminTemplate;
use models\CategoryModel;

class CategoryPage
{

  private $rows;

  public function __construct($param = null)
  {
    $this->rows = CategoryAPI::gets();
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
      CategoryAPI::post(new CategoryModel($_POST));
      echo("<script>location.href = '/admin/categories';</script>");
    }

    if (isset($_POST["e_submit"])) {
      CategoryAPI::update(new CategoryModel($_POST), $_POST["edit_category"]);
      echo("<script>location.href = '/admin/categories';</script>");
    }

    
    if (isset($_POST["d_submit"])) {
      CategoryAPI::delete($_POST["id"]);
      echo("<script>location.href = '/admin/categories';</script>");
    }

?>
    <div class="row">
      <div class="col-10">
        <h2>Manage Category</h2>
      </div>
      <div class="col-2">
        <a href="#" data-toggle="modal" data-target="#add_category_modal" class="btn btn-primary btn-sm">Add Category</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Action</th>
          </tr>
          <?php foreach ($this->rows->message as $row) : ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['title'] ?></td>
              <td><?= $row['slug'] ?></td>
              <td>
                <a href="#myModal" data-id=<?= $row["id"] ?> data-toggle="modal" data-target="#edit_category_modal" class="btn btn-sm btn-info">Edit</a>
                <form id="add-product-form" class="d-inline-block" method="post">
                  <input type="hidden" name="id" value=<?= $row["id"] ?>/>
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



    <!-- Modal -->
    <div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add-category-form" enctype="multipart/form-data" method="post">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Category Title">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Enter Category Slug">
                  </div>
                </div>
                <input type="hidden" name="add_category" value="1">
                <div class="col-12">
                  <input type="submit" class="btn btn-primary add-category" name="submit" value="Add Category"></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->

    <!--Edit category Modal -->
    <div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="edit-category-form" enctype="multipart/form-data" method="post">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Category Title">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Enter Category Slug">
                  </div>
                </div>
                <input type="hidden" name="edit_category" value="1">
                <div class="col-12">
                  <!-- <button type="button" class="btn btn-primary edit-category-btn">Update Category</button> -->
                  <input type="submit" class="btn btn-primary edit-category-btn" name="e_submit" value="Update Category"></button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->

    <script type="text/javascript" src="/assets/js/admin/category.js"></script>

<?php }
}
