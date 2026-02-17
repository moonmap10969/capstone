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
    <div class="max-w-3xl mx-auto space-y-8">
        {{-- Header Section --}}
        <div class="flex items-center justify-between border-b border-gray-200 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add New Schedule
                </h1>
                <p class="text-gray-500 font-medium mt-1 italic">Define subject timings, faculty assignments, and room locations</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-bold text-red-800 uppercase tracking-wide">Submission Errors</span>
                </div>
                <ul class="list-disc pl-5 text-xs text-red-700 font-medium space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.schedule.store') }}" method="POST" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 space-y-8">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Subject & Teacher --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Subject Name</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="e.g. Advanced Mathematics" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Assigned Teacher</label>
                    <input type="text" name="teacher" value="{{ old('teacher') }}" placeholder="e.g. Dr. Smith" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition-all">
                </div>

                {{-- Day & Grade --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Day of Week</label>
                    <select name="day_of_week" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all">
                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $d)
                            <option value="{{ $d }}" {{ old('day_of_week') == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Grade Level</label>
                <select name="year_level" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    {{-- Kinder levels: lowercase and no spaces --}}
                    <option value="kinder1" {{ old('year_level') == 'kinder1' ? 'selected' : '' }}>Kinder 1</option>
                    <option value="kinder2" {{ old('year_level') == 'kinder2' ? 'selected' : '' }}>Kinder 2</option>
                    <option value="kinder3" {{ old('year_level') == 'kinder3' ? 'selected' : '' }}>Kinder 3</option>
                    
                    {{-- Grades 1-7: lowercase and no spaces --}}
                    @foreach([1, 2, 3, 4, 5, 6, 7] as $g)
                        <option value="grade{{ $g }}" {{ old('year_level') == "grade $g" ? 'selected' : '' }}>Grade {{ $g }}</option>
                    @endforeach
                </select>
            </div>
                {{-- Section & Room --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Section</label>
                    <input type="text" name="section" value="{{ old('section') }}" placeholder="e.g. A" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Room Assignment</label>
                    <input type="text" name="room" value="{{ old('room') }}" placeholder="e.g. Room 302" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition-all">
                </div>

                {{-- Time Range --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Start Time</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">End Time</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.schedule.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 transition-colors">
                    Discard Changes
                </a>
                <button type="submit" class="px-8 py-3 bg-green-700 hover:bg-green-800 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-md transform hover:-translate-y-0.5">
                    Save Schedule
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const start = document.querySelector('input[name="start_time"]').value;
        const end = document.querySelector('input[name="end_time"]').value;

        if (start && end && start >= end) {
            e.preventDefault();
            alert('The end time must be later than the start time.');
        }
    });
</script>
@if(session('conflict_popup'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: '<span style="color: #b91c1c">Scheduling Conflict</span>',
            icon: 'warning',
            html: `
                <div style="text-align: left; background: #fef2f2; padding: 15px; border-radius: 8px; border: 1px solid #fee2e2;">
                    <p><strong>Teacher:</strong> {{ session('conflict_popup')['teacher'] }}</p>
                    <p><strong>Subject:</strong> {{ session('conflict_popup')['subject'] }}</p>
                    <p><strong>Room:</strong> {{ session('conflict_popup')['room'] }}</p>
                    <p><strong>Time:</strong> {{ session('conflict_popup')['time'] }}</p>
                </div>
                <p style="margin-top: 15px; font-size: 0.9em; color: #666;">Please adjust the time or room to resolve this.</p>
            `,
            confirmButtonText: 'Got it',
            confirmButtonColor: '#15803d',
            background: '#ffffff',
            showClass: { popup: 'animate__animated animate__fadeInDown' }
        });
    </script>
@endif