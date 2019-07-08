@component("mail::message")
	<div class="message">
		Thank you for the order! Thank you for trusting in us. We are really happy to see that. The number
		of
		your order is #{{ $order->id }}.
		You will see your goods in 2-3 days. If there are any issues, just contact us!
		<h4>Order recap:</h4>
		<div class="panel-list">
			@foreach($order->products as $product)
				<div class="product" style="margin-bottom: 10px;">
					<img align="left" src="{{ $product->product->getCoverImgUltraMin() }}"
					     alt="product-image">
					<div>
						<a href="{{ route("showProduct", ["id"=> $product->product->id, "slug"=>$product->product->slug]) }}">
							{{ $product->qty }} x {{ $product->product->name }}
						</a>
						<p>{{ $product->product->getSizeNameBySizeId($product->size) }}</p>
						<span>{{ $product->product->presentPriceWithQtyWithTax($product->qty) }}</span>
					</div>
				</div>
				<div style="clear:both;"></div>
			@endforeach
			total: $<strong>{{ $order->total }}</strong>
		</div>
	</div>
@endcomponent