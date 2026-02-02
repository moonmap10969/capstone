<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    @include('student.layouts.sidebar')

    <main class="flex-1 px-6 py-10 lg:px-12">
        <div class="max-w-6xl mx-auto space-y-14">

            <!-- Enrollment Progress -->
            <section>
                <h2 class="text-3xl font-bold text-green-700 text-center mb-12">
                    Enrollment Journey
                </h2>
            
                <div class="relative">
                    <!-- Raised horizontal line -->
                    <div class="hidden md:block absolute left-0 right-0 top-1/3 h-1 bg-green-700"></div>
            
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
                        @foreach([
                            ['1','Application','Fill out student details'],
                            ['2','Documents','Upload requirements'],
                            ['3','Payment','Make the payment'],
                            ['4','Confirmed','Official enrollment']
                        ] as [$step,$title,$desc])
                            <div class="flex flex-col items-center text-center">
                                <div class="w-16 h-16 rounded-full {{ $step <= 1 ? 'bg-green-700 text-white' : 'bg-white border-4 border-green-700 text-green-700' }} flex items-center justify-center text-xl font-bold shadow">
                                    {{ $step }}
                                </div>
                                <p class="mt-4 font-semibold text-green-700">{{ $title }}</p>
                                <p class="text-sm text-gray-500">{{ $desc }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            

            <!-- Enrollment Form Card -->
            <section class="bg-white rounded-3xl shadow-xl p-8 lg:p-12">
                <h1 class="text-3xl font-bold text-green-700 mb-10 text-center">
                    Student Enrollment Application
                </h1>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded-lg mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admissions.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Student Info -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Student First Name *</label>
                            <input type="text" name="student_first_name" value="{{ old('student_first_name') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700"
                                placeholder="First Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Student Last Name *</label>
                            <input type="text" name="student_last_name" value="{{ old('student_last_name') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700"
                                placeholder="Last Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Date of Birth *</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-medium text-green-700 mb-2">Grade Applying For *</label>
                            <select name="grade_applied" required
                                class="appearance-none w-full px-4 py-3 rounded-xl border border-green-700 text-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="">Select a grade</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="Grade {{ $i }}" {{ old('grade_applied') == "Grade $i" ? 'selected' : '' }}>
                                        Grade {{ $i }}</option>
                                @endfor
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Info -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Parent First Name *</label>
                            <input type="text" name="parent_first_name" value="{{ old('parent_first_name') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Parent Last Name *</label>
                            <input type="text" name="parent_last_name" value="{{ old('parent_last_name') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700"
                                placeholder="parent@example.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Phone *</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700"
                                placeholder="(0912) 345 6789">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-green-700 mb-2">Street Address *</label>
                            <input type="text" name="street" value="{{ old('street') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">City *</label>
                            <input type="text" name="city" value="{{ old('city') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-2">State *</label>
                                <input type="text" name="state" value="{{ old('state') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-2">ZIP Code *</label>
                                <input type="text" name="zip" value="{{ old('zip') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
                            </div>
                        </div>
                    </div>

                    <!-- Submit / Next Buttons -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('student.dashboard') }}" class="text-green-700 font-semibold hover:underline">
                            Back
                        </a>

                        <button type="submit" class="bg-green-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-800 transition">
                            Next
                        </button>
                    </div>

                </form>
            </section>

        </div>
    </main>

</body>
</html>
