<!doctype html>
<html lang="en" dir="<?php echo e(session('direction') == 2 ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="<?php echo e(@helper::appdata()->og_title); ?>" />
    <meta property="og:description" content="<?php echo e(@helper::appdata()->og_description); ?>" />
    <meta property="og:image" content='<?php echo e(helper::image_path(@helper::appdata()->og_image)); ?>' />
    <title> <?php echo e(@helper::appdata()->title); ?> <?php echo $__env->yieldContent('page_title'); ?></title>
    <link rel="icon" href="<?php echo e(helper::image_path(@helper::appdata()->favicon)); ?>"><!-- Favicon -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/bootstrap.min.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/owl_carousel/owl.carousel.min.css')); ?>">
    <!-- owl-carousel css -->
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/owl_carousel/owl.theme.default.min.css')); ?>">
    <!-- owl-carousel css -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/font_awesome/all.css')); ?>">
    <!-- Font Awesome CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/toastr/toastr.min.css')); ?>">
    <!-- Toastr CSS -->
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/sweetalert/sweetalert2.min.css')); ?>">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/style.css')); ?>"><!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/responsive.css')); ?>">
    <!-- Media Query Resposive CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/fancybox/fancybox-v4-0-27.css')); ?>">
    <!-- Fancybox 4.0 CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/css/animate.min.css')); ?>">
    <!-- home banner animation CSS -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <!-- PWA -->
    <?php if(@helper::checkaddons('pwa')): ?>
        <?php if(helper::appdata()->pwa == 1): ?>
            <?php echo $__env->make('web.pwa.pwa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
    <style>
        :root {
            --bs-primary: <?php echo e(helper::appdata()->web_primary_color != null ? helper::appdata()->web_primary_color : '#F82647'); ?>;
            --bs-secondary: <?php echo e(helper::appdata()->web_secondary_color != null ? helper::appdata()->web_secondary_color : '#FFC344'); ?>;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>


    <!-- Barion Base Pixel -->
    <script>
        // Create BP element on the window
        window["bp"] = window["bp"] || function () {
            (window["bp"].q = window["bp"].q || []).push(arguments);
        };
        window["bp"].l = 1 * new Date();

        // Insert a script tag on the top of the head to load bp.js
        var scriptElement = document.createElement("script");
        var firstScript = document.getElementsByTagName("script")[0];
        scriptElement.async = true;
        scriptElement.src = "https://pixel.barion.com/bp.js";
        firstScript.parentNode.insertBefore(scriptElement, firstScript);

        // Saját pixel ID
        window["barion_pixel_id"] = "BPT-ENlCTnu71e-46"; //TODO:live-ra átirni majd

        // Init esemény elküldése
        bp("init", "addBarionPixelId", window["barion_pixel_id"]);
    </script>

    <noscript>
        <img height="1" width="1" style="display:none" alt="Barion Pixel"
             src="https://pixel.barion.com/a.gif?ba_pixel_id=BPT-ENlCTnu71e-46&ev=contentView&noscript=1">
    </noscript>
</head>

<body>
    <main id="main-content" class="">
        <div class="wrapper">
            <input type="hidden" name="hdnsession" id="hdnsession" value="<?php echo e(session()->get('direction')); ?>">
            <?php echo $__env->make('web.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo $__env->make('web.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- index CART item modal -->
            <?php if(!request()->is('cart') && !request()->is('checkout')): ?>
                <?php if(helper::get_user_cart() != 0): ?>
                    <div class="cart-modal rounded-bottom-0">
                        <div class="rounded-lg">
                            <div class="d-flex gap-3 justify-content-between align-items-center">
                                <p class="mb-0 text-white fs-7 fw-600 d-flex align-items-center gap-1"><span
                                        class="count"><?php echo e(helper::get_user_cart()); ?></span>
                                    <?php echo e(trans('labels.item_added')); ?> </p>
                                <a href="<?php echo e(route('cart')); ?>" class="text-white fw-500 fs-7 text-uppercase">
                                    <?php echo e(trans('labels.view')); ?> <?php echo e(trans('labels.cart')); ?>

                                    <i class="fa-solid fa-bag-shopping ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            
            <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </main>

    <!-- Modal Item Details -->
    <div class="modal modalitemdetails" id="modalitemdetails" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" id="modalitem_body">
            </div>
        </div>
    </div>

    <!-- All modals here -->

    <!-- Product Allergens Modal -->
    <div class="modal" id="itemallergens" tabindex="-1" aria-labelledby="itemallergensTitle" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h1 class="modal-title fs-5" id="itemallergensTitle"><?php echo e(trans('labels.allergens')); ?></h1>
                    <button type="button" class="btn-close <?php echo e(session()->get('direction') == '2' ? 'm-0' : ''); ?>"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-0" id="allergensDisplay"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Subscribe-->
    <div class="modal" id="NewsModal" tabindex="-1" aria-labelledby="NewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 overflow-hidden">
                <div class="modal-body p-0 position-relative">
                    <button type="button"
                        class="btn-close box-shadow-none <?php echo e(session()->get('direction') == '2' ? 'rtl' : ''); ?>"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row g-0 align-items-center justify-content-between">
                        <div class="col-6 d-none d-lg-block">
                            <img src="<?php echo e(helper::image_path(@helper::appdata()->subscribe_newsletter_image)); ?>"
                                alt="" class="w-100 object-fit-cover newslatter-img">
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="py-5 px-4 px-sm-5">
                                <h2 class="subscribe-title mt-1"><?php echo e(trans('labels.newsletter')); ?></h2>
                                <p class="text-dark fw-500 fs-7 mb-4">
                                    <?php echo e(trans('labels.subscribe_title')); ?>

                                </p>
                                <form method="post" action="<?php echo e(route('subscribe')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <label class="text-black form-label fs-7 mb-1"><?php echo e(trans('labels.email')); ?></label>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control border text-dark fw-500 bg-light"
                                            name="subscribe_email" placeholder="<?php echo e(trans('labels.email')); ?>"
                                            required="">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-secondary w-100 py-2"><?php echo e(trans('labels.subscribe')); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(@helper::checkaddons('age_verification')): ?>
        <?php echo $__env->make('web.age_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(@helper::checkaddons('sales_notification')): ?>
        <?php echo $__env->make('web.sales_notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!-- Quick call -->
    <?php if(@helper::checkaddons('quick_call')): ?>
        <?php if(@helper::appdata()->quick_call == 1): ?>
        <?php echo $__env->make('web.quick_call', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>


    <!-- MODAL_working_hours--START -->
    <div class="modal" id="modal_working_hours" tabindex="-1" aria-labelledby="working_hours_Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="working_hours_Label"><?php echo e(trans('labels.working_hours')); ?></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = helper::gettime(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between fs-7"> <?php echo e(ucfirst($time->day)); ?>

                                <?php if($time->always_close == 1): ?>
                                    <span class="text-danger fs-6"><?php echo e(trans('labels.closing_time')); ?></span>
                                <?php else: ?>
                                    <span><?php echo e($time->open_time); ?> <b><?php echo e(trans('labels.to')); ?></b>
                                        <?php echo e($time->break_start); ?>

                                        <br>
                                        <?php echo e($time->break_end); ?> <b><?php echo e(trans('labels.to')); ?></b>
                                        <?php echo e($time->close_time); ?>

                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger px-4 py-2"
                        data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL_working_hours--END -->

    <!-- MODAL_USER_TYPE_SELECTION--START -->
    <div class="modal" id="useroption" tabindex="-1" aria-labelledby="useroptionLabel"
      aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="useroptionLabel">
                        <?php echo e(trans('labels.proceed_as_guest_or_login')); ?>

                    </h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-7 twoline">
                        <?php echo e(trans('labels.dont_have_account_guest')); ?>

                    </p>
                    <div class="row g-2 justify-content-start social-share-icon mt-3">
                        <div class="col-md-6 col-12">
                            <a class="btn btn-outline-dark w-100 p-2" href="javascript:void(0)"
                                onclick="showlogin()" type="button">
                                <i class="fa-solid fa-user-plus"></i>
                                <span class="px-2"><?php echo e(trans('labels.create_account')); ?></span>
                            </a>
                        </div>
                        <div class="col-md-6 col-12">
                            <a class="btn btn-primary w-100 p-2" target="_blank" onclick="checkout()">
                                <i class="fa-solid fa-address-card"></i>
                                <span
                                    class="px-2"><?php echo e(trans('labels.continue_as_guest')); ?></span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL_USER_TYPE_SELECTION--END -->

    <!-- ADD_REVIEW_ODAL_START -->
    <div class="modal" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold" id="reviewmodalLabel">
                        <?php echo e(trans('labels.add_review')); ?></h4>
                    <button type="button" class="btn-close <?php echo e(session()->get('direction') == 2 ? 'close' : ''); ?>"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(URL::to('/add-review')); ?>" method="POST" class="mb-0">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group col-lg-12">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="review-modal-img">
                                        <img src="" class="h-100 w-100 object-fit-cover rounded-4 border" />
                                    </div>
                                    <p class="fw-600 mb-0" id="data-item-name"></p>
                                </div>
                                <div class="star-rating">
                                    <?php for($i = 5; $i > 0; $i = $i - 1): ?>
                                        <input type="radio" id="<?php echo e($i); ?>" name="rating"
                                            onclick="$('#ratting').val('<?php echo e($i); ?>')"
                                            <?php echo e($i == 1 ? 'checked' : ''); ?>>
                                        <label for="<?php echo e($i); ?>"><i class="fa-solid fa-star fs-4"
                                                aria-hidden="true"></i></label>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" name="ratting" id="ratting" value="1">
                            </div>
                            <div class="mt-3">
                                <label for="form-label"><span class="fs-7"><?php echo e(trans('labels.write_review')); ?>

                                        (<?php echo e(trans('labels.optional')); ?>)</span></label>
                                <textarea name="comment" rows="2" class="form-control mt-1" placeholder="Message"></textarea>
                            </div>
                            <input type="hidden" name="item_id" id="data-item-id" value="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center border-0">
                        <div class="row g-2 w-100">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-danger px-4 fs-7 w-100"
                                    data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit"
                                    class="btn btn-primary px-4 fs-7 w-100"><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ADD_REVIEW_ODAL_END -->


    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/jquery/jquery-3.6.0.js')); ?>"></script><!-- jQuery JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/owl_carousel/owl.carousel.js')); ?>"></script><!-- owl carousel js -->
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- Bootstrap CSS -->
    <!-- COMMON-FOR-TOASTER-&-SWEETALERT -->
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/toastr/toastr.min.js')); ?>"></script><!-- Toastr JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/sweetalert/sweetalert2.min.js')); ?>"></script><!-- Sweetalert JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/fancybox/fancybox-v4-0-27.js')); ?>"></script><!-- Fancybox 4.0 JS -->

    <?php if(@helper::checkaddons('age_verification')): ?>
        <?php if(@helper::getagedetails($vendordata->id)->age_verification_on_off == 1): ?>
            <script src="<?php echo e(url('resources/js/age.js')); ?>"></script>
        <?php endif; ?>
    <?php else: ?>
        <script>
            $('#main-content').removeClass('blur');
        </script>
    <?php endif; ?>

    <!-- whatsapp chat -->
    <?php if(@helper::checkaddons('whatsapp_message')): ?>
        <?php if(@helper::getwhatsappmessage()->whatsapp_chat_on_off == 1): ?>
            <?php echo $__env->make('web.whatsapp_chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
    <!-- whatsapp_message btn end -->

    <!-- tawk chat -->
    <?php if(@helper::checkaddons('tawk_addons')): ?>
        <?php if(@helper::appdata()->tawk_on_off == 1): ?>
            <?php echo @helper::appdata()->tawk_widget_id; ?>

        <?php endif; ?>
    <?php endif; ?>

    <!-- wizz chat -->
    <?php if(@helper::checkaddons('wizz_chat')): ?>
        <?php if(@helper::appdata()->wizz_chat_on_off == 1): ?>
            <?php echo @helper::appdata()->wizz_chat_settings; ?>

        <?php endif; ?>
    <?php endif; ?>

    <script>
        // COMMON-SCRIPTS
        // to-display-success-error-message
        toastr.options = {
            "closeButton": true,
        }
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>
        // for-sweetalert
        let are_you_sure = "<?php echo e(trans('messages.are_you_sure')); ?>";
        let yes = "<?php echo e(trans('messages.yes')); ?>";
        let no = "<?php echo e(trans('messages.no')); ?>";
        let wrong = "<?php echo e(trans('messages.wrong')); ?>";
        let record_safe = "<?php echo e(trans('messages.record_safe')); ?>";
        let okay = "<?php echo e(trans('labels.okay')); ?>";
        let track_order = "<?php echo e(trans('labels.track_order')); ?>";
        let continue_shopping = "<?php echo e(trans('labels.continue_shopping')); ?>";
        let order_placed = "<?php echo e(trans('labels.order_placed')); ?>";
        let order_placed_note = "<?php echo e(trans('messages.order_placed_note')); ?>";
        let restaurant_closed = "<?php echo e(trans('messages.restaurant_closed')); ?>";
        // others
        function currency_format(price) {
            "use strict";
            if ("<?php echo e(@helper::appdata()->currency_position); ?>" == 1) {
                return "<?php echo e(@helper::appdata()->currency); ?>" + parseFloat(price).toFixed(2);
            } else {
                return parseFloat(price).toFixed(2) + "<?php echo e(@helper::appdata()->currency); ?>";
            }
        }

        // top deals parameter
        var start_date = "<?php echo e(@$topdeals->start_date); ?>";
        var start_time = "<?php echo e(@$topdeals->start_time); ?>";
        var end_date = "<?php echo e(@$topdeals->end_date); ?>";
        var end_time = "<?php echo e(@$topdeals->end_time); ?>";
        <?php if(@helper::checkaddons('top_deals')): ?>
            var enddate = "<?php echo e(App\Models\TopDeals::first()->end_date); ?>";
            var endtime = "<?php echo e(App\Models\TopDeals::first()->end_time); ?>";
            var deal_type = "<?php echo e(App\Models\TopDeals::first()->deal_type); ?>";
        <?php else: ?>
            var enddate = null;
            var endtime = null;
        <?php endif; ?>
        var topdeals = "<?php echo e(!empty(@$topdealsproduct) ? 1 : 0); ?>";
        var time_zone = "<?php echo e(helper::appdata()->timezone); ?>";
        var current_date = "<?php echo e(\Carbon\Carbon::now()->toDateString()); ?>";

        var siteurl = "<?php echo e(URL::to('/')); ?>";
    </script>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/custom/top_deals.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/common.js')); ?>"></script><!-- web-common-js -->

    <?php if(@helper::checkaddons('sales_notification')): ?>
        <?php if(helper::appdata()->fake_sales_notification == 1): ?>
        <script>
            if ("<?php echo e(@helper::appdata()->fake_sales_notification); ?>" == "1") {
                // Select the element with the ID 'sales-booster-popup'
                const popup = document.getElementById('sales-booster-popup');

                if (popup) {
                    // Define a function to add and remove the 'loaded' class
                    let isMouseOver = false;
                    const toggleLoadedClass = () => {
                        // Add the 'loaded' class
                        popup.classList.add('loaded');
                        // Remove the 'loaded' class after 5 seconds, unless the mouse is over the popup
                        setTimeout(() => {
                            if (!isMouseOver) {
                                popup.classList.remove('loaded');
                            }
                        }, "<?php echo e(helper::appdata()->notification_display_time); ?>"); // 4000 milliseconds = 4 seconds for demo purposes
                    };

                    // Function to handle mouseover event
                    const handleMouseOver = () => {
                        isMouseOver = true;
                        // You can perform actions here when mouse is over the popup
                    };

                    // Function to handle mouseout event
                    const handleMouseOut = () => {
                        isMouseOver = false;
                    };

                    // Call the function initially
                    toggleLoadedClass();

                    setInterval(function()
                    {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "<?php echo e(URL::to('get_notification_data')); ?>",

                            method: 'POST',
                            success: function(response) {
                                toggleLoadedClass();
                                $('#sales-booster-popup').show();
                                $('#notification_body').html(response.output);
                            },
                        });
                    }, "<?php echo e(helper::appdata()->notification_display_time+helper::appdata()->next_time_popup); ?>"); // 8000 milliseconds = 8 seconds

                    // Add mouseover and mouseout event listeners to the popup
                    popup.addEventListener('mouseover', handleMouseOver);
                    popup.addEventListener('mouseout', handleMouseOut);

                    // Select the close button within the popup
                    const closeButton = popup.querySelector('.close'); // Close button selector

                    if (closeButton) {
                        // Add an event listener to the close button
                        closeButton.addEventListener('click', () => {
                            // Remove the 'loaded' class immediately
                            popup.classList.remove('loaded');
                        });
                    }
                }
            }
        </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/web/layout/default.blade.php ENDPATH**/ ?>