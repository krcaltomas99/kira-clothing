@extends("layouts.app")

@section("title", "Change shipping address")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						@include("inc.usermenu")
					</div>
					<div class="rightmenu p-4">
						<h3 class="mb-3">Shipping address</h3>
						@if($user->shipping_address)
							{{ Form::open(["url"=>route("users.updateShipping", $user->id), "method"=>"PUT", "enctype"=>"multipart/form-data"]) }}
							<div class="form-group row mt-4">
								{{ Form::label("city", "City", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="city" name="city" value="{{ $user->shipping_address->city }}"
									       class="form-control @if($errors->has('city')) is-invalid @endif">
									@if ($errors->has('city'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('city') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("address", "Address", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="address" name="address" value="{{ $user->shipping_address->address }}"
									       class="form-control @if($errors->has('address')) is-invalid @endif">
									@if ($errors->has('address'))
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('address') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("country", "Country", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<select id="country" name="country" value="{{ $user->shipping_address->country_code }}"
									        class="form-control @if($errors->has('country')) is-invalid @endif">
										<option @if($user->shipping_address->country_code === "GB") selected @endif value="GB">United Kingdom</option>
										<option @if($user->shipping_address->country_code === "AL") selected @endif value="AL">Albania</option>
										<option @if($user->shipping_address->country_code === "AD") selected @endif value="AD">Andorra</option>
										<option @if($user->shipping_address->country_code === "AT") selected @endif value="AT">Austria</option>
										<option @if($user->shipping_address->country_code === "BY") selected @endif value="BY">Belarus</option>
										<option @if($user->shipping_address->country_code === "BE") selected @endif value="BE">Belgium</option>
										<option @if($user->shipping_address->country_code === "BA") selected @endif value="BA">Bosnia and Herzegovina</option>
										<option @if($user->shipping_address->country_code === "BG") selected @endif value="BG">Bulgaria</option>
										<option @if($user->shipping_address->country_code === "HR") selected @endif value="HR">Croatia (Hrvatska)</option>
										<option @if($user->shipping_address->country_code === "CY") selected @endif value="CY">Cyprus</option>
										<option @if($user->shipping_address->country_code === "CZ") selected @endif value="CZ">Czech Republic</option>
										<option @if($user->shipping_address->country_code === "FR") selected @endif value="FR">France</option>
										<option @if($user->shipping_address->country_code === "GI") selected @endif value="GI">Gibraltar</option>
										<option @if($user->shipping_address->country_code === "DE") selected @endif value="DE">Germany</option>
										<option @if($user->shipping_address->country_code === "GR") selected @endif value="GR">Greece</option>
										<option @if($user->shipping_address->country_code === "VA") selected @endif value="VA">Holy See (Vatican City State)</option>
										<option @if($user->shipping_address->country_code === "HU") selected @endif value="HU">Hungary</option>
										<option @if($user->shipping_address->country_code === "IT") selected @endif value="IT">Italy</option>
										<option @if($user->shipping_address->country_code === "LI") selected @endif value="LI">Liechtenstein</option>
										<option @if($user->shipping_address->country_code === "LU") selected @endif value="LU">Luxembourg</option>
										<option @if($user->shipping_address->country_code === "MK") selected @endif value="MK">Macedonia</option>
										<option @if($user->shipping_address->country_code === "MT") selected @endif value="MT">Malta</option>
										<option @if($user->shipping_address->country_code === "MD") selected @endif value="MD">Moldova</option>
										<option @if($user->shipping_address->country_code === "MC") selected @endif value="MC">Monaco</option>
										<option @if($user->shipping_address->country_code === "ME") selected @endif value="ME">Montenegro</option>
										<option @if($user->shipping_address->country_code === "NL") selected @endif value="NL">Netherlands</option>
										<option @if($user->shipping_address->country_code === "PL") selected @endif value="PL">Poland</option>
										<option @if($user->shipping_address->country_code === "PT") selected @endif value="PT">Portugal</option>
										<option @if($user->shipping_address->country_code === "RO") selected @endif value="RO">Romania</option>
										<option @if($user->shipping_address->country_code === "SM") selected @endif value="SM">San Marino</option>
										<option @if($user->shipping_address->country_code === "RS") selected @endif value="RS">Serbia</option>
										<option @if($user->shipping_address->country_code === "SK") selected @endif value="SK">Slovakia</option>
										<option @if($user->shipping_address->country_code === "SI") selected @endif value="SI">Slovenia</option>
										<option @if($user->shipping_address->country_code === "ES") selected @endif value="ES">Spain</option>
										<option @if($user->shipping_address->country_code === "UA") selected @endif value="UA">Ukraine</option>
										<option @if($user->shipping_address->country_code === "DK") selected @endif value="DK">Denmark</option>
										<option @if($user->shipping_address->country_code === "EE") selected @endif value="EE">Estonia</option>
										<option @if($user->shipping_address->country_code === "FO") selected @endif value="FO">Faroe Islands</option>
										<option @if($user->shipping_address->country_code === "FI") selected @endif value="FI">Finland</option>
										<option @if($user->shipping_address->country_code === "GL") selected @endif value="GL">Greenland</option>
										<option @if($user->shipping_address->country_code === "IS") selected @endif value="IS">Iceland</option>
										<option @if($user->shipping_address->country_code === "IE") selected @endif value="IE">Ireland</option>
										<option @if($user->shipping_address->country_code === "LV") selected @endif value="LV">Latvia</option>
										<option @if($user->shipping_address->country_code === "LT") selected @endif value="LT">Lithuania</option>
										<option @if($user->shipping_address->country_code === "NO") selected @endif value="NO">Norway</option>
										<option @if($user->shipping_address->country_code === "SJ") selected @endif value="SJ">Svalbard and Jan Mayen Islands</option>
										<option @if($user->shipping_address->country_code === "SE") selected @endif value="SE">Sweden</option>
										<option @if($user->shipping_address->country_code === "CH") selected @endif value="CH">Switzerland</option>
										<option @if($user->shipping_address->country_code === "TR") selected @endif value="TR">Turkey</option>
									</select>
									@if ($errors->has('country'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('country') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("psc", "Postal code", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="psc" name="psc" value="{{ $user->shipping_address->postal_code }}"
									       class="form-control @if($errors->has('psc')) is-invalid @endif">
									@if ($errors->has('psc'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('psc') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("state", "State", ["class"=>"col-sm-3 col-form-label text-md-right"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="state" name="state" value="{{ $user->shipping_address->state }}"
									       class="form-control @if($errors->has('state')) is-invalid @endif">
									@if ($errors->has('state'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('state') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("tel", "Phone", ["class"=>"col-sm-3 col-form-label text-md-right"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="tel" name="tel" value="{{ $user->shipping_address->phone }}"
									       class="form-control @if($errors->has('tel')) is-invalid @endif">
									@if ($errors->has('tel'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('tel') }}</strong>
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

						@else

							{{ Form::open(["url"=>route("users.storeShipping", $user->id), "method"=>"post", "class"=>"user-shipping"]) }}
							<div class="form-group row mt-4">
								{{ Form::label("city", "City", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="city" name="city" value="{{ old("city") }}"
									       class="form-control @if($errors->has('city')) is-invalid @endif">
									@if ($errors->has('city'))
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('city') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("address", "Address", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="address" name="address" value="{{ old("address") }}"
									       class="form-control @if($errors->has('address')) is-invalid @endif">
									@if ($errors->has('address'))
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $errors->first('address') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("country", "Country", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<select id="country" name="country" value="{{ old("country") }}"
									        class="form-control @if($errors->has('country')) is-invalid @endif">
										<option value="GB">United Kingdom</option>
										<option value="AL">Albania</option>
										<option value="AD">Andorra</option>
										<option value="AT">Austria</option>
										<option value="BY">Belarus</option>
										<option value="BE">Belgium</option>
										<option value="BA">Bosnia and Herzegovina</option>
										<option value="BG">Bulgaria</option>
										<option value="HR">Croatia (Hrvatska)</option>
										<option value="CY">Cyprus</option>
										<option value="CZ">Czech Republic</option>
										<option value="FR">France</option>
										<option value="GI">Gibraltar</option>
										<option value="DE">Germany</option>
										<option value="GR">Greece</option>
										<option value="VA">Holy See (Vatican City State)</option>
										<option value="HU">Hungary</option>
										<option value="IT">Italy</option>
										<option value="LI">Liechtenstein</option>
										<option value="LU">Luxembourg</option>
										<option value="MK">Macedonia</option>
										<option value="MT">Malta</option>
										<option value="MD">Moldova</option>
										<option value="MC">Monaco</option>
										<option value="ME">Montenegro</option>
										<option value="NL">Netherlands</option>
										<option value="PL">Poland</option>
										<option value="PT">Portugal</option>
										<option value="RO">Romania</option>
										<option value="SM">San Marino</option>
										<option value="RS">Serbia</option>
										<option value="SK">Slovakia</option>
										<option value="SI">Slovenia</option>
										<option value="ES">Spain</option>
										<option value="UA">Ukraine</option>
										<option value="DK">Denmark</option>
										<option value="EE">Estonia</option>
										<option value="FO">Faroe Islands</option>
										<option value="FI">Finland</option>
										<option value="GL">Greenland</option>
										<option value="IS">Iceland</option>
										<option value="IE">Ireland</option>
										<option value="LV">Latvia</option>
										<option value="LT">Lithuania</option>
										<option value="NO">Norway</option>
										<option value="SJ">Svalbard and Jan Mayen Islands</option>
										<option value="SE">Sweden</option>
										<option value="CH">Switzerland</option>
										<option value="TR">Turkey</option>
									</select>
									@if ($errors->has('country'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('country') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("psc", "Postal code", ["class"=>"col-sm-3 col-form-label text-md-right required"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="psc" name="psc" value="{{ old("psc") }}"
									       class="form-control @if($errors->has('psc')) is-invalid @endif">
									@if ($errors->has('psc'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('psc') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("state", "State", ["class"=>"col-sm-3 col-form-label text-md-right"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="state" name="state" value="{{ old("state") }}"
									       class="form-control @if($errors->has('state')) is-invalid @endif">
									@if ($errors->has('state'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('state') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mt-4">
								{{ Form::label("tel", "Phone", ["class"=>"col-sm-3 col-form-label text-md-right"]) }}

								<div class="col-sm-8 col-12">
									<input type="text" id="tel" name="tel" value="{{ old("tel") }}"
									       class="form-control @if($errors->has('tel')) is-invalid @endif">
									@if ($errors->has('tel'))
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $errors->first('tel') }}</strong>
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
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection