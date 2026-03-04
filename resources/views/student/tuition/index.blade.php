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
<body class="min-h-screen flex bg-gray-50 text-gray-900" x-data="{ showSubmitModal: {{ $errors->any() ? 'true' : 'false' }}, showAssessmentModal: false }">
    @include('student.layouts.sidebar')

    <main class="flex-1 p-8">
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight">My Tuition</h1>
                <p class="text-gray-500 mt-1 font-medium">Track your payments and pending approvals.</p>
            </div>
            @if($activeTuition)
            <button @click="showSubmitModal = true" class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800 transition shadow-lg font-bold flex items-center gap-2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                Submit Payment
            </button>
            @endif
        </div>

        @if($studentTuitions->isNotEmpty())
        <form method="GET" action="{{ route('student.tuition.index') }}" class="mb-6 flex items-center gap-3">
            <label class="text-xs font-bold text-gray-500 uppercase">Academic Year:</label>
            <select name="academic_year_id" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm font-bold bg-white focus:outline-none focus:ring-2 focus:ring-green-500">
                @foreach($studentTuitions as $t)
                    <option value="{{ $t->academic_year_id }}" {{ $selectedYearId == $t->academic_year_id ? 'selected' : '' }}>
                        {{ $t->academicYear->year_range ?? 'Unknown Year' }}
                    </option>
                @endforeach
            </select>
        </form>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative">
                <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Total Assessment</h3>
                <p class="text-3xl font-black text-gray-800 mt-1">₱{{ number_format($totalAssessment, 2) }}</p>
                @if($activeTuition)
                    <button @click="showAssessmentModal = true" class="absolute top-6 right-6 text-blue-600 hover:text-blue-800 text-[10px] font-black uppercase underline decoration-2 underline-offset-4">View Details</button>
                @endif
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-green-500 font-bold uppercase text-[10px] tracking-widest">Total Paid</h3>
                <p class="text-3xl font-black text-green-600 mt-1">₱{{ number_format($totalPaid, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-red-500 font-bold uppercase text-[10px] tracking-widest">Remaining Balance</h3>
                <p class="text-3xl font-black text-red-600 mt-1">₱{{ number_format($remainingBalance, 2) }}</p>
            </div>
        </div>

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
                            @if(!empty($p->receipt_path))
                                <a href="{{ route('payments.receipt.view', ['filename' => basename($p->receipt_path)]) }}" target="_blank" class="text-blue-600 hover:underline font-black text-[10px]">VIEW RECEIPT</a>
                            @else
                                <span class="text-gray-300 italic">No File</span>
                            @endif
                        </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">No payment history found for this year.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t">{{ $tuitions->links() ?? '' }}</div>
        </div>

        @if($activeTuition)
        {{-- Assessment Breakdown Modal --}}
        <div x-show="showAssessmentModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl p-8" @click.away="showAssessmentModal = false">
                <h2 class="text-2xl font-black mb-6 uppercase border-b-2 border-gray-100 pb-4">Assessment Breakdown</h2>
                
                <div class="space-y-6">
                    <div class="flex justify-between items-center bg-blue-50 p-4 rounded-xl border border-blue-100">
                        <span class="text-blue-700 uppercase text-xs font-black tracking-widest">Base Tuition</span>
                        <span class="font-black text-blue-800 text-lg">₱{{ number_format($baseTuition, 2) }}</span>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Miscellaneous Fees</h4>
                        <div class="grid grid-cols-3 gap-x-6 gap-y-4">
                            @forelse($miscFees as $name => $amount)
                                <div class="border-b border-gray-100 pb-2">
                                    <p class="text-[9px] text-gray-500 uppercase font-bold leading-tight mb-1">{{ $name }}</p>
                                    <p class="font-black text-gray-800 text-sm">₱{{ number_format($amount, 2) }}</p>
                                </div>
                            @empty
                                <div class="col-span-3 text-center text-gray-400 italic text-xs py-4">No miscellaneous fees found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center text-xl pt-6 mt-6 border-t-2 border-gray-100">
                    <span class="font-black text-gray-800 uppercase tracking-widest">Total Assessment</span>
                    <span class="font-black text-green-700 text-2xl">₱{{ number_format($totalAssessment, 2) }}</span>
                </div>
                
                <button @click="showAssessmentModal = false" class="w-full mt-8 px-4 py-3 bg-gray-100 rounded-xl font-black text-xs uppercase text-gray-500 hover:bg-gray-200 transition">Close Assessment</button>
            </div>
        </div>

        {{-- Submit Payment Modal --}}
        <div x-show="showSubmitModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8" @click.away="showSubmitModal = false">
                <h2 class="text-2xl font-black mb-6 uppercase">Submit Payment</h2>
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-xs font-bold">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('student.tuition.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{ payAmount: 0, currentBalance: {{ $remainingBalance }} }">
                    @csrf
                    <input type="hidden" name="tuition_id" value="{{ $activeTuition->id }}">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Payment Method</label>
                        <select name="payment_method" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold bg-gray-50" required>
                            <option value="GCash" {{ old('payment_method') == 'GCash' ? 'selected' : '' }}>GCash</option>
                            <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                    </div>
                    <div>
                        <div class="flex justify-between items-end mb-1">
                            <label class="block text-[10px] font-black text-gray-400 uppercase">Amount Paid (₱)</label>
                            <span class="text-[10px] font-black text-red-500">MAX: ₱{{ number_format($remainingBalance, 2) }}</span>
                        </div>
                        <input type="number" name="amount" x-model.number="payAmount" value="{{ old('amount') }}" step="0.01" max="{{ $remainingBalance }}" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold" required>
                        <p class="text-xs text-gray-500 mt-2 font-semibold" x-show="payAmount > 0">
                            New Balance: <span class="text-green-600" x-text="'₱' + Math.max(0, currentBalance - payAmount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span>
                        </p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Reference Number</label>
                        <input type="text" name="reference_number" value="{{ old('reference_number') }}" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-bold" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Payment Proof (JPG/PNG - Max 2MB)</label>
                        <input type="file" name="payment_proof" accept="image/*" class="w-full text-xs" required>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="showSubmitModal = false" class="flex-1 px-4 py-3 bg-gray-100 rounded-xl font-black text-xs uppercase text-gray-500 hover:bg-gray-200 transition">Cancel</button>
                        <button type="submit" class="flex-1 px-4 py-3 bg-green-700 text-white rounded-xl font-black text-xs uppercase hover:bg-green-800 transition">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </main>
</body>
</html>