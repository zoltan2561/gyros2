<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 box-shadow mb-3">
                    <div class="card-body">
                        <form action="<?php echo e(URL::to('admin/settings/update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for=""><?php echo e(trans('labels.title')); ?>

                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="why_choose_title"
                                            id="why_choose_title"
                                            value="<?php echo e(@$getsettings->why_choose_title == '' ? old('why_choose_title') : @$getsettings->why_choose_title); ?>"
                                            placeholder="<?php echo e(trans('labels.title')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"
                                            for="why_choose_subtitle"><?php echo e(trans('labels.subtitle')); ?>

                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="why_choose_subtitle"
                                            id="why_choose_subtitle"
                                            value="<?php echo e(@$getsettings->why_choose_subtitle == '' ? old('why_choose_subtitle') : @$getsettings->why_choose_subtitle); ?>"
                                            placeholder="<?php echo e(trans('labels.subtitle')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for=""><?php echo e(trans('labels.image')); ?>

                                            <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="why_choose_image">
                                        <img src="<?php echo e(helper::image_path(@$getsettings->why_choose_image)); ?>"
                                            class="img-fluid rounded h-50px mt-1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"
                                            for="why_choose_description"><?php echo e(trans('labels.description')); ?>

                                            <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="5" placeholder="<?php echo e(trans('labels.description')); ?>"
                                            name="why_choose_description" id="why_choose_description" required><?php echo e(@$getsettings->why_choose_description); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button class="btn btn-primary"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" name="whychooseus_update" value="1" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a class="btn btn-primary mb-3"
                                href="<?php echo e(URL::to('admin/choose_us/add')); ?>"><i class="fa-regular fa-plus"></i> <?php echo e(trans('labels.add_new')); ?></a>
                        </div>
                        <div class="table-responsive" id="table-display">
                            <?php echo $__env->make('admin.why_choose_us.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/custom/whychooseus.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/why_choose_us/index.blade.php ENDPATH**/ ?>