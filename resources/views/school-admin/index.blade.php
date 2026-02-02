<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    @include('school-admin.layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 min-h-screen p-8">

        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Dashboard
            </h1>
            <p class="text-sm text-gray-500">
                Welcome to the School Administration Panel
            </p>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm text-gray-500">Total Students</h3>
                <p class="text-2xl font-bold text-[#057E2E] mt-2">1,245</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm text-gray-500">Teachers</h3>
                <p class="text-2xl font-bold text-[#057E2E] mt-2">68</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm text-gray-500">Sections</h3>
                <p class="text-2xl font-bold text-[#057E2E] mt-2">42</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm text-gray-500">Pending Approvals</h3>
                <p class="text-2xl font-bold text-[#057E2E] mt-2">9</p>
            </div>

        </div>

        <!-- Recent Activity -->
        <div class="mt-10 bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Recent Activity
            </h2>

            <ul class="space-y-3 text-sm text-gray-600">
                <li>• New student enrolled in Grade 7</li>
                <li>• Teacher assigned to Section 10-A</li>
                <li>• Grade report approved</li>
                <li>• Tuition payment verified</li>
            </ul>
        </div>

    </main>

</body>
</html>
