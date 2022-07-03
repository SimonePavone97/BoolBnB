@extends('layouts.app')

@section('content')

  <div class="container">
    <h2 class="text-center">Create an apartment</h2>
  
    @if( $errors->any() )
      <div>
        <ul>
          @foreach ( $errors->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  
    <form action=" {{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
  
      <div class="form-group col-6">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title" required>
      </div>
      
      <div class="form-group col-6">
        <label for="description">Description:</label>
        <input type="text" name="description" class="form-control" id="description" required>
      </div>

      <div class="form-group col-6">
        <label for="rooms">Rooms:</label>
        <input type="number" name="rooms" min="0" class="form-control" id="rooms" required>
      </div>

      <div class="form-group col-6">
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" name="bathrooms" min="0" class="form-control" id="bathrooms" required>
      </div>

      <div class="form-group col-6">
        <label for="beds">Beds:</label>
        <input type="number" name="beds" min="0" class="form-control" id="beds" required>
      </div>

      <div class="form-group col-6">
        <label for="mq">Mq:</label>
        <input type="number" name="mq" min="0" class="form-control" id="mq" required>
      </div>

      <div class="form-group col-6">
        <label for="address">Address:</label>
        <input type="text" name="address" class="form-control" id="address" required>
      </div>
  
      <div class="form-group col-6">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
      </div>
  
      <div class="form-group">
        @foreach ( $services as $service )
          <div class="form-check-form-check-inline">
            <input class="form-check-input" type="checkbox" value="{{$service->id}}" id="service-{{$service->id}}" name="services[]">
            <label for="service-{{$service->id}}" class="form-check-label">{{ $service->name }}</label>
          </div>
        @endforeach
      </div>
  
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
@endsection