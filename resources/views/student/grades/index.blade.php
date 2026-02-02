<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Grades</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

  @include('student.layouts.sidebar')

  <main class="flex-1 p-6 lg:p-12 space-y-8">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-3xl font-bold text-green-700">Report Card</h1>
        <p class="text-gray-500 mt-1">See your grades for each subject this semester</p>
      </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full">
      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Overall Average</p>
          <p class="text-3xl font-bold text-green-700 mt-1">91%</p>
        </div>
        <!-- Chart Icon -->
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 3v18h18"/>
            <path d="M7 16v-6"/>
            <path d="M12 16v-10"/>
            <path d="M17 16v-4"/>
          </svg>
        </div>
      </div>

      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Subjects Taken</p>
          <p class="text-3xl font-bold text-green-700 mt-1">6</p>
        </div>
        <!-- Book Icon -->
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 4v16m-8-8h16"/>
          </svg>
        </div>
      </div>

      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Completed Units</p>
          <p class="text-3xl font-bold text-green-700 mt-1">20</p>
        </div>
        <!-- Check Icon -->
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7"/>
          </svg>
        </div>
      </div>

      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Awards</p>
          <p class="text-3xl font-bold text-green-700 mt-1">2</p>
        </div>
        <!-- Trophy Icon -->
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M8 21h8M12 3v4"/>
            <path d="M5 8h14v2a7 7 0 01-14 0V8z"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Grades Grid -->
      <div class="lg:col-span-2 space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-semibold text-green-700">Subjects & Grades</h2>
          <span class="px-2 py-1 bg-green-100 text-green-700 rounded">6 Subjects</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Example Grade Cards -->
          <div class="bg-white shadow rounded-xl p-4 flex flex-col">
            <div class="flex justify-between items-center">
              <h3 class="font-semibold">Mathematics</h3>
              <span class="text-green-700 font-bold">A</span>
            </div>
            <p class="text-sm text-gray-500">85%</p>
          </div>

          <div class="bg-white shadow rounded-xl p-4 flex flex-col">
            <div class="flex justify-between items-center">
              <h3 class="font-semibold">Science</h3>
              <span class="text-green-700 font-bold">B+</span>
            </div>
            <p class="text-sm text-gray-500">88%</p>
          </div>

          <div class="bg-white shadow rounded-xl p-4 flex flex-col">
            <div class="flex justify-between items-center">
              <h3 class="font-semibold">English</h3>
              <span class="text-green-700 font-bold">A-</span>
            </div>
            <p class="text-sm text-gray-500">90%</p>
          </div>

          <div class="bg-white shadow rounded-xl p-4 flex flex-col">
            <div class="flex justify-between items-center">
              <h3 class="font-semibold">Filipino</h3>
              <span class="text-green-700 font-bold">A</span>
            </div>
            <p class="text-sm text-gray-500">92%</p>
          </div>

          <div class="bg-white shadow rounded-xl p-4 flex flex-col">
            <div class="flex justify-between items-center">
              <h3 class="font-semibold">Araling Panlipunan</h3>
              <span class="text-green-700 font-bold">B+</span>
            </div>
            <p class="text-sm text-gray-500">87%</p>
          </div>

          <div class="bg-white shadow rounded-xl p-4 flex flex-col">
            <div class="flex justify-between items-center">
              <h3 class="font-semibold">PE/Health</h3>
              <span class="text-green-700 font-bold">A</span>
            </div>
            <p class="text-sm text-gray-500">95%</p>
          </div>
        </div>
      </div>

      <!-- Side Panel -->
      <div class="space-y-6">

        <!-- Academic Standing -->
        <div class="bg-green-700 text-white shadow rounded-xl p-6">
          <h3 class="font-semibold text-lg">Academic Standing</h3>
          <p class="text-sm mt-2">Based on overall average</p>
          <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 rounded">Honor Roll</span>
          <p class="text-sm mt-2 opacity-80">
            Congratulations! You are on the Honor Roll for excellent performance.
          </p>
        </div>

        <!-- Grade Distribution -->
        <div class="bg-white shadow rounded-xl p-4">
          <h3 class="text-lg font-semibold text-green-700 mb-3">Grade Distribution</h3>
          <div class="space-y-2">
            <div class="flex items-center gap-3">
              <span class="w-8 font-semibold text-sm">A</span>
              <div class="flex-1 h-4 bg-gray-300 rounded-full overflow-hidden">
                <div class="h-full bg-green-700 rounded-full w-48"></div>
              </div>
              <span class="w-6 text-sm text-gray-500 text-right">3</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-8 font-semibold text-sm">A-</span>
              <div class="flex-1 h-4 bg-gray-300 rounded-full overflow-hidden">
                <div class="h-full bg-green-700 rounded-full w-24"></div>
              </div>
              <span class="w-6 text-sm text-gray-500 text-right">1</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-8 font-semibold text-sm">B+</span>
              <div class="flex-1 h-4 bg-gray-300 rounded-full overflow-hidden">
                <div class="h-full bg-green-700 rounded-full w-16"></div>
              </div>
              <span class="w-6 text-sm text-gray-500 text-right">2</span>
            </div>
          </div>
        </div>

      </div>

    </div>

  </main>

</body>
</html>
