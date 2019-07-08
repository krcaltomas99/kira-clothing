@extends("layouts.app")

@section('title', 'Page Not Found')

@section("content")
	<div class="container mt-4">
		<div class="row">
			<div class="col-12 pt-4">
				<h3 class="text-center">The page you are looking for could not be found.</h3>
				<a class="text-center d-block" href="{{ route("home") }}">Go home</a>
			</div>
		</div>
	</div>
@endsection