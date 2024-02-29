@extends('layouts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">

  
    <div>
        <div class="input-group">
            <input type="text" id="search_input" class="form-control" placeholder="Search by Title or Description">
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="trip_table" class="table" style="font-size: 12px;">
        <thead>
            <tr>
                <th style="padding: 0.5rem;">Title</th>
                <th style="padding: 0.5rem;">ID_Trip</th>
                <th style="padding: 0.5rem;">Description</th>
                <th style="padding: 0.5rem;">Image</th>
                <th style="padding: 0.5rem;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td style="padding: 0.5rem;">{{ $activity->title }}</td>
                <td style="padding: 0.5rem;">{{ $activity->trip_id }}</td>
                <td style="padding: 0.5rem;">{{ $activity->description }}</td>
                <td style="padding: 0.5rem;"><img src="{{ $activity->image }}" alt="{{ $activity->title }}" style="max-width: 100px;"></td>
                <td style="padding: 0.5rem;">
                    <div style="display: block; margin-bottom: 5px;">
                        <form action="{{ route('activity.destroy', $activity->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
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
        const searchInput = document.getElementById('search_input');
        const tripTable = document.getElementById('trip_table').querySelector('tbody');

        // Search activities by title or description when typing
        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.trim().toLowerCase();
            filterActivities(searchText);
        });

        // Function to filter activities based on search text
        function filterActivities(searchText) {
            const activities = document.querySelectorAll('#trip_table tbody tr');
            activities.forEach(activity => {
                const title = activity.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const description = activity.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const showActivity = (searchText === '' ||
                        title.includes(searchText) ||
                        description.includes(searchText));
                activity.style.display = showActivity ? 'table-row' : 'none';
            });
        }
    });
</script>
@endsection
