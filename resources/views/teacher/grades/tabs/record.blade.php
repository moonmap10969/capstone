<div class="space-y-6" x-data="{ 
    openModal: false, 
    selectedStudent: null,
    searchQuery: '',
    components: {{ json_encode($components) }},
    viewDetails(student) {
        this.selectedStudent = student;
        this.openModal = true;
    }
}">
    {{-- Dashboard Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 transition-all hover:shadow-md">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Class Average</p>
            <h3 class="text-3xl font-black text-[#057E2E] tracking-tighter">{{ number_format($classAverage ?? 0, 2) }}%</h3>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 transition-all hover:shadow-md">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Passing Rate</p>
            <h3 class="text-3xl font-black text-blue-600 tracking-tighter">{{ number_format($passingRate ?? 0, 1) }}%</h3>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 transition-all hover:shadow-md">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Highest Grade</p>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($highestGrade ?? 0, 2) }}%</h3>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 transition-all hover:shadow-md">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Enrolled</p>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">{{ count($enrollments ?? []) }}</h3>
        </div>
    </div>

    {{-- Class Record Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50/40">
            <div>
                <h2 class="text-sm font-black text-gray-800 uppercase tracking-tight">Final Summarized Class Record</h2>
                <p class="text-[9px] font-bold text-[#057E2E] uppercase tracking-[0.15em] mt-1">Official Academic Grading System</p>
            </div>
            <div class="relative w-full md:w-80">
                <input type="text" x-model="searchQuery" placeholder="SEARCH STUDENT..." 
                       class="w-full border-2 border-gray-100 rounded-xl px-11 py-3 text-[10px] font-black outline-none focus:border-[#057E2E] focus:ring-0 transition-all uppercase tracking-widest">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <table class="min-w-full border-separate border-spacing-0">
            <thead>
                <tr class="bg-white">
                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Student Profile</th>
                    <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Final Rating</th>
                    <th class="px-8 py-5 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($enrollments ?? [] as $enrollment)
                <tr x-show="searchQuery === '' || '{{ strtolower($enrollment->admission->studentLastName . ' ' . $enrollment->admission->studentFirstName) }}'.includes(searchQuery.toLowerCase())" 
                    class="hover:bg-[#057E2E]/[0.02] transition-colors group cursor-pointer" @click="viewDetails({{ $enrollment }})">
                    <td class="px-8 py-5">
                        <div class="text-[12px] font-black text-gray-800 group-hover:text-[#057E2E] transition-colors uppercase tracking-tight">
                            {{ $enrollment->admission->studentLastName }}, {{ $enrollment->admission->studentFirstName }}
                        </div>
                        {{-- STUDENT NUMBER DISPLAY --}}
                        <div class="text-[10px] font-black text-gray-900 font-mono tracking-tighter uppercase mt-1">
                            <span class="text-gray-400">ID:</span> {{ $enrollment->student_number }}
                        </div>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="inline-block px-5 py-2 bg-gray-900 rounded-xl text-[13px] font-black text-white shadow-sm">
                            {{ number_format($enrollment->final_percentage ?? 0, 2) }}%
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <span class="inline-block px-4 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest border-2 {{ ($enrollment->final_percentage ?? 0) >= 75 ? 'bg-green-50 text-[#057E2E] border-green-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                            {{ ($enrollment->final_percentage ?? 0) >= 75 ? 'PASSED' : 'FAILED' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="p-24 text-center text-[11px] font-black text-gray-300 uppercase tracking-[0.3em]">No academic records found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Detail Modal --}}
    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-md w-full overflow-hidden border border-gray-100" @click.away="openModal = false">
            <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-tight" x-text="selectedStudent ? selectedStudent.admission.studentLastName + ', ' + selectedStudent.admission.studentFirstName : ''"></h3>
                    {{-- MODAL STUDENT NUMBER --}}
                    <p class="text-[10px] font-black text-[#057E2E] uppercase tracking-widest mt-1" x-text="selectedStudent ? 'STUDENT NO: ' + selectedStudent.student_number : ''"></p>
                </div>
                <button @click="openModal = false" class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm text-gray-400 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="p-10 space-y-6">
                <template x-for="component in components" :key="component.id">
                    <div class="space-y-2">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.15em]" x-text="component.category"></p>
                                <p class="text-[9px] font-bold text-gray-300 uppercase" x-text="'Weight: ' + component.percentage + '%'"></p>
                            </div>
                            <span class="font-black text-gray-900 text-[13px] tracking-tight" x-text="selectedStudent ? parseFloat(selectedStudent.final_percentage).toFixed(2) + '%' : '0.00%'"></span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-[#057E2E] h-full rounded-full transition-all duration-1000" :style="'width: ' + (selectedStudent ? selectedStudent.final_percentage : 0) + '%'"></div>
                        </div>
                    </div>
                </template>

                <div class="pt-8 border-t-4 border-double border-gray-100 mt-8 flex justify-between items-center">
                    <span class="text-[12px] font-black text-gray-400 uppercase tracking-widest">Final Weighted Grade</span>
                    <span class="text-4xl font-black text-gray-900 tracking-tighter" x-text="selectedStudent ? parseFloat(selectedStudent.final_percentage).toFixed(2) + '%' : '0.00%'"></span>
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100">
                <button @click="openModal = false" class="w-full py-4 bg-gray-900 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg hover:bg-black transition-all">
                    Return to Records
                </button>
            </div>
        </div>
    </div>
</div>