<!-- header section start -->
<header>

    <div class="header-bar" id="header1">
        <nav class="navbar navbar-expand-lg sticky-top p-0">
            <div class="container navbar-container">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <img class="img-resposive img-fluid" src="<?php echo e(helper::image_path(@helper::appdata()->logo)); ?>"
                         alt="logo">
                </a>
                <!-- language-btn -->
                <?php if(@helper::checkaddons('language')): ?>
                    <div class="buttons d-flex align-items-center">
                        <div class="dropdown d-block d-lg-none">
                            <a class="btn text-white dropdown px-1 fs-6 border-0 header-box" type="button"
                               id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-globe fs-5"></i></a>
                            <ul class="dropdown-menu <?php echo e(session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdown'); ?>"
                                aria-labelledby="dropdownMenuButton1">
                                <?php $__currentLoopData = helper::language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a class="dropdown-item text-dark d-flex gap-2"
                                           href="<?php echo e(URL::to('/language-' . $lang->code)); ?>">
                                            <img src="<?php echo e(helper::image_path($lang->image)); ?>"
                                                 class="img-fluid lag-img rounded-5" alt=""><?php echo e($lang->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                    </div>
                <?php endif; ?>
                <!-- language-btn -->

                
                <div class="navbar-collapse collapse">
                    <div class="navbar-nav mx-auto">
                        <a class="nav-link px-3 <?php echo e(request()->is('/') ? 'active' : ''); ?>"
                           href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        <a class="nav-link px-3 <?php echo e(request()->is('categories') ? 'active' : ''); ?>"
                           href="<?php echo e(route('categories')); ?>"><?php echo e(trans('labels.menu')); ?></a>

                        <a class="nav-link px-3 <?php echo e(request()->is('faq') ? 'active' : ''); ?>"
                           href="<?php echo e(route('faq')); ?>"><?php echo e(trans('labels.faq')); ?></a>
                        <a class="nav-link px-3 <?php echo e(request()->is('contactus') ? 'active' : ''); ?>"
                           href="<?php echo e(route('contact-us')); ?> "><?php echo e(trans('labels.help_contact_us')); ?></a>



                    </div>
                    <div class="d-flex gap-3 align-items-center nav-sidebar-d-none">
                        <!-- language-btn -->
                        <?php if(@helper::checkaddons('language')): ?>
                            <div class="lag dropdown">
                                <a class="header-box" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                   aria-expanded="false"><img src="<?php echo e(helper::image_path(Session::get('flag'))); ?>"
                                                              class="img-fluid lag-img rounded-5" alt=""></a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php $__currentLoopData = helper::language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a class="dropdown-item text-dark d-flex gap-2"
                                               href="<?php echo e(URL::to('/language-' . $lang->code)); ?>"><img
                                                    src="<?php echo e(helper::image_path($lang->image)); ?>"
                                                    class="img-fluid lag-img rounded-5"
                                                    alt=""><?php echo e($lang->name); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="header-search header-box">
                            <input type="text" class="search-form" placeholder="<?php echo e(trans('labels.search_here')); ?>"
                                   required>
                            <?php if(session()->get('direction') == ''): ?>
                                <a href="<?php echo e(route('search')); ?>" class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            <?php elseif(session()->get('direction') == '2'): ?>
                                <a href="<?php echo e(route('search')); ?>" class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('search')); ?>" class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <!-- cart-btn -->
                        <div class="cart-area header-box">
                            <a href="<?php echo e(route('cart')); ?>" class="text-white">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="cart-badge"><?php echo e(helper::get_user_cart()); ?></span>
                            </a>
                        </div>

                        <!-- user-btn -->
                        <div class="header-box ">
                            <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                <a class="nav-link text-white" href="<?php echo e(route('user-profile')); ?>" role="button">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="text-white"><i class="fa-solid fa-user"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- header section end -->

<!-- offer btn start-->
<div class="<?php echo e(session()->get('direction') == '2' ? 'rtl-buttons' : 'ltr-buttons'); ?>">
    <?php if(@helper::checkaddons('coupon')): ?>
        <?php if(!empty(helper::getoffers()) && count(helper::getoffers()) > 0): ?>
            <button class="btn btn-primary offer-button" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasOffer" aria-controls="offcanvasOffer">
                <i class="fa-sharp fa-solid fa-badge-percent"></i> <?php echo e(trans('labels.offers')); ?>

            </button>
        <?php endif; ?>
    <?php endif; ?>
