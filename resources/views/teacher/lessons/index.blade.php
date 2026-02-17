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
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            @include('layouts.sidebar.teacher')
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col">
            <div class="p-8 max-w-7xl mx-auto w-full space-y-8">
                {{-- Header Section --}}
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Lesson Curriculum</h1>
                        <p class="text-gray-500 mt-2 text-lg">Manage your educational roadmap and track progress.</p>
                    </div>
                    <button @click="dialogOpen = true" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-[#057E2E] hover:bg-[#046324] transition-all shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add New Lesson
                    </button>
                </div>

                {{-- Dashboard Grid --}}
                @if($lessons->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">No lessons found</h3>
                        <p class="text-gray-500">Get started by creating your first lesson plan.</p>
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($lessons as $lesson)
                            <div class="group bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-[#057E2E]/30 transition-all duration-300 flex flex-col">
                                <div class="p-6 pb-4">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="p-2 bg-gray-50 rounded-lg group-hover:bg-[#057E2E]/10 transition">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#057E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                        <span class="px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider
                                            {{ $lesson->status === 'completed' ? 'bg-green-100 text-green-700' : ($lesson->status === 'ready' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                            {{ $lesson->status }}
                                        </span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#057E2E] transition">{{ $lesson->title }}</h3>
                                    <div class="text-xs font-medium text-gray-400 mt-1">
                                        {{ $lesson->subject }} • {{ \Carbon\Carbon::parse($lesson->date)->format('M d, Y') }}
                                    </div>
                                    <p class="mt-4 text-sm text-gray-600 line-clamp-2 leading-relaxed">{{ $lesson->description }}</p>
                                </div>
                                
                                {{-- Actions Footer --}}
                                <div class="px-6 py-4 bg-gray-50/50 rounded-b-2xl border-t border-gray-100 space-y-3">
                                    @if($lesson->file_path)
                                        <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank" class="flex items-center justify-center gap-2 w-full px-3 py-2 bg-white border border-gray-200 text-[#057E2E] text-[11px] font-bold uppercase rounded-lg hover:bg-green-50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            View Materials
                                        </a>
                                    @endif

                                    <form action="{{ route('teacher.lessons.update', $lesson->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="w-full bg-white border border-gray-200 text-sm font-medium rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[#057E2E] cursor-pointer">
                                            <option value="draft" {{ $lesson->status == 'draft' ? 'selected' : '' }}>Move to Draft</option>
                                            <option value="ready" {{ $lesson->status == 'ready' ? 'selected' : '' }}>Mark as Ready</option>
                                            <option value="completed" {{ $lesson->status == 'completed' ? 'selected' : '' }}>Set as Completed</option>
                                        </select>
                                    </form>

                                    <div class="flex items-center justify-between gap-2">
                                        <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" class="flex-1 text-center px-3 py-2 bg-blue-50 text-blue-600 text-[11px] font-bold uppercase rounded-lg hover:bg-blue-100 transition">Edit</a>
                                        <form action="{{ route('teacher.lessons.destroy', $lesson->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this lesson?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-full px-3 py-2 bg-red-50 text-red-600 text-[11px] font-bold uppercase rounded-lg hover:bg-red-100 transition">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>
    </div>

    {{-- Create Modal --}}
    <div x-show="dialogOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="dialogOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden text-left relative z-10">
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-2xl font-black text-gray-900">New Lesson Plan</h2>
                    <button @click="dialogOpen = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                
                <form action="{{ route('teacher.lessons.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-gray-700">Lesson Title</label>
                        <input name="title" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] focus:bg-white transition outline-none" placeholder="e.g. Introduction to Calculus" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700">Subject Area</label>
                            <select name="subject" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none">
                                <option>Mathematics</option><option>Science</option><option>English</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700">Schedule Date</label>
                            <input name="date" type="date" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none" required>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-gray-700">Learning Objectives</label>
                        <textarea name="description" rows="3" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none" placeholder="What will the students learn?"></textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-gray-700">Lesson Materials (PDF/Doc)</label>
                        <input type="file" name="file" class="w-full bg-white border border-gray-200 px-4 py-2 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-[#057E2E] hover:file:bg-green-100">
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="button" @click="dialogOpen = false" class="flex-1 px-6 py-3.5 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">Discard</button>
                        <button type="submit" class="flex-1 px-6 py-3.5 bg-[#057E2E] text-white rounded-xl font-bold hover:shadow-lg transition-all">Publish Lesson</button>
                    </div>
                </form>
            </div>
            <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" @click="dialogOpen = false"></div>
        </div>
    </div>
</body>
</html>