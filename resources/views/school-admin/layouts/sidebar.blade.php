<aside class="w-64 min-h-screen bg-[#057E2E] flex flex-col shadow-lg">

    <!-- Profile -->
    <div class="p-6 border-b border-white/20 text-center space-y-3">
        <div class="w-16 h-16 mx-auto rounded-full bg-white flex items-center justify-center mb-1 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <p class="font-semibold text-white text-lg">School Admin</p>
        <p class="text-xs text-white/70">School Admin</p>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="mt-2 w-full px-4 py-2 rounded-lg bg-white text-[#057E2E] font-medium hover:bg-gray-100 transition">
                Logout
            </button>
        </form>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 text-sm space-y-1">

        <!-- Enrollment Overview -->
        <a href="#"
           class="flex items-center gap-2 bg-white text-[#057E2E] font-bold rounded-lg px-4 py-2 shadow-md">
            <span>Enrollment Overview</span>
        </a>

        <!-- Academic Performance -->
        <button onclick="toggleMenu('academicMenu', this)"
            class="w-full flex justify-between items-center px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Academic Performance</span>
            <svg class="w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div id="academicMenu" class="ml-4 mt-1 hidden space-y-1 border-l border-white/30 pl-4">
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Grade Analytics
            </a>
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Section Performance
            </a>
        </div>

        <!-- Teacher Management -->
        <button onclick="toggleMenu('teacherMenu', this)"
            class="w-full flex justify-between items-center px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Teacher Management</span>
            <svg class="w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div id="teacherMenu" class="ml-4 mt-1 hidden space-y-1 border-l border-white/30 pl-4">
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Teacher Directory
            </a>
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Assign Teachers
            </a>
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Teaching Loads
            </a>
        </div>

        <!-- Subject & Curriculum -->
        <a href="#"
           class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Subject & Curriculum</span>
        </a>

        <!-- Section Management -->
        <button onclick="toggleMenu('sectionMenu', this)"
            class="w-full flex justify-between items-center px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Section Management</span>
            <svg class="w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div id="sectionMenu" class="ml-4 mt-1 hidden space-y-1 border-l border-white/30 pl-4">
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Approval Center
            </a>
            <a href="#" class="block px-3 py-1 rounded-md text-white hover:bg-white hover:text-[#057E2E] transition">
                Grade Approvals
            </a>
        </div>

        <!-- Enrollment Approvals -->
        <a href="#"
           class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Enrollment Approvals</span>
        </a>

        <!-- Reports -->
        <a href="#"
           class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Reports</span>
        </a>

        <!-- Announcements -->
        <a href="#"
           class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white hover:bg-white hover:text-[#057E2E] transition">
            <span>Announcements</span>
        </a>

    </nav>

</aside>

<script>
    function toggleMenu(id, button) {
        const menu = document.getElementById(id)
        if (!menu) return
    
        const icon = button.querySelector('svg')
    
        menu.classList.toggle('hidden')
    
        if (icon) {
            icon.classList.toggle('rotate-180')
        }
    }
    </script>
    