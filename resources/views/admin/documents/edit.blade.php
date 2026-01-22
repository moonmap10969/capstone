{{-- resources/views/admin/documents/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Edit Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Document</h1>

        <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-4">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $document->title) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            {{-- Type --}}
            <div class="relative">
                <label for="type" class="block text-gray-700 font-semibold mb-1">Type</label>
                <select name="type" id="type" required
                        class="appearance-none w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Select Type</option>
                    <option value="PDF" {{ $document->type == 'PDF' ? 'selected' : '' }}>PDF</option>
                    <option value="Word" {{ $document->type == 'Word' ? 'selected' : '' }}>Word</option>
                    <option value="Excel" {{ $document->type == 'Excel' ? 'selected' : '' }}>Excel</option>
                </select>
                <!-- Dropdown arrow -->
                <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5.516 7.548l4.484 4.484 4.484-4.484L15.484 9l-5.484 5.484L4.516 9z"/>
                    </svg>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center mt-3">
                <button type="submit" class="bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
                    Save Changes
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
