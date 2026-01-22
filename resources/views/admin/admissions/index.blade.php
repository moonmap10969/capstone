<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Admissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen flex bg-gray-100" x-data="{ docModal: false, activeDocs: {} }">

    @include('admin.admissions.layouts.sidebar')

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
                <p class="text-sm text-green-100">Total Pending</p>
                <p class="text-2xl font-bold">{{ $totalPendingApprovals }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm text-green-100">Total Approved</p>
                <p class="text-2xl font-bold">{{ $totalApproved }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm text-green-100">Total Rejected</p>
                <p class="text-2xl font-bold">{{ $totalRejected }}</p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded-xl">
                <p class="text-sm text-green-100">Total Registered</p>
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
            </div>
        </div>

        {{-- Admissions Table --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="table-auto border-collapse w-full text-sm">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">App ID</th>
                        <th class="px-4 py-2 text-left">Student Name</th>
                        <th class="px-4 py-2 text-left">Grade</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-center">Documents</th>
                        <th class="px-4 py-2 text-center">Status Action</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($admissions as $admission)
                        <tr>
                            <td class="px-4 py-2 font-mono text-xs">{{ $admission->application_id }}</td>
                            <td class="px-4 py-2">{{ $admission->student_first_name }} {{ $admission->student_last_name }}</td>
                            <td class="px-4 py-2">{{ $admission->grade_applied }}</td>
                            <td class="px-4 py-2">{{ $admission->email }}</td>
                            
                            {{-- Documents Column --}}
                            <td class="px-4 py-2 text-center">
                                <button 
                                    @click="docModal = true; activeDocs = { bc: '{{ asset('storage/' . $admission->birth_certificate) }}', ir: '{{ asset('storage/' . $admission->immunization_records) }}' }"
                                    class="text-blue-600 hover:text-blue-800 underline flex items-center justify-center gap-1 w-full"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    View Files
                                </button>
                            </td>

                            {{-- Status Dropdown Action --}}
                            <td class="px-4 py-2 text-center">
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <button @click="open = !open" 
                                        class="px-3 py-1 rounded-full text-xs font-bold border transition flex items-center gap-1 mx-auto
                                        {{ $admission->status === 'approved' ? 'bg-green-100 text-green-700 border-green-700' : '' }}
                                        {{ $admission->status === 'rejected' ? 'bg-red-100 text-red-700 border-red-700' : '' }}
                                        {{ $admission->status === 'document_verification' ? 'bg-yellow-100 text-yellow-700 border-yellow-700' : '' }}">
                                        {{ strtoupper(str_replace('_', ' ', $admission->status)) }}
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                                    </button>

                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-xl z-50">
                                        <form action="{{ route('admin.admissions.approve', $admission->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-green-700 hover:bg-green-50">Approve & Issue ID</button>
                                        </form>
                                        <form action="{{ route('admin.admissions.reject', $admission->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Reject Application</button>
                                        </form>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('admin.admissions.show', $admission->id) }}" class="text-blue-600 hover:underline">View</a>
                                <form action="{{ route('admin.admissions.destroy', $admission->id) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">No applications found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $admissions->links() }}</div>
    </main>

{{-- Document Preview Modal --}}
<div x-show="docModal" 
     class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 p-4" 
     x-transition.opacity x-cloak>
    
    <div class="bg-white rounded-xl max-w-7xl w-full max-h-[95vh] overflow-y-auto p-8 shadow-2xl" @click.away="docModal = false">
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h3 class="text-2xl font-bold text-green-800">Review Submitted Documents</h3>
            <button @click="docModal = false" class="text-gray-500 hover:text-red-600 text-4xl">&times;</button>
        </div>

        {{--    Documents --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <template x-for="(src, label) in { 
                'Birth Certificate': activeDocs.bc, 
                'Immunization': activeDocs.ir, 
                'Report Card': activeDocs.rc, 
                'Good Moral': activeDocs.gm 
            }">
                <div class="flex flex-col">
                    <p class="font-bold text-gray-700 mb-3 text-center border-b pb-1" x-text="label"></p>
                    
                    {{-- Image Container --}}
                    <div class="relative group border rounded-lg overflow-hidden bg-gray-50 aspect-[3/4]">
                        <img :src="src" class="w-full h-full object-contain transition duration-300 group-hover:scale-105" />
                        
                        {{-- Hover Overlay for Actions --}}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3">
                            {{-- Enlarge Button (Opens in New Tab) --}}
                            <a :href="src" target="_blank" class="bg-white text-gray-800 px-4 py-2 rounded-full text-sm font-bold shadow hover:bg-green-700 hover:text-white transition">
                                🔍 Enlarge
                            </a>
                            {{-- Save/Download Button --}}
                            <a :href="src" :download="label + '.jpg'" class="bg-green-700 text-white px-4 py-2 rounded-full text-sm font-bold shadow hover:bg-green-800 transition">
                                💾 Save File
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

    {{-- Filter Script --}}
    <script>
        const filterInput = document.getElementById('filterInput');
        const gradeFilter = document.getElementById('gradeFilter');
        const tableRows = document.querySelectorAll('tbody tr');

        function filterRows() {
            const text = filterInput.value.toLowerCase();
            const selectedGrade = gradeFilter.value;

            tableRows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                const gradeCell = row.querySelector('td:nth-child(3)')?.textContent || '';
                const matchesText = name.includes(text);
                const matchesGrade = selectedGrade === '' || gradeCell === selectedGrade;
                row.style.display = matchesText && matchesGrade ? '' : 'none';
            });
        }
        filterInput.addEventListener('input', filterRows);
        gradeFilter.addEventListener('change', filterRows);
    </script>
</body>
</html>