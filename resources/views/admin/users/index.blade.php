<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Users</title>
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

    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Users</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
                Add User
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter --}}
        <div class="mb-4 flex gap-3">
            <input type="text" id="filterInput" placeholder="Filter by name, email or role..."
                   class="w-1/2 border border-green-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        {{-- Users Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table id="usersTable" class="min-w-full text-sm">
                <thead class="bg-green-700 text-white cursor-pointer">
                    <tr>
                        <th class="px-6 py-3 text-left" data-sort="id">ID</th>
                        <th class="px-6 py-3 text-left" data-sort="name">Name</th>
                        <th class="px-6 py-3 text-left" data-sort="email">Email</th>
                        <th class="px-6 py-3 text-left" data-sort="role">Role</th>
                        <th class="px-6 py-3 text-left" data-sort="created_at">Created</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->role }}</td>
                            <td class="px-6 py-4">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </main>

    <script>
        const table = document.getElementById('usersTable');
        const tbody = table.querySelector('tbody');
        const filterInput = document.getElementById('filterInput');

        function applyFilters() {
            const filterText = filterInput.value.toLowerCase();
            Array.from(tbody.rows).forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();
                const role = row.cells[3].textContent.toLowerCase();
                row.style.display = (name.includes(filterText) || email.includes(filterText) || role.includes(filterText)) ? '' : 'none';
            });
        }

        filterInput.addEventListener('input', applyFilters);

        // --- Sort Table ---
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

        // Default sort by ID
        sortTable(0, 'id');
    </script>

</body>
</html>
