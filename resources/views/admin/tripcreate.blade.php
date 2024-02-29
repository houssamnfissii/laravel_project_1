@extends('layouts')

@section('content')
<div class="container">
    <h1 class="mb-4">
        <a href="{{ route('trip.index') }}">Back</a>
        Create Trip
    </h1>
    <form method="POST" action="{{ route('trip.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 row">
            <label for="destination" class="col-md-2 col-form-label text-md-end">Destination:</label>
            <div class="col-md-4">
                <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" value="{{ old('destination') }}" >
                @error('destination')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="start_date" class="col-md-2 col-form-label text-md-end">Start Date:</label>
            <div class="col-md-4">
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" >
                @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Add select input for status -->
        <div class="mb-3 row">
            <label for="status" class="col-md-2 col-form-label text-md-end">Status:</label>
            <div class="col-md-4">
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" >
                    <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="end_date" class="col-md-2 col-form-label text-md-end">End Date:</label>
            <div class="col-md-4">
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" >
                @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="max_participants" class="col-md-2 col-form-label text-md-end">Max Participants:</label>
            <div class="col-md-4">
                <input type="number" class="form-control @error('max_participants') is-invalid @enderror" id="max_participants" name="max_participants" value="{{ old('max_participants') }}" >
                @error('max_participants')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-4 row">
            <label for="price" class="col-md-2 col-form-label text-md-end">Price:</label>
            <div class="col-md-4">
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" >
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="city" class="col-md-2 col-form-label text-md-end">City:</label>
            <div class="col-md-4">
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" >
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="description" class="col-md-2 col-form-label text-md-end">Description:</label>
            <div class="col-md-10">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" >{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="image_1" class="col-md-2 col-form-label text-md-end">Image 1:</label>
            <div class="col-md-4">
                <input type="file" class="form-control @error('image_1') is-invalid @enderror" id="image_1" name="image_1">
                @error('image_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="image_2" class="col-md-2 col-form-label text-md-end">Image 2:</label>
            <div class="col-md-4">
                <input type="file" class="form-control @error('image_2') is-invalid @enderror" id="image_2" name="image_2">
                @error('image_2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="image_3" class="col-md-2 col-form-label text-md-end">Image 3:</label>
            <div class="col-md-4">
                <input type="file" class="form-control @error('image_3') is-invalid @enderror" id="image_3" name="image_3">
                @error('image_3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mb-3 row">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Create Trip</button>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
