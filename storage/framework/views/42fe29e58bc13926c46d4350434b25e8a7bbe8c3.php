<?php if(session('status')): ?>
	<div class="container-full alert alert-info alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Status</strong>
					<p><?php echo e(session("status")); ?></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if(session("success")): ?>
	<div class="container-full alert alert-success alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Success</strong>
					<p><?php echo e(session("success")); ?></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if(session("error")): ?>
	<div class="container-full alert alert-danger alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Error!</strong>
					<p><?php echo e(session("error")); ?></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if(session("warning")): ?>
	<div class="container-full alert alert-warning alert-dismissible fade show" role="danger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<strong>Warning</strong>
					<p><?php echo e(session("warning")); ?></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>