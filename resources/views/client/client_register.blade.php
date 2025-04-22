<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Owner Registration - EpicEats</title>

  <!-- Google Fonts & Font Awesome -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

   <!-- Favicon Icon -->
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/img/images/Logo.png') }}">

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #ffe0cc, #ffd1b3);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .position-relative {
      position: relative;
    }

    .card {
      margin-left: 11vw;
      display: flex;
      width: 100%;
      max-width: 42vw;
      margin-right: 25px;
      height: auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .left {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 10px 30px;
      justify-content: center;
      overflow-y: hidden;
    }

    .logo-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 10px;
    }

    .logo {
      width: 90px;
    }

    .form-header {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-header h2 {
      color: #ff6b35;
      font-size: 30px;
      font-weight: 700;
      margin: 0;
      text-align: left;
    }

    .form-group {
      margin-bottom: 16px;
      position: relative;
    }

    .form-control {
      width: 100%;
      border: none;
      height: auto;
      max-height: 42px;
      border-radius: 14px;
      padding: 16px 18px;
      background-color: #fff8e1;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border: 2px solid orange;
      box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.15);
      background-color: #fff;
    }

    .eye-icon {
      position: absolute;
      top: 50%;
      right: 14px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #999;
      font-size: 18px;
    }

    .input-container {
      position: relative;
      width: 100%;
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


    .btn-submit {
      margin-top: 14px;
      padding: 10px;
      width: 100%;
      background: linear-gradient(to right, #ff6b35, #ff914d);
      border: none;
      color: white;
      font-size: 15px;
      font-weight: 600;
      border-radius: 25px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-submit:hover {
      background: linear-gradient(to right, #ff571c, #ff7c3a);
    }

    .login-text {
      margin-top: 16px;
      font-size: 14px;
      color: #444;
    }


    .right {
      display: flex;
      justify-content: center;
      background: none;
    }

    .right img {
      max-width: 70%;
      max-height: 70%;
      object-fit: contain;
    }

    @media screen and (max-width: 768px) {
      .card {
        flex-direction: column;
        max-width: 90vw;
        margin-right: 0;
      }

      .left {
        padding: 20px;
        margin-bottom: 20px;
      }

      .right {
        display: none;
      }

      .form-header h2 {
        font-size: 24px;
      }

      .logo {
        width: 70px;
      }

      .btn-submit {
        font-size: 14px;
      }
    }

    @media screen and (max-width: 480px) {
      .form-header h2 {
        font-size: 22px;
      }

      .form-control {
        padding: 12px 15px;
        font-size: 14px;
      }

      .btn-submit {
        padding: 8px;
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <div class="card">
    <!-- Left: Form -->
    <div class="left">
      <div class="logo-header">
        <img src="{{ asset('frontend/img/images/Logo.png') }}" alt="EpicEats Logo" class="logo">
        <div class="form-header">
          <h2>Owner Registration</h2>
          <h4>Welcome!</h4>
        </div>
      </div>
      <form method="POST" action="{{ route('client.register.submit') }}">
        @csrf

        <div class="form-group">
          <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{ old('restaurant_name') }}" placeholder="Enter restaurant name">
          @error('restaurant_name')
          <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
          @error('phone')
          <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}">
          @error('address')
          <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}">
          @error('email')
          <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group position-relative">
          <div class="input-container">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            <span class="eye-icon"><i class="fas fa-eye" id="togglePassword"></i></span>
          </div>
          @error('password')
          <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group position-relative">
          <div class="input-container">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
            <span class="eye-icon"><i class="fas fa-eye" id="toggleConfirmPassword"></i></span>
          </div>
          @error('password_confirmation')
          <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn-submit">Sign Up</button>
        <p class="login-text">Already have an account? <a href="{{ route('client.login') }}">Login</a></p>
      </form>
    </div>
  </div>
  <div class="right">
    <img src="{{ asset('frontend/img/images/ClientRegister.png') }}" alt="User Illustration">
  </div>
  <script>
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    togglePassword.addEventListener("click", function() {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });

    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
    const confirmPasswordInput = document.getElementById("password_confirmation");

    toggleConfirmPassword.addEventListener("click", function() {
      const type = confirmPasswordInput.getAttribute("type") === "password" ? "text" : "password";
      confirmPasswordInput.setAttribute("type", type);
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  </script>
</body>

</html>