<aside class="w-64 min-h-screen bg-[#057E2E] flex flex-col shadow-lg">

    {{-- Profile Section --}}
    <div class="p-6 border-b border-white/20">
        <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center mb-3">
                {{-- Icon placeholder --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>

            <h3 class="font-semibold text-white">
                {{ auth()->user()->name ?? 'Maria Santos' }}
            </h3>

            <p class="text-sm text-white/80">
                {{ auth()->user()->grade_level }} - Section {{ auth()->user()->section }}
            </p>
            
            <p class="text-xs text-white/60 mt-1">
                Student ID: {{ auth()->user()->student_id }}
            </p>

            {{-- Logout Button --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-4 flex justify-center">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-white text-[#057E2E] rounded hover:bg-gray-100 text-sm font-medium">
                    Logout
                </button>
            </form>
                    </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-4 space-y-1 text-sm">
        <a href="{{ route('admin.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.index') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white hover:text-[#057E2E]' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.users.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white hover:text-[#057E2E]' }}">
            Users
        </a>

        <a href="{{ route('admin.documents.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.documents.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white hover:text-[#057E2E]' }}">
            Documents
        </a>

        <a href="{{ route('admin.admissions.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.admissions.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white hover:text-[#057E2E]' }}">
            Admissions
        </a>

        <a href="{{ route('admin.tuitions.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.tuitions.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white hover:text-[#057E2E]' }}">
            Tuitions
        </a>

        <a href="{{ route('admin.reports.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.reports.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white hover:text-[#057E2E]' }}">
            Reports
        </a>
    </nav>

{{-- Footer --}}
<div class="p-4 border-t border-white/20 text-center text-xs text-white">
    <p>First United Methodist Church Ecumenical School</p>
    @php
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
    @endphp
    <p class="mt-1">School Year {{ $currentYear }}–{{ $nextYear }}</p>
</div>

</aside>
