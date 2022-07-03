@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center m-3">Apartments</h1>

        <a href=" {{route('admin.apartments.create')}} " class="btn btn-success mb-2">Create apartment</a>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Rooms</th>
                    <th scope="col">Bathrooms</th>
                    <th scope="col">Beds</th>
                    <th scope="col">Mq</th>
                    <th scope="col">Address</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Description</th>
                    <th scope="col">Visibility</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($apartments as $apartment)
                <tr>
                    <td>{{ $apartment->id }}</td>
                    <td>{{ $apartment->title }}</td>
                    <td><img src="{{ $apartment->image }}" alt="Apartment Image" width="100"></td>
                    <td>{{ $apartment->rooms }}</td>
                    <td>{{ $apartment->bathrooms }}</td>
                    <td>{{ $apartment->beds }}</td>
                    <td>{{ $apartment->mq }}</td>
                    <td>{{ $apartment->address }}</td>
                    <td>{{ $apartment->latitude }}</td>
                    <td>{{ $apartment->longitude }}</td>
                    <td>{{ $apartment->description }}</td>
                    <td>{{ $apartment->visibility }}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Details</a>
                        <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a>
                        <a class="btn btn-success" href="{{ route('admin.sponsorship.index', $apartment->id) }}">Sponsor</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection