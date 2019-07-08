<?php $__env->startSection("title", "Slider"); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class=" float-left">Slider</h3>
				<a class="float-right" href="<?php echo e(route("sliders.create")); ?>">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">
				<?php if(count($slides) > 0): ?>
					<table class="table stackable ui col-12 sortable">
						<thead>
						<tr>
							<th><a data-sortable="id" href="<?php echo e(url()->current()); ?>">ID</a></th>
							<th><a data-sortable="heading" href="<?php echo e(url()->current()); ?>">Heading</a></th>
							<th><a data-sortable="text" href="<?php echo e(url()->current()); ?>">Text</a></th>
							<th><a data-sortable="clicks" href="<?php echo e(url()->current()); ?>">Clicks</a></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($slide->id); ?></td>
								<td><?php echo e($slide->heading); ?></td>
								<td><?php echo e($slide->text); ?></td>
								<td><?php echo e($slide->clicks); ?></td>
								<td>
									<?php echo e(Form::open(["url"=>route("sliders.changeActive", $slide->id), "method"=>"put"])); ?>

									<button type="submit" style="background:none;border:none;" role="button"
									        class="<?php if($slide->isActive()): ?> ? text-secondary : text-success <?php endif; ?>">
										Active
									</button>
									<?php echo e(Form::close()); ?>

								</td>
								<td><a href="<?php echo e(route("sliders.edit", $slide->id)); ?>">Edit</a></td>
								<td>
									<?php echo e(Form::open(["url"=>route("sliders.destroy", $slide->id), "method"=>"delete","enctype"=>"multipart/form-data"])); ?>

									<button onclick="return confirm('Are you sure?')"
									        style="background:none;border:none;"
									        type="submit" role="text"><a class="text-danger">Delete</a></button>
									<?php echo e(Form::close()); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Active slides</h3>
			</div>
			<div class="admin-body">
				<div class="slides">
					<?php $__currentLoopData = $activeSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activeSlide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div data-id="<?php echo e($activeSlide->id); ?>"
						     class="slide d-flex align-items-center justify-content-center"
						     style="background-image: url(<?php echo e($activeSlide->getCoverImg()); ?>)">
							<p class="text-white"><?php echo e($activeSlide->heading); ?></p>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="admin-block">
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>