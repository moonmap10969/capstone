@php 
    $totalWeight = $components->sum('percentage'); 
    $remaining = 100 - $totalWeight;
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="font-bold text-gray-800 text-sm">Grading Schema</h3>
        @if($totalWeight < 100)
            <button @click="showModal = true" class="bg-[#057E2E] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-[#046324] transition-colors">
                + Add Category
            </button>
        @else
            <span class="text-xs font-bold text-red-500 bg-red-50 px-3 py-2 rounded-lg border border-red-100">Max Weight Reached</span>
        @endif
    </div>
    
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Code</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Weight</th>
                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Computation</th>
                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($components ?? [] as $component)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4 font-mono text-xs font-bold text-blue-600">{{ $component->code }}</td>
                <td class="px-6 py-4 font-bold text-gray-700">{{ $component->category }}</td>
                <td class="px-6 py-4 text-center text-sm font-black text-[#057E2E]">{{ number_format($component->percentage, 0) }}%</td>
                <td class="px-6 py-4 text-center">
                    <span class="text-[10px] font-bold uppercase bg-gray-100 px-2 py-1 rounded text-gray-500">
                        {{ ucfirst($component->calculation_method ?? 'Average') }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('teacher.grades.destroy', $component->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-xs uppercase">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 italic font-medium">No grading categories configured.</td></tr>
            @endforelse
        </tbody>
        @if($components->count() > 0)
        <tfoot class="bg-gray-50/80">
            <tr>
                <td colspan="2" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase">Total Allocation:</td>
                <td class="px-6 py-4 text-center font-black text-lg {{ $totalWeight > 100 ? 'text-red-600' : 'text-gray-900' }}">
                    {{ $totalWeight }}%
                </td>
                <td colspan="2" class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 italic">
                    @if($remaining > 0) ({{ $remaining }}% remaining) @endif
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

{{-- MODAL --}}
<div x-show="showModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-transition x-cloak>
    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl" @click.away="showModal = false">
        <h2 class="text-xl font-black text-gray-900 mb-6 text-center">New Category</h2>
        <form action="{{ route('teacher.grades.store') }}" method="POST" class="space-y-5" x-data="{ inputWeight: 0 }">
            @csrf 
            <input type="hidden" name="section_id" value="{{ $selectedSectionId }}">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Category Name</label>
                <input type="text" name="category" class="w-full border-2 border-gray-100 rounded-xl p-3 text-sm font-bold focus:border-[#057E2E] outline-none" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Weight (%)</label>
                    <input type="number" name="percentage" x-model.number="inputWeight" min="1" max="{{ $remaining }}" class="w-full border-2 border-gray-100 rounded-xl p-3 text-sm font-bold focus:border-[#057E2E] outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Computation</label>
                    <select name="calculation_method" class="w-full border-2 border-gray-100 rounded-xl p-3 text-sm font-bold focus:border-[#057E2E] outline-none">
                        <option value="average">Average</option>
                        <option value="highest">Highest</option>
                        <option value="latest">Latest</option>
                    </select>
                </div>
            </div>
            <template x-if="inputWeight > {{ $remaining }}">
                <p class="text-[10px] font-bold text-red-500 text-center">Weight exceeds remaining limit!</p>
            </template>
            <button type="submit" :disabled="inputWeight > {{ $remaining }} || inputWeight <= 0"
                    :class="inputWeight > {{ $remaining }} || inputWeight <= 0 ? 'bg-gray-200 text-gray-400' : 'bg-[#057E2E] text-white hover:bg-[#046324]'"
                    class="w-full py-4 rounded-2xl font-black text-sm transition-all shadow-lg shadow-[#057E2E]/20">
                Save Category
            </button>
        </form>
    </div>
</div>