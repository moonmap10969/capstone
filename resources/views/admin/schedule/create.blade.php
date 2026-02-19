<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Schedule | Admin</title>
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
                    {{-- Subject --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Subject Name</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="e.g. Advanced Mathematics" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition-all" required>
                    </div>

                    {{-- Teacher --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Assign Teacher</label>
                        <select name="teacher" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->name }}" {{ old('teacher') == $teacher->name ? 'selected' : '' }}>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Day --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Day of Week</label>
                        <select name="day_of_week" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all" required>
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $d)
                                <option value="{{ $d }}" {{ old('day_of_week') == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Year Level --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Year Level</label>
                        <select id="grade-select" name="year_level" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all" required>
                            <option value="">Select a grade</option>
                            <option value="kinder1" {{ old('year_level') == 'kinder1' ? 'selected' : '' }}>Kinder 1</option>
                            <option value="kinder2" {{ old('year_level') == 'kinder2' ? 'selected' : '' }}>Kinder 2</option>
                            <option value="kinder3" {{ old('year_level') == 'kinder3' ? 'selected' : '' }}>Kinder 3</option>
                            @for($i=1; $i<=10; $i++)
                                <option value="grade{{$i}}" {{ old('year_level') == "grade$i" ? 'selected' : '' }}>Grade {{$i}}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Section --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Section</label>
                        <select id="section-select" name="section" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all disabled:opacity-50" required disabled>
                            <option value="">Choose a section...</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->name }}" data-grade="{{ $section->year_level }}" class="hidden" {{ old('section') == $section->name ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Room --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Room Assignment</label>
                        <input type="text" name="room" value="{{ old('room') }}" placeholder="e.g. Room 302" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition-all" required>
                    </div>

                    {{-- Time Range --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Start Time</label>
                        <input type="time" name="start_time" value="{{ old('start_time') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all" required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">End Time</label>
                        <input type="time" name="end_time" value="{{ old('end_time') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:ring-2 focus:ring-green-500 transition-all" required>
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
        // Section filtering logic
        document.getElementById('grade-select').addEventListener('change', function() {
            const selectedGrade = this.value;
            const sectionSelect = document.getElementById('section-select');
            const options = sectionSelect.querySelectorAll('option[data-grade]');

            sectionSelect.disabled = !selectedGrade;
            sectionSelect.value = ""; 

            options.forEach(option => {
                option.style.display = (option.getAttribute('data-grade') === selectedGrade) ? 'block' : 'none';
                if (option.getAttribute('data-grade') === selectedGrade) {
                    option.classList.remove('hidden');
                } else {
                    option.classList.add('hidden');
                }
            });
        });

        // Basic Time Validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const start = document.querySelector('input[name="start_time"]').value;
            const end = document.querySelector('input[name="end_time"]').value;

            if (start && end && start >= end) {
                e.preventDefault();
                alert('The end time must be later than the start time.');
            }
        });
    </script>

    {{-- Redesigned Conflict Popup --}}
    @if(session('conflict_popup'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: '<span class="text-red-600">Scheduling Conflict</span>',
                icon: 'error',
                html: `
                    <div class="text-left bg-red-50 p-5 rounded-2xl border border-red-100 space-y-3 mt-4">
                        <div class="flex items-center gap-3 text-red-700 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <p class="font-bold text-sm">{{ session('conflict_popup')['message'] }}</p>
                        </div>
                        <div class="grid grid-cols-1 gap-2.5 pt-3 border-t border-red-200/50">
                            <div class="flex items-center gap-3 text-gray-700">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="text-xs font-bold uppercase text-gray-400 w-16">Teacher</span>
                                <span class="text-sm font-bold">{{ session('conflict_popup')['teacher'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span class="text-xs font-bold uppercase text-gray-400 w-16">Room</span>
                                <span class="text-sm font-bold">{{ session('conflict_popup')['room'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs font-bold uppercase text-gray-400 w-16">Time</span>
                                <span class="text-sm font-bold">{{ session('conflict_popup')['time'] }}</span>
                            </div>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Review Schedule',
                confirmButtonColor: '#b91c1c',
                customClass: {
                    popup: 'rounded-3xl border-0 shadow-2xl',
                    title: 'font-bold text-2xl pt-6',
                }
            });
        </script>
    @endif
</body>
</html>