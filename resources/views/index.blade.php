<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Admissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('admin.admissions.layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Admissions</h1>
            <a href="{{ route('admin.admissions.create') }}" class="bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
                Add Admission
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Pending</p>
                <p class="text-2xl font-bold">{{ $totalPendingApprovals }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Approved</p>
                <p class="text-2xl font-bold">{{ $totalApproved }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Rejected</p>
                <p class="text-2xl font-bold">{{ $totalRejected }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Students Registered</p>
                <p class="text-2xl font-bold">{{ $totalStudentsRegistered }}</p>
            </div>
        </div>

        {{-- Filters --}}
        <div class="mb-4 flex gap-3">
            <input type="text" id="filterInput" placeholder="Filter by student name..."
                   class="w-1/2 border border-green-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            <div class="relative w-1/4">
                <select id="gradeFilter" class="appearance-none w-full border border-green-700 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">All Grades</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade }}">{{ $grade }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Admissions Table --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="table-auto border-collapse w-full text-sm">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">First Name</th>
                        <th class="px-4 py-2 text-left">Last Name</th>
                        <th class="px-4 py-2 text-left">Date of Birth</th>
                        <th class="px-4 py-2 text-left">Grade</th>
                        <th class="px-4 py-2 text-left">Parent First Name</th>
                        <th class="px-4 py-2 text-left">Parent Last Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Phone</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-left">Admission Date</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($admissions as $admission)
                        <tr>
                            <td class="px-4 py-2">{{ $admission->id }}</td>
                            <td class="px-4 py-2">{{ $admission->student_first_name }}</td>
                            <td class="px-4 py-2">{{ $admission->student_last_name }}</td>
                            <td class="px-4 py-2">{{ $admission->date_of_birth }}</td>
                            <td class="px-4 py-2">{{ $admission->grade_applied }}</td>
                            <td class="px-4 py-2">{{ $admission->parent_first_name }}</td>
                            <td class="px-4 py-2">{{ $admission->parent_last_name }}</td>
                            <td class="px-4 py-2">{{ $admission->email }}</td>
                            <td class="px-4 py-2">{{ $admission->phone }}</td>

                            {{-- Status Column --}}
                            <td class="px-6 py-4 text-center">
                                @if($admission->status === 'pending')
                                    <div class="flex justify-center gap-3">
                                        {{-- Approve Icon --}}
                                        <form action="{{ route('admin.admissions.approve', $admission->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full border-2 border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition"
                                                title="Approve"
                                            >
                                                ✓
                                            </button>
                                        </form>

                                        {{-- Reject Icon --}}
                                        <form action="{{ route('admin.admissions.reject', $admission->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition"
                                                title="Reject"
                                            >
                                                ✕
                                            </button>
                                        </form>
                                    </div>
                                @elseif($admission->status === 'approved')
                                    <span class="text-green-700 font-semibold">Approved</span>
                                @elseif($admission->status === 'rejected')
                                    <span class="text-red-600 font-semibold">Rejected</span>
                                @else
                                    <span class="text-gray-500 font-semibold">—</span>
                                @endif
                            </td>

                            <td class="px-4 py-2">{{ $admission->created_at?->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('admin.admissions.edit', $admission->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.admissions.destroy', $admission->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-2 text-center text-gray-500">No admissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $admissions->links() }}
        </div>
    </main>

    {{-- Client-side Filter Script --}}
    <script>
        const filterInput = document.getElementById('filterInput');
        const gradeFilter = document.getElementById('gradeFilter');
        const tableRows = document.querySelectorAll('tbody tr');

        function filterRows() {
            const text = filterInput.value.toLowerCase();
            const selectedGrade = gradeFilter.value;

            tableRows.forEach(row => {
                const firstName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                const lastName = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                const gradeCell = row.querySelector('td:nth-child(5)')?.textContent || '';

                const matchesText = (firstName + ' ' + lastName).includes(text);
                const matchesGrade = selectedGrade === '' || gradeCell === selectedGrade;
                row.style.display = matchesText && matchesGrade ? '' : 'none';
            });
        }

        filterInput.addEventListener('input', filterRows);
        gradeFilter.addEventListener('change', filterRows);
    </script>

</body>
</html>
