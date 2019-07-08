<?php $__env->startSection("content"); ?>
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Tags</h3>
			</div>
			<div class="admin-body">
				<table class="table sortable">
					<thead>
					<tr>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="id">ID</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="name">Name</a></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($tag->id); ?></td>
							<td><?php echo e($tag->name); ?></td>
							<td><a href="<?php echo e(route("tags.edit", $tag->id)); ?>">Edit</a></td>
							<td>
								<?php echo e(Form::open(["url"=>route("tags.destroy", $tag->id), "method"=>"delete"])); ?>

								<button onclick="return confirm('Are you sure? This action cant be taken back')"
								        style="background:none;border:none;"
								        type="submit" role="text"><a class="text-danger">Delete</a></button>
								<?php echo e(Form::close()); ?>

							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
				<?php echo e($tags->appends(request()->input())->links()); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>