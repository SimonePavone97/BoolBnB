@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
        @endif

        <h1 class="text-center m-3">Appartamenti</h1>

        <a href=" {{route('admin.apartments.create')}} " class="btn btn-success mb-2">Create apartment</a>
        
        <div class="container">
            <table class="table">
                <thead class="text-white" style="background-color:#ff385c">
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col">Immagine</th>
                        <!-- <th scope="col">Stanze</th>
                        <th scope="col">Bagni</th>
                        <th scope="col">Letti</th>
                        <th scope="col">Mq</th> -->
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Visibilità</th>
                        <th scope="col">Azione</th>
                    </tr>
                </thead>
                <tbody>
    
                @forelse ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td><img src="{{ $apartment->image }}" alt="Apartment Image" width="100"></td>
                        <!-- <td>{{ $apartment->rooms }}</td>
                        <td>{{ $apartment->bathrooms }}</td>
                        <td>{{ $apartment->beds }}</td>
                        <td>{{ $apartment->mq }}</td> -->
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->description }}</td>
                        <td>{{ $apartment->visibility }}</td>
                        <td class="d-flex">
                            <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Details</a>
                            <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a>
                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="delete-form" data-title="{{ $apartment->title }}">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn btn-success" href="{{ route('admin.sponsorship.index', $apartment->id) }}">Sponsor</a>
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