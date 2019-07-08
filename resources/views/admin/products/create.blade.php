@extends("layouts.admin")

@section("title", "Adding product")

@section("additionalScripts")
	<script>

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
	<div class="col-xl-9 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">Create new product</h3>
			</div>
			<div class="admin-body tabbable">
				<div class="row">
					<div class="col-12 col-sm-2">
						<div class="tab">
							<ul>
								<li><a class="active" href="#tab-information">Information</a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-sm-10">
						{{ Form::open(["url"=>route("products.store"),"class"=>"prod-form" ,"method"=>"post", "enctype"=>"multipart/form-data"]) }}
						<div class="to-tab tab-information">
							<div class="form-group row">
								{{ Form::label("name","Name of the product", ["class"=>"col-sm-3 required col-form-label text-md-left "]) }}
								<div class="col-sm-8">
									{{ Form::text("name", "", ["class"=>"form-control", "required"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("cover_image", "Cover image", ["class"=> "col-sm-3 required col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									<div class="custom-file">
										{{ Form::file("cover_image", ["class"=>"preview custom-file-input form-control-file", "data-target-id"=>"img-prev"]) }}
										{{ Form::label("cover_image", "Choose a file...", ["class"=>"custom-file-label"]) }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("gender", "Gender", ["class"=>"col-sm-3 required col-form-label text-md-left "]) }}
								<div class="col-sm-8">
									{{
										Form::select("gender", [
											"male"=>"Male",
											"female"=>"Female",
											"unisex"=>"Unisex",
										], null, ["class"=>"form-control "])
									}}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("section", "Category", ["class"=>"col-sm-3 required col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									{{
										Form::select("sections", $selectedSection, null, ["class"=>" form-control"])
									}}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("colections", "Collection", ["class"=>"col-sm-3 col-form-label text-md-left "]) }}
								<div class="col-sm-8">
									{{
										Form::select("colections", [null=>"none"] + $selectedColection, null, ["class"=>"form-control"])
									}}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("group", "Group with", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
								<div class="col-sm-8">
									{{ Form::select("group", [null=>"none"] + $selectedProduct, null, ["class"=>"form-control"]) }}
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("price", "Price", ["class"=>"col-sm-3 required col-form-label text-md-left", "required"]) }}
								<div class="col-sm-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">$</span>
										</div>
										{{ Form::text("price", "", ["class"=>"form-control"]) }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								{{ Form::label("textarea", "Product info", ["class"=>"col-sm-3 col-form-label required text-md-left", "required"]) }}
								<div class="col-sm-8">
									{!! Form::textarea('textarea',null,['class'=>'form-control']) !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-11">
								{{ Form::button("Add product",["class"=>"btn btn-primary btn-wave ml-auto d-block", "id"=>"submit-all", "type"=>"submit"]) }}
							</div>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
