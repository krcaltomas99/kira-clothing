<?php $__env->startSection("title", "Adding product"); ?>

<?php $__env->startSection("additionalScripts"); ?>
	<script src="<?php echo e(asset("dropzone/dist/min/dropzone.min.js")); ?>"></script>
	<script type="text/javascript">
		var token = "<?php echo csrf_token(); ?>";

		$(function () {
			$("#my-dropzone").dropzone({
				url: "<?php echo e(route("uploadMoreImages")); ?>",
				autoProcessQueue: false,
				addRemoveLinks: true,
				acceptedFiles: "image/*",
				resizeWidth: 1000,
				init: function () {
					$("#my-dropzone").addClass("dropzone");
					var myDropzone = this;
					this.on("addedfile", function () {
						$(".dz-helper").hide();
						$(".kc.popup .helper").text("Images will be uploaded when the product is created");
					});

					$(".prod-form").one("submit", function (e) {
						e.preventDefault();
						var files = myDropzone.getQueuedFiles();
						if (files.length) {
							files.forEach(function (file) {
								myDropzone.processFile(file);
							});
						} else {
							$(this).submit();
						}
					});

					this.on("success", function (file, response) {
						$(".prod-form").append("<input hidden type='text' name='uploadImages[]' value='" + response.id + "'>");
						if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
							$(".prod-form").submit();
						}
					});
				},
				params: {
					_token: token
				},
			});
		})
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
	<div class="col-xl-9 col-12">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">Create new product</h3>
			</div>
			<div class="admin-body tabbable">
				<div class="row">
					<div class="col-12 col-sm-2">
						<div class="tab">
							<ul>
								<li><a data-toggle="tab-1" class="active" href="#tab-1">Information</a></li>
								<li><a data-toggle="tab-2" href="#tab-2">Photos</a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-sm-10">
						<?php echo e(Form::open(["url"=>route("products.store"),"class"=>"prod-form" ,"method"=>"post", "enctype"=>"multipart/form-data"])); ?>

						<div class="to-tab tab-1">
							<div class="form-group row">
								<?php echo e(Form::label("name","Name of the product", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::text("name", "", ["class"=>"form-control", "required", "v-model"=>"message"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("gender", "Gender", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("gender", [
											"male"=>"Male",
											"female"=>"Female",
											"unisex"=>"Unisex",
										], null, ["class"=>"form-control "])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("section", "Category", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("sections", $selectedSection, null, ["class"=>" form-control"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("colections", "Collection", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("colections", [null=>"none"] + $selectedColection, null, ["class"=>" form-control"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("price", "Price", ["class"=>"col-sm-3 col-form-label text-md-left", "required"])); ?>

								<div class="col-sm-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">$</span>
										</div>
										<?php echo e(Form::text("price", "", ["class"=>"form-control", "v-model"=>"price"])); ?>

									</div>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("textarea", "Product info", ["class"=>"col-sm-3 col-form-label text-md-left", "required"])); ?>

								<div class="col-sm-8">
									<?php echo Form::textarea('textarea',null,['class'=>'form-control' , "v-model"=>"text"]); ?>

								</div>
							</div>
						</div>
						<div class="to-tab hidden tab-2">
							<div class="form-group row">
								<?php echo e(Form::label("cover_image", "Cover photo", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-6">
											<?php echo e(Form::file("cover_image", ["required", "class"=>"preview", "data-target-id"=>"img-prev"])); ?>

										</div>
										<div class="col-sm-6">
											<div id="upload-photos" class="kc popup">
												<div class="header">
													<h3>Upload more photos</h3>
													<ul>
														<li>Upload photos</li>
														<li>Choose a photo</li>
													</ul>
												</div>
												<div class="body">
													<div class="dropzone-like flex-break text-primary d-flex justify-content-center align-items-center"
													     id="my-dropzone">
														<p class="dz-helper">Drop down images</p>
														<div class="fallback">
															<input type="file" name="toUpload">
														</div>
													</div>
												</div>
												<div class="helper">
													Waiting for action...
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("more_photos", "More photos", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<button type="button" data-target="upload-photos"
									        class="btn-outline-primary btn d-block kc-popup">More photos
									</button>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-11">
								<?php echo e(Form::button("Add product",["class"=>"btn btn-primary btn-wave ml-auto d-block", "id"=>"submit-all", "type"=>"submit"])); ?>

							</div>
						</div>
						<?php echo e(Form::close()); ?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="mt-1 mb-0">Product preview</h3>
			</div>
			<div class="admin-body">
				<div class="row">
					<div class="col-lg-10">
						<div class="product-preview">
							<div class="product-img">
								<img id="img-prev"
								     src="http://www.lesnicka-skola.cz/wp-content/uploads/2017/12/pojo-placeholder-1-1024x768.png"
								     alt="">
							</div>
							<div class="product-body">
								<div class="row main-info">
									<div class="col-8 name">
										<h3>{{ message }}</h3>
									</div>
									<div class="col-4 price text-right">
										{{ price }}
									</div>
									<div class="col-12 text text-justify">
										{{ text }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>