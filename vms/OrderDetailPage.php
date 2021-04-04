<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\AccountAPI;
use api\v1\CheckoutAPI;

class OrderDetailPage {
	private $account;
	private $message;
	private $order;
	private $promotion = 0;

    public function __construct($params = null) {
        $this->title  = "Đơn hàng: " . $params[0];

		// Check auth
		$res = AccountAPI::checkAuthRequest();
		if(!$res->status) {
			header("Location: /login");
			return;
		}
		$this->account = $res->message;

		// If admin then go
		if($this->account["admin"]) {
			$res = CheckoutAPI::readByCode($params[0]);
			if(!$res->status) {
				$this->message = $res->message;
				return;
			}
			if(!count($res->message)) {
				$this->message = "Không tìm thấy đơn hàng";
				return;
			}
			$this->order = $res->message[0];
			// Get promotion
			if($this->order["promotionId"]) {
				$res = CheckoutAPI::getPromotion($this->order["promotionId"]);
				if($res->status) {
					$this->promotion = $res->message[0]["price"];
				}
			}
		} else {
			// Check order is owned by account
			$res = CheckoutAPI::checkOwned($this->account["id"], $params[0]);
			if(!$res->status) {
				$this->message = $res->message;
			} else {
				$this->order = $res->message[0];
			}

			// Get order
			if($this->order) {
				$this->order = CheckoutAPI::read($this->order["id"])->message[0];
				// Get promotion
				if($this->order["promotionId"]) {
					$res = CheckoutAPI::getPromotion($this->order["promotionId"]);
					if($res->status) {
						$this->promotion = $res->message[0]["price"];
					}
				}
			}
		}
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>

<div class="container mb-5">
     <div class="heading-link mt-3">
          <ul class="item">
               <li class="home">
                    <a href="/">Trang chủ</a>
               </li>
               <li class="icon active">
                    <a>Chi tiết đơn hàng</a>
               </li>
          </ul>
     </div>
	 <?php if($this->order) { ?>
		<div class="heading-lg">
			<h1>ĐƠN HÀNG: <?= $this->order["code"] ?> <?= $this->order["status"] ? "" : "(Chưa thanh toán) "?></h1>
		</div>
		<div id="vm-table" class="cart-block">
			<div class="cart-info table-responsive">
				<table v-if="cartItems.length" class="table product-list">
					<thead>
							<tr>
								<th>Sản phẩm</th>
								<th class="text-center">Hình ảnh</th>
								<th class="text-right">Giá</th>
								<th class="text-right">Số lượng</th>
								<th class="text-right">Thành tiền</th>
							</tr>
					</thead>
					<tbody>
						<?php foreach($this->order["items"] as $item) { ?>
						<tr v-for="item in cartItems" :key="item.id">
							<td class="name"><?= $item["title"] ?></td>
							<td class="image-product">
								<img src="<?= $item["imgPath"] ?>">
							</td>
							<td class="price ng-binding text-right"><?= number_format($item["price"]) ?>đ</td>
							<td class="quantity text-right">
								<?= number_format($item["quantity"]) ?> cái
							</td>
							<td class="amount text-right">
								<?= number_format($item["price"] * $item["quantity"]) ?>đ
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<table class="table table-borderless float-right mt-3" style="width: auto">
				<tbody>
					<tr>
						<td><b>Tạm tính:</b></td>
						<td class="text-right"><?= number_format($this->order["total"]) ?>đ</td>
					</tr>
					<tr>
						<td><b>Phí giao hàng:</b></td>
						<td class="text-right"><?= number_format($this->order["shipping"]) ?>đ</td>
					</tr>
					<tr>
						<td><b>Giảm giá:</b></td>
						<td class="text-right"><?= number_format($this->promotion) ?>đ</td>
					</tr>
					<tr>
						<td colspan="2"><hr></td>
					</tr>
					<tr>
						<td class="text-danger"><b>Tổng thanh toán:</b></td>
						<td class="text-danger text-right"><?= number_format($this->order["total"] + $this->order["shipping"] - $this->promotion) ?>đ</td>
					</tr>
				</tbody>
			</table>
			<div style="clear:both"></div>
		</div>
	<?php } else { ?>
		<div v-if="message.length" class="alert alert-danger text-center" role="alert">
			<?= $this->message ?>
		</div>
	<?php } ?>
</div>
<?php }}