@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="mt-3">Boolbnb Sponsorship</h2>
    <h5 class="d-none d-md-block d-lg-block">Sponsorizza il tuo contenuto per raggiungere più utenti*</h5>
    <div class="mt-3 container">
        <div class="d-flex flex-column align-items-center flex-lg-row justify-content-lg-center">
            @foreach ($sponsorships as $sponsorship)
            <div class="card mx-2 p-3 mb-2" style="width: 15rem;">
                <img class="card-img-top" src="https://play-lh.googleusercontent.com/1zfN_BL13q20v0wvBzMWiZ_sL_t4KcCJBeAMRpOZeT3p34quM-4-pO-VcLj8PJNXPA0" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{$sponsorship->name}}</h4>
                    <h5 class="card-title">{{$sponsorship->price}}€/{{$sponsorship->duration}}h</h5>
                    <a href="{{route('admin.payment.index', [$sponsorship, $apartment])}}" class="btn btn-danger">Acquista</a>
                </div>
            </div>
        @endforeach      
        </div>
        <div>
            <p>*Le sponsorizzazioni sono cumulabili</p>
        </div>      
    </div>
</div>
@endsection


