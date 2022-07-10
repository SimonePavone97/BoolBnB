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
                    <a href="{{route('admin.payment.index', $sponsorship)}}" class="btn btn-danger">Acquista</a>
                </div>
            </div>
        @endforeach
    </div>

     <form method="post" id="payment-form" autocomplete="off">
                @csrf
                @method('POST')

                  {{-- SELECT SPONSORSHIP --}}
                  <label class="sr-only">Seleziona la sponsorizzazione</label><br>
                  <select id="sponsorship_select" name="sponsorship_select" class="form-control">
                    <option>Seleziona la sponsorizzazione</option>
                    @foreach ($sponsorships as $sponsorship)
                        <option data-price="{{ $sponsorship->price }}" value="{{ $sponsorship->id }}">{{ $sponsorship->name }}</option>
                    @endforeach
                  </select>

                  {{-- PRICE --}}
                  <div class="text-right mt-5 sponsorship-price">
                    <label for="amount">
                      <span class="font-weight-bold boolbnb-red">Prezzo:</span>
                    </label>
                    <div class="">
                      <input class="text-right border-0 font-weight-bold" id="amount" name="amount" type="tel" min="1" value="" readonly> <span class="font-weight-bold">€</span>
                    </div>
                  </div>

                  {{-- CREDIT CARD --}}
                  <div id="dropin" class="mb-4"></div>

                  {{-- PAY BUTTON --}}
                  <div class="text-right">
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="btn btn-success" type="submit"><span>Paga ora</span></button>
                  </div>

                </form>
</div>
@endsection


