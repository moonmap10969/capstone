<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Premium Payment Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-50">

    @include('layouts.sidebar.cashier')

    <main class="flex-1 min-h-screen p-6 lg:p-12 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <span class="text-green-700 font-bold tracking-widest text-xs uppercase">Financial Terminal</span>
                    <h1 class="text-4xl font-extrabold text-slate-900 mt-1">Collect Payment</h1>
                </div>
                <button type="button" onclick="resetPortal()" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl font-bold text-xs transition-all uppercase tracking-widest">
                    Clear Form
                </button>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-2 space-y-6">
                    <form action="{{ route('cashier.payments.store') }}" method="POST" id="paymentForm" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-green-100 text-green-700 rounded-full flex items-center justify-center font-bold">1</div>
                                <h2 class="text-xl font-bold text-slate-800">Student Identification</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="relative">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block ml-1">Student ID Number</label>
                                    <input type="text" name="studentNumber" id="studentNumber" autocomplete="off"
                                           class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-green-500/10 focus:border-green-600 transition-all outline-none text-lg font-semibold"
                                           placeholder="Type ID..." required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block ml-1">Verified Name / Balance</label>
                                    <div id="verifyBox" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 min-h-[62px] flex items-center">
                                        <span id="nameDisplay" class="text-slate-400 font-medium italic">Awaiting Student ID...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-green-100 text-green-700 rounded-full flex items-center justify-center font-bold">2</div>
                                <h2 class="text-xl font-bold text-slate-800">Payment Entry</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block ml-1">Amount to Pay</label>
                                    <input type="number" name="amount" id="amountInput" step="0.01" required
                                           class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-green-500/10 focus:border-green-600 transition-all outline-none text-lg font-semibold" placeholder="0.00">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block ml-1">Payment Method</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="payment_method" value="cash" class="hidden peer" onchange="toggleDigitalFields(false)" checked>
                                            <div class="text-center py-4 border border-slate-200 rounded-xl peer-checked:border-green-600 peer-checked:bg-green-50 peer-checked:text-green-700 font-bold transition-all text-xs">CASH</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="payment_method" value="gcash" class="hidden peer" onchange="toggleDigitalFields(true)">
                                            <div class="text-center py-4 border border-slate-200 rounded-xl peer-checked:border-green-600 peer-checked:bg-green-50 peer-checked:text-green-700 font-bold transition-all text-xs">GCASH</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="payment_method" value="bank" class="hidden peer" onchange="toggleDigitalFields(true)">
                                            <div class="text-center py-4 border border-slate-200 rounded-xl peer-checked:border-green-600 peer-checked:bg-green-50 peer-checked:text-green-700 font-bold transition-all text-xs">BANK</div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="digitalFields" class="mt-6 space-y-4 hidden">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block ml-1">Reference Number</label>
                                    <input type="text" name="reference_number" id="refInput" class="w-full border border-slate-200 rounded-2xl px-5 py-3 outline-none focus:border-green-600 transition-all font-mono" placeholder="REF-000000000">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block ml-1">Upload Encrypted Receipt (ISO Standard)</label>
                                    <input type="file" name="payment_proof" id="fileInput" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-green-600 hover:file:text-white cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

        <div class="lg:col-span-1">
            <div class="bg-green-700 rounded-[2rem] p-8 text-white shadow-2xl sticky top-8">
                <div class="flex justify-between items-start mb-10">
                    <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-md font-black text-xl text-center w-12 h-12">₱</div>
                    <div class="text-right">
                        <p class="text-white/60 text-xs font-bold uppercase tracking-widest">Collection</p>
                        <p class="text-xl font-black uppercase tracking-tighter">Terminal 01</p>
                    </div>
                </div>

                <div class="space-y-4 mb-8 text-sm">
                    <div class="flex justify-between text-white/70">
                        <span>Total Owed:</span>
                        <span id="summaryBalance" class="font-bold text-white">₱0.00</span>
                    </div>
                    <div class="flex justify-between text-white/70">
                        <span>Paying Now:</span>
                        <span id="summaryPaying" class="font-bold text-white">₱0.00</span>
                    </div>
                    <div class="flex justify-between text-white/70 border-t border-white/20 pt-4">
                        <span>Total After Payment:</span>
                        <span id="summaryRemaining" class="font-black text-2xl">₱0.00</span>
                    </div>
                </div>

                <button form="paymentForm" id="submitBtn" type="submit" class="w-full bg-white text-green-700 font-black py-5 rounded-2xl shadow-xl hover:shadow-2xl transition-all active:scale-95 mb-4 uppercase text-xs tracking-widest">
                    Confirm Payment
                </button>
                <p class="text-[10px] text-white/40 text-center uppercase font-bold tracking-widest">Encrypted Data Transmission Enabled</p>
            </div>
        </div>
            </div>
        </div>
    </main>

  <script>
const studentMap = @json($students);
const idInput = document.getElementById('studentNumber');
const nameDisplay = document.getElementById('nameDisplay');
const amountInput = document.getElementById('amountInput');

const summaryBalance = document.getElementById('summaryBalance');
const summaryPaying = document.getElementById('summaryPaying');
const summaryRemaining = document.getElementById('summaryRemaining');

const format = (num) => '₱' + parseFloat(num || 0).toLocaleString(undefined, {minimumFractionDigits: 2});

let currentBalance = 0;

// Update UI when student ID is entered
idInput.addEventListener('input', function() {
    const student = studentMap[this.value];
    if (student) {
        currentBalance = parseFloat(student.balance);
        nameDisplay.innerHTML = `<span class="text-green-700 font-bold">${student.name}</span> <span class="mx-2 text-slate-300">|</span> <span class="text-red-600 font-black">${format(currentBalance)}</span>`;
        summaryBalance.innerText = format(currentBalance);
        summaryPaying.innerText = '₱0.00';
        summaryRemaining.innerText = format(currentBalance);
        amountInput.value = '';
    } else {
        resetUI();
    }
});

// Update paying and remaining dynamically
amountInput.addEventListener('input', function() {
    let payingNow = parseFloat(this.value) || 0;
    if (payingNow > currentBalance) payingNow = currentBalance; // prevent overpay
    summaryPaying.innerText = format(payingNow);
    summaryRemaining.innerText = format(currentBalance - payingNow);
});

function toggleDigitalFields(show) {
    const digitalFields = document.getElementById('digitalFields');
    const fileInput = document.getElementById('fileInput');
    const refInput = document.getElementById('refInput');
    
    digitalFields.classList.toggle('hidden', !show);
    fileInput.required = show;
    refInput.required = show;
}

function resetPortal() {
    document.getElementById('paymentForm').reset();
    toggleDigitalFields(false);
    resetUI();
}

function resetUI() {
    currentBalance = 0;
    nameDisplay.innerHTML = idInput.value.length > 0 ? '<span class="text-red-400">Not Found</span>' : 'Awaiting Student ID...';
    summaryBalance.innerText = '₱0.00';
    summaryPaying.innerText = '₱0.00';
    summaryRemaining.innerText = '₱0.00';
}
</script>
</body>
</html>