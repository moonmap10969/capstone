<title>Teacher Dashboard - FUMCES</title>

@include('layouts.sidebar')

<main class="flex-1 bg-yellow-50 p-8">

    <!-- Welcome Card -->
    <div class="bg-white p-8 rounded-2xl shadow-lg mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-3">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-700 text-lg">
            This is your teacher portal dashboard. You can view your classes, grades, schedules, and manage student progress.
        </p>
    </div>

    <!-- Quick Links Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <a href="#" class="bg-white hover:shadow-xl transition p-6 rounded-xl flex flex-col items-center justify-center border border-green-100">
            <div class="bg-green-100 text-green-700 rounded-full p-4 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-green-700 font-semibold text-center">My Classes</span>
        </a>

        <a href="#" class="bg-white hover:shadow-xl transition p-6 rounded-xl flex flex-col items-center justify-center border border-green-100">
            <div class="bg-green-100 text-green-700 rounded-full p-4 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 4H7m6 0V4" />
                </svg>
            </div>
            <span class="text-green-700 font-semibold text-center">Enter/View Grades</span>
        </a>

        <a href="#" class="bg-white hover:shadow-xl transition p-6 rounded-xl flex flex-col items-center justify-center border border-green-100">
            <div class="bg-green-100 text-green-700 rounded-full p-4 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-green-700 font-semibold text-center">Schedule</span>
        </a>

        <a href="#" class="bg-white hover:shadow-xl transition p-6 rounded-xl flex flex-col items-center justify-center border border-green-100">
            <div class="bg-green-100 text-green-700 rounded-full p-4 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.5 7.5 0 0112 15a7.5 7.5 0 016.879 2.804M12 12a4.5 4.5 0 100-9 4.5 4.5 0 000 9z" />
                </svg>
            </div>
            <span class="text-green-700 font-semibold text-center">Update Profile</span>
        </a>

    </div>

    <!-- Recent Activity -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
        <ul class="divide-y divide-gray-200 text-gray-700">
            @if(isset($grades) && $grades->count() > 0)
                @foreach($grades as $grade)
                    <li class="py-3">Updated grade for {{ $grade->student->name }} in {{ $grade->subject }} <span class="text-green-700 font-semibold">✔</span></li>
                @endforeach
            @else
                <li class="py-3">No recent activity</li>
            @endif
        </ul>
    </div>

</main>
