<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Tuition | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add Tuition</h1>
            <a href="{{ route('admin.tuitions.index') }}"
               class="bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400">
                Back to Records
            </a>
        </div>

        {{-- Form --}}
        <div class="bg-white shadow rounded-lg p-6 max-w-md mx-auto">
            <form action="{{ route('admin.tuitions.store') }}" method="POST">
                @csrf

                {{-- Student Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Student Name</label>
                    <input type="text" name="student_name" value="{{ old('student_name') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                {{-- Amount --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Amount</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                {{-- Payment Status --}}
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium mb-1">Payment Status</label>
                    <select name="status"
                            class="w-full border rounded px-3 py-2 appearance-none pr-10"
                            required>
                        <option value="paid" {{ old('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partial" {{ old('status') === 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="unpaid" {{ old('status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium mb-1">Payment Method</label>
                    <select name="payment_method"
                            class="w-full border rounded px-3 py-2 appearance-none pr-10"
                            required>
                        <option value="gcash" {{ old('payment_method') === 'gcash' ? 'selected' : '' }}>Gcash</option>
                        <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- Approval Status --}}
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium mb-1">Approval Status</label>
                    <select name="approval_status"
                            class="w-full border rounded px-3 py-2 appearance-none pr-10"
                            required>
                        <option value="pending" {{ old('approval_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('approval_status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('approval_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('admin.tuitions.index') }}"
                       class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</a>
                    <button type="submit" class="px-4 py-2 rounded bg-green-700 text-white hover:bg-green-800">Save</button>
                </div>

            </form>
        </div>

    </main>

</body>
</html>
