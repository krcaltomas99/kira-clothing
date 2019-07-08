@extends('layouts.admin')

@section("title", "Slider")

@section('content')
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class=" float-left">Slider</h3>
				<a class="float-right" href="{{ route("sliders.create") }}">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">
				@if(count($slides) > 0)
					<table class="table stackable ui col-12 sortable">
						<thead>
						<tr>
							<th><a data-sortable="id" href="{{ url()->current() }}">ID</a></th>
							<th><a data-sortable="heading" href="{{ url()->current() }}">Heading</a></th>
							<th><a data-sortable="text" href="{{ url()->current() }}">Text</a></th>
							<th><a data-sortable="clicks" href="{{ url()->current() }}">Clicks</a></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($slides as $slide)
							<tr>
								<td>{{ $slide->id }}</td>
								<td>{{ $slide->heading }}</td>
								<td>{{ $slide->text }}</td>
								<td>{{ $slide->clicks}}</td>
								<td>
									{{ Form::open(["url"=>route("sliders.changeActive", $slide->id), "method"=>"put"]) }}
									<button type="submit" style="background:none;border:none;" role="button"
									        class="@if($slide->isActive()) ? text-secondary : text-success @endif">
										Active
									</button>
									{{ Form::close() }}
								</td>
								<td><a href="{{ route("sliders.edit", $slide->id) }}">Edit</a></td>
								<td>
									{{ Form::open(["url"=>route("sliders.destroy", $slide->id), "method"=>"delete","enctype"=>"multipart/form-data"]) }}
									<button onclick="return confirm('Are you sure?')"
									        style="background:none;border:none;"
									        type="submit" role="text"><a class="text-danger">Delete</a></button>
									{{ Form::close() }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@endif
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Active slides</h3>
			</div>
			<div class="admin-body">
				<div class="slides">
					@foreach($activeSlides as $activeSlide)
						<div data-id="{{ $activeSlide->id }}"
						     class="slide d-flex align-items-center justify-content-center"
						     style="background-image: url({{ $activeSlide->getCoverImg() }})">
							<p class="text-white">{{ $activeSlide->heading }}</p>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="admin-block">
		</div>
	</div>
@endsection