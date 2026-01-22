{{-- resources/views/admin/admissions/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Create Admission</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="min-h-screen flex bg-gray-100">

    @include('layouts.sidebar')

    <main class="flex-1 p-6">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add Admission</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Full Width Form --}}
        <form action="{{ route('admin.admissions.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 w-full">
            @csrf

            {{-- Student Name --}}
            <div class="mb-4">
                <label for="student_name" class="block text-gray-700 font-semibold mb-1">Student Name</label>
                <input type="text" name="student_name" id="student_name" value="{{ old('student_name') }}"
                       class="w-full border border-gray-300 rounded px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                       value="{{ old('email') }}" required>
            </div>
            

{{-- Year Level --}}
<div class="mb-4">
    <label for="year_level" class="block text-gray-700 font-semibold mb-1">Grade / Year Level</label>
    <select name="year_level" id="year_level"
            class="appearance-none w-full border border-gray-300 rounded px-4 py-3 pr-10 text-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
        <option value="">Select Grade</option>
        <!-- Elementary -->
        <option value="Grade 1" {{ old('year_level') == 'Grade 1' ? 'selected' : '' }}>Grade 1</option>
        <option value="Grade 2" {{ old('year_level') == 'Grade 2' ? 'selected' : '' }}>Grade 2</option>
        <option value="Grade 3" {{ old('year_level') == 'Grade 3' ? 'selected' : '' }}>Grade 3</option>
        <option value="Grade 4" {{ old('year_level') == 'Grade 4' ? 'selected' : '' }}>Grade 4</option>
        <option value="Grade 5" {{ old('year_level') == 'Grade 5' ? 'selected' : '' }}>Grade 5</option>
        <option value="Grade 6" {{ old('year_level') == 'Grade 6' ? 'selected' : '' }}>Grade 6</option>
        <!-- Junior High -->
        <option value="Grade 7" {{ old('year_level') == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
        <option value="Grade 8" {{ old('year_level') == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
        <option value="Grade 9" {{ old('year_level') == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
        <option value="Grade 10" {{ old('year_level') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
        <!-- Senior High -->
        <option value="Grade 11" {{ old('year_level') == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
        <option value="Grade 12" {{ old('year_level') == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
    </select>
</div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-semibold mb-1">Status</label>
                <select name="status" id="status"
                        class="appearance-none w-full border border-gray-300 rounded px-4 py-3 pr-10 text-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            {{-- Admission Date --}}
            <div class="mb-4">
                <label for="admission_date" class="block text-gray-700 font-semibold mb-1">Admission Date</label>
                <input type="text" name="admission_date" id="admission_date" value="{{ old('admission_date') }}"
                       class="w-full border border-gray-300 rounded px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.admissions.index') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded bg-green-700 text-white hover:bg-green-800">Add Admission</button>
            </div>
        </form>

    </main>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#admission_date", {
            dateFormat: "Y-m-d",
            allowInput: true,
        });
    </script>

</body>
</html>


