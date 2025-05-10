<?php
 
 namespace App\Http\Controllers\Frontend;
 
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Models\Client;
 
 use App\Models\Menu;
 use App\Models\Gallery;
 use Carbon\Carbon;
 use Illuminate\Support\Facades\Auth; 
 use App\Models\Wishlist;
 use App\Models\Review;
 
 
 class HomeController extends Controller
 {
     
   public function RestaurantDetails($id){
      $client = Client::find($id);
      $menus = Menu::where('client_id',$client->id)->get()->filter(function($menu){
        return $menu->products->isNotEmpty();
     });
     $gallerys = Gallery::where('client_id',$id)->get();
     

     $reviews = Review::where('client_id',$client->id)->where('status',1)->get();
      $totalReviews = $reviews->count();
      $ratingSum = $reviews->sum('rating');
      $averageRating = $totalReviews > 0 ? $ratingSum / $totalReviews : 0;
      $roundedAverageRating = round($averageRating, 1);
      
      $ratingCounts = [
         '5' => $reviews->where('rating',5)->count(),
         '4' => $reviews->where('rating',4)->count(),
         '3' => $reviews->where('rating',3)->count(),
         '2' => $reviews->where('rating',2)->count(),
         '1' => $reviews->where('rating',1)->count(),
      ];
      $ratingPercentages =  array_map(function ($count) use ($totalReviews){
         return $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
      },$ratingCounts);
 
      return view('frontend.details_page',compact('client','menus','gallerys','reviews','roundedAverageRating','totalReviews','ratingCounts','ratingPercentages'));
     }
     //End Method 

     public function AddWishList(Request $request, $id){
      if (Auth::check()) {
          $exists = Wishlist::where('user_id',Auth::id())->where('client_id',$id)->first();
          if (!$exists ) {
              Wishlist::insert([
                  'user_id'=> Auth::id(),
                  'client_id' => $id,
                  'created_at' => Carbon::now(),
              ]);
              return response()->json(['success' => 'Your Wishlist Addedd Successfully']);
          } else {
              return response()->json(['error' => 'This product has already on your wishlist']);
          } 
      }else{
          return response()->json(['error' => 'First Login Your Account']);
      }

  }
  //End Method

  public function AllWishlist(){
   $wishlist = Wishlist::where('user_id',Auth::id())->get();
   return view('frontend.dashboard.all_wishlist',compact('wishlist'));
}
//End Method


public function RemoveWishlist($id){
   Wishlist::find($id)->delete();

   $notification = array(
       'message' => 'Wishlist Deleted Successfully',
       'alert-type' => 'success'
   );

   return redirect()->back()->with($notification);
}
//End Method
 
 
 
public function SearchRestaurant(Request $request){
    $keyword = $request->search;

    $clients = Client::where('name', 'LIKE', '%' . $keyword . '%')
        ->where('status', 1)
        ->orderBy('name', 'asc')
        ->paginate(8);

    return view('frontend.search_restaurant', compact('clients', 'keyword'));
}

 
 
 public function AutoSearch(Request $request)
{
    $query = $request->term;

    $results = Client::where('name', 'LIKE', $query . '%')
        ->where('status', 1)
        ->orderBy('name', 'asc')
        ->limit(10)
        ->get(['id', 'name']);

    $suggestions = $results->map(function ($client) {
        return [
            'label' => $client->name,                       // what user sees
            'value' => route('res.details', $client->id)    // where user goes on click
        ];
    });

    return response()->json($suggestions);
}

 public function ToggleWishlist(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['status' => 'unauthenticated']);
    }

    $client_id = $request->client_id;
    $user_id = Auth::id();

    $existing = Wishlist::where('user_id', $user_id)->where('client_id', $client_id)->first();

    if ($existing) {
        $existing->delete();
        return response()->json(['status' => 'removed']);
    } else {
        Wishlist::create([
            'user_id' => $user_id,
            'client_id' => $client_id,
            'created_at' => now(),
        ]);
        return response()->json(['status' => 'added']);
    }
}


 } 
