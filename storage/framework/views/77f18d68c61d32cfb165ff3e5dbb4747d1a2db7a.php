<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="<?php echo e(URL::to('admin/tax/store')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="tax_name"><?php echo e(trans('labels.name')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="name" id="tax_name"
                                                placeholder="<?php echo e(trans('labels.name')); ?>" value="<?php echo e(old('name')); ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.type')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <select name="type" class="form-select" required>
                                                <option value="" hidden><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1" <?php echo e(old('type') == 1 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.fixed')); ?>

                                                    (<?php echo e(helper::appdata()->currency); ?>)</option>
                                                <option value="2" <?php echo e(old('type') == 2 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.percentage')); ?> (%)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="tax"><?php echo e(trans('labels.tax')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control numbers_only" name="tax"
                                                id="tax" placeholder="<?php echo e(trans('labels.tax')); ?>"
                                                value="<?php echo e(old('tax')); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                    <a href="<?php echo e(URL::to('admin/tax')); ?>"
                                        class="btn btn-danger"><?php echo e(trans('labels.cancel')); ?></a>
                                    <button class="btn btn-primary"
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/custom/addons.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/tax/add.blade.php ENDPATH**/ ?>