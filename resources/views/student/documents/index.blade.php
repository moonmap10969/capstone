<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Document Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50">

    {{-- Sidebar --}}
    @include('student.layouts.sidebar')

    <main class="flex-1 p-8 w-full">
        <div class="space-y-6 max-w-5xl mx-auto">

            {{-- Page Header --}}
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Admission Documents</h1>
            </div>

            {{-- Progress Card --}}
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Submission Progress</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['submitted'] }} 
                            <span class="text-lg text-gray-400 font-normal">of {{ $stats['total'] }} documents</span>
                        </p>
                    </div>
                    <div class="flex gap-4 text-sm font-semibold">
                        <div class="flex items-center gap-2 text-green-600 bg-green-50 px-3 py-1 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> {{ $stats['submitted'] }} Approved
                        </div>
                        <div class="flex items-center gap-2 text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span> {{ $stats['pending'] }} Pending
                        </div>
                    </div>
                </div>
                <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden border border-gray-200">
                    <div class="bg-blue-600 h-full transition-all duration-700 ease-in-out" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            {{-- Required Documents --}}
            @php
                $required = [
                    'report_card'       => ['title' => 'Report Card (Form 138)', 'desc' => 'Latest school report card from previous grade level.'],
                    'birth_certificate' => ['title' => 'PSA Birth Certificate', 'desc' => 'Original and photocopy of PSA Birth Certificate.'],
                    'applicant_photo'   => ['title' => 'Applicant Photo', 'desc' => '2x2 ID photo with white background.'],
                    'father_photo'      => ['title' => 'Father\'s Photo', 'desc' => 'Recent ID photo of the father.'],
                    'mother_photo'      => ['title' => 'Mother\'s Photo', 'desc' => 'Recent ID photo of the mother.'],
                    'guardian_photo'    => ['title' => 'Guardian\'s Photo', 'desc' => 'Recent ID photo of the legal guardian.'],
                    'transferee_docs'   => ['title' => 'Transferee Documents', 'desc' => 'Honorable dismissal or transfer credentials.']
                ];
            @endphp

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
                    <h2 class="text-lg font-bold text-gray-800">Required Admission Files</h2>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($required as $key => $info)
                        @php 
                            $existing = $documents->where('title', $key)->first(); 
                        @endphp

                        <div class="flex flex-col sm:flex-row items-center justify-between p-4 border rounded-lg gap-4">
                            {{-- Document Info --}}
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $info['title'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $info['desc'] }}</p>
                            </div>

                            {{-- Status and Actions --}}
                            <div class="flex flex-col sm:flex-row items-center gap-2">
                                @if($existing)
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        {{ $existing->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ strtoupper($existing->status) }}
                                    </span>
                                    <a href="{{ asset('storage/' . $existing->file_path) }}" target="_blank" class="text-blue-600 font-bold underline text-sm">VIEW</a>
                                @else
                                    <span class="text-gray-400 italic text-sm">NOT SUBMITTED</span>
                                @endif

                                {{-- Upload Form --}}
                                <form action="{{ route('student.documents.upload') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $key }}">
                                    <input type="file" name="file" class="file-input" onchange="updateFileName(this)">
                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Upload</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

    <script>
        function updateFileName(input) {
            const label = input.parentElement.querySelector('.file-name');
            if (input.files.length > 0) {
                label.textContent = input.files[0].name;
                label.classList.add('text-blue-600', 'font-semibold');
            }
        }
    </script>
</body>
</html>
