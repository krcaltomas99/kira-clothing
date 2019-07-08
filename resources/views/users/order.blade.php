@extends("layouts.app")

@section("title", "Manage orders")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						@include("inc.usermenu")
					</div>
					<div class="rightmenu p-4">
						<div class="orders">
							<h3 class="mb-3">Manage your orders</h3>
							@forelse($user->orders_desc as $order)
								<div class="order mb-3">
									<div class="header border-bottom py-3 px-4 bg-light d-flex justify-content-between mb-2">
										<div class="info">
											<h4 class="mb-0">Order #{{$order->id}}
												<small class=""> - {{ $order->products->count() }} products
													for {{ $order->total }}$
												</small>
												- <small>@if($order->finished) <span class="text-success">on the way</span> @else <span class="text-danger">in progress</span>@endif</small>
											</h4>
										</div>
										<div class="timestamps">
											<p class="mb-0">
												{{ $order->created_at->format("d.m.Y") }} {{ $order->created_at->format("H:i:s") }}</p>
										</div>
									</div>

									<div class="body py-3 px-4">
										@foreach($order->products as $product)
											<div class="product">
												<a href="{{ route("showProduct", ["id"=>$product->product->id, "slug"=>$product->product->slug]) }}">
													<img class="float-left mr-2" width="50"
													     src="{{ $product->product->getCoverImgUltraMin() }}"
													     alt="product image">
												</a>
												<div class="price float-left mb-3 py-2">
													<h6 class="mb-1 merriweather">{{ $product->product->name }}</h6>
													<p class="mb-0">{{ $product->qty }} {{ ($product->qty === 1) ? "piece" : "pieces" }}
														for {{ $product->product->presentPriceWithQtyWithTax($product->qty) }}</p>
												</div>
											</div>
											<div class="clearfix"></div>
										@endforeach
									</div>
									<div class="footer p-3 border-top bg-light">
										<ul class="mb-0 list-center pl-0">
											<li class="mr-2"><a
														href="{{ route("orders.invoice", $order->id) }}">invoice</a>
											</li>
											<li>
												{{ Form::open(["url"=>route("orders.delete", $order->id), "method"=>"delete"]) }}
												{{ Form::submit("cancel order", ["class"=>"btn-clean clickable text-danger text-underline", "role"=>"submit"]) }}
												{{ Form::close() }}
											</li>
										</ul>
									</div>
								</div>
							@empty
								<p class="text-left">No orders yet</p>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection