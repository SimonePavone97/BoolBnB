@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
@endphp

@extends('layouts.app')

@section('title', 'Boolbnb - Dashboard')

@section('content')
    <div class="heading">
        <div class="container">
            <h1>Ciao, {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h1>
        </div>
    </div>

    <div class="container">
        <div class="dashboard-content">
            {{-- Action & Info --}}
            <div class="row">
                {{-- Action --}}
                <div class="col-4">
                    <div class="dashboard-action">
                        <ul>
                            <li>
                                <a href="{{ route('admin.messages.index') }}">
                                    <i class="fa-solid fa-message"></i>
                                    Messaggi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.apartments.index') }}">
                                    <i class="fa-solid fa-square-pen"></i>
                                    Gestisci gli annunci
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.apartments.create') }}">
                                    <i class="fa-solid fa-plus"></i>
                                    Pubblica un annuncio
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Esci
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-8 d-flex">
                    {{-- Annunci --}}
                    <div class="infobox">
                        <div class="infobox-text">
                            <h2>{{ DB::table('apartments')->where('user_id', Auth::id())->count() }}</h2>
                            <p>Annunci</p>
                        </div>
                        <div class="infobox-icon">
                            <i class="fa-solid fa-house"></i>
                        </div>
                    </div>
                    {{-- Messaggi --}}
                    <div class="infobox">
                        <div class="infobox-text">
                            <h2>{{ DB::table('users')
                                       ->join('apartments', 'users.id', '=', 'apartments.user_id')
                                       ->join('messages', 'apartments.id', '=', 'messages.apartment_id')
                                       ->where('users.id', Auth::id())
                                       ->count()
                                }}
                            </h2>
                            <p>Messaggi</p>
                        </div>
                        <div class="infobox-icon">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </div>
                    {{-- Visualizzazioni --}}
                    <div class="infobox">
                        <div class="infobox-text">
                            <h2>0</h2>
                            <p>Visualizzazioni</p>
                        </div>
                        <div class="infobox-icon">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-4">
                    <h4 class="mb-3">Sponsorizzazioni attive</h4>

                    @php
                        $sponsorships = DB::table('users')
                                       ->join('apartments', 'users.id', '=', 'apartments.user_id')
                                       ->join('apartment_sponsorship', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                                       ->where('users.id', Auth::id())
                                       ->select('apartments.title', 'apartment_sponsorship.end_sponsorship')->get();
                    @endphp

                    @if (count($sponsorships) > 0)
                    <table class="table">
                        <thead>
                            <tr class="bg_primary">
                                <th scope="col" class="col-8">Appartamento</th>
                                <th scope="col" class="col-4">Fine Sponsorizzazione</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sponsorships as $sponsorship)
                                <tr>
                                    <td>{{$sponsorship->title}}</td>
                                    <td>{{$sponsorship->end_sponsorship}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>     
                    @else
                        <h5 class="text-gray">Non ci sono sponsorizzazioni attive</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection