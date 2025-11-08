<!DOCTYPE html>
<html lang="en" dir="{{ session('direction') == 2 ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @helper::appdata()->title }} | {{ trans('labels.admin_title') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ helper::image_path(@helper::appdata()->favicon) }}">
    <link rel="stylesheet"
          href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/bootstrap/bootstrap.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/fontawesome/all.min.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/toastr/toastr.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet"
          href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/style.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/responsive.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet"
          href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    <!-- dataTables css -->
    <link rel="stylesheet"
          href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    <!-- dataTables css -->
    <link rel="stylesheet"
          href="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/css/datatables/buttons.dataTables.min.css') }}">
    <!-- dataTables css -->
    <style>
        :root {
            --bs-primary: {{ @helper::appdata()->admin_primary_color != null ? @helper::appdata()->admin_primary_color : '#01112B' }};
            --bs-secondary: {{ @helper::appdata()->admin_secondary_color != null ? @helper::appdata()->admin_secondary_color : '#0a98af' }};
        }
    </style>
    @yield('styles')
</head>

<body>
{{-- @include('admin.theme.preloader') --}}
<main>
    <div class="wrapper">
        @include('admin.theme.header')
        <div class="content-wrapper">
            @include('admin.theme.sidebar')
            <div class="{{ session()->get('direction') == 2 ? 'main-content-rtl' : 'main-content' }}">
                <div class="page-content">
                    @if (helper::check_alert() == 0)
                        <div class="alert alert-danger text-center">
                            <a href="{{ URL::to('admin/settings') }}" class="text-dark"> <i class="fa fa-cog"></i>
                                {{ trans('messages.settings_note') }}</a>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
        <!--Modal: order-modal-->
        <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header d-flex justify-content-center">
                        <p class="heading">{{ trans('messages.be_up_to_date') }}</p>
                    </div>
                    <div class="modal-body"><i class="fa fa-bell fa-4x animated rotateIn mb-4"></i>
                        <p>{{ trans('messages.new_order_arrive') }}</p>
                    </div>
                    <div class="modal-footer flex-center">
                        <a role="button" class="btn btn-outline-secondary-modal btn-primary waves-effect"
                           onclick="window.location.reload();"
                           data-bs-dismiss="modal">{{ trans('labels.okay') }}</a>
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
                                class="btn-close {{ session()->get('direction') == 2 ? 'close' : '' }}"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="assign">
                        @csrf
                        <input type="hidden" name="driverurl" id="driverurl"
                               value="{{ URL::to('admin/orders/assign-driver') }}">
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="order_id" name="order_id" readonly>
                            <div class="form-group">
                                <label for="category_id"
                                       class="col-form-label">{{ trans('labels.order_number') }}</label>
                                <input type="text" class="form-control" id="order_number" readonly="">
                                <span class="id_error text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="category_id"
                                       class="col-form-label">{{ trans('messages.select_driver') }}
                                </label>
                                <select class="form-control" name="driver_id" id="driver_id" required="required">
                                    <option value="" selected>{{ trans('messages.select_driver') }}
                                    </option>
                                    @if (is_array(@$getdriver) || is_object(@$getdriver))
                                        @foreach (@$getdriver as $driver)
                                            <option value="{{ $driver->id }}">
                                                {{ $driver->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="driver_error text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal">{{ trans('labels.close') }}</button>
                            <button type="button" class="btn btn-primary"
                                    onclick="assigndriver()">{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ASSIGN-DRIVER-MODAL-END -->
        <footer class="py-3 text-center bg-white fixed-bottom border-top">{{ helper::appdata()->copyright }}
        </footer>
    </div>
</main>
@include('admin.theme.script')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif
<script type="text/javascript">
    let are_you_sure = "{{ trans('messages.are_you_sure') }}";
    let yes = "{{ trans('messages.yes') }}";
    let no = "{{ trans('messages.no') }}";
    let wrong = "{{ trans('messages.wrong') }}";
    let cannot_delete = "{{ trans('messages.cannot_delete') }}";
    let last_image = "{{ trans('messages.last_image') }}";
    let record_safe = "{{ trans('messages.record_safe') }}";
    let select = "{{ trans('labels.select') }}";
    let variation = "{{ trans('labels.variation') }}";
    let enter_variation = "{{ trans('labels.variation') }}";
    let product_price = "{{ trans('labels.product_price') }}";
    let enter_product_price = "{{ trans('labels.product_price') }}";
    let sale_price = "{{ trans('labels.sale_price') }}";
    let enter_sale_price = "{{ trans('labels.sale_price') }}";

    function currency_format(price) {
        if ("{{ @helper::appdata()->currency_position }}" == 1) {
            return "{{ @helper::appdata()->currency }}" + parseFloat(price).toFixed(2);
        } else {
            return parseFloat(price).toFixed(2) + "{{ @helper::appdata()->currency }}";
        }
    }
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    @if (Session::has('success'))
    toastr.success("{{ session('success') }}");
    @endif
    @if (Session::has('error'))
    toastr.error("{{ session('error') }}");
    @endif

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
                url: "{{ url('admin/order-unprocessed-alert') }}",   // lásd a route-ot lejjebb
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
            url: "{{ url('admin/getorder') }}",
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
                    var soundUrl = "{{ url(env('ASSETSPATHURL')) }}/admin-assets/notification/" + response.noti;

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
<script src="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/js/common.js') }}"></script><!-- Common JS -->
@yield('script')
</body>

</html>
