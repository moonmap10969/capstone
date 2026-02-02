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

    <!-- Hero Section -->
    <section class="py-24 bg-green-700 relative text-white text-center">
      <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Enroll Your Child Today</h1>
        <p class="text-xl">We're excited to welcome new families! Complete the enrollment form below to start your child's journey at First United Methodist Church Ecumenical School Inc Elementary.</p>
      </div>
    </section>

    <!-- Enrollment Process Section -->
    <section class="py-16 bg-[#f5f6f1]">
      <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
          <h2 class="text-3xl font-display font-bold text-foreground mb-4">Enrollment Process</h2>
          <p class="text-lg text-muted-foreground">Our streamlined process makes it easy for families to join our community.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach(['Complete Application', 'Submit Documents', 'Family Interview', 'Welcome to FUMCES!'] as $index => $step)
          <div class="relative bg-white rounded-3xl p-6 shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1">
            <div class="absolute -top-3 left-6 bg-green-700 text-white font-bold text-sm px-3 py-1 rounded-full">
              {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
            </div>
            <div class="mt-6 flex flex-col items-center text-center">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <h3 class="text-lg font-bold text-foreground mb-2">{{ $step }}</h3>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Enrollment Form Section -->
    <section class="py-24 bg-[#faf9f5]">
      <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-green-700 mb-4">Student Enrollment Application</h2>
          <p class="text-green-700/70">Please fill out all required fields to submit your child's enrollment application.</p>
        </div>

        {{-- Success message --}}
        @if(session('success'))
          <div class="bg-green-100 text-green-700 px-6 py-4 rounded-xl mb-6 text-center font-semibold">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('student.admissions.store') }}" method="POST" class="bg-white rounded-3xl p-8 md:p-12 shadow-lg space-y-8">
          @csrf

          <!-- Student Info -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-green-700 mb-2">Student First Name *</label>
              <input type="text" name="student_first_name" value="{{ old('student_first_name') }}" required
                     class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="First Name">
            </div>
            <div>
              <label class="block text-sm font-medium text-green-700 mb-2">Student Last Name *</label>
              <input type="text" name="student_last_name" value="{{ old('student_last_name') }}" required
                     class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="Last Name">
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
                  <option value="Grade {{ $i }}" {{ old('grade_applied') == "Grade $i" ? 'selected' : '' }}>Grade {{ $i }}</option>
                @endfor
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <svg class="h-5 w-5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                     class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="parent@example.com">
            </div>
            <div>
              <label class="block text-sm font-medium text-green-700 mb-2">Phone *</label>
              <input type="tel" name="phone" value="{{ old('phone') }}" required
                     class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="(0912) 345 6789">
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

          <!-- Submit -->
          <div class="text-center">
            <button type="submit"
                    class="bg-green-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-800 transition">
              Submit Application
            </button>
          </div>
        </form>

      </div>
    </section>

  </main>

  @include('layouts.footer')
</body>

</html>


