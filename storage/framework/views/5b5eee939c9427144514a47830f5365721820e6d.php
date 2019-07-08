<?php $__env->startSection("title", "Login"); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-12">
				<div class="card">
					<div class="card-header"><?php echo e(__('Login')); ?></div>

					<div class="card-body">
						<?php echo e(Form::open(array('url' => route("login"), "method"=>"post"))); ?>

						<div class="row">
							<div class="col-md-7">
								<div class="form-group row">
									<?php echo e(Form::label('email', 'E-Mail Address', ['class' => 'col-sm-4 col-form-label text-md-right'])); ?>

									<div class="col-md-7">
										<?php echo e(Form::text("email", "", ["class"=>"form-control $errors->has('email') ? ' is-invalid' : ''", "required"=>"required"])); ?>

									</div>
									<?php if($errors->has('email')): ?>
										<span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
									<?php endif; ?>
								</div>


								<div class="form-group row">
									<?php echo e(Form::label('password', 'Password', ['class' => 'col-sm-4 col-form-label text-md-right'])); ?>

									<div class="col-md-7">
										<?php echo e(Form::password("password", ["class"=>"form-control $errors->has('password') ? ' is-invalid' : ''", "required"=>"required"])); ?>

									</div>
									<?php if($errors->has('password')): ?>
										<span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
									<?php endif; ?>
								</div>

								<div class="form-group row">
									<div class="col-md-7 offset-md-4">
										<div class="form-check">
											<?php echo e(Form::checkbox("remember", "", false, ["class"=>"form-check-input", "arial-label"=>"Login"])); ?>

											<?php echo e(Form::label("remember me", "Remember me", ["class"=>"form-check-label"])); ?>

										</div>
									</div>
								</div>
								<?php if($errors->has('email')): ?>
									<div class="form-group row">
										<div class="col-md-7 offset-md-4">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
										</div>
									</div>
								<?php endif; ?>
								<div class="form-group row  d-flex align-items-center justify-content-start mb-4">
									<div class="col-md-8 offset-md-4">
										<?php echo e(Form::button("Log in", ["class"=>"btn btn-primary btn-wave", "type"=>"submit"])); ?>

										<a href="<?php echo e(url("/")); ?>/password/reset" class="btn btn-link">Forgot Your
											Password?</a>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<h5 class="text-center my-4 mt-lg-0">Simply login with Google or Facebook</h5>
									<div class="col-11 col-md-12 col-lg-9 mx-auto">
										<a href="<?php echo e(url('/auth/google')); ?>"
										   class="btn btn-google d-flex btn-wave align-items-center
										    justify-content-start"
										data-additional-styles="dark">
											<img class="mr-2" height="30"
											     src="<?php echo e(asset("storage/images/googlelogo.png")); ?>" alt="">
											Login using Google
										</a>
									</div>
									<div class="col-11 col-md-12 col-lg-9 mx-auto">
										<a href="<?php echo e(url('/auth/facebook')); ?>"
										   class="btn btn-facebook d-flex btn-wave align-items-center justify-content-start">
											<img class="mr-2" height="30"
											     src="<?php echo e(asset("storage/images/facebooklogo.png")); ?>" alt="">
											Login using Facebook
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php echo e(Form::close()); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.flashlessapp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>