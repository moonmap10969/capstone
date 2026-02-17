<header class="bg-white text-[#057e2f] shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">

        <!-- Left: Logo + School Name -->
        <div class="flex items-center gap-0">
            <img src="{{ asset('images/fumces_logo.jpg') }}" alt="FUMCES Logo" class="h-16 w-auto">
            <h1 class="text-lg font-bold ml-2">
                First United Methodist <br> Church Ecumenical School Inc.
            </h1>
        </div>

        <!-- Center: Navigation Links -->
        <nav class="flex gap-6 items-center mx-auto">
            <a href="/" class="transition-all duration-200 hover:font-bold">Home</a>
            <a href="/admissions-info" class="transition-all duration-200 hover:font-bold">Admissions</a>
            <a href="/education" class="transition-all duration-200 hover:font-bold">Education</a>
            <a href="/about" class="transition-all duration-200 hover:font-bold">About</a>
            <a href="/contact" class="transition-all duration-200 hover:font-bold">Contact</a>
        </nav>

        <!-- Right: Auth / Portal / Profile -->
        <div class="flex items-center gap-2">
            @guest
                <a href="{{ route('login') }}" class="bg-green-700 text-white px-3 py-1 rounded hover:bg-green-800 font-bold transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="border border-green-700 px-3 py-1 rounded hover:bg-green-700 hover:text-white font-bold transition">
                    Register
                </a>
            @else
            @php
            $user = Auth::user();
            $role = $user->role ?? '';
        
            $portalRoute = match ($role) {
                'admin' => route('admin.index'),
                'teacher' => route('teacher.index'),
                'student' => route('student.dashboard'),
                'parent' => route('parent.index'),
                'registrar' => route('registrar.index'),
                default => route('welcome'),
            };
        @endphp
        

                <!-- FUMSYS Portal Button -->
                <a href="{{ $portalRoute }}" class="bg-[#057e2f] px-3 py-1 rounded hover:bg-green-700 font-bold inline-flex items-center gap-1">
                    <span class="text-[#d7e1b3]">FUMSYS</span>
                    <span class="text-[#e5db19]">Portal</span>
                </a>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button id="profileBtn" class="border border-green-700 px-3 py-1 rounded font-bold inline-flex items-center gap-2 hover:bg-green-700 hover:text-white transition">
                        <!-- Profile User Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                        </svg>
                    
                        {{ $user->name ?? 'User' }}
                    
                        <!-- Dropdown Arrow -->
                        <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg hidden text-green-800 font-medium z-50">
                        <div class="px-4 py-3 border-b border-gray-100 text-sm font-semibold truncate capitalize">
                            {{ $user->name ?? 'User' }}
                        </div>
                        <a href="#" class="block px-4 py-3 hover:bg-green-50">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-3 rounded-b-xl hover:bg-red-50 hover:text-red-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>

    </div>
</header>

<!-- Profile Dropdown Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    if (!profileBtn || !profileDropdown) return;

    profileBtn.addEventListener('click', e => {
        e.stopPropagation();
        profileDropdown.classList.toggle('hidden');
        profileBtn.querySelector('svg:last-child').classList.toggle('rotate-180');
    });

    document.addEventListener('click', e => {
        if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
            profileDropdown.classList.add('hidden');
            profileBtn.querySelector('svg:last-child').classList.remove('rotate-180');
        }
    });
});
</script>
