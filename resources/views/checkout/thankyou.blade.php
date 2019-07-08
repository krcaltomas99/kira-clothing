@extends("layouts.app")

@section("title", "Thank you!")

@section("content")
	<div class="container mt-4">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center mb-2">Thank you!</h2>
				<p class="text-center text-dark mb-0">We really appreciate your decision! We are working on your good
					and we'll let you know as soon as it's ready!</p>
				<p class="text-center text-dark">If There is anything you want to ask or you've encountered any issue,
					let us know <a href="mailto:support@kira.com">support@kira.com</a></p>
			</div>
			<div class="col-12">
				<div class="row">
					<div class="col-12 col-md-8 col-xl-6">
						<div class="card">
							<div class="card-header">
								Recap of your order
							</div>
							<div class="card-body">
								<h5 class="card-title">Here are the goods you've ordered</h5>
								<p class="card-text">If there is anything wrong, let us know.</p>
								<div class="row">
									@foreach($order->products as $product)
										<div class="col-6 col-xl-4">
											<div class="card">
												<div class="" style="overflow: hidden;max-height: 140px;">
													<img src="{{ $product->product->getCoverImgMin() }}"
													     class="card-img-top"
													     alt="product-image">
												</div>

												<div class="card-body">
													<h6 class="card-title">{{ $product->product->name }}</h6>
													<p class="card-text">{{ $product->product->section->name }}</p>
												</div>
											</div>
										</div>
									@endforeach
								</div>
								<a href="{{ route("home") }}" class="btn btn-primary mt-5 mr-2">Go back
									home</a>
								@auth
									<a class="btn btn-secondary mt-5" href="{{ route("users.orders") }}">View order
										details</a>
								@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection