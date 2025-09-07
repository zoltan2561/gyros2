<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="<?php echo e(URL::to('admin/driver/update-' . $getdriverdata->id)); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.name')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="<?php echo e(trans('labels.name')); ?>" value="<?php echo e($getdriverdata->name); ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.email')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="<?php echo e(trans('labels.email')); ?>"
                                                value="<?php echo e($getdriverdata->email); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.mobile')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                                value="<?php echo e($getdriverdata->mobile); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"
                                                for=""><?php echo e(trans('labels.identity_type')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <select id="identity_type" name="identity_type" class="form-select"
                                                aria-label="" required>
                                                <option value="" selected disabled><?php echo e(trans('labels.select')); ?>

                                                </option>
                                                <option value="Passport"
                                                    <?php echo e($getdriverdata->identity_type == 'Passport' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.passport')); ?> </option>
                                                <option value="Driving License"
                                                    <?php echo e($getdriverdata->identity_type == 'Driving License' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.driving_license')); ?>

                                                </option>
                                                <option value="NID"
                                                    <?php echo e($getdriverdata->identity_type == 'NID' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.nid')); ?> </option>
                                                <option value="Restaurant Id"
                                                    <?php echo e($getdriverdata->identity_type == 'Restaurant Id' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.restaurant_id')); ?> </option>
                                                <option value="Other"
                                                    <?php echo e($getdriverdata->identity_type == 'Other' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.other')); ?> </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-form-label"
                                                for=""><?php echo e(trans('labels.identity_number')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="tel" class="form-control" name="identity_number"
                                                value="<?php echo e($getdriverdata->identity_number); ?>" id="identity_number"
                                                placeholder="<?php echo e(trans('labels.identity_number')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-form-label"
                                                for=""><?php echo e(trans('labels.identity_image')); ?>

                                                <span class="text-danger">*</span> </label>
                                            <input type="file" class="form-control" name="image" id="image">
                                            <img src="<?php echo e(helper::image_path($getdriverdata->identity_image)); ?>"
                                                alt="" class="img-fluid rounded h-50px mt-1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                    <a href="<?php echo e(URL::to('admin/driver')); ?>"
                                        class="btn btn-danger"><?php echo e(trans('labels.cancel')); ?></a>
                                    <button class="btn btn-primary"
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button"
                                    onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/driver/edit.blade.php ENDPATH**/ ?>