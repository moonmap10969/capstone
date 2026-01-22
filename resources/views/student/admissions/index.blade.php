<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Admissions </title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

    {{-- Sidebar stays fixed on the left --}}
    @include('student.layouts.sidebar')
    <main class="flex-1 ml-64 p-8">
        <div class="ml-sidebar min-h-screen p-10">

        <div class="max-w-5xl mx-auto space-y-8">

            <div class="animate-fade-in">
                <h1 class="text-3xl font-bold text-gray-800">Admissions</h1>
                <p class="text-gray-500 mt-1">Your admission status and enrollment information</p>
            </div>
    
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Enrollment Info --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4 text-[#057E2E]">Current Enrollment</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Program</p>
                            <p class="font-medium text-gray-800">{{ $currentInfo['program'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Year & Section</p>
                            <p class="font-medium text-gray-800">{{ $currentInfo['yearLevel'] ?? 'N/A' }} - {{ $currentInfo['section'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Status Card --}}
                <div class="bg-[#057E2E] text-white rounded-xl shadow p-6 text-center">
                    <p class="text-xl font-bold">Fully Enrolled</p>
                    <p class="text-sm opacity-80 mb-4">S.Y. 2026-2027</p>
                    <div class="w-full bg-white/20 h-2 rounded-full overflow-hidden">
                        <div class="bg-white h-full" style="width: {{ $progress ?? 100 }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-lg mb-6">Admission Timeline</h3>
                <div class="space-y-6">
                    @foreach ($admissionSteps ?? [] as $step)
                        <div class="flex gap-4">
                            <div class="h-8 w-8 rounded-full bg-[#057E2E] text-white flex items-center justify-center shrink-0">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">{{ $step['title'] }}</p>
                                <p class="text-xs text-gray-500">{{ $step['date'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    </main> 
</body>
</html>