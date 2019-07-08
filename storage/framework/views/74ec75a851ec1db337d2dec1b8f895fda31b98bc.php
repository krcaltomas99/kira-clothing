<?php $__env->startSection("title", "Create new slide"); ?>

<?php $__env->startSection("content"); ?>

	<div class="col-lg-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3 class="">Create new slide</h3>
			</div>
			<div class="admin-body">
				<?php echo e(Form::open(["url"=>route("sliders.store"),"class"=>"" ,"method"=>"post","enctype"=>"multipart/form-data"])); ?>

				<div class="form-group row">
					<?php echo e(Form::label("slider_header", "Slider heading", ["class"=>"col-sm-3 col-form-label text-md-left required"])); ?>

					<div class="col-sm-8 ">
						<?php echo e(Form::text("slider_header", "", ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("slider_text", "Slider text", ["class"=>"col-sm-3 col-form-label text-md-left required"])); ?>

					<div class="col-sm-8 ">
						<?php echo e(Form::text("slider_text", "", ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("slider_image", "Slide cover photo", ["class"=>"col-sm-3 col-form-label  text-md-left required"])); ?>

					<div class="col-8 ">
						<div class="custom-file">
							<?php echo e(Form::file("slider_image", ["class"=>"custom-file-input form-control-file"])); ?>

							<?php echo e(Form::label("slider_image", "Choose a file...", ["class"=>"custom-file-label"])); ?>

						</div>
					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("slider_link", "Destination link", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

					<div class="col-sm-8 ">

						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><?php echo e(url("/")); ?></span>
							</div>
							<?php echo e(Form::text("slider_link", "", ["class"=>"form-control"])); ?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						<?php echo e(Form::submit("Add slider",["class"=>"btn btn-primary ml-auto d-block"])); ?>

					</div>
				</div>
				<?php echo e(Form::close()); ?>

			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>