@extends('layouts.admin')

@section('content')


	<div class="col-md-10">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left mb-4 mb-sm-0">Customers</h3>
				<div class="float-left ml-sm-4">
					<form action="{{ url()->full() }}">
						<input value="{{ Request::input("q") }}" placeholder="Search by name..." name="q" type="text"
						       class="form-control">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">

				@if(count($customers) > 0)
					<table class="table col-12 sortable table-responsive-sm">
						<thead>
						<tr>
							<th><a data-sortable="id" href="{{ url()->current() }}">ID</a></th>
							<th><a data-sortable="name" href="{{ url()->current() }}">Name</a></th>
							<th><a data-sortable="email" href="{{ url()->current() }}">Email</a></th>
							<th><a data-sortable="created_at" href="{{ url()->current() }}">Added in</a></th>
							<th><a data-sortable="last_login" href="{{ url()->current() }}">Last login</a></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($customers as $customer)
							<tr class="{{ Auth()->user()->id === $customer->id ? "positive" : "" }}">
								<td>{{ $customer->id }}</td>
								<td>{{ $customer->name }}</td>
								<td>{{ $customer->email}}</td>
								<td>{{ $customer->created_at}}</td>
								<td>{{ $customer->last_login }}</td>
								<td><a href="{{ route("admin.users.edit", $customer->id) }}">Edit</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{{ $customers->links() }}
				@else
					<h4>There are no customers</h4>
				@endif
			</div>
		</div>
	</div>

@endsection
