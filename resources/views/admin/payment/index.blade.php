@extends('layouts.app')

@section('content')
<div class="container text-center">
    <form method="post" id="payment-form" action="{{ route('admin.payment.checkout', [$sponsorship, $apartment]) }}">
        @csrf
        @method('POST')
        <section>
            <label class="sr-only" for="amount">
                <span class="input-label" readonly>Prezzo</span>
                <div class="input-wrapper amount-wrapper">
                    <input readonly id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="{{$amount}}">
                </div>

                <div class="bt-drop-in-wrapper text-start">
                        <div id="bt-dropin"></div>
                </div>
            </label>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="btn btn-success" type="submit"><span>Paga ora</span></button>
    </form>
</div>
@endsection

<script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.js"></script>
<script>
    var form = document.querySelector('#payment-form');

    braintree.dropin.create({
    authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
    selector: '#bt-dropin'
    }, function (createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
                if(err){
                    console.log('Request Payment Method Error', err);
                    return;
                }
                // Submit payload.nonce to your server
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>