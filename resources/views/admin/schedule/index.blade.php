<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen flex bg-white">

    @include('admin.layouts.sidebar')

    @php
        $levels = [
            'kinder1' => 'K1', 'kinder2' => 'K2', 'kinder3' => 'K3',
            'grade1'  => 'G1', 'grade2'  => 'G2', 'grade3'  => 'G3',
            'grade4'  => 'G4', 'grade5'  => 'G5', 'grade6'  => 'G6',
            'grade7'  => 'G7', 'grade8'  => 'G8', 'grade9'  => 'G9', 'grade10' => 'G10'
        ];
        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $grouped = $schedules->groupBy(['year_level', 'section']);
        $defaultGrade = $schedules->first()->year_level ?? 'grade1';
    @endphp

    <main class="flex-1 p-6 lg:p-10 w-full overflow-y-auto" 
          x-data="{ activeGrade: '{{ $defaultGrade }}', activeSection: {} }"
          x-init="@foreach($grouped as $gLvl => $sects) activeSection['{{ $gLvl }}'] = '{{ $sects->keys()->first() }}'; @endforeach">
        
        <div class="max-w-full mx-auto space-y-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-gray-200 pb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-green-700">Schedule Management</h1>
                    <p class="text-gray-500 text-sm">Weekly View (Active Days Only)</p>
                </div>
                <a href="{{ route('admin.schedule.create') }}" class="px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Entry
                </a>
            </div>

            <div class="flex flex-wrap gap-1">
                @foreach($levels as $val => $label)
                    @if(isset($grouped[$val]))
                        <button @click="activeGrade = '{{ $val }}'"
                                :class="activeGrade === '{{ $val }}' ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                                class="px-3 py-1.5 rounded text-[10px] font-bold uppercase tracking-widest transition-all">
                            {{ $label }}
                        </button>
                    @endif
                @endforeach
            </div>

            @foreach($grouped as $gradeLevel => $sections)
                <div x-show="activeGrade === '{{ $gradeLevel }}'" class="space-y-4">
                    <div class="flex gap-4 border-b border-gray-100">
                        @foreach($sections as $sectionName => $items)
                            <button @click="activeSection['{{ $gradeLevel }}'] = '{{ $sectionName }}'"
                                    :class="activeSection['{{ $gradeLevel }}'] === '{{ $sectionName }}' ? 'border-green-700 text-black' : 'border-transparent text-gray-400'"
                                    class="pb-2 px-1 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">
                                {{ $sectionName }}
                            </button>
                        @endforeach
                    </div>

                    @foreach($sections as $sectionName => $scheds)
                        @php $activeDays = $allDays; @endphp
                        <div x-show="activeSection['{{ $gradeLevel }}'] === '{{ $sectionName }}'" class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left table-fixed min-w-[800px]">
                                    <thead>
                                        <tr class="bg-green-700 border-b border-gray-200">
                                            @foreach($allDays as $day)
                                                @if($scheds->where('day_of_week', $day)->count() > 0)
                                                    <th class="px-4 py-3 text-[10px] font-bold uppercase text-white border-r border-gray-200 last:border-0">{{ $day }}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr>
                                            @foreach($allDays as $day)
                                                @if($scheds->where('day_of_week', $day)->count() > 0)
                                                    <td class="p-2 align-top border-r border-green-700last:border-0 bg-white min-h-[400px]">
                                                        @foreach($scheds->where('day_of_week', $day)->sortBy('start_time') as $s)
                                                            <div class="mb-2 p-3 border border-gray-200 rounded-lg group hover:border-black transition-all relative">
                                                                <div class="text-[10px] font-bold text-gray-400 mb-1 flex items-center gap-1">
                                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                    {{ \Carbon\Carbon::parse($s->start_time)->format('g:i A') }}
                                                                </div>
                                                                <div class="text-xs font-bold text-black uppercase mb-2">{{ $s->subject }}</div>
                                                                <div class="space-y-1">
                                                                    <div class="flex items-center gap-2 text-[10px] text-gray-600 font-medium">
                                                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                                        {{ $s->teacher }}
                                                                    </div>
                                                                    <div class="flex items-center gap-2 text-[10px] text-gray-600 font-medium">
                                                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                                        {{ $s->room }}
                                                                    </div>
                                                                </div>
                                                                <div class="absolute top-2 right-2 hidden group-hover:flex gap-1">
                                                                    <a href="{{ route('admin.schedule.edit', $s) }}" class="p-1 hover:text-black text-gray-300">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                                    </a>
                                                                    <form action="{{ route('admin.schedule.destroy', $s) }}" method="POST" onsubmit="return confirm('Delete?')">
                                                                        @csrf @method('DELETE')
                                                                        <button class="p-1 hover:text-red-600 text-gray-300">
                                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>