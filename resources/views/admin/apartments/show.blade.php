@extends('layouts.app');

@section('content')
  <div class="container">

    <h2 class="text-center py-3">Dettagli appartamento</h2>

    <div class="card">
      <div class="card-body d-flex flex-wrap">

        <div class="col-12">
          <h5 class="card-title font-weight-bold">{{ $apartment->title }}</h5>
        </div>

        <div class="col-12">
          <img src="{{ asset('storage/' . $apartment->image) }}" class="card-img-top mt-2" alt="{{ $apartment->title }}">
        </div>

        <div class="col-12">
          <p class="card-text">{{ $apartment->description }}</p>
        </div>

        <div class="col-12">
          <span class="card-text"><span class="font-weight-bold">Stanze: </span>{{ $apartment->rooms }} - </span>
          <span class="card-text"><span class="font-weight-bold">Bagni:</span> {{ $apartment->bathrooms }} - </span>
          <span class="card-text"><span class="font-weight-bold">Letti: </span>{{ $apartment->beds }} - </span>
          <span class="card-text"><span class="font-weight-bold">Mq: </span>{{ $apartment->mq }}</span>
        </div>

        <div class="col-12">
          <span>Servizi:</span>
          <ul>
          @forelse($apartment->services as $service)
            <li>{{$service->name}}</li>
          @empty
            <li>Non sono segnalati servizi</li>
          @endforelse
          </ul>
        </div>

        <div class="col-12">
          <button type="button" class="btn btn-primary my-2"><a class="text-white" href="{{route('admin.apartments.edit', $apartment->id)}}">Modifica</a></button>
          <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="delete-form" data-title="{{ $apartment->title }}">
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-danger">Cancella</button>
          </form>
          <button type="button" class="btn btn-secondary my-2"><a class="text-white" href="{{route('admin.messages.index', $apartment->id)}}">Vedi i messaggi</a></button>
        </div>
      </div>
    </div>

  </div>
@endsection