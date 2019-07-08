<?php $__env->startSection("title", "Products"); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class=" float-left">List of products</h3>
				<a class="float-right" href="<?php echo e(route("products.create")); ?>">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">

				<?php if(count($products) > 0): ?>
					<table class="table col-12">
						<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Colection</th>
							<th>Gender</th>
							<th>Section</th>
							<th>Added by</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($product->id); ?></td>
								<td><?php echo e($product->name); ?></td>
								<td>
									<?php if(isset($product->colection)): ?>
										<?php echo e($product->collection->name); ?>

									<?php else: ?>
										None
									<?php endif; ?>
								</td>
								<td><?php echo e($product->gender); ?></td>
								<td><?php echo e($product->section->name); ?></td>
								<td><?php echo e($product->user->name); ?></td>
								<td><a href="<?php echo e(route("products.edit", $product->id)); ?>">Edit</a></td>
								<td>
									<?php echo e(Form::open(["url"=>route("products.destroy", $product->id), "method"=>"delete"])); ?>

									<button onclick="return confirm('Are you sure? This action cant be taken back')"
									        style="background:none;border:none;"
									        type="submit" role="text"><a class="text-danger">Delete</a></button>
									<?php echo e(Form::close()); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				<?php else: ?>
					There are no products
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>