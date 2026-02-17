<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Enrollment Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen bg-[#F8FAFC] flex" x-data="{ 
    selectedStudent: null,
    burstMode: false,
    selectedIds: [], 
    searchQuery: '',
    yearFilter: 'all',
    currentBurstYear: null,
    selectedSectionId: '',
    sections: {{ $sections->map(fn($s) => ['id' => $s->section_id, 'count' => $s->enrollments_count, 'max' => $s->capacity ?? 40, 'year' => $s->year_level])->toJson() }},

    get isSectionFull() {
        const section = this.sections.find(s => s.id == this.selectedSectionId);
        if (!section) return false;
        const incomingCount = this.burstMode ? this.selectedIds.length : 1;
        return (section.count + incomingCount) > section.max;
    },

    handleSelection(id, firstName, lastName, yearLevel) {
        this.selectedSectionId = ''; 
        if (!this.burstMode) {
            this.selectedIds = [];
            this.selectedStudent = { id, studentFirstName: firstName, studentLastName: lastName, year_level: yearLevel };
            return;
        }
        if (this.selectedIds.length > 0 && this.currentBurstYear !== yearLevel) {
            alert('Burst Mode Error: You can only bulk-enroll students from ' + this.currentBurstYear);
            return;
        }
        if (this.selectedIds.includes(id)) {
            this.selectedIds = this.selectedIds.filter(i => i !== id);
            if (this.selectedIds.length === 0) this.currentBurstYear = null;
        } else {
            this.selectedIds.push(id);
            this.currentBurstYear = yearLevel;
        }
    }
}">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
<header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center shrink-0">
    <div class="flex items-center gap-4">
        <a href="{{ route('registrar.enrollment.index') }}" 
           class="p-2.5 rounded-xl border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all shadow-sm group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        
        <div>
            <h1 class="text-xl font-bold text-slate-800">Enrollment Portal</h1>
            <p class="text-xs text-slate-500 font-medium">Assign approved admissions to class sections.</p>
        </div>
    </div>

    <button @click="burstMode = !burstMode; selectedStudent = null; selectedIds = []; currentBurstYear = null; selectedSectionId = ''" 
            :class="burstMode ? 'bg-green-700 text-white shadow-green-200' : 'bg-white text-slate-600 border border-slate-200'"
            class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 shadow-sm hover:scale-105">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span x-text="burstMode ? 'Exit Burst' : 'Burst Mode'"></span>
    </button>
