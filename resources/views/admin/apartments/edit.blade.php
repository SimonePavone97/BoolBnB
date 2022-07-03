@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="text-center">
      <h2>Modify the apartment's details</h2>
    </div>
  
    @if( $errors->any() )
      <div>
        <ul>
          @foreach ( $errors->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  
    <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
  
      @method('PUT')
  
      @csrf
  
      <div class="form-group col-6">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $apartment->title) }}" id="title" required>
      </div>
      
      <div class="form-group col-6">
        <label for="description">Description:</label>
        <input type="text" name="description" class="form-control" value="{{ old('description', $apartment->description) }}" id="description" required>
      </div>

      <div class="form-group col-6">
        <label for="rooms">Rooms:</label>
        <input type="number" name="rooms" min="0" class="form-control" value="{{ old('rooms', $apartment->rooms) }}" id="rooms" required>
      </div>

      <div class="form-group col-6">
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" name="bathrooms" min="0" class="form-control" value="{{ old('bathrooms', $apartment->bathrooms) }}" id="bathrooms" required>
      </div>

      <div class="form-group col-6">
        <label for="beds">Beds:</label>
        <input type="number" name="beds" min="0" class="form-control" value="{{ old('beds', $apartment->beds) }}" id="beds" required>
      </div>

      <div class="form-group col-6">
        <label for="mq">Mq:</label>
        <input type="number" name="mq" min="0" class="form-control" value="{{ old('mq', $apartment->mq) }}" id="mq" required>
      </div>

      <div class="form-group col-6">
        <label for="address">Address:</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $apartment->address) }}" id="address" required>
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
            @if ( in_array($service->id, old('services', [$apartment_services_id])) ) checked @endif
          </div>
        @endforeach
      </div>
  
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection