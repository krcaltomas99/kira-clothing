<?php $__env->startSection("content"); ?>

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Edit section: <?php echo e($section->name); ?></h3>
			</div>
			<div class="admin-body">
				<?php echo e(Form::open(["url"=>route("sections.update", $section->id), "class"=>"", "method"=>"PUT", "enctype"=>"multipart/form-data"])); ?>

				<div class="form-group row">
					<?php echo e(Form::label("name", "Category name", ["class"=>"col-sm-3 required col-form-label text-md-left required"])); ?>

					<div class="col-sm-8">
						<?php echo e(Form::text("name", $section->name, ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("sectionParent", "Category parent", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

					<div class="col-sm-8">
						<select class="form-control" name="sectionParent" id="sectionParent">
							<option value="0">None</option>
							<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionArr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php echo e($section->parent_id === $sectionArr->id ? "selected" : ""); ?> value="<?php echo e($sectionArr->id); ?>"><?php echo e($sectionArr->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("position", "Position", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

					<div class="col-sm-8">
						<?php echo e(Form::text("position", $section->position, ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						<?php echo e(Form::submit("Update section",["class"=>"btn btn-primary d-block ml-auto"])); ?>

					</div>
				</div>
				<?php echo e(Form::close()); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>