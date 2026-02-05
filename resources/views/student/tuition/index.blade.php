<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student | My Tuition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-50 font-sans">

    {{-- Sidebar --}}
    @include('student.layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">My Tuition</h1>
                <p class="text-gray-500 mt-1">Manage your payments and billing history</p>
            </div>
            <button id="openSubmitModal"
                class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800 transition shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Submit Payment Proof
            </button>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 font-medium">Total Approved Payments</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-1">₱{{ number_format($totalPaid, 2) }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full text-green-700">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 font-medium">Pending Verifications</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $pendingCount }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full text-yellow-700">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment History Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Payment History</h2>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Reference No.</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Proof</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($tuitions as $tuition)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $tuition->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-800">₱{{ number_format($tuition->amount, 2) }}</td>
                        <td class="px-6 py-4 text-sm capitalize text-gray-600">{{ str_replace('_', ' ', $tuition->payment_method) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $tuition->reference_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($tuition->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                            @elseif($tuition->status === 'approved')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Approved</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($tuition->payment_proof)
                                <a href="{{ asset('storage/' . $tuition->payment_proof) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium underline">View File</a>
                            @else
                                <span class="text-gray-400 text-xs">No File</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            No payment records found. Submit your first payment proof using the button above.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-100">
                {{ $tuitions->links() }}
            </div>
        </div>

        {{-- Submit Payment Modal --}}
        <div id="submitModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 transform transition-all scale-95 opacity-0 duration-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Submit Payment Proof</h2>
                
                <form action="{{ route('student.tuition.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" required>
                            <option value="gcash">GCash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash Payment</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Amount Paid</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-400">₱</span>
                            <input type="number" name="amount" step="0.01" class="w-full border rounded-lg pl-8 pr-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="0.00" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Reference Number</label>
                        <input type="text" name="reference_number" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="e.g. GCash Ref No.">
                    </div>

                    <div id="proof-container">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Upload Receipt (Image/PDF)</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        <div id="preview-box" class="mt-2 hidden border rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center p-2">
                            <img id="image-preview" src="#" alt="Preview" class="max-h-40 object-contain hidden">
                            <span id="pdf-preview" class="text-xs text-gray-500 hidden font-medium">PDF Selected</span>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-8">
                        <button type="button" id="closeModal" class="flex-1 px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 font-medium transition">Cancel</button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 font-bold shadow-md transition">Submit Payment</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <script>
        const modal = document.getElementById('submitModal');
        const modalContent = modal.querySelector('div');
        const openBtn = document.getElementById('openSubmitModal');
        const closeBtn = document.getElementById('closeModal');
        const methodSelect = document.getElementById('payment_method');
        const proofInput = document.getElementById('payment_proof');
        const proofContainer = document.getElementById('proof-container');

        // Toggle Modal
        function showModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
            }, 50);
        }

        function hideModal() {
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        openBtn.addEventListener('click', showModal);
        closeBtn.addEventListener('click', hideModal);

        // Hide proof input if 'Cash' is selected
        methodSelect.addEventListener('change', () => {
            if (methodSelect.value === 'cash') {
                proofContainer.style.display = 'none';
                proofInput.required = false;
            } else {
                proofContainer.style.display = 'block';
                proofInput.required = true;
            }
        });

        // Image Preview Logic
        proofInput.onchange = evt => {
            const [file] = proofInput.files;
            const previewBox = document.getElementById('preview-box');
            const imgPreview = document.getElementById('image-preview');
            const pdfPreview = document.getElementById('pdf-preview');

            if (file) {
                previewBox.classList.remove('hidden');
                if (file.type.startsWith('image/')) {
                    imgPreview.src = URL.createObjectURL(file);
                    imgPreview.classList.remove('hidden');
                    pdfPreview.classList.add('hidden');
                } else {
                    imgPreview.classList.add('hidden');
                    pdfPreview.classList.remove('hidden');
                    pdfPreview.innerText = "Selected: " + file.name;
                }
            }
        }
    </script>
</body>
</html>