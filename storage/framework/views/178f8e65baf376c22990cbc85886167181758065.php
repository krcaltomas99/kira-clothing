<?php $__env->startSection('content'); ?>
	<div class="col-lg-8 col-md-6">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left">Categories</h3>
				<a class="float-right" href="<?php echo e(route("sections.create")); ?>">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">
				<?php if(count($sections) > 0): ?>
					<table class="table col-12 sortable table-responsive-sm">
						<thead>
						<tr>
							<th><a data-sortable="id" href="<?php echo e(url()->current()); ?>">ID</a></th>
							<th><a data-sortable="name" href="<?php echo e(url()->current()); ?>">Name</a></th>
							<th>Show products</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($section->id); ?></td>
								<td><?php echo e($section->name); ?></td>
								<td><a href="<?php echo e(route("sections.show", $section->id)); ?>">Show products
										(<?php echo e($section->products->count()); ?>)</a></td>
								<td><a href="<?php echo e(route("sections.edit", $section->id)); ?>">Edit</a></td>
								<td>
									<?php echo e(Form::open(["url"=>route("sections.destroy", $section->id), "method"=>"delete","enctype"=>"multipart/form-data"])); ?>

									<button onclick="return confirm('Are you sure?')"
									        style="background:none;border:none;" type="submit" role="text"><a
												class="text-danger">Delete</a></button>
									<?php echo e(Form::close()); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				<?php else: ?>
					No sections available
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-6">
		<?php if(isset($products)): ?>
			<div class="admin-block">
				<div class="admin-header">
					<h3>Products by: <?php echo e($section->name); ?></h3>
				</div>
				<div class="admin-body">
					<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="section-prod-box mb-2">
							<div class="row">
								<div class="col-3 col-md-2">
									<div class="section-prod-header">
										<a href="<?php echo e(route("products.edit", $product->id)); ?>">
											<img width="100%" src="<?php echo e($product->getCoverImgMin()); ?>" alt="product image">
										</a>
									</div>
								</div>
								<div class="col-10 col-md-9">
									<div class="section-prod-body">
										<a href="<?php echo e(route("products.edit", $product->id)); ?>"><p><?php echo e($product->name); ?></p>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
			</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>