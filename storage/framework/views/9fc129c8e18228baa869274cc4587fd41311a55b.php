<?php $__env->startSection("content"); ?>

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Create new collection</h3>
			</div>
			<div class="admin-body">
				<?php echo e(Form::open(["url"=>route("collections.store"), "class"=>"", "method"=>"post", "enctype"=>"multipart/form-data"])); ?>

				<div class="form-group row">
					<?php echo e(Form::label("name", "Collection name", ["class"=>"col-sm-3 col-form-label text-md-left required"])); ?>

					<div class="col-sm-8">
						<?php echo e(Form::text("name", "", ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("collection_img", "Collection icon", ["class"=>"col-sm-3 col-form-label text-md-left required"])); ?>

					<div class="col-sm-8">
						<div class="custom-file">
							<?php echo e(Form::file("collection_img", ["class"=>"custom-file-input form-control-file"])); ?>

							<?php echo e(Form::label("collection_img", "Choose a file...", ["class"=>"custom-file-label"])); ?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						<?php echo e(Form::submit("Add collection",["class"=>"btn btn-primary d-block ml-auto"])); ?>

					</div>
				</div>
				<?php echo e(Form::close()); ?>

			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>