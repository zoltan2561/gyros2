<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.checkout')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <nav class="text-dark d-flex breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-dark fw-bold" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?> text-primary fw-bold active"
                            aria-current="page"><?php echo e(trans('labels.checkout')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php if(count($getcartlist) > 0): ?>
        <?php
            $totaltax = 0;
            $order_total = 0;
            $total_item_qty = 0;
            $totalcarttax = 0;
            $deliveryOn = (int) helper::app_setting('delivery_enabled', 1) === 1;
        ?>
        <?php $__currentLoopData = $taxArr['tax']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $rate = $taxArr['rate'][$k];
                $totalcarttax += (float) $taxArr['rate'][$k];
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $getcartlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $total_price =
                    ($item['item_price'] + $item['addons_total_price'] + $item['extras_total_price']) * $item['qty'];
                $order_total += (float) $total_price;
                $total_item_qty += $item['qty'];
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <section class="my-5">
            <div class="container">
                <h3 class="fw-bold fs-2 mb-4 truncate-2"><?php echo e(trans('labels.checkout')); ?></h3>
                <div class="cart-view">
                    <div class="row">
                        <div class="col-lg-8 order-md2">
                            <div class="card mb-3 order-option">
                                <div class="card-body">
                                    <div class="">
                                        <div class="heading mb-2 border-bottom">
                                            <h5><?php echo e(trans('labels.order_type')); ?></h5>
                                        </div>

                                        
                                        <?php if(!$deliveryOn): ?>
                                            <div class="alert alert-info mb-3">
                                                🚚 <strong>Kiszállítás átmenetileg nem elérhető</strong>
                                            </div>
                                        <?php endif; ?>

                                        <div class="col-12 d-flex gap-3">
                                            <?php
                                                // 1= mindkettő, 2= csak kiszállítás, 3= csak elvitel (projekt logika)
                                                $mode = (int) $getsettings->pickup_delivery;
                                            ?>

                                            
                                            <?php if(!$deliveryOn): ?>
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="radio" name="order_type" id="pickup" value="2" checked>
                                                    <label class="form-check-label fs-7 fw-500" for="pickup">
                                                        <?php echo e(trans('labels.take_away')); ?>

                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <?php if($mode === 1): ?>
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input" type="radio" name="order_type" value="1" id="delivery" checked>
                                                        <label class="form-check-label fs-7 fw-500" for="delivery">
                                                            <?php echo e(trans('labels.delivery')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input" type="radio" name="order_type" value="2" id="pickup">
                                                        <label class="form-check-label fs-7 fw-500" for="pickup">
                                                            <?php echo e(trans('labels.take_away')); ?>

                                                        </label>
                                                    </div>
                                                <?php elseif($mode === 2): ?>
                                                    
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input" type="radio" name="order_type" value="1" id="delivery" checked>
                                                        <label class="form-check-label fs-7 fw-500" for="delivery">
                                                            <?php echo e(trans('labels.delivery')); ?>

                                                        </label>
                                                    </div>
                                                <?php elseif($mode === 3): ?>
                                                    
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input" type="radio" name="order_type" value="2" id="pickup" checked>
                                                        <label class="form-check-label fs-7 fw-500" for="pickup">
                                                            <?php echo e(trans('labels.take_away')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="heading mb-2 border-bottom">
                                        <h5><?php echo e(trans('labels.customer_info')); ?></h5>
                                    </div>
                                    <div class="row">
                                        <?php
                                            $full = (Auth::user() && Auth::user()->type == 2) ? trim(Auth::user()->name) : '';
                                            // Alap: a korábbi (old) értékek élvezzenek elsőbbséget
                                            $firstPrefill = old('first_name');
                                            $lastPrefill  = old('last_name');

                                            if (!$firstPrefill && $full) {
                                                // Többszörös szóközök kezelése, unicode barát
                                                $parts = preg_split('/\s+/u', $full, -1, PREG_SPLIT_NO_EMPTY);
                                                if (count($parts) >= 2) {
                                                    $firstPrefill = array_shift($parts);
                                                    $lastPrefill  = implode(' ', $parts);
                                                } else {
                                                    $firstPrefill = $full;
                                                    $lastPrefill  = '';
                                                }
                                            }
                                        ?>

                                        <div class="col-md-6 mb-3">
                                            <label for="first_name" class="form-label"><?php echo e(trans('labels.first_name')); ?> <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="first_name"
                                                   id="first_name"
                                                   placeholder="<?php echo e(trans('labels.first_name')); ?>"
                                                   value="<?php echo e($firstPrefill); ?>"
                                                   required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="last_name" class="form-label"><?php echo e(trans('labels.last_name')); ?> <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="last_name"
                                                   id="last_name"
                                                   placeholder="<?php echo e(trans('labels.last_name')); ?>"
                                                   value="<?php echo e($lastPrefill); ?>"
                                                   required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="<?php echo e(trans('labels.email')); ?>"
                                                value="<?php echo e(Auth::user() && Auth::user()->type == 2 ? Auth::user()->email : old('email')); ?>"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile" class="form-label"><?php echo e(trans('labels.mobile')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                                value="<?php echo e(Auth::user() && Auth::user()->type == 2 ? Auth::user()->mobile : old('mobile')); ?>"
                                                required>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3" id="addressdiv">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center heading mb-2 border-bottom">
                                        <h5><?php echo e(trans('labels.customer_info')); ?></h5>
                                    </div>

                                    <div class="row g-3">
                                        <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                            <div class="col-md-9 col-sm-8">
                                                <?php if($getaddresses->count() > 0): ?>
                                                    <label class="form-label">Mentett cím kiválasztása</label>
                                                    <select name="address_type" id="address_type" class="form-select">
                                                        <?php $__currentLoopData = $getaddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($address->id); ?>" <?php echo e($address->is_default == 1 ? 'selected' : ''); ?>>
                                                                <?php echo e($address->title); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-3 col-sm-4 py-sm-4">
                                                <a href="<?php echo e(URL::to('/address')); ?>" type="button" class="btn btn-address mt-sm-2 w-100">
                                                    <i class="fa-solid fa-plus mx-1"></i> Új cím hozzáadása
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        
                                        <div class="col-12">
                                            <label for="new_address" class="form-label"><?php echo e(trans('labels.address')); ?> <span class="text-danger">*</span></label>
                                            <textarea name="address" id="new_address" class="form-control" rows="4" placeholder="Utca,közterület neve stb" required><?php echo e(old('address')); ?></textarea>
                                        </div>
                                            
                                            <div class="col-md-6">
                                                <label for="new_city" class="form-label">
                                                    <?php echo e(trans('labels.city')); ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="city"
                                                       id="new_city"
                                                       placeholder="Pl. Vásárosnamény"
                                                       value="<?php echo e(old('city')); ?>"
                                                       required
                                                       readonly>
                                                <small class="text-muted">A város a kiválasztott szállítási területből töltődik.</small>
                                            </div>


                                    </div>
                                </div>

                            </div>


                            <div class="card mb-3" id="shipping_area">
                                <div class="card-body">
                                    <div class="heading mb-2 border-bottom">
                                        <h5><?php echo e(trans('labels.shippingarea')); ?></h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <select name="delivery_area" id="delivery_area" class="form-select">
                                                <option value="" data-charge="0"><?php echo e(trans('labels.select')); ?>

                                                </option>
                                                <?php $__currentLoopData = $shippingarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($area->id); ?>"
                                                        data-charge="<?php echo e($area->delivery_charge); ?>"><?php echo e($area->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="payment-option mb-3 border">
                                <div class="heading mb-2 border-bottom">
                                    <h2><?php echo e(trans('labels.choose_payment')); ?></h2>
                                </div>

                                <!-- payment-options -->
                                <?php echo $__env->make('web.paymentmethodsview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="row g-3 justify-content-between mt-4 align-items-center">
                                    <div class="align-items-center col-sm-6 col-12">
                                        <a href="<?php echo e(URL::to('/')); ?>" class="btn btn-outline-dark w-100 p-2"><i
                                                class="fa-solid fa-circle-arrow-left <?php echo e(session()->get('direction') == '2' ? 'ms-2' : 'me-2'); ?>"></i><?php echo e(trans('labels.continue_shopping')); ?></a>
                                    </div>
                                    <div class="align-items-center col-sm-6 col-12">
                                        <button
                                            id="place-order-btn"
                                            class="btn btn-primary w-100 d-flex gap-3 justify-content-center align-items-center checkout"
                                            onclick="isopenclose('<?php echo e(URL::to('/isopenclose')); ?>','<?php echo e($total_item_qty); ?>','<?php echo e($order_total); ?>')">
                                            <?php echo e(trans('labels.proceed_pay')); ?>

                                            <div class="loader d-none checkout_loader"></div>
                                        </button>

                                    </div>
                                </div>

                            </div>

                            <!-- ÁSZF CUCC -->



                            <div class="form-group mt-3">
                                <div class="form-check">
                                    <input type="checkbox"
                                           name="terms"
                                           id="terms"
                                           value="1"
                                           class="form-check-input me-2">
                                    <label for="terms" class="form-check-label fs-6 text-dark">
                                        Elfogadom az
                                        <a href="<?php echo e(url('/terms-conditions')); ?>" target="_blank"
                                           class="text-primary text-decoration-none fw-medium">ÁSZF-et</a>
                                        és az
                                        <a href="<?php echo e(url('/terms-conditions')); ?>" target="_blank"
                                           class="text-primary text-decoration-none fw-medium">Adatvédelmi Tájékoztatót</a>.
                                    </label>
                                </div>
                            </div>




                            <!-- ÁSZF CUCC -->
                        </div>

                        <div class="col-lg-4 order-md1">
                            <?php if(@helper::checkaddons('coupon')): ?>
                                <div class="promocode mb-4 py-3">
                                    <label class="mb-3"><?php echo e(trans('labels.apply_promo')); ?></label>
                                    <div class="row justify-content-between align-items-center">
                                        <?php if(session()->get('discount_data')): ?>
                                            <form action="<?php echo e(URL::to('/promocodes/remove')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <div class="d-flex">
                                                    <input type="text" class="form-control" name="offer_code"
                                                        value="<?php echo e(session()->get('discount_data')['offer_code']); ?>"
                                                        placeholder="<?php echo e(trans('labels.have_promocode')); ?>" disabled>
                                                    <button type="submit"
                                                        class="btn btn-primary bg-primary border-0 ms-2"><?php echo e(trans('labels.remove')); ?>

                                                    </button>
                                                </div>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?php echo e(URL::to('/promocodes/apply')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <div class="d-flex">
                                                    <input type="hidden" name="order_amount"
                                                        value="<?php echo e($order_total); ?>">
                                                    <input type="text" class="form-control" name="offer_code"
                                                        value="<?php echo e(old('offer_code')); ?>" id="offer_code"
                                                        placeholder="<?php echo e(trans('labels.have_promocode')); ?>" required>
                                                    <button type="submit"
                                                        class="btn px-4 btn-primary bg-primary border-0 <?php echo e(session()->get('direction') == '2' ? 'me-2' : 'ms-2'); ?>"><?php echo e(trans('labels.apply')); ?></button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- payment-summary -->
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom"><?php echo e(trans('labels.payment_summary')); ?></h2>
                                <div class="bill-details border-bottom pb-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.subtotal')); ?></span></div>
                                        <div class="col-auto">
                                            <span><?php echo e(helper::currency_format($order_total)); ?></span>
                                        </div>
                                    </div>
                                    <?php
                                        if (session()->has('discount_data')) {
                                            $discount_amount = session()->get('discount_data')['offer_amount'];
                                        } else {
                                            $discount_amount = 0;
                                        }
                                        if (session()->has('addressdata')) {
                                            $grand_total = $order_total - $discount_amount + $totalcarttax;
                                        } else {
                                            $grand_total = $order_total - $discount_amount + $totalcarttax;
                                        }
                                    ?>

                                    <?php if(session()->has('discount_data')): ?>
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span><?php echo e(trans('labels.discount')); ?>

                                                    <?php echo e(session()->has('discount_data') == true ? '(' . session()->get('discount_data')['offer_code'] . ')' : ''); ?>

                                                </span></div>
                                            <div class="col-auto">
                                                <span>- <?php echo e(helper::currency_format($discount_amount)); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                        $totalcarttax = 0;
                                    ?>
                                    <?php $__currentLoopData = $taxArr['tax']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $rate = $taxArr['rate'][$k];
                                            $totalcarttax += (float) $taxArr['rate'][$k];
                                        ?>

                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span><?php echo e($tax); ?></span></div>
                                            <div class="col-auto">
                                                <span> <?php echo e(helper::currency_format($rate)); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $delivery_charge = 0; ?>
                                    <div class="row justify-content-between align-items-center" id="delivery_charge">
                                        <div class="col-auto"><span><?php echo e(trans('labels.delivery_charge')); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="delivery_charge" id="delivery_amount">
                                                <?php echo e(helper::currency_format(0)); ?>

                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.grand_total')); ?></span></div>
                                        <div class="col-auto"><span class="grand_total"
                                                id="total_amount"><?php echo e(helper::currency_format($grand_total)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- special-instruction -->
                            <div class="special-instruction mb-3 border">
                                <label class="form-label mb-3 border-bottom pb-2 w-100"
                                    for="order_notes"><?php echo e(trans('labels.special_instruction')); ?></label>
                                <textarea class="form-control" name="order_notes" id="order_notes" rows="3"
                                    placeholder="<?php echo e(trans('labels.special_instruction')); ?>"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <input type="hidden" name="user_id" id="user_id" value="<?php echo e(@Auth::user()->id); ?>">
                <input type="hidden" name="session_id" id="session_id" value="<?php echo e(@Session::getId()); ?>">
                <input type="hidden" name="order_type" id="order_type" value="<?php echo e(session()->get('order_type')); ?>">
                <input type="hidden" name="grand_total" id="grand_total" value="<?php echo e(helper::currency_format($grand_total)); ?>">
                <input type="hidden" name="sub_total" id="sub_total" value="<?php echo e($order_total); ?>">
                <input type="hidden" name="discount" id="discount" value="<?php echo e($discount_amount); ?>">
                <input type="hidden" name="totaltaxamount" id="totaltaxamount" value="<?php echo e($totalcarttax); ?>">
                <input type="hidden" name="tax" id="tax" value="<?php echo e(implode('|', $taxArr['rate'])); ?>">
                <input type="hidden" name="tax_name" id="tax_name" value="<?php echo e(implode('|', $taxArr['tax'])); ?>">
                <input type="hidden" name="shipping_charge" id="shipping_charge" value="">
                <input type="hidden" name="delivery_charge" id="delivery_charge" value="<?php echo e($delivery_charge); ?>">
                <input type="hidden" name="user_name" id="user_name" value="<?php echo e(@Auth::user()->name); ?>">
                <input type="hidden" name="user_email" id="user_email" value="<?php echo e(@Auth::user()->email); ?>">
                <input type="hidden" name="user_mobile" id="user_mobile" value="<?php echo e(@Auth::user()->mobile); ?>">
                <input type="hidden" name="buynow" id="buynow" value="<?php echo e(request()->get('buynow')); ?>">

                <input type="hidden" name="sloturl" id="sloturl" value="<?php echo e(URL::to('/timeslot')); ?>">
                <input type="hidden" name="orderurl" id="orderurl" value="<?php echo e(URL::to('placeorder')); ?>">
                <input type="hidden" name="paymentsuccess" id="paymentsuccess"
                    value="<?php echo e(URL::to('/paymentsuccess')); ?>">
                <input type="hidden" name="paymentfail" id="paymentfail" value="<?php echo e(URL::to('/paymentfail')); ?>">
                <input type="hidden" name="continueurl" id="continueurl" value="<?php echo e(URL::to('/')); ?>">
                <input type="hidden" name="environment" id="environment" value="<?php echo e(env('Environment')); ?>">
                <input type="hidden" name="myfatoorahurl" id="myfatoorahurl" value="<?php echo e(URL::to('/myfatoorah')); ?>">
                <input type="hidden" name="mercadopagourl" id="mercadopagourl"
                    value="<?php echo e(URL::to('/mercadorequest')); ?>">
                <input type="hidden" name="paypalurl" id="paypalurl" value="<?php echo e(URL::to('/paypal')); ?>">
                <input type="hidden" name="toyyibpayurl" id="toyyibpayurl" value="<?php echo e(URL::to('/toyyibpay')); ?>">
                <input type="hidden" name="paytaburl" id="paytaburl" value="<?php echo e(URL::to('/paytab')); ?>">
                <input type="hidden" name="phonepeurl" id="phonepeurl" value="<?php echo e(URL::to('/phonepe')); ?>">
                <input type="hidden" name="mollieurl" id="mollieurl" value="<?php echo e(URL::to('/mollie')); ?>">
                <input type="hidden" name="khaltiurl" id="khaltiurl" value="<?php echo e(URL::to('/khalti')); ?>">

                <input type="hidden" value="<?php echo e(URL::to('getaddress')); ?>" name="getaddress" id="getaddress">

                <input type="hidden" value="<?php echo e(trans('messages.delivery_date_required')); ?>"
                    name="delivery_date_message" id="delivery_date_message">
                <input type="hidden" value="<?php echo e(trans('messages.delivery_time_required')); ?>"
                    name="delivery_time_message" id="delivery_time_message">
                <input type="hidden" value="<?php echo e(trans('messages.pickup_date_required')); ?>" name="pickup_date_message"
                    id="pickup_date_message">
                <input type="hidden" value="<?php echo e(trans('messages.pickup_time_required')); ?>" name="pickup_time_message"
                    id="pickup_time_message">
                <input type="hidden" value="<?php echo e(trans('messages.first_name_required')); ?>" name="first_name_message"
                    id="first_name_message">
                <input type="hidden" value="<?php echo e(trans('messages.last_name_required')); ?>" name="last_name_message"
                    id="last_name_message">
                <input type="hidden" value="<?php echo e(trans('messages.email_required')); ?>" name="email_message"
                    id="email_message">
                <input type="hidden" value="<?php echo e(trans('messages.mobile_required')); ?>" name="mobile_message"
                    id="mobile_message">
                <input type="hidden" value="<?php echo e(trans('messages.address_required')); ?>" name="new_address_message"
                    id="new_address_message">
                <input type="hidden" value="<?php echo e(trans('messages.landmark_required')); ?>" name="new_landmark_message"
                    id="new_landmark_message">
                <input type="hidden" value="<?php echo e(trans('messages.pincode_required')); ?>" name="new_pincode_message"
                    id="new_pincode_message">
                <input type="hidden" value="<?php echo e(trans('messages.country_required')); ?>" name="new_country_message"
                    id="new_country_message">
                <input type="hidden" value="<?php echo e(trans('messages.state_required')); ?>" name="new_state_message"
                    id="new_state_message">
                <input type="hidden" value="<?php echo e(trans('messages.city_required')); ?>" name="new_city_message"
                    id="new_city_message">
                <input type="hidden" value="<?php echo e(trans('messages.select_shipping_area')); ?>" name="shipping_area_message"
                    id="shipping_area_message">
                <input type="hidden" value="<?php echo e(trans('messages.payment_selection_required')); ?>"
                    name="payment_type_message" id="payment_type_message">

                <form action="<?php echo e(URL::to('paypal')); ?>" method="post" class="d-none">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="return" value="2">
                    <input type="submit" class="callpaypal" name="submit">
                </form>
            </div>

        </section>
    <?php else: ?>
        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <input type="hidden" name="buynow_key" id="buynow_key" value="0">
    <div class="modal fade" id="modalbankdetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalbankdetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalbankdetailsLabel"><?php echo e(trans('labels.banktransfer')); ?></h5>
                    <button type="button" class="btn-close bg-white border-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to('createorder')); ?>" method="POST">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="payment_type" id="payment_type" class="form-control"
                            value="">
                        <input type="hidden" name="modal_customer_name" id="modal_customer_name" class="form-control"
                            value="">
                        <input type="hidden" name="modal_customer_email" id="modal_customer_email" class="form-control"
                            value="">
                        <input type="hidden" name="modal_customer_mobile" id="modal_customer_mobile"
                            class="form-control" value="">
                        <input type="hidden" name="modal_delivery_date" id="modal_delivery_date" class="form-control"
                            value="">
                        <input type="hidden" name="modal_delivery_time" id="modal_delivery_time" class="form-control"
                            value="">
                        <input type="hidden" name="modal_delivery_area" id="modal_delivery_area" class="form-control"
                            value="">
                        <input type="hidden" name="modal_delivery_charge" id="modal_delivery_charge"
                            class="form-control" value="">
                        <input type="hidden" name="modal_address" id="modal_address" class="form-control"
                            value="">
                        <input type="hidden" name="modal_address_type" id="modal_address_type" class="form-control"
                            value="">

                        <input type="hidden" name="modal_landmark" id="modal_landmark" class="form-control"
                            value="">
                        <input type="hidden" name="modal_pincode" id="modal_pincode" class="form-control"
                            value="">

                        <input type="hidden" name="modal_message" id="modal_message" class="form-control"
                            value="">
                        <input type="hidden" name="modal_subtotal" id="modal_subtotal" class="form-control"
                            value="">
                        <input type="hidden" name="modal_discount_amount" id="modal_discount_amount"
                            class="form-control" value="">
                        <input type="hidden" name="modal_couponcode" id="modal_couponcode" class="form-control"
                            value="">
                        <input type="hidden" name="modal_ordertype" id="modal_ordertype" class="form-control"
                            value="">
                        <input type="hidden" name="modal_vendor_id" id="modal_vendor_id" class="form-control"
                            value="">
                        <input type="hidden" name="modal_grand_total" id="modal_grand_total" class="form-control"
                            value="">
                        <input type="hidden" name="modal_tax" id="modal_tax" class="form-control" value="">
                        <input type="hidden" name="modal_tax_name" id="modal_tax_name" class="form-control"
                            value="">
                        <input type="hidden" name="modal_order_type" id="modal_order_type" class="form-control"
                            value="">

                        <input type="hidden" name="modal_buynow" id="modal_buynow" class="form-control"
                            value="">
                        <p><?php echo e(trans('labels.payment_description')); ?></p>
                        <hr>
                        <p class="payment_description" id="payment_description"></p>
                        <hr>
                        <div class="form-group col-md-12">
                            <label for="screenshot"> <?php echo e(trans('labels.screenshot')); ?> </label>
                            <div class="controls">
                                <input type="file" name="screenshot" id="screenshot"
                                    class="form-control  <?php $__errorArgs = ['screenshot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['screenshot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"> <?php echo e($message); ?> </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger"
                            data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                        <button type="submit" class="btn btn-primary"> <?php echo e(trans('labels.save')); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="<?php echo e(url(env('ASSETSPATHURL') . 'web-assets/js/custom/checkout.js')); ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        var select = "<?php echo e(trans('labels.select')); ?>";
        var dateFormat = "<?php echo e(helper::appdata()->date_format); ?>";
        var placeholderFormat = dateFormat
            .replace(/Y/g, 'yyyy') // Full year
            .replace(/m/g, 'mm') // Month
            .replace(/d/g, 'dd'); // Day

        //document.getElementById("delivery_dt").setAttribute("placeholder", placeholderFormat);

        flatpickr(".delivery_pickup_date", {
            dateFormat: dateFormat,
            enableTime: false,
            altInput: true,
            altFormat: dateFormat,
        });
    </script>


    <style>
        /* Mindig jól látható piros keret */
        #terms.form-check-input {
            width: 18px; height: 18px;
            border: 2px solid #dc3545 !important; /* piros */
        }
        /* Pipálva piros háttér + keret */
        #terms.form-check-input:checked {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
        /* Hibás állapotban plusz kiemelés */
        #terms.form-check-input.is-invalid {
            box-shadow: 0 0 0 .2rem rgba(220,53,69,.25) !important;
        }
        /* Jobb fókusz kontúr billentyűzetnél */
        #terms.form-check-input:focus {
            box-shadow: 0 0 0 .2rem rgba(220,53,69,.25) !important;
            outline: none;
        }
    </style>

    <script>
        (function(){
            var deliveryOn = <?php echo e($deliveryOn ? 'true' : 'false'); ?>;
            var hidden = document.getElementById('order_type');

            function setHidden(val){ if(hidden){ hidden.value = val; } }

            // Alapállapot
            if (!deliveryOn) {
                setHidden(2); // Kiszállítás tiltva → elvitel
            } else {
                // ha van checked radio, vegyük onnan
                var checked = document.querySelector('input[name="order_type"]:checked');
                setHidden(checked ? checked.value : 1);
            }

            // Változás figyelése
            document.querySelectorAll('input[name="order_type"]').forEach(function(el){
                el.addEventListener('change', function(e){
                    setHidden(e.target.value);
                });
            });
        })();
    </script>
    <script>
        (function(){
            var areaSel = document.getElementById('delivery_area');
            var cityInp = document.getElementById('new_city');

            function firstWordFromOption(optText){
                // első "szó" levétele, utólagos vessző/kötőjel letisztítással
                var t = (optText || '').trim();
                if (!t) return '';
                var first = t.split(/\s+/)[0];         // első szó
                first = first.replace(/[.,;:-]+$/, ''); // záró írásjelek le
                return first;
            }

            function syncCity(){
                var opt = areaSel.options[areaSel.selectedIndex];
                if (!opt || !opt.value) {
                    cityInp.value = '';
                    return;
                }
                cityInp.value = firstWordFromOption(opt.text);
            }

            if (areaSel && cityInp) {
                areaSel.addEventListener('change', syncCity);
                // betöltéskor is frissítünk (ha már ki van választva valami)
                syncCity();
            }
        })();
    </script>




    <script>
        // GPT mókolása 2.2 – univerzális ÁSZF check/validációk
        document.addEventListener('DOMContentLoaded', function () {
            const btn    = document.querySelector('#place-order-btn');
            const csrf   = document.querySelector('meta[name="csrf-token"]')?.content || '<?php echo e(csrf_token()); ?>';
            const loader = document.querySelector('.checkout_loader');
            if (!btn) return;

            // ---- UI értesítők (toastr -> Swal -> Bootstrap alert) ----
            const ui = (() => {
                const host = document.querySelector('.payment-option') || document.querySelector('.cart-view') || document.body;
                function makeAlert(kind, msg) {
                    let box = document.getElementById('checkout-inline-alert');
                    if (!box) {
                        box = document.createElement('div');
                        box.id = 'checkout-inline-alert';
                        box.style.transition = 'opacity .25s ease, transform .25s ease';
                        box.style.opacity = '0';
                        box.style.transform = 'translateY(-6px)';
                        host.prepend(box);
                    }
                    box.className = `alert alert-${kind} alert-dismissible fade show mt-2`;
                    box.innerHTML = `
                <span>${msg}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
                    requestAnimationFrame(() => {
                        box.style.opacity = '1';
                        box.style.transform = 'translateY(0)';
                    });
                    clearTimeout(box._t);
                    box._t = setTimeout(() => {
                        try {
                            box.classList.remove('show');
                            box.style.opacity = '0';
                            box.style.transform = 'translateY(-6px)';
                            setTimeout(() => box.remove(), 250);
                        } catch(_) {}
                    }, 4000);
                }
                function error(msg)   { if (window.toastr){ toastr.clear(); return toastr.error(msg); }
                    if (window.Swal){ return Swal.fire({toast:true,position:'top-end',timer:3500,showConfirmButton:false,icon:'error',title: msg}); }
                    makeAlert('danger', msg); }
                function info(msg)    { if (window.toastr){ toastr.clear(); return toastr.info(msg); }
                    if (window.Swal){ return Swal.fire({toast:true,position:'top-end',timer:2500,showConfirmButton:false,icon:'info',title: msg}); }
                    makeAlert('info', msg); }
                function success(msg) { if (window.toastr){ toastr.clear(); return toastr.success(msg); }
                    if (window.Swal){ return Swal.fire({toast:true,position:'top-end',timer:2500,showConfirmButton:false,icon:'success',title: msg}); }
                    makeAlert('success', msg); }
                return { error, info, success };
            })();

            // --- mentsük az eredeti inline onclick-et, majd vegyük le, hogy ne fusson el magától ---
            const originalOnClick = btn.getAttribute('onclick') || '';
            btn.removeAttribute('onclick');

            // isopenclose('URL','QTY','AMOUNT') → paraméterek kinyerése
            function parseArgs(str){
                const m = String(str).match(/isopenclose\(\s*'([^']+)'\s*,\s*'([^']+)'\s*,\s*'([^']+)'\s*\)/);
                return m ? { url:m[1], qty:m[2], amount:m[3] } : null;
            }
            const args = parseArgs(originalOnClick);

            const el  = id => document.getElementById(id);
            const val = id => document.querySelector('input#'+id)?.value ?? el(id)?.value ?? '';

            function selectedPaymentType(){
                const r = document.querySelector('input[name="transaction_type"]:checked')
                    ||  document.querySelector('input[name="payment_type"]:checked')
                    ||  document.querySelector('input[type="radio"][value="16"]:checked');
                return r ? parseInt(r.value, 10) : null;
            }
            function showLoader(on){ if (loader) loader.classList.toggle('d-none', !on); }

            // ======= HELPERek a placeorder logika tükrözéséhez =======
            function toFloat(any){
                if (any == null) return 0.0;
                if (typeof any === 'number') return any;
                const s0 = String(any);
                let s = s0.replace(/[^\d.,]/g, '');
                if (!s) return 0.0;
                if (s.includes(',') && !s.includes('.')) s = s.replace(',', '.');
                else s = s.replace(/,/g, '');
                const n = parseFloat(s);
                return isNaN(n) ? 0.0 : n;
            }

            // ✅ UNIVERZÁLIS: ÁSZF kötelező minden típushoz
            function validateTerms(){
                const cb = document.getElementById('terms');
                if (!cb) return true; // ha valamiért nincs checkbox, ne blokkoljunk
                if (!cb.checked){
                    cb.classList.add('is-invalid');
                    if (window.toastr) { toastr.clear(); toastr.error('Az ÁSZF és az Adatvédelmi Tájékoztató elfogadása kötelező.'); }
                    else if (window.Swal) { Swal.fire({toast:true,position:'top-end',timer:3500,showConfirmButton:false,icon:'error',
                        title:'Az ÁSZF és az Adatvédelmi Tájékoztató elfogadása kötelező.'}); }
                    else { ui.error('Az ÁSZF és az Adatvédelmi Tájékoztató elfogadása kötelező.'); }
                    cb.focus();
                    return false;
                }
                cb.classList.remove('is-invalid');
                return true;
            }

            // kötelező mezők (Barionhoz – 16)
            function validateRequiredFor16(){
                const first  = el('first_name')?.value?.trim() || '';
                const last   = el('last_name')?.value?.trim()  || '';
                const email  = el('email')?.value?.trim()      || '';
                const mobile = el('mobile')?.value?.trim()     || '';
                if (!first){ ui.error(el('first_name_message')?.value || 'Keresztnév kötelező'); el('first_name')?.focus(); return false; }
                if (!last){  ui.error(el('last_name_message')?.value  || 'Vezetéknév kötelező'); el('last_name')?.focus();  return false; }
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
                    ui.error(el('email_message')?.value || 'Érvénytelen e-mail'); el('email')?.focus(); return false;
                }
                if (!mobile){ ui.error(el('mobile_message')?.value || 'Telefon kötelező'); el('mobile')?.focus(); return false; }

                const orderType = (el('order_type')?.value || '1');
                if (orderType === '1'){ // kiszállítás
                    const address = el('new_address')?.value?.trim() || '';
                    const city    = el('new_city')?.value?.trim()    || '';
                    const areaSel = el('delivery_area');

                    if (!address || !/\d/.test(address)){
                        ui.error(el('new_address_message')?.value || 'Cím (házszámmal) kötelező');
                        el('new_address')?.focus();
                        return false;
                    }
                    if (!city){
                        ui.error(el('new_city_message')?.value || 'Város kötelező');
                        el('new_city')?.focus();
                        return false;
                    }
                    if (areaSel && !areaSel.value){
                        ui.error(el('shipping_area_message')?.value || 'Válaszd ki a szállítási területet');
                        areaSel.focus();
                        return false;
                    }

                    const dateEl = document.querySelector('.delivery_pickup_date');
                    const timeEl = el('deliverytime');
                    if (dateEl && !dateEl.value){
                        ui.error(el('delivery_date_message')?.value || 'Szállítási dátum kötelező');
                        dateEl.focus();
                        return false;
                    }
                    if (timeEl && !timeEl.value){
                        ui.error(el('delivery_time_message')?.value || 'Idősáv kötelező');
                        timeEl.focus();
                        return false;
                    }
                }
                return true;
            }

            // Minimum összeg (Barionhoz – 16)
            function validateMinTotalFor16(){
                const orderType = (el('order_type')?.value || '1');
                if (orderType !== '1') return true; // csak kiszállításnál

                const grand_total     = val('grand_total');
                const delivery_charge = val('delivery_charge');
                const dc = Math.round(toFloat(delivery_charge));
                const gt = Math.max(0, Math.round(toFloat(grand_total)) - dc);

                const minRequired = (dc <= 1100) ? 2500 : ((dc <= 1900) ? 4900 : 5900);

                if (gt < minRequired){
                    const missing = minRequired - gt;
                    ui.error('Nincs meg a minimum rendelési összeg: ' + minRequired + ' Ft. '
                        + 'Jelenlegi (végösszeg): ' + gt + ' Ft. Hiányzik: ' + missing + ' Ft.');
                    return false;
                }
                return true;
            }

            async function callIsOpenClose(url, qty, amount, buynow){
                const body = new URLSearchParams();
                body.set('qty',          qty ?? '');
                body.set('order_amount', amount ?? '');
                body.set('buynow',       buynow ?? '0');
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: body.toString()
                });
                if (!res.ok) throw new Error('isopenclose HTTP ' + res.status);
                return await res.json(); // {status, message}
            }

            async function startBarion(){
                const payload = {
                    grand_total:     val('grand_total'),
                    tax:             val('tax'),
                    tax_name:        val('tax_name'),
                    order_type:      el('order_type')?.value ?? '',
                    delivery_charge: val('delivery_charge'),
                    buynow:          val('buynow'),

                    email:      el('email')?.value ?? '',
                    mobile:     el('mobile')?.value ?? '',
                    first_name: el('first_name')?.value ?? '',
                    last_name:  el('last_name')?.value ?? '',

                    address:       el('new_address')?.value ?? '',
                    city:          el('new_city')?.value ?? '',
                    landmark:      el('landmark')?.value ?? '',
                    pincode:       el('pincode')?.value ?? '',
                    country:       el('country')?.value ?? '',
                    state:         el('state')?.value ?? '',
                    order_notes:   el('order_notes')?.value ?? '',
                    delivery_date: document.querySelector('.delivery_pickup_date')?.value ?? '',
                    delivery_time: el('deliverytime')?.value ?? ''
                };

                const res = await fetch('<?php echo e(route('barion.start')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify(payload)
                });
                if (!res.ok){
                    const t = await res.text();
                    throw new Error('Barion indítás hiba (HTTP '+res.status+'): '+t);
                }
                const data = await res.json();
                if (data?.ok && data?.redirect){
                    window.location.href = data.redirect; // → Barion
                    return;
                }
                throw new Error(data?.msg || 'Barion indítás sikertelen');
            }

            // FŐ GOMB – MINDEN FIZETÉSI TÍPUS ELŐTT ÁSZF ELLENŐRZÉS
            btn.addEventListener('click', async function(e){
                e.preventDefault();
                e.stopPropagation();

                // ⬅ KÖTELEZŐ ÁSZF minden ágon
                if (!validateTerms()) return;

                const type = selectedPaymentType();

                // Nem Barion (≠16) → a régi flow-hoz vissza (de már ÁSZF ellenőrizve van)
                if (type !== 16){
                    if (args && typeof window.isopenclose === 'function'){
                        return window.isopenclose(args.url, args.qty, args.amount);
                    }
                    return false;
                }

                // Barion (16) – plusz validációk
                if (!validateRequiredFor16()) return;
                if (!validateMinTotalFor16()) return;

                if (!args){
                    ui.error('Hiányzó isopenclose paraméterek.');
                    return;
                }

                try{
                    showLoader(true);

                    // Nyitvatartás + min/max check a meglévő endpointon
                    const buynow = val('buynow') || '0';
                    const chk = await callIsOpenClose(args.url, args.qty, args.amount, buynow);

                    // 0/2 = hiba, 4 = login kell, 1/3 = OK
                    const st = Number(chk?.status ?? 0);
                    if (st === 4){
                        ui.error('<?php echo e(trans('messages.login_required')); ?>');
                        return;
                    }
                    if (st === 0 || st === 2){
                        ui.error(chk?.message || '<?php echo e(trans('messages.wrong')); ?>');
                        return;
                    }

                    // minden zöld → Barion
                    await startBarion();

                } catch(err){
                    console.error(err);
                    ui.error(err?.message || 'Hiba történt.');
                } finally {
                    showLoader(false);
                }
            }, true);
        });
    </script>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/web/checkout/checkout.blade.php ENDPATH**/ ?>