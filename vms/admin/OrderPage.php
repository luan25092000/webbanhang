<?php

namespace vms\admin;

use api\v1\PromotionAPI;
use api\v1\AccountAPI;
use api\v1\OrderAPI;
use vms\templates\ContainerAdminTemplate;

class OrderPage
{

	public $title;
	public $customer;
	public $rows;
	public $products;

	public function __construct($param = null)
	{
		$this->rows = OrderAPI::gets();
		if (count($this->rows->message)) {
			// $this->customer = AccountAPI::get_by_id($this->rows->message[0]["customerId"]);
			$this->products = OrderAPI::getProducts($this->rows->message[0]["id"]);
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

?>
		<div class="row">
			<div class="col-10">
				<h2>Orders</h2>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Customer</th>
						<th>Code</th>
						<th>Promotion</th>
						<th>Shipping</th>
						<th>Total</th>
						<th>Status</th>
						<th>Create at</th>
					</tr>
				</thead>
				<tbody id="customer_order_list">
					<?php foreach ($this->rows->message as $row) : ?>
						<tr>
							<th><?= $row['id'] ?></th>
							<th><?= AccountAPI::get_by_id($row["customerId"])->message[0]["username"] ?></th>
							<th><?= $row["code"] ?></th>
							<th><?= PromotionAPI::getById($row["promotionId"])->message[0]["title"] ?></th>
							<th><?= number_format($row['shipping'], 0, '', ',') ?>₫</th>
							<th><?= number_format($row['total'], 0, '', ',') ?>₫</th>
							<th><?= $row['status'] == 0 ? "Processing" : "Delivery"; ?></th>
							<th><?= $row['created_at'] ?></th>
							<th><button data-id="<?= $row["id"] ?>" data-toggle="modal" class="btn btn-success" data-target="#show_modal">Hiển thị</button></th>
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
						<h5 class="modal-title" id="exampleModalLabel">Sản phẩm</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-cus table-borderless">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Price</th>
									<th scope="col">Quantity</th>
								</tr>
							</thead>
							<tbody id="bodyShow">
								
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->

		<script type="text/javascript" src="/assets/js/admin/order.js"></script>


<?php }
}
