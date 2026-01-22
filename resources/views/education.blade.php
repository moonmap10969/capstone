<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sunshine Elementary Programs</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f6f1]">


    @include('layouts.header')
<main>

  <!-- Hero Section -->
  <section class="py-24 bg-green-700 relative text-white text-center">
    <div class="max-w-3xl mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Educational Programs</h1>
      <p class="text-xl">A well-rounded curriculum designed to develop the whole child—academically, socially, and emotionally—preparing them for future success.</p>
    </div>
  </section>

  <!-- Programs Section -->
  <section class="py-24">
    <div class="max-w-7xl mx-auto px-4 space-y-16">
  
      <!-- Program 1 -->
      <div class="flex flex-col lg:flex-row gap-8 items-center">
        <div class="lg:w-1/3">
          <div class="bg-green-700 rounded-3xl p-12 flex items-center justify-center">
            <!-- Book Icon -->
            <svg class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v12M6 6h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z" />
            </svg>
          </div>
        </div>
  
        <div class="lg:w-2/3 bg-white rounded-3xl p-8 shadow-lg">
          <h2 class="text-2xl font-bold text-green-700 mb-4">Language Arts</h2>
          <p class="text-green-700/70 mb-6 leading-relaxed">
            Reading, writing, and communication skills through engaging stories and creative expression.
          </p>
          <div class="grid grid-cols-2 gap-3">
            <div class="flex items-center gap-2 bg-[#f5f6f1] rounded-xl px-4 py-2">
              <!-- Check Icon -->
              <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-green-700 text-sm font-medium">Reading comprehension</span>
            </div>
            <div class="flex items-center gap-2 bg-[#f5f6f1] rounded-xl px-4 py-2">
              <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-green-700 text-sm font-medium">Creative writing</span>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Program 2 -->
      <div class="flex flex-col lg:flex-row-reverse gap-8 items-center">
        <div class="lg:w-1/3">
          <div class="bg-green-700 rounded-3xl p-12 flex items-center justify-center">
            <!-- Calculator Icon -->
            <svg class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2zM9 9h6M9 13h2m2 0h2m-6 4h2m2 0h2" />
            </svg>
          </div>
        </div>
  
        <div class="lg:w-2/3 bg-white rounded-3xl p-8 shadow-lg">
          <h2 class="text-2xl font-bold text-green-700 mb-4">Mathematics</h2>
          <p class="text-green-700/70 mb-6 leading-relaxed">
            Building strong foundations in numbers, problem-solving, and logical thinking.
          </p>
          <div class="grid grid-cols-2 gap-3">
            <div class="flex items-center gap-2 bg-[#f5f6f1] rounded-xl px-4 py-2">
              <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-green-700 text-sm font-medium">Number sense</span>
            </div>
            <div class="flex items-center gap-2 bg-[#f5f6f1] rounded-xl px-4 py-2">
              <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-green-700 text-sm font-medium">Problem solving</span>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Program 3 -->
      <div class="flex flex-col lg:flex-row gap-8 items-center">
        <div class="lg:w-1/3">
          <div class="bg-green-700 rounded-3xl p-12 flex items-center justify-center">
            <!-- Globe Icon -->
            <svg class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 0c2.5 3 2.5 15 0 18m0-18C9.5 5 9.5 17 12 20m-8-8h16" />
            </svg>
          </div>
        </div>
  
        <div class="lg:w-2/3 bg-white rounded-3xl p-8 shadow-lg">
          <h2 class="text-2xl font-bold text-green-700 mb-4">Social Studies</h2>
          <p class="text-green-700/70 mb-6 leading-relaxed">
            Exploring history, geography, and cultures to understand our diverse world.
          </p>
          <div class="grid grid-cols-2 gap-3">
            <div class="flex items-center gap-2 bg-[#f5f6f1] rounded-xl px-4 py-2">
              <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-green-700 text-sm font-medium">World cultures</span>
            </div>
            <div class="flex items-center gap-2 bg-[#f5f6f1] rounded-xl px-4 py-2">
              <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-green-700 text-sm font-medium">Geography skills</span>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </section>
  
  <!-- Daily Schedule Section -->
  <section class="py-24 bg-[#fff]">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold text-green-700 mb-4">Daily Schedule</h2>
      <p class="text-lg text-green-700/70 mb-12">
        Our structured day provides a balance of academics, enrichment, and play.
      </p>
  
      <div class="bg-[#f5f6f1] rounded-3xl p-8 shadow-lg">
        <div class="grid md:grid-cols-2 gap-6">
  
          <!-- Item -->
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">7:30 AM</div>
              <div class="text-sm text-green-700/70">Doors Open / Breakfast</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">8:00 AM</div>
              <div class="text-sm text-green-700/70">Morning Circle / Announcements</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">8:30 AM</div>
              <div class="text-sm text-green-700/70">Core Academic Block</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">10:30 AM</div>
              <div class="text-sm text-green-700/70">Recess / Snack</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">11:00 AM</div>
              <div class="text-sm text-green-700/70">Specials (Art, Music, PE)</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">12:00 PM</div>
              <div class="text-sm text-green-700/70">Lunch & Recess</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">1:00 PM</div>
              <div class="text-sm text-green-700/70">Afternoon Academic Block</div>
            </div>
          </div>
  
          <div class="flex border-2 border-green-700 items-center gap-4 p-4 bg-[#f5f6f1] rounded-xl">
            <svg class="w-6 h-6 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="12" cy="12" r="9" stroke-width="2" />
              <path stroke-width="2" stroke-linecap="round" d="M12 7v5l3 2" />
            </svg>
            <div class="text-left">
              <div class="font-semibold text-green-700">3:00 PM</div>
              <div class="text-sm text-green-700/70">Dismissal / After School Care</div>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </section>
  </main>

@include('layouts.footer')


</body>
</html>
