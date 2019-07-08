@extends("layouts.app")

@section("title", "Change information")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						@include("inc.usermenu")
					</div>
					<div class="rightmenu p-4">
						<h3 class="mb-3">Profile information</h3>
						{{ Form::open(["url"=>route("users.update", $user->id), "method"=>"PUT", "enctype"=>"multipart/form-data"]) }}
						<div class="form-group row mt-4">
							{{ Form::label("cover_image", "Avatar", ["class"=>"col-sm-3 col-form-label text-md-right"]) }}
							<div class="col-sm-8 col-12">
								<div class="avatar avatar-reg medium float-left">
									<img src="{{ $user->getAvatar() }}"
									     alt="avatar" width="32">
								</div>
								{{ Form::label("cover_image", "Upload", ["class"=>"m-0 ml-2 clickable btn btn-blank text-primary"]) }}
								<a class="text-warning ml-2" href="{{ route("users.changeToDefault", $user->id) }}">Change to default</a>
								<input id="cover_image" type="file" class="d-none" name="cover_image"
								       accept="image/png,image/jpg, image/jpeg">
								@if ($errors->has('cover_image'))
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('cover_image') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							{{ Form::label("name", "Name", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}
							<div class="col-sm-8 col-12">
								<input type="text" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ $user->name }}">
								@if ($errors->has('name'))
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							{{ Form::label("email", "E-mail", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}
							<div class="col-sm-8 col-12">
								<input type="text" name="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{ $user->email }}">
								@if ($errors->has('email'))
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
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