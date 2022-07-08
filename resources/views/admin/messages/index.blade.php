@extends('layouts.app');

@section('content')

<div class="container">

    @if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif

    <h1 class="text-center m-3">Messages</h1>

    <div class="container">

        <table class="table">
            <thead style="background-color:#ff385c" class="text-white">
                <tr>
                    <th scope="col">Sender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Messaggio</th>
                    <th scope="col">Azione</th>
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
                            <button type="submit" class="btn btn-danger">Cancella</button>
                        </form>
                    </td>
                </tr>
            @empty
                <p class="text-center font-weight-bold text-danger">Non ci sono messaggi per questo appartamento</p>
            @endforelse
            </tbody>
        </table>

    </div>

    {{-- Bottone provvisorio, in attesa di fare la pagina apposta dove inserirlo nel frontend --}}
    <a href=" {{route('admin.messages.create')}} " class="btn btn-success mb-2">Invia un messaggio</a>  
    
<div>
@endsection