@extends("layouts.app")

@section("title", $collection->name)

@section("content")
	<div style="background-image: url({{ $collection->getCoverImg() }})" class="collection-bg">
		<div class="bg-darken"></div>
		<h2 class="text-center text-white">{{ $collection->name }}</h2>
	</div>
	<div class="section section-products">
		<div class="container">
			<div class="row">
				@if($products->count() > 0)
					<div class="col-12">
						<div class="min-filter">
							<div class="row">
								<div class="col-5 col-xs-3 col-md-4 col-xl-2">
									{{ Form::open([
									"url"=>route("products.filter"),
									"method"=>"get",
									"data-slug" => $collection->slug,
									"data-call" => route("products.filterCollections")
									])
									}}
									{{ Form::select("filter", $select, Input::get("sort"), ["class"=>"products-filter"]) }}
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="row render-category-products">
							@foreach($products as $product)
								<div class="col-6 col-sm-4 col-md-3">
									<div class="product-box">
										<div class="product-head">
											<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}"><img
														src="{{ $product->getCoverImgMin() }}" alt="Product image"></a>
										</div>
										<div class="product-body">
											<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">
												<p>{{ $product->name }}</p></a>
											<span>{{ $product->presentPrice() }} DOLLARS</span>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				@else
					<p class="text-center">No products :(</p>
				@endif
			</div>
		</div>
	</div>

@endsection