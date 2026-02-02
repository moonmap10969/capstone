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
                        <th class="px-4 py-2 text-left">Grade</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y bg-white">
                    @forelse($admissions as $admission)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 font-mono text-xs text-gray-500">{{ $admission->id }}</td>
                            <td class="px-4 py-2 font-medium">{{ $admission->studentFirstName }}</td>
                            <td class="px-4 py-2 font-medium">{{ $admission->studentLastName }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $admission->year_level }}</td> 
                            <td class="px-4 py-2 text-gray-600">{{ $admission->email }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-1 rounded-lg text-xs font-bold uppercase {{ $admission->status === 'approved' ? 'bg-green-100 text-green-700' : ($admission->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ $admission->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button onclick="openDocModal({
                                            report_card: '{{ asset('storage/' . $admission->report_card) }}',
                                            birth_certificate: '{{ asset('storage/' . $admission->birth_certificate) }}',
                                            applicant_photo: '{{ asset('storage/' . $admission->applicant_photo) }}',
                                            father_photo: '{{ asset('storage/' . $admission->father_photo) }}',
                                            mother_photo: '{{ asset('storage/' . $admission->mother_photo) }}',
                                            guardian_photo: '{{ asset('storage/' . $admission->guardian_photo) }}',
                                            transferee_docs: '{{ asset('storage/' . $admission->transferee_docs) }}'
                                        }, '{{ $admission->id }}')" class="p-1.5 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" title="View Documents">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </button>

                                    @if($admission->status === 'pending')
                                        <form action="{{ route('admin.admissions.approve', $admission->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="p-1.5 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition" title="Approve">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.admissions.reject', $admission->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to reject this application?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="p-1.5 rounded-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition" title="Reject">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">No admissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">{{ $admissions->links() }}</div>
    </main>

    {{-- MODAL FOR DOCUMENT SUBMISSIONS --}}
    <div id="docModal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-6xl w-full max-h-[90vh] flex flex-col overflow-hidden">
            <div class="p-4 border-b flex justify-between items-center bg-gray-50">
                <h3 class="text-xl font-bold text-gray-800 uppercase tracking-wide">Submitted Documents</h3>
                <button onclick="closeDocModal()" class="text-gray-400 hover:text-red-600 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto grid grid-cols-1 md:grid-cols-3 gap-6 bg-white">
                @php 
                    $fields = [
                        'report_card' => 'Report Card', 
                        'birth_certificate' => 'Birth Certificate', 
                        'applicant_photo' => 'Applicant Photo', 
                        'father_photo' => 'Father Photo', 
                        'mother_photo' => 'Mother Photo', 
                        'guardian_photo' => 'Guardian Photo', 
                        'transferee_docs' => 'Transferee Docs'
                    ]; 
                @endphp

                @foreach($fields as $id => $label)
                    <div class="space-y-2 p-3 border rounded-lg bg-gray-50 shadow-sm">
                        <p class="font-bold text-xs text-gray-600 uppercase">{{ $label }}</p>
                        <div class="relative group flex items-center justify-center min-h-[220px] bg-white border rounded-lg overflow-hidden">
                            <img id="img_{{ $id }}" src="" class="hidden w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                            <div id="null_{{ $id }}" class="flex flex-col items-center text-gray-400 p-4 text-center">
                                <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-xs italic font-medium">Image not available</span>
                            </div>
                            <div id="actions_{{ $id }}" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hidden">
                                <a id="view_{{ $id }}" href="" target="_blank" class="bg-white p-3 rounded-full text-blue-600 hover:scale-110 shadow-lg" title="Enlarge">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                </a>
                                <a id="dl_{{ $id }}" href="" download class="bg-white p-3 rounded-full text-green-600 hover:scale-110 shadow-lg" title="Download">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 border-t bg-gray-50 flex justify-between items-center shadow-inner">
                <form id="rejectForm" method="POST" onsubmit="return confirm('Are you sure you want to reject this application?')">
                    @csrf @method('PATCH')
                    
                </form>
            
            </div>
        </div>
    </div>

    <script>
        const filterInput = document.getElementById('filterInput');
        const gradeFilter = document.getElementById('gradeFilter');
        const tableRows = document.querySelectorAll('tbody tr:not(:last-child)');

        function filterRows() {
            const text = filterInput.value.toLowerCase();
            const selectedGrade = gradeFilter.value;
            tableRows.forEach(row => {
                const firstName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                const lastName = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                const gradeCell = row.querySelector('td:nth-child(4)')?.textContent || '';
                const matchesText = (firstName + ' ' + lastName).includes(text);
                const matchesGrade = selectedGrade === '' || gradeCell === selectedGrade;
                row.style.display = matchesText && matchesGrade ? '' : 'none';
            });
        }
        filterInput.addEventListener('input', filterRows);
        gradeFilter.addEventListener('change', filterRows);

        function openDocModal(docs, admissionId) {
            const fields = ['report_card', 'birth_certificate', 'applicant_photo', 'father_photo', 'mother_photo', 'guardian_photo', 'transferee_docs'];
            document.getElementById('rejectForm').action = `/admin/admissions/${admissionId}/reject`;

            fields.forEach(field => {
                const img = document.getElementById('img_' + field);
                const placeholder = document.getElementById('null_' + field);
                const actions = document.getElementById('actions_' + field);
                const url = docs[field];

                if (url && !url.endsWith('/storage/') && !url.includes('/storage/null')) {
                    img.src = url;
                    document.getElementById('view_' + field).href = url;
                    document.getElementById('dl_' + field).href = url;
                    img.classList.remove('hidden');
                    actions.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                } else {
                    img.classList.add('hidden');
                    actions.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                }
            });

            document.getElementById('docModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDocModal() {
            document.getElementById('docModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>