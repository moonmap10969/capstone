<title>Developer Dashboard - FUMCES</title>

@include('layouts.sidebar')

<main class="flex-1 bg-yellow-50 p-8">
    <div class="bg-white p-8 rounded-2xl shadow-lg mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-3">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-700 text-lg">
            This is your developer portal dashboard. You can manage students, admissions, grades, and system settings from here.
        </p>
    </div>

    <!-- Developer quick links could be different -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('developer.users') }}" class="bg-white hover:shadow-xl transition p-6 rounded-xl flex flex-col items-center justify-center border border-green-100">
            <div class="bg-green-100 text-green-700 rounded-full p-4 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="text-green-700 font-semibold text-center">Manage Users</span>
        </a>
        <!-- Add more cards for admissions, grades, or settings -->
    </div>
</main>
1`