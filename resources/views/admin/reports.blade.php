<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Institutional Reports - FumiSys</title>
    <style>
        @media print { 
            .no-print { display: none !important; } 
            body { background-color: white; } 
            .print-container { width: 100% !important; margin: 0 !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="min-h-screen flex bg-green-50 font-sans">

    <div class="no-print">
        @include('admin.layouts.sidebar')
    </div>
    
    <main class="flex-1 p-8 lg:p-12 overflow-y-auto print-container">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.index') }}" class="no-print p-2 bg-white border border-green-200 rounded-lg text-green-600 hover:text-green-800 hover:bg-green-100 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-extrabold text-green-900 tracking-tight">Institutional Reports</h1>
                    <p class="text-sm text-gray-600 font-medium mt-1">DEPED compliance and strategic enrollment demographics.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 no-print">
                <a href="{{ route('admin.reports.export') }}" class="bg-white border border-green-200 text-green-700 hover:bg-green-50 px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export CSV
                </a>
                <button onclick="window.print()" class="bg-green-700 border border-green-800 text-white hover:bg-green-800 px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Report
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 no-print">
            <div class="bg-gradient-to-br from-green-600 to-green-700 p-6 rounded-2xl shadow-lg text-white">
                <h3 class="font-bold text-green-100 uppercase text-xs tracking-widest mb-4">Top Performing Grade</h3>
                <p class="text-2xl font-black capitalize">{{ str_replace(['kinder', 'grade'], ['Kinder ', 'Grade '], $topGrade) }}</p>
                <p class="text-sm text-green-100 mt-1">{{ $topGradeCount }} Total Verified Students</p>
            </div>

            <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl shadow-lg text-white">
                <h3 class="font-bold text-blue-100 uppercase text-xs tracking-widest mb-4">Growth Velocity</h3>
                <p class="text-3xl font-black">{{ number_format($growthRate, 1) }}%</p>
                <p class="text-sm text-blue-100 mt-1">Enrollment increase since last month</p>
            </div>

            <div class="bg-gradient-to-br from-amber-500 to-amber-600 p-6 rounded-2xl shadow-lg text-white">
                <h3 class="font-bold text-amber-100 uppercase text-xs tracking-widest mb-4">Forecast Confidence</h3>
                <p class="text-2xl font-black">High (Seasonal)</p>
                <p class="text-sm text-amber-100 mt-1">Adjusted for June/July surge</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <div class="xl:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-green-100">
                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-green-900">DEPED Enrollment Registry (K-10)</h3>
                    <p class="text-sm text-gray-500 mt-1">Official headcount of approved and enrolled students by grade and gender.</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-green-50 text-green-800 uppercase text-xs font-bold border-y border-green-200">
                            <tr>
                                <th class="px-6 py-4">Grade Level</th>
                                <th class="px-6 py-4 text-center">Male</th>
                                <th class="px-6 py-4 text-center">Female</th>
                                <th class="px-6 py-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($depedData as $grade => $data)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-3 font-semibold text-gray-800 capitalize">{{ str_replace(['kinder', 'grade'], ['Kinder ', 'Grade '], $grade) }}</td>
                                <td class="px-6 py-3 text-center">{{ $data['Male'] }}</td>
                                <td class="px-6 py-3 text-center">{{ $data['Female'] }}</td>
                                <td class="px-6 py-3 text-right font-bold text-green-700">{{ $data['Total'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 font-bold border-t-2 border-green-200">
                            <tr>
                                <td class="px-6 py-4 text-gray-800 uppercase text-xs">Grand Total</td>
                                <td class="px-6 py-4 text-center text-blue-700">{{ $totalMale }}</td>
                                <td class="px-6 py-4 text-center text-pink-600">{{ $totalFemale }}</td>
                                <td class="px-6 py-4 text-right text-green-800 text-lg">{{ $totalMale + $totalFemale }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="flex flex-col gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <h3 class="text-lg font-bold text-green-900 mb-1">Gender Distribution</h3>
                    <p class="text-xs text-gray-500 mb-4">Cross-grade visual breakdown</p>
                    <div class="relative h-64 w-full">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <h3 class="text-lg font-bold text-green-900 mb-1">Enrollment Growth Forecast</h3>
                    <p class="text-xs text-gray-500 mb-4">Regression with Seasonal Intelligence</p>
                    <div class="relative h-64 w-full">
                        <canvas id="forecastChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Data for Gender Chart
        const gData = @json($depedData);
        const labels = Object.keys(gData).map(l => l.replace('kinder', 'K').replace('grade', 'G'));
        
        new Chart(document.getElementById('genderChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Male',
                        data: Object.values(gData).map(d => d.Male),
                        backgroundColor: '#3b82f6',
                        borderRadius: 4,
                    },
                    {
                        label: 'Female',
                        data: Object.values(gData).map(d => d.Female),
                        backgroundColor: '#ec4899',
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { stacked: true, grid: { display: false } },
                    y: { stacked: true, grid: { color: '#f3f4f6' } }
                },
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, usePointStyle: true } } }
            }
        });

        // Data for Forecast Chart
        new Chart(document.getElementById('forecastChart'), {
            type: 'line',
            data: {
                labels: [...@json($labels), ...@json($forecastLabels)],
                datasets: [
                    {
                        label: 'Actual',
                        data: @json($counts),
                        borderColor: '#15803d',
                        backgroundColor: '#15803d',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Forecast',
                        data: [...Array(@json(count($labels)) - 1).fill(null), @json(end($counts)), ...@json($forecastValues)],
                        borderColor: '#ca8a04',
                        borderDash: [5, 5],
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>