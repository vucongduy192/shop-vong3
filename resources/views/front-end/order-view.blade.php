@extends('front-end.app_default')
@section('content')
<h3 class="mtext-109 cl2 p-b-30" style="padding: 5%">
	Orders management
</h3>
<div class="card col-sm-8" style="margin-left: 10%">
	<div class="flex-w flex-t bor12 p-b-13 card-header">
		<div class="size-209 p-t-1">
			<span class="mtext-110 cl2" id="total">
				<i class="fa fa-user"></i> {{$order->name}}<br> 
				<i class="fa fa-envelope"></i> {{$order->email}}<br>
				<i class="fa fa-phone"></i> {{$order->phone}}
			</span>
		</div>
		<div class="size-208">
			@if($order->status == -1)
			<h3 class="mtext-101 cl2" style="color:red">
				Đơn hàng đã hủy
			</h3>
			@elseif($order->status == 1)
			<h3 class="mtext-101 cl2" style="color:gray">
				Đơn hàng chưa hoàn thành thông tin thanh toán
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
			<i class="fa fa-truck"></i> {{$order->address}}<br>
		</div>
	</div>
	<div class="flex-w flex-t p-t-27 p-b-33 card-body">
		<div class="size-209">
			<span class="mtext-101 cl2">
				Chi tiết đơn hàng
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
					{{$item->quantity}} x {{$item->price}} VND
				</span>
			</div>
		</div>
	@endforeach
	<div class="flex-w flex-t p-t-10 p-b-10 card-footer">
		<div class="size-209">
			<span class="mtext-101 cl2">
				Tổng tiền thanh toán:
			</span>
		</div>
		<div class="size-208 p-t-1">
			<span class="mtext-110 cl2" id="total">
				{{$order->total}} VND (+ 10% TAX)
			</span>
		</div>
	</div>
	@if($order->status < 3)
		<a href="{{route('order.delete',$order->id)}}" class="btn btn-danger" style="margin: 2%">DELETE</a>
	@elseif($order->status == 3)
		<div class="flex-w flex-t p-t-27 p-b-33 card-body">
			<div class="size-209">
				<span class="mtext-101 cl2">
					Đơn hàng đã được chuyển đi. <br>
					Vui lòng liên hệ hotline 19001000 để hủy đơn hàng
				</span>
			</div>
		</div>
	@elseif($order->status == 4)
		<div class="flex-w flex-t p-t-27 p-b-33 card-body">
			<div class="size-209">
				<span class="mtext-101 cl2">
					Đơn hàng thành công.
				</span>
			</div>
		</div>
	@endif

</div>
<br>
@stop
