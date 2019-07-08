<?php $__env->startSection("title", "Slider"); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class=" float-left">List of slides</h3>
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
					<table class="table stackable ui col-12">
						<thead>
						<tr>
							<th>ID</th>
							<th>Heading</th>
							<th>Text</th>
							<th>Cover image</th>
							<th>Clicks</th>
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
								<td><?php echo e($slide->cover_img); ?></td>
								<td><?php echo e($slide->clicks); ?></td>
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
				<h3>Most popular slide</h3>
			</div>
			<div class="admin-body">
				<div class="slider"></div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="admin-block">
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>