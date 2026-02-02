<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100 font-sans text-gray-700">

    {{-- Sidebar --}}
    @include('student.layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Welcome, {{ auth()->user()->name ?? 'Student' }}
            </h1>
            <p class="text-gray-500 mt-1">
                Here’s an overview of your student account
            </p>
        </div>

        {{-- Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-sm text-gray-500 uppercase tracking-wide">Admission Status</h2>
                <p class="mt-2 text-2xl font-bold text-green-700">
                    {{ auth()->user()->admission_status ?? 'Pending' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-sm text-gray-500 uppercase tracking-wide">Current Grade Average</h2>
                @php
                    $grades = [94, 87, 91, 95, 84, 88];
                    $avg = round(array_sum($grades)/count($grades), 2);
                @endphp
                <p class="mt-2 text-2xl font-bold text-blue-600">
                    {{ $avg }}%
                </p>
            </div>

        </div>

        {{-- Current Semester Grades --}}
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Current Semester Grades - Spring 2026</h2>

            @php
                $subjects = [
                    ['Filipino 7','A','94%','Ms. Reyes','3'],
                    ['Mathematics 7','B+','87%','Mr. Santos','4'],
                    ['Science 7','A-','91%','Dr. Cruz','4'],
                    ['English 7','A','95%','Ms. Tan','3'],
                    ['Araling Panlipunan 7','B','84%','Mr. dela Cruz','3'],
                    ['MAPEH','B+','88%','Ms. Villanueva','3'],
                ];

                function gradeColor($grade) {
                    return match($grade) {
                        'A+', 'A' => 'bg-green-700 text-white',
                        'A-' => 'bg-green-600 text-white',
                        'B+', 'B' => 'bg-yellow-500 text-white',
                        'B-' => 'bg-yellow-400 text-white',
                        'C+', 'C' => 'bg-orange-400 text-white',
                        'D' => 'bg-red-500 text-white',
                        default => 'bg-gray-300 text-gray-800',
                    };
                }
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($subjects as [$subj,$letter,$perc,$teacher,$units])
                    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition border-l-4 border-green-700 pl-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $subj }}</h3>
                        <p class="text-sm text-gray-500 mb-1">Teacher: {{ $teacher }}</p>
                        <p class="text-sm text-gray-500 mb-1">Units: {{ $units }}</p>
                        <span class="inline-block px-3 py-1 mt-2 rounded-full text-sm font-semibold {{ gradeColor($letter) }}">
                            {{ $letter }} ({{ $perc }})
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Schedule Overview --}}
        <div x-data="{ view: 'today', now: '{{ now()->format('H:i') }}' }" class="bg-white rounded-2xl shadow-lg p-6 mb-12">
            
            {{-- Header --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800">Schedule Overview</h2>
                <div class="flex bg-gray-100 rounded-full p-1 text-sm">
                    <button
                        @click="view = 'today'"
                        :class="view === 'today' ? 'bg-green-700 text-white shadow rounded-full' : 'text-gray-500 rounded-full'"
                        class="px-4 py-1 transition font-semibold"
                    >Today</button>
                    <button
                        @click="view = 'week'"
                        :class="view === 'week' ? 'bg-green-700 text-white shadow rounded-full' : 'text-gray-500 rounded-full'"
                        class="px-4 py-1 transition font-semibold"
                    >Week</button>
                </div>
            </div>

            {{-- TODAY VIEW --}}
            <div x-show="view === 'today'" x-cloak>
                <p class="text-sm text-gray-500 mb-3">{{ now()->format('l, F j') }}</p>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b border-gray-200">
                            <th class="pb-2">Time</th>
                            <th class="pb-2">Subject</th>
                            <th class="pb-2">Teacher</th>
                            <th class="pb-2">Room</th>
                            <th class="pb-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php
                            $schedule = [
                                ['08:00','09:00','Filipino 7','Ms. Reyes','201'],
                                ['09:30','10:30','Mathematics 7','Mr. Santos','102'],
                                ['13:00','14:00','Science 7','Mrs. Santos','Lab 1'],
                                ['14:30','15:30','English 7','Ms. Tan','203'],
                            ];
                            $now = now()->format('H:i');
                        @endphp

                        @foreach ($schedule as [$start,$end,$subject,$teacher,$room])
                            @php
                                $status = 'Upcoming';
                                $badge = 'bg-gray-200 text-gray-700 rounded-full px-2 py-1 text-xs font-semibold';
                                if ($now >= $start && $now <= $end) {
                                    $status = 'Ongoing';
                                    $badge = 'bg-green-700 text-white rounded-full px-2 py-1 text-xs font-semibold';
                                } elseif ($now > $end) {
                                    $status = 'Completed';
                                    $badge = 'bg-blue-500 text-white rounded-full px-2 py-1 text-xs font-semibold';
                                }
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 font-medium">{{ $start }} – {{ $end }}</td>
                                <td class="{{ $status === 'Ongoing' ? 'font-semibold text-green-700' : '' }}">
                                    {{ $subject }}
                                </td>
                                <td>{{ $teacher }}</td>
                                <td>{{ $room }}</td>
                                <td>
                                    <span class="{{ $badge }}">{{ $status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- WEEK VIEW --}}
            <div x-show="view === 'week'" x-cloak class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 text-sm">
                    @php
                        $week = [
                            'Mon' => ['Filipino','Mathematics'],
                            'Tue' => ['Science','Mathematics'],
                            'Wed' => ['English','Values Education'],
                            'Thu' => ['Science','Mathematics'],
                            'Fri' => ['English','MAPEH'],
                        ];
                    @endphp

                    @foreach ($week as $day => $subjects)
                        <div class="border rounded-2xl p-4 bg-gray-50">
                            <h3 class="font-semibold text-gray-800 mb-2">{{ $day }}</h3>
                            <ul class="space-y-1 text-gray-600">
                                @foreach ($subjects as $subj)
                                    <li>• {{ $subj }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </main>

    {{-- AlpineJS --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>