</header>

        <div class="flex-1 flex overflow-hidden">
            <aside class="w-80 bg-white border-r border-slate-200 flex flex-col shrink-0">
                <div class="p-4 border-b border-slate-100 space-y-3 bg-slate-50/30">
                    <div class="relative">
                        <input type="text" x-model="searchQuery" placeholder="Search name..." class="w-full bg-white border border-slate-200 rounded-lg py-2 pl-8 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600">
                        <svg class="w-4 h-4 absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"/></svg>
                    </div>
                    <select x-model="yearFilter" class="w-full bg-white border border-slate-200 rounded-lg text-[10px] font-bold p-2 uppercase text-slate-600 outline-none cursor-pointer">
                        <option value="all">Filter: All Levels</option>
                        @foreach($approvedAdmissions->pluck('year_level')->unique() as $level)
                            <option value="{{ $level }}">{{ $level }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-2">
                    @forelse($approvedAdmissions as $student)
                    <div x-show="(yearFilter === 'all' || '{{ $student->year_level }}' === yearFilter) && ('{{ $student->studentFirstName }} {{ $student->studentLastName }}').toLowerCase().includes(searchQuery.toLowerCase())"
                         @click="handleSelection({{ $student->id }}, '{{ $student->studentFirstName }}', '{{ $student->studentLastName }}', '{{ $student->year_level }}')"
                         :class="(!burstMode && selectedStudent?.id === {{ $student->id }}) || (burstMode && selectedIds.includes({{ $student->id }})) ? 'bg-green-50 border-green-500' : 'bg-white border-slate-100 hover:border-slate-300'"
                         class="p-4 rounded-xl border-2 transition-all cursor-pointer group">
                        <div class="flex justify-between items-center">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $student->studentFirstName }} {{ $student->studentLastName }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase tracking-tighter">{{ $student->year_level }}</span>
                            </div>
                            <template x-if="burstMode && selectedIds.includes({{ $student->id }})">
                                <div class="bg-green-600 rounded-full p-1 shadow-sm">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            </template>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 space-y-2">
                        <p class="text-xs text-slate-400 font-medium">No students awaiting enrollment.</p>
                    </div>
                    @endforelse
                </div>
            </aside>

            <section class="flex-1 overflow-y-auto p-12 bg-[#FBFDFF]">
                <div class="max-w-2xl mx-auto">
                    <div x-show="!selectedStudent && selectedIds.length === 0" class="text-center py-20 border-2 border-dashed border-slate-200 rounded-3xl">
                        <p class="text-slate-400 font-bold text-sm">Select a student from the sidebar to begin.</p>
                    </div>

                    {{-- Form Templates Shared Style --}}
                    <template x-if="(!burstMode && selectedStudent) || (burstMode && selectedIds.length > 0)">
                        <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-xl space-y-8 animate-in fade-in zoom-in duration-300">
                            <div>
                                <h2 class="text-3xl font-black text-slate-800" x-text="burstMode ? 'Burst Enrollment' : (selectedStudent.studentFirstName + ' ' + selectedStudent.studentLastName)"></h2>
                                <p class="text-green-600 font-bold text-sm mt-1 uppercase tracking-widest" x-text="burstMode ? 'Assigning ' + selectedIds.length + ' students to ' + currentBurstYear : 'Processing Grade Level: ' + selectedStudent.year_level"></p>
                            </div>

                            <form action="{{ route('registrar.enrollment.store') }}" method="POST" class="grid grid-cols-2 gap-6">
                                @csrf
                                <input type="hidden" name="admission_ids" :value="burstMode ? JSON.stringify(selectedIds) : JSON.stringify([selectedStudent.id])">
                                
                                <div class="col-span-2 space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Available Sections</label>
                                    <select name="section_id" 
                                            x-model="selectedSectionId"
                                            :class="isSectionFull ? 'border-red-500 bg-red-50 focus:ring-red-200' : 'border-slate-200 focus:border-green-600'"
                                            class="w-full bg-slate-50 border p-4 rounded-xl font-bold outline-none transition-all" required>
                                        <option value="">Select Section...</option>
                                        @foreach($sections as $section) 
                                            @php $isFull = $section->enrollments_count >= ($section->capacity ?? 40); @endphp
                                            <option x-show="(burstMode ? currentBurstYear : selectedStudent.year_level) === '{{ $section->year_level }}'" 
                                                    value="{{ $section->section_id }}"
                                                    class="{{ $isFull ? 'text-red-500' : '' }}">
                                                {{ $section->name }} ({{ $section->enrollments_count }}/{{ $section->capacity ?? 40 }}) {{ $isFull ? '— FULL' : '' }}
                                            </option> 
                                        @endforeach
                                    </select>
                                    
                                    <template x-if="isSectionFull">
                                        <p class="text-red-500 text-[10px] font-black uppercase mt-1 animate-pulse">This section is at capacity for this request.</p>
                                    </template>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Shift</label>
                                    <select name="shift" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-xl font-bold outline-none" required>
                                        <option value="morning">Morning</option>
                                        <option value="afternoon">Afternoon</option>
                                        <option value="whole day">Whole Day</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Academic Year</label>
                                    <input type="text" name="school_year" value="{{ date('Y') . '-' . (date('Y') + 1) }}" readonly class="w-full bg-slate-100 border-none p-4 rounded-xl font-bold text-slate-400">
                                </div>

                                <button type="submit" 
                                        :disabled="isSectionFull || !selectedSectionId"
                                        :class="isSectionFull || !selectedSectionId ? 'bg-slate-300 cursor-not-allowed shadow-none' : 'bg-green-700 hover:bg-green-800 shadow-green-100'"
                                        class="col-span-2 text-white py-5 rounded-2xl font-black transition-all shadow-lg">
                                    <span x-text="isSectionFull ? 'Section Over Capacity' : 'Finalize Enrollment'"></span>
                                </button>
                            </form>
                        </div>
                    </template>
                </div>
            </section>
        </div>
    </main>
</body>
</html>