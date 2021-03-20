<?php
namespace vms\admin;
use api\v1\AccountAPI;
use vms\templates\ContainerAdminTemplate;

class CustomerPage {

	private $rows;

    public function __construct($param = null) {
		$this->rows = AccountAPI::gets();
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerAdminTemplate();
        $template->renderChild($this);
    }

    public function __render() {


        
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
            </tr>
          </thead>
          <tbody id="customer_list">
          <?php foreach ($this->rows->message as $row) : ?>
            <tr>
              <th><?= $row['id'] ?></th>
              <th><?= $row['username'] ?></th>
              <th><?= $row["admin"] ?></th>
              <th><?= $row['email'] ?></th>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- <script type="text/javascript" src="assets/js/admin/customers.js"></script> -->

<?php }}