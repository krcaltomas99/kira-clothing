@extends('layouts.admin')

@section("title", "Collections")

@section('content')
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left">Collections</h3>
				<a class="float-right" href="{{ route("collections.create") }}">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">

			@if(count($collections) > 0)
				<table class="table col-12 sortable">
					<thead>
					<tr>
						<th><a data-sortable="id" href="{{ url()->current() }}">ID</a></th>
						<th><a data-sortable="name" href="{{ url()->current() }}">Name</a></th>
						<th>Cover image</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($collections as $collection)
						<tr>
							<td>{{ $collection->id }}</td>
							<td>{{ $collection->name }}</td>
							<td>{{ $collection->cover_img }}</td>
							<td><a href="{{ route("collections.edit", $collection->id) }}">Edit</a></td>
							<td>
								{{ Form::open(["url"=>route("collections.destroy", $collection->id), "method"=>"delete"]) }}
								<button onclick="return confirm('Are you sure?')" style="background:none;border:none;"
								        type="submit" role="text"><a class="text-danger">Delete</a></button>
								{{ Form::close() }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@else
				There are no collections
			@endif
			</div>
		</div>
	</div>

@endsection
