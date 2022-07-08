@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center py-3">Dati utente</h2>
    <div class="card">
        <div class="card-body d-flef felx-wrap">

            <div class="col-12">
                <span class="card-text">Nome: {{ $user->first_name }}</span>
            </div>
            <div class="col-12">
                <span class="card-text">Cognome: {{ $user->last_name }}</span>
            </div>
            <div class="col-12">
                <span class="card-text">Compleanno: {{ $user->birth_date }}</span>
            </div>
            <div class="col-12">
                <span class="card-text">Email: {{ $user->email }}</span>
            </div>

            <div class="col-12">
                <button type="button" class="btn btn-primary my-2"><a class="text-white" href="{{route('admin.user.edit', $user->id)}}">Modifica</a></button>
            </div>
        </div>
    </div>
</div>
@endsection