@extends('layouts.app');

@section('content')

<div class="container">

    @if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif

    <h1 class="text-center m-3">Messages</h1>

    <div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Text</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            @forelse ($messages as $message)
                <tr>
                    <td>{{ $message->sender }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->text }}</td>
                    <td>
                        <form action=" {{ route('admin.messages.destroy', $message->id) }} " method="POST" class="delete-form">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <p class="text-center font-weight-bold text-danger">No messages for this apartment</p>
            @endforelse
            </tbody>
        </table>

    </div>

    {{-- Bottone provvisorio, in attesa di fare la pagina apposta dove inserirlo nel frontend --}}
    <a href=" {{route('admin.messages.create')}} " class="btn btn-success mb-2">Create message</a>  
    
<div>
@endsection