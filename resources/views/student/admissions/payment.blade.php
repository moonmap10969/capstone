<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Payment</title>
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
                    <div class="hidden md:block absolute left-0 right-0 top-1/3 h-1 bg-green-700"></div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
                        @foreach([
                            ['1','Application','Fill out student details'],
                            ['2','Documents','Upload requirements'],
                            ['3','Payment','Submit your payment'],
                            ['4','Confirmed','Official enrollment']
                        ] as [$step,$title,$desc])
                            <div class="flex flex-col items-center text-center">
                                <div class="w-16 h-16 rounded-full {{ $step <= 3 ? 'bg-green-700 text-white' : 'bg-white border-4 border-green-700 text-green-700' }} flex items-center justify-center text-xl font-bold shadow">
                                    {{ $step }}
                                </div>
                                <p class="mt-4 font-semibold text-green-700">{{ $title }}</p>
                                <p class="text-sm text-gray-500">{{ $desc }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Payment + File Upload Card -->
            <section class="bg-white rounded-3xl shadow-xl p-8 lg:p-12">
                <h1 class="text-3xl font-bold text-green-700 mb-10 text-center">
                    Submit Payment & Upload Documents
                </h1>

                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Payment Method -->
                    <div class="relative">
                        <label class="block font-semibold text-gray-700 mb-2">Payment Method</label>
                        <select name="payment_method" class="appearance-none text-gray-700 w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none pr-10" required>
                            <option value="">Select a payment method</option>
                            <option value="gcash">GCash</option>
                            <option value="paymaya">Maya</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                        <!-- Arrow Icon -->
                        <div class="pointer-events-none mt-4 absolute right-0 top-1/2 transform -translate-y-1/2 flex items-center px-3 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Reference Number -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Reference Number / Transaction ID</label>
                        <input type="text" name="reference_number" placeholder="Enter your payment reference number"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                    </div>

                    <!-- Payer Name -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Payer Name</label>
                        <input type="text" name="payer_name" placeholder="Full name of the payer"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Amount Paid</label>
                        <input type="number" name="amount" placeholder="Enter the amount paid"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                    </div>

                    <!-- Payment Date -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Payment Date</label>
                        <input type="date" name="payment_date"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                    </div>

                    <!-- File Uploads -->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="border border-gray-200 rounded-xl p-5 hover:shadow transition bg-gray-50 w-full">
                            <label class="block font-semibold text-gray-700 mb-3">
                                Payment Receipt
                            </label>
                            <label class="flex items-center justify-between border border-dashed border-gray-300 rounded-lg px-4 py-3 cursor-pointer bg-white hover:bg-gray-50 transition w-full">
                                <span class="text-sm text-gray-500">Choose file</span>
                                <input type="file" name="payment_receipt" class="hidden" required>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex justify-between items-center pt-8">
                        <a href="{{ route('student.admissions.documents') }}"
                            class="text-green-700 font-semibold hover:underline">
                            Back
                        </a>
                        <button type="submit" class="bg-green-700 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-800 transition">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </main>

</body>

</html>


