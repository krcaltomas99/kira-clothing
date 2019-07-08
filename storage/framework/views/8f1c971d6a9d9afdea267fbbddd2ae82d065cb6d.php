<?php $__env->startSection('content'); ?>
	<div class="col-md-10">
		<h3>Dashboard</h3>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>