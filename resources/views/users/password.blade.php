@extends("layouts.app")

@section("title", "Change password")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						@include("inc.usermenu")
					</div>
					<div class="rightmenu p-4">
						<h3 class="mb-3">Manage your orders</h3>
						{{ Form::open(["url"=>route("users.updatePass", $user->id), "method"=>"PUT", "enctype"=>"multipart/form-data"]) }}
						<div class="form-group row mt-4">
							{{ Form::label("old_pass", "Your password", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

							<div class="col-sm-8 col-12">
								<input type="password" id="old_pass" name="old_pass"
								       class="form-control @if($errors->has('old_pass')) is-invalid @endif">
								@if ($errors->has('old_pass'))
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('old_pass') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row mt-4">
							{{ Form::label("new_pass", "New password", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

							<div class="col-sm-8 col-12">
								<input type="password" id="new_pass" name="new_pass"
								       class="form-control @if($errors->has('new_pass')) is-invalid @endif">
								@if ($errors->has('new_pass'))
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('new_pass') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row mt-4">
							{{ Form::label("new_pass_check", "New password again", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

							<div class="col-sm-8 col-12">
								<input type="password" id="new_pass_check" name="new_pass_check"
								       class="form-control @if($errors->has('new_pass_check')) is-invalid @endif">
								@if ($errors->has('new_pass_check'))
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('new_pass_check') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="row">
							<div class="col-11">
								{{ Form::submit("Update", ["class"=>"btn-wave d-block btn btn-primary ml-auto"]) }}
							</div>
						</div>

						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
