<title>Schedule - FUMCES</title>

<!-- Sidebar -->
@include('layouts.sidebar')

<main class="flex-1 bg-yellow-50 p-8">
    <h1 class="text-3xl font-bold text-green-900 mb-6">Weekly Schedule</h1>

    <div class="max-w-5xl mx-auto">

        <!-- Timetable Grid -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Weekly Timetable</h2>

            <div class="grid grid-cols-6 border border-gray-300">
                <!-- Header Row -->
                <div class="border-b border-r border-gray-300 p-2 font-semibold text-center bg-green-100">Time</div>
                <div class="border-b border-r border-gray-300 p-2 font-semibold text-center bg-green-100">Mon</div>
                <div class="border-b border-r border-gray-300 p-2 font-semibold text-center bg-green-100">Tue</div>
                <div class="border-b border-r border-gray-300 p-2 font-semibold text-center bg-green-100">Wed</div>
                <div class="border-b border-r border-gray-300 p-2 font-semibold text-center bg-green-100">Thu</div>
                <div class="border-b border-gray-300 p-2 font-semibold text-center bg-green-100">Fri</div>

                <!-- 8:00-9:00 -->
                <div class="border-b border-r border-gray-300 p-2 text-center font-semibold">8:00-9:00</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-400 text-white font-semibold">Filipino</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-400 text-white font-semibold">Filipino</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-400 text-white font-semibold">Filipino</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-400 text-white font-semibold">Filipino</div>
                <div class="border-b border-gray-300 p-2 bg-green-400 text-white font-semibold">Filipino</div>

                <!-- 9:00-10:00 -->
                <div class="border-b border-r border-gray-300 p-2 text-center font-semibold">9:00-10:00</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-500 text-white font-semibold">English</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-500 text-white font-semibold">English</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-500 text-white font-semibold">English</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-500 text-white font-semibold">English</div>
                <div class="border-b border-gray-300 p-2 bg-green-500 text-white font-semibold">English</div>

                <!-- 10:00-11:00 -->
                <div class="border-b border-r border-gray-300 p-2 text-center font-semibold">10:00-11:00</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-600 text-white font-semibold">Math</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-600 text-white font-semibold">Math</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-600 text-white font-semibold">Math</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-600 text-white font-semibold">Math</div>
                <div class="border-b border-gray-300 p-2 bg-green-600 text-white font-semibold">Math</div>

                <!-- 11:00-12:00 -->
                <div class="border-b border-r border-gray-300 p-2 text-center font-semibold">11:00-12:00</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-700 text-white font-semibold">Science</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-700 text-white font-semibold">Science</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-700 text-white font-semibold">Science</div>
                <div class="border-b border-r border-gray-300 p-2 bg-green-700 text-white font-semibold">Science</div>
                <div class="border-b border-gray-300 p-2 bg-green-700 text-white font-semibold">Science</div>

                <!-- 12:00-1:00 -->
                <div class="border-r border-gray-300 p-2 text-center font-semibold">12:00-1:00</div>
                <div class="border-r border-gray-300 p-2 bg-green-800 text-white font-semibold">Araling Panlipunan</div>
                <div class="border-r border-gray-300 p-2 bg-green-800 text-white font-semibold">Araling Panlipunan</div>
                <div class="border-r border-gray-300 p-2 bg-green-800 text-white font-semibold">Araling Panlipunan</div>
                <div class="border-r border-gray-300 p-2 bg-green-800 text-white font-semibold">Araling Panlipunan</div>
                <div class="p-2 bg-green-800 text-white font-semibold">Araling Panlipunan</div>
            </div>
        </div>

        <!-- Subjects & Rooms Legend -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-green-900 mb-4">Subjects & Rooms</h2>
            <div class="grid grid-cols-4 gap-4 text-center">
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-6 bg-green-600 rounded-full"></span>
                    <span>Filipino - R201</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-6 bg-green-500 rounded-full"></span>
                    <span>English - R202</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-6 bg-green-400 rounded-full"></span>
                    <span>Math - R203</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-6 bg-green-700 rounded-full"></span>
                    <span>Science - R204</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-6 bg-green-300 rounded-full"></span>
                    <span>Araling Panlipunan - R205</span>
                </div>
            </div>
        </div>

    </div>
</main>