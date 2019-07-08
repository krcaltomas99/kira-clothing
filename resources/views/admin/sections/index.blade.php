@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 col-md-6">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left">Categories</h3>
				<a class="float-right" href="{{ route("sections.create") }}">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">
				@if(count($sections) > 0)
					<table class="table col-12 sortable table-responsive-sm">
						<thead>
						<tr>
							<th><a data-sortable="id" href="{{ url()->current() }}">ID</a></th>
							<th><a data-sortable="name" href="{{ url()->current() }}">Name</a></th>
							<th>Show products</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($sections as $section)
							<tr>
								<td>{{ $section->id }}</td>
								<td>{{ $section->name }}</td>
								<td><a href="{{ route("sections.show", $section->id) }}">Show products
										({{ $section->products->count() }})</a></td>
								<td><a href="{{ route("sections.edit", $section->id) }}">Edit</a></td>
								<td>
									{{ Form::open(["url"=>route("sections.destroy", $section->id), "method"=>"delete","enctype"=>"multipart/form-data"]) }}
									<button onclick="return confirm('Are you sure?')"
									        style="background:none;border:none;" type="submit" role="text"><a
												class="text-danger">Delete</a></button>
									{{ Form::close() }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@else
					No sections available
				@endif
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-6">
		@isset($products)
			<div class="admin-block">
				<div class="admin-header">
					<h3>Products by: {{ $section->name }}</h3>
				</div>
				<div class="admin-body">
					@foreach($products as $product)
						<div class="section-prod-box mb-2">
							<div class="row">
								<div class="col-3 col-md-2">
									<div class="section-prod-header">
										<a href="{{ route("products.edit", $product->id) }}">
											<img width="100%" src="{{ $product->getCoverImgMin() }}" alt="product image">
										</a>
									</div>
								</div>
								<div class="col-10 col-md-9">
									<div class="section-prod-body">
										<a href="{{ route("products.edit", $product->id) }}"><p>{{ $product->name }}</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					@endisset
				</div>
			</div>
	</div>
@endsection
