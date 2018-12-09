<h1>New order success</h1>
<table>
	<tr class="table_head">
		<th class="column-1">Product</th>
		<th class="column-3">Quantity</th>
		<th class="column-4">Price</th>
		<th class="column-5">Size</th>
		<th class="column-5">Total</th>
	</tr>
	@foreach($order_items as $key => $item) 
		<tr>
			<td>
				{{ $item->getName() }}
			</td>
			<td>{{ $item->getQty() }}</td>
			<td>{{ $item->getPrice() }} đ</td>
			<td>{{ $item->getOptions() ['size']}}</td>
			<td>{{ $item->getPrice() * $item->getQty() }}</td>	
		</tr>
	@endforeach
</table>
<a href="{{URL::to('/')}}/payment/{!! $order->id !!}/{!! $order->_token !!}">Now completed payment</a> <br>
<a href="{{URL::to('/')}}/order/view/{!! $order->id !!}/{!! $order->_token !!}">See your order status here</a>	