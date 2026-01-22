<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUMCES - Education</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50"> 

  {{-- Success Card --}}
    @if(session('status') === 'submitted')
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm px-4">
            <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl text-center border border-gray-100">
                <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Submission Successful!</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    We have received your application (ID: <span class="font-mono font-bold text-green-700">{{ session('appId') }}</span>). 
                    Please wait for an email containing notification that your application was successful while we verify your documents.
                </p>
                
                <button onclick="window.location.href='/education'" class="w-full py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all shadow-lg shadow-green-200">
                    Got it, thank you!
                </button>
            </div>
        </div>
    @endif
        @include('layouts.header')


<div class="min-h-screen bg-gray-50" x-data="{ isSubmitting: false }">
    <main>
        {{-- Hero Section --}}
        <section class="py-24 bg-green-600 relative overflow-hidden text-white">
            <div class="absolute inset-0 opacity-20 pattern-waves"></div>
            <div class="container mx-auto px-4 relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Enroll Your Child Today</h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                    Complete the enrollment form below to start your child's journey at FUMCES.
                </p>
            </div>
        </section>

        @php
            $steps = [
        ['step' => '01', 'title' => 'Submit Request', 'description' => 'Complete the admissions form and submit your initial enrollment request.', 'icon' => 'send'],
        ['step' => '02', 'title' => 'Success Confirmation', 'description' => 'Upon submission, you will be redirected to a success card confirming your request.', 'icon' => 'check-circle'],
        ['step' => '03', 'title' => 'Wait for Admin Approval', 'description' => 'Our administration team will verify your documents and approve your application.', 'icon' => 'clock'],
        ['step' => '04', 'title' => 'Receive Portal Access', 'description' => 'Check your email for approval and your new Student Number to access the portal.', 'icon' => 'key'],
            ];
        @endphp

        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Enrollment Process</h2>
                    <p class="text-lg text-gray-600">
                        Our streamlined process makes it easy for families to join our community.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($steps as $index => $step)
                        <div class="relative bg-white rounded-3xl p-6 shadow-md" 
                            style="animation: fadeInUp 0.5s ease-out forwards; animation-delay: {{ $index * 0.1 }}s;">
                            
                            <div class="absolute -top-3 left-6 bg-green-600 text-white font-bold text-sm px-3 py-1 rounded-full">
                                {{ $step['step'] }}
                            </div>

                            <div class="mt-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 text-green-600">
                                    <i data-lucide="{{ $step['icon'] }}" class="w-6 h-6"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    {{ $step['title'] }}
                                </h3>
                                <p class="text-sm text-gray-600">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Enrollment Form --}}
        <section class="py-24">
   <div class="max-w-4xl mx-auto text-center">
    {{-- Header Section --}}
    <div class="w-20 h-20 bg-green-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
        </svg>
    </div>
            
    <h2 class="text-3xl font-bold text-gray-900 mb-4">
        Student Enrollment Application
    </h2>
            
    <p class="text-lg text-gray-600 mb-4">
        Please fill out all required fields to submit your child's enrollment application.
    </p>
