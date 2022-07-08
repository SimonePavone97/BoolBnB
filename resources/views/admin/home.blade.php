@php
    use Illuminate\Support\Facades\Auth;
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
                            <h2>0</h2>
                            <p>Annunci</p>
                        </div>
                        <div class="infobox-icon">
                            <i class="fa-solid fa-house"></i>
                        </div>
                    </div>
                    {{-- Messaggi --}}
                    <div class="infobox">
                        <div class="infobox-text">
                            <h2>0</h2>
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
                            <p>Annunci</p>
                        </div>
                        <div class="infobox-icon">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection