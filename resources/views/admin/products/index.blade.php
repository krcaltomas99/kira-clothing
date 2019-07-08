@extends('layouts.admin')

@section("title", "Products")

@section('content')
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left mb-3 mb-sm-0">Products</h3>
				<div class="float-md-left float-right ml-sm-4 mb-3 mb-sm-0">
					<form action="{{ url()->full() }}">
						<input value="{{ Request::input("q") }}" placeholder="Search by name..." name="q" type="text"
						       class="form-control">
					</form>
				</div>
				<a class="float-left float-sm-right" href="{{ route("products.create") }}">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">
				@if(count($products) > 0)
					<table class="table col-12 sortable table-responsive-lg">
						<thead>
						<tr>
							<th><a data-sortable="id" href=" {{ url()->current() }}">ID</a></th>
							<th><a data-sortable="name" href=" {{ url()->current() }}">Name</a></th>
							<th><a data-sortable="gender" href=" {{ url()->current() }}">Gender</a></th>
							<th><a data-sortable="collections" href="{{ url()->current() }}">Collection</a></th>
							<th><a data-sortable="section" href="{{ url()->current() }}">Section</a></th>
							<th>Added by</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($products as $product)
							<tr>
								<td>{{ $product->id }}</td>
								<td><a href="{{ route("products.edit", $product->id) }}">{{ $product->name }}</a></td>
								<td>{{ $product->gender }}</td>
								<td>
									@isset($product->collection)
										{{ $product->collection->name }}
									@else
										None
									@endisset
								</td>
								<td>{{ $product->section->name }}</td>
								<td>{{ $product->user->name }}</td>
								<td><a target="_blank" href="{{ route("showProduct", ["id"=>$product->id, "slug"=>$product->slug]) }}">Show</a></td>
								<td>
									{{ Form::open(["url"=>route("products.destroy", $product->id), "method"=>"delete"]) }}
									<button onclick="return confirm('Are you sure? This action cant be taken back')"
									        style="background:none;border:none;"
									        type="submit" role="text"><a class="text-danger">Delete</a></button>
									{{ Form::close() }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{{ $products->appends(request()->input())->links() }}
				@else
					There are no products
				@endif
			</div>
		</div>
	</div>

@endsection
