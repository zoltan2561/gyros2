
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/shippingarea/update-' . $shippingareadata->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" name="id"value="<?php echo e($shippingareadata->id); ?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.area_name')); ?>

                                        <span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control" name="name"
                                        value="<?php echo e($shippingareadata->name); ?>" placeholder="<?php echo e(trans('labels.area_name')); ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.delivery_charge')); ?>

                                        <span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control numbers_only" name="delivery_charge"
                                        value="<?php echo e($shippingareadata->delivery_charge); ?>"
                                        placeholder="<?php echo e(trans('labels.delivery_charge')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <a href="<?php echo e(URL::to('admin/shippingarea')); ?>"
                                    class="btn btn-danger"><?php echo e(trans('labels.cancel')); ?></a>
                                <button class="btn btn-primary "
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/shippingarea/edit.blade.php ENDPATH**/ ?>