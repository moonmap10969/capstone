<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Admissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100 font-sans">


 {{-- Sidebar --}}
    @include('layouts.sidebar.admissions')
    
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Admissions Management</h1>
           <a href="{{ route('admissions.create') }}">Create Admission</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded mb-6 shadow-sm">{{ session('success') }}</div>
        @endif

        {{-- Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border-b-4 border-yellow-500 p-6 rounded-xl shadow-sm text-center">
                <p class="text-xs font-bold text-gray-500 uppercase">Pending</p>
                <p class="text-3xl font-black text-gray-800">{{ $totalPendingApprovals }}</p>
            </div>
            <div class="bg-white border-b-4 border-green-500 p-6 rounded-xl shadow-sm text-center">
                <p class="text-xs font-bold text-gray-500 uppercase">Approved</p>
                <p class="text-3xl font-black text-gray-800">{{ $totalApproved }}</p>
            </div>
            <div class="bg-white border-b-4 border-red-500 p-6 rounded-xl shadow-sm text-center">
                <p class="text-xs font-bold text-gray-500 uppercase">Rejected</p>
                <p class="text-3xl font-black text-gray-800">{{ $totalRejected }}</p>
            </div>
            <div class="bg-white border-b-4 border-blue-500 p-6 rounded-xl shadow-sm text-center">
                <p class="text-xs font-bold text-gray-500 uppercase">Total Registered</p>
                <p class="text-3xl font-black text-gray-800">{{ $totalStudentsRegistered }}</p>
            </div>
        </div>

        {{-- Filters --}}
        <div class="mb-6 flex flex-wrap gap-4 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <input type="text" id="filterInput" placeholder="Search by student name..."
                   class="flex-1 min-w-[300px] border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none">
            <select id="gradeFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none">
                <option value="">All Grade Levels</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade }}">{{ $grade }}</option>
                @endforeach
            </select>
        </div>

        {{-- Table --}}
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold border-b">
                    <tr>
                        <th class="px-6 py-4">Student Name</th>
                        <th class="px-6 py-4 text-center">Grade</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($admissions as $admission)
                        <tr class="hover:bg-green-50/50 transition">
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $admission->studentFirstName }} {{ $admission->studentLastName }}</td>
                            <td class="px-6 py-4 text-center text-gray-600">{{ $admission->year_level }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $admission->email }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    {{ $admission->status === 'approved' ? 'bg-green-100 text-green-700' : ($admission->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ $admission->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="viewAdmission({{ json_encode($admission) }}, '{{ asset('storage/') }}')" 
                                        class="px-4 py-1.5 bg-green-600 text-white rounded-md text-xs font-bold hover:bg-yellow-500 transition">
                                    Review Application
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-16 text-center text-gray-400">No records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $admissions->links() }}</div>
    </main>

    {{-- VIEW MODAL --}}
    <div id="viewModal" class="hidden fixed inset-0 bg-slate-900/80 z-[100] flex items-center justify-center p-6 backdrop-blur-md">
        <div class="bg-white rounded-3xl shadow-2xl max-w-6xl w-full max-h-[95vh] flex flex-col overflow-hidden">
            <div class="p-6 border-b bg-white flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black text-gray-800">Application Review</h2>
                    <p class="text-sm text-gray-500 font-medium" id="modalSubheader"></p>
                </div>
                <button onclick="closeViewModal()" class="text-gray-300 hover:text-red-500 text-4xl">&times;</button>
            </div>

            <div class="flex-1 overflow-y-auto p-8 bg-gray-50/50">
                {{-- Data Sections --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 border-b pb-2">Student & Address</h3>
                    <div id="studentDetails" class="grid grid-cols-2 gap-4">
                        {{-- This content is populated by the viewAdmission JS function --}}
                    </div>
                    <div class="mt-4 pt-4 border-t grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Date of Birth</p>
                            <p id="dobDetail" class="font-bold text-gray-800 text-sm"></p>
                        </div>
                        <div class="col-span-1">
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Residential Address</p>
                            <p id="addressDetail" class="font-bold text-gray-800 text-sm"></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-green-700 uppercase tracking-widest mb-4 border-b pb-2">Parent/Guardian Contact</h3>
                    <div id="guardianDetails" class="grid grid-cols-2 gap-4"></div>
                </div>
            </div>

                {{-- Document Sections --}}
                <h3 class="text-xs font-black text-green-700 uppercase tracking-widest mb-4">Core Documents</h3>
                <div id="coreDocGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8"></div>

                <h3 class="text-xs font-black text-green-700 uppercase tracking-widest mb-4">Family Photos</h3>
                <div id="familyDocGrid" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8"></div>

                {{-- Action Buttons --}}
                <div id="modalActions" class="flex gap-4 border-t pt-8 mt-4"></div>
            </div>
        </div>
    </div>

    <script>

  
const filterInput = document.getElementById('filterInput');
const gradeFilter = document.getElementById('gradeFilter');

function performFilter() {
    const searchTerm = filterInput.value.toLowerCase();
    const selectedGrade = gradeFilter.value.toLowerCase();
    
    document.querySelectorAll('tbody tr').forEach(row => {
        const rowText = row.innerText.toLowerCase();
        const gradeCell = row.cells[1].innerText.toLowerCase(); 
        
        const matchesSearch = rowText.includes(searchTerm);
        const matchesGrade = selectedGrade === "" || gradeCell.trim() === selectedGrade;
        
        row.style.display = (matchesSearch && matchesGrade) ? '' : 'none';
    });
}

filterInput.addEventListener('input', performFilter);
gradeFilter.addEventListener('change', performFilter);
        function viewAdmission(data, storageUrl) {
            document.getElementById('modalSubheader').innerText = `Admission ID: ${data.id}`;
            document.getElementById('addressDetail').innerText = data.address || 'No address provided';
            document.getElementById('dobDetail').innerText = data.dateOfBirth || 'Not Provided';

            document.getElementById('studentDetails').innerHTML = `
                <div><p class="text-[10px] text-gray-400 font-bold uppercase">Name</p><p class="font-bold text-gray-800">${data.studentFirstName} ${data.studentLastName}</p></div>
                <div><p class="text-[10px] text-gray-400 font-bold uppercase">Grade</p><p class="font-bold text-gray-800">${data.year_level}</p></div>
            `;

            document.getElementById('guardianDetails').innerHTML = `
                <div class="col-span-2"><p class="text-[10px] text-gray-400 font-bold uppercase">Primary Guardian</p><p class="font-bold text-gray-800">${data.parentFirstName} ${data.parentLastName}</p></div>
                <div><p class="text-[10px] text-gray-400 font-bold uppercase">Phone</p><p class="font-bold text-gray-800">${data.phone}</p></div>
                <div><p class="text-[10px] text-gray-400 font-bold uppercase">Email</p><p class="font-bold text-gray-800 text-xs">${data.email}</p></div>
            `;

            // Helper to generate doc blocks
            const generateDocBlock = (name, path) => {
                if(path) {
                    const url = `${storageUrl}/${path}`;
                    return `
                        <div class="bg-white p-3 rounded-xl border border-gray-200 shadow-sm text-center">
                            <p class="text-[9px] font-black text-gray-400 uppercase mb-2">${name}</p>
                            <a href="${url}" target="_blank"><img src="${url}" class="h-28 w-full object-cover rounded mb-3 border"></a>
                            <a href="${url}" download class="block py-1 bg-gray-100 text-gray-600 text-[10px] font-bold rounded hover:bg-gray-200">DOWNLOAD</a>
                        </div>`;
                }
                return `<div class="bg-gray-100 p-3 rounded-xl border border-dashed flex flex-col items-center justify-center min-h-[160px] text-gray-400 text-[10px] italic">No ${name}</div>`;
            };

            // CORE DOCUMENTS
            document.getElementById('coreDocGrid').innerHTML = 
                generateDocBlock('Report Card', data.report_card) +
                generateDocBlock('Birth Cert', data.birth_certificate) +
                generateDocBlock('Applicant Photo', data.applicant_photo) +
                generateDocBlock('Transferee Docs', data.transferee_docs);

            // FAMILY PHOTOS
            document.getElementById('familyDocGrid').innerHTML = 
                generateDocBlock('Father Photo', data.father_photo) +
                generateDocBlock('Mother Photo', data.mother_photo) +
                generateDocBlock('Guardian Photo', data.guardian_photo);

            // ACTIONS
            let actionHtml = '';
            if(data.status === 'pending') {
                actionHtml = `
                    <form action="/admissions/admissions/${data.id}/approve" method="POST" class="flex-1">@csrf @method('PATCH')
                        <button class="w-full bg-green-600 text-white py-3 rounded-xl font-bold hover:bg-green-700 transition">APPROVE APPLICATION</button>
                    </form>
                    <form action="/admissions/admissions/${data.id}/reject" method="POST" class="flex-1">@csrf @method('PATCH')
                        <button class="w-full bg-red-50 text-red-600 py-3 rounded-xl font-bold hover:bg-red-100 transition">REJECT APPLICATION</button>
                    </form>`;
            } else {
                actionHtml = `<div class="w-full text-center p-4 bg-gray-100 rounded-xl font-bold text-gray-500 uppercase">Application ${data.status}</div>`;
            }
            document.getElementById('modalActions').innerHTML = actionHtml;

            document.getElementById('viewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>