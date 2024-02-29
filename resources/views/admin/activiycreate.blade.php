@extends('layouts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Activity</div>

                    <div class="card-body">
                        <form method="POST" action="{{  route('activity.update',$Trip->id) }}">
                            @csrf
                       
                                @method('PUT')
                        
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{  old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required>{{  old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>

                            <button type="submit" class="btn btn-primary">  Create Activity</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
