<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Enrollment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js for Modal and Logic --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar.registrar')

    {{-- Main Content --}}
    <main class="flex-1 p-8" x-data="{ open: false, viewModal: false, type: 'new', selectedEnrollment: null, searchQuery: '', statusFilter: 'all' }">
        <div class="space-y-6">

{{-- Header Section --}}
<div class="flex justify-between items-center mb-6">

    <!-- Title -->
    <h1 class="text-2xl font-bold text-gray-800">
        Enrollment Management
    </h1>

    <!-- Button + Dropdown -->
    <div x-data="{ openMenu: false }" class="relative">
        <button 
            @click="openMenu = !openMenu"
            class="bg-[#057E2E] text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-[#046625] transition">
            + New Enrollment
        </button>

        <!-- Dropdown -->
        <div 
            x-show="openMenu"
            @click.away="openMenu = false"
            x-transition
            class="absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">

            <a href="{{ route('registrar.enrollment.create', ['type' => 'new']) }}"
               class="block px-4 py-3 text-sm font-semibold hover:bg-gray-50 border-b">
                New Student
            </a>

            <button 
                @click="open = true; type = 'returning'; openMenu = false"
                class="w-full text-left px-4 py-3 text-sm font-semibold hover:bg-gray-50">
                Returning Student
            </button>
        </div>
    </div>

</div>

 
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach ($stats as $label => $value)
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">{{ $label }}</p>
                        <p class="text-2xl font-black text-gray-900">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
@foreach($enrollments as $enrollment)
<tr>
    <td class="px-6 py-4">{{ $enrollment->admission->studentFirstName }} {{ $enrollment->admission->studentLastName }}</td>
    <td class="px-6 py-4">{{ ucfirst($enrollment->enrollment_type) }}</td>
    <td class="px-6 py-4">{{ $enrollment->admission->year_level }}</td>
    <td class="px-6 py-4">{{ $enrollment->admission->parentFirstName }} {{ $enrollment->admission->parentLastName }}</td>
    <td class="px-6 py-4">
        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
            {{ ucfirst($enrollment->status) }}
        </span>
    </td>
    <td class="px-6 py-4">
        </td>
</tr>
@endforeach
            {{-- Search & Filter --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="relative flex-1 w-full">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65" stroke="currentColor" stroke-width="2"></line>
                    </svg>
                    <input type="text" placeholder="Search by name or ID..." x-model="searchQuery" class="pl-9 w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-[#057E2E] outline-none">
                </div>
                <select x-model="statusFilter" class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-[#057E2E]">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
<table class="w-full text-left">
    <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Student Name</th>
            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Type</th>
            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Grade</th>
            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Guardian Name</th>
            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Status</th>
            <th class="p-4 text-xs font-bold text-gray-500 uppercase text-right">Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($enrollments as $e)
           <tr class="hover:bg-gray-50 transition"
            x-show="(
                statusFilter === 'all' || statusFilter === '{{ $e->status }}'
            ) && (
                '{{ $e->studentFirstName }} {{ $e->studentLastName }}'.toLowerCase().includes(searchQuery.toLowerCase()) ||
                '{{ $e->studentNumber ?? '' }}'.toLowerCase().includes(searchQuery.toLowerCase())
            )"
        >

                {{-- Student Name + Number --}}
                <td class="p-4">
                    <p class="font-medium text-gray-900">{{ $e->studentFirstName }} {{ $e->studentLastName }}</p>
                    <p class="text-xs text-gray-400 mt-1"> {{ $e->studentNumber ?? 'N/A' }}</p>
                </td>

                {{-- Enrollment Type --}}
                <td class="p-4">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold
                        {{ $e->enrollment_type === 'returning' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($e->enrollment_type) }}
                    </span>
                </td>

                {{-- Grade --}}
                <td class="p-4 text-gray-600">{{ $e->year_level }}</td>

                {{-- Guardian Name --}}
                <td class="p-4 font-medium text-gray-900">{{ $e->parentFirstName }} {{ $e->parentLastName }}</td>

                {{-- Status --}}
                <td class="p-4">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold
                        {{ $e->status === 'approved' ? 'bg-green-100 text-green-700' : ($e->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($e->status) }}
                    </span>
                </td>

                {{-- Actions --}}
                <td class="p-4 text-right flex justify-end gap-2">
                    <button @click="selectedEnrollment = {{ json_encode($e) }}; viewModal = true"
                        class="text-[#057E2E] font-bold hover:underline flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View
                    </button>

                    @if($e->status === 'pending')
                        <form action="{{ route('registrar.enrollment.update', $e->id) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit"
                                class="bg-green-50 text-green-700 p-2 rounded-lg hover:bg-green-100 transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg> Approve
                            </button>
                        </form>
                        <form action="{{ route('registrar.enrollment.update', $e->id) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit"
                                class="bg-red-50 text-red-700 p-2 rounded-lg hover:bg-red-100 transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg> Reject
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="p-12 text-center text-gray-400">No enrollment records found.</td></tr>
        @endforelse
    </tbody>
</table>


            </div>
    </main>

</body>
</html>
