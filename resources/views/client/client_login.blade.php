<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title>User Login - Online Food Ordering</title>

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
      <!-- Bootstrap core CSS -->
      <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Font Awesome for icons -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

      <style>
         body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #fff;
         }
         .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-wrap: wrap;
         }
         .login-box {
            margin-bottom: 10px;
            width: 400px;
            text-align: center;
            margin-top: 80px;
         }
         .login-heading {
            margin-top: 5px;
            font-weight: 700;
            color: #FF6B35;
         }
         .sub-text {
            margin-bottom: 5px;
            color: #FF6B35;
            font-size: 16px;
         }
         .form-group {
            margin-top: 30px;
            text-align: left;
         }
         .form-control {
            border: 2px solid #FF6B35;
            border-radius: 8px;
            padding: 10px;
         }
         .form-control.error {
            border-color: #FF3E3E;
            background-color: #fff6f6;
         }
         .form-control.input-with-icon {
            padding-right: 45px !important;
         }
         .error-message {
            color: #FF3E3E;
            font-size: 14px;
            margin-top: 5px;
            display: flex;
            align-items: center;
         }
         .error-message i {
            margin-right: 5px;
         }
         .btn-signin {
            background-color: #FF6B35;
            color: white;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            border: none;
            margin-top: 20px;
         }
         .btn-signin:hover {
            background-color: #e65a2d;
         }
         .forgot-password {
            font-size: 15px;
            color: #555;
            display: block;
            margin-top: 10px;
         }
         .image-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
         }
         .image-container img {
            max-width: 100%;
         }
         .signup-text {
            margin-top: 20px;
         }
         .signup-text a {
            color: #FF6B35;
            font-weight: 600;
         }
         .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            cursor: pointer;
            font-size: 18px;
            z-index: 5;
            height: 100%;
            display: flex;
            align-items: center;
         }
         .eye-icon:hover {
            color: #FF6B35;
         }
      </style>
   </head>
   <body>
      <div class="container-fluid login-container">
         <div class="row w-100">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
               <div class="login-box">
                  <img src="{{ asset('frontend/img/logo.png')}}" alt="Logo" width="150">
                  <p class="sub-text">A Flavor Race, in One Place!</p>
                  <h3 class="login-heading">Welcome Owner!</h3>
                  
                  <form method="POST" action="{{ route('client.login_submit') }}">
                     @csrf

                     <!-- Email Field -->
                     <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') error @enderror" placeholder="Email">
                        @error('email')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                     </div>

                     <!-- Password Field -->
                     <div class="form-group position-relative">
                        <input type="password" name="password" id="password" class="form-control input-with-icon @error('password') error @enderror" placeholder="Password">
                        <span class="eye-icon"><i class="fas fa-eye" id="togglePassword"></i></span>
                        @error('password')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                     </div>

                     <a href="#" class="forgot-password">Forgot Password?</a>
                     <button type="submit" class="btn btn-signin">Sign In</button>
                     <p class="signup-text">Don’t have an account? <a href="{{ route('register') }}">Sign UP</a></p>
                  </form>
               </div>
            </div>
            <div class="col-md-6 image-container">
               <img src="{{ asset('frontend/img/login-illustration.png')}}" alt="Login Illustration">
            </div>
         </div>
      </div>

      <!-- jQuery -->
      <script src="{{ asset('frontend/vendor/jquery/jquery-3.3.1.slim.min.js')}}"></script>
      <!-- Bootstrap core JavaScript -->
      <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

      <!-- Toggle password visibility -->
      <script>
         const togglePassword = document.querySelector("#togglePassword");
         const password = document.querySelector("#password");

         togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
         });
      </script>
   </body>
</html>
