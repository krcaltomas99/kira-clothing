@extends("layouts.admin")

@section("title", "Edit $product->name")

@section("additionalScripts")
	<script src="{{ secure_asset("dropzone/dist/min/dropzone.min.js") }}"></script>
	<script type="text/javascript">
		var token = "{!! csrf_token() !!}";

		$(function () {
			$("body").prepend(
				`<div id="upload-photos" class="kc popup">
					<div class="header">
						<i class="fas kc-exit fa-times"></i>
						<h3>Upload more photos</h3>
						<ul>
							<li>Upload photos</li>
						</ul>
					</div>
					<div class="body">
						<div class="dropzone-like flex-break text-primary d-flex justify-content-center align-items-center"
						     id="my-dropzone">
							<p class="dz-helper">Drop down images</p>
							<div class="fallback">
								<input type="file" name="toUpload">
							</div>
						</div>
					</div>
					<div class="helper">
						Waiting for action...
					</div>
				</div>`
			);

			$("#my-dropzone").dropzone({
				url: "{{ route('product-ajax-upload', $product->id) }}",
				acceptedFiles: "image/*",
				resizeWidth: 600,
				init: function () {
					$("#my-dropzone").addClass("dropzone");
					this.on("addedfile", function () {
						$(".dz-helper").hide();
					});
					this.on("success", function (file, responseText) {
						var $helper = $(".kc.popup .helper");
						$helper.text(responseText.message);
						$helper.addClass("text-success");
						$("#product-images-edit").append(
							"<form method=\"POST\" action=\"../destroyImg/image/" + responseText.id + "\" accept-charset=\"UTF-8\">" +
							"<input name=\"_method\" type=\"hidden\" value=\"DELETE\">" +
							"<input name=\"_token\" type=\"hidden\" value=\"{{ csrf_token() }}\">" +
							"<div class=\"product-imgs\">" +
							"<label for='img_" + responseText.id + "'>" +
							"<img width=\"50\" height=\"50\" src=\"{{ secure_asset("storage/product_images/") }}/" + responseText.name + "\" alt=\"\"> " +
							"</label>" +
							"<input id='img_" + responseText.id + "'  type=\"checkbox\" value='" + responseText.id + "'>" +
							"<button onclick=\"return confirm('This action can\\'t be taken back, are you sure?')\" class=\"btn btn-danger float-right mt-2 mr-2 p-1\">" +
							"<i class=\"fas fa-trash\"></i>" +
							"</button>" +
							"</div>" +
							"</form>"
						);
					});
					this.on("error", function (response) {
						$(".kc.popup .helper").text(response);
					});
				},
				params: {
					_token: token
				},
			});
		});
	</script>
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

		//TinyMCE
		tinymce.init({
			selector: 'textarea',
			height: 200,
			menubar: false,
			plugins: [
				'advlist autolink lists link image charmap print preview anchor textcolor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code help wordcount'
			],
			toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tinymce.com/css/codepen.min.css']
		});

	</script>
@endsection

