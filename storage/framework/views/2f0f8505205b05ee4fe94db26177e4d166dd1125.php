<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo e(config('app.name')); ?> | <?php echo $__env->yieldContent('title'); ?></title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">

	<!-- Styles -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo e(asset("dropzone/dist/min/dropzone.min.css")); ?>">
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo e(asset("googleclick/css/googleclick.css")); ?>">
	<link rel="stylesheet" href="<?php echo e(asset("css/admin.css")); ?>">
</head>
<body>
<div class="darken admin"></div>
<?php echo $__env->make("inc.adminnavbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="rightnav">
	<div id="app" class="admin-app">
		<?php echo $__env->make("inc.adminflashes", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	</div>
</div>
<script src="<?php echo e(asset("js/jq-v321.js")); ?>"></script>
<script src="<?php echo e(asset("googleclick/js/googleclick.js")); ?>" defer></script>
<script src="<?php echo e(asset("js/app.js")); ?>" defer></script>
<script src="<?php echo e(asset("js/admin.js")); ?>" defer></script>
<?php echo $__env->yieldContent("additionalScripts"); ?>
</body>
</html>
