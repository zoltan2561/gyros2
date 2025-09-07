<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <div class="row g-4 my-3">
            <div class="col-lg-3 col-sm-6 col-12 d-flex my-2">
                <div class="card border-0 w-100">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <img src='<?php echo e(helper::image_path($getdriverdata->profile_image)); ?>'
                                class="rounded-circle user-profile-image" alt="">
                            <h5 class="mt-3 mb-1"><?php echo e($getdriverdata->name); ?></h5>
                            <p class="m-0"><?php echo e($getdriverdata->email); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex my-2">
                <div class="card border-0 w-100">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <span class="card-icon mx-auto">
                                <i class="fa-solid fa-cart-shopping fs-5"></i>
                            </span>
                            <h5 class="mt-3 mb-1"><?php echo e(count($getorders)); ?></h5>
                            <p class="m-0"><?php echo e(trans('labels.total_orders')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex my-2">
                <div class="card border-0 w-100">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <span class="card-icon mx-auto">
                                <i class="fa fa-hourglass fs-5"></i>
                            </span>
                            <h5 class="mt-3 mb-1"> <?php echo e($totalprocessing); ?> </h5>
                            <p class="m-0"><?php echo e(trans('labels.processing')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex my-2">
                <div class="card border-0 w-100">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <span class="card-icon mx-auto">
                                <i class="fa fa-check fs-5"></i>
                            </span>
                            <h5 class="mt-3 mb-1"> <?php echo e($totalcompleted); ?> </h5>
                            <p class="m-0"><?php echo e(trans('labels.completed')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo e(trans('labels.orders')); ?></h4>
                        <div class="table-responsive" id="table-display">
                            <?php echo $__env->make('admin.orders.orderstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/custom/orders.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/driver/driverdetails.blade.php ENDPATH**/ ?>