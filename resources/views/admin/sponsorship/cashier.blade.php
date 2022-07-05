@extends('layouts.app')

@section('content')

<div id="dropin-container">

</div>
<button id="submit-button" type="submit" class="btn btn-success">Acquista</button>

@endsection

<script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.js"></script>
<script>
    var button = document.querySelector('#submit-button');

braintree.dropin.create({
  authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
  selector: '#dropin-container'
}, function (err, instance) {
  button.addEventListener('click', function () {
    instance.requestPaymentMethod(function (err, payload) {
      // Submit payload.nonce to your server
    });
  })
});
</script>