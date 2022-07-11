@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Sponsorizzazione</h2>
    <h5>Sponsorizza il tuo contenuto per raggiungere più utenti</h5>
    <div class="d-flex justify-content-center">
        @foreach ($sponsorships as $sponsorship)
            <div class="card mx-2" style="width: 18rem;">
                <img class="card-img-top" src="https://play-lh.googleusercontent.com/1zfN_BL13q20v0wvBzMWiZ_sL_t4KcCJBeAMRpOZeT3p34quM-4-pO-VcLj8PJNXPA0" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{$sponsorship->name}}</h4>
                    <h5 class="card-title">{{$sponsorship->price}}€</h5>
                    <h5 class="card-title">{{$sponsorship->duration}}h</h5>
                </div>
            </div>
        @endforeach
    </div>
    <form method="get" id="payment-form" autocomplete="off" action="{{ route('admin.payment.checkout', $apartment) }}">
        @csrf
        @method('POST')

        <label class="sr-only">Seleziona la sponsorizzazione</label><br>
        <select id="sponsorship_select" name="sponsorship_select" class="form-control">
            <option>Seleziona il pacchetto</option>
                @foreach ($sponsorships as $sponsorship)
                    <option data-price="{{ $sponsorship->price }}" value="{{ $sponsorship->id }}">
                        {{ $sponsorship->name }}
                    </option>
                @endforeach
        </select>



        <div id="dropin" class="mb-4"></div>


        <div class="text-right d-flex justify-content-center">
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-success" type="submit"><span>Paga ora</span></button>
        </div>
    </form>
</div>
@endsection

<script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.js"></script>
<script>
    var form = document.querySelector('#payment-form');

braintree.dropin.create({
  authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
  selector: '#dropin'
}, function (err, instance) {
  button.addEventListener('click', function () {
    instance.requestPaymentMethod(function (err, payload) {
      // Submit payload.nonce to your server
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
    });
  })
});
</script>