<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo e(config('app.name', 'Laravel')); ?> | <?php echo $__env->yieldContent('title'); ?></title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">

	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo e(asset("googleclick/css/googleclick.css")); ?>">
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
<?php echo $__env->make("inc.navbar", ["sections"=>$sections], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="app">
	<main class="py-4">
		<?php echo $__env->yieldContent('content'); ?>
	</main>
</div>
<script src="<?php echo e(asset("js/jq-v321.js")); ?>"></script>
<script src="<?php echo e(asset("googleclick/js/googleclick.js")); ?>" defer></script>
<script src="<?php echo e(asset("js/app.js")); ?>" defer></script>
</body>
</html>
