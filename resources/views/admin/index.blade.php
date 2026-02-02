<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <title>Student Portal</title>
</head>
<body class="min-h-screen flex bg-gray-50">

    <!-- Sidebar -->

    @include('layouts.sidebar')
    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-bold text-green-700">Admin Dashboard</h1>
            <p class="text-gray-600">Manage your student portal efficiently</p>
        </div>

        <!-- Management Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Users Card -->
            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Users</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalUsers ?? 0 }}</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Manage Users</p>
            </a>

            <!-- Admissions Card -->
            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Admissions</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalAdmissions ?? 0 }}</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Manage Admissions</p>
            </a>

            <!-- Tuition Card -->
            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Tuition</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalTuition ?? 0 }}</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Manage Tuition Records</p>
            </a>

            <!-- Reports Card -->
            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Reports</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">View</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Generate Reports</p>
            </a>

        </div>
    </main>

</body>
</html>
