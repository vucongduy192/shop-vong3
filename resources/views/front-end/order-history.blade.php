@extends('front-end.app_default')
@section('content')
	<div class="bg0 p-t-75 p-b-85" style="min-height: 500px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
					@if(sizeof($orders) == 0)
						<h3 class="mtext-101 cl2">
							Tài khoản chưa từng thực hiện mua hàng
						</h3>
					@endif
					@foreach($orders as $key => $order)
						<div class="bor10 p-lr-20 p-t-30 m-l-63 m-r-40 m-b-40 p-b-20 m-lr-0-xl p-lr-15-sm" style="border-color: blue;">
							<?php $created_at = strtotime($order->created_at); ?>
							{{App\Lib\Date::date2Text(date('d-m-Y', $created_at))}}
							<div>
								<b>Total : {{$order->total}}</b>
							</div>
							<div> 
								@if($order->status == -1)
									<h3 class="mtext-101 cl2" style="color:red">
										Đơn hàng đã hủy
									</h3>
								@elseif($order->status == 1)
									<h3 class="mtext-101 cl2" style="color:gray">
										Đơn hàng chưa hoàn thành thông tin thanh toán
										<a href="/payment/{{$order->id}}/{{$order->_token}}">Hoàn thành ngay</a>
									</h3>
								@elseif($order->status == 2)
									<h3 class="mtext-101 cl2" style="color:blue">
										Đơn hàng hoàn thành. Vui lòng chờ hệ thống xử lý
									</h3>
								@elseif($order->status == 3)
									<h3 class="mtext-101 cl2" style="color:orange">
										Đơn hàng của bạn đã được gửi đi
									</h3>
								@elseif($order->status == 4)
									<h3 class="mtext-101 cl2" style="color:green">
										Đơn hàng thành công
									</h3>
								@endif
							</div>
							<a href="/order/view/{{$order->id}}/{{$order->_token}}">See more detail</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@stop