@extends('frontend.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<section class="section pt-5 pb-5 products-section">
   <div class="container">
      <div class="section-header text-center">
         <h2>Popular Brands</h2>
         <h2>Popular Restaurants</h2>
         <p>Top restaurants, cafes, pubs, and bars in Kathmandu, based on trends</p>
         <span class="line"></span>
      </div>
      <div class="row">
         
         @php
         // Paginate the clients with their average ratings, considering multiple reviews, and handle clients with no reviews
         $clientsWithRatings = App\Models\Client::select(
         'clients.id',
         'clients.name',
         'clients.email',
         'clients.photo',
         'clients.status',
         DB::raw('COALESCE(AVG(reviews.rating), 0) as average_rating') // COALESCE replaces NULL with 0 for clients with no reviews
         )
         ->leftJoin('reviews', 'clients.id', '=', 'reviews.client_id')
         ->where('clients.status', 1) // Ensure client is active
         ->where('reviews.status', 1) // Only include reviews with status 1
         ->groupBy('clients.id', 'clients.name', 'clients.email', 'clients.status', 'clients.photo') // Add all non-aggregated columns here
         ->orderByDesc('average_rating') // Order clients by their average rating (highest first)
         ->paginate(8); // Paginate the results, 8 per page
         @endphp

         @foreach ($clientsWithRatings as $client)

         @php
         $products = App\Models\Product::where('client_id',$client->id)->limit(3)->get();
         $menuNames = $products->map(function($product){
         return $product->menu->menu_name;
         })->toArray();
         $menuNamesString = implode(' . ',$menuNames);

         @endphp

         @php
         $userFavs = [];
         if(Auth::check()) {
         $userFavs = App\Models\Wishlist::where('user_id', Auth::id())->pluck('client_id')->toArray();
         }
         @endphp

         @php
         $reviewcount = App\Models\Review::where('client_id',$client->id)->where('status',1)->latest()->get();
         $avarage = App\Models\Review::where('client_id',$client->id)->where('status',1)->avg('rating');
         @endphp

         <div class="col-md-3">
            <div class="item pb-3">
               <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm" style="min-height: 360px;">
                  <div class="list-card-image">
                     <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i>{{ number_format($avarage,1) }} ({{ count($reviewcount ) }}+)</span></div>
                     <div class="favourite-heart position-absolute">
                        <a href="javascript:void(0);" class="wishlist-toggle" data-id="{{ $client->id }}">
                           <i class="icofont-heart {{ in_array($client->id, $userFavs) ? 'text-danger' : 'text-muted' }}"></i>
                        </a>
                     </div>
                     <a href="{{ route('res.details',$client->id) }}">
                        <img src="{{ !empty($client->photo) ? asset('upload/client_images/' . $client->photo) : asset('upload/no_image.jpg') }}" class="img-fluid item-img" style="min-height: 200px; width: 300px; height:200px;" alt="Profile Image">
                     </a>
                  </div>
                  <div class="p-3 position-relative">
                     <div class="list-card-body">
                        <h6 class="mb-1"><a href="{{ route('res.details',$client->id) }}" class="text-black">{{ $client->name }}</a></h6>
                        <p class="text-gray mb-3"> {{ $menuNamesString  }}</p>
                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 20–25 min</span> </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         {{-- // end col md-3 --}}

      </div>
      <div class="d-flex justify-content-center mt-4">
         {{-- Custom Styled Pagination links --}}
         <div>
            {{ $clientsWithRatings->links('pagination::bootstrap-4') }}
         </div>
      </div>
   </div>
</section>

@endsection