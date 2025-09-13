<!DOCTYPE html>
<html lang="en" dir="<?php echo e(session('direction') == 2 ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(@helper::appdata()->title); ?> | <?php echo e(trans('labels.admin_title')); ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(helper::image_path(@helper::appdata()->favicon)); ?>">
    <link rel="stylesheet"
          href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/bootstrap/bootstrap.min.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/fontawesome/all.min.css')); ?>">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/toastr/toastr.min.css')); ?>">
    <!-- Toastr CSS -->
    <link rel="stylesheet"
          href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/sweetalert/sweetalert2.min.css')); ?>">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/style.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/responsive.css')); ?>">
    <!-- Responsive CSS -->
    <link rel="stylesheet"
          href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/datatables/dataTables.bootstrap5.min.css')); ?>">
    <!-- dataTables css -->
    <link rel="stylesheet"
          href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/datatables/dataTables.bootstrap5.min.css')); ?>">
    <!-- dataTables css -->
    <link rel="stylesheet"
          href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/datatables/buttons.dataTables.min.css')); ?>">
    <!-- dataTables css -->
    <style>
        :root {
            --bs-primary: <?php echo e(@helper::appdata()->admin_primary_color != null ? @helper::appdata()->admin_primary_color : '#01112B'); ?>;
            --bs-secondary: <?php echo e(@helper::appdata()->admin_secondary_color != null ? @helper::appdata()->admin_secondary_color : '#0a98af'); ?>;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>

<main>
    <div class="wrapper">
        <?php echo $__env->make('admin.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-wrapper">
            <?php echo $__env->make('admin.theme.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="<?php echo e(session()->get('direction') == 2 ? 'main-content-rtl' : 'main-content'); ?>">
                <div class="page-content">
                    <?php if(helper::check_alert() == 0): ?>
                        <div class="alert alert-danger text-center">
                            <a href="<?php echo e(URL::to('admin/settings')); ?>" class="text-dark"> <i class="fa fa-cog"></i>
                                <?php echo e(trans('messages.settings_note')); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
        <!--Modal: order-modal-->
        <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header d-flex justify-content-center">
                        <p class="heading"><?php echo e(trans('messages.be_up_to_date')); ?></p>
                    </div>
                    <div class="modal-body"><i class="fa fa-bell fa-4x animated rotateIn mb-4"></i>
                        <p><?php echo e(trans('messages.new_order_arrive')); ?></p>
                    </div>
                    <div class="modal-footer flex-center">
                        <a role="button" class="btn btn-outline-secondary-modal btn-primary waves-effect"
                           onclick="window.location.reload();"
                           data-bs-dismiss="modal"><?php echo e(trans('labels.okay')); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal: modalPush-->
        <!-- ASSIGN-DRIVER-MODAL-START -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                                class="btn-close <?php echo e(session()->get('direction') == 2 ? 'close' : ''); ?>"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="assign">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="driverurl" id="driverurl"
                               value="<?php echo e(URL::to('admin/orders/assign-driver')); ?>">
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="order_id" name="order_id" readonly>
                            <div class="form-group">
                                <label for="category_id"
                                       class="col-form-label"><?php echo e(trans('labels.order_number')); ?></label>
                                <input type="text" class="form-control" id="order_number" readonly="">
                                <span class="id_error text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="category_id"
                                       class="col-form-label"><?php echo e(trans('messages.select_driver')); ?>

                                </label>
                                <select class="form-control" name="driver_id" id="driver_id" required="required">
                                    <option value="" selected><?php echo e(trans('messages.select_driver')); ?>

                                    </option>
                                    <?php if(is_array(@$getdriver) || is_object(@$getdriver)): ?>
                                        <?php $__currentLoopData = @$getdriver; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($driver->id); ?>">
                                                <?php echo e($driver->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <span class="driver_error text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                            <button type="button" class="btn btn-primary"
                                    onclick="assigndriver()"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ASSIGN-DRIVER-MODAL-END -->
        <footer class="py-3 text-center bg-white fixed-bottom border-top"><?php echo e(helper::appdata()->copyright); ?>

        </footer>
    </div>
</main>
<?php echo $__env->make('admin.theme.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            toastr.error('<?php echo e($error); ?>');
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<script type="text/javascript">
    let are_you_sure = "<?php echo e(trans('messages.are_you_sure')); ?>";
    let yes = "<?php echo e(trans('messages.yes')); ?>";
    let no = "<?php echo e(trans('messages.no')); ?>";
    let wrong = "<?php echo e(trans('messages.wrong')); ?>";
    let cannot_delete = "<?php echo e(trans('messages.cannot_delete')); ?>";
    let last_image = "<?php echo e(trans('messages.last_image')); ?>";
    let record_safe = "<?php echo e(trans('messages.record_safe')); ?>";
    let select = "<?php echo e(trans('labels.select')); ?>";
    let variation = "<?php echo e(trans('labels.variation')); ?>";
    let enter_variation = "<?php echo e(trans('labels.variation')); ?>";
    let product_price = "<?php echo e(trans('labels.product_price')); ?>";
    let enter_product_price = "<?php echo e(trans('labels.product_price')); ?>";
    let sale_price = "<?php echo e(trans('labels.sale_price')); ?>";
    let enter_sale_price = "<?php echo e(trans('labels.sale_price')); ?>";

    function currency_format(price) {
        if ("<?php echo e(@helper::appdata()->currency_position); ?>" == 1) {
            return "<?php echo e(@helper::appdata()->currency); ?>" + parseFloat(price).toFixed(2);
        } else {
            return parseFloat(price).toFixed(2) + "<?php echo e(@helper::appdata()->currency); ?>";
        }
    }
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    <?php if(Session::has('success')): ?>
    toastr.success("<?php echo e(session('success')); ?>");
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
    toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>

</script>




<script type="text/javascript">
    // --- New Notification + 2 percenkénti hang, amíg a popup nyitva van ---
    var noticount = 0;
    var orderReminderTimer = null;
    var isOrderModalOpen = false;
    var reminderAudio = null;

    // ÚJ: számláló + egyszeri e-mail flag
    var reminderHitCount = 0;
    var emailAlertSent   = false;

    // modal állapotkövetés (megbízhatóbb, mint :visible)
    $(document).on('shown.bs.modal', '#order-modal', function () {
        isOrderModalOpen = true;
    });
    $(document).on('hidden.bs.modal', '#order-modal', function () {
        isOrderModalOpen = false;
        if (orderReminderTimer) { clearInterval(orderReminderTimer); orderReminderTimer = null; }
        if (reminderAudio) { try { reminderAudio.pause(); } catch(e){} }
        // ÚJ: reseteljük a számlálót és az e-mail flaget, ha bezárták
        reminderHitCount = 0;
        emailAlertSent   = false;
    });

    function maybeSendEmailAlert(currentCount) {
        if (reminderHitCount >= 8 && !emailAlertSent) {  //3 problakozas utan
            // egyszer küldünk, aztán nem spammelünk
            emailAlertSent = true;
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "<?php echo e(url('admin/order-unprocessed-alert')); ?>",   // lásd a route-ot lejjebb
                method: 'POST',
                dataType: 'json',
                data: {
                    count: currentCount    // opcionális infó a backendre
                }
            });
        }
    }

    function startOrderReminder(soundUrl, currentCount) {
        if (!reminderAudio || reminderAudio.src !== soundUrl) {
            reminderAudio = new Audio(soundUrl);
            reminderAudio.preload = 'auto';
        }
        if (orderReminderTimer) return; // már fut

        orderReminderTimer = setInterval(function () {
            if (isOrderModalOpen) {
                try {
                    reminderAudio.currentTime = 0;
                    reminderAudio.play().catch(function(){});
                    // ÚJ: minden ismétlés számít
                    reminderHitCount++;
                    maybeSendEmailAlert(currentCount);
                } catch(e){}
            } else {
                clearInterval(orderReminderTimer);
                orderReminderTimer = null;
            }
        }, 120000); // 120 000 ms = 2 perc
        //TODO: teszteléshez 15 mp
    }

    (function noti() {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "<?php echo e(url('admin/getorder')); ?>",
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                var prev    = Number(localStorage.getItem("count") || 0);
                var current = Number(response.count || 0);

                // jelvény frissítés
                $('#notificationcount').text(current > 9 ? (current + "+") : current);

                if (current !== 0 && current !== prev) {
                    localStorage.setItem("count", String(current));

                    var $modal   = $("#order-modal");
                    var soundUrl = "<?php echo e(url(env('ASSETSPATHURL'))); ?>/admin-assets/notification/" + response.noti;

                    // popup fel és első hang
                    $modal.modal('show');

                    if (!reminderAudio || reminderAudio.src !== soundUrl) {
                        reminderAudio = new Audio(soundUrl);
                        reminderAudio.preload = 'auto';
                    }
                    // első lejátszás
                    reminderAudio.currentTime = 0;
                    reminderAudio.play().catch(function(){});

                    // ÚJ: első lejátszás is számít
                    reminderHitCount = 1;
                    emailAlertSent   = false; // új batchnél nullázzuk
                    maybeSendEmailAlert(current);

                    // 2 percenkénti emlékeztető, amíg nyitva van
                    startOrderReminder(soundUrl, current);

                } else if (current !== prev) {
                    localStorage.setItem("count", String(current));
                }

                setTimeout(noti, 6000); // 5 mp-enként poll
            }
        });
    })();
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/js/common.js')); ?>"></script><!-- Common JS -->
<?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/theme/default.blade.php ENDPATH**/ ?>