</div>
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <form action="{{ route('student.admissions.store') }}" method="POST" enctype="multipart/form-data"
                          @submit="isSubmitting = true" 
                          class="bg-white rounded-3xl p-8 md:p-12 shadow-lg border border-gray-100">
                        @csrf

                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b">Student Information</h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Student First Name *</label>
                                    <input type="text" name="studentFirstName" value="{{ old('studentFirstName') }}" 
                                           class="w-full px-4 py-3 rounded-xl border @error('studentFirstName') border-red-500 @enderror">
                                    @error('studentFirstName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Student Last Name *</label>
                                    <input type="text" name="studentLastName" value="{{ old('studentLastName') }}" 
                                           class="w-full px-4 py-3 rounded-xl border @error('studentLastName') border-red-500 @enderror">
                                    @error('studentLastName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Date of Birth *</label>
                                    <input type="date" name="dateOfBirth" value="{{ old('dateOfBirth') }}" 
                                           class="w-full px-4 py-3 rounded-xl border @error('dateOfBirth') border-red-500 @enderror">
                                    @error('dateOfBirth') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Grade Applying For *</label>
                                    <select name="gradeApplying" class="w-full px-4 py-3 rounded-xl border @error('gradeApplying') border-red-500 @enderror">
                                        <option value="">Select a grade</option>
                                        @foreach(['kindergarten', 'grade 1', 'grade 2', 'grade 3', 'grade 4', 'grade 5', 'grade 6', 'grade 7', 'grade 8', 'grade 9', 'grade 10'] as $grade)
                                            <option value="{{ $grade }}" {{ old('gradeApplying') == $grade ? 'selected' : '' }}>
                                                {{ ucfirst($grade) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gradeApplying') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Parent/Guardian Information --}}
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b">Parent/Guardian Information</h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Parent First Name *</label>
                                    <input type="text" name="parentFirstName" value="{{ old('parentFirstName') }}" 
                                        class="w-full px-4 py-3 rounded-xl border @error('parentFirstName') border-red-500 @enderror">
                                    @error('parentFirstName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Parent Last Name *</label>
                                    <input type="text" name="parentLastName" value="{{ old('parentLastName') }}" 
                                        class="w-full px-4 py-3 rounded-xl border @error('parentLastName') border-red-500 @enderror">
                                    @error('parentLastName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Email Address *</label>
                                    <input type="email" name="email" value="{{ old('email') }}" 
                                        class="w-full px-4 py-3 rounded-xl border @error('email') border-red-500 @enderror">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" 
                                        class="w-full px-4 py-3 rounded-xl border @error('phone') border-red-500 @enderror">
                                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Address Information --}}
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b">Address Information</h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2">Street Address *</label>
                                    <input type="text" name="address" value="{{ old('address') }}" 
                                        class="w-full px-4 py-3 rounded-xl border @error('address') border-red-500 @enderror">
                                    @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">City *</label>
                                    <input type="text" name="city" value="{{ old('city') }}" 
                                        class="w-full px-4 py-3 rounded-xl border @error('city') border-red-500 @enderror">
                                    @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-2">State *</label>
                                        <input type="text" name="state" value="{{ old('state') }}" 
                                            class="w-full px-4 py-3 rounded-xl border @error('state') border-red-500 @enderror">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-2">ZIP Code *</label>
                                        <input type="text" name="zipCode" value="{{ old('zipCode') }}" 
                                            class="w-full px-4 py-3 rounded-xl border @error('zipCode') border-red-500 @enderror">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Document Submission Section --}}
<div class="mb-10">
    <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b">Document Submission</h3>
    <p class="text-sm text-gray-600 mb-6">
        Please upload the required documents. Accepted formats: PDF, JPG, PNG (max 10MB each).
    </p>

    <div class="grid md:grid-cols-2 gap-6">
        @php
        $docs = [
            'birthCertificate' => 'Birth Certificate *',
            'immunizationRecords' => 'Immunization Records *',
            'reportCard' => 'Report Card *', // Name must match controller
            'goodMoral' => 'Good Moral Certificate *' // Name must match controller
        ];
    @endphp

        @foreach($docs as $name => $label)
            <div>
                <label class="block text-sm font-medium mb-2">{{ $label }}</label>
                <div class="relative border-2 border-dashed rounded-xl p-4 @error($name) border-red-500 bg-red-50 @else border-gray-300 hover:border-green-500 @enderror">
                    <input type="file" name="{{ $name }}" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
                @error($name) <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        @endforeach
    </div>
</div>


                     {{-- Additional Information --}}
                        <div class="mb-10">
                            <label class="block text-sm font-medium mb-2">Anything else we should know?</label>
                            <textarea name="additionalInfo" rows="4" 
                                    class="w-full px-4 py-3 rounded-xl border resize-none @error('additionalInfo') border-red-500 @enderror">{{ old('additionalInfo') }}</textarea>
                        </div>
                        
     {{-- Submit Button --}}
    <div class="text-center mt-12">
        <button type="submit" class="inline-flex items-center px-8 py-4 bg-yellow-400 text-black font-bold rounded-full hover:bg-yellow-500 transition-colors gap-2 min-w-[200px]">
            Submit Application
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
        <p class="mt-4 text-sm text-gray-500">
            By submitting this form, you agree to our privacy policy and terms of service.
        </p>
    </div>
                    </form>
                </div>
            </div>
        </section>
        
    </main>
</div>
@include('layouts.footer')

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
</body>
</html>