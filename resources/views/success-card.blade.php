<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="bg-white p-8 rounded-3xl shadow-xl text-center max-w-md border border-green-100">
    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>
    <h2 class="text-3xl font-bold text-gray-800 mb-3">Application Received!</h2>
    <p class="text-gray-600 mb-6 leading-relaxed">
        To complete your admission, please visit the school campus to <strong>submit your physical documents</strong>, participate in a <strong>quick interview</strong>, and <strong>settle the required school fees</strong>.
    </p>
    <div class="space-y-3">
        <a href="{{ route('welcome') }}" class="block w-full bg-green-700 text-white font-bold py-3 rounded-xl hover:bg-green-800 transition shadow-md">
            Return to Homepage
        </a>
    </div>
</div>
</body>
</html>