<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | EpicEats</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ffecd2, #fcb69f);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .login-container {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }
    .login-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 50px 40px;
      border-radius: 24px;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      text-align: center;
      position: relative;
      animation: slideIn 1s ease-out;
    }
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .login-box img {
      width: 100px;
      margin-bottom: 15px;
    }
    .sub-text {
      color: #FF6B35;
      font-size: 16px;
      margin-bottom: 8px;
    }
    .login-heading {
      font-size: 30px;
      font-weight: 700;
      color: #1f1f1f;
      margin-bottom: 35px;
    }
    .form-group {
      margin-bottom: 22px;
      text-align: left;
    }
    .form-control {
      border: none;
      border-radius: 14px;
      padding: 14px 18px;
      background-color: #fff8e1;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border: 2px solid #FF6B35;
      box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.15);
      background-color: #fff;
    }
    .btn-signin {
      background: linear-gradient(135deg, #FF6B35, #ff884d);
      color: #fff;
      font-weight: 600;
      padding: 14px;
      border: none;
      border-radius: 50px;
      width: 100%;
      transition: all 0.3s ease;
      font-size: 17px;
      margin-top: 28px;
      margin-bottom: 14px;
    }
    .btn-signin:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(255, 107, 53, 0.3);
    }
    .forgot-password {
      display: block;
      text-align: center;
      margin-top: 12px;
      font-size: 14px;
      color: #555;
      text-decoration: none;
    }
    .forgot-password:hover {
      color: #FF6B35;
      text-decoration: underline;
    }
    .signup-text {
      margin-top: 16px;
      font-size: 14px;
      color: #444;
    }
    .signup-text a {
      color: #FF6B35;
      font-weight: 600;
      text-decoration: none;
    }
    .signup-text a:hover {
      text-decoration: underline;
    }
    .eye-icon {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }
    .eye-icon:hover {
      color: #FF6B35;
    }
    .image-container img {
      max-width: 100%;
      height: auto;
      animation: floatImg 4s infinite ease-in-out;
    }
    @keyframes floatImg {
      0% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0); }
    }
    .form-group.position-relative {
      position: relative;
    }
  </style>
</head>
<body>
  <div class="container-fluid login-container">
    <div class="row w-100">
      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div class="login-box">
          <img src="{{ asset('frontend/img/logo.png') }}" alt="EpicEats Logo">
          <p class="sub-text">A Flavor Race, in One Place!</p>
          <h3 class="login-heading">Savor the journey!</h3>

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <input type="email" name="email" class="form-control @error('email') error @enderror" placeholder="Enter your email">
              @error('email')
                <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
              @enderror
            </div>

            <div class="form-group position-relative">
              <input type="password" name="password" id="password" class="form-control input-with-icon @error('password') error @enderror" placeholder="Enter your password">
              <span class="eye-icon"><i class="fas fa-eye" id="togglePassword"></i></span>
              @error('password')
                <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
              @enderror
            </div>

            <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
            <button type="submit" class="btn btn-signin">Sign In</button>
            <p class="signup-text">Don’t have an account? <a href="{{ route('register') }}">Sign UP</a></p>
          </form>
        </div>
      </div>

      <div class="col-md-6 image-container d-none d-md-flex align-items-center justify-content-center">
        <img src="{{ asset('frontend/img/login-illustrator.png') }}" alt="Login Illustration">
      </div>
    </div>
  </div>

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
