@extends('frontend.dashboard.dashboard')
@section('dashboard')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


@php
$products = App\Models\Product::where('client_id',$client->id)->limit(3)->get();
$menuNames = $products->map(function($product){
return $product->menu->menu_name;
})->toArray();
$menuNamesString = implode(' . ',$menuNames);


@endphp

<section class="restaurant-detailed-banner">
   <div class="container">
      <div class="text-center">
         <img class="img-fluid w-100 cover"
            src="{{ !empty($client->cover_photo) ? asset('upload/client_images/' . $client->cover_photo) : asset('upload/no_image.jpg') }}"
            alt="Cover Photo"
            style="width: 100%; height: auto; min-height: 300px; max-height: 550px; object-fit: cover; object-position: center;">
      </div>
   </div>
   <div class="restaurant-detailed-header">
      <div class="container">
         <div class="row d-flex align-items-end">
            <div class="col-md-8">
               <div class="restaurant-detailed-header-left">
                  <img class="img-fluid mr-3 float-left rounded-circle border border-secondary" alt="Restaurant Logo" src="{{ !empty($client->photo) ? asset('upload/client_images/' . $client->photo) : asset('upload/no_image.jpg') }}" style="width: 100px; height: 100px; object-fit: cover;">

                  <h2 class="text-white">{{ $client->name }}</h2>
                  <p class="text-white mb-1"><i class="icofont-location-pin"></i>{{ $client->address }} <span class="badge badge-success">OPEN</span>
                  </p>
                  <p class="text-white mb-0"><i class="icofont-food-cart"></i> {{$menuNamesString}}
                  </p>
               </div>
            </div>
            <!-- <div class="col-md-4">
               <div class="restaurant-detailed-header-right text-right">
                  <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i> 25–35 min
                  </button>
                  <h6 class="text-white mb-0 restaurant-detailed-ratings"><span class="generator-bg rounded text-white"><i class="icofont-star"></i> 3.1</span> 23 Ratings <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6>
               </div>
            </div> -->
         </div>
      </div>
   </div>
   </div>
</section>
<section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <!-- <span class="restaurant-detailed-action-btn float-right">
               <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-heart text-danger"></i> Mark as Favourite</button>
               <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-cauli-flower text-success"></i> Pure Veg</button>
               <button class="btn btn-outline-danger btn-sm" type="button"><i class="icofont-sale-discount"></i> OFFERS</button>
            </span> -->
            <ul class="nav" id="pills-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Order Online</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">Restaurant Info</a>
               </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" id="pills-book-tab" data-toggle="pill" href="#pills-book" role="tab" aria-controls="pills-book" aria-selected="false">Book A Table</a>
               </li> -->
               <li class="nav-item">
                  <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Ratings & Reviews</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</section>
