<?php $__env->startSection("content"); ?>
<div class="col-8">
	<div class="admin-block">
		<div class="admin-header">
			<h3>Edit: <?php echo e($tag->name); ?></h3>
		</div>
		<div class="admin-body">
			<?php echo e(Form::open(["url"=>route("tags.update", $tag->id),"class"=>"" ,"method"=>"PUT","enctype"=>"multipart/form-data"])); ?>

			<div class="form-group row">
				<?php echo e(Form::label("name", "Name", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

				<div class="col-sm-8">
					<?php echo e(Form::text("name", $tag->name, ["class"=>"form-control"])); ?>

				</div>
			</div>
			<div class="row">
				<div class="col-sm-11">
					<?php echo e(Form::submit("Update tag",["class"=>"btn btn-primary ml-auto d-block"])); ?>

				</div>
			</div>
			<?php echo e(Form::close()); ?>

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>