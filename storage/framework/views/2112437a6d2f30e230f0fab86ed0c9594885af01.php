<?php $__env->startSection("title", "Collections"); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left">Collections</h3>
				<a class="float-right" href="<?php echo e(route("collections.create")); ?>">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">

			<?php if(count($collections) > 0): ?>
				<table class="table col-12 sortable">
					<thead>
					<tr>
						<th><a data-sortable="id" href="<?php echo e(url()->current()); ?>">ID</a></th>
						<th><a data-sortable="name" href="<?php echo e(url()->current()); ?>">Name</a></th>
						<th>Cover image</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($collection->id); ?></td>
							<td><?php echo e($collection->name); ?></td>
							<td><?php echo e($collection->cover_img); ?></td>
							<td><a href="<?php echo e(route("collections.edit", $collection->id)); ?>">Edit</a></td>
							<td>
								<?php echo e(Form::open(["url"=>route("collections.destroy", $collection->id), "method"=>"delete"])); ?>

								<button onclick="return confirm('Are you sure?')" style="background:none;border:none;"
								        type="submit" role="text"><a class="text-danger">Delete</a></button>
								<?php echo e(Form::close()); ?>

							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			<?php else: ?>
				There are no collections
			<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>