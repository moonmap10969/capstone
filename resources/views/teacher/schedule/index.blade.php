<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex min-h-screen">

    <aside class="w-64 bg-white border-r border-gray-100 hidden md:block">
        @include('layouts.sidebar.teacher')
    </aside>

    @php
        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = $schedules->sortBy('start_time')->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->start_time)->format('g:i A');
        });
    @endphp

    <main class="flex-1 p-4 lg:p-6">
        <div class="max-w-full mx-auto space-y-4">
            
            <div class="flex justify-between items-center px-1">
                <h1 class="text-xl font-extrabold text-gray-900 tracking-tight">Weekly Schedule</h1>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">2025-2026</span>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <table class="w-full text-left table-fixed border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-3 py-3 text-[10px] font-extrabold uppercase text-gray-400 border-r border-gray-100 w-24">Time</th>
                            @foreach($allDays as $day)
                                <th class="px-2 py-3 text-[10px] font-extrabold uppercase text-gray-700 text-center tracking-tight">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($timeSlots as $time => $entries)
                        <tr>
                            <td class="px-3 py-4 text-[10px] font-bold text-gray-400 bg-gray-50/20 border-r border-gray-100 whitespace-nowrap">
                                {{ $time }}
                            </td>
                            @foreach($allDays as $day)
                                @php $match = $entries->where('day_of_week', $day)->first(); @endphp
                                <td class="p-1 h-full align-middle">
                                    @if($match)
                                        <div class="bg-white border border-gray-200 p-2 rounded-lg shadow-sm hover:border-green-600 transition-colors">
                                            <p class="text-[8px] font-extrabold text-green-700 uppercase leading-none mb-1">Sec {{ $match->section }}</p>
                                            <h4 class="text-[11px] font-extrabold text-gray-800 leading-tight truncate uppercase">{{ $match->subject }}</h4>
                                            <div class="flex justify-between items-center mt-1 text-[8px] font-bold text-gray-400">
                                                <span>{{ $match->room }}</span>
                                                <span class="text-gray-300">|</span>
                                                <span>{{ $match->section_model ? $match->section_model->enrollments->count() : '0' }} STU</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-xs font-bold text-gray-300 uppercase tracking-widest">No assigned classes.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex items-center gap-4 px-2">
                <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-green-600"></span><span class="text-[9px] font-bold text-gray-400 uppercase">Assigned</span></div>
                <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-gray-200"></span><span class="text-[9px] font-bold text-gray-400 uppercase">Available</span></div>
            </div>

        </div>
    </main>
</body>
</html>