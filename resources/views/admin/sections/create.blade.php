@extends("layouts.admin")

@section("content")

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Create new category</h3>
			</div>
			<div class="admin-body">
				{{ Form::open(["url"=>route("sections.store"), "class"=>"mt-3", "method"=>"post", "enctype"=>"multipart/form-data"]) }}
				<div class="form-group row">
					{{ Form::label("name", "Category name", ["class"=>"col-sm-3 required col-form-label text-md-left required"]) }}
					<div class="col-sm-8">
						{{ Form::text("name", "", ["class"=>"form-control"]) }}
					</div>
				</div>
				<div class="form-group row">
					{{ Form::label("sectionParent", "Category parent", ["class"=>"col-sm-3 col-form-label text-md-left"]) }}
					<div class="col-sm-8">
						<select class="form-control" name="sectionParent" id="sectionParent">
							<option value="0" selected>None</option>
							@foreach($sections as $section)
								<option value="{{ $section->id }}">{{ $section->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						{{ Form::submit("Add section",["class"=>"btn btn-primary d-block ml-auto"]) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection