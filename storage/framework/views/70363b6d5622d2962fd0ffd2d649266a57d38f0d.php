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
					<?php echo e(Form::label("sliderheader", "Slider heading", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

					<div class="col-sm-8 ">
						<?php echo e(Form::text("sliderheader", "", ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("slidertext", "Slider text", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

					<div class="col-sm-8 ">
						<?php echo e(Form::text("slidertext", "", ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("sliderlink", "Destination link", ["class"=>"col-sm-3 col-form-label text-md-left "])); ?>

					<div class="col-sm-8 ">

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><?php echo e(url("/")); ?></span>
							</div>
							<?php echo e(Form::text("sliderlink", "", ["class"=>"form-control"])); ?>

						</div>
					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("slider_image", "Slide cover photo", ["class"=>"col-sm-3 col-form-label  text-md-left"])); ?>

					<div class="col-8 ">
						<?php echo e(Form::file("slider_image")); ?>

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