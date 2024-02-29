@extends('layouts')

@section('content')
<!-- Main layout -->
<main class="my-5">
    <div class="container">
        <!-- Trip details section -->
        <section class="border-bottom pb-4 mb-5">
            <div class="row gx-5">
                <div class="col-md-6 mb-4">
                 <!-- Featured image -->
                 <div id="carouselExampleIndicators_{{ $trip->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide-to="0" class="active"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide-to="1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators_{{ $trip->id }}" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset($trip->image_1)}}" class="d-block w-100" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset($trip->image_2)}}" class="d-block w-100" alt="Third slide">
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

                </div>

                <div class="col-md-6 mb-4">
                    <!-- Trip title and details -->
                    <h4><strong>{{ $trip->destination }}</strong></h4>
                    <p class="text-muted">
                        Start Date: {{ $trip->start_date }} <br>
                        End Date: {{ $trip->end_date }} <br>
                        Max Participants: {{ $trip->max_participants }} <br>
                        Price: ${{ $trip->price }} <br>
                        City: {{ $trip->city }}
                    </p>
                    <p class="text-muted">{{ $trip->description }}</p>
                    <form action="{{ route('tripusers.book',Auth::user()->id) }}" method="POST">
                      @csrf
                      <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                      <button type="submit" class="btn btn-success">Book Trip</button>
                  </form>
                </div>
            </div>
        </section>
        <!-- End trip details section -->
        <section>
            <hr />
            <h1 class="text-center">ACTIVIES</h1>
            <hr />
            <div class="row gx-5">
                @foreach($trip->activities as $activity)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <!-- Image -->
                        
                        <div class="card-body">
                            <!-- Title -->
                            <h5 class="card-title">{{ $activity->title }}</h5>
                            <!-- Description -->
                            <p class="card-text">{{ $activity->description }}</p>
                        </div>
                      
                    </div>
                </div>
                @endforeach
            </div>
            
        </section>
    </div>
    <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
        <hr />
        <h1 class="text-center">REVIEW</h1>

        <hr />
        <h1>Add Review</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="" method="POST" class="d-flex">
            @csrf
            
            <div>
                <label for="review">Review:</label><br>
                <textarea name="review" id="review" cols="100" rows="2"></textarea>
            </div>
            <div>
                <label for="rating">Rating:</label><br>
                <input type="number" name="rating" id="rating" min="1" max="5">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/> 
        @if(!$trip->reviews->isEmpty())
        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
            <hr />
            <h1 class="text-center">REVIEWS</h1>
            <hr />
            <!-- Reviews Carousel -->
            <div class="carousel-inner">
                @foreach($trip->reviews as $key => $review)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="review-card">
                                    <div class="reviewer-info">
                                        <div class="reviewer-name">{{ $review->user->name }}</div>
                                        <div class="rating">Rating: {{ $review->rating }}</div>
                                    </div>
                                    <div class="review-text">{{ $review->review_text }}</div>
                                    <div class="reviewer-photo text-center">
                                        <img src="{{ asset($review->user->profile_picture) }}" class="img-fluid rounded-circle" alt="User Photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Review Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
      
</main>
<!-- End main layout -->
 <!-- Bootstrap Bundle with Popper -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

 <style>
     .carousel-item img {
         width: 100%;
         height: 300px; /* Adjust this value to your desired height */
         object-fit: cover; /* Ensures the image covers the entire carousel item */
     }
     .review-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .review-card .reviewer-name {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .review-card .review-text {
      font-style: italic;
    }
    .review-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f9f9f9; /* Add background color */
}

.review-card .reviewer-info {
    margin-bottom: 15px;
}

.review-card .reviewer-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.review-card .rating {
    color: #ffc107; /* Adjust color as needed */
}

.review-card .review-text {
    font-style: italic;
}

.reviewer-photo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    cursor: pointer;
}

 </style>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endsection


{{-- <section class="border-bottom pb-4 mb-5">
    <h2>Reviews and Activities</h2>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Reviews -->
            @foreach($trip->reviews as $review)
            <div class="swiper-slide">
                <h3>Review</h3>
                <p>{{ $review->review_text }}</p>
            </div>
            @endforeach

            <!-- Activities -->
            @foreach($trip->activities as $activity)
            <div class="swiper-slide">
                <h3>Activity: {{ $activity->title }}</h3>
                <p>{{ $activity->description }}</p>
                <img src="{{ asset($activity->image) }}" alt="{{ $activity->title }}" class="img-fluid">
            </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section> --}}