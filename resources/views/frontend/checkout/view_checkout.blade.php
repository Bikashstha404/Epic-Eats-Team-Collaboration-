@extends('frontend.dashboard.dashboard')
@section('dashboard')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
   .btn-gradient {
      background: linear-gradient(to right, #ffa45b, #ff864b);
      color: #fff;
      border-radius: 4px;
      text-align: center;
      font-size: 16px;
      border: none;
      display: inline-block;
      cursor: pointer;
   }

   .btn-gradient:hover {
      background: linear-gradient(to right, #ff9c4b, #ff6f3c);
      color: #fff;
   }

   .nav-pills .nav-link.custom-selected {
      background-color: #198754 !important;
      color: #fff !important;
   }
</style>

<section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="offer-dedicated-body-left">

               @php
               $id = Auth::user()->id;
               $profileData = App\Models\User::find($id);
               @endphp


               <div class="pt-2"></div>
               <div class="bg-white rounded shadow-sm p-4 mb-4">
                  <h4 class="mb-1">Choose a delivery address</h4>
                  <h6 class="mb-3 text-black-50">Multiple addresses in this location</h6>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="bg-white card addresses-item mb-4 border border-black">
                           <div class="gold-members p-4">
                              <div class="media">
                                 <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                 <div class="media-body">
                                    <h5 class="mb-1 text-black">Home</h5>
                                    <p class="text-black" style="font-size: 16px;">
                                       {{ $profileData->address }}
                                    </p>
                                    <!-- Home Address Button -->
                                    <a class="btn-gradient btn-sm btn-success mr-2 mt-2 select-address" data-address="{{ $profileData->address }}">DELIVER HERE</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="bg-white card addresses-item mb-4 border-black">
                           <div class="gold-members p-4">
                              <div class="media">
                                 <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                 <div class="media-body">
                                    <h5 class="text-black">Away</h5>
                                    <input type="text" id="customAddress" placeholder="Enter your location address" style="padding:2px; width: 18vw; border-radius: 5px">
                                    <a class="btn-gradient btn-sm btn-s mr-2 mt-3 select-custom-address">DELIVER HERE</a>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="pt-2"></div>
               <div class="bg-white rounded shadow-sm p-4 osahan-payment">
                  <h4 class="mb-4">Choose payment method</h4>
                  <!-- <h6 class="mb-3 text-black-50">Credit/Debit Cards</h6> -->
                  <div class="row">
                     <div class="col-sm-4 pr-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                           <a class="nav-link active" id="v-pills-cash-tab" data-toggle="pill" href="#v-pills-cash" role="tab" aria-controls="v-pills-cash" aria-selected="false"><i class="icofont-money"></i> Pay on Delivery</a>

                           <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="icofont-credit-card"></i> Credit/Debit Cards</a>
                        </div>
                     </div>
                     <div class="col-sm-8 pl-0">
                        <div class="tab-content ml-4 h-30" id="v-pills-tabContent" style="border: 1px solid black; border-radius:10px">

                           <div class="tab-pane fade show active" id="v-pills-cash" role="tabpanel" aria-labelledby="v-pills-cash-tab">
                              <h6 class="mb-1 mt-0">Cash</h6>
                              <p>Please keep exact change handy to help us serve you better</p>
                           </div>

                           <!-- <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                              <h6 class="mb-3 mt-0">Add new card</h6>
                              <p>WE ACCEPT <span class="osahan-card">
                                    <i class="icofont-visa-alt"></i> <i class="icofont-mastercard-alt"></i> <i class="icofont-american-express-alt"></i> <i class="icofont-payoneer-alt"></i> <i class="icofont-apple-pay-alt"></i> <i class="icofont-bank-transfer-alt"></i> <i class="icofont-discover-alt"></i> <i class="icofont-jcb-alt"></i>
                                 </span>
                              </p>
                           </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         @php
         $id = Auth::user()->id;
         $profileData = App\Models\User::find($id);
         @endphp

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
               <form action="{{ route('cash_order') }}" method="POST">
                  @csrf
                  <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                  <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                  <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                  <!-- <input type="hidden" name="address" value="{{ Auth::user()->address }}"> -->
                  <input type="hidden" name="address" id="selectedAddress">
                  <button type="submit" class="btn btn-success btn-block btn-lg">
                     PAY ${{ $total }}
                     <i class="icofont-long-arrow-right"></i>
                  </button>
               </form>
            </div>
            <div class="pt-2"></div>
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

   let selectedAddress = ''; // track selected address

   // When "Home" address is selected
   $('.select-address').on('click', function(e) {
      e.preventDefault();
      selectedAddress = $(this).data('address');
      $('#selectedAddress').val(selectedAddress);

      Swal.fire({
         icon: 'success',
         title: 'Home address selected',
         timer: 1200,
         showConfirmButton: false
      });
   });

   // When custom address is selected
   $('.select-custom-address').on('click', function(e) {
      e.preventDefault();
      let inputAddress = $('#customAddress').val().trim();

      if (!inputAddress) {
         Swal.fire({
            icon: 'error',
            title: 'Address required!',
            text: 'Please enter a valid address before proceeding.'
         });
         return;
      }

      selectedAddress = inputAddress;
      $('#selectedAddress').val(selectedAddress);

      Swal.fire({
         icon: 'success',
         title: 'Custom address selected',
         timer: 1200,
         showConfirmButton: false
      });
   });

   // Prevent form submission if no address selected
   $('#orderForm').on('submit', function(e) {
      if (!selectedAddress) {
         e.preventDefault();
         Swal.fire({
            icon: 'error',
            title: 'No delivery address selected!',
            text: 'Please choose where you want the order delivered.'
         });
      }
   });
</script>

<script>
   $(document).ready(function () {
      // Restore selection from localStorage
      const selectedTabId = localStorage.getItem('selectedPaymentTab');

      if (selectedTabId) {
         $('.nav-pills .nav-link').removeClass('active custom-selected');
         $('.tab-pane').removeClass('show active');

         const $tab = $('#' + selectedTabId);
         $tab.addClass('active custom-selected');
         const target = $tab.attr('href');
         $(target).addClass('show active');
      }

      // On user click, store selection
      $('.nav-pills .nav-link').on('click', function () {
         $('.nav-pills .nav-link').removeClass('custom-selected');
         $(this).addClass('custom-selected');
         localStorage.setItem('selectedPaymentTab', $(this).attr('id'));
      });
   });
</script>

@endsection