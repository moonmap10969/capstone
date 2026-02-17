<aside class="sticky top-0 h-screen w-64 bg-[#057E2E] flex flex-col shadow-lg">

  <div class="p-6 border-b border-white/20 text-center space-y-3">
      <div class="w-16 h-16 mx-auto rounded-full bg-white flex items-center justify-center mb-1 shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
      </div>
      <p class="font-semibold text-white text-lg">{{ auth()->user()->name }}</p>
      <p class="text-xs text-white/70 italic">
          @switch(auth()->user()->role)
              @case('registrar') Registrar @break
              @case('admin') System Administrator @break
              @case('teacher') Subject Teacher @break
              @case('adviser') Class Adviser @break
              @default User
          @endswitch
      </p>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="mt-2 w-full px-4 py-2 rounded-lg bg-white text-[#057E2E] font-medium hover:bg-gray-100 transition shadow-sm">
              Logout
          </button>
      </form>
  </div>

  <nav class="flex-1 overflow-y-auto p-4 text-sm space-y-1">

      <a href="{{ route('registrar.index') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
         {{ request()->routeIs('registrar.index') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10 hover:text-white' }}">
          <span>Dashboard</span>
      </a>

      <a href="{{ route('registrar.enrollment.index') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
         {{ request()->routeIs('registrar.enrollment') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10 hover:text-white' }}">
          <span>Enrollment</span>
      </a>

        <a href="{{ route('registrar.sections.index') }}" 
        class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
        {{ request()->routeIs('registrar.sections.*') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10 hover:text-white' }}">
            <span>Sections</span>
        </a>
        
      <a href="{{ route('registrar.tuitions.index') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
         {{ request()->routeIs('registrar.tuitions.*') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10 hover:text-white' }}">
         <span>Tuition</span>
      </a>
   
      <div class="relative">
          <button onclick="toggleMenu('reportsMenu', this)" 
              class="w-full flex justify-between items-center gap-2 px-4 py-2 rounded-lg font-medium transition
              {{ request()->routeIs('registrar.reports.*') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10 hover:text-white' }}">
              <span>Reports</span>
              <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('registrar.reports.*') ? 'rotate-180' : '' }}" 
                   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
          </button>

          <div id="reportsMenu" class="ml-4 mt-1 space-y-1 border-l border-white/30 pl-4 {{ request()->routeIs('registrar.reports.*') ? '' : 'hidden' }}">
              <a href="{{ route('registrar.reports.enrollment-summary') }}" 
                 class="block px-3 py-1 rounded-md text-white text-sm hover:bg-white/20 transition">
                  Enrollment Summary
              </a>
              <a href="{{ route('registrar.reports.payment-reports') }}" 
                 class="block px-3 py-1 rounded-md text-white text-sm hover:bg-white/20 transition">
                  Payment Reports
              </a>
          </div>
      </div>
  </nav>

  <div class="p-4 border-t border-white/20 text-center text-xs text-white/80">
      <p class="font-medium">First United Methodist Church Ecumenical School</p>
      <p class="mt-1 opacity-70">School Year 2026–2027</p>
  </div>

</aside>

<script>
function toggleMenu(menuId, btn) {
  const menu = document.getElementById(menuId);
  menu.classList.toggle('hidden');

  // Rotate arrow icon
  const svg = btn.querySelector('svg');
  svg.classList.toggle('rotate-180');
}

// Optional: Automatically keep menu open if on a report page
document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('reportsMenu');
  if (!menu.classList.contains('hidden')) {
      const btn = menu.previousElementSibling;
      const svg = btn.querySelector('svg');
      svg.classList.add('rotate-180');
  }
});
</script>