<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Payment | Cashier Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gray-50 flex">

 @include('layouts.sidebar.cashier')

<main class="flex-1 p-6 md:p-12">
    <div class="max-w-3xl mx-auto mb-8">
        <nav class="text-sm text-gray-500 mb-2">
            <a href="{{ route('cashier.payments.index') }}" class="hover:text-green-700 transition">Payments</a> / Edit Record
        </nav>
        <h1 class="text-3xl font-extrabold text-gray-900">Edit Payment Details</h1>
        <p class="text-gray-600">Update the transaction information and verification status.</p>
    </div>

    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('cashier.payments.update', $tuition->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-8 space-y-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700 ml-1">Student ID Number</label>
                    <input type="text" name="studentNumber"
                           value="{{ $tuition->studentNumber }}"
                           class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed outline-none"
                           readonly>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700 ml-1">Payment Method</label>
                    <select name="payment_method"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-green-700/10 focus:border-green-700 transition-all outline-none appearance-none">
                        <option value="Cash" {{ $tuition->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="GCash" {{ $tuition->payment_method == 'GCash' ? 'selected' : '' }}>GCash</option>
                        <option value="Bank Transfer" {{ $tuition->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="Walk-in" {{ $tuition->payment_method == 'Walk-in' ? 'selected' : '' }}>Walk-in</option>
                    </select>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700 ml-1">Student Name</label>
                    <input type="text" name="name"
                           value="{{ $tuition->studentLastName }}, {{ $tuition->studentFirstName }}"
                           class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed outline-none"
                           readonly>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700 ml-1">Payment Status</label>
                    <select name="status"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-green-700/10 focus:border-green-700 transition-all outline-none appearance-none">
                        <option value="pending" {{ $tuition->status == 'pending' ? 'selected' : '' }}>Pending (Awaiting Verification)</option>
                        <option value="partial" {{ $tuition->status == 'partial' ? 'selected' : '' }}>Partial (Balance Remaining)</option>
                        <option value="paid" {{ $tuition->status == 'paid' ? 'selected' : '' }}>Paid (Fully Cleared)</option>
                    </select>
                </div>
            </div>

            <hr class="border-gray-100 my-4">

            <div class="space-y-4">
                <label class="text-sm font-semibold text-gray-700 ml-1">Reference/Proof of Payment</label>
                
                @if($tuition->payment_proof)
                <div class="flex items-center p-4 bg-blue-50 border border-blue-100 rounded-xl mb-4">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-blue-700 font-medium">Existing Proof Attached</p>
                        <a href="{{ route('cashier.payments.show', $tuition->id) }}" target="_blank" class="text-sm text-blue-900 underline hover:text-blue-700 font-bold">Securely View Decrypted Receipt</a>
                    </div>
                </div>
                @else
                <div class="p-4 bg-gray-100 border border-gray-200 rounded-xl text-center text-sm text-gray-500 italic">
                    No payment proof submitted for this record.
                </div>
                @endif
            </div>

            <div class="flex items-center justify-end gap-6 pt-6 border-t border-gray-100">
                <a href="{{ route('cashier.payments.index') }}"
                   class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
                    Discard Changes
                </a>
                <button type="submit"
                        class="bg-green-700 text-white px-10 py-3.5 rounded-xl font-bold shadow-lg shadow-green-700/20 hover:bg-green-800 transform active:scale-95 transition-all">
                    Update Record
                </button>
            </div>
        </form>
    </div>
</main>

</body>
</html>