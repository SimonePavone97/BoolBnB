@extends('layouts.app')

@section('content')

@section('content')
<div class="container">
    <form action=" {{ route('admin.messages.store') }} " method="POST">
        @csrf

        <div class="form-group">
            <label for="sender">Sender</label>
            <input type="text" class="form-control" id="sender" name="sender" placeholder="Inser your name here" required>
        </div>

        <div class="form-group">
            <label for="text">Text</label>
            <textarea name="text" id="text" cols="30" rows="10" placeholder="Insert your text here" required></textarea>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>

        <button type="submit" class="btn btn-primary">Invia messaggio</button>
    </form>
</div>
@endsection

