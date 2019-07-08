<?php $__env->startSection("title", $section->name); ?>

<?php $__env->startSection("content"); ?>
	<div class="section section-products">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center"><?php echo e($section->name); ?></h2>
					<?php if(!$section->parent): ?>
						<ul class="ul-centered">
							<?php $__currentLoopData = $section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a href="<?php echo e(route("homesections.show", $item->slug)); ?>"><?php echo e($item->name); ?></a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					<?php else: ?>
						<ul class="ul-centered">
							<li>
								<a href="<?php echo e(route("homesections.show", $section->parent->slug)); ?>"><?php echo e($section->parent->name); ?></a>
							</li>
							<li> ></li>
							<?php $__currentLoopData = $section->parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a href="<?php echo e(route("homesections.show", $item->slug)); ?>"><?php echo e($item->name); ?></a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<?php if($products->count() > 0): ?>
					<div class="col-12">
						<div class="min-filter">
							<div class="row">
								<div class="col-5 col-xs-3 col-md-4 col-xl-2">
									<?php echo e(Form::open([
									"url"=>route("products.filter"), "method"=>"get",
									"data-slug"=>$section->slug,
									"data-call" => route("products.filter")
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
										<a href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>">
											<div class="product-head">
												<img src=" <?php echo e($product->getCoverImgMin()); ?>"
												     alt="Product image">
											</div>
										</a>
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
				<?php else: ?>
					<p class="text-center">No products :(</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>