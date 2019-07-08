@extends('layouts.flashlessapp')

@section("title", "Login")

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-12">
				<div class="card">
					<div class="card-header">{{ __('Login') }}</div>

					<div class="card-body">
						{{ Form::open(array('url' => route("login"), "method"=>"post")) }}
						<div class="row">
							<div class="col-md-7">
								<div class="form-group row">
									{{ Form::label('email', 'E-Mail Address', ['class' => 'col-sm-4 col-form-label text-md-right']) }}
									<div class="col-md-7">
										{{ Form::text("email", "", ["class"=>"form-control $errors->has('email') ? ' is-invalid' : ''", "required"=>"required"]) }}
									</div>
									@if ($errors->has('email'))
										<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>


								<div class="form-group row">
									{{ Form::label('password', 'Password', ['class' => 'col-sm-4 col-form-label text-md-right']) }}
									<div class="col-md-7">
										{{ Form::password("password", ["class"=>"form-control $errors->has('password') ? ' is-invalid' : ''", "required"=>"required"]) }}
									</div>
									@if ($errors->has('password'))
										<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
									@endif
								</div>
								@if ($errors->has('email'))
									<div class="form-group row">
										<div class="col-md-7 offset-md-4">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
										</div>
									</div>
								@endif
								<div class="form-group row">
									<div class="col-md-7 offset-md-4">
										<div class="form-check">
											{{ Form::checkbox("remember", "remember",false, ["class"=>"form-check-input", "arial-label"=>"Login", "id"=>"remember"]) }}
											{{ Form::label("remember", "Remember me", ["class"=>"form-check-label"]) }}
										</div>
									</div>
								</div>
								<div class="form-group row  d-flex align-items-center justify-content-start mb-4">
									<div class="col-md-8 offset-md-4">
										{{ Form::button("Log in", ["class"=>"btn btn-primary btn-wave", "type"=>"submit"]) }}
										<a href="{{ url("/") }}/password/reset" class="btn btn-link">Forgot Your
											Password?</a>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-8 offset-md-4">
										<a href="{{ route("register") }}">{{ __("Don't have an account? Register now.") }}</a>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<h5 class="text-center my-4 mt-lg-0">Simply login with Google or Facebook</h5>
									<div class="col-11 col-md-12 col-lg-9 mx-auto">
										<a href="{{ url('/auth/google') }}"
										   class="btn btn-google d-flex btn-wave align-items-center
										    justify-content-start"
										   data-additional-styles="dark">
											<img class="mr-2" height="30"
											     src="{{ secure_asset("storage/images/googlelogo.png") }}" alt="">
											Login using Google
										</a>
									</div>
									<div class="col-11 col-md-12 col-lg-9 mx-auto">
										<a href="{{ url('/auth/facebook') }}"
										   class="btn btn-facebook d-flex btn-wave align-items-center justify-content-start">
											<img class="mr-2" height="30"
											     src="{{ secure_asset("storage/images/facebooklogo.png") }}" alt="">
											Login using Facebook
										</a>
									</div>
								</div>
							</div>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
