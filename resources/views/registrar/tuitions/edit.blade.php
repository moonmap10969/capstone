{{-- Edit Tuition Modal --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl p-8 relative transform transition-all scale-95 opacity-0
    max-h-[90vh] overflow-y-auto">
<button id="closeEditModal"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Tuition</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-gray-700 font-medium mb-1">Student ID</label>
                <input type="number" name="studentNumber" id="edit_studentNumber"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Student Name</label>
                <input type="text" name="name" id="edit_name"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Reference Number</label>
                <input type="text" name="reference_number" id="edit_reference_number"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Amount</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 font-medium">₱</span>
                    <input type="number" step="0.01" name="amount" id="edit_amount"
                        class="w-full border rounded-lg px-10 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                </div>
            </div>

            {{-- Payment Method --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Payment Method</label>
                <div class="relative">
                    <select name="payment_method" id="edit_payment_method"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none"
                        required>
                        <option value="gcash">GCash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Status</label>
                <div class="relative">
                    <select name="status" id="edit_status"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none"
                        required>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Payment Type --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Payment Type</label>
                <div class="relative">
                    <select name="payment_type" id="edit_payment_type"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none"
                        required>
                        <option value="full">Paid</option>
                        <option value="partial">Partial</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- File Upload with Preview --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Proof of Payment</label>
                <div id="editFilePreview"
                    class="w-full h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden bg-gray-50 mb-2">
                    <span class="text-gray-400">No file selected</span>
                </div>
                <label
                    class="flex items-center justify-center w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200 shadow-sm transition">
                    <span id="editFileName" class="text-gray-700">Choose file</span>
                    <input type="file" name="payment_proof" id="edit_payment_proof" class="hidden"
                        accept="image/*,application/pdf">
                </label>
                <p class="text-sm text-gray-500 mt-1">Leave blank to keep existing file</p>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="cancelEditModal"
                    class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium">Cancel</button>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-green-700 text-white hover:bg-green-800 font-medium">Update</button>
            </div>
        </form>
    </div>
</div>