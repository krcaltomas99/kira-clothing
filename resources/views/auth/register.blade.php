@extends('layouts.flashlessapp')

@section("title", "Sign up")

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-sm-12">
				<div class="card card-primary">
					<div class="card-header">{{ __('Sign up') }}</div>

					<div class="card-body">
						<form class="" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
						      aria-label="{{ __('Sign up') }}">
							@csrf
							<div class="row">
								<div class="col-md-7 col-12">
									<div class="form-group row">
										<label for="name"
										       class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

										<div class="col-md-8 col-lg-7">
											<input id="name" type="text"
											       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
											       name="name" value="{{ old('name') }}" required autofocus>

											@if ($errors->has('name'))
												<span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
											@endif
										</div>
									</div>

									<div class="form-group row">
										<label for="email"
										       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

										<div class="col-md-8 col-lg-7">
											<input id="email" type="email"
											       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
											       name="email" value="{{ old('email') }}" required>

											@if ($errors->has('email'))
												<span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
											@endif
										</div>
									</div>

									<div class="form-group row">
										<label for="password"
										       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

										<div class="col-md-8 col-lg-7">
											<input id="password" type="password"
											       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
											       name="password" required>
											<small id="emailHelp" class="form-text text-muted">Minimum 6 characters
											</small>
											@if ($errors->has('password'))
												<span class="invalid-feedback" role="alert">
													<strong>{{ $errors->first('password') }}</strong>
												</span>
											@endif
										</div>
									</div>

									<div class="form-group row">
										<label for="password-confirm"
										       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

										<div class="col-md-8 col-lg-7">
											<input id="password-confirm" type="password" class="form-control"
											       name="password_confirmation" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="cover_image"
										       class="col-md-4 col-form-label text-md-right">Avatar</label>

										<div class="col-md-8 col-lg-7">
											<div class="row">
												<div class="col-12">
													<div class="avatar avatar-reg medium float-left">
														<img id="img_prev"
														     src="{{ secure_asset("storage/userAvatars/user.png") }}"
														     alt="avatar" width="32">
													</div>
													<label class="m-0 ml-2 clickable btn btn-blank text-primary"
													       for="cover_image">Upload</label>
													<input data-target-id="img_prev" id="cover_image" type="file"
													       class="d-none preview" name="avatar-file"
													       accept="image/png,image/jpg, image/jpeg">
												</div>
												@if ($errors->has('avatar-file'))
													<div class="col-12">
	                                                    <span class="invalid-feedback d-block" role="alert">
	                                                        <strong>{{ $errors->first('avatar-file') }}</strong>
	                                                    </span>
													</div>
												@endif
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-8 offset-md-4">
											<button style="display: block;" type="submit"
											        class="btn btn-wave btn-primary">
												{{ __('Register') }}
											</button>
										</div>
									</div>

									<div class="form-group row mb-0">
										<div class="col-md-8 offset-md-4">
											<a href="{{ route("login") }}">{{ __("Already have an account? Log in.") }}</a>
										</div>
									</div>
								</div>
								<div class="col-md-5 col-12 register-left ">
									<div class="form-group row">
										<div class="col-12">
											<h5 class="text-center my-4 mt-lg-0">Sign up with Google or Facebook and
												we'll
												do the rest</h5>
											<div class="row">
												<div class="col-12 col-sm-10 col-md-12 col-lg-9 mx-auto">
													<a href="{{ url('/auth/google') }}"
													   class="btn btn-wave btn-google d-flex align-items-center justify-content-start"
													   data-additional-styles="dark">
														<img class="mr-2" height="30"
														     src="{{ secure_asset("storage/images/googlelogo.png") }}" alt="">
														Sign up using Google
													</a>
													<a href="{{ url('/auth/facebook') }}"
													   class="btn btn-wave btn-facebook d-flex align-items-center justify-content-start">
														<img class="mr-2" height="30"
														     src="{{ secure_asset("storage/images/facebooklogo.png") }}"
														     alt="">
														Sign up using Facebook
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
