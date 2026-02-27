<div class="space-y-6" x-data="{ 
    selectedMaxScore: 0,
    showToast: {{ session('success') ? 'true' : 'false' }},
    init() {
        if(this.showToast) {
            setTimeout(() => { this.showToast = false }, 3000);
        }
        let el = document.getElementById('activity-selector');
        if(el && el.selectedIndex > 0) {
            this.selectedMaxScore = el.options[el.selectedIndex].getAttribute('data-max') || 0;
        }
    },
    loadActivity(e) {
        if(e.target.value) {
            const url = new URL(window.location.href);
            url.searchParams.set('grading_item_id', e.target.value);
            window.location.href = url.toString();
        }
    }
}">
    {{-- Success Toast Notification --}}
    <div x-show="showToast" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         class="fixed top-5 right-5 z-[100] bg-white border border-gray-200 shadow-xl rounded-xl p-4 flex items-center gap-3 border-l-4 border-l-[#057E2E]" x-cloak>
        <div class="w-8 h-8 bg-green-50 text-[#057E2E] rounded-full flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div>
            <p class="text-[10px] font-black text-gray-800 uppercase leading-none">Scores Saved</p>
            <p class="text-[9px] font-bold text-gray-400 uppercase mt-1">Class record updated</p>
        </div>
    </div>

    {{-- Activity Selection Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h3 class="font-bold text-gray-800 text-sm mb-4">Score Encoding</h3>
        <form action="{{ route('teacher.grades.scores.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-6">
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Target Activity</label>
                    <select id="activity-selector" name="grading_item_id" @change="loadActivity($event)" 
                            class="w-full border rounded-lg p-2.5 text-sm outline-none focus:ring-2 focus:ring-[#057E2E] font-bold text-gray-600" required>
                        <option value="">-- SELECT ACTIVITY TO LOAD SCORES --</option>
                        @foreach($gradingItems as $item)
                            <option value="{{ $item->id }}" data-max="{{ $item->max_score }}" {{ request('grading_item_id') == $item->id ? 'selected' : '' }}>
                                {{ strtoupper($item->item_name) }} (MAX: {{ $item->max_score }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(request('grading_item_id'))
                <button type="submit" class="bg-[#057E2E] text-white font-bold py-2.5 rounded-lg text-sm shadow-sm hover:bg-opacity-90 transition-all uppercase">
                    Save Changes
                </button>
                @endif
            </div>

            {{-- Scoring Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Student Name</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Raw Score</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Percentage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($enrollments ?? [] as $enrollment)
                        <tr x-data="{ score: '{{ $enrollment->grades->where('grading_item_id', request('grading_item_id'))->first()->raw_score ?? '' }}' }" class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-800 uppercase">
                                    {{ $enrollment->admission->studentLastName }}, {{ $enrollment->admission->studentFirstName }}
                                </div>
                                <div class="text-[10px] text-gray-400 font-mono tracking-tighter uppercase">{{ $enrollment->studentNumber }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <input type="number" name="scores[{{ $enrollment->id }}]" x-model="score" min="0" :max="selectedMaxScore"
                                       class="w-24 border rounded-lg p-2 text-center text-sm font-black focus:ring-2 focus:ring-[#057E2E] outline-none border-gray-200" placeholder="0">
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-xs font-black" :class="selectedMaxScore > 0 && score !== '' ? ( (score/selectedMaxScore) >= 0.75 ? 'text-[#057E2E]' : 'text-red-500' ) : 'text-gray-300'"
                                      x-text="selectedMaxScore > 0 && score !== '' ? Math.round((score / selectedMaxScore) * 100) + '%' : '0%'">
                                    0%
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Please select an activity to start encoding.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>