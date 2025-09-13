<header class="page-topbar">




    <div class="navbar-header">
        <div class="">
            <button class="navbar-toggler d-lg-none d-md-block px-md-4 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarcollapse" aria-expanded="false" aria-controls="sidebarcollapse">
                <i class="fa-regular fa-bars fs-4"></i>
            </button>
        </div>
        <div class="px-md-3 px-0 d-flex align-items-center">

            <?php if(Auth::user()->type == 1 || Auth::user()->type == 4): ?>
                
                <?php if(helper::check_restaurant_closed() == 1 ): ?>
                    <?php $tooltiptitle = trans('messages.online_note'); ?>
                    <input id="open-close-switch" type="checkbox" class="checkbox-switch" name="open-close"
                           value="1" checked
                           <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" disabled
                           <?php else: ?> onclick="changeStatus(2,'<?php echo e(URL::to('admin/change-status')); ?>')" <?php endif; ?>>
                <?php else: ?>
                    <?php $tooltiptitle = trans('messages.offline_note'); ?>
                    <input id="open-close-switch" type="checkbox" class="checkbox-switch" name="open-close"
                           value=""
                           <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" disabled
                           <?php else: ?> onclick="changeStatus(1,'<?php echo e(URL::to('admin/change-status')); ?>')" <?php endif; ?>>
                <?php endif; ?>
                <label for="open-close-switch" class="switch me-3" data-bs-toggle="tooltip" title="<?php echo e($tooltiptitle); ?>">
        <span class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>">
            <span class="switch__circle-inner"></span>
        </span>
                    <span class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                    <span class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                </label>

                
                <form method="POST" action="<?php echo e(route('admin.toggleDelivery')); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php $deliveryOn = (int)\App\Helpers\helper::app_setting('delivery_enabled', 1) === 1; ?>
                    <button type="submit" class="btn btn-sm <?php echo e($deliveryOn ? 'btn-warning' : 'btn-success'); ?>">
                        <?php echo e($deliveryOn ? '🚚 Kiszállítás kikapcsolása' : '🚚 Kiszállítás bekapcsolása'); ?>

                    </button>
                </form>
            <?php endif; ?>

            <?php if(@helper::checkaddons('language')): ?>
                <div class="position-relative mx-1">
                    <div class="dropdown d-lg-block d-none">
                        <a class="btn btn-sm border-primary dropdown-toggle" href="javascript:void(0)" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo e(helper::image_path(session()->get('flag'))); ?>" alt=""
                                class="mx-1 rounded-5 language-width">
                            <span
                                class="<?php echo e(Session::get('theme') == 'dark' ? 'text-white' : ''); ?>"><?php echo e(session()->get('language')); ?>

                            </span>
                        </a>
                        <ul
                            class="dropdown-menu drop-menu <?php echo e(session()->get('direction') == 2 ? 'drop-menu-rtl' : 'drop-menu'); ?>">
                            <?php $__currentLoopData = helper::language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item d-flex text-start d-flex"
                                        href="<?php echo e(URL::to('/language-' . $lang->code)); ?>">
                                        <img src="<?php echo e(helper::image_path($lang->image)); ?>" alt=""
                                            class="img-fluid mx-1 rounded-5 language-width">
                                        <?php echo e($lang->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- language-btn -->
                    <div class="dropdown d-block d-lg-none">
                        <a class="btn text-dark border dropdown-toggle px-3 py-1 fs-6" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-globe fs-5"></i></a>
                        <ul class="dropdown-menu <?php echo e(session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdown'); ?>"
                            aria-labelledby="dropdownMenuButton1">
                            <?php $__currentLoopData = helper::language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item text-dark d-flex"
                                        href="<?php echo e(URL::to('/language-' . $lang->code)); ?>">
                                        <img src="<?php echo e(helper::image_path($lang->image)); ?>"
                                            class="img-fluid lag-img mx-1 rounded-5 language-width"
                                            alt=""><?php echo e($lang->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- language-btn -->
                </div>
            <?php endif; ?>
            <div class="dropwdown d-inline-block">
                <button class="btn header-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(helper::image_path(Auth::user()->profile_image)); ?>">
                    <span class="d-none d-xxl-inline-block d-xl-inline-block ms-1"><?php echo e(Auth::user()->name); ?></span>
                    <i class="fa-regular fa-angle-down d-none d-xxl-inline-block d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu box-shadow">
                    <?php if(Auth::user()->type != 1): ?>
                        <?php if(in_array('22', explode(',', helper::get_roles()))): ?>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo e(URL::to('admin/settings#edit_profile')); ?>">
                                <i class="fa-regular fa-user mx-2"></i><?php echo e(trans('labels.edit_profile')); ?> </a>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo e(URL::to('admin/settings#change_password')); ?>">
                                <i class="fa-regular fa-key mx-2"></i><?php echo e(trans('labels.change_password')); ?> </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="dropdown-item d-flex align-items-center"
                            href="<?php echo e(URL::to('admin/settings#edit_profile')); ?>">
                            <i class="fa-regular fa-user mx-2"></i><?php echo e(trans('labels.edit_profile')); ?> </a>
                        <a class="dropdown-item d-flex align-items-center"
                            href="<?php echo e(URL::to('admin/settings#change_password')); ?>">
                            <i class="fa-regular fa-key mx-2"></i><?php echo e(trans('labels.change_password')); ?> </a>
                    <?php endif; ?>
                    <a class="dropdown-item d-flex align-items-center cursor-pointer"
                        onclick="logout('<?php echo e(URL::to('/admin/logout')); ?>')">
                        <i class="fa-regular fa-arrow-right-from-bracket mx-2"></i><?php echo e(trans('labels.logout')); ?> </a>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/theme/header.blade.php ENDPATH**/ ?>