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
<body class="min-h-screen flex bg-gray-100" x-data="{ open: false, viewModal: false, selectedEnrollment: null, searchQuery: '', statusFilter: 'all', typeFilter: 'all' }">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 p-8 overflow-y-auto">
<div class="max-w-[1600px] mx-auto space-y-8">
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Enrollment Management</h1>
                    <p class="text-gray-500 text-sm mt-1">Manage student enrollments and academic records.</p>
                </div>

                <div x-data="{ openMenu: false }" class="relative">
                    <a href="{{ route('registrar.enrollment.create', ['type' => 'new']) }}"
                    class="bg-[#057E2E] text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-green-900/20 hover:bg-[#046625] transition-all active:scale-95 inline-block">
                    + New Enrollment
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <p class="text-gray-400 text-xs uppercase font-black tracking-widest">Total Enrollments</p>
                    <p class="text-3xl font-black text-gray-900 mt-2">{{ $stats->total_enrollments }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <p class="text-gray-400 text-xs uppercase font-black tracking-widest">Pending Requests</p>
                    <p class="text-3xl font-black text-yellow-600 mt-2">{{ $stats->pending_requests }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <p class="text-gray-400 text-xs uppercase font-black tracking-widest">New This Week</p>
                    <p class="text-3xl font-black text-blue-600 mt-2">{{ $stats->new_this_week }}</p>
                </div>
            </div>

            {{-- Search & Filter Row --}}
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200 flex flex-col lg:flex-row gap-4">
                <div class="relative flex-1">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Search name or ID..." x-model="searchQuery" 
                        class="pl-11 w-full border-gray-200 border bg-gray-50/50 p-3 rounded-xl focus:ring-4 focus:ring-green-500/10 focus:border-[#057E2E] outline-none transition-all">
                </div>
                
                <div class="flex flex-wrap items-center gap-3">
                    <select name="academic_year" class="border-gray-200 border bg-gray-50/50 rounded-xl p-3 min-w-[180px] focus:ring-4 focus:ring-green-500/10 focus:border-[#057E2E] font-bold text-gray-600 transition-all outline-none" onchange="window.location.href='?academic_year='+this.value">
                        <option value="">All Academic Years</option>
                        @foreach($academicYears as $ay)
                            <option value="{{ $ay->id }}" {{ request('academic_year') == $ay->id ? 'selected' : '' }}>
                                {{ $ay->year_range }} ({{ $ay->semester }})
                            </option>
                        @endforeach
                    </select>
                    
                    <select x-model="typeFilter" class="border-gray-200 border bg-gray-50/50 rounded-xl p-3 w-full sm:w-36 font-semibold text-gray-600 outline-none focus:border-[#057E2E]">
                        <option value="all">All Types</option>
                        <option value="new">New</option>
                        <option value="returning">Returning</option>
                    </select>
                    
                    <select x-model="statusFilter" class="border-gray-200 border bg-gray-50/50 rounded-xl p-3 w-full sm:w-36 font-semibold text-gray-600 outline-none focus:border-[#057E2E]">
                        <option value="all">All Status</option>
                        <option value="enrolled">Enrolled</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50 border-b border-gray-200 text-[11px] font-black text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-6 py-5">Student Name</th>
                            <th class="px-6 py-5 text-center">Academic Year</th>
                            <th class="px-6 py-5">Type</th>
                            <th class="px-6 py-5">Section / Grade</th>
                            <th class="px-6 py-5">Status</th>
                            <th class="px-6 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($enrollments as $e)
                        <tr class="hover:bg-green-50/30 transition-colors" 
                            x-show="(statusFilter === 'all' || statusFilter === '{{ $e->status }}') && 
                                    (typeFilter === 'all' || typeFilter === '{{ $e->student_type }}') &&
                                    ('{{ $e->admission->studentFirstName ?? '' }} {{ $e->admission->studentLastName ?? '' }}'.toLowerCase().includes(searchQuery.toLowerCase()) || 
                                     '{{ $e->studentNumber ?? '' }}'.toLowerCase().includes(searchQuery.toLowerCase()))">
                            
                            <td class="px-6 py-5">
                                <p class="font-bold text-gray-900">{{ $e->admission->studentFirstName ?? 'N/A' }} {{ $e->admission->studentLastName ?? '' }}</p>
                                <p class="text-xs font-mono text-gray-400 mt-0.5 tracking-tighter">{{ $e->studentNumber }}</p>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <p class="text-sm font-black text-gray-700">{{ $e->admission->academicYear->year_range ?? 'N/A' }}</p>
                                <p class="text-[9px] text-gray-400 uppercase font-black tracking-widest">{{ $e->admission->academicYear->semester ?? '' }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $e->student_type === 'new' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                    {{ $e->student_type ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm font-bold text-gray-700">{{ $e->section->name ?? 'Unassigned' }}</p>
                                <p class="text-[10px] text-gray-400 uppercase font-bold">{{ $e->year_level }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wide
                                    {{ $e->status === 'enrolled' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($e->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <button @click="selectedEnrollment = {{ json_encode($e->load('admission', 'section')) }}; viewModal = true"
                                    class="bg-gray-50 text-[#057E2E] p-2 px-4 rounded-xl font-black text-xs hover:bg-[#057E2E] hover:text-white transition-all inline-flex items-center gap-2 border border-gray-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg> DETAILS
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="p-20 text-center text-gray-400 font-medium italic">No enrollment records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-6 bg-gray-50/50 border-t border-gray-100">
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </main>

    {{-- Detail Modal --}}
    <div x-show="viewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="viewModal = false"></div>
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl relative z-10" @click.away="viewModal = false">
            <div class="p-8 bg-[#057E2E] text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-green-200 text-[10px] font-black uppercase tracking-widest mb-1">Student Record</p>
                        <h3 class="text-2xl font-black tracking-tight">Enrollment Details</h3>
                    </div>
                    <button @click="viewModal = false" class="bg-white/10 hover:bg-white/20 p-2 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="p-8 space-y-6" x-show="selectedEnrollment">
                <div class="grid grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Academic Period</p>
                        <p class="font-bold text-gray-900" x-text="selectedEnrollment?.admission?.academic_year?.year_range + ' (' + selectedEnrollment?.admission?.academic_year?.semester + ')'"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Student Name</p>
                        <p class="font-bold text-gray-900" x-text="selectedEnrollment?.admission?.studentFirstName + ' ' + selectedEnrollment?.admission?.studentLastName"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Student Type</p>
                        <p class="font-black uppercase text-xs" :class="selectedEnrollment?.student_type === 'new' ? 'text-blue-600' : 'text-purple-600'" x-text="selectedEnrollment?.student_type || 'N/A'"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Section</p>
                        <p class="font-bold text-green-700" x-text="selectedEnrollment?.section?.name || 'N/A'"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Status</p>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-gray-100 text-gray-800" x-text="selectedEnrollment?.status"></span>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-gray-50 flex justify-end gap-3">
                <button @click="viewModal = false" class="px-8 py-3 bg-white border border-gray-200 rounded-xl font-black text-xs text-gray-600 hover:bg-gray-50 transition-all">CLOSE</button>
            </div>
        </div>
    </div>

</body>
</html>