<section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
   <div class="container">

      <div class="row">
         <div class="col-md-8">
            <div class="offer-dedicated-body-left">
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                     @php
                     $populers = App\Models\Product::where('status',1)
                     ->where('client_id',$client->id)
                     ->where('most_populer',1)
                     ->orderBy('id','desc')
                     ->limit(5)
                     ->get();
                     @endphp

                     @if($populers->count() > 0)
                     <div class="position-relative">
                        <h5 class="mb-4 mt-3">Most Populars</h5>

                        <!-- Scrollable container with buttons on sides -->
                        <div class="position-relative">
                           <!-- Scrollable Flex Container -->
                           <div id="populerScroll" class="d-flex overflow-hidden" style="scroll-behavior: smooth;">
                              @foreach ($populers as $populer)
                              <div class="card shadow-sm me-3" style="min-width: 250px; flex-shrink: 0; border: 1px solid black">
                                 <img src="{{ asset($populer->image) }}"
                                    class="card-img-top"
                                    alt="{{ $populer->name }}"
                                    style="height: 125px; object-fit: cover; border-radius: 5px 5px 0 0;">

                                 <div class="card-body p-3">
                                    <h6 class="card-title text-start mb-1">{{ $populer->name }}</h6>

                                    <div class="text-start">
                                       @if (is_null($populer->price))
                                       <span class="text-muted">Price: Not available</span>
                                       @elseif (is_null($populer->discount_price))
                                       Price: ${{ $populer->price }}
                                       @else
                                       Price:
                                       <small class="text-muted"><del>${{ $populer->price }}</del></small>
                                       <strong class="text-success ms-1">${{ $populer->discount_price }}</strong>
                                       @endif
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                       <div>
                                          @if (is_null($populer->size))
                                          Size: -------
                                          @else
                                          Size: <span class="ms-1">{{ $populer->size }} cm</span>
                                          @endif
                                       </div>
                                       <a class="btn btn-outline-secondary btn-sm"
                                          href="{{ route('add_to_cart', $populer->id) }}">
                                          Add
                                       </a>
                                    </div>
                                 </div>
                              </div>

                              @endforeach
                              <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y"
                                 onclick="scrollPopulers(-1)"
                                 style="z-index: 2; box-shadow: 0 0 5px rgba(0,0,0,0.2); font-size:larger">
                                 ‹
                              </button>

                              <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y"
                                 onclick="scrollPopulers(1)"
                                 style="z-index: 2; box-shadow: 0 0 5px rgba(0,0,0,0.2); font-size:larger">
                                 ›
                              </button>
                           </div>
                        </div>
                     </div>

                     <!-- JavaScript -->
                     <script>
                        function scrollPopulers(direction) {
                           const container = document.getElementById('populerScroll');
                           const scrollAmount = 270;
                           container.scrollBy({
                              left: direction * scrollAmount,
                              behavior: 'smooth'
                           });
                        }
                     </script>
                     @endif


                     @php
                     $bestsellers = App\Models\Product::where('status', 1)
                     ->where('client_id', $client->id)
                     ->where('best_seller', 1)
                     ->orderBy('id', 'desc')
                     ->limit(5)
                     ->get();
                     @endphp

                     @if($bestsellers->count() > 0)
                     <div class="position-relative">
                        <h5 class="mb-4 mt-3">Best Sellers</h5>

                        <!-- Scrollable container with buttons on sides -->
                        <div class="position-relative">
                           <!-- Scrollable Flex Container -->
                           <div id="bestsellerScroll" class="d-flex overflow-hidden" style="scroll-behavior: smooth;">
                              @foreach ($bestsellers as $bestseller)
                              <div class="card shadow-sm me-3" style="min-width: 250px; flex-shrink: 0; border: 1px solid black">
                                 <img src="{{ asset($bestseller->image) }}"
                                    class="card-img-top"
                                    alt="{{ $bestseller->name }}"
                                    style="height: 125px; object-fit: cover; border-radius: 5px 5px 0 0;">

                                 <div class="card-body p-3">
                                    <h6 class="card-title text-start mb-1">{{ $bestseller->name }}</h6>

                                    <div class="text-start">
                                       @if (is_null($bestseller->price))
                                       <span class="text-muted">Price: Not available</span>
                                       @elseif (is_null($bestseller->discount_price))
                                       Price: ${{ $bestseller->price }}
                                       @else
                                       Price:
                                       <small class="text-muted"><del>${{ $bestseller->price }}</del></small>
                                       <strong class="text-success ms-1">${{ $bestseller->discount_price }}</strong>
                                       @endif
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                       <div>
                                          @if (is_null($bestseller->size))
                                          Size: -------
                                          @else
                                          Size: <span class="ms-1">{{ $bestseller->size }}cm</span>
                                          @endif
                                       </div>
                                       <a class="btn btn-outline-secondary btn-sm"
                                          href="{{ route('add_to_cart', $bestseller->id) }}">
                                          Add
                                       </a>
                                    </div>
                                 </div>
                              </div>

                              @endforeach

                              <!-- Left Scroll Button -->
                              <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y"
                                 onclick="scrollBestsellers(-1)"
                                 style="z-index: 2; box-shadow: 0 0 5px rgba(0,0,0,0.2); font-size:larger">
                                 ‹
                              </button>

                              <!-- Right Scroll Button -->
                              <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y"
                                 onclick="scrollBestsellers(1)"
                                 style="z-index: 2; box-shadow: 0 0 5px rgba(0,0,0,0.2); font-size:larger">
                                 ›
                              </button>
                           </div>
                        </div>
                     </div>

                     <script>
                        function scrollBestsellers(direction) {
                           const container = document.getElementById('bestsellerScroll');
                           const scrollAmount = 270;
                           container.scrollBy({
                              left: direction * scrollAmount,
                              behavior: 'smooth'
                           });
                        }
                     </script>
                     @endif


                     @foreach ($menus as $menu)
                     <div class="row">
                        <h5 class="mb-4 mt-3 col-md-12">{{ $menu->menu_name }} <small class="h6 text-black-50">{{ $menu->products->count() }} ITEMS</small></h5>
                        <div class="col-md-12">
                           <div class="bg-white rounded border shadow-sm mb-4">

                              @foreach ($menu->products as $product)
                              <div class="menu-list p-3 border-bottom">
                                 <a class="btn btn-outline-secondary btn-sm  float-right" href="{{ route('add_to_cart',$product->id)}}">ADD</a>

                                 <div class="media">
                                    <img class="mr-3 rounded-pill" src="{{ asset($product->image) }}" alt="Generic placeholder image">
                                    <div class="media-body">
                                       <h6 class="mb-1">{{ $product->name }}</h6>

                                       @if (is_null($product->price) && is_null($product->size))
                                       <p class="text-muted mb-0">Price: ---, Size: ---</p>
                                       @elseif (is_null($product->price))
                                       <p class="text-muted mb-0">Price: ---, Size: {{ $product->size }} cm</p>
                                       @elseif (is_null($product->size))
                                       <p class="text-muted mb-0">Price: ${{ $product->price }}, Size: ---</p>
                                       @else
                                       <p class="text-gray mb-0">Price: ${{ $product->price }}, Size: {{ $product->size }} cm</p>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                              @endforeach

                           </div>
                        </div>
                     </div>
                     @endforeach

                  </div>

                  <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                     <div id="gallery" class="bg-white rounded p-4 mb-4">
                        <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">

                           <div class="owl-carousel owl-theme homepage-ad">

                              @foreach ($gallerys as $index => $gallery)

                              <div class="item">
                                 <img class="img-fluid" src="{{ asset($gallery->gallery_img) }}" style="width: 100%; height: 70vh;">
                                 <div class="position-absolute restaurant-slider-pics bg-dark text-white">{{ $index + 1 }} of {{ $gallerys->count() }} Photos</div>
                              </div>
                              @endforeach

                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                     <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                        <!-- <div class="address-map float-right ml-5">
                           <div class="mapouter">
                              <div class="gmap_canvas"><iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                           </div>
                        </div> -->
                        <h4 class="mb-2">Restaurant Info</h4>
                        <p class="mb-3">{{ $client->address }}</p>
                        <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i> {{ $client->phone }}</p>
                        <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i> {{ $client->email }}</p>
                        <!-- <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i> {{ $client->city_id }}
                           <span class="badge badge-success"> OPEN NOW </span>
                        </p> -->
                        <!-- <hr class="clearfix"> -->
                        <!-- <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold" href="#">Venue Map</a></p> -->
                        <!-- <hr class="clearfix"> -->
                        <h5 class="mt-4 mb-4">More Info</h5>
                        <p class="mb-3">{{$client->shop_info}}</p>
                        <!-- <div class="border-btn-main mb-4">
                           <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                           <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                           <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                           <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                           <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                           <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                           <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                        </div> -->
                     </div>
                  </div>

                  <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                     <!-- <div id="ratings-and-reviews" class="bg-white rounded shadow-sm p-4 mb-4 clearfix restaurant-detailed-star-rating">
                        <span class="star-rating float-right">
                           <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                           <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                           <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                           <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                           <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                        </span>
                        <h5 class="mb-0 pt-1">Rate this Place</h5>
                     </div> -->

                     <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                        <h5 class="mb-2">Ratings and Reviews</h5>
                        <div class="graph-star-rating-header">
                           <div class="star-rating">
                              @for ($i = 1; $i <= 5; $i++)
                                 <i class="icofont-ui-rating {{ $i <= round($roundedAverageRating) ? 'active' : ''}}"></i>
                                 @endfor
                                 <span class="text-black ml-2">{{ $totalReviews }} reviews</span>
                           </div>
                           <p class="text-black mb-4 mt-2">Rated {{$roundedAverageRating}} out of 5</p>
                        </div>

                        <div class="graph-star-rating-body">

                           @foreach ($ratingCounts as $star => $count)
                           <div class="rating-list">
                              <div class="rating-list-left text-black">
                                 {{ $star }} Star
                              </div>
                              <div class="rating-list-center">
                                 <div class="progress">
                                    <div style="width: {{ $ratingPercentages[$star] }}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                       <span class="sr-only">{{ $ratingPercentages[$star] }}% Complete (danger)</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="rating-list-right text-black">{{ number_format($ratingPercentages[$star],2) }}%</div>
                           </div>
                           @endforeach

                        </div>


                        <!-- <div class="graph-star-rating-footer text-center mt-3 mb-3">
                           <button type="button" class="btn btn-outline-primary btn-sm">Rate and Review</button>
                        </div> -->
                     </div>



                     <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                        <!-- <a href="#" class="btn btn-outline-primary btn-sm float-right">Top Rated</a> -->
                        <h5 class="mb-1">All Ratings and Reviews</h5>
                        <style>
                           .icofont-ui-rating {
                              color: #ccc;
                           }

                           .icofont-ui-rating.active {
                              color: #dd646e;
                           }
                        </style>

                        @php
                        $reviews = App\Models\Review::where('client_id',$client->id)->where('status',1)->latest()->limit(5)->get();
                        @endphp

                        @foreach ($reviews as $index => $review)
                        <div class="reviews-members py-4 review-item {{ $index >= 3 ? 'd-none extra-review' : '' }}" style="border-bottom: 1px solid black;">
                           <!-- Review content -->
                           <div class="d-flex align-items-start">
                              <a href="#">
                                 <img alt="User image"
                                    src="{{ (!empty($review->user->photo)) ? url('upload/user_images/'.$review->user->photo) : url('upload/no_image.jpg') }}"
                                    class="rounded-circle me-3"
                                    style="width: 60px; height: 60px; object-fit: cover;">
                              </a>
                              <div class="flex-grow-1">
                                 <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                       <a class="text-dark fw-bold" href="#">{{ $review->user->name }}</a>
                                    </h6>
                                    <div class="star-rating">
                                       @php $rating = $review->rating ?? 0; @endphp
                                       @for ($i = 1; $i <= 5; $i++)
                                          <i class="icofont-ui-rating {{ $i <= $rating ? 'text-warning' : 'text-muted' }}"></i>
                                          @endfor
                                    </div>
                                 </div>
                                 <small class="text-muted">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</small>
                                 <div class="mt-1">
                                    <p class="mb-0">{{ $review->comment }}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach


                        <a id="toggle-reviews" class="text-center w-100 d-block mt-2 font-weight-bold" href="javascript:void(0);">
                           See All Reviews
                        </a>
                        <script>
                           document.addEventListener("DOMContentLoaded", function() {
                              const button = document.getElementById("toggle-reviews");
                              const extraReviews = document.querySelectorAll(".extra-review");
                              let expanded = false; // Track toggle state

                              button.addEventListener("click", function() {
                                 if (!expanded) {
                                    // Show all hidden reviews
                                    extraReviews.forEach(review => review.classList.remove("d-none"));
                                    button.textContent = "Hide Reviews";
                                 } else {
                                    // Hide reviews after the first 3
                                    extraReviews.forEach(review => review.classList.add("d-none"));
                                    button.textContent = "See All Reviews";
                                 }
                                 expanded = !expanded;
                              });
                           });
                        </script>

                     </div>


                     <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                        @guest
                        <p><b>For Add Resturant Review. You need to login first <a href="{{ route('login') }}"> Login Here </a> </b></p>
                        @else

                        <style>
                           .star-rating label {
                              display: inline-flex;
                              margin-right: 5px;
                              cursor: pointer;
                           }

                           .star-rating input[type="radio"] {
                              display: none;
                           }

                           .star-rating input[type="radio"]:checked+.star-icon {
                              color: #dd646e;
                           }
                        </style>

                        <h5 class="mb-2">Leave Comment</h5>
                        <p class="mb-2">Rate the Place</p>
                        <form method="post" action="{{ route('store.review') }}">
                           @csrf
                           <input type="hidden" name="client_id" value="{{ $client->id }}">
                           <div class="mb-2">
                              <span class="star-rating">
                                 <label for="rating-1">
                                    <input type="radio" name="rating" id="rating-1" value="1" hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>

                                 <label for="rating-2">
                                    <input type="radio" name="rating" id="rating-2" value="2" hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>
                                 <label for="rating-3">
                                    <input type="radio" name="rating" id="rating-3" value="3" hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>

                                 <label for="rating-4">
                                    <input type="radio" name="rating" id="rating-4" value="4" hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>
                                 <label for="rating-5">
                                    <input type="radio" name="rating" id="rating-5" value="5" hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>
                              </span>
                           </div>
                           <script>
                              document.addEventListener("DOMContentLoaded", function() {
                                 const stars = document.querySelectorAll(".star-rating input[type='radio']");
                                 const icons = document.querySelectorAll(".star-rating .star-icon");

                                 stars.forEach((star, index) => {
                                    star.addEventListener("change", () => {
                                       const rating = parseInt(star.value);

                                       icons.forEach((icon, i) => {
                                          if (i < rating) {
                                             icon.style.color = "#dd646e"; // active color
                                          } else {
                                             icon.style.color = "#ccc"; // default color
                                          }
                                       });
                                    });
                                 });
                              });
                           </script>
                           <div class="form-group">
                              <label>Your Comment</label>
                              <textarea class="form-control" name="comment" id="comment"></textarea>
                           </div>
                           <div class="form-group">
                              <button class="btn btn-primary btn-sm" type="submit"> Submit Comment </button>
                           </div>
                        </form>

                        @endguest
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
               <h5 class="mb-1 text-white">Your Order</h5>
               <p class="mb-4 text-white">{{ count((array) session('cart')) }} ITEMS</p>
               <div class="bg-white rounded shadow-sm mb-2">

                  @php $total = 0 @endphp
                  @if (session('cart'))
                  @foreach (session('cart') as $id => $details)
                  @php
                  $total += $details['price'] * $details['quantity']
                  @endphp

                  <div class="gold-members p-2 border-bottom">
                     <span class="count-number float-right">

                        <button class="btn btn-outline-secondary  btn-sm left dec" data-id="{{ $id }}"> <i class="icofont-minus"></i> </button>

                        <input class="count-number-input" type="text" value="{{  $details['quantity'] }}" readonly="">

                        <button class="btn btn-outline-secondary btn-sm right inc" data-id="{{ $id }}"> <i class="icofont-plus"></i> </button>

                        <button class="btn btn-outline-danger btn-sm right remove" data-id="{{ $id }}"> <i class="icofont-trash"></i> </button>
                     </span>
                     <p class="text-gray mb-0 float-right me-3">${{ $details['price'] * $details['quantity'] }}</p>
                     <div class="media">
                        <div class="mr-2"><img src="{{ asset($details['image']) }}" width="25px"></div>
                        <div class="media-body">
                           <p class="mt-1 mb-0 text-black">{{ $details['name'] }}</p>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @endif
               </div>
               <div class="mb-2 bg-white rounded p-2 clearfix">
                  <img class="img-fluid float-left" src="{{ asset('frontend/img/wallet-icon1.jpeg') }}" style="height: 40px; width: auto">
                  <h6 class="font-weight-bold text-right mb-1">Subtotal : <span class="text-danger">${{ $total }}</span></h6>
                  <p class="seven-color mb-1 text-right">Extra charges may apply</p>
               </div>
               <a href="{{ route('checkout') }}" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
            </div>

            <div class="text-center pt-2 mb-4">

            </div>
            <div class="text-center pt-2">

            </div>
         </div>
      </div>
   </div>
