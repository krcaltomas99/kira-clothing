<?php $__env->startSection("title", "Change password"); ?>

<?php $__env->startSection("content"); ?>

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						<?php echo $__env->make("inc.usermenu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<div class="rightmenu p-4">
						<h3 class="mb-3">Manage your orders</h3>
						<?php echo e(Form::open(["url"=>route("users.updatePass", $user->id), "method"=>"PUT", "enctype"=>"multipart/form-data"])); ?>

						<div class="form-group row mt-4">
							<?php echo e(Form::label("old_pass", "Your password", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


							<div class="col-sm-8 col-12">
								<input type="password" id="old_pass" name="old_pass"
								       class="form-control <?php if($errors->has('old_pass')): ?> is-invalid <?php endif; ?>">
								<?php if($errors->has('old_pass')): ?>
									<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('old_pass')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group row mt-4">
							<?php echo e(Form::label("new_pass", "New password", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


							<div class="col-sm-8 col-12">
								<input type="password" id="new_pass" name="new_pass"
								       class="form-control <?php if($errors->has('new_pass')): ?> is-invalid <?php endif; ?>">
								<?php if($errors->has('new_pass')): ?>
									<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('new_pass')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group row mt-4">
							<?php echo e(Form::label("new_pass_check", "New password again", ["class"=>"col-sm-3 col-form-label text-md-right required"])); ?>


							<div class="col-sm-8 col-12">
								<input type="password" id="new_pass_check" name="new_pass_check"
								       class="form-control <?php if($errors->has('new_pass_check')): ?> is-invalid <?php endif; ?>">
								<?php if($errors->has('new_pass_check')): ?>
									<span class="invalid-feedback d-block" role="alert">
										<strong><?php echo e($errors->first('new_pass_check')); ?></strong>
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