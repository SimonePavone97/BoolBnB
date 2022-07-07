@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="width: 36rem;">
        <div class="card-body">

            <div>
                <span class="card-text">Name: {{ $user->first_name }}</span>
            </div>
            <div>
                <span class="card-text">Last name: {{ $user->last_name }}</span>
            </div>
            <div>
                <span class="card-text">Email: {{ $user->email }}</span>
            </div>
            <div>
                <span class="card-text">Birthday: {{ $user->birth_date }}</span>
            </div>

            <div>
                <button type="button" class="btn btn-primary my-2"><a class="text-white" href="{{route('admin.user.edit', $user->id)}}">Edit</a></button>
            </div>
        </div>
    </div>
</div>
@endsection