<!DOCTYPE html>
<html lang="en" x-data="{ dialogOpen: false, search: '' }" x-cloak>
<head>
    <meta charset="UTF-8">
    <title>Teacher | Class Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans antialiased text-gray-900">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:block shadow-sm">
        @include('layouts.sidebar.teacher')
    </aside>

    {{-- Main --}}
    <main class="flex-1">

        <div class="p-8 max-w-7xl mx-auto w-full space-y-8" x-data="{ selectedDay: 'Monday' }">

            {{-- Header --}}
            <div class="space-y-2">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">
                    Class Schedule
                </h1>
                <p class="text-gray-500 text-lg">
                    View your weekly class schedule and manage student lists.
                </p>
            </div>

            {{-- Day Selector --}}
            <div class="bg-white p-2 rounded-2xl inline-flex w-full sm:w-auto shadow-sm border border-gray-200">
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                    <button
                        @click="selectedDay = '{{ $day }}'"
                        :class="selectedDay === '{{ $day }}'
                            ? 'bg-[#057E2E] text-white shadow-md'
                            : 'text-gray-600 hover:bg-gray-100'"
                        class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200">
                        
                        <span class="hidden sm:inline">{{ $day }}</span>
                        <span class="sm:hidden">{{ substr($day, 0, 3) }}</span>

                    </button>
                @endforeach
            </div>

            {{-- Schedule Per Day --}}
            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)

                <div
                    x-show="selectedDay === '{{ $day }}'"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    class="space-y-6"
                >

                    @php
                        $daySchedule = $schedules->where('day_of_week', $day);
                    @endphp

                    @if($daySchedule->isEmpty())

                        {{-- Empty State --}}
                        <div class="bg-white rounded-3xl border border-gray-200 p-16 text-center shadow-sm">
                            <div class="inline-flex p-4 bg-gray-50 rounded-full mb-4">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium text-lg">
                                No classes scheduled for {{ $day }}.
                            </p>
                        </div>

                    @else

                        <div class="grid gap-6 md:grid-cols-2">

                            @foreach($daySchedule as $entry)

                                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-[#057E2E]/30 transition-all p-6 flex flex-col justify-between space-y-6">

                                    {{-- Top Section --}}
                                    <div class="space-y-4">

                                        <div class="flex justify-between items-start">
                                            <h3 class="text-xl font-bold text-gray-900 leading-tight">
                                                {{ $entry->subject }}
                                            </h3>

                                            <span class="bg-[#057E2E]/10 text-[#057E2E] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                                {{ \Carbon\Carbon::parse($entry->start_time)->format('g:i A') }}
                                            </span>
                                        </div>

                                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 font-medium">

                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($entry->start_time)->format('g:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($entry->end_time)->format('g:i A') }}
                                            </span>

                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $entry->room }} (Section {{ $entry->section }})
                                            </span>

                                        </div>

                                        {{-- Student Count --}}
                                        <div class="pt-4 border-t border-gray-100">
                                            <div class="flex items-center justify-between bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                                                <div class="flex items-center gap-3">
                                                    <div class="p-2 bg-white rounded-lg shadow-sm">
                                                        <svg class="w-5 h-5 text-[#057E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                        </svg>
                                                    </div>
                                                    <span class="text-sm font-bold text-gray-700">
                                                        Enrolled Students
                                                    </span>
                                                </div>

                                                <span class="text-lg font-black text-[#057E2E]">
                                                    {{ $entry->section_model ? $entry->section_model->enrollments->count() : '0' }}
                                                </span>
                                            </div>
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
