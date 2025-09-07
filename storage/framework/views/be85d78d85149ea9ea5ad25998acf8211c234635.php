<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <?php if(Auth::user()->type == 1 || in_array(0, explode(',',helper::get_roles()))): ?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-list fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.categories')); ?></p>
                                            <h4><?php echo e($gettotalcategory); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-cutlery fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.items')); ?></p>
                                            <h4><?php echo e(count($getitems)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-users fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.customers')); ?></p>
                                            <h4><?php echo e(count($getusers)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa-solid fa-motorcycle fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.drivers')); ?></p>
                                            <h4><?php echo e(count($getdriver)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-shopping-cart fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.total_orders')); ?></p>
                                            <h4><?php echo e(count($getorderscount)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-star fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.reviews')); ?></p>
                                            <h4><?php echo e(count($getreview)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-usd fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.earnings')); ?></p>
                                            <h4><?php echo e(helper::currency_format($order_total - $order_tax)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="dashboard-card">
                                        <span class="card-icon">
                                            <i class="fa fa-calculator fs-5"></i>
                                        </span>
                                        <span class="text-end">
                                            <p class="fw-medium mb-1"><?php echo e(trans('labels.tax')); ?></p>
                                            <h4> <?php echo e(helper::currency_format($order_tax)); ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-4 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <h5 class="card-title"><?php echo e(trans('labels.customers')); ?></h5>
                                <select class="form-select form-select-sm w-auto" id="useryear" data-url="<?php echo e(URL::to('/admin/home')); ?>">
                                    <?php if(!in_array(date('Y'), array_column($user_years->toArray(),'year'))): ?>
                                        <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                                    <?php endif; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $user_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $useryear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($useryear->year); ?>" <?php echo e(date('Y') == $useryear->year ? 'selected' : ''); ?>><?php echo e($useryear->year); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>    
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="row">
                                <canvas id="userschart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-3 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <h5 class="card-title"><?php echo e(trans('labels.earnings')); ?></h5>
                                <select class="form-select form-select-sm w-auto" id="earningsyear" data-url="<?php echo e(URL::to('/admin/home')); ?>">
                                    <?php if(!in_array(date('Y'), array_column($earnings_years->toArray(),'year'))): ?>
                                        <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                                    <?php endif; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $earnings_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $earnings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($earnings->year); ?>" <?php echo e(date('Y') == $earnings->year ? 'selected' : ''); ?>><?php echo e($earnings->year); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>    
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="row">
                                <canvas id="earningschart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-12 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-3 mb-3"><?php echo e(trans('labels.today_order')); ?></h5>
                            <div class="table-responsive" id="table-display">
                                <?php echo $__env->make('admin.orders.orderstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-3 mb-3"><?php echo e(trans('labels.top_items')); ?></h5>
                            <?php if(count($topitems) > 0): ?>
                                <div class="table-responsive" id="table-items">
                                    <?php echo $__env->make('admin.dashboard.topproducttable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php else: ?>
                                <?php echo $__env->make('admin.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-3 mb-3"><?php echo e(trans('labels.top_users')); ?></h5>
                            <?php if(count($topusers) > 0): ?>
                                <div class="table-responsive" id="table-users">
                                    <?php echo $__env->make('admin.dashboard.topuserstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php else: ?>
                                <?php echo $__env->make('admin.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <h5 class="card-title"><?php echo e(trans('labels.orders_overview')); ?></h5>
                                <select class="form-select form-select-sm w-auto" id="getyear" data-url="<?php echo e(URL::to('/admin/home')); ?>">
                                    <?php if(!in_array(date('Y'), array_column($order_years->toArray(),'year'))): ?>
                                        <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                                    <?php endif; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $order_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderyear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($orderyear->year); ?>" <?php echo e(date('Y') == $orderyear->year ? 'selected' : ''); ?>><?php echo e($orderyear->year); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>    
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="row">
                                <canvas id="orderschart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <?php echo $__env->make('admin.noaccess', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/custom/orders.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--- orders-chart-script --->
    <script type="text/javascript">
        var orderschart = null;
        var labels = <?php echo e(Js::from($orderlabels)); ?>;
        var deliverydata = <?php echo e(Js::from($deliverydata)); ?>;
        var pickupdata = <?php echo e(Js::from($pickupdata)); ?>;
        
        var delivery_orders = <?php echo e(Js::from(trans('labels.delivery_orders'))); ?>;
        var pickup_orders = <?php echo e(Js::from(trans('labels.pickup_orders'))); ?>;
        createOrdersChart(labels, deliverydata, pickupdata);
        $('#getyear').on('change',function() {
            "use strict";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $("#getyear").attr('data-url'),
                method: "GET",
                data: {
                    getyear: $("#getyear").val()
                },
                dataType: "JSON",
                success: function(data) {
                    createOrdersChart(data.orderlabels, data.deliverydata, data.pickupdata)
                },
                error: function(data) {
                    toastr.error(wrong);
                    return false;
                }
            });
        });
        function createOrdersChart(labels, deliverydata, pickupdata) {
            "use strict";
            const chartdata = {
                labels: labels,
                datasets: [{
                    label: delivery_orders,
                    backgroundColor: ['#ac1515'],
                    borderColor: ['#ac1515'],
                    data: deliverydata,
                }, {
                    label: pickup_orders,
                    backgroundColor: ['#ac151563'],
                    borderColor: ['#ac1515'],
                    data: pickupdata,
                }]
            };
            const config = {
                type: 'bar',
                data: chartdata,
                options: {}
            };
            if (orderschart != null) {
                orderschart.destroy();
            }
            if(document.getElementById('orderschart')){
                orderschart = new Chart(document.getElementById('orderschart'), config);
            }
        }
    </script>
    <!--- users-chart-script --->
    <script type="text/javascript">
        var userschart = null;
        var labels = <?php echo e(Js::from($userslabels)); ?>;
        var userdata = <?php echo e(Js::from($userdata)); ?>;
        createUsersChart(labels, userdata);
        $('#useryear').on('change',function() {
            "use strict";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $("#useryear").attr('data-url'),
                method: "GET",
                data: {
                    useryear: $("#useryear").val()
                },
                dataType: "JSON",
                success: function(data) {
                    createUsersChart(data.userslabels, data.userdata)
                },
                error: function(data) {
                    toastr.error(wrong);
                    return false;
                }
            });
        });
        function createUsersChart(labels, userdata) {
            "use strict";
            if (labels.length == 0) {
                labels = ['No Data'];
            }
            const chartdata = {
                labels: labels,
                datasets: [{
                    label: 'Users ',
                    backgroundColor: ['rgba(54, 162, 235, 0.4)', 'rgba(255, 150, 86, 0.4)',
                        'rgba(140, 162, 198, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(255, 99, 132, 0.4)',
                        'rgba(255, 159, 64, 0.4)', 'rgba(255, 205, 86, 0.4)', 'rgba(75, 192, 192, 0.4)',
                        'rgba(54, 170, 235, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(201, 203, 207, 0.4)',
                        'rgba(255, 159, 64, 0.4)',
                    ],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 150, 86, 1)', 'rgba(140, 162, 198, 1)',
                        'rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 170, 235, 1)',
                        'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)', 'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 2,
                    data: userdata,
                }]
            };
            const config = {
                type: 'doughnut',
                data: chartdata,
                options: {}
            };
            if (userschart != null) {
                userschart.destroy();
            }
            if(document.getElementById('userschart')){
                userschart = new Chart(document.getElementById('userschart'), config);
            }
        }
    </script>
    <!--- earnings-chart-script --->
    <script type="text/javascript">
        var earningschart = null;
        var labels = <?php echo e(Js::from($earningslabels)); ?>;
        var earningsdata = <?php echo e(Js::from($earningsdata)); ?>;
        createEarningsChart(labels, earningsdata);
        $('#earningsyear').on('change',function() {
            "use strict";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $("#earningsyear").attr('data-url'),
                method: "GET",
                data: {
                    earningsyear: $("#earningsyear").val()
                },
                dataType: "JSON",
                success: function(data) {
                    createEarningsChart(data.earningslabels, data.earningsdata)
                },
                error: function(data) {
                    toastr.error(wrong);
                    return false;
                }
            });
        });
        function createEarningsChart(labels, earningsdata) {
            "use strict";
            const chartdata = {
                labels: labels,
                datasets: [{
                    label: 'Earnings ',
                    backgroundColor: ['#ac1515'],
                    borderColor: ['#ac1515'],
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointHoverRadius: 10,
                    data: earningsdata,
                }]
            };
            const config = {
                type: 'line',
                data: chartdata,
                options: {}
            };
            if (earningschart != null) {
                earningschart.destroy();
            }
            if(document.getElementById('earningschart')){
                earningschart = new Chart(document.getElementById('earningschart'), config);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/dashboard/home.blade.php ENDPATH**/ ?>