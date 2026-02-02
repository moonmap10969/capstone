
<aside class="w-64 min-h-screen bg-[#057E2E] flex flex-col shadow-lg">

    <!-- Profile -->
    <div class="p-6 border-b border-white/20 text-center space-y-3">
        <div class="w-16 h-16 mx-auto rounded-full bg-white flex items-center justify-center mb-1 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>

        <!-- Display User Name -->
<p class="font-semibold text-white text-lg">
    {{ auth()->user()->name }}
</p>

<!-- Display Friendly Role Name -->
<p class="text-xs text-white/70">
    @switch(auth()->user()->role)
        @case('registrar')
            School Admin
            @break

        @case('admin')
            System Administrator
            @break

        @case('teacher')
            Subject Teacher
            @break

        @case('adviser')
            Class Adviser
            @break

        @default
            User
    @endswitch
</p>


        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-2 w-full px-4 py-2 rounded-lg bg-white text-[#057E2E] font-medium hover:bg-gray-100 transition">
                Logout
            </button>
        </form>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 text-sm space-y-1">

        <!-- Dashboard -->
        <a href="#" class="flex items-center gap-2 bg-white text-[#057E2E] font-bold rounded-lg px-4 py-2 shadow-md">
            <span>Dashboard</span>
        </a>

        <!-- Students -->
        <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] hover:font-semibold transition">
            <span>Students</span>
        </a>

        <!-- Grades -->
        <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] hover:font-semibold transition">
            <span>Grades</span>
        </a>

        <!-- Schedule -->
        <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] hover:font-semibold transition">
            <span>Schedule</span>
        </a>

        <!-- Report Cards -->
        <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] hover:font-semibold transition">
            <span>Report Cards</span>
        </a>

    </nav>

    <!-- Footer -->
    <div class="p-4 border-t border-white/20 text-center text-xs text-white/80">
        <p class="font-medium">First United Methodist Church Ecumenical School</p>
        <p class="mt-1">School Year 2026–2027</p>
    </div>
</aside>

<script>
function toggleMenu(id, button) {
    const menu = document.getElementById(id)
    const icon = button.querySelector('svg')
    menu.classList.toggle('hidden')
    icon.classList.toggle('rotate-180')
}
</script>
