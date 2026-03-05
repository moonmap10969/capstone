<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Economic Analytics - Admin Dashboard</title>
</head>
<body class="min-h-screen flex bg-slate-50  font-sans">

    @include('admin.layouts.sidebar')
    
    <main class="flex-1 p-8 lg:p-12 overflow-y-auto relative">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('admin.index') }}" class="p-2 bg-white border border-green-200 rounded-lg text-green-600 hover:text-green-800 hover:bg-green-100 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-green-900 tracking-tight">Economic Demographics</h1>
                <p class="text-sm text-gray-600 font-medium mt-1">Socioeconomic distribution and predictive resource allocation.</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-green-100 mb-8">
            <div class="mb-8 border-b border-gray-100 pb-6">
                <h3 class="text-xl font-bold text-green-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    Predictive Allocation (K-Means Clustering)
                </h3>
                <p class="text-sm text-gray-600 mt-2 max-w-3xl">This unsupervised machine learning algorithm groups incoming students into objective risk tiers based on combined socioeconomic vectors, projecting future financial aid requirements.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <button onclick="openModal()" class="bg-red-50 p-6 rounded-xl border border-red-200 shadow-sm flex flex-col items-center text-center relative overflow-hidden hover:bg-red-100 transition-colors w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-400">
                    <div class="absolute top-0 w-full h-1 bg-red-600"></div>
                    <p class="text-xs font-bold text-red-700 uppercase tracking-widest mb-3">High Priority Need</p>
                    <p class="text-5xl font-extrabold text-red-600 tracking-tight">{{ $highNeedCount ?? 0 }}</p>
                    <p class="text-sm font-medium text-red-500 mt-2 underline decoration-red-300 underline-offset-4">View Students &rarr;</p>
                </button>

                <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200 shadow-sm flex flex-col items-center text-center relative overflow-hidden">
                    <div class="absolute top-0 w-full h-1 bg-yellow-400"></div>
                    <p class="text-xs font-bold text-yellow-700 uppercase tracking-widest mb-3">Moderate Need</p>
                    <p class="text-5xl font-extrabold text-yellow-600 tracking-tight">{{ $moderateNeedCount ?? 0 }}</p>
                    <p class="text-sm font-medium text-yellow-500 mt-2">Enrolled Students</p>
                </div>

                <div class="bg-green-50 p-6 rounded-xl border border-green-200 shadow-sm flex flex-col items-center text-center relative overflow-hidden">
                    <div class="absolute top-0 w-full h-1 bg-green-600"></div>
                    <p class="text-xs font-bold text-green-800 uppercase tracking-widest mb-3">Low Resource Strain</p>
                    <p class="text-5xl font-extrabold text-green-700 tracking-tight">{{ $lowNeedCount ?? 0 }}</p>
                    <p class="text-sm font-medium text-green-500 mt-2">Enrolled Students</p>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-green-900">Descriptive Demographics</h2>
                <div class="bg-white border border-green-200 text-green-700 px-4 py-2 rounded-lg font-bold text-sm shadow-sm flex items-center">
                    Avg Household Size: {{ number_format($avgHouseholdSize ?? 0, 1) }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <h3 class="text-sm font-bold text-green-800 uppercase tracking-wider mb-6">Household Income Distribution</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="incomeChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <h3 class="text-sm font-bold text-green-800 uppercase tracking-wider mb-6">Primary Earner Employment Status</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="employmentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div id="studentsModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/60 backdrop-blur-sm hidden">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[85vh] flex flex-col m-4 overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-red-50">
                    <div>
                        <h2 class="text-2xl font-bold text-red-800">High Priority Cohort</h2>
                        <p class="text-sm text-red-600 mt-1">Students identified for potential financial aid based on K-Means clustering.</p>
                    </div>
                    <button onclick="closeModal()" class="text-red-400 hover:text-red-700 transition-colors p-2 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="p-6 overflow-y-auto flex-1">
                    @if(count($highNeedStudents) > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full text-left text-sm text-gray-600">
                                <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-bold">
                                    <tr>
                                        <th class="px-6 py-4 border-b">Student ID</th>
                                        <th class="px-6 py-4 border-b">Name</th>
                                        <th class="px-6 py-4 border-b">Grade Level</th>
                                        <th class="px-6 py-4 border-b">Household Income</th>
                                        <th class="px-6 py-4 border-b">Family Size</th>
                                        <th class="px-6 py-4 border-b">Employment Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($highNeedStudents as $student)
                                        <tr class="hover:bg-green-50 transition-colors">
                                            <td class="px-6 py-4 font-semibold text-green-700">{{ $student->studentNumber }}</td>
                                            <td class="px-6 py-4">{{ $student->studentFirstName }} {{ $student->studentLastName }}</td>
                                            <td class="px-6 py-4 capitalize">{{ str_replace('_', ' ', $student->year_level) }}</td>
                                            <td class="px-6 py-4">
                                                @if($student->household_income == 'below_25k') Below ₱25k
                                                @elseif($student->household_income == '25k_to_50k') ₱25k - ₱50k
                                                @elseif($student->household_income == '50k_to_100k') ₱50k - ₱100k
                                                @else ₱100k+ @endif
                                            </td>
                                            <td class="px-6 py-4">{{ $student->household_size }} members</td>
                                            <td class="px-6 py-4 capitalize">{{ str_replace('_', ' ', $student->employment_status) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-lg font-medium text-gray-700">No high-priority students detected currently.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </main>

    <script>
        // Modal Logic
        function openModal() {
            document.getElementById('studentsModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('studentsModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('studentsModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Chart Data
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

        Chart.defaults.font.family = "'Inter', 'sans-serif'";
        Chart.defaults.color = '#4b5563';

        new Chart(document.getElementById('incomeChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(incomeData).map(key => incomeLabels[key] || key),
                datasets: [{
                    label: 'Applicants',
                    data: Object.values(incomeData),
                    backgroundColor: '#15803d', 
                    hoverBackgroundColor: '#16a34a',
                    borderRadius: 4,
                    barPercentage: 0.5
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { border: { display: false }, grid: { color: '#f3f4f6' } },
                    x: { border: { display: false }, grid: { display: false } }
                }
            }
        });

        new Chart(document.getElementById('employmentChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(employmentData).map(key => employmentLabels[key] || key),
                datasets: [{
                    data: Object.values(employmentData),
                    backgroundColor: ['#14532d', '#15803d', '#ca8a04', '#eab308', '#22c55e'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                cutout: '75%',
                plugins: { legend: { position: 'right', labels: { padding: 20, usePointStyle: true, boxWidth: 8 } } }
            }
        });
    </script>
</body>
</html>