<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>First United Methodist Church Ecumenical School Inc. - Admissions</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 font-sans">

  @include('layouts.header')

  <main>

    <section class="py-24 bg-green-700 relative text-white text-center">
      <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Enroll Your Child Today</h1>
        <p class="text-xl">We're excited to welcome new families! Complete the enrollment form below to start your child's journey at First United Methodist Church Ecumenical School Inc Elementary.</p>
      </div>
    </section>

    <section class="py-16 bg-[#f5f6f1]">
      <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
          <h2 class="text-3xl font-display font-bold text-foreground mb-4">Enrollment Process</h2>
          <p class="text-lg text-muted-foreground">Our streamlined process makes it easy for families to join our community.</p>
        </div>
    
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          @php
            $steps = [
              ['title' => 'Complete Application', 'icon' => 'M3 7h18M3 12h18M3 17h18'],
              ['title' => 'Submit Documents', 'icon' => 'M12 4v16m8-8H4'],
              ['title' => 'Document Verification', 'icon' => 'M5 13l4 4L19 7'],
              ['title' => 'Welcome to FUMCES!', 'icon' => 'M12 2a10 10 0 100 20 10 10 0 000-20z']
            ];
          @endphp
    
          @foreach($steps as $index => $step)
          <div class="relative bg-white rounded-3xl p-6 shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1">
            <div class="absolute -top-3 left-6 bg-green-700 text-white font-bold text-sm px-3 py-1 rounded-full">
              {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
            </div>
            <div class="mt-6 flex flex-col items-center text-center">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}" />
                </svg>
              </div>
              <h3 class="text-lg font-bold text-foreground mb-2">{{ $step['title'] }}</h3>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <div class="min-h-screen bg-gray-50 text-gray-900 font-sans">
        <section class="py-24" id="enrollment-form">
            <div class="container mx-auto px-4 max-w-4xl">
                <form id="admissionForm" action="{{ route('admissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="type" value="admission">
                    
                    <div class="mb-10">
                        <h3 class="text-xl font-bold mb-6 pb-2 border-b">Student Information</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Student First Name *</label>
                                <input type="text" name="studentFirstName" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-green-700 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Student Last Name *</label>
                                <input type="text" name="studentLastName" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-green-700 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Date of Birth *</label>
                                <input type="date" name="dateOfBirth" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-green-700 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Grade Applying For *</label>
                                <select name="year_level" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-green-700 outline-none" required>
                                    <option value="">Select a grade</option>
                                    <option value="kindergarten">Kindergarten</option>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="grade{{$i}}">Grade {{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-2">Previous School (if applicable)</label>
                                <input type="text" name="previousSchool" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-green-700 outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <h3 class="text-xl font-bold mb-6 pb-2 border-b">Parent/Guardian Information</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <input type="text" name="parentFirstName" placeholder="First Name *" class="w-full px-4 py-3 rounded-xl border" required>
                            <input type="text" name="parentLastName" placeholder="Last Name *" class="w-full px-4 py-3 rounded-xl border" required>
                            <input type="email" name="email" placeholder="Email Address *" class="w-full px-4 py-3 rounded-xl border" required>
                            <input type="tel" name="phone" placeholder="Phone Number *" class="w-full px-4 py-3 rounded-xl border" required>
                        </div>
                    </div>

                    <div class="mb-10">
                        <h3 class="text-xl font-bold mb-6 pb-2 border-b">Address Information</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <input type="text" name="address" placeholder="Street Address *" class="w-full px-4 py-3 rounded-xl border" required>
                            </div>
                            <input type="text" name="city" placeholder="City *" class="w-full px-4 py-3 rounded-xl border" required>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="state" placeholder="State *" class="w-full px-4 py-3 rounded-xl border" required>
                                <input type="text" name="zipCode" placeholder="ZIP *" class="w-full px-4 py-3 rounded-xl border" required>
                            </div>
                        </div>
                    </div>

 <div class="mb-10">
                    <div class="mb-10 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                      <h3 class="text-xl font-bold mb-6 pb-2 border-b border-gray-200 text-gray-800">Document Submission</h3>
                     
                      <div class="grid md:grid-cols-2 gap-x-8 gap-y-6">
                          <div class="space-y-1">
                              <label class="text-sm font-semibold text-gray-700">Report Card *</label>
                              <input type="file" name="report_card" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-green-700 hover:file:bg-blue-100 transition" required>
                          </div>


                          <div class="space-y-1">
                              <label class="text-sm font-semibold text-gray-700">Birth Certificate (Photocopy) *</label>
                              <input type="file" name="birth_certificate" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-green-700 hover:file:bg-blue-100 transition" required>
                          </div>


                          <div class="space-y-1">
                              <label class="text-sm font-semibold text-gray-700">1x1 Photo of Applicant *</label>
                              <input type="file" name="applicant_photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-green-700 hover:file:bg-blue-100 transition" required>
                          </div>


                          <div class="grid grid-cols-3 gap-2 md:col-span-2 pt-2">
                              <div class="space-y-1">
                                  <label class="text-xs font-medium text-gray-600">Father's 2x2 *</label>
                                  <input type="file" name="father_photo" class="block w-full text-xs text-gray-500 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-green-700" required>
                              </div>
                              <div class="space-y-1">
                                  <label class="text-xs font-medium text-gray-600">Mother's 2x2 *</label>
                                  <input type="file" name="mother_photo" class="block w-full text-xs text-gray-500 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-green-700" required>
                              </div>
                              <div class="space-y-1">
                                  <label class="text-xs font-medium text-gray-600">Guardian's 2x2 *</label>
                                  <input type="file" name="guardian_photo" class="block w-full text-xs text-gray-500 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-green-700" required>
                              </div>
                          </div>
                      </div>


                      <div class="mt-8 pt-6 border-t border-dashed border-gray-300">
                          <label class="text-sm font-semibold text-gray-700 block mb-2">For Transferees (Permanent Record / Good Moral)</label>
                          <input type="file" name="transferee_docs" class="block w-full text-sm text-gray-500  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                      </div>
                  </div>


                    <button type="button" id="submitBtn" class="w-full bg-yellow-400 hover:bg-yellow-500 text-green-700 font-bold py-4 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                        SUBMIT APPLICATION
                    </button>
                </form>
            </div>
        </section>
    </div>

    <div id="authModal" class="fixed inset-0 bg-green-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl text-center">
            <div class="w-20 h-20 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">🔑</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Registration Required</h3>
            <p class="text-gray-600 mb-8">Please create an account to submit your application and track your progress.</p>
            <div class="space-y-3">
                <a href="{{ route('register') }}" class="block w-full bg-green-700 text-white font-bold py-3 rounded-xl">Create Account</a>
                <a href="{{ route('login') }}" class="block w-full text-green-700 font-semibold py-2">Login</a>
                <button onclick="document.getElementById('authModal').classList.replace('flex', 'hidden')" class="text-gray-400 text-sm mt-4">Close</button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div id="success-modal" class="fixed inset-0 bg-green-900/60 backdrop-blur-sm flex items-center justify-center z-[100] p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full text-center">
            <div class="text-6xl mb-4 text-green-500">✓</div>
            <h2 class="text-2xl font-bold mb-2">Application Received!</h2>
            <p class="text-gray-600 mb-8">{{ session('success') }}</p>
            <button onclick="this.closest('#success-modal').remove()" class="w-full bg-yellow-400 text-green-900 font-bold py-3 rounded-xl">Got it!</button>
        </div>
    </div>
    @endif
  </main>

  @include('layouts.footer')

  <script>
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        @auth
            document.getElementById('admissionForm').submit();
        @else
            document.getElementById('authModal').classList.replace('hidden', 'flex');
        @endauth
    });
  </script>
</body>
</html>