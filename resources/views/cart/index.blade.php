@extends("layouts.app")

@section("title", "Cart")

@section("content")
	<div class="container cart-container">
		@if(Cart::count() > 0)
			<div class="row">
				<div class="col-12 col-md-10 col-xl-7 mb-2 mb-sm-0 mb-3">
					<div class="products-summary">
						<h3 class="mb-4">
							<i class="fas fa-shopping-basket"></i>
							<span class="cart-count">
								{{ Cart::content()->count() }}
							</span> item(s) in your
							Cart.
						</h3>
						<p>Product prices include taxes.</p>
						<div style="padding: 5px;" class="product-cart">
							<div class="row">
								<div class="col-md-6 col-5">
									Name
								</div>
								<div class="col-3">
									Quantity
								</div>
								<div class="col-4 col-md-3">
									Price
								</div>
							</div>
						</div>
						@foreach(Cart::content() as $item)
							<div data-rowId="{{ $item->rowId }}" class="product-cart border-bottom">
								<div class="row">
									<div class="col-5 col-md-6">
										<div class="wrap">
											<div class="row">
												<div class="col-12 col-md-4">
													<a class="d-sm-block" href="{{ route("showProduct", $item->id) }}">
														<img align="left" src="{{ $item->model->getCoverImgUltraMin() }}"
														     alt="Product image"
														     class="mr-3">
													</a>
													<div class="remove-button">
														{{ Form::open(["url"=>route("cart.destroy", $item->rowId), "method"=>"delete", "class"=>"delete-form"]) }}
														{{ Form::button("<i class='far fa-times-circle mr-2'></i>", ["class"=>"nobutton cart-options float-right", "type"=>"submit"]) }}
														{{ Form::close() }}
													</div>
												</div>
												<div class="col-12 col-md-8">
													<div class="product-cart-product pl-2 pt-1 pl-md-0">
														<a class="product-cart-name padded-y mt-2 merriweather"
														   href="{{ route("showProduct", $item->id) }}">{{ $item->name }}
														</a>
														<span class="d-block product-size">{{ $item->model->section->name }}</span>
														<div class="dropdown size-changer">
															<button data-toggle="dropdown" aria-haspopup="true"
															        aria-expanded="false" type="button"
															        id="size-dropdown"
															        class="nobutton btn dropdown-toggle p-0">{{ $item->model->getSizeNameBySizeId($item->options->size) }}</button>
															<div class="dropdown-menu" aria-labelledby="size-dropdown">
																@foreach($item->model->quantities as $qty)
																	<a {{ $qty->qty > 0 ? "" : "disabled" }} data-sizeId="{{ $qty->size->id }}"
																	   href="{{ route("cart.changesize") }}"
																	   class="dropdown-item {{ $qty->qty > 0 ? "" : "disabled" }}">
																		{{ $qty->size->name }}
																	</a>
																@endforeach
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>

									<div class="col-3 d-flex align-items-center d-flex">
										<div class="padded-y d-flex align-items-center">
											<span class="float-left item-qty">{{ $item->qty }}</span>
											<div class="quantity-changers float-left ml-2">
												<button data-qty="up" class="d-block nobutton"><i
															class="fas fa-plus"></i></button>
												<button data-qty="down" class="d-block nobutton"><i
															class="fas fa-minus"></i></button>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>

									<div class="col-4 col-md-3 d-flex align-items-center">
										<div class="padded-y col-12 d-flex align-items-center justify-content-between">
											<p class="d-block mb-0"><span
														class="item-price">{{ $item->model->presentPriceWithQtyWithTax($item->qty) }}</span>
											</p>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 col-xl-7 mb-sm-0 mb-3">
					<div class="order-summary">
						<div class="row">
							<div class="col-8 col-md-10">
								<p class="text-right">Subtotal:</p>
								<p class="text-right">Tax (21%):</p>
								<p class="text-right">Shipping: </p>
								<div class="divider mb-2"></div>
								<p class="text-right font-weight-bold mb-0">Total:</p>
							</div>
							<div class="col-md-2 col-4">
								<p class="text-right cart-subtotal">${{ Cart::subtotal() }}</p>
								<p class="text-right cart-tax">${{ Cart::tax() }}</p>
								<p class="text-right">Free</p>
								<div class="divider mb-2"></div>
								<p class="text-right mb-0 font-weight-bold cart-total">${{ Cart::total() }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 col-xl-7 mt-4">
					<a class="float-right" href="{{ route("checkout.index") }}">
						<button class="btn btn-primary btn-wave">
							Checkout
						</button>
					</a>

					<a class="float-right mr-2" href="{{ route("homesections.show",$section->slug) }}">
						<button class="btn btn-light btn-wave">
							Continue shopping
						</button>
					</a>
				</div>
			</div>
		@else
			<div class="row">
				<div class="col-12">
					<h3 class="text-center">No items in cart :(</h3>
					<p class="text-center">
						Go <a href="{{ route("home") }}">home</a> or
						<a href="{{ route("homesections.show", $section->slug) }}">explore more</a>
					</p>
				</div>
			</div>
		@endif
	</div>

	<div class="section slider-section pt-4">
		<div class="container recommend-container">
			<h2>Products you might like</h2>
			<div class="recommended-slider slider-products">
				<div class="product-box placeholder mr-2 float-left">
					<div class="product-head"></div>
					<div class="product-body">
						<div class="name"></div>
						<div class="price"></div>
					</div>
				</div>
				<div class="product-box placeholder mr-2 float-left">
					<div class="product-head"></div>
					<div class="product-body">
						<div class="name"></div>
						<div class="price"></div>
					</div>
				</div>
				<div class="product-box placeholder mr-2 float-left">
					<div class="product-head"></div>
					<div class="product-body">
						<div class="name"></div>
						<div class="price"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection