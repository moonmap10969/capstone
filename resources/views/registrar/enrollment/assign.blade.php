<form action="{{ route('registrar.enrollment.store') }}" method="POST" x-data="{ 
    studentSearch: '', 
    selectAll: false,
    isSubmitting: false,
    toggleAll() {
        // Specifically target only checkboxes currently visible via the search filter
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => {
            if (cb.closest('label').style.display !== 'none') {
                cb.checked = this.selectAll;
            }
        });
    }
}" @submit="isSubmitting = true">
    @csrf
    <div class="space-y-8">
        {{-- 1. Student Selection (Searchable) --}}
        <div>
            <div class="flex justify-between items-end mb-2">
                <label class="block text-sm font-bold">Select Approved Student(s)</label>
                <label class="flex items-center text-xs text-green-700 cursor-pointer font-bold select-none">
                    <input type="checkbox" x-model="selectAll" @change="toggleAll()" class="mr-1 w-4 h-4 rounded"> 
                    Select All Visible
                </label>
            </div>
            
            <div class="relative mb-4">
                <input type="text" x-model="studentSearch" placeholder="Search approved students by name..." 
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <div class="max-h-64 overflow-y-auto border rounded-xl divide-y bg-white shadow-inner">
                @forelse($approvedAdmissions as $admission)
                    <label class="flex items-center p-4 hover:bg-gray-50 cursor-pointer transition group"
                           x-show="'{{ strtolower($admission->studentFirstName . ' ' . $admission->studentLastName) }}'.includes(studentSearch.toLowerCase())">
                        <input type="checkbox" name="admission_ids[]" value="{{ $admission->id }}" 
                               class="student-checkbox w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                        <div class="ml-4">
                            <p class="font-bold text-gray-900 group-hover:text-green-700">{{ $admission->studentFirstName }} {{ $admission->studentLastName }}</p>
                            <p class="text-xs text-gray-500 font-medium">Level: {{ $admission->year_level }} | ID: {{ $admission->studentNumber ?? 'Pending' }}</p>
                        </div>
                    </label>
                @empty
                    <div class="p-8 text-center text-gray-500 italic">No approved students found.</div>
                @endforelse
            </div>
        </div>

        {{-- 2. Assignment Details --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-300">
            <div>
                <label class="block text-sm font-bold mb-2">Assign Grade & Section</label>
                <select name="section_id" required class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-green-500 bg-white font-semibold">
                    <option value="">Select a Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->section_id }}">
                            {{ $section->year_level }} - {{ $section->name }} ({{ $section->enrollments_count }}/{{ $section->capacity ?? 40 }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Schedule Shift</label>
                <div class="flex gap-4">
                    <label class="flex-1 border p-3 rounded-xl cursor-pointer hover:bg-white has-[:checked]:border-green-600 has-[:checked]:bg-green-50 bg-white transition shadow-sm">
                        <input type="radio" name="shift" value="morning" class="hidden" required checked>
                        <span class="block text-center font-bold">☀️ Morning</span>
                    </label>
                    <label class="flex-1 border p-3 rounded-xl cursor-pointer hover:bg-white has-[:checked]:border-green-600 has-[:checked]:bg-green-50 bg-white transition shadow-sm">
                        <input type="radio" name="shift" value="afternoon" class="hidden">
                        <span class="block text-center font-bold">⛅ Afternoon</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- 3. School Year --}}
        <div>
            <label class="block text-sm font-bold mb-2">School Year</label>
            <input type="text" name="school_year" value="2025-2026" readonly 
                   class="w-full border p-3 rounded-xl bg-gray-100 text-gray-600 font-bold outline-none cursor-not-allowed">
        </div>

        {{-- Finalize Action with Loading State --}}
        <div class="pt-4">
            <button type="submit" 
                    x-bind:disabled="isSubmitting"
                    class="w-full bg-[#057E2E] text-white py-4 rounded-xl font-black text-lg shadow-xl hover:bg-[#046625] hover:-translate-y-1 transition-all active:scale-95 uppercase tracking-widest disabled:opacity-50 disabled:cursor-wait flex items-center justify-center">
                <template x-if="!isSubmitting">
                    <span>Confirm and Finalize Enrollment</span>
                </template>
                <template x-if="isSubmitting">
                    <div class="flex items-center">
                        <svg class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </div>
                </template>
            </button>
            <p class="text-center text-xs text-gray-400 mt-3 font-medium">Finalizing will bulk-enroll all selected students and update system counts.</p>
        </div>
    </div>
</form>