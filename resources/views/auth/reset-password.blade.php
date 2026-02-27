<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | FUMCESS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center font-sans antialiased">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md border-t-[6px] border-green-700">
        <div class="text-center mb-8">
            <img src="{{ asset('images/fumces_logo.jpg') }}" alt="FUMCESS Logo" class="h-20 mx-auto mb-4">
            <h3 class="text-2xl font-bold text-gray-800">New Password</h3>
            <p class="text-gray-500 mt-2 text-sm">Please secure your account with a new password.</p>
        </div>

        <form method="POST" action="{{ route('password.update_final') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->token }}">
            <input type="hidden" name="email" value="{{ $request->email }}">

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-400 outline-none" value="{{ $request->email }}" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">New Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-700/20 focus:border-green-700 outline-none @error('password') border-red-500 @enderror" required autofocus>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-700/20 focus:border-green-700 outline-none" required>
            </div>

            <button type="submit" class="w-full py-3 bg-green-700 hover:bg-green-800 text-white font-bold rounded-xl shadow-lg transition-all active:scale-[0.98]">
                Reset Password
            </button>
        </form>
    </div>
</body>
</html>