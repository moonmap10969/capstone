<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen flex bg-gray-50">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Reports Dashboard</h1>
            <p class="text-gray-700 mt-1">
                View student demographics, academic performance, attendance, behavior, and trends.
            </p>
        </div>

        {{-- Search / Filter --}}
        <div class="mb-6 flex flex-col md:flex-row gap-4 items-start md:items-center">
            <input type="text" id="reportSearch" placeholder="Search by name, ID, or section..."
                class="w-full md:w-1/2 border border-green-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">

                <div class="relative w-48">
                    <select id="gradeFilter"
                        class="appearance-none w-full border border-green-700 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">All Grades</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">Grade {{ $i }}</option>
                        @endfor
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-green-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                        </div>

                                {{-- 1. Student Demographics --}}
        <div class="bg-white p-6 rounded-2xl shadow mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Student Demographics</h2>
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Age</th>
                        <th class="px-4 py-2 text-left">Gender</th>
                        <th class="px-4 py-2 text-left">Grade Level</th>
                        <th class="px-4 py-2 text-left">Enrollment Year</th>
                        <th class="px-4 py-2 text-left">Section/Class</th>
                    </tr>
                </thead>
                <tbody id="demographicsTable" class="divide-y">
                    <!-- Static sample rows -->
                    <tr class="report-item">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">John Doe</td>
                        <td class="px-4 py-2">12</td>
                        <td class="px-4 py-2">Male</td>
                        <td class="px-4 py-2">Elementary</td>
                        <td class="px-4 py-2">2023</td>
                        <td class="px-4 py-2">A1</td>
                    </tr>
                    <tr class="report-item">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Jane Smith</td>
                        <td class="px-4 py-2">13</td>
                        <td class="px-4 py-2">Female</td>
                        <td class="px-4 py-2">Elementary</td>
                        <td class="px-4 py-2">2023</td>
                        <td class="px-4 py-2">A2</td>
                    </tr>
                    <tr class="report-item">
                        <td class="px-4 py-2">3</td>
                        <td class="px-4 py-2">Mark Lee</td>
                        <td class="px-4 py-2">15</td>
                        <td class="px-4 py-2">Male</td>
                        <td class="px-4 py-2">Junior High</td>
                        <td class="px-4 py-2">2022</td>
                        <td class="px-4 py-2">B1</td>
                    </tr>
                </tbody>
            </table>
        </div>

{{-- Charts --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

{{-- Grade Distribution --}}
<div class="bg-white p-4 rounded-2xl shadow flex flex-col items-center">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Grade Distribution</h2>
    <div class="w-64 h-64">
        <canvas id="gradeDistributionChart"></canvas>
    </div>
</div>

{{-- Gender Distribution --}}
<div class="bg-white p-4 rounded-2xl shadow flex flex-col items-center">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Gender Distribution</h2>
    <div class="w-48 h-48">
        <canvas id="genderDistributionChart"></canvas>
    </div>
</div>

{{-- Average Grades --}}
<div class="bg-white p-4 rounded-2xl shadow md:col-span-2 flex flex-col items-center">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Average Grades per Subject</h2>
    <div class="w-full max-w-xl h-72">
        <canvas id="averageGradesChart"></canvas>
    </div>
</div>

<script>
    const gradeData = { labels: ['Elementary', 'Junior High', 'Senior High'], values: [120, 80, 60] };
    const genderData = { labels: ['Male', 'Female'], values: [130, 130] };
    const avgGradesData = { labels: ['Math', 'Science', 'English'], values: [85, 90, 88] };

    // Tailwind green shades based on green-700
    const greenShades = ['#fce700', '#057e2f', '#046425', '#ffee38'];

    // Grade Distribution Doughnut
    new Chart(document.getElementById('gradeDistributionChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: gradeData.labels,
            datasets: [{ data: gradeData.values, backgroundColor: greenShades.slice(0, gradeData.labels.length) }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Gender Distribution Pie
    new Chart(document.getElementById('genderDistributionChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: genderData.labels,
            datasets: [{ data: genderData.values, backgroundColor: greenShades.slice(0, genderData.labels.length) }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Average Grades Bar
    new Chart(document.getElementById('averageGradesChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: avgGradesData.labels,
            datasets: [{ label: 'Average Grade', data: avgGradesData.values, backgroundColor: greenShades[1] }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 100 } }
        }
    });
</script>
