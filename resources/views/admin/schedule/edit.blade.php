<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50">

    @include('admin.layouts.sidebar')

    <main class="flex-1 p-6 lg:p-10 w-full overflow-y-auto bg-gray-50">
    <div class="max-w-3xl mx-auto space-y-8">
        {{-- Header Section --}}
        <div class="flex items-center justify-between border-b border-gray-200 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Schedule
                </h1>
                <p class="text-gray-500 font-medium mt-1 italic">Modify existing class timings, faculty, or room locations</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                <ul class="list-disc pl-5 text-xs text-red-700 font-bold space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.schedule.update', $schedule) }}" method="POST" id="scheduleForm" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject', $schedule->subject) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Teacher</label>
                    <input type="text" name="teacher" value="{{ old('teacher', $schedule->teacher) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Day of Week</label>
                    <select name="day_of_week" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500">
                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $d)
                            <option value="{{ $d }}" {{ old('day_of_week', $schedule->day_of_week) == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Grade Level</label>
                    <select name="year_level" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all">
                        @php
                            $levels = [
                                -2 => 'Kinder 1', -1 => 'Kinder 2', 0 => 'Kinder 3',
                                1 => 'Grade 1', 2 => 'Grade 2', 3 => 'Grade 3', 4 => 'Grade 4',
                                5 => 'Grade 5', 6 => 'Grade 6', 7 => 'Grade 7', 8 => 'Grade 8',
                                9 => 'Grade 9', 10 => 'Grade 10'
                            ];
                        @endphp
                        @foreach($levels as $val => $label)
                            <option value="{{ $val }}" {{ (string)old('year_level', $schedule->year_level) === (string)$val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Section</label>
                    <input type="text" name="section" value="{{ old('section', $schedule->section) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Room</label>
                    <input type="text" name="room" value="{{ old('room', $schedule->room) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Start Time</label>
                    <input type="time" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">End Time</label>
                    <input type="time" name="end_time" value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.schedule.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 transition-colors">Cancel</a>
                <button type="submit" class="px-8 py-3 bg-green-700 hover:bg-green-800 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-md transform hover:-translate-y-0.5">
                    Update Schedule
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    document.getElementById('scheduleForm').addEventListener('submit', function(e) {
        const start = this.querySelector('input[name="start_time"]').value;
        const end = this.querySelector('input[name="end_time"]').value;
        if (start && end && start >= end) {
            e.preventDefault();
            alert('Error: The end time must be later than the start time.');
        }
    });
</script>
</body>
</html>