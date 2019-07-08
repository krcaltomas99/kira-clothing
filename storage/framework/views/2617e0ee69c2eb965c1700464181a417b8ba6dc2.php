<?php $__env->startSection('content'); ?>


	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">List of customers</h3>
			</div>
			<div class="admin-body">

				<?php if(count($clients) > 0): ?>
					<table class="table ui col-12">
						<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Added in</th>
							<th>Last login</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr class="<?php echo e(Auth()->user()->id === $client->id ? "positive" : ""); ?>">
								<td><?php echo e($client->id); ?></td>
								<td><?php echo e($client->name); ?></td>
								<td><?php echo e($client->email); ?></td>
								<td><?php echo e($client->created_at); ?></td>
								<td><?php echo e($client->last_login); ?></td>
								<td><a href="<?php echo e(route("admin.users.edit", $client->id)); ?>">Edit</a></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					<?php echo e($clients->links()); ?>

				<?php else: ?>
					<h4>There are no clients</h4>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>