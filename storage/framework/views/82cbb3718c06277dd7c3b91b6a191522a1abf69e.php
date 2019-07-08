<?php $__env->startSection("title", "Products"); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-lg-8 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="float-left mb-3 mb-sm-0">Products</h3>
				<div class="float-md-left float-right ml-sm-4 mb-3 mb-sm-0">
					<form action="<?php echo e(url()->full()); ?>">
						<input value="<?php echo e(Request::input("q")); ?>" placeholder="Search by name..." name="q" type="text"
						       class="form-control">
					</form>
				</div>
				<a class="float-left float-sm-right" href="<?php echo e(route("products.create")); ?>">
					<button type="button" class="btn-primary d-block btn-wave btn">
						Add new
						<i class="fas ml-2 fa-plus"></i>
					</button>
				</a>
				<div class="clearfix"></div>
			</div>
			<div class="admin-body">
				<?php if(count($products) > 0): ?>
					<table class="table col-12 sortable table-responsive-lg">
						<thead>
						<tr>
							<th><a data-sortable="id" href=" <?php echo e(url()->current()); ?>">ID</a></th>
							<th><a data-sortable="name" href=" <?php echo e(url()->current()); ?>">Name</a></th>
							<th><a data-sortable="gender" href=" <?php echo e(url()->current()); ?>">Gender</a></th>
							<th><a data-sortable="collections" href="<?php echo e(url()->current()); ?>">Collection</a></th>
							<th><a data-sortable="section" href="<?php echo e(url()->current()); ?>">Section</a></th>
							<th>Added by</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($product->id); ?></td>
								<td><a href="<?php echo e(route("products.edit", $product->id)); ?>"><?php echo e($product->name); ?></a></td>
								<td><?php echo e($product->gender); ?></td>
								<td>
									<?php if(isset($product->collection)): ?>
										<?php echo e($product->collection->name); ?>

									<?php else: ?>
										None
									<?php endif; ?>
								</td>
								<td><?php echo e($product->section->name); ?></td>
								<td><?php echo e($product->user->name); ?></td>
								<td><a target="_blank" href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>">Show</a></td>
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
					<?php echo e($products->appends(request()->input())->links()); ?>

				<?php else: ?>
					There are no products
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>