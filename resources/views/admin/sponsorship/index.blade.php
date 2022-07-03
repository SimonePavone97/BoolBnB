@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Sponsorizzazione</h2>
    <p>Sponsorizza il tuo contenuto per raggiungere più utenti</p>

    <form action="{{route('admin.sponsorship.index')}}">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="d-flex flex-column">
                    @foreach ($sponsorship as $sponsorship)
                        <div class="d-flex">
                            <input type="radio" aria-label="Radio button for following text input" name="sponsorship" class="d-flex">
                            <div class="ml-1">
                                <span>{{$sponsorship->name}}</span>
                                <span>-</span>
                                <span>{{$sponsorship->duration}} ore</span>
                                <span>-</span>
                                <span>{{$sponsorship->price}} $</span>
                            </div>  
                        </div>
                    @endforeach
                </div>               
            </div>
        </div>
        <button type="submit" class="btn btn-success">Acquista</button>
    </form>
</div>
@endsection