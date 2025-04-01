<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f7f7f7;
    }

    .main-container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 60px;
      border-radius: 18px;
      background-color: #fff;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
      position: relative;
      overflow: hidden;
    }

    .logo-wrapper {
      position: absolute;
      top: 25px;
      right: 30px;
      z-index: 10;
    }

    .logo {
      width: 100px; /* Increased from 80px */
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .form-column {
      flex: 1;
      max-width: 48%;
    }

    .heading-wrapper {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-title {
      font-size: 34px;
      font-weight: 700;
      color: #FF6B35;
      margin-bottom: 5px;
    }

    .form-subtitle {
      font-size: 22px;
      font-weight: 600;
      color: #333;
      margin: 0;
    }

    .form-group {
      margin-bottom: 22px;
    }

    label {
      font-size: 15px;
      color: #444;
      margin-bottom: 8px;
      display: block;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #FF6B35;
      border-radius: 10px;
      font-size: 15px;
      outline: none;
      transition: 0.3s;
      background-color: #fffdfc;
      box-shadow: 0 2px 6px rgba(255, 107, 53, 0.05);
    }

    input:focus {
      border-color: #e65a2d;
      box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
    }

    .btn {
      background: linear-gradient(135deg, #FF6B35, #ff914d);
      color: white;
      font-size: 16px;
      font-weight: 600;
      padding: 14px 40px;
      border-radius: 12px;
      border: none;
      box-shadow: 0 8px 16px rgba(255, 107, 53, 0.25);
      cursor: pointer;
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
      display: block;
      margin: 20px auto; /* ✅ Centered */
    }

    .btn:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #ff571c, #ff7c3a);
      box-shadow: 0 12px 24px rgba(255, 107, 53, 0.3);
    }

    .image-column {
      flex: 1;
      max-width: 48%;
      text-align: center;
      position: relative;
    }

    .illustration {
      max-width: 100%;
      height: auto;
      z-index: 1;
    }

    @media (max-width: 991px) {
      .row {
        flex-direction: column;
      }

      .form-column,
      .image-column {
        max-width: 100%;
      }

      .main-container {
        padding: 40px 25px;
        border-radius: 0;
      }

      .logo-wrapper {
        top: 15px;
        right: 20px;
      }

      .logo {
        width: 90px;
      }
    }
  </style>
</head>
<body>

  <div class="main-container">
    <!-- Logo -->
    <div class="logo-wrapper">
      <img src="frontend/img/logo.png" class="logo" alt="EpicEats Logo">
    </div>

    <div class="row">
      <!-- Left Column -->
      <div class="form-column">
        <div class="heading-wrapper">
          <h2 class="form-title">User Registration</h2>
          <h4 class="form-subtitle">Welcome !</h4>
        </div>

        <form>
          <div class="form-group">
            <label for="restaurant_name">Username</label>
            <input type="text" id="restaurant_name" placeholder="Enter your username">
          </div>

          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" placeholder="Enter phone number">
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" placeholder="Enter address">
          </div>

          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" placeholder="Enter email address">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter password">
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirm Your Password</label>
            <input type="password" id="confirm_password" placeholder="Confirm password">
          </div>

          <button type="submit" class="btn">Sign Up</button>
        </form>
      </div>

      <!-- Right Column -->
      <div class="image-column">
        <img src="frontend/img/user.png" class="illustration" alt="user">
      </div>
    </div>
  </div>

</body>
</html>
