<?php $__env->startSection('title', 'Page Not Found'); ?>

<?php $__env->startSection("content"); ?>
	<div class="container mt-4">
		<div class="row">
			<div class="col-12 pt-4">
				<h3 class="text-center">The page you are looking for could not be found.</h3>
				<a class="text-center d-block" href="<?php echo e(route("home")); ?>">Go home</a>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>