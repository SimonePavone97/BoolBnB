@extends('layouts.app')

@section('content')

    <div>
        @if (session('success-message'))
            <div class="alert alert-success">
                {{session('success-message')}}
            </div>
        @endif
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    <li>
                        {{$amount}}
                    </li>
                </ul>
            </div>
        @endif
    </div>
    
    <div class="container text-center">
        <form method="post" id="payment-form" action="{{ route('admin.payment.checkout', [$sponsorship, $apartment]) }}">
            @csrf
            @method('POST')           
            <section class="mt-4">
                <label for="amount">
                    <div class="text-center d-flex flex-column align-items-center">
                        <img class="img-fluid w-25 d-none d-md-block" src="https://play-lh.googleusercontent.com/1zfN_BL13q20v0wvBzMWiZ_sL_t4KcCJBeAMRpOZeT3p34quM-4-pO-VcLj8PJNXPA0" alt="">
                        <h5 class="mt-5 title" style="--duration: 2s"><span style="--delay: .1s" class="p-3 reveal">Stai acquistando il pacchetto <span class="text-color-pink">{{$sponsorship->name}}</span> al prezzo di <span class="text-color-pink">{{$sponsorship->price}}€</span> ed il tuo appartamento sarà più visibile agli utenti per <span class="text-color-pink">{{$sponsorship->duration}} ore</span></span> </h5>
                    </div>
                    <div class="bt-drop-in-wrapper text-start">
                        <div id="bt-dropin"></div>
                    </div>
                </label>
            </section>
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-danger my-3" type="submit"><span>Acquista</span></button>
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