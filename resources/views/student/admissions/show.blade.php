<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Admission Details</h1>
        <p class="text-gray-600 mb-6">Application ID: {{ $admission->application_id }}</p>

        <h2 class="text-xl font-semibold mb-2">Student Info</h2>
        <p>{{ $admission->student_first_name }} {{ $admission->student_last_name }}</p>
        <p>DOB: {{ $admission->date_of_birth }}</p>
        <p>Grade Applied: {{ $admission->grade_applied }}</p>

        <hr class="my-4">

        <h2 class="text-xl font-semibold mb-2">Parent Info</h2>
        <p>{{ $admission->parent_first_name }} {{ $admission->parent_last_name }}</p>
        <p>Email: {{ $admission->email }}</p>
        <p>Phone: {{ $admission->phone }}</p>

        <hr class="my-4">

        <h2 class="text-xl font-semibold mb-2">Documents</h2>
        <ul class="space-y-2">
            @if($documents && count($documents) > 0)
                @foreach($documents as $name => $path)
                <li class="flex justify-between items-center bg-gray-50 border rounded px-4 py-2">
                    <span>{{ ucwords(str_replace('_',' ',$name)) }}</span>
                    <a href="{{ asset('storage/'.$path) }}" target="_blank" class="text-green-600 hover:underline">View</a>
                </li>
                @endforeach
            @else
                <li class="text-gray-500">No documents uploaded yet.</li>
            @endif
        </ul>
    </div>

</body>
</html>
