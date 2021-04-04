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
		if(isset($_POST["pay_id"])) {
			OrderAPI::pay($_POST["pay_id"]);
		}
		if(isset($_POST["unpay_id"])) {
			OrderAPI::unpay($_POST["unpay_id"]);
		}

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
			<table class="table">
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
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="customer_order_list">
					<?php foreach ($this->rows->message as $row) : ?>
						<tr>
							<td><?= $row['id'] ?></td>
							<td><?= AccountAPI::get_by_id($row["customerId"])->message[0]["username"] ?></td>
							<td><a href="/order-detail/<?= $row["code"] ?>" style="white-space: nowrap;"><?= $row["code"] ?></a></td>
							<td><?= $row["promotionId"] ? PromotionAPI::getById($row["promotionId"])->message[0]["title"] : ""; ?></td>
							<td><?= number_format($row['shipping'], 0, '', ',') ?>₫</td>
							<td><?= number_format($row['total'], 0, '', ',') ?>₫</td>
							<td><?= $row['status'] == 0 ? "Processing" : "Delivered"; ?></td>
							<td><?= $row['created_at'] ?></td>
							<td>
								<?php if(!$row["status"]) { ?>
									<button class="btn btn-success" onclick="pay(<?= $row["id"] ?>)">Thanh toán</button>
								<?php } else { ?>
									<button style="white-space: nowrap;" class="btn btn-danger" onclick="unpay(<?= $row["id"] ?>)">Hủy thanh toán</button>
								<?php } ?>
							</td>
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

<style>
#customer_order_list td {
	vertical-align: middle;
}
</style>
<script>
function pay(id) {
	let res = confirm("Xác nhận thanh toán hóa đơn?");
	if(res) {
		var newForm = $('<form>', {
			'action': '/admin/orders',
			'method': 'POST'
		}).append($('<input>', {
			'name': 'pay_id',
			'value': id,
			'type': 'hidden'
		})).appendTo('body').submit();
	}
}

function unpay(id) {
	let res = confirm("Xác nhận hủy thanh toán hóa đơn?");
	if(res) {
		var newForm = $('<form>', {
			'action': '/admin/orders',
			'method': 'POST'
		}).append($('<input>', {
			'name': 'unpay_id',
			'value': id,
			'type': 'hidden'
		})).appendTo('body').submit();
	}
}
</script>
<?php }
}
