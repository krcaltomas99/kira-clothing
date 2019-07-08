<?php $__env->startSection("title", "Edit order $order->id"); ?>

<?php $__env->startSection("additionalScripts"); ?>
	<script>
		$(window).on('hashchange', function () {
			var $anchor = window.location.hash.substr(1);

			if ($anchor === '') {
				$anchor = 'tab-information';
			}

			$(".to-tab").hide();
			$("." + $anchor).show();
			$(".tab a.active").removeClass("active");
			$(".tab a[href='#" + $anchor + "']").addClass("active");

			$(window).scrollTop(0);
		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
	<div class="col-12 col-md-12 col-xl-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Edit <?php echo e($order->recipient_name); ?>'s order: <?php echo e($order->name); ?></h3>
			</div>
			<div class="admin-body tabbable">
				<div class="row">
					<div class="col-12 col-sm-2">
						<div class="tab">
							<ul>
								<li><a class="active" href="#tab-information">Information</a></li>
								<li><a href="#tab-products">Products</a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-sm-10">
						<div class="to-tab tab-information">
							<?php echo e(Form::open(["url"=>route("admin.orders.update", $order->id), "method"=>"PUT"])); ?>

							<div class="form-group row">
								<?php echo e(Form::label("user", "User", ["class"=>"col-sm-4 col-form-label text-md-left required"])); ?>

								<div class="col-sm-8">
									<select name="user" id="user" class="form-control">
										<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option <?php if($user->id === $order->user->id): ?> selected
											        <?php endif; ?> value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("recipient", "Recipient", ["class"=>"col-sm-4 col-form-label text-md-left required"])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::text("recipient", $order->recipient_name, ["class"=>"form-control"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("subtotal", "Subtotal", ["class"=>"col-sm-4 col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::text("subtotal", "$".$order->subtotal, ["class"=>"form-control disabled", "disabled"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("tax", "Tax", ["class"=>"col-sm-4 col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::text("tax", "$".$order->tax, ["class"=>"form-control disabled", "disabled"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("total", "Total", ["class"=>"col-sm-4 col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::text("total", "$".$order->total, ["class"=>"form-control disabled", "disabled"])); ?>

								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<?php echo e(Form::submit("Update order",["class"=>"btn btn-primary d-block ml-auto"])); ?>

								</div>
							</div>
							<?php echo e(Form::close()); ?>

						</div>

						<div class="to-tab tab-products hidden">
							<?php echo e(Form::open(["url"=>route("admin.orders.updateProducts", $order->id), "method"=>"PUT"])); ?>

							<div class="form-group row">
								<?php echo e(Form::label("products", "Products", ["class"=>"col-sm-4 col-form-label text-md-left required"])); ?>

								<div class="col-sm-8">
									<div class="row">
										<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-12 mb-2">
												<div class="row">
													<div class="col-3">
														<img style="width: 50px;"
														     src="<?php echo e($product->product->getCoverImgMin()); ?>"
														     alt="">
													</div>
													<div class="col-3">
														<h6><?php echo e($product->product->name); ?></h6>
													</div>
													<div class="col-3">
														<?php echo e(Form::number("products[".$product->product->id."][qty]", $product->qty,["class"=>"form-control"])); ?>

													</div>
													<div class="col-3">
														<select name="products[<?php echo e($product->product->id); ?>][size]"
														        id="size"
														        class="form-control">
															<?php $__currentLoopData = $product->product->quantities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<option <?php if($qty->size->id === $product->size): ?> selected
																        <?php endif; ?>
																        value="<?php echo e($qty->size->id); ?>"><?php echo e($qty->size->name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</select>
													</div>
												</div>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="row mt-4">
										<div class="col-12">
											<small class="helper">add product</small>
											<select style="width: 100%;" class="custom-select" name="product"
											        id="product">
												<option selected disabled value="">none</option>
												<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<?php echo e(Form::submit("Update products",["class"=>"btn btn-primary d-block ml-auto"])); ?>

								</div>
							</div>
							<?php echo e(Form::close()); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>