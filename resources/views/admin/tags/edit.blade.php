@extends("layouts.admin")

@section("content")
<div class="col-8">
	<div class="admin-block">
		<div class="admin-header">
			<h3>Edit: {{ $tag->name }}</h3>
		</div>
		<div class="admin-body">
			{{ Form::open(["url"=>route("tags.update", $tag->id),"class"=>"" ,"method"=>"PUT","enctype"=>"multipart/form-data"]) }}
			<div class="form-group row">
				{{ Form::label("name", "Name", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
				<div class="col-sm-8">
					{{ Form::text("name", $tag->name, ["class"=>"form-control"]) }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-11">
					{{ Form::submit("Update tag",["class"=>"btn btn-primary ml-auto d-block"]) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection