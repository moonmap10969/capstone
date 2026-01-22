<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Tuition | FUMCES</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 flex">

    @include('student.layouts.sidebar')

    <main class="flex-1 ml-64 p-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-2 text-gray-800">My Tuition</h1>
            <p class="text-gray-500 font-medium">School Year 2026–2027</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-[#057E2E] rounded-2xl p-6 text-white shadow-lg">
                <p class="text-sm opacity-80 uppercase tracking-wider font-semibold">Total Tuition</p>
                <p class="text-3xl font-bold mt-2">₱{{ number_format($totalTuition, 2) }}</p>
            </div>
            <div class="bg-[#057E2E] rounded-2xl p-6 text-white shadow-lg">
                <p class="text-sm opacity-80 uppercase tracking-wider font-semibold">Total Paid</p>
                <p class="text-3xl font-bold mt-2">₱{{ number_format($totalPaid, 2) }}</p>
            </div>
            <div class="bg-[#057E2E] rounded-2xl p-6 text-white shadow-lg">
                <p class="text-sm opacity-80 uppercase tracking-wider font-semibold">Remaining Balance</p>
                <p class="text-3xl font-bold mt-2">₱{{ number_format($remainingBalance, 2) }}</p>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm font-bold text-gray-700">Payment Progress</span>
                <span class="text-2xl font-black text-[#057E2E]">{{ round($percentagePaid) }}%</span>
            </div>
            <div class="h-4 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-[#057E2E] rounded-full transition-all duration-1000" style="width: {{ $percentagePaid }}%"></div>
            </div>
        </div>

        {{-- Payment List --}}
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Transaction History</h2>
            @forelse($payments as $payment)
                <div class="flex items-center justify-between bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4">
                        <div class="{{ strtolower($payment->status) === 'paid' ? 'text-green-500' : 'text-amber-500' }}">
                            @if(strtolower($payment->status) === 'paid')
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">{{ $payment->description }}</p>
                            <p class="text-xs text-gray-500 font-medium">{{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900">₱{{ number_format($payment->amount, 2) }}</p>
                        <span class="text-[10px] uppercase tracking-widest font-bold px-3 py-1 rounded-full {{ strtolower($payment->status) === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $payment->status }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-white p-12 text-center rounded-2xl text-gray-400 border-2 border-dashed border-gray-100">
                    <p class="font-medium">No transaction history recorded yet.</p>
                </div>
            @endforelse
        </div>

        {{-- Payment Action --}}
        <div class="mt-8">
            <a href="{{ route('student.tuitions.index', ['show_payment' => 1]) }}"
               class="block text-center bg-[#057E2E] hover:bg-[#046324] text-white py-4 rounded-2xl font-bold shadow-lg shadow-green-900/20 transition transform active:scale-[0.98]">
                Make a Payment
            </a>
        </div>

        {{-- Modal --}}
@if(request('show_payment'))
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[60] p-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full relative">
            <a href="{{ route('student.tuitions.index') }}" 
            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors text-xl font-bold">
                ✕
            </a>

            <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="text-2xl font-black text-gray-800 mb-2">Submit Payment</h2>
                <p class="text-gray-500 text-sm mb-6">Please upload your proof of payment for verification.</p>

                {{-- Scrollable Form Fields --}}
                <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Full Name</label>
                        <input type="text" name="full_name" value="{{ auth()->user()->name }}" class="w-full mt-1 p-4 bg-gray-50 border-none rounded-xl" readonly>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Student Number</label>
                        <input type="text" name="student_number" value="{{ auth()->user()->username }}" class="..." readonly>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Reference Number</label>
                        <input name="reference_number" class="w-full mt-1 p-4 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#057E2E]" required>
                    </div>
                     <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">
                            Payment Method
                        </label>
                        <select name="payment_method"
                            class="w-full mt-1 p-4 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#057E2E]"
                            required>
                            <option value="" disabled selected>Select payment method</option>
                            <option value="gcash">GCash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Payment Description</label>
                        <textarea name="description" rows="2" class="w-full mt-1 p-4 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#057E2E]" required></textarea>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Amount</label>
                        <input type="number" name="amount" class="w-full mt-1 p-4 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#057E2E]" required>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Receipt Image</label>
                        <input type="file" name="receipt" class="w-full mt-1 p-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-green-50 file:text-[#057E2E]" required>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-[#057E2E] text-white font-bold py-4 rounded-xl hover:bg-[#046324] transition-transform active:scale-95">
                    Submit Payment
                </button>
            </form>
        </div>
    </div>
@endif
    </main>

</body>
</html>