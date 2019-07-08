<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo e(config('app.name', 'Kira Clothing')); ?></title>

	<!-- Scripts -->
	<script src="<?php echo e(secure_asset("js/jq-v321.js")); ?>"></script>
	<script src="<?php echo e(secure_asset("js/app.js")); ?>"></script>
	<script src="<?php echo e(secure_asset("js/admin.js")); ?>"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">

	<!-- Styles -->
	<link href="<?php echo e(secure_asset('css/app.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(secure_asset('css/admin.css')); ?>" rel="stylesheet">

</head>
<body>
<div id="app">
	<main class="container py-4">
		<div class="row justify-content-center">
			<div style="max-width: 296px;width:296px;" class="mt-xl-5 pt-xl-5 admin-login">
				<h2 class="brand-heading text-center mb-3">Kira Admin</h2>
				<?php if($errors->count() > 0): ?>
					<div class="container-full alert alert-danger alert-dismissible fade show" role="danger">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<strong>Error</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<p><?php echo e($error); ?></p>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="card">
					<div class="card-header"><?php echo e(__('Admin login')); ?></div>

					<div class="card-body">
						<?php echo e(Form::open(array('url' => route("login"), "method"=>"post"))); ?>

						<div class="form-group">
							<?php echo e(Form::label('email', 'E-Mail Address', ['class' => ''])); ?>

							<?php echo e(Form::text("email", "", ["class"=>"form-control", "required"=>"required"])); ?>

						</div>

						<div class="form-group">
							<?php echo e(Form::label('password', 'Password', ['class' => ''])); ?>

							<?php echo e(Form::password("password", ["class"=>"form-control", "required"=>"required"])); ?>

						</div>

						<div class="form-group">
							<div class="form-check">
								<?php echo e(Form::checkbox("remember", "", false, ["class"=>"form-check-input", "arial-label"=>"Login"])); ?>

								<?php echo e(Form::label("remember me", "Remember me", ["class"=>"form-check-label"])); ?>

							</div>
						</div>
						<div class="form-group">
							<?php echo e(Form::submit("Log in", ["class"=>"btn btn-primary"])); ?>

						</div>
						<div class="form-group mb-0">
							<a href="<?php echo e(url('/adminauth/google')); ?>"
							   class="mb-0 btn btn-google d-flex align-items-center justify-content-start">
								<img class="mr-2" height="30" src="<?php echo e(secure_asset("storage/images/googlelogo.png")); ?>"
								     alt="">
								Login using Google
							</a>
						</div>
						<?php echo e(Form::close()); ?>

					</div>
				</div>
			</div>
		</div>
	</main>
</div>
</body>
</html>




