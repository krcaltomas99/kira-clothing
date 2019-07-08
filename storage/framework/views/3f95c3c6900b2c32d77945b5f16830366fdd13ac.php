<?php $__env->startSection("title", "Change information"); ?>

<?php $__env->startSection("content"); ?>

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						<?php echo $__env->make("inc.usermenu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<div class="rightmenu p-4">
						<h3 class="mb-3">Profile information</h3>
						<?php echo e(Form::open(["url"=>route("users.update", $user->id), "method"=>"PUT", "enctype"=>"multipart/form-data"])); ?>

						<div class="form-group row mt-4">
							<?php echo e(Form::label("cover_image", "Avatar", ["class"=>"col-sm-3 col-form-label text-md-right"])); ?>

							<div class="col-sm-8 col-12">
								<div class="avatar avatar-reg medium float-left">
									<img src="<?php echo e($user->getAvatar()); ?>"
									     alt="avatar" width="32">
								</div>
								<?php echo e(Form::label("cover_image", "Upload", ["class"=>"m-0 ml-2 clickable btn btn-blank text-primary"])); ?>

								<a class="text-warning ml-2" href="<?php echo e(route("users.changeToDefault", $user->id)); ?>">Change to default</a>
								<input id="cover_image" type="file" class="d-none" name="cover_image"
								       accept="image/png,image/jpg, image/jpeg">
								<?php if($errors->has('cover_image')): ?>
									<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('cover_image')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group row">
							<?php echo e(Form::label("name", "Name", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>

							<div class="col-sm-8 col-12">
								<input type="text" id="name" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" name="name" value="<?php echo e($user->name); ?>">
								<?php if($errors->has('name')): ?>
									<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('name')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group row">
							<?php echo e(Form::label("email", "E-mail", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>

							<div class="col-sm-8 col-12">
								<input type="text" name="email" id="email" class="form-control <?php if($errors->has('email')): ?> is-invalid <?php endif; ?>" value="<?php echo e($user->email); ?>">
								<?php if($errors->has('email')): ?>
									<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('email')); ?></strong>
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

					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>