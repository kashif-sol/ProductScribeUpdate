<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Topdawg Website</title>
		<meta name="keywords" content="Topdawg Website" />
		<meta name="description" content="Topdawg">
		<meta name="author" content="Topdawg.net">

        <!-- Title Logo -->
        <link rel="shortcut icon" href="<?php echo e(asset('ThemeData/img/logo-default.png')); ?>">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/bootstrap/css/bootstrap.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/animate/animate.compat.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/font-awesome/css/all.min.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/boxicons/css/boxicons.min.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/magnific-popup/magnific-popup.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')); ?>"/>
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/vendor/datatables/media/css/dataTables.bootstrap5.css')); ?>" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/css/theme.css')); ?>" />

		<!-- Theme Layout -->
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/css/layouts/modern.css')); ?>" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/css/skins/default.css')); ?>" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('ThemeData/css/custom.css')); ?>">

		<!-- Head Libs -->
		<script src="<?php echo e(asset('ThemeData/vendor/modernizr/modernizr.js')); ?>"></script>

	</head>
	<body>
		<section class="body">
			
			<div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php echo $__env->make('Sidebar.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- end: sidebar -->

            <!-- start: Dashboard content -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- end: Dashboard content -->

			</div>

		</section>
		<?php if(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_enabled')): ?>
			<script
				src="https://unpkg.com/@shopify/app-bridge<?php echo e(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : ''); ?>"></script>
			<script
				src="https://unpkg.com/@shopify/app-bridge-utils<?php echo e(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : ''); ?>"></script>
			<script
				<?php if(\Osiset\ShopifyApp\Util::getShopifyConfig('turbo_enabled')): ?>
				data-turbolinks-eval="false"
				<?php endif; ?>
			>
				var AppBridge = window['app-bridge'];
				var actions = AppBridge.actions;
				var utils = window['app-bridge-utils'];
				var createApp = AppBridge.default;
				var app = createApp({
					apiKey: "<?php echo e(\Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name )); ?>",
					shopOrigin: "<?php echo e($shopDomain ?? Auth::user()->name); ?>",
					host: "<?php echo e(\Request::get('host')); ?>",
					forceRedirect: true,
				});
			</script>
			<?php echo $__env->make('shopify-app::partials.token_handler', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php echo $__env->make('shopify-app::partials.flash_messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
		<!-- Vendor -->
		<script src="<?php echo e(asset('ThemeData/vendor/jquery/jquery.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/jquery-browser-mobile/jquery.browser.mobile.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/popper/umd/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/common/common.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/nanoscroller/nanoscroller.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/magnific-popup/jquery.magnific-popup.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/jquery-placeholder/jquery.placeholder.js')); ?>"></script>

		<!-- Specific Page Vendor -->
		<script src="<?php echo e(asset('ThemeData/vendor/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('ThemeData/vendor/datatables/media/js/dataTables.bootstrap5.min.js')); ?>"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo e(asset('ThemeData/js/theme.js')); ?>"></script>

		<script src="<?php echo e(asset('ThemeData/vendor/ios7-switch/ios7-switch.js')); ?>"></script>

		<!-- Theme Custom -->
		<script src="<?php echo e(asset('ThemeData/js/custom.js')); ?>"></script>

		<!-- Theme Initialization Files -->
		<script src="<?php echo e(asset('ThemeData/js/theme.init.js')); ?>"></script>

		<script src="<?php echo e(asset('ThemeData/js/examples/examples.header.menu.js')); ?>"></script>

		<script src="<?php echo e(asset('ThemeData/js/examples/examples.ecommerce.datatables.list.js')); ?>"></script>

		<script src="<?php echo e(asset('vendor/pnotify/pnotify.custom.js')); ?>"></script>

	</body>
</html>
<?php /**PATH D:\laragon\www\ProductScribeUpdate\resources\views/website.blade.php ENDPATH**/ ?>