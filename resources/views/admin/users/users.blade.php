@extends('layouts.admin')

@section("title", "Users")

@section('content')

	<div class="col-md-10">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left mb-4 mb-sm-0">Users</h3>
				<div class="float-left ml-sm-4">
					<form action="{{ url()->full() }}">
						<input value="{{ Request::input("q") }}" placeholder="Search by name..." name="q" type="text" class="form-control">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">

				@if(count($users) > 0)
					<table class="table ui col-12 sortable table-responsive-sm">
						<thead>
						<tr>
							<th><a data-sortable="id" href="{{ url()->current() }}">ID</a></th>
							<th><a data-sortable="name" href="{{ url()->current() }}">Name</a></th>
							<th><a data-sortable="email" href="{{ url()->current() }}">Email</a></th>
							<th><a data-sortable="role" href="{{ url()->current() }}">Role</a></th>
							<th><a data-sortable="created_at" href="{{ url()->current() }}">Added in</a></th>
							<th><a data-sortable="last_login" href="{{ url()->current() }}">Last login</a></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr class="{{ Auth()->user()->id === $user->id ? "positive" : "" }}">
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->role }}</td>
								<td>{{ $user->created_at }}</td>
								<td>{{ $user->last_login }}</td>
								<td><a href="{{ route("admin.users.edit", $user->id) }}">Edit</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{{ $users->appends(request()->input())->links() }}
				@else
					<h4>There are no users</h4>
				@endif
			</div>
		</div>
	</div>

@endsection
