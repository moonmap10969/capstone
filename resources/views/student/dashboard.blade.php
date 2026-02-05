<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="min-h-screen flex bg-slate-50">

    @include('student.layouts.sidebar')

    <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-10">

            <!-- Header -->
            <section class="relative overflow-hidden rounded-3xl bg-[#057E2E]  p-8 shadow-xl">
                <div class="relative z-10">
                    <h1 class="text-3xl font-semibold text-white tracking-tight">
                        Welcome, {{ $user->name }}
                    </h1>
                    <p class="text-white mt-2 text-sm font-medium">
                        Academic Year 2025–2026 · First Semester
                    </p>
                </div>
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl"></div>
            </section>

            <!-- Statistics -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($stats as $stat)
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                        {{ $stat['label'] }}
                    </p>
                    <div class="mt-4 flex items-end justify-between">
                        <h2 class="text-3xl font-bold text-slate-800">
                            {{ $stat['value'] }}
                        </h2>
                        <span class="{{ $stat['color'] }} bg-slate-50 px-3 py-1 rounded-full text-xs font-semibold">
                            Status
                        </span>
                    </div>
                </div>
                @endforeach
            </section>

            <!-- Quick Actions -->
            <section>
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest mb-4">
                    Quick Actions
                </h3>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- Grades -->
    <a href="{{ route('student.grades.index') }}"
       class="group bg-white p-5 rounded-xl border border-slate-200 flex flex-col items-center justify-center text-center hover:border-emerald-500 transition">
        <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center mb-3
                    group-hover:bg-emerald-600 transition">
            <svg class="w-5 h-5 text-emerald-600 group-hover:text-white" fill="none"
                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5
                         c-2.54 0-4.847-.65-6.16-1.922L12 14z" />
            </svg>
        </div>
        <span class="text-sm font-medium text-slate-700">Grades</span>
    </a>

    <!-- Schedule -->
    <a href="{{ route('student.schedule.index') }}"
       class="group bg-white p-5 rounded-xl border border-slate-200 flex flex-col items-center justify-center text-center hover:border-emerald-500 transition">
        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center mb-3
                    group-hover:bg-emerald-600 transition">
            <svg class="w-5 h-5 text-emerald-600 group-hover:text-white" fill="none"
                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2
                         2 0 002-2V7a2 2 0 00-2-2H5a2
                         2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <span class="text-sm font-medium text-slate-700">Schedule</span>
    </a>

    <!-- Tuition -->
    <a href="{{ route('student.tuition.index') }}"
    class="group bg-white p-5 rounded-xl border border-slate-200 flex flex-col items-center justify-center text-center hover:border-emerald-500 transition">
        <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center mb-3
                    group-hover:bg-emerald-600 transition">
            <svg class="w-5 h-5 text-emerald-600 group-hover:text-white"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <rect x="2" y="5" width="20" height="14" rx="2" ry="2"
                    stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="2" y1="10" x2="22" y2="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <span class="text-sm font-medium text-slate-700">Tuition</span>
    </a>


    <!-- Documents -->
    <a href="{{ route('student.documents.index') }}"
       class="group bg-white p-5 rounded-xl border border-slate-200 flex flex-col items-center justify-center text-center hover:border-emerald-500 transition">
        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center mb-3
                    group-hover:bg-emerald-600 transition">
            <svg class="w-5 h-5 text-emerald-600 group-hover:text-white" fill="none"
                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h6m-6 4h6m2
                         5H7a2 2 0 01-2-2V5a2
                         2 0 012-2h5l5 5v11a2
                         2 0 01-2 2z" />
            </svg>
        </div>
        <span class="text-sm font-medium text-slate-700">Documents</span>
    </a>

</div>

            </section>

            {{-- <!-- Announcements -->
            <section class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h3 class="text-lg font-semibold text-slate-800">
                        Institutional Announcements
                    </h3>
                    <button class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                        View All
                    </button>
                </div>

                <div class="divide-y divide-slate-100">
                    @foreach($announcements as $announcement)
                    <div class="p-6 hover:bg-slate-50 transition">
                        <div class="flex gap-5">
                            <div class="w-14 text-center">
                                <span class="block text-xs font-semibold text-slate-400 uppercase">
                                    {{ \Carbon\Carbon::parse($announcement['date'])->format('M') }}
                                </span>
                                <span class="block text-xl font-bold text-slate-700">
                                    {{ \Carbon\Carbon::parse($announcement['date'])->format('d') }}
                                </span>
                            </div>

                            <div class="flex-1">
                                <h4 class="font-semibold text-slate-800">
                                    {{ $announcement['title'] }}
                                </h4>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $announcement['description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section> --}}

        </div>
    </main>
</body>
</html>
