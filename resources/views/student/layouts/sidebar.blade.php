<aside class="w-64 min-h-screen bg-[#057E2E] flex flex-col shadow-lg fixed inset-y-0 left-0">

    {{-- Profile Section --}}
    <div class="p-6 border-b border-white/20">
        <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>

            <h3 class="font-semibold text-white truncate w-full">
                {{ Auth::user()->name }}
            </h3>

            <p class="text-sm text-white/80">
                {{ Auth::user()->student->year_level ?? 'N/A' }} - {{ Auth::user()->student->section ?? 'N/A' }}
            </p>
            
            <p class="text-xs text-white/60 mt-1">
               {{ Auth::user()->student->student_number ?? 'No ID' }}
            </p>

            <form method="POST" action="{{ route('logout') }}" class="mt-4 flex justify-center w-full">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-white text-[#057E2E] rounded hover:bg-gray-100 text-sm font-medium transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-4 space-y-1 text-sm overflow-y-auto">
        <a href="{{ route('student.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('student.index') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white/10' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
            Dashboard
        </a>

        <a href="{{ route('student.documents.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('student.documents.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white/10' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m8 17 4 4 4-4"/></svg>
            Documents
        </a>

        <a href="{{ route('student.admissions.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('student.admissions.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white/10' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
            Admissions
        </a>

        <a href="{{ route('student.tuitions.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('student.tuitions.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white/10' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Tuitions
        </a>

        <a href=""
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('student.reports.*') ? 'bg-white text-[#057E2E] font-bold shadow' : 'text-white hover:bg-white/10' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
            Reports
        </a>
    </nav>

    {{-- Footer --}}
    <div class="p-4 border-t border-white/20 text-center text-[10px] text-white/70 uppercase tracking-widest">
        <p>FUMCES Portal</p>
        <p class="mt-1">S.Y. 2026–2027</p>
    </div>
</aside>