<?php $__env->startSection("content"); ?>

	<div class="col-8">
		<div class="admin-block">
			<div class="admin-header">
				<h3>Create new category</h3>
			</div>
			<div class="admin-body">
				<?php echo e(Form::open(["url"=>route("sections.store"), "class"=>"mt-3", "method"=>"post", "enctype"=>"multipart/form-data"])); ?>

				<div class="form-group row">
					<?php echo e(Form::label("name", "Category name", ["class"=>"col-sm-3 required col-form-label text-md-left required"])); ?>

					<div class="col-sm-8">
						<?php echo e(Form::text("name", "", ["class"=>"form-control"])); ?>

					</div>
				</div>
				<div class="form-group row">
					<?php echo e(Form::label("sectionParent", "Category parent", ["class"=>"col-sm-3 col-form-label text-md-left"])); ?>

					<div class="col-sm-8">
						<select class="form-control" name="sectionParent" id="sectionParent">
							<option value="0" selected>None</option>
							<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($section->id); ?>"><?php echo e($section->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						<?php echo e(Form::submit("Add section",["class"=>"btn btn-primary d-block ml-auto"])); ?>

					</div>
				</div>
				<?php echo e(Form::close()); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>