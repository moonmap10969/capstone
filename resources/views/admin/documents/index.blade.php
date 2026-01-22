<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Documents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        th.sorted-asc::after { content: "▲"; margin-left: 4px; font-size: 0.6em; }
        th.sorted-desc::after { content: "▼"; margin-left: 4px; font-size: 0.6em; }
    </style>
</head>

<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Documents</h1>
            <a href="{{ route('admin.documents.create') }}"
               class="bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">Add Document</a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Pending Documents</p>
                <p class="text-2xl font-bold">{{ $totalPending }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Approved Documents</p>
                <p class="text-2xl font-bold">{{ $totalApproved }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Rejected Documents</p>
                <p class="text-2xl font-bold">{{ $totalRejected }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Documents</p>
                <p class="text-2xl font-bold">{{ $totalDocuments }}</p>
            </div>
        </div>

        {{-- Filters --}}
        <div class="mb-4 flex gap-3">
            <input type="text" id="filterInput" placeholder="Filter by title..."
                   class="w-1/2 border border-green-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">

            <div class="relative w-1/4">
                <select id="typeFilter"
                        class="appearance-none w-full border border-green-700 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                     d="M19 9l-7 7-7-7" /></svg>
                </div>
            </div>
        </div>

        {{-- Documents Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <table id="documentsTable" class="min-w-full text-sm">
                <thead class="bg-green-700 text-white cursor-pointer">
                    <tr>
                        <th class="px-6 py-3 text-left" data-sort="id">ID</th>
                        <th class="px-6 py-3 text-left" data-sort="title">Title</th>
                        <th class="px-6 py-3 text-left" data-sort="type">Type</th>
                        <th class="px-6 py-3 text-left" data-sort="created_at">Created</th>
                        <th class="px-6 py-3 text-left" data-sort="approval_status">Approval Status</th>
                        <th class="px-6 py-3 text-center">Approval</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($documents as $document)
                    <tr>
                        <td class="px-6 py-4">{{ $document->id }}</td>
                        <td class="px-6 py-4">{{ $document->title }}</td>
                        <td class="px-6 py-4">{{ $document->type }}</td>
                        <td class="px-6 py-4">{{ $document->created_at->format('M d, Y') }}</td>

                        {{-- Approval Status --}}
                        <td class="px-6 py-4 font-semibold">
                            @if($document->approval_status === 'approved')
                                <span class="text-green-700 font-semibold">Approved</span>
                            @elseif($document->approval_status === 'rejected')
                                <span class="text-red-600 font-semibold">Rejected</span>
                            @else
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            @endif
                        </td>

                        {{-- Approval Buttons --}}
                        <td class="px-6 py-4 text-center">
                            @if($document->approval_status === 'pending')
                                <div class="flex justify-center gap-3">
                                    <form action="{{ route('admin.documents.approve', $document->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-full border-2 border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                            ✓
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.documents.reject', $document->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-full border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <a href="{{ route('admin.documents.edit', $document->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No documents found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">{{ $documents->links() }}</div>

    </main>

    <script>
        const table = document.getElementById('documentsTable');
        const tbody = table.querySelector('tbody');
        const filterInput = document.getElementById('filterInput');
        const typeFilter = document.getElementById('typeFilter');

        function applyFilters() {
            const filterText = filterInput.value.toLowerCase();
            const typeValue = typeFilter.value;

            Array.from(tbody.rows).forEach(row => {
                const title = row.cells[1].textContent.toLowerCase();
                const type = row.cells[2].textContent;

                row.style.display =
                    (title.includes(filterText) && (typeValue === '' || type === typeValue)) ? '' : 'none';
            });
        }

        filterInput.addEventListener('input', applyFilters);
        typeFilter.addEventListener('change', applyFilters);

        const headers = table.querySelectorAll('th[data-sort]');
        let currentSortColumn = 0;
        let sortDirection = 1;

        function sortTable(index, key) {
            const rows = Array.from(tbody.rows);
            rows.sort((a, b) => {
                let aText = a.cells[index].textContent.trim();
                let bText = b.cells[index].textContent.trim();
                if (key === 'id') return sortDirection * (parseInt(aText) - parseInt(bText));
                if (key === 'created_at') return sortDirection * (new Date(aText) - new Date(bText));
                return sortDirection * aText.localeCompare(bText);
            });
            rows.forEach(row => tbody.appendChild(row));
            headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
            headers[index].classList.add(sortDirection === 1 ? 'sorted-asc' : 'sorted-desc');
        }

        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                const key = header.getAttribute('data-sort');
                if (currentSortColumn === index) sortDirection *= -1;
                else sortDirection = 1;
                currentSortColumn = index;
                sortTable(index, key);
            });
        });

        sortTable(0, 'id');
    </script>

</body>
</html>


