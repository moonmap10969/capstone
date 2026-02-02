<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@0.244.0/dist/lucide.min.js"></script>
</head>
<body class="bg-gray-50 flex min-h-screen">

  <!-- Sidebar -->
  <div class="w-64">
    @include('layouts.sidebar.registrar')
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-6">

    <!-- Page Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold">Student Records</h1>
      <p class="text-gray-500">Manage student information</p>
    </div>

    <!-- Actions Bar -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
      <div class="relative flex-1">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7 7 0 1110 3a7 7 0 016.65 13.65z"/></svg>
        <input type="text" placeholder="Search by name or LRN..." class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
      </div>
      <div class="flex gap-3">
        <!-- Grade Filter -->
        <div class="relative w-[160px]">
          <select class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-3 appearance-none focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <option value="all" selected>All Grades</option>
            <option value="Grade 7">Grade 7</option>
            <option value="Grade 8">Grade 8</option>
            <option value="Grade 9">Grade 9</option>
            <option value="Grade 10">Grade 10</option>
            <option value="Grade 11">Grade 11</option>
            <option value="Grade 12">Grade 12</option>
          </select>
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
        <button class="flex items-center gap-2 px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 8l4 4m0 0l-4 4m4-4H8"/></svg>
          Export
        </button>
        <button class="flex items-center gap-2 px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Add Student
        </button>
      </div>
    </div>

    <!-- Students Table -->
    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold">Student</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">LRN</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Grade & Section</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Contact</th>
            <th class="px-6 py-3 text-left text-sm font-semibold w-[80px]">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <!-- Example Row -->
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 flex items-center gap-3">
              <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center font-medium text-green-700">MS</div>
              <div>
                <p class="font-medium">Maria Santos</p>
                <p class="text-sm text-gray-500">Female</p>
              </div>
            </td>
            <td class="px-6 py-4 font-mono text-sm">123456789012</td>
            <td class="px-6 py-4">
              <p class="font-medium">Grade 7</p>
              <p class="text-sm text-gray-500">Section A</p>
            </td>
            <td class="px-6 py-4">
              <span class="px-2 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700">Enrolled</span>
            </td>
            <td class="px-6 py-4 text-sm">09171234567</td>
            <td class="px-6 py-4">
              <div class="flex gap-1">
                <button class="p-1 hover:bg-gray-100 rounded">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </button>
                <button class="p-1 hover:bg-gray-100 rounded">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m2 0h2m-6 0h2v14h-2V5zm-4 0h2v14H5V5zm12 0h2v14h-2V5z"/>
                  </svg>
                </button>
                <button class="p-1 hover:bg-red-100 rounded text-red-600">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="flex items-center justify-between p-4 border-t border-gray-200">
        <p class="text-sm text-gray-500">Showing 1 of 8 students</p>
        <div class="flex gap-2">
          <button class="px-3 py-1 border border-gray-300 rounded text-gray-500" disabled>Previous</button>
          <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">Next</button>
        </div>
      </div>
    </div>

  </div>

  <script>
    lucide.replace()
  </script>

</body>
</html>
