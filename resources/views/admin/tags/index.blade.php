@extends("layouts.admin")

@section("content")
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Tags</h3>
			</div>
			<div class="admin-body">
				<table class="table sortable">
					<thead>
					<tr>
						<th><a href="{{ url()->current() }}" data-sortable="id">ID</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="name">Name</a></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($tags as $tag)
						<tr>
							<td>{{ $tag->id }}</td>
							<td>{{ $tag->name }}</td>
							<td><a href="{{ route("tags.edit", $tag->id) }}">Edit</a></td>
							<td>
								{{ Form::open(["url"=>route("tags.destroy", $tag->id), "method"=>"delete"]) }}
								<button onclick="return confirm('Are you sure? This action cant be taken back')"
								        style="background:none;border:none;"
								        type="submit" role="text"><a class="text-danger">Delete</a></button>
								{{ Form::close() }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $tags->appends(request()->input())->links() }}
			</div>
		</div>
	</div>
@endsection