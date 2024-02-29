@extends('layouts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="{{ route('trip.create') }}" class="btn btn-success">Create Trip</a>
        <a href="{{ route('trips.export') }}" class="btn btn-info">export</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import Trips</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('trips.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="file">Choose Excel File</label>
                            <input type="file" name="file" class="form-control-file" id="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        <label for="status_filter">Filter by Status:</label>
        <select id="status_filter" class="form-select">
            <option value="">All</option>
            <option value="unavailable">Unavailable</option>
        </select>
    </div>
    <div>
        <div class="input-group">
            <input type="text" id="search_input" class="form-control" placeholder="Search by City or Destination">
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="trip_table" class="table" style="font-size: 12px;">
        <thead>
            <tr>
                <th style="padding: 0.5rem;">Destination</th>
                <th style="padding: 0.5rem;">Start D</th>
                <th style="padding: 0.5rem;">End D</th>
                <th style="padding: 0.5rem;">Max Parti</th>
                <th style="padding: 0.5rem;">Price</th>
                <th style="padding: 0.5rem;">Description</th>
                <th style="padding: 0.5rem;">City</th>
                <th style="padding: 0.5rem;">Status</th>
                <th style="padding: 0.5rem;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
            <tr>
                <td style="padding: 0.5rem;">{{ $trip->destination }}</td>
                <td style="padding: 0.5rem;">{{ $trip->start_date }}</td>
                <td style="padding: 0.5rem;">{{ $trip->end_date }}</td>
                <td style="padding: 0.5rem;">{{ $trip->max_participants }}</td>
                <td style="padding: 0.5rem;">{{ $trip->price }}</td>
                <td style="padding: 0.5rem;">{{ implode(' ', array_slice(explode(' ', $trip->description), 0, 1)) }}</td>
                <td style="padding: 0.5rem;">{{ $trip->city }}</td>
                <td style="padding: 0.5rem;"><span style="color: green;">{{ $trip->status }}</span></td>
                <td style="padding: 0.5rem;">
                    <div style="display: block; margin-bottom: 5px;">
                        <form action="{{ route('trip.destroy', $trip->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                    <div style="display: block; margin-bottom: 5px;">
                        <a href="{{ route('trip.show', $trip->id) }}" class="btn btn-primary btn-sm">Details</a>
                    </div>
                    <div style="display: block;">
                        <a href="{{ route('trip.edit', $trip->id) }}" class="btn btn-warning btn-sm">Update</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // JavaScript for handling filtering and searching
    document.addEventListener('DOMContentLoaded', function () {
        const statusFilter = document.getElementById('status_filter');
        const searchInput = document.getElementById('search_input');
        const tripTable = document.getElementById('trip_table').querySelector('tbody');

        // Filter trips by status
        statusFilter.addEventListener('change', function () {
            const selectedStatus = statusFilter.value;
            filterTrips(selectedStatus, searchInput.value.trim());
        });

        // Search trips by city or destination when typing
        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.trim();
            filterTrips(statusFilter.value, searchText);
        });

        // Function to filter trips based on status and search text
        function filterTrips(status, searchText) {
            const trips = document.querySelectorAll('#trip_table tbody tr');
            trips.forEach(trip => {
                const tripStatus = trip.querySelector('td:nth-child(8)').textContent.toLowerCase();
                const tripCity = trip.querySelector('td:nth-child(7)').textContent.toLowerCase();
                const tripDestination = trip.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const showTrip = (status === '' || tripStatus.includes(status)) &&
                    (searchText === '' ||
                        tripCity.includes(searchText.toLowerCase()) ||
                        tripDestination.includes(searchText.toLowerCase()));
                trip.style.display = showTrip ? 'table-row' : 'none';
            });
        }
    });
</script>
@endsection
