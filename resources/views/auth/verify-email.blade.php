<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Email Verification | EpicEats</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <!-- Favicon Icon -->
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
    <h2 class="text-2xl font-bold text-orange-500 mb-4">Verify your email</h2>
    <p class="text-gray-700 text-sm leading-relaxed mb-6">
      Thanks for signing up! Please verify your email address by clicking the link we just sent you. <br />
      Didn’t receive it? We’ll gladly send another.
    </p>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 font-medium text-sm text-green-600">
        A new verification link has been sent to the email address you provided.
      </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6">
      <!-- Resend -->
      <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit"
          class="btn-glow bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-xl shadow-md">
          Resend Verification Email
        </button>
      </form>

      <!-- Logout -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
          class="text-sm text-gray-600 hover:text-orange-600 transition duration-150 ease-in-out">
          Log Out
        </button>
      </form>
    </div>
  </div>

</body>
</html>
