<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid">
        <?php if(@helper::checkaddons('product_import')): ?>
            <div class="d-flex justify-content-end">
                <a href="<?php echo e(route('import')); ?>" class="btn btn-primary mb-2"><?php echo e(trans('labels.import')); ?> <?php if(env('Environment') == 'sendbox'): ?>
                        <small class="badge bg-danger">Addon</small>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="table-responsive" id="table-display">
                            <?php echo $__env->make('admin.item.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/custom/additem.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/item/item.blade.php ENDPATH**/ ?>