<?php
namespace vms;
use vms\templates\ContainerTemplate;
use api\v1\AccountAPI;

class CartPage {
    public function __construct($params = null) {
        $this->title  = "Giỏ hàng";
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
		// Check auth
		$res = AccountAPI::checkAuthRequest();
		if(!$res->status) {
			header("Location: /");
			return;
		}

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
                    <a>Giỏ hàng</a>
               </li>
          </ul>
     </div>
     <div class="heading-lg">
          <h1>GIỎ HÀNG CỦA TUI</h1>
     </div>
     <div class="step">
          <div class="step-item active">
               <div class="step-item-icon mr-0">
                    <i class="fas fa-cart-plus"></i>
               </div>
               <span>GIỎ HÀNG</span>
               <div class="step-number">1</div>
          </div>
          <div class="liner mr-0"></div>
          <div class="step-item">
               <div class="step-item-icon">
                    <i class="fas fa-dollar-sign"></i>
               </div>
               <span>THANH TOÁN</span>
               <div class="step-number">2</div>
          </div>
          <div class="liner mr-0"></div>
          <div class="step-item">
               <div class="step-item-icon">
                    <i class="fas fa-check"></i>
               </div>
               <span>HOÀN TẤT</span>
               <div class="step-number">3</div>
          </div>
     </div>
     <div id="vm-table" class="cart-block">
		<template>
			<div v-if="message.length" class="alert alert-danger text-center" role="alert">
				{{message}}
			</div>
			<div class="cart-info table-responsive">
				<div v-if="!cartItems.length" class="alert alert-light text-center" role="alert">
					Không có sản phẩm nào trong giỏ hàng
				</div>
				<table v-if="cartItems.length" class="table product-list">
					<thead>
							<tr>
								<th>Sản phẩm</th>
								<th class="text-center">Hình ảnh</th>
								<th class="text-right">Giá</th>
								<th class="text-center">Số lượng</th>
								<th class="text-right">Thành tiền</th>
								<th></th>
							</tr>
					</thead>
					<tbody>
							<tr v-for="item in cartItems" :key="item.id">
								<td class="name">{{item.title}}</td>
								<td class="image-product">
									<img :src="item.imgPath">
								</td>
								<td class="price ng-binding text-right">{{formatPrice(item.price)}}đ</td>
								<td class="quantity">
									<div class="quantity-control" data-quantity="">
										<button @click="adjustQuantity(item, -1)" class="quantity-btn" data-quantity-minus=""><svg viewBox="0 0 409.6 409.6"><g><g><path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" /></g></g></svg></button>
										<input type="number" class="quantity-input" v-model="item.quantity"
												step="1" min="1" name="quantity">
										<button @click="adjustQuantity(item, 1)" class="quantity-btn" data-quantity-plus=""><svg viewBox="0 0 426.66667 426.66667"><path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" /></svg></button>
									</div>
								</td>
								<td class="amount text-right">
									{{formatPrice(item.quantity * item.price)}}đ
								</td>
								<td class="remove" style="cursor: pointer" @click="cartItemsRemove(item)">
									<i class="far fa-trash-alt"></i>
								</td>
							</tr>
					</tbody>
				</table>
			</div>
			<div v-if="cartItems.length" class="clearfix text-right">
				<span><b>Tổng thanh toán:</b></span>
				<span class="pay-price ng-binding">
					{{formatPrice(total)}}đ
				</span>
			</div>
			<div v-if="cartItems.length" class="button text-right mt-3">
				<a class="btn btn-default" href="/" onclick="window.history.back()">Tiếp tục mua hàng</a>
				<a v-if="state == 'off'" class="btn btn-primary" href="/checkout">Thanh toán</a>
				<button v-if="state == 'loading'" disabled class="btn btn-primary">Loading...</button>
			</div>
		</template>
     </div>
</div>
<script src="/assets/js/vue.js"></script>
<script>
var vmTable = new Vue({
  	el: '#vm-table',
  	name: "vmTable",
  	data: {
		cartItems: [],
		message: "",
		state: "off",
		delayFunc: null,
	},
	computed: {
		total: function() {
			return this.cartItems.reduce(function(pre, cur) {
				return pre + (cur.quantity * cur.price)
			}, 0);
		},
	},
	methods: {
		adjustQuantity(item, quantity) {
			// Set quantity
			item.quantity = parseInt(item.quantity) + parseInt(quantity);
			if(item.quantity < 1) item.quantity = 1;

			// Reset delay
			if(this.delayFunc) {
				clearTimeout(this.delayFunc);
			}
			this.delayFunc = setTimeout(() => {
				this.state = "loading";
				$.ajax({
					type: "POST",
					url: "/api/v1/cart/put",
					dataType: "json",
					data: {
						"product_id": item.productId,
						"product_quantity": item.quantity,
					},
				}).done(() => {}).fail(() => {}).always(() => {
					this.state = "off";
				});
			}, 500);
		},
		cartItemsRemove: function(item) {
			let index = this.cartItems.indexOf(item);
			if (index > -1) {
				this.cartItems.splice(index, 1);
			}

			this.state = "loading";
			$.ajax({
				type: "POST",
				url: "/api/v1/cart/delete",
				dataType: "json",
				data: {
					"cart_item_id": item.id,
				},
			}).done(() => {}).fail(() => {}).always(() => {
				this.state = "off";
			});
		},
		formatPrice: function(value) {
			let val = (value/1).toFixed(0)
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		},
	},
	created: function() {
		$.ajax({
			type: "GET",
			url: "/api/v1/cart",
			dataType: "json",
		}).done((data) => {
			if (data.status) {
				this.cartItems = data.message[0].cart_items;
			} else {
				this.message = data.message;
			}
		}).fail((err) => {
			this.message = "Có lỗi xảy ra";
		});
	},
});
</script>
<?php }}