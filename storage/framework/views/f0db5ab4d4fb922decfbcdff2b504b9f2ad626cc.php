<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger alert-dismissible fade show mt-4" role="danger">
		<strong>Oh no!</strong> <br>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<p><?php echo e($error); ?></p>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<?php if(session('status')): ?>
	<div class="alert alert-info alert-dismissible fade show" role="danger">
		<strong>Yay!</strong> <p><?php echo e(session("status")); ?></p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<?php if(session("success")): ?>
	<div class="alert alert-success alert-dismissible fade show" role="danger">
		<strong>Hurray!</strong> <p><?php echo e(session("success")); ?></p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<?php if(session("error")): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="danger">
		<strong>Oh no!</strong> <p><?php echo e(session("error")); ?></p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>