<?php $__env->startSection("title", $collection->name); ?>

<?php $__env->startSection("content"); ?>
	<div style="background-image: url(<?php echo e($collection->getCoverImg()); ?>)" class="collection-bg">
		<div class="bg-darken"></div>
		<h2 class="text-center text-white"><?php echo e($collection->name); ?></h2>
	</div>
	<div class="section section-products">
		<div class="container">
			<div class="row">
				<?php if($products->count() > 0): ?>
					<div class="col-12">
						<div class="min-filter">
							<div class="row">
								<div class="col-5 col-xs-3 col-md-4 col-xl-2">
									<?php echo e(Form::open([
									"url"=>route("products.filter"),
									"method"=>"get",
									"data-slug" => $collection->slug,
									"data-call" => route("products.filterCollections")
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
				<?php else: ?>
					<p>No products :(</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>