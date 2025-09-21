<div class="row g-3 justify-content-between">
    <?php
        $isGuest = !auth()->check();

        // Currency COD-hoz
        $cod    = $getpaymentmethods->firstWhere('payment_type', '1');
        $cod15  = $getpaymentmethods->firstWhere('payment_type', '15');
        $codCur = optional($cod)->currency ?? optional($cod15)->currency ?? '';
        $cardCur= optional($cod15)->currency ?? $codCur ?? '';
    ?>

    
    <label class="form-check-label col-md-6" for="payment1_cash">
        <input class="form-check-input"
               type="radio"
               name="transaction_type"
               id="payment1_cash"
               value="1"
               data-uid="cod_cash"
               data-currency="<?php echo e($codCur); ?>"
               checked>
        <div class="payment-gateway mb-0 justify-content-between">
            <span>
                <img src="<?php echo e(helper::image_path('cod.png')); ?>" class="<?php echo e(session()->get('direction') == '2' ? 'ms-2' : 'me-2'); ?>" alt="">
                Fizetés átvételkor (Készpénz)
            </span>
            <span class="check-icon"></span>
        </div>
    </label>

    
    <label class="form-check-label col-md-6" for="payment1_card">
        <input class="form-check-input"
               type="radio"
               name="transaction_type"
               id="payment1_card"
               value="1"
               data-uid="cod_card"
               data-order_notes="Kártyával"
               data-currency="<?php echo e($cardCur); ?>">
        <div class="payment-gateway mb-0 justify-content-between">
            <span>
                <img src="<?php echo e(helper::image_path('khalti.png')); ?>" class="<?php echo e(session()->get('direction') == '2' ? 'ms-2' : 'me-2'); ?>" alt="">
                Fizetés átvételkor (Kártya)
            </span>
            <span class="check-icon"></span>
        </div>
    </label>

    
    <?php $__currentLoopData = $getpaymentmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $pt = (int) ($pmdata->payment_type ?? 0);

            // az 1 és 15 fent már külön megjelenik
            if (in_array($pt, [1, 15])) { continue; }

            // aktivált módszer-e?
            $systemAddonActivated = in_array($pt, [2,3,4,5,6,7,8,9,10,11,12,13,14,16]);
            $addon = App\Models\SystemAddons::where('unique_identifier', $pmdata->unique_identifier)->first();
            if ($addon && $addon->activated == 1) { $systemAddonActivated = true; }

            $isWallet  = ($pt === 2);
            $disabled  = ($isWallet && $isGuest); // vendégként wallet tiltva
        ?>

        <?php if($systemAddonActivated): ?>
            <label class="form-check-label col-md-6 <?php echo e($disabled ? 'opacity-50' : ''); ?>" for="payment<?php echo e($pt); ?>">
                <input class="form-check-input"
                       type="radio"
                       name="transaction_type"
                       id="payment<?php echo e($pt); ?>"
                       data-payment-type="<?php echo e($pt); ?>"
                       value="<?php echo e($pt); ?>"
                       data-currency="<?php echo e($pmdata->currency); ?>"
                       <?php if($disabled): ?> disabled title="Bejelentkezés szükséges" <?php endif; ?>>
                <div class="payment-gateway mb-0 justify-content-between">
                    <span>
                        <img src="<?php echo e(helper::image_path($pmdata->image)); ?>"
                             class="<?php echo e(session()->get('direction') == '2' ? 'ms-2' : 'me-2'); ?>" alt="">
                        <?php echo e(ucfirst($pmdata->payment_name)); ?>

                    </span>
                    <div class="d-flex gap-2">
                        <?php if($isWallet): ?>
                            <?php if(auth()->guard()->check()): ?>
                                <span class="text-end text-muted">
                                    <?php echo e(helper::currency_format(Auth::user()->wallet ?? 0)); ?>

                                </span>
                            <?php else: ?>
                                <span class="small text-danger">Bejelentkezés szükséges</span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <span class="check-icon"></span>
                    </div>
                </div>
            </label>
        <?php endif; ?>

        
        <?php if(in_array($pt, [3,4,5,6])): ?>
            <?php if($pt === 3): ?>
                <input type="hidden" name="razorpaykey" id="razorpaykey" value="<?php echo e($pmdata->public_key); ?>">
            <?php endif; ?>
            <?php if($pt === 4): ?>
                <input type="hidden" name="stripekey" id="stripekey" value="<?php echo e($pmdata->public_key); ?>">
                <form action="" method="" id="payment-form" class="d-none">
                    <div class="my-3" id="card-element"></div>
                </form>
            <?php endif; ?>
            <?php if($pt === 5): ?>
                <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="<?php echo e($pmdata->public_key); ?>">
            <?php endif; ?>
            <?php if($pt === 6): ?>
                <input type="hidden" name="paystackkey" id="paystackkey" value="<?php echo e($pmdata->public_key); ?>">
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php if(!in_array(4, array_column($getpaymentmethods->toArray(), 'id'))): ?>
        <input type="hidden" name="stripekey" id="stripekey" value="">
    <?php endif; ?>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const TAG   = '|->KÁRTYÁVAL FIZET<-|';
        const notes = document.querySelector('#order_notes, textarea[name="order_notes"], input[name="order_notes"]');
        const radios = document.querySelectorAll('input[name="transaction_type"]');

        if (!notes) return;

        // Kártya van-e kiválasztva? (igazítsd a feltételeket a saját markupodhoz)
        function isCardSelected() {
            const sel = document.querySelector('input[name="transaction_type"]:checked');
            if (!sel) return false;
            const uid = sel.getAttribute('data-uid') || '';
            const val = sel.value;
            // pl. 'cod_card' vagy value==2 (Bankkártya futárnál)
            return uid === 'cod_card' || String(val) === '2';
        }

        // Csak akkor írjuk be a TAG-et, ha üres a mező
        function ensureTagIfEmptyForCard() {
            if (isCardSelected()) {
                if (notes.value.trim() === '') {
                    notes.value = TAG;
                }
            }
        }

        // Ha NEM kártya és a mezőben csak a TAG van, töröljük (ne maradjon ott feleslegesen)
        function stripTagIfOnlyTag() {
            const t = (notes.value || '').trim();
            if (!isCardSelected() && (t === TAG)) {
                notes.value = '';
            }
        }

        // Fizetési mód váltásakor
        radios.forEach(r => r.addEventListener('change', function () {
            // sosem bántjuk a user saját szövegét
            if (notes.value.trim() === '') {
                ensureTagIfEmptyForCard(); // üresnél beírjuk, ha kártya
            } else {
                stripTagIfOnlyTag();       // ha nem kártya és csak TAG áll, töröljük
            }
        }));

        // Submitkor is biztosítsuk
        const form = document.querySelector('#checkout-form')
            || document.querySelector('form.checkout-form')
            || document.querySelector('form[action*="place-order"]')
            || document.querySelector('form');

        if (form) {
            form.addEventListener('submit', function () {
                if (notes.value.trim() === '') {
                    ensureTagIfEmptyForCard();
                } else {
                    stripTagIfOnlyTag();
                }
            });
        }

        // Első betöltéskor – ha kártya az alapértelmezett és üres a mező
        if (notes.value.trim() === '') {
            ensureTagIfEmptyForCard();
        }
    });
</script>



<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/web/paymentmethodsview.blade.php ENDPATH**/ ?>