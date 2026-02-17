<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Schedule | FUMCES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="min-h-screen flex bg-[#f8fafc]">

    @include('student.layouts.sidebar')

    <main class="flex-1 p-6 lg:p-10 w-full overflow-y-auto">
        <div class="max-w-7xl mx-auto space-y-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-200 pb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Class Schedule</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <p class="text-[10px] uppercase font-bold text-gray-400 leading-none">Total Academic Units</p>
                        <p class="text-xl font-bold text-[#057E2E]">{{ $totalUnits }}</p>
                    </div>
                </div>
            </div>

            {{-- THE WEEKLY GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @foreach($weeklySchedule as $dayData)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col transition-all hover:border-green-200">
                        <div class="bg-gray-50 border-b border-gray-100 py-3 text-center">
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-600">{{ $dayData['day'] }}</span>
                        </div>
                        <div class="p-3 space-y-3 flex-1 min-h-[250px]">
                            @forelse($dayData['subjects'] as $sub)
                                <div class="group p-3 rounded-lg border border-gray-100 bg-white shadow-sm hover:shadow-md hover:border-green-500 transition-all border-l-4 border-l-[#057E2E]">
                                    <p class="text-[11px] font-bold text-gray-900 leading-tight uppercase mb-1">{{ $sub->subject }}</p>
                                    <div class="flex items-center gap-1.5 text-[10px] text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        {{ \Carbon\Carbon::parse($sub->start_time)->format('g:i A') }}
                                    </div>
                                    <div class="flex items-center gap-1.5 text-[10px] text-green-700 font-medium mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3Z"/><path d="M9 17h6"/></svg>
                                         {{ $sub->room }}
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center h-full py-10 opacity-20">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                                    <span class="text-[10px] uppercase font-bold mt-2">No Classes</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- SUBJECT DETAILS CARDS --}}
            <div class="pt-6">
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Subject Information</h2>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($subjects as $subject)
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="font-bold text-gray-900 leading-tight pr-4">{{ $subject['name'] }}</h3>
                                <span class="bg-gray-50 text-gray-600 text-[10px] px-2 py-1 rounded-md font-bold border border-gray-100 whitespace-nowrap">
                                    {{ $subject['units'] }} UNITS
                                </span>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold leading-none mb-1">Instructor</p>
                                        <p class="text-xs font-semibold text-gray-700">{{ $subject['teacher'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold leading-none mb-1">Schedule</p>
                                        <p class="text-xs font-semibold text-gray-700">{{ $subject['schedule'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold leading-none mb-1">Location</p>
                                        <p class="text-xs font-semibold text-gray-700">Room {{ $subject['room'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>
</body>
</html>