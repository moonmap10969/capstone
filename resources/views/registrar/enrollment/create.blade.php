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
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen bg-[#F8FAFC] flex" x-data="{ 
    selectedStudent: null,
    burstMode: false,
    selectedIds: [], 
    searchQuery: '',
    yearFilter: 'all',
    typeFilter: 'all',
    currentBurstYear: null,
    selectedSectionId: '',
    showScheduleModal: false,
    enrollmentGradeLevel: '',
    autoStudentNumber: '',
    sections: {{ $sections->map(fn($s) => ['id' => $s->section_id, 'name' => $s->name, 'count' => (int)$s->enrollments_count, 'max' => (int)($s->capacity ?? 40), 'year' => $s->year_level])->values()->toJson() }},
    allSchedules: {{ $schedules->groupBy('section_id')->toJson() }},
    days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],

    get isSectionFull() {
        const section = this.sections.find(s => s.id == this.selectedSectionId);
        if (!section) return false;
        return (section.count + this.selectedIds.length) > section.max;
    },

    get activeSectionName() {
        return this.sections.find(s => s.id == this.selectedSectionId)?.name || '';
    },

    getScheduleForDay(day) {
        return (this.allSchedules[this.selectedSectionId] || [])
            .filter(item => item.day_of_week === day)
            .sort((a, b) => a.start_time.localeCompare(b.start_time));
    },

    handleSelection(id, firstName, lastName, yearLevel, studentNo, type, balance) {
        if (balance > 0) {
            alert('Cannot select student. Outstanding balance: ₱' + parseFloat(balance).toFixed(2));
            return;
        }
        
        this.selectedSectionId = ''; 
        if (!this.burstMode) {
            this.selectedIds = [id];
            this.selectedStudent = { id, studentFirstName: firstName, studentLastName: lastName, year_level: yearLevel, student_type: type };
            this.enrollmentGradeLevel = yearLevel;
            this.autoStudentNumber = studentNo;
            return;
        }
        if (this.selectedIds.length > 0 && this.currentBurstYear !== yearLevel) {
            alert('Burst Mode Error: You can only bulk-enroll students from ' + this.currentBurstYear);
            return;
        }
        if (this.selectedIds.includes(id)) {
            this.selectedIds = this.selectedIds.filter(i => i !== id);
            if (this.selectedIds.length === 0) {
                this.currentBurstYear = null;
                this.enrollmentGradeLevel = '';
            }
        } else {
            this.selectedIds.push(id);
            this.currentBurstYear = yearLevel;
            this.enrollmentGradeLevel = yearLevel;
        }
    },

    selectAll() {
        const visibleStudents = Array.from(document.querySelectorAll('[data-student-card]'))
            .filter(el => el.style.display !== 'none' && !el.hasAttribute('disabled-card'))
            .map(el => {
                return {
                    id: parseInt(el.getAttribute('data-id')),
                    year: el.getAttribute('data-year')
                };
            });

        if (visibleStudents.length === 0) return;

        if (this.yearFilter !== 'all') {
            this.selectedIds = visibleStudents.map(s => s.id);
            this.currentBurstYear = this.yearFilter;
            this.enrollmentGradeLevel = this.yearFilter;
        } else {
            alert('Please filter by a specific Grade Level before using Select All to ensure section compatibility.');
        }
    }
}">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center shrink-0">
            <div class="flex items-center gap-4">
                <a href="{{ route('registrar.enrollment.index') }}" class="p-2.5 rounded-xl border border-slate-200 text-slate-500 hover:bg-slate-50 shadow-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Enrollment Portal</h1>
                    <p class="text-xs text-slate-500 font-medium tracking-tight">Assigning approved students to sections.</p>
                </div>
            </div>

            <button @click="burstMode = !burstMode; selectedStudent = null; selectedIds = []; currentBurstYear = null; selectedSectionId = '';" 
                    :class="burstMode ? 'bg-green-700 text-white shadow-green-200' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'"
                    class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 shadow-sm">
                <div :class="burstMode ? 'animate-pulse bg-white' : 'bg-slate-400'" class="w-2 h-2 rounded-full"></div>
                <span x-text="burstMode ? 'Exit Burst Mode' : 'Enable Burst Mode'"></span>
            </button>
        </header>

        <div class="flex-1 flex overflow-hidden">
            {{-- Sidebar: Student Queue --}}
            <aside class="w-80 bg-white border-r border-slate-200 flex flex-col shrink-0">
                <div class="p-4 border-b border-slate-100 space-y-3 bg-slate-50/30">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Student Queue</span>
                        <button x-show="burstMode" @click="selectAll()" class="text-[10px] font-black text-green-600 uppercase tracking-widest hover:underline">Select All Visible</button>
                    </div>
                    <div class="relative">
                        <input type="text" x-model="searchQuery" placeholder="Search name..." class="w-full bg-white border border-slate-200 rounded-lg py-2.5 pl-9 text-sm outline-none focus:ring-2 focus:ring-green-500/20">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2.5"/></svg>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <select x-model="yearFilter" class="w-full bg-white border border-slate-200 rounded-lg text-[9px] font-bold p-2 uppercase text-slate-600 outline-none">
                            <option value="all">All Levels</option>
                            @foreach($approvedAdmissions->pluck('year_level')->unique() as $level)
                                <option value="{{ $level }}">{{ $level }}</option>
                            @endforeach
                        </select>
                        <select x-model="typeFilter" class="w-full bg-white border border-slate-200 rounded-lg text-[9px] font-bold p-2 uppercase text-slate-600 outline-none">
                            <option value="all">All Types</option>
                            <option value="new">New</option>
                            <option value="returning">Returning</option>
                        </select>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-2">
                    @forelse($approvedAdmissions as $student)
                    <div x-show="(yearFilter === 'all' || '{{ $student->year_level }}' === yearFilter) && (typeFilter === 'all' || '{{ $student->student_type ?? 'new' }}' === typeFilter) && ('{{ $student->studentFirstName }} {{ $student->studentLastName }}').toLowerCase().includes(searchQuery.toLowerCase())"
                         data-student-card data-id="{{ $student->id }}" data-year="{{ $student->year_level }}"
                         {{ $student->balance > 0 ? 'disabled-card' : '' }}
                         @click="handleSelection({{ $student->id }}, '{{ $student->studentFirstName }}', '{{ $student->studentLastName }}', '{{ $student->year_level }}', '{{ $student->studentNumber ?? 'NO-SN' }}', '{{ $student->student_type ?? 'new' }}', {{ $student->balance ?? 0 }})"
                         :class="selectedIds.includes({{ $student->id }}) ? 'bg-green-50 border-green-500' : 'bg-white border-slate-100 hover:border-slate-300 shadow-sm'"
                         class="p-4 rounded-xl border-2 transition-all cursor-pointer group relative {{ $student->balance > 0 ? 'opacity-60 bg-red-50 hover:border-red-300 cursor-not-allowed' : '' }}">
                        <div class="flex justify-between items-center relative z-10">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $student->studentFirstName }} {{ $student->studentLastName }}</p>
                                <div class="flex gap-1 mt-1 flex-wrap">
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase tracking-tighter">{{ $student->year_level }}</span>
                                    <span class="px-2 py-0.5 text-[9px] font-black rounded uppercase tracking-tighter" :class="'{{ $student->student_type ?? 'new' }}' === 'new' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600'">{{ $student->student_type ?? 'new' }}</span>
                                    
                                    {{-- Outstanding Balance Flag --}}
                                    @if($student->balance > 0)
                                        <span class="px-2 py-0.5 bg-red-100 text-red-700 text-[9px] font-black rounded uppercase tracking-widest w-full mt-1.5 border border-red-200 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            Balance: ₱{{ number_format($student->balance, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <template x-if="selectedIds.includes({{ $student->id }})">
                                <div class="bg-green-600 rounded-full p-1 shadow-sm shrink-0 ml-2">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            </template>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10"><p class="text-xs text-slate-400 font-medium uppercase tracking-widest">No pending admissions</p></div>
                    @endforelse
                </div>
            </aside>

            {{-- Main Config Area --}}
            <section class="flex-1 overflow-y-auto p-8 lg:p-12 bg-[#FBFDFF]">
                <div class="max-w-3xl mx-auto">
                    <div x-show="selectedIds.length === 0" class="text-center py-24 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-white/50">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Select students to configure enrollment</p>
                    </div>

                    <div x-show="selectedIds.length > 0" x-cloak class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-2xl space-y-8">
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 tracking-tight" x-text="burstMode ? 'Batch Enrollment Configuration' : (selectedStudent?.studentFirstName + ' ' + selectedStudent?.studentLastName)"></h2>
                            <p class="text-green-600 font-black text-xs mt-1 uppercase tracking-[0.2em]" x-text="'Active Queue: ' + selectedIds.length + ' Student(s)'"></p>
                        </div>

                        <form id="enrollmentForm" action="{{ route('registrar.enrollment.store') }}" method="POST" class="grid grid-cols-2 gap-8">
                            @csrf
                            <template x-for="id in selectedIds" :key="id">
                                <input type="hidden" name="admission_ids[]" :value="id">
                            </template>
                            <input type="hidden" name="school_year" value="2026-2027">
                            
                            <div class="col-span-2 space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Target Grade Level</label>
                                <select name="year_level" x-model="enrollmentGradeLevel" class="w-full bg-slate-50 border-2 border-slate-100 p-4 rounded-2xl font-bold text-slate-800 outline-none focus:border-green-500 transition-all shadow-sm" required>
                                    <option value="">Confirm Level...</option>
                                        @foreach([
                                            'kinder1', 'kinder2', 'kinder3', 
                                            'grade1', 'grade2', 'grade3', 'grade4', 'grade5', 'grade6', 
                                            'grade7', 'grade8', 'grade9', 'grade10'
                                        ] as $level)
                                            <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Daily Shift</label>
                                <select name="shift" class="w-full bg-white border-2 border-slate-100 p-4 rounded-2xl font-bold text-slate-700 outline-none focus:border-green-500 shadow-sm transition-all" required>
                                    <option value="morning">Morning Shift</option>
                                    <option value="afternoon">Afternoon Shift</option>
                                    <option value="whole day">Full Day Session</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Section Assignment</label>
                                <select name="section_id" x-model="selectedSectionId" @change="if($el.value) { showScheduleModal = true; }"
                                        :class="isSectionFull ? 'border-red-500 bg-red-50 text-red-600' : 'border-slate-100 focus:border-green-500'"
                                        class="w-full border-2 p-4 rounded-2xl font-bold text-slate-700 outline-none shadow-sm transition-all" required>
                                    <option value="">Select Class Section...</option>
                                    <template x-for="section in sections.filter(s => s.year === enrollmentGradeLevel)" :key="section.id">
                                        <option :value="section.id" :disabled="(section.count + selectedIds.length) > section.max" 
                                                x-text="section.name + ' (' + section.count + '/' + section.max + ')'"></option>
                                    </template>
                                </select>
                                <p x-show="isSectionFull" class="text-[10px] text-red-500 font-bold uppercase mt-2 text-center tracking-widest">! Section is at capacity</p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        {{-- Schedule Modal Overlay --}}
        <div x-show="showScheduleModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm transition-opacity">
            <div @click.away="showScheduleModal = false" class="bg-white w-full max-w-6xl rounded-[3rem] shadow-2xl overflow-hidden">
                <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="font-black text-slate-800 uppercase tracking-widest text-xl">Section Schedule Matrix</h3>
                        <p class="text-xs text-green-600 font-bold uppercase mt-1">Previewing: <span class="underline" x-text="activeSectionName"></span></p>
                    </div>
                    <button @click="showScheduleModal = false" class="p-3 bg-white rounded-2xl shadow-sm border border-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3"/></svg>
                    </button>
                </div>
                
                <div class="p-10">
                    <div class="grid grid-cols-5 gap-6 overflow-x-auto pb-6 custom-scrollbar">
                        <template x-for="day in days" :key="day">
                            <div class="flex flex-col gap-4 min-w-[180px]">
                                <div class="bg-gradient-to-br from-green-600 to-green-800 text-white text-center py-4 rounded-2xl shadow-lg border border-green-500/20">
                                    <span class="text-[11px] font-black uppercase tracking-[0.2em]" x-text="day"></span>
                                </div>
                                <div class="flex flex-col gap-3 min-h-[350px] p-2 bg-green-50/30 rounded-2xl border border-dashed border-green-200/50">
                                    <template x-for="item in getScheduleForDay(day)" :key="item.id">
                                        <div class="bg-white border-l-4 border-l-green-600 border border-slate-200 p-4 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                            <p class="text-[10px] font-black text-green-700" x-text="item.start_time.substring(0,5) + ' - ' + item.end_time.substring(0,5)"></p>
                                            <p class="text-xs font-black text-slate-800 mt-1 uppercase" x-text="item.subject"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-10 flex gap-6">
                        <button @click="showScheduleModal = false" class="px-10 py-5 rounded-2xl font-black text-slate-400 border-2 border-slate-100 hover:bg-slate-50 transition-colors uppercase text-xs tracking-widest">Back to Config</button>
                        <button @click="document.getElementById('enrollmentForm').submit()" 
                                :disabled="isSectionFull"
                                :class="isSectionFull ? 'bg-slate-300 cursor-not-allowed opacity-50' : 'bg-green-700 hover:bg-green-800 shadow-xl shadow-green-700/20 hover:-translate-y-1'"
                                class="flex-1 text-white py-5 rounded-2xl font-black transition-all flex items-center justify-center gap-4 active:scale-95">
                            <span class="text-sm uppercase tracking-widest">Finalize & Commit Enrollment</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    {{-- Error & Success Notifications --}}
    <div x-data="{ 
            show: false, message: '', isError: false,
            init() { 
                @if(session('success')) this.trigger('{{ session('success') }}', false); @endif 
                @if(session('error')) this.trigger('{{ session('error') }}', true); @endif 
            },
            trigger(msg, err) { this.message = msg; this.isError = err; this.show = true; setTimeout(() => this.show = false, 5000); }
         }"
         x-show="show" x-cloak class="fixed bottom-10 right-10 z-[100] bg-white border-l-8 shadow-2xl rounded-2xl p-6 flex items-center gap-5 min-w-[350px]"
         :class="isError ? 'border-red-500' : 'border-green-500'">
        <div class="p-3 rounded-xl shadow-sm" :class="isError ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'">
            <svg x-show="!isError" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"/></svg>
            <svg x-show="isError" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest" :class="isError ? 'text-red-500' : 'text-green-500'" x-text="isError ? 'Enrollment Blocked' : 'Success'"></p>
            <p class="text-sm font-bold text-slate-800 mt-0.5" x-text="message"></p>
        </div>
    </div>
</body>
</html>