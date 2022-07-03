@extends('layouts.app');

@section('content')
  <div class="container">

    <div class="card" style="width: 36rem;">
      <div class="card-body">
        <h5 class="card-title">{{ $apartment->title }}</h5>

        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top mt-2" alt="{{ $post->title }}">
        <p class="card-text">{{ $apartment->description }}</p>

        <!-- <span>Services:</span>
        @forelse($apartment->services as $service)
          <span  class="badge badge-pill">{{$service->name}}</span>
        @empty
          <h3>There are no reported services</h3>
        @endforelse -->

        <div>
          <button type="button" class="btn btn-primary my-2"><a class="text-white" href="{{route('admin.apartments.edit', $apartment->id)}}">Update</a></button>
          <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="delete-form" data-title="{{ $apartment->title }}">
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-primary">Delete</button>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection