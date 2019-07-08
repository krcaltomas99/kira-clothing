<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo $__env->yieldContent('title', "Home"); ?> / <?php echo e(config('app.name')); ?></title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">

	<!-- Styles -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo e(secure_asset("dropzone/dist/min/dropzone.min.css")); ?>">
	<link href="<?php echo e(secure_asset('css/app.css')); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo e(secure_asset("googleclick/css/googleclick.css")); ?>">
	<link rel="stylesheet" href="https://cdn.rawgit.com/infostreams/bootstrap-select/fd227d46de2afed300d97fd0962de80fa71afb3b/dist/css/bootstrap-select.min.css" />
	<link rel="stylesheet" href="<?php echo e(secure_asset("css/admin.css")); ?>">

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
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(secure_asset("assets/favicons/android-icon-192x192.png")); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(secure_asset("assets/favicons/favicon-32x32.png")); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(secure_asset("assets/favicons/favicon-96x96.png")); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(secure_asset("assets/favicons/favicon-16x16.png")); ?>">
	<link rel="manifest" href="<?php echo e(secure_asset("assets/favicons/manifest.json")); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo e(secure_asset("assets/favicons/")); ?>/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
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
<body>
<div class="ajax-loader"></div>
<div class="darken admin"></div>
<div class="darker"></div>
<?php echo $__env->make("inc.adminnavbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="rightnav">
	<div id="app" class="admin-app">
		<?php echo $__env->make("inc.adminflashes", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script src="<?php echo e(secure_asset("js/jq-v321.js")); ?>"></script>
<script src="<?php echo e(secure_asset("googleclick/js/googleclick.js")); ?>"></script>
<script src="<?php echo e(secure_asset("fancybox/dist/jquery.fancybox.min.js")); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/microplugin/0.0.3/microplugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sifter/0.5.3/sifter.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/selectize.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1n16sp8r283dtbkve42rx7h1clrfralqngo4dsn9cp17tefo"></script>
<script src="<?php echo e(secure_asset("js/app.js")); ?>"></script>
<script src="https://cdn.rawgit.com/infostreams/bootstrap-select/fd227d46de2afed300d97fd0962de80fa71afb3b/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo e(secure_asset("js/admin.js")); ?>"></script>
<?php echo $__env->yieldContent("additionalScripts"); ?>
</body>
</html>
