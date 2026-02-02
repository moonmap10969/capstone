<!-- Header -->
<header class="bg-white text-[#057e2f] shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Left: Logo + H1 -->
        <div class="flex items-center gap-0">
            <img src="{{ asset('images/fumces_logo.jpg') }}" alt="FUMCES Logo" class="h-16 w-auto">
            <h1 class="text-lg font-bold ml-2">
                First United Methodist <br> Church Ecumenical School Inc.
            </h1>
        </div>

        <!-- Center: Navigation links -->
        <nav class="flex gap-6 items-center mx-auto">
            <a href="/" class="transition-all duration-200 hover:font-bold">Home</a>
            <a href="/admissions" class="transition-all duration-200 hover:font-bold">Admissions</a>
            <a href="/education" class="transition-all duration-200 hover:font-bold">Education</a>
            <a href="/about" class="transition-all duration-200 hover:font-bold">About</a>
            <a href="/contact" class="transition-all duration-200 hover:font-bold">Contact</a>
        </nav>

        <!-- Right: FUMSYS Portal / Login -->
        <div class="flex items-center gap-2">
            @auth
                @php
                    $role = auth()->user()->role;
                    switch ($role) {
                        case 'admin':
                            $portalRoute = route('admin.index');
                            break;
                        case 'teacher':
                            $portalRoute = route('teacher.index');
                            break;
                        case 'student':
                            $portalRoute = route('student.index');
                            break;
                        case 'registrar':
                            $portalRoute = route('registrar.index');
                            break;
                        case 'school-admin':
                            $portalRoute = route('school-admin.index');
                            break;
                        case 'adviser':
                            $portalRoute = route('adviser.index');
                            break;
                        case 'parent':
                            $portalRoute = route('parent.index');
                            break;



                        default:
                            $portalRoute = route('welcome');
                    }
                @endphp

                <a href="{{ $portalRoute }}"
                    class="bg-[#057e2f] px-3 py-1 rounded hover:bg-green-700 font-bold inline-flex items-center gap-1">
                    <span class="text-[#d7e1b3]">FUMSYS</span>
                    <span class="text-[#e5db19]">Portal</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-white border border-[#057e2f] text-[#057e2f] px-3 py-1 rounded font-bold hover:bg-[#f0f0f0]">
                        Logout
                    </button>
                </form>
            @else
                <!-- Guests -->
                <a href="{{ route('login') }}"
                    class="bg-green-700 px-3 py-1 rounded hover:bg-green-800 font-bold inline-flex items-center gap-1">
                    <span class="text-green-200">FUMSYS</span>
                    <span class="text-yellow-400">Portal</span>
                </a>
            @endauth
        </div>
    </div>
</header>