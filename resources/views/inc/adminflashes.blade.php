@if(count($errors) > 0)
	<div class="row">
		<div class="col-12 pb-3">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Ooops...</strong>
				@foreach($errors->all() as $error)
					<p>{{$error}}</p>
				@endforeach
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
@endif


@if (session('status'))
	<div class="row">
		<div class="col-12 pb-3">
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<strong>Status</strong>
				<p>{{session("status")}}</p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
@endif

@if(session("success"))
	<div class="row">
		<div class="col-12 pb-3">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Hurray!</strong>
				<p>{{session("success")}}</p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
@endif

@if(session("error"))
	<div class="row">
		<div class="col-12 pb-3">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Oops...</strong>
				<p>{{session("error")}}</p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
@endif