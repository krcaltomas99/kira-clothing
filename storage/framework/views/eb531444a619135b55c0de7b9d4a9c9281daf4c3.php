<?php $__env->startComponent("mail::message"); ?>
	<div class="message">
		Thank you for the order! Thank you for trusting in us. We are really happy to see that. The number
		of
		your order is #<?php echo e($order->id); ?>.
		You will see your goods in 2-3 days. If there are any issues, just contact us!
		<h4>Order recap:</h4>
		<div class="panel-list">
			<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="product" style="margin-bottom: 10px;">
					<img align="left" src="<?php echo e($product->product->getCoverImgUltraMin()); ?>"
					     alt="product-image">
					<div>
						<a href="<?php echo e(route("showProduct", ["id"=> $product->product->id, "slug"=>$product->product->slug])); ?>">
							<?php echo e($product->qty); ?> x <?php echo e($product->product->name); ?>

						</a>
						<p><?php echo e($product->product->getSizeNameBySizeId($product->size)); ?></p>
						<span><?php echo e($product->product->presentPriceWithQtyWithTax($product->qty)); ?></span>
					</div>
				</div>
				<div style="clear:both;"></div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			total: $<strong><?php echo e($order->total); ?></strong>
		</div>
	</div>
<?php echo $__env->renderComponent(); ?>