<?php $__env->startSection("content"); ?>
	<div class="section section-products">
		<div class="container">
			<?php if($products->count() > 0): ?>
				<div class="row">
					<div class="col-12">
						<div class="min-filter">
							<div class="row">
								<div class="col-5 col-xs-3 col-md-4 col-xl-2">
									<?php echo e(Form::open([
									"url"=>route("products.filterSearch"),
									"method"=>"get",
									"data-slug"=> Input::get("q"),
									"data-call" => route("products.filterSearch")
									])); ?>

									<?php echo e(Form::select("filter", $select, Input::get("sort"), ["class"=>"products-filter"])); ?>

									<?php echo e(Form::close()); ?>

								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="row render-category-products">
							<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-6 col-sm-4 col-md-3">
									<div class="product-box">
										<div class="product-head">
											<a href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>"><img
														src="<?php echo e($product->getCoverImgMin()); ?>" alt="Product image"></a>
										</div>
										<div class="product-body">
											<a href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>">
												<p><?php echo e($product->name); ?></p></a>
											<span><?php echo e($product->presentPrice()); ?> DOLLARS</span>
										</div>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<div class="products-pagination">
						<?php echo e($products->links()); ?>

					</div>
				</div>
			<?php else: ?>
				<p class="text-center">No products :(</p>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>