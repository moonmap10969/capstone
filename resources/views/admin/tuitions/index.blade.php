<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Tuition Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        th.sorted-asc::after {
            content: "▲";
            margin-left: 4px;
            font-size: 0.6em;
        }

        th.sorted-desc::after {
            content: "▼";
            margin-left: 4px;
            font-size: 0.6em;
        }
    </style>
</head>

<body class="min-h-screen flex bg-gray-100">

    @include('layouts.sidebar')

    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tuition Records</h1>
            <a href="{{ route('admin.tuitions.create') }}"
                class="bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
                Add Tuition
            </a>
        </div>

        @php
            // Stats
            $totalPendingApprovals = $tuitions->where('approval_status', 'pending')->count();
            $paymentsPartial = $tuitions->where('status', 'partial')->count();
            $paymentsCompleted = $tuitions->where('status', 'paid')->count();
            $totalStudents = $tuitions->pluck('student_name')->unique()->count();
        @endphp

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Pending Approvals</p>
                <p class="text-2xl font-bold">{{ $totalPendingApprovals }}</p>
            </div>

            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Payments Partial</p>
                <p class="text-2xl font-bold">{{ $paymentsPartial }}</p>
            </div>

            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Payments Completed</p>
                <p class="text-2xl font-bold">{{ $paymentsCompleted }}</p>
            </div>

            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm">Total Students Registered</p>
                <p class="text-2xl font-bold">{{ $totalStudents }}</p>
            </div>
        </div>

        {{-- Filter --}}
        <input id="filterInput" class="w-full mb-4 border border-green-700 rounded px-3 py-2"
            placeholder="Filter by student, status, method, approval">

        {{-- Main Tuition Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <table id="tuitionTable" class="min-w-full text-sm">
                <thead class="bg-green-700 text-white cursor-pointer">
                    <tr>
                        <th class="px-6 py-3 text-left" data-sort="id">ID</th>
                        <th class="px-6 py-3 text-left" data-sort="student">Student Name</th>
                        <th class="px-6 py-3 text-left" data-sort="amount">Amount</th>
                        <th class="px-6 py-3 text-left" data-sort="status">Payment Status</th>
                        <th class="px-6 py-3 text-left" data-sort="method">Payment Method</th>
                        <th class="px-6 py-3 text-left" data-sort="approval_status">Approval Status</th>
                        <th class="px-6 py-3 text-center">Approval</th>
                        <th class="px-6 py-3 text-left" data-sort="date">Date</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($tuitions as $tuition)
                        <tr>
                            <td class="px-6 py-4">{{ $tuition->id }}</td>
                            <td class="px-6 py-4">{{ $tuition->student_name }}</td>
                            <td class="px-6 py-4">₱{{ number_format($tuition->amount, 2) }}</td>
                            <td class="px-6 py-4">{{ ucfirst($tuition->status) }}</td>
                            <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $tuition->payment_method)) }}</td>
                            <td class="px-6 py-4 font-semibold">
                                @if($tuition->approval_status === 'approved')
                                    <span class="text-green-700 font-semibold">Approved</span>
                                @else
                                    {{ ucfirst($tuition->approval_status) }}
                                @endif
                            </td>

                            {{-- Approval Buttons --}}
                            <td class="px-6 py-4 text-center">
                                @if($tuition->approval_status !== 'approved')
                                    <div class="flex justify-center gap-3">
                                        {{-- Approve Form --}}
                                        <form action="{{ route('admin.tuitions.approve', $tuition->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full border-2 border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                                ✓
                                            </button>
                                        </form>

                                        {{-- Reject Form --}}
                                        <form action="{{ route('admin.tuitions.reject', $tuition->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition">
                                                ✕
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-green-700 font-semibold"> — </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($tuition->date)->format('M d, Y') }}</td>

                            {{-- Actions always visible --}}
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="{{ route('admin.tuitions.edit', $tuition->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.tuitions.destroy', $tuition->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">No tuition records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Students with Partial Tuition Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <h2 class="text-xl font-bold px-6 py-4 border-b border-gray-200">Students with Partial Tuition</h2>
            <table class="min-w-full text-sm">
                <thead class="bg-green-700 text-white cursor-pointer">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Student Name</th>
                        <th class="px-6 py-3 text-left">Amount</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse(\App\Models\Tuition::where('status', 'partial')->latest()->get() as $tuition)
                        <tr>
                            <td class="px-6 py-4">{{ $tuition->id }}</td>
                            <td class="px-6 py-4">{{ $tuition->student_name }}</td>
                            <td class="px-6 py-4">₱{{ number_format($tuition->amount, 2) }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($tuition->date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="mailto:{{ $tuition->student_email ?? 'example@email.com' }}"
                                    class="bg-green-700 text-white px-3 py-1 rounded hover:bg-green-800">Email</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No partial tuition records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">{{ $tuitions->links() }}</div>

    </main>

    <script>
        const table = document.getElementById('tuitionTable');
        const tbody = table.querySelector('tbody');
        const headers = table.querySelectorAll('th[data-sort]');
        const filterInput = document.getElementById('filterInput');

        let currentSortColumn = 0;
        let sortDirection = 1;

        function sortTable(index, key) {
            const rows = Array.from(tbody.rows);
            rows.sort((a, b) => {
                let A = a.cells[index].textContent.trim();
                let B = b.cells[index].textContent.trim();

                if (key === 'id' || key === 'amount') return sortDirection * (parseFloat(A) - parseFloat(B));
                if (key === 'date') return sortDirection * (new Date(A) - new Date(B));
                return sortDirection * A.localeCompare(B);
            });

            rows.forEach(row => tbody.appendChild(row));
            headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
            headers[index].classList.add(sortDirection === 1 ? 'sorted-asc' : 'sorted-desc');
        }

        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                const key = header.dataset.sort;
                sortDirection = currentSortColumn === index ? -sortDirection : 1;
                currentSortColumn = index;
                sortTable(index, key);
            });
        });

        window.addEventListener('DOMContentLoaded', () => {
            sortTable(0, 'id');
        });

        filterInput.addEventListener('input', () => {
            const value = filterInput.value.toLowerCase();
            Array.from(tbody.rows).forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
            });
        });
    </script>
</body>

</html>