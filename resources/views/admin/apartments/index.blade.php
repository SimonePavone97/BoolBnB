@extends('layouts.app')

@section('content')
    <div class="container" id="apartment-index">
        @if (session('success-message'))
            <div class="alert alert-success">
                {{session('success-message')}}
            </div>
        @endif
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    <li>
                        {{$amount}}
                    </li>
                </ul>
            </div>
        @endif

        @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
        @endif

        <h1 class="text-center m-3">Appartamenti</h1>

        <a href=" {{route('admin.apartments.create')}} " class="btn btn-pink rounded-pill mb-2">
            <i class="fa-solid fa-plus"></i>
            Aggiungi annuncio
        </a>
        
        <div class="container p-0">
            <table class="table">
                <thead class="text-white text-center" style="background-color:#ff385c">
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col" class="table-img">Immagine</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Mq</th>
                        <th scope="col">Stanze</th>
                        <th scope="col">Gestisci</th>
                    </tr>
                </thead>
                <tbody>
    
                @forelse ($apartments as $apartment)
                    <tr>
                        <td class="font-weight-bold">{{ $apartment->title }}</td>
                        <td class="table-img text-center"><img src="{{ asset('images/apartments') }}/{{ $apartment->image }}" alt="Apartment Image" width="100px"></td>
                        <td class="text-center">{{ $apartment->address }}</td>
                        <td class="text-center">{{ $apartment->mq }}</td>
                        <td class="text-center">{{ $apartment->rooms }}</td>
                        <td class="d-flex justify-content-center flex-wrap">
                            <a class="btn btn-success" href="{{ route('admin.sponsorship.index', $apartment->id) }}">Sponsorizza</a>
                            <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Dettagli</a>
                            <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Modifica</a>
                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" data-title="{{ $apartment->title }}">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p class="text-center font-weight-bold text-danger">Non sono presenti appartamenti</p>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection