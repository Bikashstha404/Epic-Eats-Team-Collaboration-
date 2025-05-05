@extends('frontend.dashboard.dashboard')
@section('dashboard')

@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<!-- Custom CSS -->
<style>
    .password-wrapper {
        position: relative;
    }
    .password-wrapper input {
        padding-right: 2.5rem;
    }
    .password-wrapper .toggle-password {
        position: absolute;
        top: 50%;
        right: 0.75rem;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
    }
    .password-wrapper .toggle-password:hover {
        color: #000;
    }
</style>

<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            @include('frontend.dashboard.sidebar')

            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">
                    <h4 class="font-weight-bold mb-4">Change Password</h4>

                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf

                        <!-- Old Password -->
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <div class="password-wrapper">
                                <input type="password" class="form-control"
                                       name="old_password" id="old_password">
                                <i class="fa fa-eye toggle-password" toggle="#old_password"></i>
                            </div>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="password-wrapper">
                                <input type="password" class="form-control"
                                       name="new_password" id="new_password">
                                <i class="fa fa-eye toggle-password" toggle="#new_password"></i>
                            </div>
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <div class="password-wrapper">
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation">
                                <i class="fa fa-eye toggle-password" toggle="#new_password_confirmation"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger px-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JS for toggling eye icon -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-password").forEach(icon => {
            icon.addEventListener("click", function () {
                const input = document.querySelector(this.getAttribute("toggle"));
                if (input.type === "password") {
                    input.type = "text";
                    this.classList.remove("fa-eye");
                    this.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    this.classList.remove("fa-eye-slash");
                    this.classList.add("fa-eye");
                }
            });
        });
    });
</script>

@endsection
