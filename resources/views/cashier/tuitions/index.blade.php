<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tuition Management | Cashier Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; } 
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50 text-gray-900">

    @include('layouts.sidebar.cashier')

    <main class="flex-1 p-6 lg:p-10">
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Tuition Assessment View</h1>
            <p class="text-gray-500 mt-1">Cross-reference Registrar assessments with student payment history.</p>
        </header>

        {{-- Filter/Search --}}
        <div class="mb-6">
            <form action="{{ route('cashier.tuitions.index') }}" method="GET" class="flex flex-wrap gap-3 items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ID or Name..." 
                    class="w-full max-w-xs px-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-green-600 outline-none shadow-sm transition-all">
                
                <select name="grade_filter" onchange="this.form.submit()" 
                    class="w-full max-w-[180px] px-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-semibold text-slate-600 focus:ring-2 focus:ring-green-600 outline-none shadow-sm cursor-pointer">
                    <option value="">All Grade Levels</option>
                    @php $levels = ['kinder1','kinder2','kinder3','grade1','grade2','grade3','grade4','grade5','grade6','grade7','grade8','grade9','grade10']; @endphp
                    @foreach($levels as $level)
                        <option value="{{ $level }}" {{ request('grade_filter') == $level ? 'selected' : '' }}>
                            {{ strtoupper($level) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="bg-green-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-green-800 transition shadow-sm">
                    Apply Filter
                </button>

                @if(request('search') || request('grade_filter'))
                    <a href="{{ route('cashier.tuitions.index') }}" class="text-slate-400 hover:text-red-500 transition-colors flex items-center gap-1 text-xs font-bold uppercase tracking-tighter">
                        ✕ Clear Filters
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <th class="px-8 py-4">Student Name</th>
                        <th class="px-8 py-4">Grade Level</th>
                        <th class="px-8 py-4">Assessment Detail</th>
                        <th class="px-8 py-4">Current Balance</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($admissions as $student)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-4">
                            <div class="font-bold text-slate-800 text-sm">{{ $student->studentLastName }}, {{ $student->studentFirstName }}</div>
                            <div class="text-[10px] font-mono text-slate-400">{{ $student->studentNumber }}</div>
                        </td>
                        <td class="px-8 py-4">
                            <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tight">
                                {{ $student->year_level }}
                            </span>
                        </td>
                        <td class="px-8 py-4">
                            @if($student->tuition)
                                <div class="flex flex-col">
                                    <span class="font-black text-green-700">₱ {{ number_format($student->tuition->amount, 2) }}</span>
                                    <span class="text-[9px] text-slate-400 uppercase font-medium">
                                        (₱{{ number_format($student->tuition->tuition_fee, 2) }} Tuition + ₱{{ number_format($student->tuition->misc_fees, 2) }} Misc)
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-4 font-black text-sm {{ ($student->tuition->balance ?? 0) > 0 ? 'text-red-600' : 'text-slate-400' }}">
                            ₱{{ number_format($student->tuition->balance ?? 0, 2) }}
                        </td>
                        <td class="px-8 py-4 text-right">
                            <button onclick="viewHistory({{ json_encode($student) }}, {{ json_encode($student->tuition) }}, {{ json_encode($student->tuition->payments ?? []) }})" 
                                class="bg-slate-900 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-green-700 transition">
                                View History
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-10 text-center text-slate-400 text-sm italic">No student records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $admissions->appends(request()->query())->links() }}</div>
    </main>

    {{-- History Modal --}}
    <div id="historyModal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden border border-slate-200">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 id="h_name" class="text-xl font-black text-slate-800">Student Name</h3>
                        <p id="h_id" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">ID: 0000</p>
                    </div>
                    <button onclick="closeModal()" class="text-slate-300 hover:text-slate-600 transition">✕</button>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 mb-6 flex justify-between items-center border border-slate-100">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase">Total Assessment</p>
                        <p id="h_total" class="font-bold text-slate-700">₱ 0.00</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] font-black text-slate-400 uppercase">Remaining Balance</p>
                        <p id="h_balance" class="font-black text-red-600 text-lg">₱ 0.00</p>
                    </div>
                </div>

                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-4">Transaction History</label>
                <div id="history_list" class="max-h-60 overflow-y-auto custom-scrollbar space-y-3 pr-2"></div>

                <button onclick="closeModal()" class="w-full mt-8 bg-slate-100 text-slate-600 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-200 transition">
                    Close Record
                </button>
            </div>
        </div>
    </div>

    <script>
        function viewHistory(student, tuition, payments) {
            document.getElementById('h_name').innerText = student.studentLastName + ', ' + student.studentFirstName;
            document.getElementById('h_id').innerText = 'ID: ' + student.studentNumber;

            const displayTotal = tuition ? parseFloat(tuition.amount) : 0;
            const displayBalance = tuition ? (tuition.balance !== null ? parseFloat(tuition.balance) : parseFloat(tuition.amount)) : 0;

            document.getElementById('h_total').innerText = '₱ ' + displayTotal.toLocaleString(undefined, {minimumFractionDigits:2});
            document.getElementById('h_balance').innerText = '₱ ' + displayBalance.toLocaleString(undefined, {minimumFractionDigits:2});

            const list = document.getElementById('history_list');
            list.innerHTML = '';

            if (payments && payments.length > 0) {
                payments.forEach(p => {
                    const date = new Date(p.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    list.innerHTML += `
                        <div class="flex items-center justify-between p-3 bg-white border border-slate-100 rounded-xl shadow-sm">
                            <div>
                                <p class="text-xs font-bold text-slate-800">₱ ${parseFloat(p.amount).toLocaleString()}</p>
                                <p class="text-[9px] text-slate-400 uppercase font-medium">${p.payment_method} • ${date}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                ${p.receipt_path ? `<a href="/cashier/payments/view/${p.id}" target="_blank" class="text-[9px] font-black text-green-600 uppercase">View</a>` : ''}
                                <span class="text-[9px] font-black text-green-600 uppercase">Paid</span>
                            </div>
                        </div>
                    `;
                });
            } else {
                list.innerHTML = '<div class="text-center py-10 text-slate-300 text-[10px] uppercase font-bold italic">No payments found</div>';
            }

            document.getElementById('historyModal').classList.remove('hidden');
        }

        function closeModal() { document.getElementById('historyModal').classList.add('hidden'); }
    </script>
</body>
</html>