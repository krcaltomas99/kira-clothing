<?php $__env->startSection("title", $product->name); ?>

<?php $__env->startSection("meta"); ?>
	<meta property="og:url" content="<?php echo e(url()->full()); ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="<?php echo e($product->name); ?> / <?php echo e(config('app.name')); ?>"/>
	<meta property="og:description" content=" <?php echo e(env("APP_DESCRIPTION")); ?>"/>
	<meta property="og:image" content="<?php echo e($product->getCoverImgMin()); ?>"/>
	<meta property="fb:app_id" content="<?php echo e(env("FACEBOOK_APP_ID")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
	<div class="container product-page-container">
		<div class="row product-page-box">
			<div class="col-12 col-md-8 col-lg-8">
				<div data-color="<?php echo e($product->color()->first()->value); ?>" data-id="<?php echo e($product->id); ?>"
				     class="left-product-box">
					<div class="image-box">
						<a data-width="760" data-fancybox="images" href="<?php echo e($product->getCoverImg()); ?>">
							<img src="<?php echo e($product->getCoverImg()); ?>" alt="Product image">
						</a>
					</div>
					<?php if($productImages->count() > 0): ?>
						<div class="images-box mt-2">
							<div class="image-slider">
								<?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a data-fancybox="images" data-width="760"
									   href="<?php echo e(secure_asset("storage/product_images/" . $image->name)); ?>">
										<img src="<?php echo e(secure_asset("storage/product_images/" . $image->name)); ?>"
										     alt="Product image">
									</a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<?php if($groupedProducts->isNotEmpty()): ?>
					<div style="overflow: hidden;" class="row grouped-products product-page-sliders d-none d-md-block">
						<div class="col-12">
							<h2>Grouped products</h2>
							<div class="group-slider grouped-products-slider slider-products">
								<?php $__currentLoopData = $groupedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="product-box">
										<a href="<?php echo e(route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug])); ?>">
											<div class="product-head">
												<img src="<?php echo e($groupProduct->getCoverImgMin()); ?>" alt="product img">
											</div>
										</a>
										<div class="product-body">
											<a href="<?php echo e(route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug])); ?>">
												<p><?php echo e($groupProduct->name); ?></p>
											</a>
											<span><?php echo e($groupProduct->presentPrice()); ?></span>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div style="overflow: hidden;"
					     class="row recommend-container product-page-sliders d-none d-md-block">
						<div class="col-12">
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

				<?php endif; ?>

				<div class="clearfix"></div>

				<div style="overflow: hidden;" class="row last-visited product-page-sliders d-none d-md-block">
					<div class="col-12">
						<h2>Last visited</h2>
						<div class="group-slider last-visit-slider slider-products">
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
			</div>

			<div class="col-12 col-md-4 col-lg-4">
				<div class="right-product-box layout-holder">
					<?php if(Auth::check() && Auth::user()->isAdmin()): ?>
						<a href="<?php echo e(route("products.edit", $product->id)); ?>">Edit</a>
					<?php endif; ?>
					<div class="essential-info">
						<h2 class=""><?php echo e($product->name); ?></h2>
						<h4 class=""><?php echo e($product->presentPrice()); ?></h4>
						<h5 class="">inc. 21% TAX</h5>
					</div>

					<div class="product-variants">
						<a class=""
						   href="<?php echo e(route("showProduct", ["id"=> $product->getMainSku()->id, "slug"=>$product->getMainSku()->slug])); ?>">
							<div class="variant-box <?php if($product->getMainSku()->id === $product->id): ?> active <?php endif; ?>">
								<img src="<?php echo e($product->getMainSku()->getCoverImgUltraMin()); ?>" alt="variant photo">
							</div>
						</a>
						<?php $__currentLoopData = $product->getMainSku()->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="<?php echo e(route("showProduct", ["id"=> $child->id, "slug"=>$child->slug])); ?>">
								<div class="variant-box <?php if($child->id === $product->id): ?> active <?php endif; ?>">
									<img src="<?php echo e($child->getCoverImgUltraMin()); ?>" alt="variant photo">
								</div>
							</a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php echo e(Form::open(["url"=>route("cart.store", $product->id), "method"=>"POST", "class"=>"", "id"=>"product-form"])); ?>

					<div class="row">
						<div class="col-lg-12">
							<div class="size-labels">
								<?php if($errors->has("size-warning")): ?>
									<div class="inline-warning">
										<?php echo e($errors->first("size-warning")); ?>

									</div>
								<?php endif; ?>
								<?php $__currentLoopData = $product->quantities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quantity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="size-label">
										<?php $disabled = "" ?>
										<?php if($quantity->qty <= 0): ?>
											<?php $disabled = "disabled" ?>
										<?php endif; ?>
										<?php echo e(Form::radio("size", $quantity->size->id, false, ["id"=>str_slug($quantity->size->name),
										"data-qty"=>$quantity->qty,
										 "class"=>$disabled, $disabled])); ?>

										<?php echo e(Form::label(str_slug($quantity->size->name), $quantity->size->name, ["class"=>$disabled . " noselect"])); ?>

									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row">
								<div class="col-12 mt-3">
									<?php if($product->ratings->isNotEmpty()): ?>
										<h6 class="to-rate"><?php echo e($ratingValue); ?> / 5</h6>
									<?php else: ?>
										<h6 class="to-rate">No ratings yet</h6>
									<?php endif; ?>
									<?php if(auth()->guard()->check()): ?>
										<?php if($displayRate): ?>
											<div class="rating-box pt-2">
												<h6>Rate this product</h6>
												<div data-id="<?php echo e($product->id); ?>"
												     class="d-flex pt-2 ratings justify-content-around">
													<div data-value="1" class="rating">1</div>
													<div data-value="2" class="rating">2</div>
													<div data-value="3" class="rating">3</div>
													<div data-value="4" class="rating">4</div>
													<div data-value="5" class="rating">5</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
								<div class="col-12">
									<div class="row">
										<div class="col-7">
											<div class="qty-box">
												<div class="qty-numbers float-left ">
													<i class="fas fa-minus product-minus"></i>
												</div>
												<?php echo e(Form::number("qty", 1, ["class"=>"float-left", "readonly"])); ?>

												<div class="qty-numbers float-left ">
													<i class="fas fa-plus product-plus"></i>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="col-5">
											<div data-price="<?php echo e($product->price); ?>" class="total-price text-right">
												<?php echo e($product->presentPrice()); ?>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mt-4">
							<div class="shopping-box">
								<div class="row">
									<div class="col-10 col-md-8">
										<button <?php if(!$product->hasQuantities()): ?> disabled <?php endif; ?> id="add_to_basket"
										        type="submit"
										        class="btn btn-dark btn-wave p-2 d-block w-100 <?php if(!$product->hasQuantities()): ?> disabled <?php endif; ?>">
											Add to cart
										</button>
									</div>
									<div class="col-2 col-md-4">
										<a class="add-to-favorites text-dark d-block mx-auto" data-productid="<?php echo e($product->id); ?>"
										   href="<?php echo e(route("products.addToFavorites")); ?>">
											<?php if(auth()->guard()->check()): ?>
												<?php if(Auth::user()->isProductFavorite($product->id)): ?>
													<i class="fas fa-heart"></i>
												<?php else: ?>
													<i class="far fa-heart"></i>
												<?php endif; ?>
											<?php else: ?>
												<i class="far fa-heart"></i>
											<?php endif; ?>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mt-4">
							<div class="product-information">
								<?php echo $product->text; ?>

							</div>
						</div>
					</div>
					<?php echo e(Form::close()); ?>

				</div>
			</div>

			<?php if($groupedProducts->isNotEmpty()): ?>
				<div class="col-12">
					<div style="overflow: hidden;" class="row grouped-products product-page-sliders d-block d-md-none">
						<div class="col-12">
							<h2>Grouped products</h2>
							<div class="group-slider grouped-products-slider slider-products">
								<?php $__currentLoopData = $groupedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="product-box">
										<a href="<?php echo e(route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug])); ?>">
											<div class="product-head">
												<img src="<?php echo e($groupProduct->getCoverImgMin()); ?>" alt="product img">
											</div>
										</a>
										<div class="product-body">
											<a href="<?php echo e(route("showProduct", ["id"=>$groupProduct->id, "slug"=>$groupProduct->slug])); ?>">
												<p><?php echo e($groupProduct->name); ?></p>
											</a>
											<span><?php echo e($groupProduct->presentPrice()); ?></span>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="col-12">
					<div style="overflow: hidden;"
					     class="row recommend-container product-page-sliders d-block d-md-none">
						<div class="col-12">
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
				</div>
			<?php endif; ?>

			<div class="col-12">
				<div style="overflow: hidden;" class="row last-visited product-page-sliders d-block d-md-none">
					<div class="col-12">
						<h2>Last visited</h2>
						<div class="group-slider last-visit-slider slider-products">
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
			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("additionalScripts"); ?>
	<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>