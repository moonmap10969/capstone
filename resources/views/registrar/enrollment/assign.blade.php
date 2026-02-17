<div class="space-y-8" x-data="{ studentSearch: '' }">
    {{-- 1. Student Selection (Searchable) --}}
    <div>
        <label class="block text-sm font-bold mb-2">Select Approved Student(s)</label>
        <div class="relative mb-4">
            <input type="text" x-model="studentSearch" placeholder="Search approved students..." 
                   class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        <div class="max-h-60 overflow-y-auto border rounded-xl divide-y">
            @foreach($approvedAdmissions as $admission)
                <label class="flex items-center p-4 hover:bg-gray-50 cursor-pointer transition"
                       x-show="'{{ strtolower($admission->studentFirstName . ' ' . $admission->studentLastName) }}'.includes(studentSearch.toLowerCase())">
                    <input type="checkbox" name="admission_ids[]" value="{{ $admission->id }}" class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <div class="ml-4">
                        <p class="font-bold text-gray-900">{{ $admission->studentFirstName }} {{ $admission->studentLastName }}</p>
                        <p class="text-xs text-gray-500">Level: {{ $admission->year_level }} | ID: {{ $admission->studentNumber ?? 'Pending' }}</p>
                    </div>
                </label>
            @endforeach
        </div>
    </div>

    {{-- 2. Section & Shift Assignment --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Grade & Section --}}
        <div>
            <label class="block text-sm font-bold mb-2">Assign Grade & Section</label>
            <select name="section_id" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-green-500">
                <option value="">Select a Section</option>
                @foreach($sections as $section)
                    <option value="{{ $section->section_id }}">
                        {{ $section->year_level }} - {{ $section->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Schedule Preference --}}
        <div>
            <label class="block text-sm font-bold mb-2">Schedule Shift</label>
            <div class="flex gap-4">
                <label class="flex-1 border p-3 rounded-xl cursor-pointer hover:bg-gray-50 has-[:checked]:border-green-600 has-[:checked]:bg-green-50">
                    <input type="radio" name="shift" value="morning" class="hidden" required>
                    <span class="block text-center font-bold">☀️ Morning</span>
                </label>
                <label class="flex-1 border p-3 rounded-xl cursor-pointer hover:bg-gray-50 has-[:checked]:border-green-600 has-[:checked]:bg-green-50">
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
               class="w-full border p-3 rounded-xl bg-gray-50 text-gray-600">
    </div>
</div>