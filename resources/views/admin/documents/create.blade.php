{{-- resources/views/admin/documents/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Add Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-64 bg-green-700 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-green-600">Admin Panel</div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.index') }}" class="block px-4 py-2 rounded hover:bg-green-800">Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-green-800">Users</a>
            <a href="{{ route('admin.documents.index') }}" class="block px-4 py-2 rounded hover:bg-green-800">Documents</a>
            <a href="{{ route('admin.admissions.index') }}" class="block px-4 py-2 rounded hover:bg-green-800">Admissions</a>
            <a href="{{ route('admin.tuitions.index') }}" class="block px-4 py-2 rounded hover:bg-green-800">Tuitions</a>
            <a href="{{ route('admin.reports.index') }}" class="block px-4 py-2 rounded hover:bg-green-800">Reports</a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="p-6 border-t border-green-600">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-green-800 rounded">Logout</button>
        </form>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add Document</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.documents.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-4">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                       required>
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div class="relative">
                <label for="type" class="block text-gray-700 font-semibold mb-1">Type</label>
                <select name="type" id="type"
                        class="appearance-none w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                    <option value="">Select Type</option>
                    <option value="PDF" {{ old('type') == 'PDF' ? 'selected' : '' }}>PDF</option>
                    <option value="Word" {{ old('type') == 'Word' ? 'selected' : '' }}>Word</option>
                    <option value="Excel" {{ old('type') == 'Excel' ? 'selected' : '' }}>Excel</option>
                </select>
                <!-- Centered bigger green dropdown icon -->
                <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.516 7.548l4.484 4.484 4.484-4.484L15.484 9l-5.484 5.484L4.516 9z"/>
                    </svg>
                </div>
                @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex items-center mt-3">
                <button type="submit" class="bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
                    Save Document
                </button>
                <a href="{{ route('admin.documents.index') }}" 
                class="ml-3 border border-green-700 px-5 py-2 text-green-700 rounded-md hover:bg-green-100 hover:text-green-800 transition">
                 Cancel
             </a>
                         </div>
        </form>
    </main>

</body>
</html>
