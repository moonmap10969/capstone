<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex bg-gray-100">

    @include('student.layouts.sidebar')

    <main class="flex-1 px-6 py-10 lg:px-12">
        <div class="max-w-6xl mx-auto space-y-14">

            <!-- Enrollment Progress -->
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
                    <div class="w-16 h-16 rounded-full {{ $step <= 2 ? 'bg-green-700 text-white' : 'bg-white border-4 border-green-700 text-green-700' }} flex items-center justify-center text-xl font-bold shadow">
                        {{ $step }}
                    </div>
                    <p class="mt-4 font-semibold text-green-700">{{ $title }}</p>
                    <p class="text-sm text-gray-500">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

            <!-- Application ID -->
            @if($admission)
                <div class="text-center">
                    <span class="text-gray-600 font-medium">Application ID</span>
                    <div class="text-green-700 font-bold text-xl mt-1">
                        {{ $admission->application_id }}
                    </div>
                </div>
            @endif

            <!-- Upload Card -->
            <section class="bg-white rounded-3xl shadow-xl p-8 lg:p-12">

                <h1 class="text-3xl font-bold text-green-700 mb-10 text-center">
                    Upload Required Documents
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

                <form action="{{ route('student.documents.upload') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf


                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(['birth_certificate', 'baptismal_certificate', 'report_card', 'good_moral_certificate', 'medical_records', 'id_photos', 'parent_id', 'proof_of_residence'] as $doc)
                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow transition bg-gray-50">
                                <label class="block font-semibold text-gray-700 mb-3">
                                    {{ ucwords(str_replace('_', ' ', $doc)) }}
                                </label>

                                <label
                                    class="flex items-center justify-between border border-dashed border-gray-300 rounded-lg px-4 py-3 cursor-pointer bg-white hover:bg-gray-50 transition">
                                    <span class="text-sm text-gray-500">Choose file</span>
                                    <input type="file" name="{{ $doc }}" class="hidden">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-green-700 text-white font-semibold px-10 py-3 rounded-xl hover:bg-green-800 transition">
                            Upload Documents
                        </button>
                    </div>
                    <div class="flex justify-between items-center pt-8">
                        <a href="{{ route('student.admissions.index') }}"
                            class="text-green-700 font-semibold hover:underline">
                            Back
                        </a>
                        <a href="{{ route('student.admissions.payment') }}"
                            class="bg-green-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-800 transition">
                            Next
                        </a>


                    </div>
                </form>
            </section>

        </div>
    </main>

</body>

</html>