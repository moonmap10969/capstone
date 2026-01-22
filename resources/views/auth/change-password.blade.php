<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Change Your Password</h2>
        <p class="mb-6 text-sm text-gray-600">This is your first login. Please set a new password to secure your account.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Update Password
            </button>
        </form>
    </div>
</x-guest-layout>