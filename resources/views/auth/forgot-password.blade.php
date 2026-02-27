<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | FUMCESS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center font-sans antialiased">

    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md border-t-[6px] border-green-700 transform transition-all">
        <div class="text-center mb-8">
            <img src="{{ asset('images/fumces_logo.jpg') }}" alt="FUMCESS Logo" class="h-24 mx-auto mb-6">
            
            <h3 class="text-2xl font-bold text-gray-800">Forgot Password?</h3>
            <p class="text-gray-500 mt-2 text-sm px-4">Enter your registered email below and we'll send you a link to reset your password.</p>
        </div>

        @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-6 text-center font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 pl-1">Email Address</label>
                <input type="email" id="email" name="email" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-green-700/20 focus:border-green-700 outline-none transition-all @error('email') border-red-500 @enderror" 
                       placeholder="e.g. name@example.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-green-700 hover:bg-green-800 text-white font-bold rounded-xl shadow-lg shadow-green-900/20 transform hover:-translate-y-0.5 transition-all duration-200 active:scale-[0.98]">
                Send Reset Link
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-400 hover:text-green-700 transition-colors inline-flex items-center gap-2">
                &larr; Back to Login
            </a>
        </div>
    </div>

</body>
</html>