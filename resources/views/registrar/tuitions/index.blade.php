<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar | Financial Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">
    <div class="flex">
        <aside class="w-64 bg-white border-r border-slate-200 h-screen sticky top-0">
            @include('layouts.sidebar.registrar')
        </aside>

        <main class="flex-1 p-10">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Tuition Management</h1>
                    <p class="text-sm text-slate-500 font-medium">Managing {{ $students->total() }} Students</p>
                </div>
                <div class="flex gap-3">
                    <form action="{{ route('registrar.tuitions.sync-all') }}" method="POST" onsubmit="return confirm('Sync all students to Cashier based on Master Fees?')">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-900/20 flex items-center gap-2">
                            <i data-feather="refresh-cw" class="w-4 h-4"></i> Sync All to Cashier
                        </button>
                    </form>
                    <a href="{{ route('registrar.tuitions.create') }}" class="bg-green-700 text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-green-800 transition shadow-lg shadow-green-900/20">
                        Master Fee Setup
                    </a>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <form action="{{ route('registrar.tuitions.index') }}" method="GET" class="flex gap-2">
                    <div class="relative flex-1">
                        <i data-feather="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or student ID..." class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-green-600 outline-none transition shadow-sm">
                    </div>
                    <select name="grade_filter" onchange="this.form.submit()" class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 outline-none cursor-pointer">
                        <option value="">All Levels</option>
                        @foreach($gradeOrder as $level)
                            <option value="{{ $level }}" {{ request('grade_filter') == $level ? 'selected' : '' }}>
                                {{ strtoupper($level) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-green-700 text-white px-8 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-green-700 transition">Filter</button>
                    @if(request('search') || request('grade_filter'))
                        <a href="{{ route('registrar.tuitions.index') }}" class="bg-slate-200 text-slate-600 px-4 py-3 rounded-xl flex items-center justify-center hover:bg-slate-300">
                            <i data-feather="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                            <th class="px-8 py-4">Year Level</th>
                            <th class="px-8 py-4">Student Info</th>
                            <th class="px-8 py-4">Current Assessment</th>
                            <th class="px-8 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($students as $student)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-4">
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-md text-[10px] font-black uppercase">
                                    {{ $student->year_level }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                <div class="font-bold text-slate-800">{{ $student->studentLastName }}, {{ $student->studentFirstName }}</div>
                                <div class="text-[10px] text-slate-400 font-mono">{{ $student->studentNumber }}</div>
                            </td>
                            <td class="px-8 py-4">
                                @php
                                    $master = $feeStructures[$student->year_level] ?? null;
                                    $regularTotal = $master ? ($master->base_tuition + $master->total_misc) : 0;
                                @endphp
                                @if($student->tuition)
                                    <div class="flex flex-col">
                                        <span class="font-black text-green-700">₱ {{ number_format($student->tuition->amount, 2) }}</span>
                                        
                                        @php
                                            $base = (float) ($master->base_tuition ?? 0);
                                            $actual = (float) $student->tuition->tuition_fee;
                                            $ratio = $base > 0 ? (1 - ($actual / $base)) : 0;
                                            
                                            $label = 'Standard Rate';
                                            $color = 'bg-slate-100 text-slate-500 border-slate-200';

                                            if ($ratio > 0.05) {
                                                if (abs($ratio - 1.0) < 0.01) { $label = 'UMC Worker (100%)'; $color = 'bg-purple-100 text-purple-700 border-purple-200'; }
                                                elseif (abs($ratio - 0.5) < 0.01) { $label = 'UMC Member (50%)'; $color = 'bg-blue-100 text-blue-700 border-blue-200'; }
                                                elseif (abs($ratio - 0.3) < 0.01) { 
                                                    $label = ($student->year_level == 'grade7') ? 'G7 Incentive (30%)' : '4th Sibling (30%)'; 
                                                    $color = 'bg-amber-100 text-amber-700 border-amber-200'; 
                                                }
                                                elseif (abs($ratio - 0.2) < 0.01) { $label = '3rd Sibling (20%)'; $color = 'bg-orange-100 text-orange-700 border-orange-200'; }
                                                elseif (abs($ratio - 0.1) < 0.01) { $label = '2nd Sibling (10%)'; $color = 'bg-emerald-100 text-emerald-700 border-emerald-200'; }
                                                else { $label = 'Custom Discount'; $color = 'bg-green-100 text-green-700 border-green-200'; }
                                            }
                                        @endphp

                                        <span class="inline-flex mt-1">
                                            <span class="px-2 py-0.5 rounded-full text-[8px] font-black uppercase border {{ $color }}">
                                                {{ $label }}
                                            </span>
                                        </span>
                                    </div>
                                @else
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-400 italic">Not Yet Synced</span>
                                        <span class="text-[9px] text-slate-300 uppercase">Est: ₱ {{ number_format($regularTotal, 2) }}</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-center">
                                <button onclick="openDiscountModal({{ json_encode($student) }})" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition shadow-sm flex items-center gap-2 mx-auto">
                                    <i data-feather="edit-3" class="w-3 h-3"></i> 
                                    {{ $student->tuition ? 'Modify Assessment' : 'Assess Student' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $students->links() }}
            </div>
        </main>
    </div>

    <div id="discountModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-sm overflow-hidden shadow-xl border border-slate-200">
            <div class="px-8 pt-8 pb-4 flex justify-between items-start">
                <div>
                    <h3 class="font-bold text-lg text-slate-800" id="modal_student_name">Name</h3>
                    <p class="text-xs text-slate-500 font-medium" id="modal_student_level">Level</p>
                </div>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition">
                    <i data-feather="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form action="{{ route('registrar.tuitions.store') }}" method="POST" class="px-8 pb-8">
                @csrf
                <input type="hidden" name="studentNumber" id="modal_student_id">
                <input type="hidden" name="year_level" id="modal_student_level_val">
                <input type="hidden" name="name" id="modal_student_name_val">

                <div class="space-y-4 mt-2">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 block">Affiliation</label>
                        <select name="umc_affiliation" id="calc_affiliation" onchange="liveCalc()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sm focus:border-green-600 outline-none transition">
                            <option value="none">Regular (0%)</option>
                            <option value="member">UMC Member (50%)</option>
                            <option value="worker">UMC Worker (100%)</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 block">Sibling Order</label>
                        <select name="sibling_order" id="calc_sibling" onchange="liveCalc()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sm focus:border-green-600 outline-none transition">
                            <option value="none">None / 1st (0%)</option>
                            <option value="2nd">2nd (10%)</option>
                            <option value="3rd">3rd (20%)</option>
                            <option value="4th">4th (30%)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-100 flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-500">New Total:</span>
                    <span id="modal_total" class="text-xl font-black text-green-700">₱ 0.00</span>
                </div>

                <button type="submit" class="w-full mt-6 bg-green-700 text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-green-800 transition shadow-lg shadow-green-900/20">
                    Finalize Assessment
                </button>
            </form>
        </div>
    </div>

    <script>
        const feeStructures = @json($feeStructures);
        let activeLevel = '';

        function openDiscountModal(student) {
            activeLevel = student.year_level;
            const fullName = student.studentLastName + ', ' + student.studentFirstName;
            document.getElementById('modal_student_name').innerText = fullName;
            document.getElementById('modal_student_name_val').value = fullName;
            document.getElementById('modal_student_level').innerText = activeLevel.toUpperCase();
            document.getElementById('modal_student_level_val').value = activeLevel;
            document.getElementById('modal_student_id').value = student.studentNumber;
            document.getElementById('discountModal').classList.remove('hidden');
            liveCalc();
        }

        function closeModal() { document.getElementById('discountModal').classList.add('hidden'); }

        function liveCalc() {
            const aff = document.getElementById('calc_affiliation').value;
            const sib = document.getElementById('calc_sibling').value;
            const preset = feeStructures[activeLevel];
            
            if (!preset) {
                document.getElementById('modal_total').innerText = '₱ 0.00';
                return;
            }

            const affRate = (aff === 'worker') ? 1.0 : (aff === 'member' ? 0.5 : 0);
            const sibRate = { 'none': 0, '2nd': 0.10, '3rd': 0.20, '4th': 0.30 }[sib] || 0;
            const g7Rate = (activeLevel === 'grade7') ? 0.30 : 0;

            const bestDiscount = Math.max(affRate, sibRate, g7Rate);
            const netTuition = parseFloat(preset.base_tuition) * (1 - bestDiscount);
            const total = netTuition + parseFloat(preset.total_misc);
            
            document.getElementById('modal_total').innerText = '₱ ' + total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
        feather.replace();
    </script>
</body>
</html>