@section("content")

	<div class="col-12 col-md-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left">
					Edit product: {{ $product->name }}
					@if($product->isSku())
						<a href="{{route("products.edit", $product->sku_id)}}">#{{$product->sku_id}}</a>
					@endif
				</h3>
				{{ Form::open(["url"=>route("products.destroy", $product->id), "method"=>"delete"]) }}
				<button class="btn btn-danger float-right d-block ml-auto"
				        onclick="return confirm('Are you sure? This action cant be taken back.')"
				        type="submit">Delete
				</button>
				{{ Form::close() }}
				<div class="clearfix"></div>
			</div>
			<div class="admin-body tabbable">
				<div class="row">
					<div class="col-12 col-sm-2">
						<div class="tab">
							<ul>
								<li><a class="active" href="#tab-information">Information</a></li>
								<li><a href="#tab-photos">Photos</a></li>
								<li><a href="#tab-tags">Tags</a></li>
								<li><a href="#tab-quantity">Quantities</a></li>
								<li><a href="#tab-colors">Colors</a></li>
								@if(!$product->isSku())
									<li><a href="#tab-sku-add">New variation</a></li>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-12 col-sm-10">
						<p>added by {{ $product->user->name }}</p>
						<div class="to-tab tab-information">
							{{ Form::open(["url"=>route("products.update", $product->id), "class"=>"mt-3 preview-edit" ,"method"=>"PUT"]) }}
							<div class="form-group row">
								{{ Form::label("name","Name of the product", ["class"=>"col-sm-3 col-form-label text-md-left required "]) }}
								<div class="col-sm-8">
									{{ Form::text("name", $product->name, ["class"=>"form-control binded", "data-target"=>"product-name"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("gender", "Gender", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
								<div class="col-sm-8">
									{{
										Form::select("gender", [
											"male"=>"Male",
											"female"=>"Female",
											"unisex"=>"Unisex",
										], $product->gender, ["class"=>"ui dropdown form-control selectpicker"])
									}}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("sections", "Category", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
								<div class="col-sm-8">
									{{ Form::select("sections",$selectedSection, $product->section->id, ["class"=>"ui dropdown form-control"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("colections", "Collection", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									<select class="form-control" name="colections" id="colections">
										<option value="">none</option>
										@foreach($collections as $collection)
											<option {{ $product->collection_id == $collection->id ? "selected" : "" }} value="{{ $collection->id }}">{{ $collection->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("group", "Group with", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									@isset($product->group)
										{{ Form::select("group", [null=>"none"] + $selectedProduct, $product->group->products[0]->id, ["class"=>"form-control"]) }}
										<small id="groupHelp" class="form-text text-muted">
											Grouped with {{ $product->group->products->count() - 1 }} product(s)
										</small>
									@else
										{{ Form::select("group", [null=>"none"] + $selectedProduct, null, ["class"=>"form-control"]) }}
									@endif
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("price", "Price", ["class"=>"col-sm-3 col-form-label text-md-left required "]) }}
								<div class="col-sm-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">$</span>
										</div>
										{{ Form::text("price", $product->price, ["class"=>"form-control binded", "data-target"=>"product-price"]) }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("textarea", "Product info", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
								<div class="col-sm-8">
									{!! Form::textarea('textarea',$product->text,['class'=>'form-control']) !!}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-11">
									{{ Form::submit("Update information",["class"=>"btn btn-primary d-block ml-auto"]) }}
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<div class="to-tab tab-photos hidden">
							{{ Form::open(["url"=>route("products.updatePhotos", $product->id), "class"=>"mt-3", "id"=>"photos-edit","method"=>"PUT","enctype"=>"multipart/form-data"]) }}
							<div class="form-group row">
								{{ Form::label("cover_image", "Cover photo", ["class"=>"col-sm-3 col-form-label text-md-left "]) }}
								<div class="col-sm-8">
									<div class="custom-file">
										{{ Form::file("cover_image", ["class"=>"preview custom-file-input form-control-file", "data-target-id"=>"img-prev"]) }}
										{{ Form::label("cover_image", "Choose a file...", ["class"=>"custom-file-label"]) }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("more_photos", "More photos", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									<button type="button" data-target="upload-photos"
									        class="btn-outline-primary btn d-block kc-popup">More photos
									</button>
								</div>
							</div>
							{{ Form::close() }}
							<div class="form-group row">
								<div class="col-sm-3"></div>
								<div class="col-sm-8">
									<div class="admin-block inserted">
										<div class="admin-header">
											<h3 class=" float-left">Images</h3>
											<button id="product_delete_multiple" disabled
											        class="btn btn-outline-danger float-right disabled">
												Delete multiple
											</button>
											<div class="clearfix"></div>
										</div>
										<div class="admin-body">
											<div id="product-images-edit">
												@if(count($productImages) > 0)
													@foreach($productImages as $image)
														{{ Form::open(["url"=> route("destroyImg", $image->id), "method"=>"delete" ]) }}
														<div data-id="{{ $image->id }}" class="product-imgs">
															<label for="img_{{ $image->id  }}">
																<img width="50" height="50"
																     src="{{ asset("storage/product_images/" . $image->name) }}"
																     alt="">
															</label>
															<input id="img_{{ $image->id }}" type="checkbox"
															       value="{{ $image->id }}"/>
															<button onclick="return confirm('This action can\'t be taken back, are you sure?')"
															        class="btn btn-danger float-right mt-2 mr-2 p-1">
																<i class="fas fa-trash"></i>
															</button>
														</div>
														{{ Form::close() }}
													@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-11">
									<button onclick="document.getElementById('photos-edit').submit()"
									        class="btn btn-primary d-block ml-auto">Update photos
									</button>
								</div>
							</div>
						</div>

						<div class="to-tab hidden tab-tags">
							{{ Form::open(["url"=>route("products.updateTags", $product->id), "class"=>"mt-3" ,"method"=>"PUT"]) }}
							<div class="form-group row">
								{{ Form::label("tags", "Tags", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									{{ Form::text("tags", $tags, ["class"=>"form-control selectize"]) }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-11">
									{{ Form::submit("Update tags",["class"=>"btn btn-primary d-block ml-auto"]) }}
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<div class="to-tab hidden tab-quantity">
							{{ Form::open(["url"=>route("products.updateQuantities", $product->id), "class"=>"mt-3", "method"=>"PUT"]) }}
							@foreach($product->quantities as $quantity)
								<div class="form-group row">
									{{ Form::label("size[$quantity->id]", $quantity->size->name, ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
									<div class="col-sm-8">
										{{ Form::text("size[$quantity->id]", $quantity->qty, ["class"=>"form-control"]) }}
									</div>
								</div>
							@endforeach
							<div class="row">
								<div class="col-sm-11">
									{{ Form::submit("Update quantites",["class"=>"btn btn-primary d-block ml-auto"]) }}
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<div class="to-tab hidden tab-colors">
							{{ Form::open(["url"=>route("products.updateColors", $product->id), "class"=>"mt-3", "method"=>"PUT"]) }}
							@foreach($product->color as $key => $color)
								<div class="form-group row">
									{{ Form::label("value[$key]", "Color #$key", ["class"=>"col-sm-3 col-form-label text-mt-right"]) }}
									<div class="color-box" style="background: {{ $color->value }}"></div>
									<div class="col-sm-8">
										{{ Form::text("value[$key]", $color->value, ["class"=>"form-control color-input"]) }}
									</div>
								</div>
							@endforeach
							<div class="form-group row">
								<div class="col-sm-8 offset-3">
									<div class="card">
										<div style="padding: 8px;" class="card-body add-color text-center clickable">
											<i class="fas fa-plus"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-11">
									{{ Form::submit("Update colors",["class"=>"btn btn-primary d-block ml-auto"]) }}
								</div>
							</div>
							{{ Form::close() }}
						</div>

						@if(!$product->isSku())
							<div class="to-tab hidden tab-sku-add">
								{{ Form::open(["url"=>route("products.storeSku", $product->id), "class"=>"mt-3", "method"=>"POST", "enctype"=>"multipart/form-data"]) }}
								<div class="form-group row">
									{{ Form::label("sku_name","Name of the product", ["class"=>"col-sm-3 col-form-label text-md-left required "]) }}
									<div class="col-sm-8">
										{{ Form::text("sku_name", $product->name, ["class"=>"form-control binded", "data-target"=>"product-name"]) }}
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label("sku_cover_image", "Cover photo", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
									<div class="col-sm-8">
										<div class="custom-file">
											{{ Form::file("sku_cover_image", ["class"=>"custom-file-input form-control-file"]) }}
											{{ Form::label("sku_cover_image", "Choose a file...", ["class"=>"custom-file-label"]) }}
										</div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label("sku_gender", "Gender", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
									<div class="col-sm-8">
										{{
											Form::select("sku_gender", [
												"male"=>"Male",
												"female"=>"Female",
												"unisex"=>"Unisex",
											], $product->gender, ["class"=>"ui dropdown form-control"])
										}}
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label("sku_price", "Price", ["class"=>"col-sm-3 col-form-label text-md-left required "]) }}
									<div class="col-sm-8">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">$</span>
											</div>
											{{ Form::text("sku_price", $product->price, ["class"=>"form-control binded", "data-target"=>"product-price"]) }}
										</div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label("sku_textarea", "Product info", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
									<div class="col-sm-8">
										{!! Form::textarea('sku_textarea',$product->text,['class'=>'form-control']) !!}
									</div>
								</div>
								{{ Form::hidden("product_id", $product->id) }}
								<div class="row">
									<div class="col-sm-11">
										{{ Form::submit("Add variation",["class"=>"btn btn-primary d-block ml-auto"]) }}
									</div>
								</div>
								{{ Form::close() }}
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-4">
		<div class="row">
			<div class="col-12">
				<div class="admin-block">
					<div class="admin-header">
						<h3 class="">Product preview</h3>
					</div>
					<div class="admin-body">
						<div class="row">
							<div class="col-12">
								<div class="product-preview">
									<div class="product-img">
										<a href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">
											<img id="img-prev" src="{{ $product->getCoverImgMin() }}" alt="">
										</a>
									</div>
									<div class="product-body">
										<div class="row main-info">
											<div class="col-6 col-lg-8 name">
												<h3><span id="product-name"></span></h3>
											</div>
											<div class="col-6 col-lg-4 price text-right">
												<span id="product-price"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection