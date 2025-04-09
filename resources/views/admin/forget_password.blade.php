<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password | EpicEats</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff, #ffece5);
        }

        .card {
            backdrop-filter: blur(6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 107, 53, 0.15);
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
        <img src="{{ asset('frontend/img/logo.png') }}" alt="EpicEats Logo" class="w-28 md:w-32 drop-shadow-md">
    </div>

    <!-- Card -->
    <div class="card bg-white/70 rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-orange-500 mb-4">Forgot your password?</h2>
        <p class="text-gray-700 text-sm leading-relaxed mb-6">
            No worries! Just enter your email address below, and we’ll send you a link to reset your password.
        </p>

        @if (session('status'))
        <div class="mb-4 text-green-600 text-sm font-medium">
            {{ session('status') }}
        </div>
        @endif

        <form action="{{route('admin.password_submit')}}"method="post">
            @csrf

            <!-- Email Field -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-1">Email Address</label>
                <input id="email" name="email" type="email"
                    class="w-full px-4 py-2 rounded-lg bg-white/80 border border-orange-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="btn-glow bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white text-sm font-semibold px-6 py-2 rounded-xl shadow-md">
                    Send Reset Link
                </button>
            </div>
        </form>
    </div>

</body>

</html>