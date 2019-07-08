@extends("layouts.admin")

@section("content")

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">Edit slide: {{ $slide->heading }}</h3>
			</div>
			<div class="admin-body">
				{{ Form::open(["url"=>route("sliders.update", $slide->id), "class"=>"", "method"=>"PUT", "enctype"=>"multipart/form-data"]) }}
				<div class="form-group row">
					{{ Form::label("slider_header", "Slider heading", ["class"=>"col-sm-3 col-form-label text-md-left "]) }}
					<div class="col-sm-8 ">
						{{ Form::text("slider_header", $slide->heading, ["class"=>"form-control"]) }}
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("slider_text", "Slider text", ["class"=>"col-sm-3 col-form-label text-md-left "]) }}
					<div class="col-sm-8 ">
						{{ Form::text("slider_text", $slide->text, ["class"=>"form-control"]) }}
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("slider_image", "Slide cover photo", ["class"=>"col-sm-3 col-form-label  text-md-left"]) }}
					<div class="col-8 ">
						<div class="custom-file">
							{{ Form::file("slider_image", ["class"=>"custom-file-input form-control-file"]) }}
							{{ Form::label("slider_image", "Choose a file...", ["class"=>"custom-file-label"]) }}
						</div>
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("slider_link", "Destination link", ["class"=>"col-sm-3 col-form-label text-md-left "]) }}
					<div class="col-sm-8 ">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">{{ url("/") }}</span>
							</div>
							{{ Form::text("slider_link", $slide->url_dest, ["class"=>"form-control"]) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						{{ Form::submit("Update slider",["class"=>"btn btn-primary ml-auto d-block"]) }}
					</div>
				</div>

				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection