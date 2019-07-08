@if (session('status'))
	<div class="container-full alert alert-info alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Status</strong>
					<p>{{session("status")}}</p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
@endif

@if(session("success"))
	<div class="container-full alert alert-success alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Success</strong>
					<p>{{session("success")}}</p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
@endif

@if(session("error"))
	<div class="container-full alert alert-danger alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Error!</strong>
					<p>{{session("error")}}</p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
@endif

@if(session("warning"))
	<div class="container-full alert alert-warning alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Warning</strong>
					<p>{{session("warning")}}</p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
@endif