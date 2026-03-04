<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Ledger | Financial Terminal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 flex min-h-screen font-sans" x-data="{ 
    activeTab: '{{ request()->has('walkin_page') ? 'cashier' : 'students' }}',
    showRejectModal: false,
    showRemarksModal: false, 
    rejectId: null,
    viewRemarks: '' 
}">

    @include('layouts.sidebar.cashier')

    <main class="flex-1 p-8 overflow-y-auto">
        
        {{-- Dashboard Summary --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Verified</p>
                <p class="text-2xl font-black text-green-700">₱{{ number_format($payments->where('status', 'completed')->sum('amount'), 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pending Submissions</p>
                <p class="text-2xl font-black text-yellow-600">{{ $payments->where('status', 'pending')->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Rejected</p>
                <p class="text-2xl font-black text-red-600">{{ $payments->where('status', 'rejected')->count() }}</p>
            </div>
        </div>

        {{-- Header Actions --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Payment Ledger</h1>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mt-1">Audit Trail & Verification</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('cashier.payments.create') }}" class="bg-green-700 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-green-100 hover:bg-green-800 transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                    New Walk-in Payment
                </a>

                <form action="{{ route('cashier.payments.index') }}" method="GET" class="flex gap-2">
                    <select name="academic_year_id" onchange="this.form.submit()" class="bg-white border-2 border-slate-100 rounded-2xl px-4 py-2 text-xs font-black text-slate-600 outline-none">
                        <option value="">All Years</option>
                        @foreach($academicYears as $id => $range)
                            <option value="{{ $id }}" {{ request('academic_year_id') == $id ? 'selected' : '' }}>{{ $range }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="bg-white border-2 border-slate-100 rounded-2xl px-4 py-2 text-xs font-black outline-none w-48">
                    <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest">Filter</button>
                </form>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="flex gap-8 mb-6 border-b border-slate-100">
            <button @click="activeTab = 'students'" :class="activeTab === 'students' ? 'border-green-600 text-green-700' : 'border-transparent text-slate-400'" class="pb-4 border-b-2 font-black text-[10px] uppercase tracking-widest transition-all">Student Submissions</button>
            <button @click="activeTab = 'cashier'" :class="activeTab === 'cashier' ? 'border-green-600 text-green-700' : 'border-transparent text-slate-400'" class="pb-4 border-b-2 font-black text-[10px] uppercase tracking-widest transition-all">Cashier Walk-ins</button>
        </div>

        {{-- Tables Container --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-5">Student Name</th>
                        <th class="px-6 py-5">Amount</th>
                        <th class="px-6 py-5">Reference Number</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5">Method</th>
                        <th class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    {{-- Tab 1 Rows --}}
                    @forelse($studentSubmissions as $payment)
                        <tr x-show="activeTab === 'students'" class="hover:bg-slate-50/50">
                           <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-800">
                                @if($payment->enrollment && $payment->enrollment->admission)
                                    {{ $payment->enrollment->admission->studentFirstName }} {{ $payment->enrollment->admission->studentLastName }}
                                @elseif($payment->admission)
                                    {{ $payment->admission->studentFirstName }} {{ $payment->admission->studentLastName }}
                                @else
                                    <span class="text-red-500">Name Not Found</span>
                                @endif
                            </span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-0.5">
                                ID: {{ $payment->studentNumber }}
                            </span>
                        </div>
                    </td>
                            <td class="px-6 py-4 font-black text-slate-900 text-sm">₱{{ number_format($payment->amount, 2) }}</td>
                            <td class="px-6 py-4 font-mono text-xs font-bold text-slate-500">{{ $payment->reference_number }}</td>
                            <td class="px-6 py-4">
                                @php $isFull = optional($payment->tuition)->balance <= 0; @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $isFull ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $isFull ? 'Complete' : 'Partial' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $payment->payment_method }}</td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <a href="{{ route('cashier.payments.show', $payment->id) }}" target="_blank" class="p-2 bg-slate-100 rounded-xl text-[10px] font-black uppercase px-4 hover:bg-slate-200">View</a>
                                @if($payment->status === 'pending')
                                    <form action="{{ route('cashier.payments.approveOnline', $payment->id) }}" method="POST" class="inline">@csrf<button class="p-2 bg-green-600 text-white rounded-xl text-[10px] font-black uppercase px-4">Approve</button></form>
                                    <button @click="showRejectModal = true; rejectId = '{{ $payment->id }}'" class="p-2 bg-red-600 text-white rounded-xl text-[10px] font-black uppercase px-4">Reject</button>
                                @endif
                                @if($payment->status === 'rejected')
                                    <button @click="showRemarksModal = true; viewRemarks = '{{ addslashes($payment->remarks) }}'" class="p-2 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase px-4">Remarks</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr x-show="activeTab === 'students'"><td colspan="6" class="px-6 py-20 text-center text-slate-300 font-black uppercase text-[10px] tracking-widest">No Submissions Found</td></tr>
                    @endforelse

                    {{-- Tab 2 Rows --}}
                    @forelse($walkInPayments as $payment)
                        <tr x-show="activeTab === 'cashier'" class="hover:bg-slate-50/50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-slate-900">{{ $payment->enrollment->admission->studentFirstName ?? 'N/A' }} {{ $payment->enrollment->admission->studentLastName ?? '' }}</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $payment->studentNumber }}</div>
                            </td>
                            <td class="px-6 py-4 font-black text-slate-900 text-sm">₱{{ number_format($payment->amount, 2) }}</td>
                            <td class="px-6 py-4 font-mono text-xs font-bold text-slate-500">{{ $payment->reference_number }}</td>
                            <td class="px-6 py-4">
                                @php $isFull = optional($payment->tuition)->balance <= 0; @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $isFull ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $isFull ? 'Complete' : 'Partial' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $payment->payment_method }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('cashier.payments.show', $payment->id) }}" target="_blank" class="p-2 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase px-6 hover:bg-slate-800 shadow-lg shadow-slate-200">Print Receipt</a>
                            </td>
                        </tr>
                    @empty
                        <tr x-show="activeTab === 'cashier'"><td colspan="6" class="px-6 py-20 text-center text-slate-300 font-black uppercase text-[10px] tracking-widest">No Walk-in Records Found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4">
            <div x-show="activeTab === 'students'">{{ $studentSubmissions->links() }}</div>
            <div x-show="activeTab === 'cashier'">{{ $walkInPayments->links() }}</div>
        </div>

        {{-- Modals --}}
        <div x-show="showRejectModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm">
            <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">
                <h2 class="text-2xl font-black mb-4 text-red-600 uppercase">Reject Submission</h2>
                <form :action="'/cashier/payments/' + rejectId + '/reject'" method="POST">
                    @csrf
                    <textarea name="remarks" class="w-full border-2 border-slate-100 p-4 rounded-2xl mb-6 text-sm outline-none" rows="4" placeholder="Reason for rejection..." required></textarea>
                    <div class="flex justify-end gap-6 items-center uppercase font-black text-[10px]">
                        <button type="button" @click="showRejectModal = false" class="text-slate-400">Cancel</button>
                        <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-2xl">Confirm Reject</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="showRemarksModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm">
            <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">
                <h2 class="text-2xl font-black mb-4 text-slate-900 uppercase">Rejection History</h2>
                <div class="bg-slate-50 p-6 rounded-2xl mb-6"><p class="text-slate-700 italic text-sm" x-text="viewRemarks"></p></div>
                <div class="flex justify-end"><button type="button" @click="showRemarksModal = false" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase">Close</button></div>
            </div>
        </div>

    </main>
</body>
</html>