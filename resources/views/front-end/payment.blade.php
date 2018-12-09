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
		.payment {
			display: none;
		}
	</style>
		<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85" method="POST" action="/payment/{{$order->id}}/{{$order->_token}}">
		@csrf
		<input type="hidden" value="{{$order->id}}" name="order_id">
		<input type="hidden" value="{{$order->total}}" name="amount">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-lg-6 col-xl-6 m-lr-auto m-b-50">
					<div class="bor10 p-lr-20 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Payment infomation
						</h4>
						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm p-t-15">
								<span class="stext-110 cl2">
									Payment:
								</span>
							</div>

							<div class="size-209 p-r-0-sm w-full-ssm">
								<div class="">
									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="type" id="payment_type">
											<option value="{{App\Payment::DELIVERED}}" {{old('type') == 1 ? 'selected' : ''}}>Delivered</option>
											<option value="{{App\Payment::CREDIT}}" {{old('type') == 2 ? 'selected' : ''}}>Credit card</option>
											<option value="{{App\Payment::PAYPAL}}" {{old('type') == 3 ? 'selected' : ''}}>Paypal</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>	
								</div>
							</div>
							<style>.how-pos4-parent{width: 100%;}</style>
							{{-- Deliveried --}}
							{!! $errors->first('name', '<span class="error payment credit">:message</span>') !!}
							<div class="bor8 m-b-20 how-pos4-parent payment credit">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Name" value="{{old('name')}}">
								<img class="how-pos4 pointer-none" src="/images/icons/name.png" alt="ICON">
							</div>

							{!! $errors->first('card_number', '<span class="error payment credit">:message</span>') !!}
							<div class="bor8 m-b-20 how-pos4-parent payment credit">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="card_number" placeholder="Card number" value="{{old('card_number')}}">
								<img class="how-pos4 pointer-none" src="/images/icons/card-number.png" alt="ICON">
							</div>

							{!! $errors->first('cvv', '<span class="error payment credit">:message</span>') !!}
							<div class="bor8 m-b-20 how-pos4-parent payment credit">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="cvv" placeholder="Cvv" value="{{old('cvv')}}">
								<img class="how-pos4 pointer-none" src="/images/icons/cvv.png" alt="ICON">
							</div>
							{!! $errors->first('dateOfExpiry', '<span class="error payment credit">:message</span>') !!}
							<div class="bor8 m-b-20 how-pos4-parent payment credit">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="dateOfExpiry" placeholder="Date of expiry" value="{{old('dateOfExpiry')}}">
								<img class="how-pos4 pointer-none" src="/images/icons/dateExpiry.png" alt="ICON">
							</div>


							{{-- Paypal --}}
							{!! $errors->first('email', '<span class="error payment paypal">:message</span>') !!}
							<div class="bor8 m-b-20 how-pos4-parent payment paypal">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Paypal email" value="{{old('paypal_email')}}">
								<img class="how-pos4 pointer-none" src="/images/icons/paypal-email.png" alt="ICON">
							</div>

							{!! $errors->first('password', '<span class="error payment paypal">:message</span>') !!}
							<div class="bor8 m-b-20 how-pos4-parent payment payment paypal">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="Password" value="{{old('paypal_password')}}">
								<img class="how-pos4 pointer-none" src="/images/icons/password.png" alt="ICON">
							</div>

						</div>
						<input type="submit" id="checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" value="Completed your order">
					</div>
				</div>

				<div class="col-lg-10 col-xl-6 m-lr-auto m-b-50">
					<div class="bor10 p-lr-20 p-t-30 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Invoice
						</h4>
						{{-- <div class="flex-w flex-t bor12 p-b-13">
							<div class="size-209">
								<span class="stext-110 cl2">
									Date
								</span>
							</div>

							<div class="size-208">
								<span class="mtext-110 cl2" id="subtotal">
									{{date("d-m-Y", strtotime($order->created_at)) }}
								</span>
							</div>
						</div> --}}

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Bill to:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2" id="total">
									{{$order->name}}, {{$order->address}}
								</span>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-209">
								<span class="mtext-101 cl2">
									Detail
								</span>
							</div>
						</div>
						@foreach($order->items as $key => $item)
							<div class="flex-w flex-t bor12 p-b-13">
								<div class="size-209">
									<span class="stext-110 cl2">
										{{$item->product->name}}
									</span>
								</div>

								<div class="size-208">
									<span class="mtext-110 cl2" id="subtotal">
										{{$item->quantity}} x {{$item->price}} đ
									</span>
								</div>
							</div>
						@endforeach
						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-209">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-208">
								<span class="mtext-110 cl2" id="subtotal">
									{{$order->subtotal}} đ
								</span>
							</div>
						</div>


						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-209">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-208 p-t-1">
								<span class="mtext-110 cl2" id="total">
									{{$order->total}} đ
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@stop
@section('script')
	<script type="text/javascript">
		var payment_type = $('#payment_type').val();
		if (parseInt(payment_type) == 2) $('.credit').css("display", "block");
		if (parseInt(payment_type) == 3) $('.paypal').css("display", "block");

		$('#payment_type').on('change', function () {
			$('.payment').css("display", "none");
			payment_type = parseInt($(this).val());
			if (parseInt(payment_type) == 2) $('.credit').css("display", "block");
			if (parseInt(payment_type) == 3) $('.paypal').css("display", "block");
		})
	</script>
@stop