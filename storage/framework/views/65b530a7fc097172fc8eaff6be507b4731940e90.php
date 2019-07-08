<?php $__env->startSection('content'); ?>


	<div class="col-md-10">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left mb-4 mb-sm-0">Employees</h3>
				<div class="float-left ml-sm-4">
					<form action="<?php echo e(url()->full()); ?>">
						<input value="<?php echo e(Request::input("q")); ?>" placeholder="Search by name..." name="q" type="text"
						       class="form-control">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">

				<?php if(count($employees) > 0): ?>
					<table class="table col-12 sortable table-responsive-sm">
						<thead>
						<tr>
							<th><a data-sortable="id" href="<?php echo e(url()->current()); ?>">ID</a></th>
							<th><a data-sortable="name" href="<?php echo e(url()->current()); ?>">Name</a></th>
							<th><a data-sortable="email" href="<?php echo e(url()->current()); ?>">Email</a></th>
							<th><a data-sortable="created_at" href="<?php echo e(url()->current()); ?>">Added in</a></th>
							<th><a data-sortable="last_login" href="<?php echo e(url()->current()); ?>">Last login</a></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr class="<?php echo e(Auth()->user()->id === $employee->id ? "positive" : ""); ?>">
								<td><?php echo e($employee->id); ?></td>
								<td><?php echo e($employee->name); ?></td>
								<td><?php echo e($employee->email); ?></td>
								<td><?php echo e($employee->role); ?></td>
								<td><?php echo e($employee->created_at); ?></td>
								<td><?php echo e($employee->last_login); ?></td>
								<td><a href="<?php echo e(route("admin.users.edit", $employee->id)); ?>">Edit</a></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					<?php echo e($employees->links()); ?>

				<?php else: ?>

					<h4>There are no employees</h4>

				<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>