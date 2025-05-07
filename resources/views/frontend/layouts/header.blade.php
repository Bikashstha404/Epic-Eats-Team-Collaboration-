<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Custom Epic Navbar</title>

   <!-- Bootstrap CSS -->
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

   <style>
      /* === Epic Custom Navbar CSS === */
      .epics-navbar {
         background-color: white;
         border-bottom: 1px solid #eaeaea;
         padding: 5px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      }

      .epics-logo {
         width: 50px;
         height: auto;
         margin-left: 45px;
      }

      .navbar-nav .nav-item {
         margin-left: 15px;
         margin-right: 5px;
      }

      .navbar-nav .nav-link {
         color: #333;
         font-weight: 500;
         padding: 8px 15px;
         transition: color 0.3s ease;
      }

      .navbar-nav .nav-link:hover {
         color: #007bff;
      }

      .badge-warning {
         font-size: 10px;
         padding: 3px 6px;
         border-radius: 10px;
      }

      .dropdown-cart .badge-success {
         font-size: 12px;
         padding: 4px 8px;
         border-radius: 50px;
      }

      .dropdown-cart-top {
         min-width: 300px;
         background-color: #fff;
      }

      .dropdown-cart-top-header {
         display: flex;
         align-items: center;
         background: #f8f9fa;
         padding: 10px;
      }

      .dropdown-cart-top-header img {
         width: 50px;
         height: 50px;
         object-fit: cover;
         border-radius: 50%;
         margin-right: 10px;
      }

      .dropdown-cart-top-body {
         max-height: 200px;
         overflow-y: auto;
         padding: 10px;
      }

      .dropdown-cart-top-footer {
         background: #f1f1f1;
         padding: 10px;
      }

      .nav-epics-pic {
         width: 35px;
         height: 35px;
         object-fit: cover;
         border-radius: 50%;
         margin-right: 5px;
         vertical-align: middle;
      }

      .navbar-nav.ml-auto {
         margin-right: 20px;
      }
   </style>
</head>

<body>

   <!-- === Epic Navbar Start === -->
   <nav class="navbar navbar-expand-md navbar-light epics-navbar">
      <div class="container-fluid">
         <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('frontend/img/images/Logo.png') }}" alt="Logo" class="epics-logo">
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

               <li class="nav-item">
                  <a class="nav-link" href="{{ route('client.register') }}">
                     Become a Owner
                  </a>
               </li>

               @auth
               @php
               $id = Auth::user()->id;
               $profileData = App\Models\User::find($id);
               @endphp
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">
                     <img alt="User image"
                        src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                        class="nav-epics-pic"> My Account
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                     <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="icofont-user-alt-3 mr-2"></i> Profile</a>
                     <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="icofont-logout mr-2"></i> Logout </a>
                  </div>
               </li>
               @else
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}" role="button">Login</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}" role="button">Register</a>
               </li>
               @endauth

       

               @php
               $total = 0;
               $cart = session()->get('cart', []);
               $groupedCart = [];

               foreach ($cart as $item) {
               $groupedCart[$item['client_id']][] = $item;
               }

               $clients = App\Models\Client::whereIn('id', array_keys($groupedCart))->get()->keyBy('id');
               @endphp

               <li class="nav-item dropdown dropdown-cart">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">
                     <i class="fas fa-shopping-basket"></i> Cart
                     <span class="badge badge-success">{{ count((array) session('cart')) }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                     @foreach ($groupedCart as $clientId => $items)
                     @if (isset($clients[$clientId]))
                     @php
                     $client = $clients[$clientId];
                     @endphp
                     <div class="dropdown-cart-top-header">
                        <img src="{{ asset('upload/client_images/' . $client->photo) }}" alt="Client">
                        <div>
                           <h6 class="mb-0">{{ $client->name }}</h6>
                           <p class="text-secondary mb-0">{{ $client->address }}</p>
                        </div>
                     </div>
                     @endif
                     @endforeach

                     <div class="dropdown-cart-top-body border-top">
                        @php $total = 0 @endphp
                        @if (session('cart'))
                        @foreach (session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <p class="mb-2">
                           <i class="icofont-ui-press text-danger food-item"></i>
                           {{ $details['name'] }} x {{ $details['quantity'] }}
                           <span class="float-right text-secondary">${{ $details['price'] * $details['quantity'] }}</span>
                        </p>
                        @endforeach
                        @endif
                     </div>

                     <div class="dropdown-cart-top-footer border-top">
                        <p class="mb-0 font-weight-bold text-secondary">
                           Sub Total
                           <span class="float-right text-dark">
                              @if (Session::has('coupon'))
                              ${{ Session()->get('coupon')['discount_amount'] }}
                              @else
                              ${{ $total }}
                              @endif
                           </span>
                        </p>
                     </div>
                     <div class="dropdown-cart-top-footer border-top p-2">
                        <a class="btn btn-success btn-block btn-lg" href="{{ route('checkout') }}">Checkout</a>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   <!-- === Epic Navbar End === -->

   <!-- Bootstrap Scripts -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>