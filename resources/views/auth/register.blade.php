<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Registration - EpicEats</title>

  <!-- Google Fonts & Font Awesome -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

    .card {
      display: flex;
      width: 100%;
      max-width: 1200px;
      height: 630px;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .left {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 20px 30px;
      justify-content: flex-start;
      overflow-y: hidden;
    }

    .logo-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 10px;
    }

    .logo {
      width: 60px;
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

    .form-header h4 {
      font-size: 14px;
      color: #333;
      margin: 2px 0;
      text-align: left;
    }

    .form-group {
      margin-bottom: 10px;
    }

    label {
      font-size: 13px;
      margin-bottom: 4px;
      display: block;
      font-weight: 500;
      color: #222;
    }

    input {
      width: 100%;
      padding: 10px 14px;
      border: 2px solid #ff6b35;
      border-radius: 10px;
      font-size: 14px;
      background: #fffdfc;
    }

    input:focus {
      outline: none;
      border-color: #e65a2d;
      box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.15);
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

    .right {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background: none;
      padding: 20px;
    }

    .right img {
      max-width: 100%;
      max-height: 90%;
      object-fit: contain;
    }

    @media (max-width: 992px) {
      .card {
        flex-direction: column;
        height: auto;
        border-radius: 0;
      }

      .right {
        display: none;
      }

      body {
        overflow-y: auto;
        height: auto;
      }

      .left {
        padding: 25px 20px;
      }

      .logo-header {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>

<body>
  <div class="card">
    <!-- Left: Form -->
    <div class="left">
      <div class="logo-header">
        <img src="frontend/img/logo.png" alt="EpicEats Logo" class="logo">
        <div class="form-header">
          <h2>User Registration</h2>
          <h4>Welcome!</h4>
        </div>
      </div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" value="{{ old('username') }}">
        </div>

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}">
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password">
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
        </div>

        <button type="submit" class="btn-submit">Sign Up</button>
      </form>
    </div>

    <!-- Right: Illustration -->
    <div class="right">
      <img src="frontend/img/user.png" alt="User Illustration">
    </div>
  </div>
</body>

</html>
