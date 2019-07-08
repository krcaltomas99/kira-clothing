<?php $__env->startSection("title", "Adding product"); ?>

<?php $__env->startSection("additionalScripts"); ?>
	<script>

		//TinyMCE
		tinymce.init({
			selector: 'textarea',
			height: 200,
			menubar: false,
			plugins: [
				'advlist autolink lists link image charmap print preview anchor textcolor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code help wordcount'
			],
			toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tinymce.com/css/codepen.min.css']
		});

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
								<li><a class="active" href="#tab-information">Information</a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-sm-10">
						<?php echo e(Form::open(["url"=>route("products.store"),"class"=>"prod-form" ,"method"=>"post", "enctype"=>"multipart/form-data"])); ?>

						<div class="to-tab tab-information">
							<div class="form-group row">
								<?php echo e(Form::label("name","Name of the product", ["class"=>"col-sm-3 required col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::text("name", "", ["class"=>"form-control", "required"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("cover_image", "Cover image", ["class"=> "col-sm-3 required col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<div class="custom-file">
										<?php echo e(Form::file("cover_image", ["class"=>"preview custom-file-input form-control-file", "data-target-id"=>"img-prev"])); ?>

										<?php echo e(Form::label("cover_image", "Choose a file...", ["class"=>"custom-file-label"])); ?>

									</div>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("gender", "Gender", ["class"=>"col-sm-3 required col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("gender", [
											"male"=>"Male",
											"female"=>"Female",
											"unisex"=>"Unisex",
										], null, ["class"=>"form-control "])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("section", "Category", ["class"=>"col-sm-3 required col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("sections", $selectedSection, null, ["class"=>" form-control"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("colections", "Collection", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("colections", [null=>"none"] + $selectedColection, null, ["class"=>"form-control"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("group", "Group with", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

								<div class="col-sm-8">
									<?php echo e(Form::select("group", [null=>"none"] + $selectedProduct, null, ["class"=>"form-control"])); ?>

								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("price", "Price", ["class"=>"col-sm-3 required col-form-label text-md-left", "required"])); ?>

								<div class="col-sm-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">$</span>
										</div>
										<?php echo e(Form::text("price", "", ["class"=>"form-control"])); ?>

									</div>
								</div>
							</div>
							<div class="form-group row">
								<?php echo e(Form::label("textarea", "Product info", ["class"=>"col-sm-3 col-form-label required text-md-left", "required"])); ?>

								<div class="col-sm-8">
									<?php echo Form::textarea('textarea',null,['class'=>'form-control']); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>