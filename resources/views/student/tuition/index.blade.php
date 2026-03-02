<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student | My Tuition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50 text-gray-900" x-data="{ showSubmitModal: false }">
    @include('student.layouts.sidebar')

    <main class="flex-1 p-8">
        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight">My Tuition</h1>
                <p class="text-gray-500 mt-1 font-medium">Track your payments and pending approvals.</p>
            </div>
            <button @click="showSubmitModal = true" class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800 transition shadow-lg font-bold flex items-center gap-2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                Submit Payment
            </button>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Total Assessment</h3>
                <p class="text-3xl font-black text-gray-800 mt-1">₱{{ number_format($totalAssessment, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-green-500 font-bold uppercase text-[10px] tracking-widest">Total Paid</h3>
                <p class="text-3xl font-black text-green-600 mt-1">₱{{ number_format($totalPaid, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-red-500 font-bold uppercase text-[10px] tracking-widest">Remaining Balance</h3>
                <p class="text-3xl font-black text-red-600 mt-1">₱{{ number_format(max(0, $totalAssessment - $totalPaid), 2) }}</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Amount</th>
                            <th class="px-6 py-4 text-left">Reference No.</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-left">Remarks / Feedback</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white text-xs font-bold uppercase">
                        @forelse($tuitions as $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-600">{{ $p->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-gray-900">₱{{ number_format($p->amount, 2) }}</td>
                            <td class="px-6 py-4 font-mono text-blue-600">{{ $p->reference_number }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] 
                                    {{ $p->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($p->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700') }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($p->status === 'rejected' && $p->remarks)
                                    <div class="bg-red-50 text-red-600 p-2 rounded-lg text-[10px] border border-red-100">
                                        <strong>REASON:</strong> {{ $p->remarks }}
                                    </div>
                                @elseif($p->status === 'completed' || $p->status === 'approved')
                                    <span class="text-green-600">Payment Credited</span>
                                @else
                                    <span class="text-gray-400 italic">Awaiting Verification</span>
                                @endif
                            </td>
                           <td class="px-6 py-4 text-center">
                            {{-- Check the column where the image path actually exists --}}
                            @if(!empty($p->receipt_path))
                                <a href="{{ route('payments.receipt.view', ['filename' => basename($p->receipt_path)]) }}" 
                                target="_blank"
                                class="text-blue-600 hover:underline font-black text-[10px]">
                                    VIEW RECEIPT
                                </a>
                            @else
                                <span class="text-gray-300 italic">No File</span>
                            @endif
                        </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">No payment history found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t">{{ $tuitions->links() }}</div>
        </div>

        {{-- Submit Modal --}}
        <div x-show="showSubmitModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8" @click.away="showSubmitModal = false">
                <h2 class="text-2xl font-black mb-6 uppercase">Submit Payment</h2>
                <form action="{{ route('student.tuition.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Payment Method</label>
                        <select name="payment_method" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold bg-gray-50" required>
                            <option value="GCash">GCash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Amount Paid (₱)</label>
                        <input type="number" name="amount" step="0.01" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Reference Number</label>
                        <input type="text" name="reference_number" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Payment Proof (JPG/PNG)</label>
                        <input type="file" name="payment_proof" accept="image/*" class="w-full text-xs" required>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="showSubmitModal = false" class="flex-1 px-4 py-3 bg-gray-100 rounded-xl font-black text-xs uppercase text-gray-500">Cancel</button>
                        <button type="submit" class="flex-1 px-4 py-3 bg-green-700 text-white rounded-xl font-black text-xs uppercase hover:bg-green-800 transition">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>