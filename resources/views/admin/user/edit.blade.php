@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="container my-4">
      <h2 class="text-center py-3">Modifica i dati</h2>
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
  
    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data" class="d-flex flex-wrap">
  
      @method('PUT')
  
      @csrf
  
      <div class="form-group col-12 col-md-6">
        <label for="first_name">Nome:</label>
        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" id="first_name" required>
      </div>

      <div class="form-group col-12 col-md-6">
        <label for="last_name">Cognome:</label>
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" id="last_name" required>
      </div>

      <div class="form-group col-12 col-md-6">
        <label for="birth_date">Compleanno:</label>
        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $user->birth_date) }}" id="birth_date" required>
      </div>

      <div class="form-group col-12 col-md-6">
        <label for="email">Email:</label>
        <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}" id="email" required>
      </div>
  
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Aggiorna</button>
      </div>
    </form>
  </div>
@endsection