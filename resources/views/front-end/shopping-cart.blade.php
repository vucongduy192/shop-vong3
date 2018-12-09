@extends('front-end.app_default')
@section('content')
	<style>
		.table-shopping-cart th, .table-shopping-cart td {
			text-align: center !important;
		}
		.error {
			color: red;
			font-size: 12px;
		}
	</style>
		<!-- Shoping Cart -->
	<form action="/order/store" class="bg0 p-t-75 p-b-85" method="POST" >
		@csrf
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-5 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Quantity</th>
									<th class="column-4">Price</th>
									<th class="column-5">Size</th>
									<th class="column-5">Total</th>
								</tr>
								@foreach($cartItems as $key => $item)
								<?php $product = App\Product::where('id', $item->getId())->first(); ?>
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1" data-rowid="{{$item->getRowId()}}" data-name="{{$product->name}}">
											<img src="/images/products/{{$product->img1}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$product->name}}</td>
									<td class="column-2">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" value="{{$item->getQty()}}" data-rowid="{{$item->getRowId()}}">
								
											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
										<br><span class="error err_{{$item->getRowId()}}"></span>
									</td>
									<td class="column-4">{{$item->getPrice()}} đ</td>
									<td class="column-5">
										{{$item->getOptions()['size']}}	
									</td>
									<td class="column-5 total_{{$item->getRowId()}}" data-price={{$item->getPrice()}}>{{$item->getPrice() * $item->getQty()}} đ</td>
								</tr>
								@endforeach
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" id="update_cart">
								Update Cart
							</div>
							{!! $errors->first('total', '<span class="error">:message</span>') !!}
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Checkout
						</h4>

						{!! $errors->first('name', '<span class="error">:message</span>') !!}
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Name" value="{{old('name')}}">
							<img class="how-pos4 pointer-none" src="images/icons/name.png" alt="ICON">
						</div>

						{!! $errors->first('email', '<span class="error">:message</span>') !!}
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Email" value="{{old('email')}}">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						{!! $errors->first('phone', '<span class="error">:message</span>') !!}
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="phone" placeholder="Phone" value="{{old('phone')}}">
							<img class="how-pos4 pointer-none" src="images/icons/phone.png" alt="ICON">
						</div>

						{!! $errors->first('address', '<span class="error">:message</span>') !!}
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="address" placeholder="Address" style="height: 100px;"  value="{{old('address')}}">
							<img class="how-pos4 pointer-none" src="images/icons/address.png" alt="ICON">
						</div>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2" id="subtotal">
									{{$subTotal}} đ
									<input type="hidden" name="subtotal" id="input_subtotal" value="{{$subTotal}}">
								</span>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2" id="total">
									{{$total}} đ
									<input type="hidden" name="total" id="input_total" value="{{$total}}">
								</span>
							</div>
						</div>
						<input type="hidden" name="tax" id="input_tax" value="{{$total-$subTotal}}">
						<input type="submit" id="checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" value="Proceed to Checkout">
					</div>
				</div>
			</div>
		</div>
	</form>
@stop
@section('script')
<script type="text/javascript">

	$('.how-itemcart1').click(function () {
		var name = $(this).data("name");
		var rowId = $(this).data("rowid");
		var rowHtml = $(this).parent().parent();

		$.ajax({
			url : '/cart/remove',
			data : {rowId : rowId},
			success: function (data) {
				swal(name, data.msg, "success");					
				rowHtml.remove();
				$('#subtotal').html(data.subtotal);
				$('#total').html(data.total);
				$('#total_quantity').html(data.total_quantity);	
				$('#input_subtotal').val(data.subtotal);
				$('#input_total').val(data.total);
				$('#input_fee').val(parseInt(data.total) - parseInt(data.subtotal));
			}
		});
	});

	$('#update_cart').click(function () {
		var update = [];
		$('.num-product').each(function () {
			update.push({
				rowId : $(this).data("rowid"),
				qty   : $(this).val()    
			})
		});

		$.ajax({
			url : '/cart/update',
			data : {update},
			success: function (data) {
				var status = (data.errors) ? "error" : "success";
				swal("Shopping Cart", data.msg, status);

				$('.error').css("display", "none");
				if (data.errors) {
					$.each(data.errors, function (key, value) {
						$('.err_' + key).css("display", "inline");
						$('.err_' + key).html(value);
					})
				} else {
					//console.log($('#total_quantity').data("notify"));
					$.each(data.update, function (key, item) {
						var price = $('.total_' + item.rowId).data("price");
						$('.total_' + item.rowId).html(item.qty * price);
					});
					$('#subtotal').html(data.subtotal);
					$('#input_subtotal').val(data.subtotal);
					$('#total').html(data.total);
					$('#input_total').val(data.total);
					$('#total_quantity').html(data.total_quantity);
					$('#input_fee').val(parseInt(data.total) - parseInt(data.subtotal));
				}
			}
		});
	});

</script>	
@stop