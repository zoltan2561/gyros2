<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(trans('labels.print')); ?></title>
    <link rel="stylesheet" href="<?php echo e(url('storage/app/public/admin-assets/assets/css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(helper::image_path(@helper::appdata()->favicon)); ?>">
    <style type="text/css">
        /* 80 mm blokk – nagy, félkövér, fekete */
        html, body{
            width:80mm; margin:0; padding:0; background:#fff;
            font-family: system-ui,-apple-system,"Segoe UI",Arial,Helvetica,sans-serif;
            font-size:19px;              /* nagy alapméret */
            line-height:1.22;
            font-weight:700;             /* minden vastag */
            color:#000;                  /* minden fekete */
            -webkit-font-smoothing:none; /* hőnyomtatón élesebb */
            text-align:center;
        }

        #printDiv{ margin:0 auto; }
        .resept{ width:100%; margin:0 auto; padding:1.2mm 0.8mm; background:#fff; } /* picit kisebb belső margó */

        /* Fejléc */
        h5{ font-size:30px; margin:0; letter-spacing:1px; }
        .fs-8{ font-size:24px !important; }
        .fs-10, .txt-resept-font-size{ font-size:20px !important; }

        /* Terméknév */
        .product-text-size{
            font-size:23px !important;
            line-height:1.22;
            color:#000 !important;
            font-weight:700;
        }

        /* ===== Extrák/Testreszabás – legyen fekete, félkövér, 1 sorban ===== */
        .product-text-size .text-muted,
        .product-text-size .text-muted span{
            font-size:18px !important;
            font-weight:700 !important;          /* tényleg félkövér */
            color:#000 !important;               /* nem szürke */
            opacity:1 !important;
            white-space:nowrap;                   /* ne törjön három sorba */
            display:inline-block;
        }

        /* Táblázat – az „első verzió” szerinti középre igazítás */
        .table{ width:100%; border-collapse:collapse; margin:6px 0; }
        .table th, .table td{
            border:0; padding:4px 1px;           /* kicsit kisebb padding → kevesebb törés */
            text-align:center; vertical-align:middle;
            white-space:nowrap;
        }
        .table td:nth-child(2){ white-space:normal; } /* a terméknév törhet */

        /* Szaggatott elválasztók */
        .underline-3{
            border-top:2px dashed #000;
            border-bottom:2px dashed #000;
            padding:4px 0; margin:6px 0;
        }

        /* Összesítők */
        .total-line{
            border-top:2px dashed #000; border-bottom:2px dashed #000;
            padding:6px 0; margin-top:10px; font-size:23px; text-transform:uppercase;
        }
        .grand-total{ font-size:29px; margin-top:3mm; text-transform:uppercase; }

        /* Nyomtatási margó – kicsit „kijjebb” */
        @media print{
            @page{ margin: 2mm; }   /* eddigi 0 helyett 2 mm */
            body{ margin:0; }
            #btnPrint{ display:none !important; }
        }

        .btn-primary{
            background:#0a53ff; color:#fff; border:0;
            font-size:21px; padding:9px 26px; border-radius:6px;
        }

        /* Megjegyzés blokk tipó */
        .note-box{ text-align:left; }
        .note-title{ font-size:22px; text-transform:uppercase; }
        .note-text{ font-size:20px; font-weight:700; white-space:normal; word-break:break-word; }
    </style>











</head>

<body>
    <div id="printDiv">
        <div class="resept p-2">
            <div class="address">
                <h5 class="m-0 text-uppercase fs-8 text-center line-2 fw-600"><?php echo e(@helper::appdata()->short_title); ?></h5>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center ">
                    <small class=" text-uppercase fs-10 text-center text-dark fw-500 line-2">
                        <?php if($orderdata->order_type == 1): ?>
                            <?php echo e(@$orderdata->address . ' ' . @$orderdata->landmark . ',' . @$orderdata->city . ',' . @$orderdata->state . ',' . @$orderdata->country . ',' . @$orderdata->postal_code); ?>

                        <?php elseif($orderdata->order_type == 2): ?>
                            <?php echo e(trans('labels.pickup')); ?>

                        <?php elseif($orderdata->order_type == 3): ?>
                            <?php echo e(trans('labels.pos')); ?>

                        <?php endif; ?>
                    </small>
                </div>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                    <p class=" m-0 fw-500 text-uppercase fs-10 text-center text-dark line-1">
                        <?php echo e(trans('labels.name')); ?> :</p>
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark  line-1">
                        <?php echo e(@$orderdata->name); ?>

                    </small>
                </div>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                    <p class="fw-500 m-0 text-uppercase fs-10 text-center text-dark line-1">
                        <?php echo e(trans('labels.email')); ?> :</p>
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark  line-1">
                        <?php echo e(@$orderdata->email); ?>

                    </small>
                </div>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                    <p class="fw-500 m-0 text-uppercase fs-10 text-center text-dark line-1">
                        <?php echo e(trans('labels.mobile')); ?> :</p>
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark  line-1">
                        <?php echo e(@$orderdata->mobile); ?>

                    </small>
                </div>
            </div>
            <div class="total-billes-amount">
                <div
                    class="fw-500 d-flex gap-1 align-items-center justify-content-center mt-1 text-uppercase fs-10 text-center text-dark">
                    <?php echo e(trans('labels.order_number')); ?> :
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark line-1">
                        #<?php echo e($orderdata->order_number); ?>

                    </small>
                </div>
                <p
                    class="fw-500 d-flex gap-1 align-items-center justify-content-center m-0 text-uppercase fs-10 text-center text-dark line-1">
                    <?php echo e(trans('labels.order_date')); ?> :
                    <small
                        class="fw-500 text-uppercase fs-10 text-center text-dark line-1"><?php echo e(@helper::date_format($orderdata->created_at)); ?>

                    </small>
                </p>
            </div>
            <div class="total-billes-amount">
                <?php if($orderdata->delivery_date != ''): ?>
                    <div
                        class="fw-500 d-flex gap-1 align-items-center justify-content-center m-0 text-uppercase fs-10 text-center text-dark">
                        <?php echo e($orderdata->order_type == '1' ? trans('labels.delivery_date') : trans('labels.pickup_date')); ?>

                        :
                        <small class="fw-500 text-uppercase fs-10 text-center text-dark line-1">
                            <?php echo e(@helper::date_format($orderdata->delivery_date)); ?>

                        </small>
                    </div>
                <?php endif; ?>
                <?php if($orderdata->delivery_time != ''): ?>
                    <p
                        class="fw-500 d-flex gap-1 align-items-center justify-content-center m-0 text-uppercase fs-10 text-center text-dark line-1">
                        <?php echo e($orderdata->order_type == '1' ? trans('labels.delivery_time') : trans('labels.pickup_time')); ?>

                        :
                        <small
                            class="fw-500 text-uppercase fs-10 text-center text-dark line-1"><?php echo e($orderdata->delivery_time); ?>

                        </small>
                    </p>
                <?php endif; ?>
            </div>
            <table class="table table-borderless my-2 bg-transparent">
                <thead class="underline-3">
                    <tr class="text-dark">
                        <th scope="col" class="product-text-size fw-bold">#</th>
                        <th scope="col" class="product-text-size fw-bold"><?php echo e(trans('labels.item')); ?>

                        </th>
                        <th scope="col" class="product-text-size fw-bold text-center"><?php echo e(trans('labels.price')); ?>

                        </th>
                        <th scope="col" class="product-text-size fw-bold text-center"><?php echo e(trans('labels.qty')); ?>

                        </th>
                        <th scope="col" class="product-text-size fw-bold text-center pe-0">
                            <?php echo e(trans('labels.total')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $order_total = 0;
                        $qty = 0;
                    ?>
                    <?php $__currentLoopData = $ordersdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $order_total +=
                                ($orders['item_price'] +
                                    $orders['addons_total_price'] +
                                    $orders['extras_total_price']) *
                                $orders['qty'];
                            $qty += $orders['qty'];
                        ?>
                        <tr class="align-middle">
                            <td class="py-2">
                                <p class="fw-500 text-dark line-1 m-0 product-text-size"><?php echo e(++$key); ?></p>
                            </td>
                            <td class="py-2">
                                <h6 class="m-0 fw-500 product-text-size">
                                    <?php echo e($orders->item_name); ?>

                                    [<?php echo e($orders->item_type == 1 ? trans('labels.veg') : trans('labels.nonveg')); ?>]
                                    <br>
                                    <?php
                                        $addons_name = explode('| ', $orders->addons_name);
                                        $addons_price = explode('| ', $orders->addons_price);
                                        $extras_name = explode('| ', $orders->extras_name);
                                        $extras_price = explode('| ', $orders->extras_price);
                                    ?>
                                    <?php if($orders->addons_id != ''): ?>
                                        <?php $__currentLoopData = $addons_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="text-muted"><?php echo e($addons_name[$key]); ?> :
                                                <span><?php echo e(helper::currency_format($addons_price[$key])); ?></span>
                                            </span><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($orders->extras_id != ''): ?>
                                        <?php $__currentLoopData = $extras_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="text-muted"><?php echo e($extras_name[$key]); ?> :
                                                <span><?php echo e(helper::currency_format($extras_price[$key])); ?></span>
                                            </span><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </h6>
                            </td>
                            <td class="py-2 text-end">
                                <div class="fw-500 product-text-size d-flex align-items-center justify-content-center">
                                    <p class="m-0 text-dark">
                                        <?php echo e(helper::currency_format($orders->item_price)); ?>

                                        <?php if($orders->addons_total_price != 0 || $orders->extras_total_price != 0): ?>
                                            <br><small class="text-muted">+
                                                <?php echo e(helper::currency_format($orders->addons_total_price + $orders->extras_total_price)); ?></small>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </td>
                            <td class="py-2 text-end">
                                <div class="fw-500 product-text-size d-flex align-items-center justify-content-center">
                                    <p class="m-0 text-dark"><?php echo e($orders->qty); ?></p>
                                </div>
                            </td>
                            <td class="py-2 pe-0 text-end">
                                <p class="text-dark fw-500 line-1 m-0  product-text-size">
                                    <?php echo e(helper::currency_format($orders->item_price * $orders->qty + $orders->addons_total_price + $orders->extras_total_price)); ?>

                                </p>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr class="underline-3">
                        <td class="py-2" colspan="3">
                            <h6 class="line-1 m-0 fw-600 product-text-size"><?php echo e(trans('labels.subtotal')); ?></h6>
                        </td>
                        <td class="py-2 text-end">
                            <div class=" product-text-size d-flex align-items-center justify-content-center">
                                <p class="m-0 text-dark"><?php echo e($qty); ?></p>
                            </div>
                        </td>
                        <td class="py-2 pe-0 text-end">
                            <p class="text-dark line-1 fw-500 m-0  product-text-size">
                                <?php echo e(helper::currency_format($order_total)); ?>

                            </p>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="col-12 d-flex mb-2 justify-content-end">
                <div class="col-7">
                    <div class="col-12">
                        <div class="text-dark">
                            <?php if(!empty($orderdata->discount_amount)): ?>
                                <div class="d-flex justify-content-between text-dark my-1">
                                    <div class="">
                                        <span class="txt-resept-font-size fw-500 text-uppercase line-1">
                                            <?php echo e(trans('labels.discount')); ?>

                                            <?php echo e($orderdata->offer_code != '' ? '(' . $orderdata->offer_code . ')' : ''); ?>

                                        </span>
                                    </div>
                                    <div class="">
                                        <span class="txt-resept-font-size fw-500 text-uppercase text-end line-1">
                                            <?php echo e(helper::currency_format($orderdata->discount_amount)); ?>

                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                                $tax = explode('|', $orderdata->tax_amount);
                                $tax_name = explode('|', $orderdata->tax_name);
                            ?>
                            <?php if($orderdata->tax_amount != null && $orderdata->tax_name != null): ?>
                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex justify-content-between text-dark my-1">
                                        <div class="">
                                            <span
                                                class="txt-resept-font-size fw-500 text-uppercase line-1"><?php echo e($tax_name[$key]); ?></span>
                                        </div>
                                        <div class="">
                                            <span class="txt-resept-font-size fw-500 text-uppercase text-end line-1">
                                                <?php echo e(helper::currency_format($tax_value)); ?>

                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if($orderdata->delivery_charge != 0): ?>
                                <div class="d-flex justify-content-between text-dark my-1">
                                    <div class="">
                                        <span class="txt-resept-font-size fw-500 text-uppercase line-1">
                                            <?php echo e(trans('labels.delivery_charge')); ?>

                                        </span>
                                    </div>
                                    <div class="">
                                        <span class="txt-resept-font-size fw-500 text-uppercase line-1 text-end">
                                            <?php echo e(helper::currency_format($orderdata->delivery_charge)); ?>

                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>


                                
                                <?php
                                    $order_note = $orderdata->instruction ?? $orderdata->notes ?? $orderdata->order_notes ?? '';
                                ?>
                                <?php if(!empty($order_note)): ?>
                                    <div class="underline-3 note-box">
                                        <div class="note-title"><?php echo e(trans('labels.note')); ?></div>
                                        <div class="note-text"><?php echo e($order_note); ?></div>
                                    </div>
                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-between underline-3 py-2">
                <span class="fw-semibold product-text-size line-1"><?php echo e(trans('labels.grand_total')); ?></span>
                <span
                    class="fw-semibold line-1 product-text-size"><?php echo e(helper::currency_format($orderdata->grand_total)); ?></span>
            </div>
            <h2 class="my-2 fs-8 fw-600 text-center line-1"><?php echo e(trans('labels.thanks_for_order')); ?></h2>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <button type='button' id="btnPrint"
                    class="rounded border-0 btn btn-primary text-light text-capitalize fs-8 px-3 py-2"><?php echo e(trans('labels.print')); ?></button>
            </div>
        </div>
    </div>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/orders/print.blade.php ENDPATH**/ ?>