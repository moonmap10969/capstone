<!DOCTYPE html>
<html lang="en" x-data="{ activeTab: '{{ $sections->first()->section_id ?? '' }}', search: '' }" x-cloak>
<head>
    <meta charset="UTF-8">
    <title>Teacher | Class Lists</title>
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

    <main class="flex-1 p-8 max-w-7xl mx-auto w-full space-y-6">
        
        {{-- Header --}}
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Class Lists</h1>
                <p class="text-gray-500 mt-2 text-lg">Viewing all students enrolled in your assigned sections.</p>
            </div>
            {{-- Filter Search --}}
            <div class="relative w-72">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input x-model="search" type="text" placeholder="Find a student..." 
                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-[#057E2E] focus:border-[#057E2E] outline-none transition-all">
            </div>
        </div>

        {{-- Section Tabs Navigation --}}
        <div class="flex border-b border-gray-200 overflow-x-auto scrollbar-hide">
            @foreach($sections as $section)
                <button 
                    @click="activeTab = '{{ $section->section_id }}'"
                    :class="activeTab === '{{ $section->section_id }}' ? 'border-[#057E2E] text-[#057E2E]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-8 border-b-2 font-bold text-sm transition-all flex items-center gap-2">
                    <span>Section {{ $section->name }}</span>
                    <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full text-xs font-medium">
                        {{ $section->enrollments->count() }}
                    </span>
                </button>
            @endforeach
        </div>

        {{-- Section Content --}}
        @foreach($sections as $section)
            <div x-show="activeTab === '{{ $section->section_id }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-16">#</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Full Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Year Level</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($section->enrollments->sortBy('admission.studentLastName') as $enrollment)
                                <tr class="hover:bg-gray-50 transition-colors" 
                                    x-show="search === '' || '{{ strtolower($enrollment->admission->studentLastName . ' ' . $enrollment->admission->studentFirstName) }}'.includes(search.toLowerCase())">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-mono text-sm text-blue-600">
                                        {{ $enrollment->admission->studentNumber ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-700 uppercase text-sm">
                                        {{ $enrollment->admission->studentLastName }}, {{ $enrollment->admission->studentFirstName }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 uppercase">
                                        {{ $section->year_level }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic bg-gray-50">
                                        No students found for this section.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </main>
</div>

</body>
</html>