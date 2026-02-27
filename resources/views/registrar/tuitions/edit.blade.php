<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="bg-yellow-600 p-6 text-white flex justify-between items-center">
            <h2 class="text-xl font-bold">Update Student Assessment</h2>
            <button onclick="toggleModal('editModal', false)" class="hover:text-gray-200"><i data-feather="x"></i></button>
        </div>

        <form id="editForm" method="POST" class="p-8 space-y-5">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase">Student Name</label>
                <input type="text" id="edit_name" class="w-full p-3 border rounded-xl bg-gray-100 outline-none" readonly>
            </div>

            <div class="grid grid-cols-1 gap-4">
                {{-- UMC Affiliation --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 uppercase">UMC Affiliation</label>
                    <select name="umc_affiliation" id="edit_umc" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-yellow-500 outline-none">
                        <option value="none">Not Affiliated</option>
                        <option value="member">UMC Member (50%)</option>
                        <option value="worker">UMC Worker (100%)</option>
                    </select>
                </div>

                {{-- Sibling Order --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 uppercase">Sibling Order</label>
                    <select name="sibling_order" id="edit_sibling" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-yellow-500 outline-none">
                        <option value="none">Oldest / Only Child</option>
                        <option value="2nd">2nd Child (10%)</option>
                        <option value="3rd">3rd Child (20%)</option>
                        <option value="4th">4th Child (30%)</option>
                    </select>
                </div>

                {{-- Payment Schedule --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 uppercase">Payment Schedule</label>
                    <select name="payment_schedule" id="edit_schedule" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-yellow-500 outline-none">
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly (5%)</option>
                        <option value="full">Full Year (10%)</option>
                    </select>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-yellow-600 text-white py-4 rounded-xl font-black text-lg hover:bg-yellow-700 transition shadow-lg">
                    RECALCULATE & UPDATE
                </button>
            </div>
        </form>
    </div>
</div>