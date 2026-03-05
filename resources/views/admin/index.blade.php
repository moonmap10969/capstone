<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <title>Student Portal - Admin Dashboard</title>
</head>
<body class="min-h-screen flex bg-slate-50 font-sans">

    @include('admin.layouts.sidebar')
    
    <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">System Overview</h1>
                <p class="text-sm text-slate-500 font-medium mt-1">Monitor daily operations and active enrollments.</p>
            </div>

            <a href="{{ route('admin.ay.index') }}" class="group inline-flex items-center bg-white border border-slate-200 rounded-full py-2.5 px-5 shadow-sm hover:shadow-md hover:border-blue-500 transition-all duration-200">
                <span class="flex h-3 w-3 relative mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                </span>
                <span class="text-sm font-semibold text-slate-700 group-hover:text-blue-600 transition-colors">
                    Academic Year: {{ $activeYear ? $activeYear->year_range . ' (' . $activeYear->semester . ')' : 'Initialize System' }}
                </span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-slate-500 font-semibold text-sm uppercase tracking-wider">Total Users</h2>
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">{{ $totalUsers ?? 0 }}</p>
                    <a href="#" class="text-sm text-blue-600 mt-2 inline-block hover:underline font-medium">Manage Directory &rarr;</a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-slate-500 font-semibold text-sm uppercase tracking-wider">Admissions</h2>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">{{ $totalAdmissions ?? 0 }}</p>
                    <a href="#" class="text-sm text-emerald-600 mt-2 inline-block hover:underline font-medium">Review Applications &rarr;</a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-slate-500 font-semibold text-sm uppercase tracking-wider">Tuition</h2>
                    <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">{{ $totalTuition ?? 0 }}</p>
                    <a href="#" class="text-sm text-amber-600 mt-2 inline-block hover:underline font-medium">Financial Records &rarr;</a>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold text-slate-900 mb-4">Strategic Intelligence & Reporting</h2>
            <div class="space-y-4">
                
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6 hover:shadow-md transition-shadow">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Economic Demographics & Predictive Cohorts</h3>
                        <p class="text-slate-500 text-sm mt-2 max-w-2xl leading-relaxed">Access advanced K-Means clustering and descriptive analytics to objectively evaluate student socioeconomic distribution, resource strain, and future financial aid requirements.</p>
                    </div>
                    <a href="{{ route('admin.economics') }}" class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors w-full md:w-auto shrink-0">
                        Open Analytics Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6 hover:shadow-md transition-shadow">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Institutional Reporting & DEPED Compliance</h3>
                        <p class="text-slate-500 text-sm mt-2 max-w-2xl leading-relaxed">Generate automated, ready-to-submit official reports and gain strategic insights into active enrollment demographics across all grade levels.</p>
                    </div>
                    <a href="{{ route('admin.reports') }}" class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors w-full md:w-auto shrink-0">
                        Open Reports Hub
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                
            </div>
        </div>
    </main>
</body>
</html>