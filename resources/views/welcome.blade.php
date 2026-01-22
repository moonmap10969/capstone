<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FUMCES - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="{{ asset('resources/fumces_logo.jpg') }}" type="image/png">
</head>

<body class="min-h-screen bg-gray-50 dark:bg-gray-900 font-sans flex flex-col">

  @include('layouts.header')

  <section class="relative min-h-screen flex items-center overflow-hidden pt-2">

    <!-- Background -->
    <div class="absolute inset-0 z-0">
      <img src="{{ asset('images/bg-image.jpeg') }}" class="w-full h-full object-cover" alt="">
      <div class="absolute inset-0 bg-gradient-to-r from-green-700/90 via-green-700/70 to-transparent"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/50 via-transparent to-transparent"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 w-full">
      <div class="max-w-2xl px-6 sm:px-12 lg:px-24 text-left">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur rounded-full px-4 py-2 mb-3">
          <span class="text-yellow-400 text-sm">✨</span>
          <span class="text-sm font-medium text-white">
            Now Enrolling for 2025–2026
          </span>
        </div>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
          Where Every Child's
          <span class="text-yellow-400">Potential</span>
          Shines Bright
        </h1>

        <!-- Description -->
        <p class="text-lg md:text-xl text-white/90 mb-8 leading-relaxed">
          We nurture curious minds through engaging, hands on learning experiences that prepare students for success.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <a href="/admissions"
            class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-yellow-400 text-gray-900 font-semibold hover:bg-yellow-300 transition">
            Enroll Now
          </a>

          <a href="/about"
            class="inline-flex items-center justify-center px-8 py-4 rounded-xl border border-white text-white font-semibold hover:bg-white/10 transition">
            Learn More About Us
          </a>
        </div>

        <!-- Stats -->
        <div class="flex flex-wrap gap-10">

          <div>
            <div class="text-3xl font-bold text-yellow-400">
              <span class="counter" data-target="500">0</span>+
            </div>
            <div class="text-sm text-white/80">Happy Students</div>
          </div>

          <div>
            <div class="text-3xl font-bold text-yellow-400">
              <span class="counter" data-target="35">0</span>+
            </div>
            <div class="text-sm text-white/80">Expert Teachers</div>
          </div>

          <div>
            <div class="text-3xl font-bold text-yellow-400">
              <span class="counter" data-target="25">0</span>
            </div>
            <div class="text-sm text-white/80">Years of Excellence</div>
          </div>

        </div>

      </div>
    </div>

  </section>

  <section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

      <!-- Section Header -->
      <div class="text-center max-w-2xl mx-auto mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Why Families Choose <span
            class="bg-clip-text text-transparent bg-gradient-to-r from-green-700 via-green-600 to-green-500">First United Methodist
