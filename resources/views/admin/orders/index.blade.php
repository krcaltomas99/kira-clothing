@extends("layouts.admin")

@section("content")
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">Orders</h3>
			</div>
			<div class="admin-body">
				<table class="table sortable">
					<thead>
					<tr>
						<th><a href="{{ url()->current() }}" data-sortable="id">ID</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="recipient_name">User</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="subtotal">Subtotal</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="tax">Tax</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="total">Total</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="created_at">Created at</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="updated_at">Updated at</a></th>
						<th><a href="{{ url()->current() }}" data-sortable="finished">Finished</a></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($orders as $order)
						<tr>
							<td>{{ $order->id }}</td>
							<td>{{ $order->recipient_name }}</td>
							<td>${{ $order->subtotal }}</td>
							<td>${{ $order->tax }}</td>
							<td>${{ $order->total }}</td>
							<td>{{ $order->created_at }}</td>
							<td>{{ $order->updated_at }}</td>
							<td>
								<a href="{{ route("admin.orders.finish", $order->id) }}">
									<button type='button' class='btn py-1 {{ ($order->finished) ? "btn-secondary" : "btn-outline-secondary"}}'>
										@if($order->finished)
											Mark as unfinished
										@else
											Mark as finished
										@endif
									</button>
								</a>
							</td>
							<td><a href="{{ route("admin.orders.edit", $order->id) }}">Edit</a></td>
							<td>
								{{ Form::open(["url"=>route("admin.orders.destroy", $order->id), "method"=>"delete"]) }}
								<button onclick="return confirm('Are you sure? This action cant be taken back')"
								        style="background:none;border:none;"
								        type="submit" role="text"><a class="text-danger">Delete</a></button>
								{{ Form::close() }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $orders->appends(request()->input())->links() }}
			</div>
		</div>
	</div>
@endsection