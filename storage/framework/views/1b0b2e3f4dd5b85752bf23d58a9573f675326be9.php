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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
	      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo e(asset("googleclick/css/googleclick.css")); ?>">
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
<div class="darken"></div>
<?php echo $__env->make("inc.navbar", ["sections"=>$sections], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="app">
	<div class="container">
		<?php echo $__env->make("inc.flashes", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<main>
		<?php echo $__env->yieldContent('content'); ?>
	</main>
</div>
<script src="<?php echo e(asset("js/jq-v321.js")); ?>"></script>
<script src="<?php echo e(asset("googleclick/js/googleclick.js")); ?>" defer></script>
<script src="<?php echo e(asset("js/app.js")); ?>" defer></script>
</body>
</html>
