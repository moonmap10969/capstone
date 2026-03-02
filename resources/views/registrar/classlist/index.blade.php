<!DOCTYPE html>
<html lang="en" x-data="{ yearFilter: 'all' }">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Class Lists</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none;}</style>
</head>

<body class="min-h-screen flex bg-gray-100">

@include('layouts.sidebar.registrar')
<main class="flex-1 flex h-screen overflow-hidden bg-[#F3F4F6]" x-data="{ activeGrade: '{{ $yearLevels->first() }}' }">
    <aside class="w-52 bg-white text-black flex flex-col shrink-0">
        <div class="p-4 bg-white text-[10px] font-bold uppercase tracking-widest text-black">Year Levels</div>
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">
        @foreach($yearLevels as $level)
            <button @click="activeGrade = '{{ $level }}'"
                    :class="activeGrade === '{{ $level }}' 
                        ? 'bg-white text-green-700 border-y border-slate-200 shadow-sm' 
                        : 'text-slate-400 hover:bg-slate-50'"
                    class="w-full h-12 flex justify-center items-center px-5 text-[11px] font-black uppercase tracking-[0.2em] transition-all duration-200">
                {{ $level }}
            </button>
        @endforeach
    </nav>
    </aside>

    <section class="flex-1 overflow-y-auto p-6">
    <div class="mb-6 flex items-center justify-between bg-white p-4 rounded-sm border border-gray-200">
        <h1 class="text-lg font-black text-gray-800 uppercase tracking-tight">Sectional Class Lists</h1>
        <div class="flex items-center gap-3">
            <label class="text-[10px] font-black text-gray-400 uppercase">School Year:</label>
            <select onchange="window.location.href='?academic_year='+this.value" 
                    class="border border-gray-300 rounded-lg px-3 py-1.5 text-xs font-bold text-gray-600 outline-none focus:border-green-600">
                @foreach($academicYears as $ay)
                    <option value="{{ $ay->id }}" {{ request('academic_year', $activeYear->id) == $ay->id ? 'selected' : '' }}>
                        {{ $ay->year_range }} ({{ $ay->semester }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    @foreach($sections as $yearLevel => $levelSections)
        <div x-show="activeGrade === '{{ $yearLevel }}'" x-cloak class="space-y-6">
            @foreach($levelSections as $section)
                <div class="bg-white border border-gray-200 shadow-sm rounded-sm">
                    <div class="bg-[#F9FAFB] px-6 py-4 border-b flex justify-between items-center">
                        <h2 class="text-sm font-bold text-gray-700 uppercase">{{ $section->name }}</h2>
                        <span class="text-[10px] bg-green-100 text-green-700 px-2 py-1 rounded-full font-bold">
                            {{ $section->enrollments->where('admission.academic_year_id', request('academic_year', $activeYear->id))->count() }} Students
                        </span>
                    </div>

                    <table class="w-full text-left text-[12px]">
                        <thead>
                            <tr class="bg-gray-50 text-gray-400 uppercase text-[10px] border-b">
                                <th class="px-6 py-2 font-bold w-16">#</th>
                                <th class="px-6 py-2 font-bold">Student No.</th>
                                <th class="px-6 py-2 font-bold">Name</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @php
                                $filteredEnrollments = $section->enrollments
                                    ->where('admission.academic_year_id', request('academic_year', $activeYear->id))
                                    ->sortBy('admission.studentLastName');
                            @endphp

                            @forelse($filteredEnrollments as $enrollment)
                                <tr class="hover:bg-green-50/50">
                                    <td class="px-6 py-2 text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-2 font-mono text-green-600">{{ $enrollment->admission->studentNumber }}</td>
                                    <td class="px-6 py-2 font-semibold text-gray-700 uppercase">
                                        {{ $enrollment->admission->studentLastName }}, {{ $enrollment->admission->studentFirstName }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">No students enrolled in this year.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach
</section>
</main>