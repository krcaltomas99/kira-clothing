<?php $__env->startSection("title", "Change shipping address"); ?>

<?php $__env->startSection("content"); ?>

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						<?php echo $__env->make("inc.usermenu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<div class="rightmenu p-4">
						<h3 class="mb-3">Shipping address</h3>
						<?php if($user->shipping_address): ?>
							<?php echo e(Form::open(["url"=>route("users.updateShipping", $user->id), "method"=>"PUT", "enctype"=>"multipart/form-data"])); ?>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("city", "City", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="city" name="city" value="<?php echo e($user->shipping_address->city); ?>"
									       class="form-control <?php if($errors->has('city')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('city')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('city')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("address", "Address", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="address" name="address" value="<?php echo e($user->shipping_address->address); ?>"
									       class="form-control <?php if($errors->has('address')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('address')): ?>
										<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('address')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("country", "Country", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<select id="country" name="country" value="<?php echo e($user->shipping_address->country_code); ?>"
									        class="form-control <?php if($errors->has('country')): ?> is-invalid <?php endif; ?>">
										<option <?php if($user->shipping_address->country_code === "GB"): ?> selected <?php endif; ?> value="GB">United Kingdom</option>
										<option <?php if($user->shipping_address->country_code === "AL"): ?> selected <?php endif; ?> value="AL">Albania</option>
										<option <?php if($user->shipping_address->country_code === "AD"): ?> selected <?php endif; ?> value="AD">Andorra</option>
										<option <?php if($user->shipping_address->country_code === "AT"): ?> selected <?php endif; ?> value="AT">Austria</option>
										<option <?php if($user->shipping_address->country_code === "BY"): ?> selected <?php endif; ?> value="BY">Belarus</option>
										<option <?php if($user->shipping_address->country_code === "BE"): ?> selected <?php endif; ?> value="BE">Belgium</option>
										<option <?php if($user->shipping_address->country_code === "BA"): ?> selected <?php endif; ?> value="BA">Bosnia and Herzegovina</option>
										<option <?php if($user->shipping_address->country_code === "BG"): ?> selected <?php endif; ?> value="BG">Bulgaria</option>
										<option <?php if($user->shipping_address->country_code === "HR"): ?> selected <?php endif; ?> value="HR">Croatia (Hrvatska)</option>
										<option <?php if($user->shipping_address->country_code === "CY"): ?> selected <?php endif; ?> value="CY">Cyprus</option>
										<option <?php if($user->shipping_address->country_code === "CZ"): ?> selected <?php endif; ?> value="CZ">Czech Republic</option>
										<option <?php if($user->shipping_address->country_code === "FR"): ?> selected <?php endif; ?> value="FR">France</option>
										<option <?php if($user->shipping_address->country_code === "GI"): ?> selected <?php endif; ?> value="GI">Gibraltar</option>
										<option <?php if($user->shipping_address->country_code === "DE"): ?> selected <?php endif; ?> value="DE">Germany</option>
										<option <?php if($user->shipping_address->country_code === "GR"): ?> selected <?php endif; ?> value="GR">Greece</option>
										<option <?php if($user->shipping_address->country_code === "VA"): ?> selected <?php endif; ?> value="VA">Holy See (Vatican City State)</option>
										<option <?php if($user->shipping_address->country_code === "HU"): ?> selected <?php endif; ?> value="HU">Hungary</option>
										<option <?php if($user->shipping_address->country_code === "IT"): ?> selected <?php endif; ?> value="IT">Italy</option>
										<option <?php if($user->shipping_address->country_code === "LI"): ?> selected <?php endif; ?> value="LI">Liechtenstein</option>
										<option <?php if($user->shipping_address->country_code === "LU"): ?> selected <?php endif; ?> value="LU">Luxembourg</option>
										<option <?php if($user->shipping_address->country_code === "MK"): ?> selected <?php endif; ?> value="MK">Macedonia</option>
										<option <?php if($user->shipping_address->country_code === "MT"): ?> selected <?php endif; ?> value="MT">Malta</option>
										<option <?php if($user->shipping_address->country_code === "MD"): ?> selected <?php endif; ?> value="MD">Moldova</option>
										<option <?php if($user->shipping_address->country_code === "MC"): ?> selected <?php endif; ?> value="MC">Monaco</option>
										<option <?php if($user->shipping_address->country_code === "ME"): ?> selected <?php endif; ?> value="ME">Montenegro</option>
										<option <?php if($user->shipping_address->country_code === "NL"): ?> selected <?php endif; ?> value="NL">Netherlands</option>
										<option <?php if($user->shipping_address->country_code === "PL"): ?> selected <?php endif; ?> value="PL">Poland</option>
										<option <?php if($user->shipping_address->country_code === "PT"): ?> selected <?php endif; ?> value="PT">Portugal</option>
										<option <?php if($user->shipping_address->country_code === "RO"): ?> selected <?php endif; ?> value="RO">Romania</option>
										<option <?php if($user->shipping_address->country_code === "SM"): ?> selected <?php endif; ?> value="SM">San Marino</option>
										<option <?php if($user->shipping_address->country_code === "RS"): ?> selected <?php endif; ?> value="RS">Serbia</option>
										<option <?php if($user->shipping_address->country_code === "SK"): ?> selected <?php endif; ?> value="SK">Slovakia</option>
										<option <?php if($user->shipping_address->country_code === "SI"): ?> selected <?php endif; ?> value="SI">Slovenia</option>
										<option <?php if($user->shipping_address->country_code === "ES"): ?> selected <?php endif; ?> value="ES">Spain</option>
										<option <?php if($user->shipping_address->country_code === "UA"): ?> selected <?php endif; ?> value="UA">Ukraine</option>
										<option <?php if($user->shipping_address->country_code === "DK"): ?> selected <?php endif; ?> value="DK">Denmark</option>
										<option <?php if($user->shipping_address->country_code === "EE"): ?> selected <?php endif; ?> value="EE">Estonia</option>
										<option <?php if($user->shipping_address->country_code === "FO"): ?> selected <?php endif; ?> value="FO">Faroe Islands</option>
										<option <?php if($user->shipping_address->country_code === "FI"): ?> selected <?php endif; ?> value="FI">Finland</option>
										<option <?php if($user->shipping_address->country_code === "GL"): ?> selected <?php endif; ?> value="GL">Greenland</option>
										<option <?php if($user->shipping_address->country_code === "IS"): ?> selected <?php endif; ?> value="IS">Iceland</option>
										<option <?php if($user->shipping_address->country_code === "IE"): ?> selected <?php endif; ?> value="IE">Ireland</option>
										<option <?php if($user->shipping_address->country_code === "LV"): ?> selected <?php endif; ?> value="LV">Latvia</option>
										<option <?php if($user->shipping_address->country_code === "LT"): ?> selected <?php endif; ?> value="LT">Lithuania</option>
										<option <?php if($user->shipping_address->country_code === "NO"): ?> selected <?php endif; ?> value="NO">Norway</option>
										<option <?php if($user->shipping_address->country_code === "SJ"): ?> selected <?php endif; ?> value="SJ">Svalbard and Jan Mayen Islands</option>
										<option <?php if($user->shipping_address->country_code === "SE"): ?> selected <?php endif; ?> value="SE">Sweden</option>
										<option <?php if($user->shipping_address->country_code === "CH"): ?> selected <?php endif; ?> value="CH">Switzerland</option>
										<option <?php if($user->shipping_address->country_code === "TR"): ?> selected <?php endif; ?> value="TR">Turkey</option>
									</select>
									<?php if($errors->has('country')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('country')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("psc", "Postal code", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="psc" name="psc" value="<?php echo e($user->shipping_address->postal_code); ?>"
									       class="form-control <?php if($errors->has('psc')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('psc')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('psc')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("state", "State", ["class"=>"col-sm-3 col-form-label text-md-right"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="state" name="state" value="<?php echo e($user->shipping_address->state); ?>"
									       class="form-control <?php if($errors->has('state')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('state')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('state')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("tel", "Phone", ["class"=>"col-sm-3 col-form-label text-md-right"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="tel" name="tel" value="<?php echo e($user->shipping_address->phone); ?>"
									       class="form-control <?php if($errors->has('tel')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('tel')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('tel')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="row">
								<div class="col-11">
									<?php echo e(Form::submit("Update", ["class"=>"btn-wave d-block btn btn-primary ml-auto"])); ?>

								</div>
							</div>

							<?php echo e(Form::close()); ?>


						<?php else: ?>

							<?php echo e(Form::open(["url"=>route("users.storeShipping", $user->id), "method"=>"post", "class"=>"user-shipping"])); ?>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("city", "City", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="city" name="city" value="<?php echo e(old("city")); ?>"
									       class="form-control <?php if($errors->has('city')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('city')): ?>
										<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('city')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("address", "Address", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="address" name="address" value="<?php echo e(old("address")); ?>"
									       class="form-control <?php if($errors->has('address')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('address')): ?>
										<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('address')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("country", "Country", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<select id="country" name="country" value="<?php echo e(old("country")); ?>"
									        class="form-control <?php if($errors->has('country')): ?> is-invalid <?php endif; ?>">
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
									<?php if($errors->has('country')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('country')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("psc", "Postal code", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="psc" name="psc" value="<?php echo e(old("psc")); ?>"
									       class="form-control <?php if($errors->has('psc')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('psc')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('psc')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("state", "State", ["class"=>"col-sm-3 col-form-label text-md-right"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="state" name="state" value="<?php echo e(old("state")); ?>"
									       class="form-control <?php if($errors->has('state')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('state')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('state')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mt-4">
								<?php echo e(Form::label("tel", "Phone", ["class"=>"col-sm-3 col-form-label text-md-right"])); ?>


								<div class="col-sm-8 col-12">
									<input type="text" id="tel" name="tel" value="<?php echo e(old("tel")); ?>"
									       class="form-control <?php if($errors->has('tel')): ?> is-invalid <?php endif; ?>">
									<?php if($errors->has('tel')): ?>
										<span class="invalid-feedback d-block" role="alert">
											<strong><?php echo e($errors->first('tel')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="row">
								<div class="col-11">
									<?php echo e(Form::submit("Update", ["class"=>"btn-wave d-block btn btn-primary ml-auto"])); ?>

								</div>
							</div>
							<?php echo e(Form::close()); ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>