<div class="space-y-6">
    {{-- Activity Creation Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h3 class="font-bold text-gray-800 text-sm mb-4">Add Activity to Class Standing</h3>
        {{-- Appended #standing to action --}}
        <form action="{{ route('teacher.grades.items.store') }}#standing" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @csrf
            <input type="hidden" name="section_id" value="{{ $selectedSectionId }}">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Component</label>
                <select name="component_id" class="w-full border rounded-lg p-2.5 text-sm outline-none focus:ring-2 focus:ring-[#057E2E]" required>
                    @foreach($components as $comp)
                        <option value="{{ $comp->id }}">{{ $comp->category }} ({{ $comp->percentage }}%)</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Activity Name</label>
                <input type="text" name="item_name" placeholder="Quiz #1" class="w-full border rounded-lg p-2.5 text-sm outline-none focus:ring-2 focus:ring-[#057E2E]" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Max Score</label>
                <input type="number" name="max_score" class="w-full border rounded-lg p-2.5 text-sm outline-none focus:ring-2 focus:ring-[#057E2E]" required>
            </div>
            <button type="submit" class="bg-[#057E2E] text-white font-bold py-2.5 rounded-lg text-sm shadow-sm hover:bg-opacity-90 transition-all">
                Create Activity
            </button>
        </form>
    </div>

    {{-- Activity List Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Activity Name</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Computation</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Max Score</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($gradingItems ?? [] as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $item->item_name }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase">
                            {{ $item->component->category ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-[10px] font-black text-gray-500 uppercase bg-gray-100 px-2 py-1 rounded">
                            {{ $item->component->calculation_method ?? 'Average' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center font-black text-gray-700">{{ $item->max_score }}</td>
                    <td class="px-6 py-4 text-right">
                        {{-- Appended #standing to action --}}
                        <form action="{{ route('teacher.grades.items.destroy', $item->id) }}#standing" 
                            method="POST" 
                            onsubmit="return confirm('Are you sure?');"
                            class="inline">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">No activities found for this section.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>