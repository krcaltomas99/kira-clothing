@extends("layouts.app")

@section("title", $product->name)

@section("meta")
	<meta property="og:url" content="{{ url()->full() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="{{ $product->name }} / {{ config('app.name') }}"/>
	<meta property="og:description" content=" {{ env("APP_DESCRIPTION") }}"/>
	<meta property="og:image" content="{{ $product->getCoverImgMin() }}"/>
	<meta property="fb:app_id" content="{{ env("FACEBOOK_APP_ID") }}">
@endsection

@section("content")
	<div class="container product-page-container">
		<div class="row product-page-box">
			<div class="col-12 col-md-8 col-lg-8">
				<div data-color="{{ $product->color()->first()->value }}" data-id="{{ $product->id }}"
				     class="left-product-box">
					<div class="image-box">
						<a data-width="760" data-fancybox="images" href="{{ $product->getCoverImg() }}">
							<img src="{{ $product->getCoverImg() }}" alt="Product image">
						</a>
					</div>
					@if($productImages->count() > 0)
						<div class="images-box mt-2">
							<div class="image-slider">
								@foreach($productImages as $image)
									<a data-fancybox="images" data-width="760"
									   href="{{ secure_asset("storage/product_images/" . $image->name) }}">
										<img src="{{ secure_asset("storage/product_images/" . $image->name) }}"
										     alt="Product image">
									</a>
								@endforeach
							</div>
						</div>
					@endif
				</div>

				@if($groupedProducts->isNotEmpty())
					<div style="overflow: hidden;" class="row grouped-products product-page-sliders d-none d-md-block">
						<div class="col-12">
							<h2>Grouped products</h2>
							<div class="group-slider grouped-products-slider slider-products">
								@foreach($groupedProducts as $groupProduct)
									<div class="product-box">
										<a href="{{ route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug]) }}">
											<div class="product-head">
												<img src="{{ $groupProduct->getCoverImgMin() }}" alt="product img">
											</div>
										</a>
										<div class="product-body">
											<a href="{{ route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug]) }}">
												<p>{{ $groupProduct->name }}</p>
											</a>
											<span>{{ $groupProduct->presentPrice() }}</span>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				@else
					<div style="overflow: hidden;"
					     class="row recommend-container product-page-sliders d-none d-md-block">
						<div class="col-12">
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

				@endif

				<div class="clearfix"></div>

				<div style="overflow: hidden;" class="row last-visited product-page-sliders d-none d-md-block">
					<div class="col-12">
						<h2>Last visited</h2>
						<div class="group-slider last-visit-slider slider-products">
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
			</div>

			<div class="col-12 col-md-4 col-lg-4">
				<div class="right-product-box layout-holder">
					@if(Auth::check() && Auth::user()->isAdmin())
						<a href="{{ route("products.edit", $product->id) }}">Edit</a>
					@endif
					<div class="essential-info">
						<h2 class="">{{ $product->name }}</h2>
						<h4 class="">{{ $product->presentPrice() }}</h4>
						<h5 class="">inc. 21% TAX</h5>
					</div>

					<div class="product-variants">
						<a class=""
						   href="{{ route("showProduct", ["id"=> $product->getMainSku()->id, "slug"=>$product->getMainSku()->slug]) }}">
							<div class="variant-box @if($product->getMainSku()->id === $product->id) active @endif">
								<img src="{{ $product->getMainSku()->getCoverImgUltraMin() }}" alt="variant photo">
							</div>
						</a>
						@foreach($product->getMainSku()->children as $child)
							<a href="{{ route("showProduct", ["id"=> $child->id, "slug"=>$child->slug]) }}">
								<div class="variant-box @if($child->id === $product->id) active @endif">
									<img src="{{ $child->getCoverImgUltraMin() }}" alt="variant photo">
								</div>
							</a>
						@endforeach
					</div>
					{{ Form::open(["url"=>route("cart.store", $product->id), "method"=>"POST", "class"=>"", "id"=>"product-form"]) }}
					<div class="row">
						<div class="col-lg-12">
							<div class="size-labels">
								@if($errors->has("size-warning"))
									<div class="inline-warning">
										{{ $errors->first("size-warning") }}
									</div>
								@endif
								@foreach($product->quantities as $quantity)
									<div class="size-label">
										@php $disabled = "" @endphp
										@if($quantity->qty <= 0)
											@php $disabled = "disabled" @endphp
										@endif
										{{ Form::radio("size", $quantity->size->id, false, ["id"=>str_slug($quantity->size->name),
										"data-qty"=>$quantity->qty,
										 "class"=>$disabled, $disabled]) }}
										{{ Form::label(str_slug($quantity->size->name), $quantity->size->name, ["class"=>$disabled . " noselect"]) }}
									</div>
								@endforeach
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row">
								<div class="col-12 mt-3">
									@if($product->ratings->isNotEmpty())
										<h6 class="to-rate">{{ $ratingValue }} / 5</h6>
									@else
										<h6 class="to-rate">No ratings yet</h6>
									@endif
									@auth
										@if($displayRate)
											<div class="rating-box pt-2">
												<h6>Rate this product</h6>
												<div data-id="{{ $product->id }}"
												     class="d-flex pt-2 ratings justify-content-around">
													<div data-value="1" class="rating">1</div>
													<div data-value="2" class="rating">2</div>
													<div data-value="3" class="rating">3</div>
													<div data-value="4" class="rating">4</div>
													<div data-value="5" class="rating">5</div>
												</div>
											</div>
										@endif
									@endauth
								</div>
								<div class="col-12">
									<div class="row">
										<div class="col-7">
											<div class="qty-box">
												<div class="qty-numbers float-left ">
													<i class="fas fa-minus product-minus"></i>
												</div>
												{{ Form::number("qty", 1, ["class"=>"float-left", "readonly"]) }}
												<div class="qty-numbers float-left ">
													<i class="fas fa-plus product-plus"></i>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="col-5">
											<div data-price="{{ $product->price }}" class="total-price text-right">
												{{ $product->presentPrice() }}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mt-4">
							<div class="shopping-box">
								<div class="row">
									<div class="col-10 col-md-8">
										<button @if(!$product->hasQuantities()) disabled @endif id="add_to_basket"
										        type="submit"
										        class="btn btn-dark btn-wave p-2 d-block w-100 @if(!$product->hasQuantities()) disabled @endif">
											Add to cart
										</button>
									</div>
									<div class="col-2 col-md-4">
										<a class="add-to-favorites text-dark d-block mx-auto" data-productid="{{ $product->id }}"
										   href="{{ route("products.addToFavorites") }}">
											@auth
												@if(Auth::user()->isProductFavorite($product->id))
													<i class="fas fa-heart"></i>
												@else
													<i class="far fa-heart"></i>
												@endif
											@else
												<i class="far fa-heart"></i>
											@endauth
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mt-4">
							<div class="product-information">
								{!! $product->text !!}
							</div>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>

			@if($groupedProducts->isNotEmpty())
				<div class="col-12">
					<div style="overflow: hidden;" class="row grouped-products product-page-sliders d-block d-md-none">
						<div class="col-12">
							<h2>Grouped products</h2>
							<div class="group-slider grouped-products-slider slider-products">
								@foreach($groupedProducts as $groupProduct)
									<div class="product-box">
										<a href="{{ route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug]) }}">
											<div class="product-head">
												<img src="{{ $groupProduct->getCoverImgMin() }}" alt="product img">
											</div>
										</a>
										<div class="product-body">
											<a href="{{ route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug]) }}">
												<p>{{ $groupProduct->name }}</p>
											</a>
											<span>{{ $groupProduct->presentPrice() }}</span>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="col-12">
					<div style="overflow: hidden;"
					     class="row recommend-container product-page-sliders d-block d-md-none">
						<div class="col-12">
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
				</div>
			@endif

			<div class="col-12">
				<div style="overflow: hidden;" class="row last-visited product-page-sliders d-block d-md-none">
					<div class="col-12">
						<h2>Last visited</h2>
						<div class="group-slider last-visit-slider slider-products">
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
			</div>

		</div>
	</div>
@endsection

@section("additionalScripts")
	<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>-->
@endsection