<div class="row g-3 justify-content-between">
    @php
        // próbáljuk a currency-t kinyerni a DB-ből, ha van 1-es vagy 15-ös rekord
        $cod    = $getpaymentmethods->firstWhere('payment_type', '1');
        $cod15  = $getpaymentmethods->firstWhere('payment_type', '15');
        $codCur = optional($cod)->currency ?? optional($cod15)->currency ?? '';
        $cardCur= optional($cod15)->currency ?? $codCur ?? '';
    @endphp
    {{-- COD – KÉSZPÉNZ (type=1, uid=cod_cash) --}}
    <label class="form-check-label col-md-6" for="payment1_cash">
        <input class="form-check-input" type="radio" name="transaction_type" id="payment1_cash"
               value="1"
               data-uid="cod_cash"
               data-currency="{{ $codCur }}" checked>
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
        <input class="form-check-input" type="radio" name="transaction_type" id="payment1_card"
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
            $transaction_type = (int) $pmdata->payment_type;
            // az 1 és 15 fent külön megjelenik
            if (in_array($transaction_type, [1,15])) { continue; }

            // aktivált módszer-e?
            $systemAddonActivated = in_array($transaction_type, [2,3,4,5,6,7,8,9,10,11,12,13,14]);
            $addon = App\Models\SystemAddons::where('unique_identifier', $pmdata->unique_identifier)->first();
            if ($addon && $addon->activated == 1) { $systemAddonActivated = true; }
        @endphp

        @if ($systemAddonActivated)
            <label class="form-check-label col-md-6" for="payment{{ $transaction_type }}">
                <input class="form-check-input" type="radio" name="transaction_type" id="payment{{ $transaction_type }}"
                       data-payment-type="{{ $transaction_type }}" value="{{ $transaction_type }}"
                       data-currency="{{ $pmdata->currency }}">
                <div class="payment-gateway mb-0 justify-content-between">
                    <span>
                        <img src="{{ helper::image_path($pmdata->image) }}"
                             class="{{ session()->get('direction') == '2' ? 'ms-2' : 'me-2' }}" alt="">
                        {{ ucfirst($pmdata->payment_name) }}
                    </span>
                    <div class="d-flex gap-2">
                        @if ($transaction_type === 2)
                            <span class="text-end text-muted">{{ helper::currency_format(Auth::user()->wallet) }}</span>
                        @endif
                        <span class="check-icon"></span>
                    </div>
                </div>
            </label>
        @endif

        @if (in_array($transaction_type, [3,4,5,6]))
            @if ($transaction_type === 3)
                <input type="hidden" name="razorpaykey" id="razorpaykey" value="{{ $pmdata->public_key }}">
            @endif
            @if ($transaction_type === 4)
                <input type="hidden" name="stripekey" id="stripekey" value="{{ $pmdata->public_key }}">
                <form action="" method="" id="payment-form" class="d-none">
                    <div class="my-3" id="card-element"></div>
                </form>
            @endif
            @if ($transaction_type === 5)
                <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="{{ $pmdata->public_key }}">
            @endif
            @if ($transaction_type === 6)
                <input type="hidden" name="paystackkey" id="paystackkey" value="{{ $pmdata->public_key }}">
            @endif
        @endif
    @endforeach

    @if (!in_array(4, array_column($getpaymentmethods->toArray(), 'id')))
        <input type="hidden" name="stripekey" id="stripekey" value="">
    @endif
</div>

