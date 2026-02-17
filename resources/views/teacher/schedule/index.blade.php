<!DOCTYPE html>
<html lang="en" x-data="{ dialogOpen: false, search: '' }" x-cloak>
<head>
    <meta charset="UTF-8">
    <title>Teacher | Lessons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-[#F9FAFB] font-sans antialiased text-gray-900">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            @include('layouts.sidebar.teacher')
        </aside>

        <main class="flex-1 flex flex-col">
            <div class="p-8 max-w-7xl mx-auto w-full space-y-6" x-data="{ selectedDay: 'Monday' }">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Class Schedule</h1>
                    <p class="text-gray-500 mt-2 text-lg">View your weekly class schedule and enrolled students.</p>
                </div>

                <div class="bg-gray-100 p-1 rounded-xl inline-flex w-full sm:w-auto shadow-inner border border-gray-200">
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                        <button @click="selectedDay = '{{ $day }}'"
                            :class="selectedDay === '{{ $day }}' ? 'bg-white text-[#057E2E] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                            class="flex-1 sm:flex-none px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-200">
                            <span class="hidden sm:inline">{{ $day }}</span>
                            <span class="sm:hidden">{{ substr($day, 0, 3) }}</span>
                        </button>
                    @endforeach
                </div>

                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                    <div x-show="selectedDay === '{{ $day }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2">
                        @php $daySchedule = $schedules->where('day_of_week', $day); @endphp

                        @if($daySchedule->isEmpty())
                            <div class="bg-white rounded-3xl border border-gray-200 p-16 text-center shadow-sm">
                                <div class="inline-flex p-4 bg-gray-50 rounded-full mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <p class="text-gray-500 font-medium text-lg">No classes scheduled for {{ $day }}.</p>
                            </div>
                        @else
                            <div class="grid gap-6 md:grid-cols-2">
                                @foreach($daySchedule as $entry)
                                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md hover:border-[#057E2E]/20 transition-all p-6 space-y-5">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $entry->subject }}</h3>
                                            <span class="bg-[#057E2E]/10 text-[#057E2E] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                                {{ $entry->start_time }}
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-5 text-sm text-gray-500 font-medium">
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $entry->start_time }} - {{ $entry->end_time }}
                                            </span>
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                {{ $entry->room }} ({{ $entry->year_level }})
                                            </span>
                                        </div>

                                        <div class="pt-4 border-t border-gray-50">
                                            <div class="flex items-center gap-2 text-sm font-bold text-gray-800 mb-3">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                                Students ({{ $entry->students ? $entry->students->count() : 0 }})
                                            </div>
                                            <div class="flex flex-wrap gap-2">
                                                @if($entry->students)
                                                    @foreach($entry->students as $student)
                                                        <span class="bg-gray-50 text-gray-600 text-xs px-2.5 py-1 rounded-md border border-gray-200">
                                                            {{ $student->name ?? $student }}
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</body>
</html>