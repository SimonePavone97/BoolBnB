@extends('layouts.app')

@section('content')
    <div class="container">
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

        <a href=" {{route('admin.apartments.create')}} " class="btn btn-success mb-2">Aggiungi appartamento</a>
        
        <div class="container p-0">
            <table class="table">
                <thead class="text-white text-center" style="background-color:#ff385c">
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col" class="table-img">Immagine</th>
                        <!-- <th scope="col">Stanze</th>
                        <th scope="col">Bagni</th>
                        <th scope="col">Letti</th>
                        <th scope="col">Mq</th> -->
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Azione</th>
                    </tr>
                </thead>
                <tbody>
    
                @forelse ($apartments as $apartment)
                    <tr>
                        <td class="text-center">{{ $apartment->title }}</td>
                        <td class="table-img text-center"><img src="{{ asset('images/apartments') }}/{{ $apartment->image }}" alt="Apartment Image" width="100px"></td>
                        <!-- <td>{{ $apartment->rooms }}</td>
                        <td>{{ $apartment->bathrooms }}</td>
                        <td>{{ $apartment->beds }}</td>
                        <td>{{ $apartment->mq }}</td> -->
                        <td class="text-center">{{ $apartment->address }}</td>
                        <td class="text-center">{{ $apartment->description }}</td>
                        <td class="row m-0">
                            <div class="col-lg-4 col-sm-12 py-sm-1 text-center">
                                <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Dettagli</a>
                            </div>
                            <!-- <div>
                                <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Modifica</a>
                            </div> -->
                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="delete-form col-lg-4 col-sm-12 py-sm-1 text-center" data-title="{{ $apartment->title }}">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="btn btn-danger">Elimina</button>
                            </form>
                            <div class="col-lg-4 col-sm-12 py-sm-1 text-center">
                                <a class="btn btn-success" href="{{ route('admin.sponsorship.index', $apartment->id) }}">Sponsorizza</a>
                            </div>
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