</div>
<div class="offer">
    <div class="offcanvas <?php echo e(session()->get('direction') == '2' ? 'offcanvas-start' : 'offcanvas-end'); ?>"
         tabindex="-1" id="offcanvasOffer" aria-labelledby="offcanvasOfferLabel">
        <div class="offcanvas-header border-bottom bg-light">
            <div class="d-flex d-grid gap-2 align-items-center">
                <i class="fa-sharp fa-solid fa-badge-percent"></i>
                <h5 class="offcanvas-title fw-600" id="offcanvasOfferLabel"><?php echo e(trans('labels.offers')); ?></h5>
            </div>
            <button type="button"
                    class="btn-close <?php echo e(session()->get('direction') == '2' ? 'me-auto ms-0' : 'ms-auto me-0'); ?>"
                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row g-3">
                <?php $__currentLoopData = helper::getoffers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $count = helper::getcouponcodecount($offers->offer_code);
                    ?>
                    <?php if($offers->usage_type == 1): ?>
                        <?php if($count < $offers->usage_limit): ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="coupons-label"><?php echo e($offers->offer_code); ?></span>
                                            <?php if(request()->is('checkout')): ?>
                                                <p class="fw-500 cursor-pointer copy_coupon_code mb-0"
                                                   data-bs-dismiss="offcanvas"
                                                   onclick="getoffercode('<?php echo e($offers->offer_code); ?>')">
                                                    <?php echo e(trans('labels.copy_code')); ?>

                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <h5 class="pt-3 mb-0 offer-text"><?php echo e($offers->offer_name); ?></h5>
                                        <p class="text-muted fw-400 fs-8 pt-2 mb-0"><?php echo e($offers->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="coupons-label"><?php echo e($offers->offer_code); ?></span>
                                        <?php if(request()->is('checkout')): ?>
                                            <p class="fw-500 cursor-pointer copy_coupon_code mb-0"
                                               data-bs-dismiss="offcanvas"
                                               onclick="getoffercode('<?php echo e($offers->offer_code); ?>')">
                                                <?php echo e(trans('labels.copy_code')); ?>

                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="pt-3 mb-0 offer-text"><?php echo e($offers->offer_name); ?></h5>
                                    <p class="text-muted fw-400 fs-8 pt-2 mb-0"><?php echo e($offers->description); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<!-- offer btn end-->

<div class="mobile_menu_footer d-lg-none">
    <div class="container">
        <ul class="d-flex justify-content-between align-items-center mb-0 gap-3">
            <li class="text-center">
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->is('/') ? 'active1' : ''); ?>">
                    <i class="fa-light fa-house"></i>
                    <p class="mb-0"><?php echo e(trans('labels.home')); ?></p>
                </a>
            </li>
            <li class="text-center">
                <a href="<?php echo e(route('search')); ?>" class="<?php echo e(request()->is('search') ? 'active1' : ''); ?>">
                    <i class="fa-light fa-magnifying-glass"></i>
                    <p class="mb-0"><?php echo e(trans('labels.search')); ?></p>
                </a>
            </li>
            <li class="text-center">
                <a href="<?php echo e(route('cart')); ?>" class="<?php echo e(request()->is('cart') ? 'active1' : ''); ?>">
                    <div class="position-relative">
                        <i class="fa-light fa-bag-shopping"></i>
                        <span class="qut_counter"><?php echo e(helper::get_user_cart()); ?></span>
                    </div>
                    <p class="mb-0"><?php echo e(trans('labels.cart')); ?></p>
                </a>
            </li>
            <li class="text-center">
                <a href="<?php echo e(Auth::user() ? route('user-favouritelist') : route('login')); ?>"
                   class="<?php echo e(request()->is('favouritelist') ? 'active1' : ''); ?>">
                    <i class="fa-light fa-heart"></i>
                    <p class="mb-0"><?php echo e(trans('labels.wishlist')); ?></p>
                </a>
            </li>
            <li class="text-center">
                <a href="<?php echo e(Auth::user() ? route('user-profile') : route('login')); ?>"
                   class="<?php echo e(request()->is('profile') ? 'active1' : ''); ?>">
                    <i class="fa-light fa-user"></i>
                    <p class="mb-0"><?php echo e(trans('labels.account')); ?></p>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/web/layout/header.blade.php ENDPATH**/ ?>