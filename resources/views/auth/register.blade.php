<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FUMCES</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen">

<div class="min-h-screen flex">

    <!-- Left Image Section -->
    <div class="hidden lg:flex w-1/2 relative">
        <img
            src="https://media.istockphoto.com/id/2096480418/photo/group-of-multi-cultural-children-friends-linking-arms-looking-down-into-camera.jpg"
            class="absolute inset-0 w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-green-900/30"></div>
    </div>

    <!-- Right Register Section -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6">
        <div class="w-full max-w-md">

            <div class="text-center mb-6">
                <img
                    src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-6/308787211_474191617959376_4052700751878050898_n.jpg"
                    class="w-24 h-24 mx-auto rounded-full mb-2"
                >
                <h1 class="text-2xl font-semibold text-green-700">Create Account</h1>
            </div>

            <!-- Laravel Register Form -->
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full px-4 py-2 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500"
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-2 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-2 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500"
                    >
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-2 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700"
                >
                    Register
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 h-px bg-gray-300"></div>
                <span class="px-3 text-sm text-gray-500">already have an account?</span>
                <div class="flex-1 h-px bg-gray-300"></div>
            </div>

            <!-- Login Link -->
            <a href="{{ route('login') }}"
               class="block w-full text-center border border-green-600 text-green-700 py-2 rounded-lg font-semibold hover:bg-green-50">
                Log In
            </a>

        </div>
    </div>

</div>

</body>
</html>
