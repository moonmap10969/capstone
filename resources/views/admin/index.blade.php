<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Student Portal</title>
</head>
<body class="min-h-screen flex bg-gray-50">

    @include('admin.layouts.sidebar')
    
    <main class="flex-1 p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-green-800 tracking-tight">Admin Dashboard</h1>
                <p class="text-sm text-gray-500 font-medium">Manage your student portal efficiently</p>
            </div>

            <a href="{{ route('admin.ay.index') }}" class="group flex items-center bg-white border border-green-200 rounded-xl p-1 pr-4 shadow-sm hover:shadow-md hover:border-green-500 transition-all duration-200">
                <div class="bg-green-600 text-white p-2 rounded-lg group-hover:bg-green-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-[10px] font-black text-green-600 uppercase tracking-wider leading-none">Active Period</p>
                    <p class="text-sm font-bold text-gray-800">
                        {{ $activeYear ? $activeYear->year_range . ' (' . $activeYear->semester . ')' : 'Initialize System' }}
                    </p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 text-gray-400 group-hover:text-green-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Users</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalUsers ?? 0 }}</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Manage Users</p>
            </a>

            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Admissions</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalAdmissions ?? 0 }}</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Manage Admissions</p>
            </a>

            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Tuition</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalTuition ?? 0 }}</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Manage Tuition Records</p>
            </a>

            <a href="#" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-green-700 font-semibold">Reports</h2>
                </div>
                <p class="text-3xl font-bold text-green-700">View</p>
                <p class="text-sm text-green-700 mt-1 hover:underline">Generate Reports</p>
            </a>
        </div>

        <div class="mt-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-green-800">Economic Demographics</h2>
                <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                    Avg Household Size: {{ number_format($avgHouseholdSize ?? 0, 1) }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Household Income Distribution</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="incomeChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Primary Earner Employment Status</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="employmentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const incomeData = @json($incomeStats ?? []);
        const employmentData = @json($employmentStats ?? []);

        const incomeLabels = {
            'below_25k': 'Below ₱25,000',
            '25k_to_50k': '₱25,000 - ₱50,000',
            '50k_to_100k': '₱50,000 - ₱100,000',
            'above_100k': '₱100,000+'
        };

        const employmentLabels = {
            'employed_full': 'Employed (Full-time)',
            'employed_part': 'Employed (Part-time)',
            'self_employed': 'Self-Employed / Business',
            'unemployed': 'Unemployed',
            'retired': 'Retired'
        };

        new Chart(document.getElementById('incomeChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(incomeData).map(key => incomeLabels[key] || key),
                datasets: [{
                    label: 'Number of Applicants',
                    data: Object.values(incomeData),
                    backgroundColor: '#16a34a',
                    borderRadius: 6
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        new Chart(document.getElementById('employmentChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(employmentData).map(key => employmentLabels[key] || key),
                datasets: [{
                    data: Object.values(employmentData),
                    backgroundColor: ['#2563eb', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '60%' }
        });
    </script>
</body>
</html>