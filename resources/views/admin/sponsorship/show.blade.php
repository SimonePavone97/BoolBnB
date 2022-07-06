@extends('layouts.app')

@section('content')

<div class="text-center">
    <img class="img-fluid" src="https://play-lh.googleusercontent.com/1zfN_BL13q20v0wvBzMWiZ_sL_t4KcCJBeAMRpOZeT3p34quM-4-pO-VcLj8PJNXPA0" alt="">
    <h3 class="mt-5">Stai acquistando la sponsorizzazione {{$sponsorship->name}} a {{$sponsorship->price}}€ e durerà per {{$sponsorship->duration}} ore</h3>
</div>

<div id="dropin-container" class="d-flex justify-content-center">

</div>
<div class="text-center">
    <button id="submit-button" type="submit" class="btn btn-success">Acquista</button>   
</div>

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