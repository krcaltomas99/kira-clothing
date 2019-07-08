@extends('layouts.app')

@section("title", "Home")

@section('content')
	<div class="container-full">
		<div class="click-left"></div>
		<div class="click-right"></div>
		<div class="hp-slider slider" id="hp-slider">
			@foreach($slides as $slide)
				<div data-id="{{ $slide->id }}"
				     data-redirect="@if($slide->hasDestination()){{ url("/") . $slide->url_dest }} @endif"
				     class="slide clickable">
					<div class="slide-darken"></div>
					<div class="img-slide">
						<img src="{{ $slide->getCoverImg() }}" alt="slide background">
					</div>
					<div class="container">
						<h2>{{ $slide->heading }}</h2>
						<p>{{ $slide->text }}</p>
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<div class="section">
		<div class="container">
			<h2>Newest products</h2>
			<div class="row products-row">
				@foreach($newestProducts as $product)
					<div class="col-6 col-sm-4 col-md-3">
						<div class="product-box">
							<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">
								<div class="product-head">
									<img src="{{ asset($product->getCoverImgMin()) }}" alt="Product image">
									@if($product->hasSku())
										<div class="variations">
											{{ $product->children()->count() + 1 }} variations
										</div>
									@endif
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
			<div class="content faded-sm-text">
				<p>
					<a class="load-more-button" href="">
						Load more
						<span class="plus"></span>
					</a>
				</p>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="container">
			<div class="collection-container">
				<div class="row">
					@foreach($collections as $collection)
						<div class="col-12 col-sm-6 col-md-4">
							<a data-id="{{ $collection->id }}" class="click-count"
							   data-call="{{ route("collectionclick") }}"
							   href="{{ route("showCollection", $collection->slug) }}">
								<div class="collection-box">
									<div title="{{ $collection->name }}" class="absolute-box">
										<p>{{ $collection->name }}</p>
									</div>
									<img src="{{ $collection->getImg() }}" alt="Collection image">
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="section slider-section">
		<div class="container">
			<h2>Hottest products</h2>
			<div class="slider-products hottest-products">
				@foreach($hottestProducts as $product)
					<div class="product-box">
						<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">
							<div class="product-head">
								<img src="{{ asset($product->getCoverImgMin()) }}" alt="Product image">
							</div>
						</a>
						<div class="product-body">
							<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">
								<p>{{ $product->name }}</p></a>
							<span>{{ $product->presentPrice() }} DOLLARS</span>
						</div>
					</div>
				@endforeach
			</div>
		</div>
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
