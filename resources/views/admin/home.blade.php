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
                <div class="col-4">
                    <div class="dashboard-action">
                        <ul>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-message"></i>
                                    Messaggi
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-square-pen"></i>
                                    Gestisci gli annunci
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-plus"></i>
                                    Pubblica un annuncio
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Esci
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection