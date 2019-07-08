@extends("layouts.admin")

@section("content")

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Edit user: {{ $user->name }}</h3>
				<p>Registered through {{ $user->isSocial() ? " ".$user->social->provider : " Kira Clothing" }}</p>
			</div>
			<div class="admin-body">

				{{ Form::open(["url"=>route("admin.users.update", $user->id), "class"=>"mt-3" ,"method"=>"PUT","enctype"=>"multipart/form-data"]) }}

				<div class="form-group row">
					{{ Form::label("name", "Name", ["class"=>"col-sm-3 col-form-label"]) }}
					<div class="col-sm-8">
						{{ Form::text("name", $user->name, ["class"=>"form-control"]) }}
					</div>
				</div>

				<div class="form-group row">
					{{ Form::label("email", "E-mail", ["class"=>"col-sm-3 col-form-label"]) }}
					<div class="col-sm-8">
						{{ Form::text("email", $user->email, ["class"=>"form-control"]) }}
					</div>
				</div>

				<div class="form-group row">
					{{ Form::label("role", "Role", ["class"=>"col-sm-3 col-form-control text-md-left"]) }}
					<div class="col-sm-8">
						<select class="ui dropdown form-control" name="role" id="">
							<option {{ $user->role == "superadmin" ? "selected" : "" }} value="superadmin">superadmin
							</option>
							<option {{ $user->role == "admin" ? "selected" : "" }} value="admin">admin</option>
							<option {{ $user->role == "emplyoee" ? "selected" : "" }} value="employee">employee</option>
							<option {{ $user->role == "customer" ? "selected" : "" }} value="customer">customer</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="cover_image"
					       class="col-sm-3 col-form-label text-md-left">Avatar</label>

					<div class="col-md-8 col-lg-7">
						<div class="row">
							<div class="col-12">
								<div class="avatar medium float-left">
									<img id="img_prev"
									     src="{{ $user->getAvatar() }}"
									     alt="avatar" width="32">
								</div>
								<label class="m-0 ml-2 clickable btn btn-blank text-primary"
								       for="cover_image">Upload</label>
								</button>
								<input data-target-id="img_prev" id="cover_image" type="file"
								       class="d-none preview" name="avatar-file"
								       accept="image/png,image/jpg, image/jpeg">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-11">
						{{ Form::submit("Update", ["class"=>"btn btn-primary ml-auto d-block"]) }}
					</div>
				</div>

				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection