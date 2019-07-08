<?php $__env->startSection("title", "Home"); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-full">
		<div class="hp-slider slider" id="hp-slider">
			<?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="slide">
					<div class="slide-darken"></div>
					<img src="<?php echo e($slide->getCoverImg()); ?>" alt="slide background">
					<div class="container">
						<h2><?php echo e($slide->heading); ?></h2>
						<p><?php echo e($slide->text); ?></p>
						<?php if($slide->hasDestination()): ?>
							<a href="<?php echo e(url("/") . $slide->url_dest); ?>">
								<button class="btn btn-primary">Go shopping</button>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-12 col-xl-10">
				<div class="card">
					<div class="card-header">Dashboard</div>

					<div class="card-body">
						<?php if(auth()->guard()->check()): ?>
							<h6>You are logged in!</h6>
						<?php endif; ?>

						<?php if(auth()->guard()->guest()): ?>
							<h6>You aren't logged in</h6>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>