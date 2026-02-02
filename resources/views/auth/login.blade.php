<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FUMCES</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-50">

    <div class="min-h-screen flex">

        <!-- Left Image Section -->
        <div class="hidden lg:flex w-1/2 relative">
            <img src="{{ asset('images/bg-image.jpeg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-green-900/30"></div>
        </div>

        <!-- Right Login Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6">
            <div class="w-full max-w-md">

                <div class="text-center mb-6">
                    <img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-6/308787211_474191617959376_4052700751878050898_n.jpg"
                        class="w-24 h-24 mx-auto rounded-full mb-2">
                    <h1 class="text-2xl font-semibold text-green-700">Log In</h1>
                </div>

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-2 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password with Show/Hide -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-2 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500">
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-700">
                                <!-- Open Eye -->
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <!-- Closed Eye -->
                                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.969 9.969 0 012.223-3.703M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="rounded">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Log In
                    </button>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-center text-gray-600 hover:text-green-700">
                            Forgot your password?
                        </a>
                    @endif
                </form>

                <!-- Divider -->
                <div class="flex items-center my-6">
                    <div class="flex-1 h-px bg-gray-300"></div>
                    <span class="px-3 text-sm text-gray-500">or</span>
                    <div class="flex-1 h-px bg-gray-300"></div>
                </div>

                <!-- Register -->
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block w-full text-center border border-green-600 text-green-700 py-2 rounded-lg font-semibold hover:bg-green-50">
                        Create an account
                    </a>
                @endif

            </div>
        </div>

    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        });
    </script>

</body>

</html>