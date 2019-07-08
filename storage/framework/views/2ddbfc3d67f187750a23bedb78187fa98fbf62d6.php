<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title>
		<?php if(Cart::count() > 0): ?>
			(<?php echo e(Cart::content()->count()); ?>)
		<?php endif; ?>
		<?php echo $__env->yieldContent('title', "Home"); ?> / <?php echo e(config('app.name')); ?>

	</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:400,900" rel="stylesheet">

	<!-- Styles -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
	      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo e(secure_asset("googleclick/css/googleclick.css")); ?>">
	<link rel="stylesheet" href="<?php echo e(secure_asset("fancybox/dist/jquery.fancybox.min.css")); ?>"/>
	<link href="<?php echo e(secure_asset('css/app.css')); ?>" rel="stylesheet">

	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(secure_asset("assets/favicons/apple-icon-57x57.png")); ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(secure_asset("assets/favicons/apple-icon-60x60.png")); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(secure_asset("assets/favicons/apple-icon-72x72.png")); ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(secure_asset("assets/favicons/apple-icon-76x76.png")); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(secure_asset("assets/favicons/apple-icon-114x114.png")); ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(secure_asset("assets/favicons/apple-icon-120x120.png")); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(secure_asset("assets/favicons/apple-icon-144x144.png")); ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(secure_asset("assets/favicons/apple-icon-152x152.png")); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(secure_asset("assets/favicons/apple-icon-180x180.png")); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(secure_asset("assets/favicons/android-icon-192x192.png")); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(secure_asset("assets/favicons/favicon-32x32.png")); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(secure_asset("assets/favicons/favicon-96x96.png")); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(secure_asset("assets/favicons/favicon-16x16.png")); ?>">
	<link rel="manifest" href="<?php echo e(secure_asset("assets/favicons/manifest.json")); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo e(secure_asset("assets/favicons/")); ?>/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="description" content="<?php echo e(config("app.description")); ?>">
	<?php echo $__env->yieldContent("meta"); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-68443301-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-68443301-2');
	</script>

</head>
<body class="<?php if(auth()->guard()->check()): ?> auth <?php endif; ?>">

<script>
	window.fbAsyncInit = function () {
		FB.init({
			appId: '706617963024844',
			autoLogAppEvents: true,
			xfbml: true,
			version: 'v3.2'
		});
	};

	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div class="ajax-loader"></div>
<div class="darker"></div>
<div class="darken"></div>
<?php echo $__env->make("inc.navbar", ["sections"=>$sections], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="app">
	<?php echo $__env->make("inc.flashes", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<main>
		<?php echo $__env->yieldContent('content'); ?>
	</main>
</div>
<?php echo $__env->make("inc.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(secure_asset("js/jq-v321.js")); ?>"></script>
<script src="<?php echo e(secure_asset("googleclick/js/googleclick.js")); ?>" defer></script>
<script src="<?php echo e(secure_asset("fancybox/dist/jquery.fancybox.min.js")); ?>" defer></script>
<script src="<?php echo e(secure_asset("js/app.js")); ?>" defer></script>
<?php echo $__env->yieldContent("additionalScripts"); ?>
</body>
</html>
