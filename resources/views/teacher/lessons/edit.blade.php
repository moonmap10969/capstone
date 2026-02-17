<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Lesson | {{ $lesson->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9FAFB] font-sans antialiased text-gray-900">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            @include('layouts.sidebar.teacher')
        </aside>

        <main class="flex-1 p-8">
            <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-2xl font-black text-gray-900">Edit Lesson Plan</h2>
                    <a href="{{ route('teacher.lessons.index') }}" class="text-sm font-bold text-[#057E2E] hover:underline">Back to List</a>
                </div>
                
                <form action="{{ route('teacher.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-gray-700">Lesson Title</label>
                        <input name="title" value="{{ old('title', $lesson->title) }}" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] focus:bg-white transition outline-none" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700">Subject Area</label>
                            <select name="subject" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none">
                                <option {{ $lesson->subject == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                                <option {{ $lesson->subject == 'Science' ? 'selected' : '' }}>Science</option>
                                <option {{ $lesson->subject == 'English' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700">Schedule Date</label>
                            <input name="date" type="date" value="{{ old('date', $lesson->date) }}" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none" required>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-gray-700">Lesson Status</label>
                        <select name="status" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none">
                            <option value="draft" {{ $lesson->status == 'draft' ? 'selected' : '' }}>Move to Draft</option>
                            <option value="ready" {{ $lesson->status == 'ready' ? 'selected' : '' }}>Mark as Ready</option>
                            <option value="completed" {{ $lesson->status == 'completed' ? 'selected' : '' }}>Set as Completed</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-gray-700">Learning Objectives</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none">{{ old('description', $lesson->description) }}</textarea>
                    </div>

{{-- Updated File Section with Debugging --}}
<div class="space-y-2">
    <label class="text-sm font-bold text-gray-700">Lesson Materials</label>
    
    @if($lesson->file_path && \Storage::disk('public')->exists($lesson->file_path))
        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-200 mb-2">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-[#057E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs font-bold text-gray-900 truncate max-w-[180px]">{{ basename($lesson->file_path) }}</span>
                    <span class="text-[10px] text-green-600">File is ready</span>
                </div>
            </div>
            <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank" class="px-3 py-1 bg-white border border-green-200 rounded-lg text-[10px] font-black text-[#057E2E] uppercase hover:bg-green-100 transition">View File</a>
        </div>
    @elseif($lesson->file_path)
        <div class="p-3 bg-red-50 border border-red-200 rounded-xl mb-2 text-[10px] text-red-600">
            <strong>Error:</strong> File record exists ({{ basename($lesson->file_path) }}), but the physical file was not found in storage.
        </div>
    @endif

    <div class="relative">
        <input type="file" name="file" class="w-full bg-white border border-gray-200 px-4 py-2 rounded-xl focus:ring-2 focus:ring-[#057E2E] outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-[#057E2E] hover:file:bg-green-100">
    </div>
</div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('teacher.lessons.index') }}" class="flex-1 text-center px-6 py-3.5 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">Cancel</a>
                        <button type="submit" class="flex-1 px-6 py-3.5 bg-[#057E2E] text-white rounded-xl font-bold hover:shadow-lg transition-all">Update Lesson Plan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>