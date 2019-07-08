@extends("layouts.admin")

@section("content")

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Create new collection</h3>
			</div>
			<div class="admin-body">
				{{ Form::open(["url"=>route("collections.store"), "class"=>"", "method"=>"post", "enctype"=>"multipart/form-data"]) }}
				<div class="form-group row">
					{{ Form::label("name", "Collection name", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
					<div class="col-sm-8">
						{{ Form::text("name", "", ["class"=>"form-control"]) }}
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("collection_img", "Collection icon", ["class"=>"col-sm-3 col-form-label text-md-left required"]) }}
					<div class="col-sm-8">
						<div class="custom-file">
							{{ Form::file("collection_img", ["class"=>"custom-file-input form-control-file"]) }}
							{{ Form::label("collection_img", "Choose a file...", ["class"=>"custom-file-label"]) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						{{ Form::submit("Add collection",["class"=>"btn btn-primary d-block ml-auto"]) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection