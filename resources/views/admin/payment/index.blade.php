@extends('layouts.app')

@section('content')
    @if (session('success-message'))
        <div class="alert alert-success">
            {{session('success-message')}}
        </div>
    @endif
    
    @if (count($errors) > 0)
        <script>
            Swal.fire(
                'Qualcosa è andato storto!',
                'Errore imprevisto'
            )
        </script>
    @endif
    
    <div class="container text-center">
        <form method="post" id="payment-form" action="{{ route('admin.payment.checkout', [$sponsorship, $apartment]) }}">
            @csrf
            @method('POST')
            <section>
                <label for="amount">
                    <span class="input-label" readonly>Prezzo</span>
                    <div class="input-wrapper amount-wrapper">
                        <input readonly id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="{{$amount}}€">
                    </div>

                    <div class="bt-drop-in-wrapper text-start">
                        <div id="bt-dropin"></div>
                    </div>
                </label>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-success" type="submit"><span>Acquista</span></button>
        </form>
    </div>


    <script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{$token}}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            locale: 'it_IT'
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

@endsection