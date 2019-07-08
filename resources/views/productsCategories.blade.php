@extends("layouts.app")

@section("title", $section->name)

@section("content")
	<div class="section section-products">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center">{{ $section->name }}</h2>
					@if(!$section->parent)
						<ul class="ul-centered">
							@foreach($section->children as $item)
								<li>
									<a href="{{ route("homesections.show", $item->slug) }}">{{ $item->name }}</a>
								</li>
							@endforeach
						</ul>
					@else
						<ul class="ul-centered">
							<li>
								<a href="{{ route("homesections.show", $section->parent->slug) }}">{{ $section->parent->name }}</a>
							</li>
							<li> ></li>
							@foreach($section->parent->children as $item)
								<li>
									<a href="{{ route("homesections.show", $item->slug) }}">{{ $item->name }}</a>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				@if($products->count() > 0)
					<div class="col-12">
						<div class="min-filter">
							<div class="row">
								<div class="col-5 col-xs-3 col-md-4 col-xl-2">
									{{ Form::open([
									"url"=>route("products.filter"), "method"=>"get",
									"data-slug"=>$section->slug,
									"data-call" => route("products.filter")
									]) }}
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
										<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">
											<div class="product-head">
												<img src=" {{ $product->getCoverImgMin() }}"
												     alt="Product image">
											</div>
										</a>
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
					<div class="products-pagination">
						{{ $products->links() }}
					</div>
				@else
					<p class="text-center">No products :(</p>
				@endif
			</div>
		</div>
	</div>

@endsection