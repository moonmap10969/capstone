<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admission</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Admission</h1>
            <a href="{{ route('admin.admissions.index') }}"
               class="bg-gray-700 text-white px-5 py-2 rounded hover:bg-gray-800">
                Back to Admissions
            </a>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white shadow rounded-lg p-6 w-full max-w-3xl">

            <form action="{{ route('admin.admissions.update', $admission->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Student Name --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-1">
                        Student Name
                    </label>
                    <input type="text"
                           name="student_name"
                           value="{{ old('student_name', $admission->student_name) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-500"
                           required>
                </div>

                {{-- Grade --}}
                <div class="mb-5 relative">
                    <label class="block text-gray-700 font-semibold mb-1">
                        Grade / Year Level
                    </label>

                    <select name="year_level"
                            class="appearance-none w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:ring-2 focus:ring-green-500"
                            required>
                        <option value="">Select Grade</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="Grade {{ $i }}"
                                {{ $admission->year_level === 'Grade '.$i ? 'selected' : '' }}>
                                Grade {{ $i }}
                            </option>
                        @endfor
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5.25 7.5L10 12.25L14.75 7.5H5.25Z"/>
                        </svg>
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-5 relative">
                    <label class="block text-gray-700 font-semibold mb-1">
                        Status
                    </label>

                    <select name="status"
                            class="appearance-none w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:ring-2 focus:ring-green-500"
                            required>
                        <option value="pending" {{ $admission->status === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="approved" {{ $admission->status === 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>
                        <option value="rejected" {{ $admission->status === 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5.25 7.5L10 12.25L14.75 7.5H5.25Z"/>
                        </svg>
                    </div>
                </div>

                {{-- Admission Date --}}
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-1">
                        Admission Date
                    </label>
                    <input type="date"
                           name="admission_date"
                           value="{{ old('admission_date', optional($admission->admission_date)->format('Y-m-d')) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-500">
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full bg-green-700 text-white py-2 rounded hover:bg-green-800 font-semibold">
                    Update Admission
                </button>

            </form>
        </div>

    </main>
</body>
</html>
