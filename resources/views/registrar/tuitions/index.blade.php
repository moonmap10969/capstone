<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Tuition Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-50 font-sans">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 p-8">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Tuition Records</h1>
            <button id="openAddModal" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition shadow-md">
                + Add Tuition
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition flex flex-col justify-between">
                <h3 class="text-green-700 font-semibold text-lg">Pending Approvals</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPending }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition flex flex-col justify-between">
                <h3 class="text-green-700 font-semibold text-lg">Partial Payments</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $paymentsPartial }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition flex flex-col justify-between">
                <h3 class="text-green-600 font-semibold text-lg">Payments Completed</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $paymentsCompleted }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition flex flex-col justify-between">
                <h3 class="text-green-700 font-semibold text-lg">Total Students</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalStudents }}</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-white font-medium text-sm">ID</th>
                        <th class="px-6 py-3 text-left text-white font-medium text-sm">Student ID</th>
                        <th class="px-6 py-3 text-left text-white font-medium text-sm">Student Name</th>
                        <th class="px-6 py-3 text-left text-white font-medium text-sm">Amount</th>
                        <th class="px-6 py-3 text-center text-white font-medium text-sm">Status</th>
                        <th class="px-6 py-3 text-left text-white font-medium text-sm">Proof</th>
                        <th class="px-6 py-3 text-center text-white font-medium text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($tuitions as $tuition)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $tuition->id }}</td>
                        <td class="px-6 py-4">{{ $tuition->studentNumber }}</td>
                        <td class="px-6 py-4">{{ $tuition->name }}</td>
                        <td class="px-6 py-4 font-semibold">₱{{ number_format($tuition->amount, 2) }}</td>
                        
                        <td class="px-6 py-4 text-center">
                            @if($tuition->status === 'pending')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('registrar.tuitions.approve', $tuition->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-green-100 text-green-700 p-2 rounded hover:bg-green-600 hover:text-white transition">✓</button>
                                    </form>
                                    <form action="{{ route('registrar.tuitions.reject', $tuition->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-red-100 text-red-700 p-2 rounded hover:bg-red-600 hover:text-white transition">✕</button>
                                    </form>
                                </div>
                            @else
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $tuition->status == 'approved' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ ucfirst($tuition->status) }}
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @if($tuition->payment_proof)
                                <a href="{{ asset('storage/' . $tuition->payment_proof) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600 transition editBtn"
                                data-id="{{ $tuition->id }}" 
                                data-studentNumber="{{ $tuition->studentNumber }}"
                                data-name="{{ $tuition->name }}"
                                data-amount="{{ $tuition->amount }}"
                                data-reference_number="{{ $tuition->reference_number }}"
                                data-payment_method="{{ $tuition->payment_method }}"
                                data-status="{{ $tuition->status }}" 
                                data-payment_type="{{ $tuition->payment_type }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            <form action="{{ route('registrar.tuitions.destroy', $tuition->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 text-white p-2 rounded hover:bg-red-700 transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">No records found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Add Modal --}}
        <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 transform transition-all scale-95 opacity-0">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Add Tuition (Registrar)</h2>
                <form action="{{ route('registrar.tuitions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="text" name="student_id" placeholder="Student ID" class="w-full border rounded-lg px-4 py-2" required>
                    <input type="text" name="student_name" placeholder="Student Name" class="w-full border rounded-lg px-4 py-2" required>
                    <input type="number" step="0.01" name="amount" placeholder="Amount" class="w-full border rounded-lg px-4 py-2" required>
                    <select name="payment_method" class="w-full border rounded-lg px-4 py-2">
                        <option value="gcash">GCash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
                    <input type="file" name="payment_proof" class="text-sm">
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" class="closeMdl px-5 py-2 bg-gray-200 rounded-lg">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-green-700 text-white rounded-lg">Save Record</button>
                    </div>
                </form>
            </div>
        </div>

        @include('registrar.tuitions.edit')

    </main>

    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');

        const openModal = (m) => {
            m.classList.remove('hidden');
            setTimeout(() => m.querySelector('div').classList.remove('scale-95', 'opacity-0'), 10);
        };

        const closeModal = (m) => {
            m.querySelector('div').classList.add('scale-95', 'opacity-0');
            setTimeout(() => m.classList.add('hidden'), 200);
        };

        document.getElementById('openAddModal').onclick = () => openModal(addModal);
        document.querySelectorAll('.closeMdl').forEach(btn => btn.onclick = () => { closeModal(addModal); closeModal(editModal); });

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.onclick = () => {
                const form = document.getElementById('editForm');
                form.action = `/registrar/tuitions/${btn.dataset.id}`;
                
                document.getElementById('edit_studentNumber').value = btn.dataset.studentNumber;
                document.getElementById('edit_name').value = btn.dataset.name;
                document.getElementById('edit_amount').value = btn.dataset.amount;
                document.getElementById('edit_payment_method').value = btn.dataset.payment_method;
                document.getElementById('edit_status').value = btn.dataset.status;
                document.getElementById('edit_payment_type').value = btn.dataset.payment_type;
                document.getElementById('edit_reference_number').value = btn.dataset.reference_number || '';

                openModal(editModal);
            };
        });
    </script>
</body>
</html>