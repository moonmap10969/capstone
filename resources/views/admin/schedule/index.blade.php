<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Curriculum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50">

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    <main class="flex-1 p-6 lg:p-10 w-full overflow-y-auto bg-gray-50">
    <div class="max-w-7xl mx-auto space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-gray-200 pb-6 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Schedule Management
                </h1>
                <p class="text-gray-500 font-medium mt-1 italic">Manage administrative class schedules and institutional room assignments</p>
            </div>
            <a href="{{ route('admin.schedule.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-green-700 hover:bg-green-800 text-white text-sm font-bold rounded-xl transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Schedule
            </a>
        </div>

        {{-- Filter Controls --}}
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <form method="GET" class="flex flex-wrap gap-3 items-center">
                <select name="day" class="bg-gray-50 border border-gray-200 text-gray-700 text-xs font-bold py-2 px-4 rounded-lg focus:ring-2 focus:ring-green-500 uppercase tracking-wider">
                    @foreach(['All Days','Monday','Tuesday','Wednesday','Thursday','Friday'] as $d)
                        <option value="{{ $d }}" {{ $day == $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
    <select name="grade" class="bg-gray-50 border border-gray-200 text-gray-700 text-xs font-bold py-2 px-4 rounded-lg focus:ring-2 focus:ring-green-500 uppercase tracking-wider">
        <option value="All Grades" {{ $grade == 'All Grades' ? 'selected' : '' }}>All Grades</option>
        @foreach([-2 => 'Kinder 1', -1 => 'Kinder 2', 0 => 'Kinder 3', 1 => 'Grade 1', 2 => 'Grade 2', 3 => 'Grade 3', 4 => 'Grade 4', 5 => 'Grade 5', 6 => 'Grade 6', 7 => 'Grade 7'] as $val => $label)
            <option value="{{ $val }}" {{ (string)$grade === (string)$val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

                <button type="submit" class="px-6 py-2 bg-gray-900 text-white text-xs font-black uppercase tracking-widest rounded-lg hover:bg-black transition-colors">
                    Filter
                </button>
            </form>
        </div>

        {{-- Schedule Table --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Day & Time</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Subject Details</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Assignment</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($schedules as $schedule)
                    <tr class="hover:bg-green-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-black uppercase tracking-tighter text-green-700 bg-green-50 px-2 py-0.5 rounded w-fit border border-green-100">
                                    {{ $schedule->day_of_week }}
                                </span>
                                <span class="text-xs text-gray-500 font-medium">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900">{{ $schedule->subject }}</span>
                                <span class="text-[11px] text-gray-400 italic">Grade {{ $schedule->year_level }} • Section {{ $schedule->section }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1 text-xs text-gray-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $schedule->teacher }}
                                </div>
                                <div class="flex items-center gap-2 text-[11px] text-gray-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    Room {{ $schedule->room }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.schedule.edit', $schedule) }}" class="p-2 text-gray-400 hover:text-green-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.schedule.destroy', $schedule) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-gray-400 hover:text-red-600 transition-colors" onclick="return confirm('Delete schedule?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>