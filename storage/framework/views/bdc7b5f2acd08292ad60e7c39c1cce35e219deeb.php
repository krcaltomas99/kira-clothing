<?php $__env->startSection("title", "Home"); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-full">
		<div class="click-left"></div>
		<div class="click-right"></div>
		<div class="hp-slider slider" id="hp-slider">
			<?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div data-id="<?php echo e($slide->id); ?>"
				     data-redirect="<?php if($slide->hasDestination()): ?><?php echo e(url("/") . $slide->url_dest); ?> <?php endif; ?>"
				     class="slide clickable">
					<div class="slide-darken"></div>
					<div class="img-slide">
						<img src="<?php echo e($slide->getCoverImg()); ?>" alt="slide background">
					</div>
					<div class="container">
						<h2><?php echo e($slide->heading); ?></h2>
						<p><?php echo e($slide->text); ?></p>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<h2>Newest products</h2>
			<div class="row products-row">
				<?php $__currentLoopData = $newestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-6 col-sm-4 col-md-3">
						<div class="product-box">
							<a href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>">
								<div class="product-head">
									<img src="<?php echo e(asset($product->getCoverImgMin())); ?>" alt="Product image">
									<?php if($product->hasSku()): ?>
										<div class="variations">
											<?php echo e($product->children()->count() + 1); ?> variations
										</div>
									<?php endif; ?>
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
			<div class="content faded-sm-text">
				<p>
					<a class="load-more-button" href="">
						Load more
						<span class="plus"></span>
					</a>
				</p>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="container">
			<div class="collection-container">
				<div class="row">
					<?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-12 col-sm-6 col-md-4">
							<a data-id="<?php echo e($collection->id); ?>" class="click-count"
							   data-call="<?php echo e(route("collectionclick")); ?>"
							   href="<?php echo e(route("showCollection", $collection->slug)); ?>">
								<div class="collection-box">
									<div title="<?php echo e($collection->name); ?>" class="absolute-box">
										<p><?php echo e($collection->name); ?></p>
									</div>
									<img src="<?php echo e($collection->getImg()); ?>" alt="Collection image">
								</div>
							</a>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="section slider-section">
		<div class="container">
			<h2>Hottest products</h2>
			<div class="slider-products hottest-products">
				<?php $__currentLoopData = $hottestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="product-box">
						<a href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>">
							<div class="product-head">
								<img src="<?php echo e(asset($product->getCoverImgMin())); ?>" alt="Product image">
							</div>
						</a>
						<div class="product-body">
							<a href="<?php echo e(route("showProduct", ["id"=>$product->id, "slug"=>$product->slug])); ?>">
								<p><?php echo e($product->name); ?></p></a>
							<span><?php echo e($product->presentPrice()); ?> DOLLARS</span>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>

	<div class="section slider-section pt-4">
		<div class="container recommend-container">
			<h2>Products you might like</h2>
			<div class="recommended-slider slider-products">
				<div class="product-box placeholder mr-2 float-left">
					<div class="product-head"></div>
					<div class="product-body">
						<div class="name"></div>
						<div class="price"></div>
					</div>
				</div>
				<div class="product-box placeholder mr-2 float-left">
					<div class="product-head"></div>
					<div class="product-body">
						<div class="name"></div>
						<div class="price"></div>
					</div>
				</div>
				<div class="product-box placeholder mr-2 float-left">
					<div class="product-head"></div>
					<div class="product-body">
						<div class="name"></div>
						<div class="price"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>