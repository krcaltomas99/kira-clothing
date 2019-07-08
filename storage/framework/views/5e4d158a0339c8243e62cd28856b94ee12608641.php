<?php $__env->startSection("title", "Checkout"); ?>

<?php $__env->startSection("additionalScripts"); ?>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script>
		var _token = $("meta[name='csrf-token']").attr("content");
		paypal.Button.render({
			env: 'sandbox', // Or 'production'
			// Set up the payment:
			// 1. Add a payment callback
			locale: 'en_US',
			style: {
				size: 'medium',
				color: 'gold',
				shape: 'rect',
			},
			payment: function (data, actions) {
				// 2. Make a request to your server
				return actions.request.post('/create-payment', {
					_token: _token
				})
					.then(function (res) {
						// 3. Return res.id from the response
						return res.id;
					});
			},
			// Execute the payment:
			// 1. Add an onAuthorize callback
			onAuthorize: function (data, actions) {
				// 2. Make a request to your server
				return actions.request.post('/execute-payment', {
					paymentID: data.paymentID,
					payerID: data.payerID,
					_token: _token
				})
					.then(function (res) {
						$.ajax({
							url: "/paymentsuccess",
							data: {data: res, _token: _token},
							method: "post",
							dataType: "json",
							success: function (res) {
								window.location.href = "/thankyou?id=" + res.orderId;
							},
							error: function () {
								alert("Server error. Contact us for further information");
							}
						});
					});
			}
		}, '#paypal-button');
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
	<div class="container checkout-container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8 order-2 order-md-1 mb-sm-0 mb-3">
				<div class="row">
					<div class="col-12 col-md-10 col-lg-8">
						<h3>Information about you</h3>
						<?php echo e(Form::open(["url"=>"checkout.store", "method"=>"post"])); ?>

						<div class="form-row">
							<div class="form-group col-md-6">
								<?php echo e(Form::label("product-name", "Full name", ["class"=>"col-form-label"])); ?>

								<?php echo e(Form::text("product-name", "", ["class"=>"form-control"])); ?>

							</div>
							<div class="form-group col-md-6">
								<?php echo e(Form::label("email", "E-mail", ["class"=>"col-form-label"])); ?>

								<?php echo e(Form::text("email", "", ["class"=>"form-control"])); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<?php echo e(Form::label("tel", "Phone number", ["class"=>"col-form-label"])); ?>

								<?php echo e(Form::text("tel", "", ["class"=>"form-control"])); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<?php echo e(Form::label("city", "City", ["class"=>"col-form-label"])); ?>

								<?php echo e(Form::text("city", "", ["class"=>"form-control"])); ?>

							</div>
							<div class="form-group col-md-6">
								<?php echo e(Form::label("country", "Country", ["class"=>"col-form-label"])); ?>

								<select id="country" name="country" class="form-control">
									<option value="GB">United Kingdom</option>
									<option value="AL">Albania</option>
									<option value="AD">Andorra</option>
									<option value="AT">Austria</option>
									<option value="BY">Belarus</option>
									<option value="BE">Belgium</option>
									<option value="BA">Bosnia and Herzegovina</option>
									<option value="BG">Bulgaria</option>
									<option value="HR">Croatia (Hrvatska)</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="FR">France</option>
									<option value="GI">Gibraltar</option>
									<option value="DE">Germany</option>
									<option value="GR">Greece</option>
									<option value="VA">Holy See (Vatican City State)</option>
									<option value="HU">Hungary</option>
									<option value="IT">Italy</option>
									<option value="LI">Liechtenstein</option>
									<option value="LU">Luxembourg</option>
									<option value="MK">Macedonia</option>
									<option value="MT">Malta</option>
									<option value="MD">Moldova</option>
									<option value="MC">Monaco</option>
									<option value="ME">Montenegro</option>
									<option value="NL">Netherlands</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="RO">Romania</option>
									<option value="SM">San Marino</option>
									<option value="RS">Serbia</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="ES">Spain</option>
									<option value="UA">Ukraine</option>
									<option value="DK">Denmark</option>
									<option value="EE">Estonia</option>
									<option value="FO">Faroe Islands</option>
									<option value="FI">Finland</option>
									<option value="GL">Greenland</option>
									<option value="IS">Iceland</option>
									<option value="IE">Ireland</option>
									<option value="LV">Latvia</option>
									<option value="LT">Lithuania</option>
									<option value="NO">Norway</option>
									<option value="SJ">Svalbard and Jan Mayen Islands</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="TR">Turkey</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<?php echo e(Form::label("address", "Address", ["class"=>"col-form-label"])); ?>

								<?php echo e(Form::text("address", "", ["class"=>"form-control"])); ?>

							</div>
							<div class="form-group col-md-4">
								<?php echo e(Form::label("psc", "Postal code", ["class"=>"col-form-label"])); ?>

								<?php echo e(Form::text("psc", "", ["class"=>"form-control"])); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<div class="buttons">
									<?php echo e(Form::button("Checkout", ["class"=>"btn btn-primary disabled mb-2 float-md-left", "disabled"])); ?>

									<div class="float-md-right" id="paypal-button"></div>
								</div>
								<div class="clearfix"></div>
								<p>
									Please use paypal instead. <strong>Paypal accepts debit card
										payments.</strong>
								</p>
							</div>
						</div>
						<?php echo e(Form::close()); ?>

					</div>
				</div>

			</div>

			<div class="col-12 col-md-6 col-lg-4 order-1 order-md-2 mb-sm-0 mb-3">
				<div class="row">
					<div class="col-12">
						<h3 class="mb-4">Summary of your order:</h3>
						<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div data-rowid="<?php echo e($item->rowId); ?>" class="product-cart border-top border-bottom mb-2 p-2">
								<div class="row">
									<div class="col-4">
										<img style="width: 100%;" src="<?php echo e($item->model->getCoverImgMin()); ?>" alt="">
									</div>

									<div class="col-8">
										<div class="summary-name padded-y float-left float-md-left ml-2 ml-sm-0">
											<span class="merriweather"><?php echo e($item->name); ?></span>
											<div class="divider"></div>
											<div>
												<div class="product-smaller-label">
													category: <?php echo e($item->model->section->name); ?>

												</div>
												<div class="product-smaller-label">
													size: <?php echo e($item->model->getSizeNameBySizeId($item->options->size)); ?>

												</div>
												<div class="product-smaller-label">
													qty: <span class="item-qty"><?php echo e($item->qty); ?></span>
												</div>
												<div class="product-smaller-label">
													price: <span
															class="item-price"><?php echo e($item->model->presentPriceWithQtyWithTax($item->qty)); ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div class="col-12">
						<div class="order-summary">
							<div class="row">
								<div class="col-8">
									<p class="text-right">Subtotal:</p>
									<p class="text-right">Tax (21%):</p>
									<p class="text-right">Shipping:</p>
									<div class="divider"></div>
									<p class="text-right font-weight-bold">Total:</p>
								</div>
								<div class="col-4">
									<p class="text-right cart-subtotal">$<?php echo e(Cart::subtotal()); ?></p>
									<p class="text-right cart-tax">$<?php echo e(Cart::tax()); ?></p>
									<p class="text-right">Free</p>
									<div class="divider"></div>
									<p class="text-right font-weight-bold cart-total">$<?php echo e(Cart::total()); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>