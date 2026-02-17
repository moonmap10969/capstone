<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Enrollment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen flex bg-gray-100" x-data="{ open: false, viewModal: false, selectedEnrollment: null, searchQuery: '', statusFilter: 'all' }">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="space-y-6">

            {{-- Header Section --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Enrollment Management</h1>

                <div x-data="{ openMenu: false }" class="relative">
                    <button @click="openMenu = !openMenu"
                        class="bg-[#057E2E] text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-[#046625] transition">
                        + New Enrollment
                    </button>

                    <div x-show="openMenu" @click.away="openMenu = false" x-transition
                        class="absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">
                        <a href="{{ route('registrar.enrollment.create', ['type' => 'new']) }}"
                           class="block px-4 py-3 text-sm font-semibold hover:bg-gray-50 border-b">
                            New Student
                        </a>
                        <button @click="window.location.href='{{ route('registrar.enrollment.create', ['type' => 'returning']) }}'"
                            class="w-full text-left px-4 py-3 text-sm font-semibold hover:bg-gray-50">
                            Returning Student
                        </button>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                    <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Total Enrollments</p>
                    <p class="text-2xl font-black text-gray-900">{{ $stats->total_enrollments }}</p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                    <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Pending Requests</p>
                    <p class="text-2xl font-black text-gray-900">{{ $stats->pending_requests }}</p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                    <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">New This Week</p>
                    <p class="text-2xl font-black text-gray-900">{{ $stats->new_this_week }}</p>
                </div>
            </div>

            {{-- Search & Filter --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="relative flex-1 w-full">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Search by name or ID..." x-model="searchQuery" 
                        class="pl-9 w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-[#057E2E] outline-none">
                </div>
                <select x-model="statusFilter" class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-[#057E2E]">
                    <option value="all">All Status</option>
                    <option value="enrolled">Enrolled</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase">
                        <tr>
                            <th class="p-4">Student Name</th>
                            <th class="p-4">Section</th>
                            <th class="p-4">Grade</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($enrollments as $e)
                        <tr class="hover:bg-gray-50 transition" 
                            x-show="(statusFilter === 'all' || statusFilter === '{{ $e->status }}') && 
                            ('{{ $e->admission->studentFirstName ?? '' }} {{ $e->admission->studentLastName ?? '' }}'.toLowerCase().includes(searchQuery.toLowerCase()) || 
                             '{{ $e->studentNumber ?? '' }}'.toLowerCase().includes(searchQuery.toLowerCase()))">
                            
                            <td class="p-4">
                                <p class="font-medium text-gray-900">{{ $e->admission->studentFirstName ?? 'N/A' }} {{ $e->admission->studentLastName ?? '' }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $e->studentNumber }}</p>
                            </td>
                            <td class="p-4 text-sm text-gray-600 font-bold">{{ $e->section->name ?? 'Unassigned' }}</td>
                            <td class="p-4 text-gray-600 uppercase">{{ $e->year_level }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold 
                                    {{ $e->status === 'enrolled' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($e->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <button @click="selectedEnrollment = {{ json_encode($e->load('admission', 'section')) }}; viewModal = true"
                                    class="text-[#057E2E] font-bold hover:underline inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg> View
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-12 text-center text-gray-400 italic">No enrollment records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t">
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </main>

    {{-- Detail Modal --}}
    <div x-show="viewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl" @click.away="viewModal = false">
            <div class="p-6 bg-[#057E2E] text-white flex justify-between items-center">
                <h3 class="text-xl font-bold">Enrollment Details</h3>
                <button @click="viewModal = false" class="text-2xl leading-none">&times;</button>
            </div>
            <div class="p-6 space-y-4" x-show="selectedEnrollment">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Student Name</p>
                        <p class="font-bold text-gray-800" x-text="selectedEnrollment?.admission?.studentFirstName + ' ' + selectedEnrollment?.admission?.studentLastName"></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Section</p>
                        <p class="font-bold text-green-700" x-text="selectedEnrollment?.section?.name || 'N/A'"></p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gray-50 text-right">
                <button @click="viewModal = false" class="px-6 py-2 bg-gray-200 rounded-lg font-bold text-gray-700 hover:bg-gray-300 transition">Close</button>
            </div>
        </div>
    </div>

</body>
</html>