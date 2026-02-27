<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student | My Tuition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        .modal-active { overflow: hidden; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50 text-gray-900">
    @include('student.layouts.sidebar')

    <main class="flex-1 p-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">My Tuition</h1>
                <p class="text-gray-500 mt-1 font-medium">Manage your billing and track payments.</p>
            </div>
            <div class="flex gap-3">
                <div class="relative">
                    <input type="text" id="tableSearch" placeholder="Search logs..." class="pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none shadow-sm transition-all w-64">
                    <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <button onclick="toggleModal('submitModal', true)" class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800 transition shadow-lg font-bold flex items-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Submit Payment
                </button>
            </div>
        </div>

    {{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    {{-- Total Assessment Card --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
        <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Total Assessment</h3>
        <p class="text-3xl font-black text-gray-800 mt-1">₱{{ number_format($totalAssessment, 2) }}</p>
    </div>

    {{-- Total Paid Card --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
        <h3 class="text-green-500 font-bold uppercase text-[10px] tracking-widest">Total Paid</h3>
        <p class="text-3xl font-black text-green-600 mt-1">₱{{ number_format($totalPaid, 2) }}</p>
    </div>

    {{-- Remaining Balance Card --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
        <h3 class="text-red-500 font-bold uppercase text-[10px] tracking-widest">Remaining Balance</h3>
        <p class="text-3xl font-black text-red-600 mt-1">₱{{ number_format(max(0, $totalAssessment - $totalPaid), 2) }}</p>
    </div>
</div>

        {{-- Payment Logs Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <span class="font-black text-gray-700 uppercase text-xs tracking-widest">Payment History</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="paymentTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-wider">Reference No.</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        {{-- Cashier Verified Payments --}}
                        @foreach($cashierPayments as $cp)
                        <tr class="hover:bg-gray-50 transition border-l-4 border-l-green-500">
                            <td class="px-6 py-4 text-sm font-medium">
                                {{ $cp->created_at ? $cp->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-green-700">₱{{ number_format($cp->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-semibold">Walk-in (Cashier)</td>
                            <td class="px-6 py-4 text-sm font-mono font-bold text-gray-400">{{ $cp->reference_number ?? 'OFFICE_RCPT' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">Official</span>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-300 text-xs italic">Verified</td>
                        </tr>
                        @endforeach

                        {{-- Online Submissions --}}
                        @forelse($tuitions as $tuition)
                        <tr class="hover:bg-gray-50 transition searchable-row">
                            <td class="px-6 py-4 text-sm font-medium text-gray-600">
                                {{ $tuition->created_at ? $tuition->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">₱{{ number_format($tuition->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $tuition->payment_method }}</td>
                            <td class="px-6 py-4 text-sm font-mono font-bold text-blue-600">{{ $tuition->reference_number }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $status = strtolower($tuition->status ?? 'pending');
                                    $color = match($status) {
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'approved' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp
                                <span class="px-3 py-1 {{ $color }} rounded-full text-[10px] font-black uppercase">{{ $tuition->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openPreview('{{ asset('storage/' . $tuition->payment_proof) }}')" class="text-blue-600 hover:text-blue-800 font-black text-[10px] uppercase underline">View Receipt</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400 italic text-sm">No payment records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100">{{ $tuitions->links() }}</div>
        </div>

        {{-- SUBMIT MODAL --}}
        <div id="submitModal" class="fixed inset-0 bg-black/60 hidden z-50 items-center justify-center p-4 backdrop-blur-sm">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-black text-gray-900">Submit Payment</h2>
                    <button onclick="toggleModal('submitModal', false)" class="text-gray-400 hover:text-red-500 font-bold text-2xl">&times;</button>
                </div>
                <form action="{{ route('student.tuition.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Method</label>
                            <select name="payment_method" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold bg-gray-50" required>
                                <option value="GCash">GCash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Type</label>
                            <select name="amount_type" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold bg-gray-50" required>
                                <option value="Partial">Partial</option>
                                <option value="Full">Full</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Amount Paid (₱)</label>
                        <input type="number" name="amount" step="0.01" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold" placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Reference Number</label>
                        <input type="text" name="reference_number" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold" placeholder="Transaction ID" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Payment Proof</label>
                        <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs py-2" required>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="toggleModal('submitModal', false)" class="flex-1 px-4 py-3 bg-gray-100 rounded-xl font-black text-xs uppercase text-gray-500">Cancel</button>
                        <button type="submit" class="flex-1 px-4 py-3 bg-green-700 text-white rounded-xl font-black text-xs uppercase hover:bg-green-800 transition">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- PREVIEW MODAL --}}
        <div id="previewModal" class="fixed inset-0 bg-black/90 hidden z-[60] items-center justify-center p-4 backdrop-blur-md">
            <div class="bg-white rounded-2xl w-full max-w-4xl h-[85vh] flex flex-col overflow-hidden shadow-2xl">
                <div class="p-4 border-b flex justify-between items-center bg-gray-50">
                    <span class="text-xs font-black uppercase text-gray-500 tracking-widest">Receipt Preview</span>
                    <button onclick="toggleModal('previewModal', false)" class="text-red-600 font-black px-4 py-1.5 rounded-lg">&times; Close</button>
                </div>
                <div class="flex-1 bg-gray-200 relative overflow-hidden">
                    <iframe id="receiptFrame" class="w-full h-full border-none hidden"></iframe>
                    <div id="imageContainer" class="w-full h-full hidden p-6 overflow-auto">
                        <img id="receiptImage" src="" class="max-w-full max-h-full rounded-lg shadow-2xl mx-auto object-contain">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleModal(id, show) {
            const modal = document.getElementById(id);
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('modal-active');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('modal-active');
            }
        }

        function openPreview(url) {
            const frame = document.getElementById('receiptFrame');
            const imgCont = document.getElementById('imageContainer');
            const img = document.getElementById('receiptImage');
            
            frame.classList.add('hidden');
            imgCont.classList.add('hidden');
            imgCont.classList.remove('flex', 'items-center', 'justify-center');

            if (url.toLowerCase().endsWith('.pdf')) {
                frame.src = url;
                frame.classList.remove('hidden');
            } else {
                img.src = url;
                imgCont.classList.remove('hidden');
                imgCont.classList.add('flex', 'items-center', 'justify-center');
            }
            toggleModal('previewModal', true);
        }

        document.getElementById('tableSearch').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.searchable-row');
            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>