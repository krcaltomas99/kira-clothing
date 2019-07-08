@extends("layouts.admin")

@section("content")

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Edit section: {{ $section->name }}</h3>
			</div>
			<div class="admin-body">
				{{ Form::open(["url"=>route("sections.update", $section->id), "class"=>"", "method"=>"PUT", "enctype"=>"multipart/form-data"]) }}
				<div class="form-group row">
					{{ Form::label("name", "Category name", ["class"=>"col-sm-3 required col-form-label text-md-left required"]) }}
					<div class="col-sm-8">
						{{ Form::text("name", $section->name, ["class"=>"form-control"]) }}
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("sectionParent", "Category parent", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
					<div class="col-sm-8">
						<select class="form-control" name="sectionParent" id="sectionParent">
							<option value="0">None</option>
							@foreach($sections as $sectionArr)
								<option {{ $section->parent_id === $sectionArr->id ? "selected" : "" }} value="{{ $sectionArr->id }}">{{ $sectionArr->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("position", "Position", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
					<div class="col-sm-8">
						{{ Form::text("position", $section->position, ["class"=>"form-control"]) }}
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						{{ Form::submit("Update section",["class"=>"btn btn-primary d-block ml-auto"]) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection