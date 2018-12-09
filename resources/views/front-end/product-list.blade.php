@foreach($products as $key => $item)
	<div class="col-sm-6 col-md-4 col-lg-2 isotope-item">
		<div class="block2">
			<div class="block2-pic hov-img0">
				<img src="/images/products/{{$item->img1}}" alt="" style="height: 300px;">
				<a href="/product-detail/{{$item['id']}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
					Quick View
				</a>
			</div>

			<div class="block2-txt flex-w flex-t p-t-14">
				<div class="block2-txt-child1 flex-col-l ">
					<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
						{{$item['name']}}
					</a>

					<span class="stext-105 cl3">
						{{$item['price']}} VNĐ
					</span>
				</div>
			</div>
		</div>	
	</div>
@endforeach