</section>

<script>
   $(document).ready(function() {
      const Toast = Swal.mixin({
         toast: true,
         position: 'top-end',
         showConfirmButton: false,
         timer: 1500,
         timerProgressBar: true,
         didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
         }
      });

      $('.inc').on('click', function() {
         var id = $(this).data('id');
         var input = $(this).closest('span').find('input');
         var newQuantity = parseInt(input.val()) + 1;
         updateQuantity(id, newQuantity);
      });

      $('.dec').on('click', function() {
         var id = $(this).data('id');
         var input = $(this).closest('span').find('input');
         var newQuantity = parseInt(input.val()) - 1;
         if (newQuantity >= 1) {
            updateQuantity(id, newQuantity);
         }
      });

      $('.remove').on('click', function() {
         var id = $(this).data('id');
         removeFromCart(id);
      });

      function updateQuantity(id, quantity) {
         $.ajax({
            url: '{{ route("cart.updateQuantity") }}',
            method: 'POST',
            data: {
               _token: '{{ csrf_token() }}',
               id: id,
               quantity: quantity
            },
            success: function(response) {
               Toast.fire({
                  icon: 'success',
                  title: 'Quantity Updated'
               }).then(() => {
                  location.reload();
               });
            }
         })
      }

      function removeFromCart(id) {
         $.ajax({
            url: '{{ route("cart.remove") }}',
            method: 'POST',
            data: {
               _token: '{{ csrf_token() }}',
               id: id
            },
            success: function(response) {
               Toast.fire({
                  icon: 'success',
                  title: 'Cart Remove Successfully'
               }).then(() => {
                  location.reload();
               });
            }
         });
      }



   })
</script>

@endsection