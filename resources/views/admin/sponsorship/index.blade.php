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
                    <a href="{{route('admin.payment.index', [$sponsorship, $apartment])}}" class="btn btn-danger">Acquista</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


