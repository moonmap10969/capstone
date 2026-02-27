<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Fee Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#f1f5f9] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-5xl">
        <header class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Master Fee Configuration</h1>
            <a href="{{ route('registrar.tuitions.index') }}" class="text-slate-500 hover:text-green-700 font-bold text-sm transition flex items-center gap-1">
                <i data-feather="arrow-left" class="w-4 h-4"></i> Back
            </a>
        </header>

        <form id="masterFeeForm" action="{{ route('registrar.fee-structures.update') }}" method="POST" class="bg-white rounded-[1.5rem] border border-slate-200 shadow-2xl overflow-hidden">
            @csrf
            
            <div class="bg-green-700 px-8 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3 text-white">
                    <i data-feather="settings" class="w-4 h-4"></i>
                    <span class="font-black text-xs uppercase tracking-[0.2em]">Global Tuition & Fees Control</span>
                </div>
                <select name="year_level" id="year_selector" onchange="loadYearLevelData(this.value)" class="bg-green-800 text-white border border-green-600 rounded-lg px-4 py-1.5 text-xs font-black outline-none focus:ring-2 focus:ring-white/30 cursor-pointer">
                    <option value="" disabled selected>— Select Year Level —</option>
                    @foreach($gradeOrder as $level)
                        <option value="{{ $level }}">{{ $level }}</option>
                    @endforeach
                </select>
            </div>

            <div id="fee_inputs_container" class="hidden">
                <div class="p-8">
                    <div class="flex flex-col lg:flex-row gap-10">
                        <div class="w-full lg:w-1/3 bg-slate-50 p-6 rounded-2xl border border-slate-100 flex flex-col justify-center">
                            <label class="text-[10px] font-black text-green-700 uppercase tracking-widest mb-3 block text-center">Base Tuition Fee</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-black text-2xl text-green-700">₱</span>
                                <input type="number" step="0.01" name="base_tuition" id="input_base_tuition" oninput="calculateTotal()"
                                       class="w-full pl-10 pr-4 py-5 bg-white border-2 border-green-100 rounded-xl font-black text-3xl text-slate-800 outline-none focus:border-green-700 transition-all text-right shadow-sm">
                            </div>
                            <p class="mt-4 text-[10px] text-slate-400 text-center font-bold uppercase tracking-tight">Main instructional fee</p>
                        </div>

                        <div class="flex-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-4">Miscellaneous Breakdown (15 Items)</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-3">
                                @php
                                    $miscKeys = [
                                        'reg_fee' => 'Reg. Fee', 'learning_materials' => 'Learning Mat.', 'medical_dental' => 'Med/Dental',
                                        'testing_materials' => 'Testing Fee', 'id_fee' => 'Student ID', 'insurance' => 'Insurance',
                                        'av_computer' => 'AV/Computer', 'handbook' => 'Handbook', 'athletes' => 'Athletes Fee',
                                        'red_cross' => 'Red Cross', 'energy_fee' => 'Energy Fee', 'membership_fees' => 'Membership',
                                        'prisap_umesa' => 'PRISAP', 'hgp_modules' => 'HGP Modules', 'lab_fees' => 'Lab Fees'
                                    ];
                                @endphp
                                @foreach($miscKeys as $key => $label)
                                <div class="flex flex-col">
                                    <label class="text-[9px] font-bold text-slate-500 uppercase mb-1 ml-1">{{ $label }}</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-300">₱</span>
                                        <input type="number" step="0.01" name="{{ $key }}" id="input_{{ $key }}" oninput="calculateTotal()"
                                               class="w-full pl-7 pr-2 py-2 border border-slate-200 rounded-lg text-xs font-bold text-slate-700 outline-none focus:border-green-700 transition-all shadow-sm">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-5 bg-green-700 flex justify-between items-center border-t border-green-700">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-white uppercase tracking-[0.2em]">Calculated Total</span>
                        <span id="grand_total_display" class="text-3xl font-black text-white leading-none italic">₱ 0.00</span>
                    </div>
                    <button type="button" onclick="confirmUpdate()" class="bg-green-600 text-white px-10 py-4 rounded-xl font-black uppercase text-xs tracking-[0.2em] hover:bg-green-500 transition-all active:scale-95 shadow-xl shadow-green-600/20">
                        Update Master Rates
                    </button>
                </div>
            </div>

            <div id="empty_state" class="py-24 text-center">
                <i data-feather="mouse-pointer" class="w-8 h-8 text-slate-200 mx-auto mb-2"></i>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Select Year Level Above</p>
            </div>
        </form>
    </div>

    <script>
        const masterFees = @json($feeStructures);
        const miscKeys = {!! json_encode(array_keys($miscKeys)) !!};

        function loadYearLevelData(level) {
            if(!level) return;
            document.getElementById('fee_inputs_container').classList.remove('hidden');
            document.getElementById('empty_state').classList.add('hidden');
            const data = masterFees[level] || {};
            document.getElementById('input_base_tuition').value = data.base_tuition || '0.00';
            miscKeys.forEach(key => {
                const input = document.getElementById('input_' + key);
                if(input) input.value = data[key] || '0.00';
            });
            calculateTotal();
        }

        function calculateTotal() {
            let total = parseFloat(document.getElementById('input_base_tuition').value) || 0;
            miscKeys.forEach(key => { total += parseFloat(document.getElementById('input_' + key).value) || 0; });
            document.getElementById('grand_total_display').innerText = '₱ ' + total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }

        function confirmUpdate() {
            const level = document.getElementById('year_selector').value;
            Swal.fire({
                title: 'Confirm Update?',
                text: `Apply these rates to ${level}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Confirm and Save'
            }).then((result) => { if (result.isConfirmed) document.getElementById('masterFeeForm').submit(); });
        }
        feather.replace();
    </script>
</body>
</html>