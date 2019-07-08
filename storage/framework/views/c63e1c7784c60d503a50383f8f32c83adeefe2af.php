<?php $__env->startSection("title", "Collections"); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-8">
		<div class="admin-block">
			<h3 class="mb-2 float-left">List of collections</h3>
			<a href="<?php echo e(route("collections.create")); ?>"><button class="btn-secondary btn btn-wave float-right">Add</button></a>
			<div class="clearfix"></div>
			<?php if(count($collections) > 0): ?>
				<table class="table col-12">
					<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>