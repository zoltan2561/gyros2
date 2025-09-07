<?php $__env->startSection('content'); ?>
    <div class="alert top-alert">
        <i class="fa-regular fa-circle-exclamation"></i> This section is available only for website & admin panel. 
    </div>
    
    <div class="alert top-alert" role="alert">
        <p>Dont Use Double Qoute (")</p>
    </div>
    
    <div class="row settings">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-uppercase"><?php echo e(trans('labels.language')); ?></h5>
            <?php if(@helper::checkaddons('language')): ?>
            <div class="d-flex justify-content-end">
                <a href="<?php echo e(URL::to('/admin/language-settings/language/add')); ?>" class="btn btn-primary px-4 mb-2"><i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add_new')); ?> </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card card-sticky-top border-0">
                <ul class="list-group list-options">
                    <?php $__currentLoopData = $getlanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(URL::to('admin/language-settings/' . $data->code)); ?>"
                            class="list-group-item basicinfo p-3 list-item-primary <?php if($currantLang->code == $data->code): ?> active <?php endif; ?>"
                            aria-current="true">
                            <div class="d-flex justify-content-between align-item-center">
                                <?php echo e($data->name); ?>

                                <div class="d-flex align-item-center">
                                    <?php if($data->is_default == '1'): ?>
                                        <span><?php echo e(trans('labels.default')); ?></span>
                                    <?php endif; ?>
                                    <i class="fa-regular fa-angle-right ps-2"></i>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="dropdown">

                <a class="btn btn-info text-white"
                    href="<?php echo e(URL::to('/admin/language-settings/language/edit-' . $currantLang->id)); ?>">
                    <?php echo e(trans('labels.edit')); ?> </a>
                <?php if(Strtolower($currantLang->name) != 'english'): ?>
                    <a class="btn btn-danger text-white"
                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/language-settings/language/delete-' . $currantLang->id . '/2')); ?>')" <?php endif; ?>>
                        <?php echo e(trans('labels.delete')); ?> </a>
                <?php endif; ?>
            </div>
            <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active bg-white" id="labels-tab" data-bs-toggle="tab" data-bs-target="#labels"
                        type="button" role="tab" aria-controls="labels" aria-selected="true">Labels</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bg-white" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button"
                        role="tab" aria-controls="message" aria-selected="false">Messages</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="labels" role="tabpanel" aria-labelledby="labels-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form method="post" action="<?php echo e(URL::to('admin/language-settings/update')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" class="form-control" name="currantLang"
                                    value="<?php echo e($currantLang->code); ?>">
                                <input type="hidden" class="form-control" name="file" value="label">
                                <div class="row">
                                    <?php $__currentLoopData = $arrLabel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="example3cols1Input"><?php echo e($label); ?>

                                                </label>
                                                <input type="text" class="form-control"
                                                    name="label[<?php echo e($label); ?>]" id="label<?php echo e($label); ?>"
                                                    onkeyup="validation($(this).val(),this.getAttribute('id'))"
                                                    value="<?php echo e($value); ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <div class="d-flex justify-content-end mt-3">
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <button type="button" class="btn btn-raised btn-primary px-4"
                                                        onclick="myFunction()"><i class="fa fa-check-square-o"></i>
                                                        <?php echo e(trans('labels.save')); ?> </button>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn-raised btn-primary px-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_language_settings', Auth::user()->role_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                            class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?>

                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form method="post" action="<?php echo e(URL::to('admin/language-settings/update')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" class="form-control" name="currantLang"
                                    value="<?php echo e($currantLang->code); ?>">
                                <input type="hidden" class="form-control" name="file" value="message">
                                <div class="row">
                                    <?php $__currentLoopData = $arrMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="example3cols1Input"><?php echo e($label); ?>

                                                </label>
                                                <input type="text" class="form-control"
                                                    name="message[<?php echo e($label); ?>]" id="message<?php echo e($label); ?>"
                                                    onkeyup="validation($(this).val(),this.getAttribute('id'))"
                                                    value="<?php echo e($value); ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <div class="d-flex justify-content-end mt-3">
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <button type="button" class="btn btn-raised btn-primary px-4"
                                                        onclick="myFunction()"><i class="fa fa-check-square-o"></i>
                                                        <?php echo e(trans('labels.save')); ?> </button>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn-raised btn-primary px-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_language_settings', Auth::user()->role_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                            class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?>

                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        function validation(value, id) {
            if (value.includes('"')) {
                newval = value.replaceAll('"', '');
                $('#' + id).val(newval);
            }
        }
    </script>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/custom/settings.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/language/index.blade.php ENDPATH**/ ?>