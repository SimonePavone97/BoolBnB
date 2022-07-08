@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="container my-4">
      <h2 class="text-center py-3">Modifica i dettagli dell'appartamento</h2>
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
  
    <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data" class="d-flex flex-wrap">
  
      @method('PUT')
  
      @csrf
  
      <div class="form-group col-12 col-md-6">
        <label for="title">Titolo annuncio:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $apartment->title) }}" id="title" required>
      </div>
      
      <div class="form-group col-12 col-md-6">
        <label for="address">Indirizzo:</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $apartment->address) }}" id="address" required>
      </div>

      <div class="form-group col-6">
        <label for="rooms">Stanze:</label>
        <input type="number" name="rooms" min="0" class="form-control" value="{{ old('rooms', $apartment->rooms) }}" id="rooms" required>
      </div>

      <div class="form-group col-6">
        <label for="bathrooms">Bagni:</label>
        <input type="number" name="bathrooms" min="0" class="form-control" value="{{ old('bathrooms', $apartment->bathrooms) }}" id="bathrooms" required>
      </div>

      <div class="form-group col-6">
        <label for="beds">Letti:</label>
        <input type="number" name="beds" min="0" class="form-control" value="{{ old('beds', $apartment->beds) }}" id="beds" required>
      </div>

      <div class="form-group col-6">
        <label for="mq">Mq:</label>
        <input type="number" name="mq" min="0" class="form-control" value="{{ old('mq', $apartment->mq) }}" id="mq" required>
      </div>

      <div class="form-group col-12">
        <label for="description">Descrizione:</label>
        <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', $apartment->description) }}</textarea>
      </div>
  
      <div class="form-group col-6">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
      </div>
  
      <label for="services" class="col-12">Servizi:</label>
      <div class="form-group d-flex flex-wrap pl-3">
        @foreach ( $services as $service )
          <div class="form-check-form-check-inline col-6 col-md-4">
            <input class="form-check-input" type="checkbox" value="{{$service->id}}" id="service-{{$service->id}}" name="services[]"
            @if ( in_array($service->id, old('services', $apartment_services_id)) ) checked @endif>
            <label for="service-{{$service->id}}" class="form-check-label">{{ $service->name }}</label>
          </div>
        @endforeach
      </div>
  
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Aggiorna</button>
      </div>
    </form>
  </div>
@endsection