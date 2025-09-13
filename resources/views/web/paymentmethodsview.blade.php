<div class="row g-3 justify-content-between">
    @php
        $isGuest = !auth()->check();

        // Currency COD-hoz
        $cod    = $getpaymentmethods->firstWhere('payment_type', '1');
        $cod15  = $getpaymentmethods->firstWhere('payment_type', '15');
        $codCur = optional($cod)->currency ?? optional($cod15)->currency ?? '';
        $cardCur= optional($cod15)->currency ?? $codCur ?? '';
    @endphp

    {{-- COD – KÉSZPÉNZ (type=1, uid=cod_cash) --}}
    <label class="form-check-label col-md-6" for="payment1_cash">
        <input class="form-check-input"
               type="radio"
               name="transaction_type"
               id="payment1_cash"
               value="1"
               data-uid="cod_cash"
               data-currency="{{ $codCur }}"
               checked>
        <div class="payment-gateway mb-0 justify-content-between">
            <span>
                <img src="{{ helper::image_path('cod.png') }}" class="{{ session()->get('direction') == '2' ? 'ms-2' : 'me-2' }}" alt="">
                Fizetés átvételkor (Készpénz)
            </span>
            <span class="check-icon"></span>
        </div>
    </label>

    {{-- COD – KÁRTYA (type=1, uid=cod_card) --}}
    <label class="form-check-label col-md-6" for="payment1_card">
        <input class="form-check-input"
               type="radio"
               name="transaction_type"
               id="payment1_card"
               value="1"
               data-uid="cod_card"
               data-order_notes="Kártyával"
               data-currency="{{ $cardCur }}">
        <div class="payment-gateway mb-0 justify-content-between">
            <span>
                <img src="{{ helper::image_path('card.png') }}" class="{{ session()->get('direction') == '2' ? 'ms-2' : 'me-2' }}" alt="">
                Fizetés átvételkor (Kártya)
            </span>
            <span class="check-icon"></span>
        </div>
    </label>

    {{-- A többi fizetési mód (wallet/online stb.), az 1 és 15 kihagyva --}}
    @foreach ($getpaymentmethods as $pmdata)
        @php
            $pt = (int) ($pmdata->payment_type ?? 0);

            // az 1 és 15 fent már külön megjelenik
            if (in_array($pt, [1, 15])) { continue; }

            // aktivált módszer-e?
            $systemAddonActivated = in_array($pt, [2,3,4,5,6,7,8,9,10,11,12,13,14]);
            $addon = App\Models\SystemAddons::where('unique_identifier', $pmdata->unique_identifier)->first();
            if ($addon && $addon->activated == 1) { $systemAddonActivated = true; }

            $isWallet  = ($pt === 2);
            $disabled  = ($isWallet && $isGuest); // vendégként wallet tiltva
        @endphp

        @if ($systemAddonActivated)
            <label class="form-check-label col-md-6 {{ $disabled ? 'opacity-50' : '' }}" for="payment{{ $pt }}">
                <input class="form-check-input"
                       type="radio"
                       name="transaction_type"
                       id="payment{{ $pt }}"
                       data-payment-type="{{ $pt }}"
                       value="{{ $pt }}"
                       data-currency="{{ $pmdata->currency }}"
                       @if($disabled) disabled title="Bejelentkezés szükséges" @endif>
                <div class="payment-gateway mb-0 justify-content-between">
                    <span>
                        <img src="{{ helper::image_path($pmdata->image) }}"
                             class="{{ session()->get('direction') == '2' ? 'ms-2' : 'me-2' }}" alt="">
                        {{ ucfirst($pmdata->payment_name) }}
                    </span>
                    <div class="d-flex gap-2">
                        @if ($isWallet)
                            @auth
                                <span class="text-end text-muted">
                                    {{ helper::currency_format(Auth::user()->wallet ?? 0) }}
                                </span>
                            @else
                                <span class="small text-danger">Bejelentkezés szükséges</span>
                            @endauth
                        @endif
                        <span class="check-icon"></span>
                    </div>
                </div>
            </label>
        @endif

        {{-- Rejtett kulcsok a 3–6 típusokhoz (régi kód kompatibilitás) --}}
        @if (in_array($pt, [3,4,5,6]))
            @if ($pt === 3)
                <input type="hidden" name="razorpaykey" id="razorpaykey" value="{{ $pmdata->public_key }}">
            @endif
            @if ($pt === 4)
                <input type="hidden" name="stripekey" id="stripekey" value="{{ $pmdata->public_key }}">
                <form action="" method="" id="payment-form" class="d-none">
                    <div class="my-3" id="card-element"></div>
                </form>
            @endif
            @if ($pt === 5)
                <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="{{ $pmdata->public_key }}">
            @endif
            @if ($pt === 6)
                <input type="hidden" name="paystackkey" id="paystackkey" value="{{ $pmdata->public_key }}">
            @endif
        @endif
    @endforeach

    {{-- Ha nincs Stripe (id=4) beállítva, üres kulcs --}}
    @if (!in_array(4, array_column($getpaymentmethods->toArray(), 'id')))
        <input type="hidden" name="stripekey" id="stripekey" value="">
    @endif
</div>

{{-- Mini script: a "Kártyával" megjegyzés automatikus kezelése COD-kártyánál --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notes = document.querySelector('#order_notes, textarea[name="order_notes"], input[name="order_notes"]');
        const radios = document.querySelectorAll('input[name="transaction_type"]');

        function applyNote(el) {
            if (!notes) return;
            const uid = el.getAttribute('data-uid') || '';
            const note = el.getAttribute('data-order_notes') || '';

            if (uid === 'cod_card' && note) {
                notes.value = note;
            } else if (uid === 'cod_cash') {
                notes.value = '';
            } else {
                if (notes.value === 'Kártyával') notes.value = '';
            }
        }

        radios.forEach(r => r.addEventListener('change', function(){ applyNote(this); }));
        const checked = document.querySelector('input[name="transaction_type"]:checked');
        if (checked) applyNote(checked);
    });
</script>
