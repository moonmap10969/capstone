<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cashier | Payment Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        .pagination-container nav { display: flex; justify-content: space-between; align-items: center; width: 100%; }
        .pagination-container span[aria-current="page"] > span { 
            background-color: #15803d !important; 
            color: white !important; 
            border-radius: 8px; 
            border: none; 
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50 text-gray-900 overflow-x-hidden">

    @include('layouts.sidebar.cashier')

    <main class="flex-1 p-8 overflow-y-auto">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Payment Verification</h1>
                <p class="text-gray-500 mt-1 font-medium">Verify online submissions and manage student accounts.</p>
            </div>
            <div class="flex gap-3">
                <form action="{{ route('cashier.payments.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ID or Name..." 
                        class="pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none shadow-sm transition-all w-64">
                    <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </form>
                <a href="{{ route('cashier.payments.create') }}" class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800 transition shadow-lg font-bold flex items-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Payment
                </a>
            </div>
        </div>
<div class="bg-gray-900 rounded-2xl shadow-xl mb-10 overflow-hidden border border-gray-800">
    <div class="p-5 border-b border-gray-800 flex justify-between items-center bg-gray-800/50">
        <span class="font-black text-green-400 uppercase text-xs tracking-widest">Recent Activity Log</span>
        <span class="text-[10px] text-gray-400 font-bold uppercase">Live Audit Trail</span>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-[9px] font-black text-gray-500 uppercase">Ref Number</th>
                    <th class="px-6 py-3 text-left text-[9px] font-black text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-center text-[9px] font-black text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-right text-[9px] font-black text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($transactionHistory as $log)
                <tr class="hover:bg-gray-800/30 transition">
                    <td class="px-6 py-3 text-xs font-mono text-green-500">{{ $log->reference_number }}</td>
                    <td class="px-6 py-3 text-xs text-gray-300 font-bold">{{ $log->studentNumber }}</td>
                    <td class="px-6 py-3 text-center text-xs font-black text-white">₱{{ number_format($log->amount, 2) }}</td>
                    <td class="px-6 py-3 text-right text-[10px] text-gray-500">{{ $log->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <h3 class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Total Collected</h3>
                <p class="text-3xl font-black text-gray-800 mt-1">₱{{ number_format($totalCollected ?? 0, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <h3 class="text-yellow-500 font-bold uppercase text-[10px] tracking-widest">Pending Review</h3>
                <p class="text-3xl font-black text-yellow-600 mt-1">{{ $tuitions->where('status', 'pending')->count() }} Students</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <h3 class="text-red-500 font-bold uppercase text-[10px] tracking-widest">Outstanding Balances</h3>
                <p class="text-3xl font-black text-red-600 mt-1">₱{{ number_format($totalBalance ?? 0, 2) }}</p>
            </div>
        </div>

        {{-- Main Ledger Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <span class="font-black text-gray-700 uppercase text-xs tracking-widest">Master Payment Ledger</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-wider">Student Profile</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-wider">Amount Paid</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($tuitions as $sub)
                            @php $isPending = $sub->status === 'pending'; @endphp
                            <tr class="hover:bg-gray-50 transition {{ $isPending ? 'border-l-4 border-l-yellow-400' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-900 text-sm uppercase">{{ $sub->studentLastName }}, {{ $sub->studentFirstName }}</span>
                                        <span class="text-[10px] text-blue-600 font-mono font-bold tracking-tight">ID: {{ $sub->studentNumber }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="text-sm font-bold text-gray-900">₱{{ number_format($sub->paid_amount, 2) }}</p>
                                    <p class="text-[10px] font-bold text-red-500 uppercase italic">Bal: ₱{{ number_format($sub->balance, 2) }}</p>
                                </td>
                                <td class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                                    {{ $sub->payment_method ?? 'CASH' }}
                                    <div class="text-[10px] font-mono text-gray-400">{{ $sub->reference_number ?? 'WALK-IN' }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $isPending ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $sub->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
    <div class="flex items-center justify-end gap-2">
        {{-- Only show actions if a tuition record exists --}}
        @if($sub->tuition_id)
            @if($isPending)
                <form action="{{ route('cashier.payments.approve', $sub->tuition_id) }}" method="POST">
                    @csrf
                    <button class="px-3 py-1.5 bg-green-700 text-white rounded-lg text-[10px] font-black uppercase shadow hover:bg-green-800 transition">Verify</button>
                </form>
            @endif
            <a href="{{ route('cashier.payments.edit', $sub->tuition_id) }}" class="p-2 text-gray-400 hover:text-blue-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            </a>
            <form action="{{ route('cashier.payments.destroy', $sub->tuition_id) }}" method="POST" onsubmit="return confirm('Delete record?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-gray-300 hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </form>
        @else
            <span class="text-[10px] font-bold text-gray-400 uppercase italic">No Record</span>
        @endif
    </div>
</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 italic text-sm">No payment records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 pagination-container">
                {{ $tuitions->links() }}
            </div>
        </div>
    </main>
</body>
</html>