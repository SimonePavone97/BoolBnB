@extends('layouts.app');

@section('content')

<div class="container">

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
                <p>No messages</p>
            @endforelse
            </tbody>
        </table>

    </div>

    <a href=" {{route('admin.messages.create')}} " class="btn btn-success mb-2">Create message</a>
    
<div>