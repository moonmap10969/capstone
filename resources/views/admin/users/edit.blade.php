<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Edit User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- Full Width Edit Form --}}
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white shadow rounded-lg p-6 w-full">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

{{-- Role --}}
<div class="mb-4 relative">
    <label for="role" class="block text-gray-700 font-semibold mb-1">Role</label>
    <select name="role" id="role"
            class="appearance-none w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500"
            required>
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="registrar" {{ old('role', $user->role) == 'registrar' ? 'selected' : '' }}>Registrar</option>
        <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
        <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Teacher</option>
    </select>
    <!-- Custom dropdown arrow -->
    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-700">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
</div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password <span class="text-gray-500">(leave blank to keep current)</span></label>
                <input type="password" name="password" id="password"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            {{-- Submit --}}
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded bg-green-700 text-white hover:bg-green-800">Update User</button>
            </div>
        </form>

    </main>
</body>
</html>
