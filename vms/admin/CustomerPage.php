<?php

namespace vms\admin;

use api\v1\AccountAPI;
use vms\templates\ContainerAdminTemplate;

class CustomerPage
{

  private $rows;

  public function __construct($param = null)
  {
    $this->rows = AccountAPI::gets();
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
        <h2>Customers</h2>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Admin</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="customer_list">
          <?php foreach ($this->rows->message as $row) : ?>
            <tr>
              <th><?= $row['id'] ?></th>
              <th><?= $row['username'] ?></th>
              <th><?= $row["admin"] ?></th>
              <th><?= $row['email'] ?></th>
              <th><button data-toggle="modal" data-target="#show_modal">show modal</button></th>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    </main>
    </div>
    </div>

    <div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="name-pd">
                <h4 class="title">Ten san pham:</h4>
                <p class="name-sp">aanh yeu em</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <script type="text/javascript" src="assets/js/admin/customers.js"></script> -->

<?php }
}
