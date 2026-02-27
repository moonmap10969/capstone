<!DOCTYPE html>
<html lang="en" x-data="{ 
    activeTab: '{{ $selectedSectionId ?? '' }}', 
    /* Updated logic: Check URL hash first, then default to 'components' */
    currentTab: window.location.hash ? window.location.hash.substring(1) : 'components',
    showModal: false,
    sectionOpen: false,
    init() {
        /* Listen for browser back/forward and manual hash changes */
        window.addEventListener('hashchange', () => {
            this.currentTab = window.location.hash.substring(1);
        });
    }
}" x-cloak>
<head>
    <meta charset="UTF-8">
    <title>Teacher | Grade Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-[#F9FAFB] font-sans antialiased text-gray-900">
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
        @includeIf('layouts.sidebar.teacher')
    </aside>

    <main class="flex-1 p-8 max-w-7xl mx-auto w-full space-y-6">
        
        {{-- Header & Section Switcher --}}
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Grade Management</h1>
                <div class="relative mt-4" @click.away="sectionOpen = false">
                    <button @click="sectionOpen = !sectionOpen" class="flex items-center gap-3 bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-sm hover:border-[#057E2E] transition-all">
                        <span class="text-sm font-bold text-gray-600">Active Section:</span>
                        <span class="text-sm font-extrabold text-[#057E2E]">
                            Section {{ isset($sections) && $sections->where('section_id', $selectedSectionId)->first() ? $sections->where('section_id', $selectedSectionId)->first()->name : 'Select' }}
                        </span>
                        <svg class="w-4 h-4 text-gray-400" :class="sectionOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="sectionOpen" x-transition class="absolute z-50 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-xl p-2">
                        @if(isset($sections))
                            @foreach($sections as $sec)
                                <a href="?section={{ $sec->section_id }}#{{' + currentTab + '}}" 
                                   @click="window.location.href='?section={{ $sec->section_id }}#' + currentTab"
                                   class="block px-4 py-2 text-sm font-semibold rounded-lg hover:bg-gray-50 {{ $selectedSectionId == $sec->section_id ? 'text-[#057E2E] bg-green-50' : 'text-gray-700' }}">
                                    Section {{ $sec->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-200 px-6 py-3 rounded-2xl shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Instructor</p>
                <p class="text-sm font-extrabold text-gray-800">{{ Auth::user()->name }}</p>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <div class="flex border-b border-gray-200 overflow-x-auto">
            @php
                $tabs = [
                    'components' => 'Grading Schema',
                    'standing'   => 'Edit Class Standing',
                    'encoding'   => 'Grade Encoding',
                    'attendance' => 'Attendance',
                    'record'     => 'Class Record'
                ];
            @endphp
            @foreach($tabs as $key => $label)
                <button @click="currentTab = '{{ $key }}'; window.location.hash = '{{ $key }}'" 
                    :class="currentTab === '{{ $key }}' ? 'border-[#057E2E] text-[#057E2E]' : 'border-transparent text-gray-500 hover:text-gray-700'" 
                    class="whitespace-nowrap py-4 px-6 border-b-2 font-bold text-sm transition-all">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Tab Content --}}
        <div class="mt-6">
            <div x-show="currentTab === 'components'" x-transition>
                @includeIf('teacher.grades.tabs.components')
            </div>
            <div x-show="currentTab === 'standing'" x-transition>
                @includeIf('teacher.grades.tabs.standing')
            </div>
            <div x-show="currentTab === 'encoding'" x-transition>
                @includeIf('teacher.grades.tabs.encoding')
            </div>
            <div x-show="currentTab === 'attendance'" x-transition>
                @includeIf('teacher.grades.tabs.attendance')
            </div>
            <div x-show="currentTab === 'record'" x-transition>
                @includeIf('teacher.grades.tabs.record')
            </div>
        </div>

       
        </div>
    </main>
</div>
</body>
</html>