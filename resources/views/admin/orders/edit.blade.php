@extends("layouts.admin")

@section("title", "Edit order $order->id")

@section("additionalScripts")
	<script>
		$(window).on('hashchange', function () {
			var $anchor = window.location.hash.substr(1);

			if ($anchor === '') {
				$anchor = 'tab-information';
			}

			$(".to-tab").hide();
			$("." + $anchor).show();
			$(".tab a.active").removeClass("active");
			$(".tab a[href='#" + $anchor + "']").addClass("active");

			$(window).scrollTop(0);
		});
	</script>
@endsection

@section("content")
	<div class="col-12 col-md-12 col-xl-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Edit {{ $order->recipient_name }}'s order: {{ $order->name }}</h3>
			</div>
			<div class="admin-body tabbable">
				<div class="row">
					<div class="col-12 col-sm-2">
						<div class="tab">
							<ul>
								<li><a class="active" href="#tab-information">Information</a></li>
								<li><a href="#tab-products">Products</a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-sm-10">
						<div class="to-tab tab-information">
							{{ Form::open(["url"=>route("admin.orders.update", $order->id), "method"=>"PUT"]) }}
							<div class="form-group row">
								{{ Form::label("user", "User", ["class"=>"col-sm-4 col-form-label text-md-left required"]) }}
								<div class="col-sm-8">
									<select name="user" id="user" class="form-control">
										@foreach($users as $user)
											<option @if($user->id === $order->user->id) selected
											        @endif value="{{ $user->id }}">{{ $user->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("recipient", "Recipient", ["class"=>"col-sm-4 col-form-label text-md-left required"]) }}
								<div class="col-sm-8">
									{{ Form::text("recipient", $order->recipient_name, ["class"=>"form-control"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("subtotal", "Subtotal", ["class"=>"col-sm-4 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									{{ Form::text("subtotal", "$".$order->subtotal, ["class"=>"form-control disabled", "disabled"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("tax", "Tax", ["class"=>"col-sm-4 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									{{ Form::text("tax", "$".$order->tax, ["class"=>"form-control disabled", "disabled"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("total", "Total", ["class"=>"col-sm-4 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									{{ Form::text("total", "$".$order->total, ["class"=>"form-control disabled", "disabled"]) }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									{{ Form::submit("Update order",["class"=>"btn btn-primary d-block ml-auto"]) }}
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<div class="to-tab tab-products hidden">
							{{ Form::open(["url"=>route("admin.orders.updateProducts", $order->id), "method"=>"PUT"]) }}
							<div class="form-group row">
								{{ Form::label("products", "Products", ["class"=>"col-sm-4 col-form-label text-md-left required"]) }}
								<div class="col-sm-8">
									<div class="row">
										@foreach($order->products as $product)
											<div class="col-12 mb-2">
												<div class="row">
													<div class="col-3">
														<img style="width: 50px;"
														     src="{{ $product->product->getCoverImgMin() }}"
														     alt="">
													</div>
													<div class="col-3">
														<h6>{{ $product->product->name }}</h6>
													</div>
													<div class="col-3">
														{{ Form::number("products[".$product->product->id."][qty]", $product->qty,["class"=>"form-control"]) }}
													</div>
													<div class="col-3">
														<select name="products[{{ $product->product->id }}][size]"
														        id="size"
														        class="form-control">
															@foreach($product->product->quantities as $qty)
																<option @if($qty->size->id === $product->size) selected
																        @endif
																        value="{{ $qty->size->id }}">{{ $qty->size->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
										@endforeach
									</div>
									<div class="row mt-4">
										<div class="col-12">
											<small class="helper">add product</small>
											<select style="width: 100%;" class="custom-select" name="product"
											        id="product">
												<option selected disabled value="">none</option>
												@foreach($products as $product)
													<option value="{{ $product->id }}">{{ $product->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									{{ Form::submit("Update products",["class"=>"btn btn-primary d-block ml-auto"]) }}
								</div>
							</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection