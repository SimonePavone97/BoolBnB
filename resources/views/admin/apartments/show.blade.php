@extends('layouts.app');

@section('content')
  <div class="container">

    <div class="card" style="width: 36rem;">
      <div class="card-body">
        <h5 class="card-title">{{ $apartment->title }}</h5>

        <img src="{{ asset('storage/' . $apartment->image) }}" class="card-img-top mt-2" alt="{{ $apartment->title }}">
        <p class="card-text">{{ $apartment->description }}</p>

        <div>
          <span class="card-text">Rooms: {{ $apartment->rooms }}</span>
          <span class="card-text">Bathrooms: {{ $apartment->bathrooms }}</span>
          <span class="card-text">Beds: {{ $apartment->beds }}</span>
          <span class="card-text">Mq: {{ $apartment->mq }}</span>
        </div>

        <span>Services:</span>
        <ul>
        @forelse($apartment->services as $service)
          <li>{{$service->name}}</li>
        @empty
          <li>There are no reported services</li>
        @endforelse
        </ul>

        <div>
          <button type="button" class="btn btn-primary my-2"><a class="text-white" href="{{route('admin.apartments.edit', $apartment->id)}}">Update</a></button>
          <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="delete-form" data-title="{{ $apartment->title }}">
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-primary">Delete</button>
          </form>
          <button type="button" class="btn btn-secondary my-2"><a class="text-white" href="{{route('admin.messages.show', $apartment->id)}}">View messages</a></button>
        </div>
      </div>
    </div>

  </div>
@endsection