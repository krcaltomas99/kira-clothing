<?php $__env->startSection("title", "Manage orders"); ?>

<?php $__env->startSection("content"); ?>

	<div class="container">
		<div class="row">
			<div class="col-12 col-xl-10 mx-auto">
				<div class="user-settings">
					<div class="leftmenu">
						<?php echo $__env->make("inc.usermenu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<div class="rightmenu p-4">
						<div class="orders">
							<h3 class="mb-3">Manage your orders</h3>
							<?php $__empty_1 = true; $__currentLoopData = $user->orders_desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<div class="order mb-3">
									<div class="header border-bottom py-3 px-4 bg-light d-flex justify-content-between mb-2">
										<div class="info">
											<h4 class="mb-0">Order #<?php echo e($order->id); ?>

												<small class=""> - <?php echo e($order->products->count()); ?> products
													for <?php echo e($order->total); ?>$
												</small>
												- <small><?php if($order->finished): ?> <span class="text-success">on the way</span> <?php else: ?> <span class="text-danger">in progress</span><?php endif; ?></small>
											</h4>
										</div>
										<div class="timestamps">
											<p class="mb-0">
												<?php echo e($order->created_at->format("d.m.Y")); ?> <?php echo e($order->created_at->format("H:i:s")); ?></p>
										</div>
									</div>

									<div class="body py-3 px-4">
										<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="product">
												<a href="<?php echo e(route("showProduct", ["id"=>$product->product->id, "slug"=>$product->product->slug])); ?>">
													<img class="float-left mr-2" width="50"
													     src="<?php echo e($product->product->getCoverImgUltraMin()); ?>"
													     alt="product image">
												</a>
												<div class="price float-left mb-3 py-2">
													<h6 class="mb-1 merriweather"><?php echo e($product->product->name); ?></h6>
													<p class="mb-0"><?php echo e($product->qty); ?> <?php echo e(($product->qty === 1) ? "piece" : "pieces"); ?>

														for <?php echo e($product->product->presentPriceWithQtyWithTax($product->qty)); ?></p>
												</div>
											</div>
											<div class="clearfix"></div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="footer p-3 border-top bg-light">
										<ul class="mb-0 list-center pl-0">
											<li class="mr-2"><a
														href="<?php echo e(route("orders.invoice", $order->id)); ?>">invoice</a>
											</li>
											<li>
												<?php echo e(Form::open(["url"=>route("orders.delete", $order->id), "method"=>"delete"])); ?>

												<?php echo e(Form::submit("cancel order", ["class"=>"btn-clean clickable text-danger text-underline", "role"=>"submit"])); ?>

												<?php echo e(Form::close()); ?>

											</li>
										</ul>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<p class="text-left">No orders yet</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>