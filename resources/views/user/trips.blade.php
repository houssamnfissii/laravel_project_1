@extends('layouts')

@section('content')
    <!--Main layout-->
    <main class="my-5">
        <div class="container">
            <!--Section: Content-->
            <section>
                <div class="row gx-5">
                    @foreach($trips as $trip)
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <!-- Trip card -->
                            <div>
                                <!-- Featured image -->
                                <div id="carouselExampleIndicators_{{ $trip->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                      <button type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide-to="0" class="active"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide-to="1"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide-to="2"></button>
                                    </div>
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <img src="{{ asset($trip->image_1)}}" class="d-block w-100" alt="First slide">
                                      </div>
                                      <div class="carousel-item">
                                        <img src="{{ asset($trip->image_2)}}" class="d-block w-100" alt="Second slide">
                                      </div>
                                      <div class="carousel-item">
                                        <img src="{{ asset($trip->image_3)}}" class="d-block w-100" alt="Third slide">
                                      </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="visually-hidden">Next</span>
                                    </button>
                                  </div>

                                <!-- Trip data -->
                                <div class="row mb-3">
                                    <div class="col-6">
                                            {{ $trip->destination }}
                             
                                    </div>
                                    <div class="col-6 text-end">
                                        <span  style="color: white;background-color:crimson; border-radius: 30%;padding: 5px;">{{ $trip->price }}DH</span>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted">{{ $trip->description }}</small>
                                    </div>
                                </div>

                         

                                <hr />
                                <a href="{{ route('show.tripuser', $trip->id) }}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <!--Section: Content-->
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        .carousel-item img {
            width: 100%;
            height: 200px; /* Adjust this value to your desired height */
            object-fit: cover; /* Ensures the image covers the entire carousel item */
            padding: 5px;
           
        }
    </style>
@endsection
