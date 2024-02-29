@extends('layouts')

@section('content')
<main class="my-5">
    <div class="container">
        <h2>Trip List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Start_date</th>
                    <th scope="col">City</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trips as $trip)
                <tr>
                    <th scope="row">{{ $trip->id }}</th>
                    <td>{{ $trip->trip->destination }}</td>
                    <td>{{ $trip->trip->start_date }}</td>
                    <td>{{ $trip->trip->city }}</td>
                    <td>{{ $trip->trip->price }}DH</td>
                    <td>
                        <form action="{{ route('tripuser.destroy', $trip->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
