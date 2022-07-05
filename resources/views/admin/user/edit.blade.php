@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="text-center">
      <h2>Modify details</h2>
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
  
    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
  
      @method('PUT')
  
      @csrf
  
      <div class="form-group col-6">
        <label for="first_name">Name:</label>
        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" id="first_name" required>
      </div>

      <div class="form-group col-6">
        <label for="last_name">Last name:</label>
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" id="last_name" required>
      </div>

      <div class="form-group col-6">
        <label for="birth_date">Birthday:</label>
        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $user->birth_date) }}" id="birth_date" required>
      </div>
  
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection