
<?php $__env->startSection('content'); ?>
<section role="main" class="content-body content-body-modern">


	<!-- start: page -->
	
	<div class="row">
		<div class="col">

			<div class="card card-modern card-modern-table-over-header">
			
				<div class="card-body">
                <style>
    body {
    background: rgb(94, 19, 217)
}

.table-pricing h1 {
    color: rgb(94, 19, 217)
}

.col-md-3 {
    margin-top: 25px
}
    </style>

    <!-- here plans start -->
    <div style="margin-bottom: 50px;" class="text-center container mt-5">
    <h1 class="" style="font-weight: 700;"><i class="fa-solid fa-box-open"></i> Purchase Plans ></h1><span class=""><br><br></span>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="text-center  p-5 table-pricing shadow-lg">
                    <h2 class="text-uppercase" style="font-weight: 700;"><?php echo e($plan->name); ?></h2>
                    <h1 style="color: #191C21; font-weight: 600;">$<?php echo e($plan->price); ?></h1><?php echo e($plan->terms); ?>&nbsp; words / Month</span><br>
                    <?php
                        $plan_id = Auth::user()->plan_id;
                    ?>

                    <?php if($plan_id != $plan->id): ?>
                        <a  href="<?php echo e(route('billing', ['plan' => $plan->id, 'shop' => Auth::user()->name])); ?>" class="btn btn-default btn-block mt-4" type="button">Upgrade</a>
                    <?php else: ?>
                        <a  href="#" class="btn btn-default btn-block mt-4" type="button" style="background-color: #47A447; color: white;">Active</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
                <!-- here plans start -->

				
		</div>
	</div>
	<!-- end: page -->
</section>
<script src="<?php echo e(asset('ThemeData/vendor/jquery/jquery.js')); ?>"></script>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<script>

	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('website', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ProductScribeUpdate\resources\views/Content/plan.blade.php ENDPATH**/ ?>