Church Ecumenical School
            Elementary</span>
        </h2>
        <p class="text-lg text-gray-600">
          We believe every child deserves an education that inspires, challenges, and prepares them for the future.
        </p>
      </div>

      <!-- Features Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Feature 1 -->
        <div
          class="group bg-white rounded-3xl p-8 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 text-green-700 text-2xl">
            ❤️</div>
          <h3 class="text-xl font-bold text-green-700 mb-3">Nurturing Environment</h3>
          <p class="text-gray-600 leading-relaxed">
            We create a warm, supportive atmosphere where every child feels valued, safe, and ready to learn.
          </p>
        </div>

        <!-- Feature 2 -->
        <div
          class="group bg-white rounded-3xl p-8 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 text-green-700 text-2xl">
            💡</div>
          <h3 class="text-xl font-bold text-green-700 mb-3">Creative Learning</h3>
          <p class="text-gray-600 leading-relaxed">
            Our curriculum sparks curiosity through hands-on projects, arts, and exploration-based education.
          </p>
        </div>

        <!-- Feature 3 -->
        <div
          class="group bg-white rounded-3xl p-8 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 text-green-700 text-2xl">
            👥</div>
          <h3 class="text-xl font-bold text-green-700 mb-3">Strong Community</h3>
          <p class="text-gray-600 leading-relaxed">
            Parents, teachers, and students work together to build lasting relationships and shared success.
          </p>
        </div>

        <!-- Feature 4 -->
        <div
          class="group bg-white rounded-3xl p-8 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 text-green-700 text-2xl">
            🏆</div>
          <h3 class="text-xl font-bold text-green-700 mb-3">Academic Excellence</h3>
          <p class="text-gray-600 leading-relaxed">
            Our proven methods help students achieve their best while developing a lifelong love of learning.
          </p>
        </div>

      </div>
    </div>
  </section>




  <section class="py-24 bg-[#f5f6f1]">
    <div class="max-w-7xl mx-auto px-4">

      <!-- Section Header -->
      <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16">
        <div class="max-w-2xl">
          <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-4">
            Our Educational Programs
          </h2>
          <p class="text-lg text-green-700/70">
            A well-rounded curriculum designed to develop the whole child—academically, socially, and emotionally.
          </p>
        </div>
        <a href="/education"
          class="inline-flex items-center gap-2 px-6 py-3 border border-green-700 rounded-xl text-green-700 font-semibold hover:bg-green-100 transition">
          View All Programs →
        </a>
      </div>

      <!-- Programs Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Program 1 -->
        <div class="group bg-white rounded-3xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="h-2 bg-green-700"></div>
          <div class="p-8">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-700 text-2xl">
                📚</div>
              <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Grades K-5</span>
            </div>
            <h3 class="text-xl font-bold text-green-700 mb-3">Language Arts</h3>
            <p class="text-green-700/70 leading-relaxed">
              Reading, writing, and communication skills through engaging stories and creative expression.
            </p>
          </div>
        </div>

        <!-- Program 2 -->
        <div class="group bg-white rounded-3xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="h-2 bg-green-700"></div>
          <div class="p-8">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-700 text-2xl">
                🧮</div>
              <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Grades K-5</span>
            </div>
            <h3 class="text-xl font-bold text-green-700 mb-3">Mathematics</h3>
            <p class="text-green-700/70 leading-relaxed">
              Building strong foundations in numbers, problem-solving, and logical thinking.
            </p>
          </div>
        </div>

        <!-- Program 3 -->
        <div class="group bg-white rounded-3xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="h-2 bg-green-700"></div>
          <div class="p-8">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-700 text-2xl">
                🌍</div>
              <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Grades K-5</span>
            </div>
            <h3 class="text-xl font-bold text-green-700 mb-3">Social Studies</h3>
            <p class="text-green-700/70 leading-relaxed">
              Exploring history, geography, and cultures to understand our diverse world.
            </p>
          </div>
        </div>

        <!-- Program 4 -->
        <div class="group bg-white rounded-3xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="h-2 bg-green-700"></div>
          <div class="p-8">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-700 text-2xl">
                🍃</div>
              <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Grades K-5</span>
            </div>
            <h3 class="text-xl font-bold text-green-700 mb-3">Science</h3>
            <p class="text-green-700/70 leading-relaxed">
              Hands-on experiments and discovery-based learning about our natural world.
            </p>
          </div>
        </div>

        <!-- Program 5 -->
        <div class="group bg-white rounded-3xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="h-2 bg-green-700"></div>
          <div class="p-8">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-700 text-2xl">
                🎨</div>
              <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Grades K-5</span>
            </div>
            <h3 class="text-xl font-bold text-green-700 mb-3">Visual Arts</h3>
            <p class="text-green-700/70 leading-relaxed">
              Nurturing creativity through painting, drawing, sculpture, and digital arts.
            </p>
          </div>
        </div>

        <!-- Program 6 -->
        <div class="group bg-white rounded-3xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
          <div class="h-2 bg-green-700"></div>
          <div class="p-8">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-700 text-2xl">
                🎵</div>
              <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Grades K-5</span>
            </div>
            <h3 class="text-xl font-bold text-green-700 mb-3">Music & Performing Arts</h3>
            <p class="text-green-700/70 leading-relaxed">
              Developing musical talents and self-expression through song, instruments, and performance.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="py-24 relative overflow-hidden bg-green-700">
    <!-- Background -->
    <div class="absolute inset-0 to-white opacity-80"></div>
    <div class="absolute inset-0 bg-[url('assets/pattern-waves.png')] opacity-30"></div>

    <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">

      <!-- Heading -->
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
        Ready to Give Your Child the <span class="text-yellow-400">Best Start?</span>
      </h2>

      <!-- Description -->
      <p class="text-lg md:text-xl text-white/90 mb-10 max-w-2xl mx-auto">
        Join our welcoming community and watch your child thrive. Start the enrollment process today or contact us to
        learn more.
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="/admissions"
          class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-yellow-400 text-gray-900 font-semibold hover:bg-yellow-300 transition w-full sm:w-auto">
          <!-- Arrow Right Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
          Enroll Your Child
        </a>

        <a href="/contact"
          class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl border border-white text-white font-semibold hover:bg-white/10 transition w-full sm:w-auto">
          <!-- Phone Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H7a14 14 0 006 6v-2a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
          Contact Us
        </a>
      </div>

      <!-- Info -->
      <p class="mt-8 text-white/70 text-sm">
        Open enrollment for 2025-2026 school year. Limited spots available.
      </p>

    </div>
  </section>


  @include('layouts.footer')

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const counters = document.querySelectorAll(".counter");

      counters.forEach(counter => {
        const target = +counter.dataset.target;
        let current = 0;
        const increment = Math.ceil(target / 120);

        const update = () => {
          current += increment;
          if (current < target) {
            counter.textContent = current;
            requestAnimationFrame(update);
          } else {
            counter.textContent = target;
          }
        };

        update();
      });
    });
  </script>

</body>

</html>