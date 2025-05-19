<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password | EpicEats</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/img/images/Logo.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to top right, #fff, #ffeae0);
    }

    .card {
      backdrop-filter: blur(6px);
      border: 1px solid rgba(255, 107, 53, 0.15);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .btn-glow {
      transition: all 0.3s ease;
    }

    .btn-glow:hover {
      transform: scale(1.02) translateY(-2px);
      box-shadow: 0 12px 24px rgba(255, 107, 53, 0.35);
    }
  </style>
</head>

<body class="flex justify-center items-center min-h-screen relative px-4">

  <!-- Logo -->
  <div class="absolute top-8 right-8">
    <img src="{{ asset('frontend/img/images/Logo.png') }}" alt="EpicEats Logo" class="w-28 md:w-32 drop-shadow-md">
  </div>

  <!-- Card -->
  <div class="card bg-white/70 rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-orange-500 mb-4">Reset your password</h2>
    <p class="text-gray-700 text-sm leading-relaxed mb-6">
      Enter your email and new password to complete the reset.
    </p>

    <form action="{{route('admin.reset_password_submit')}}" method="post">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-semibold text-gray-800 mb-1">Email Address</label>
        <input id="email" name="email" type="email" required autofocus autocomplete="username"
          value="{{$email}}" readonly
          class="w-full px-4 py-2 rounded-lg bg-white/80 border border-orange-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400">
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-semibold text-gray-800 mb-1">New Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password"
          class="w-full px-4 py-2 rounded-lg bg-white/80 border border-orange-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400">
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 mb-1">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
          class="w-full px-4 py-2 rounded-lg bg-white/80 border border-orange-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400">
        @error('password_confirmation')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Button -->
      <div class="text-right">
        <button type="submit"
          class="btn-glow bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white text-sm font-semibold px-6 py-2 rounded-xl shadow-md">
          Reset Password
        </button>
      </div>
    </form>
  </div>

</body>

</html>