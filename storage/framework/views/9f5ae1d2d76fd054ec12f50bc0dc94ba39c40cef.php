<?php $__env->startSection("content"); ?>
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">Orders</h3>
			</div>
			<div class="admin-body">
				<table class="table sortable">
					<thead>
					<tr>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="id">ID</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="recipient_name">User</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="subtotal">Subtotal</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="tax">Tax</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="total">Total</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="created_at">Created at</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="updated_at">Updated at</a></th>
						<th><a href="<?php echo e(url()->current()); ?>" data-sortable="finished">Finished</a></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($order->id); ?></td>
							<td><?php echo e($order->recipient_name); ?></td>
							<td>$<?php echo e($order->subtotal); ?></td>
							<td>$<?php echo e($order->tax); ?></td>
							<td>$<?php echo e($order->total); ?></td>
							<td><?php echo e($order->created_at); ?></td>
							<td><?php echo e($order->updated_at); ?></td>
							<td>
								<a href="<?php echo e(route("admin.orders.finish", $order->id)); ?>">
									<button type='button' class='btn py-1 <?php echo e(($order->finished) ? "btn-secondary" : "btn-outline-secondary"); ?>'>
										<?php if($order->finished): ?>
											Mark as unfinished
										<?php else: ?>
											Mark as finished
										<?php endif; ?>
									</button>
								</a>
							</td>
							<td><a href="<?php echo e(route("admin.orders.edit", $order->id)); ?>">Edit</a></td>
							<td>
								<?php echo e(Form::open(["url"=>route("admin.orders.destroy", $order->id), "method"=>"delete"])); ?>

								<button onclick="return confirm('Are you sure? This action cant be taken back')"
								        style="background:none;border:none;"
								        type="submit" role="text"><a class="text-danger">Delete</a></button>
								<?php echo e(Form::close()); ?>

							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
				<?php echo e($orders->appends(request()->input())->links()); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>