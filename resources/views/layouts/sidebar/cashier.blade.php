<aside class="sticky top-0 h-screen w-64 bg-[#057E2E] flex flex-col shadow-lg">

    <div class="p-6 border-b border-white/20 text-center space-y-3">
        <div class="w-16 h-16 mx-auto rounded-full bg-white flex items-center justify-center mb-1 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-1.657 0-3 1.567-3 3.5S10.343 15 12 15s3-1.567 3-3.5S13.657 8 12 8z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 11.5c0 5-7 9-7 9s-7-4-7-9a7 7 0 1114 0z"/>
            </svg>
        </div>
  
        <p class="font-semibold text-white text-lg">{{ auth()->user()->name }}</p>
  
        <p class="text-xs text-white/70 italic">
            @switch(auth()->user()->role)
                @case('cashier') Cashier @break
                @case('admin') System Administrator @break
                @default User
            @endswitch
        </p>
  
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="mt-2 w-full px-4 py-2 rounded-lg bg-white text-[#057E2E] font-medium hover:bg-gray-100 transition shadow-sm">
                Logout
            </button>
        </form>
    </div>
  
    <nav class="flex-1 overflow-y-auto p-4 text-sm space-y-1">
  
        <!-- Dashboard -->
        <a href="{{ route('cashier.index') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
           {{ request()->routeIs('cashier.index') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10' }}">
            <span>Dashboard</span>
        </a>
  
  
<!-- Tuitions -->
<a href="{{ route('cashier.tuitions.index') }}"
   class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
   {{ request()->routeIs('cashier.tuitions.*') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10' }}">
    <span>Tuitions</span>
</a>  
  
        <!-- Tuition -->
        <a href="{{ route('cashier.payments.index') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition
           {{ request()->routeIs('cashier.payments.*') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10' }}">
            <span>Payments</span>
        </a>
  
        <!-- Reports Dropdown -->
        {{-- <div class="relative">
            <button onclick="toggleMenu('reportsMenu', this)"
                class="w-full flex justify-between items-center gap-2 px-4 py-2 rounded-lg font-medium transition
                {{ request()->routeIs('cashier.reports.*') ? 'bg-white text-[#057E2E] font-bold shadow-md' : 'text-white hover:bg-white/10' }}">
                <span>Reports</span>
                <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('cashier.reports.*') ? 'rotate-180' : '' }}"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
  
            <div id="reportsMenu"
                 class="ml-4 mt-1 space-y-1 border-l border-white/30 pl-4 {{ request()->routeIs('cashier.reports.*') ? '' : 'hidden' }}">
  
                <a href="{{ route('cashier.reports.enrollment-summary') }}"
                   class="block px-3 py-1 rounded-md text-white text-sm hover:bg-white/20 transition">
                    Enrollment Summary
                </a>
  
                <a href="{{ route('cashier.reports.payment-reports') }}"
                   class="block px-3 py-1 rounded-md text-white text-sm hover:bg-white/20 transition">
                    Payment Reports
                </a> --}}
  
            </div>
        </div>
  
    </nav>
  
<div class="p-4 border-t border-white/20 text-center text-xs text-white/80">
    <p class="font-medium">First United Methodist Church Ecumenical School</p>
    <p class="mt-1 opacity-70">School Year {{ date('Y') }}–{{ date('Y') + 1 }}</p>
</div>
  
  </aside>
  