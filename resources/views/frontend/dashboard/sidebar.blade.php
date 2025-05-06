@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
@endphp

<style>
   .sidebar-box {
      background: white;
      border-radius: 6px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
      height: 100%;
      padding-bottom: 1rem;
   }

   .sidebar-header {
      border-bottom: 1px solid #eee;
      padding: 1.5rem;
      text-align: center;
   }

   .user-photo {
      width: 90px;
      height: 90px;
      object-fit: cover;
      border-radius: 50%;
      margin-top: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }

   .user-name {
      margin-top: 1rem;
      margin-bottom: .25rem;
      font-size: 1.1rem;
      font-weight: 600;
   }

   .user-contact {
      font-size: 0.9rem;
      color: #555;
      margin: 0;
   }

   .nav-tabs-custom {
      list-style: none;
      padding: 1.5rem 1rem;
      margin: 0;
      min-height: 40vh;
   }

   .nav-tabs-custom .nav-item {
      margin-bottom: 0.5rem;
   }

   .nav-tabs-custom .nav-link {
      display: block;
      padding: 0.6rem 1rem;
      border-radius: 4px;
      color: #333;
      transition: background 0.2s;
   }

   .nav-tabs-custom .nav-link:hover {
      background-color: #f8f9fa;
   }

   .nav-tabs-custom .nav-link.active {
      background-color: #888888;
      color: white;
   }

   .nav-tabs-custom .nav-link i {
      margin-right: 8px;
   }
</style>

<div class="col-md-3">
   <div class="sidebar-box">
      <div class="sidebar-header">
         <img class="user-photo"
            src="{{ !empty($profileData->photo) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
            alt="Profile Photo">
         <div>
            <h6 class="user-name">{{ $profileData->name }}</h6>
            <p class="user-contact">{{ $profileData->phone }}</p>
            <p class="user-contact">{{ $profileData->email }}</p>
         </div>
      </div>
      <ul class="nav nav-tabs flex-column nav-tabs-custom" id="myTab" role="tablist">
         <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}"
               href="{{ route('dashboard') }}">
               <i class="icofont-user-alt-3"></i> Profile
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() === 'change.password' ? 'active' : '' }}"
               href="{{ route('change.password') }}">
               <i class="icofont-lock"></i> Change Password
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() === 'user.order.list' ? 'active' : '' }}"
               href="{{ route('user.order.list') }}">
               <i class="icofont-basket"></i> Orders
            </a>
         </li>

         <!-- <li class="nav-item">
            <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments">
               <i class="icofont-credit-card"></i> Payments
            </a>
         </li>

         <li class="nav-item">
            <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses">
               <i class="icofont-location-pin"></i> Addresses
            </a>
         </li> -->
      </ul>
   </div>
</div>