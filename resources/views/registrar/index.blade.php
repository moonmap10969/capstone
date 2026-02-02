<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Dashboard - SY 2024-2025</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <div class="w-64">
    @include('layouts.sidebar.registrar')
  </div>

  <!-- Main Wrapper -->
  <div class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-6 lg:p-8">
      <h2 class="text-3xl font-bold text-green-700">Registrar Dashboard</h2>
      <p class="text-gray-500">School Year 2024–2025</p>
    </header>

    <!-- Main Content -->
    <main class="p-6 space-y-6">

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="users" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Students</p>
            <p class="text-2xl font-bold text-green-700">1,243</p>
            <p class="text-sm text-gray-500">Enrolled this year</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="user-check" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Approved Enrollments</p>
            <p class="text-2xl font-bold text-green-700">1,056</p>
            <p class="text-sm text-gray-500">Ready for sectioning</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="clock" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending Requests</p>
            <p class="text-2xl font-bold text-green-700">187</p>
            <p class="text-sm text-gray-500">For review</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="file-text" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Incomplete Documents</p>
            <p class="text-2xl font-bold text-green-700">156</p>
            <p class="text-sm text-gray-500">Needs follow up</p>
          </div>
        </div>

      </div>

      <!-- Grid -->
      <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Recent Enrollment Requests -->
        <div class="xl:col-span-2 bg-white rounded-xl shadow border overflow-hidden">
          <div class="p-4 border-b bg-gray-50">
            <h3 class="font-semibold text-green-700">Recent Enrollment Requests</h3>
            <p class="text-sm text-gray-500">Latest student applications</p>
          </div>

          <table class="min-w-full divide-y">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Student</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Grade</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Submitted</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y">
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">Maria Santos</td>
                <td class="px-6 py-4">Grade 7</td>
                <td class="px-6 py-4 text-sm text-gray-500">Jan 10, 2025</td>
                <td class="px-6 py-4">
                  <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700">Pending</span>
                </td>
              </tr>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">Juan Dela Cruz</td>
                <td class="px-6 py-4">Grade 10</td>
                <td class="px-6 py-4 text-sm text-gray-500">Jan 12, 2025</td>
                <td class="px-6 py-4">
                  <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700">Approved</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow border">
          <div class="p-4 border-b">
            <h3 class="font-semibold text-green-700">Quick Actions</h3>
          </div>

          <div class="p-4 space-y-3">
            <a href="#" class="flex items-center gap-3 p-3 border rounded-lg hover:bg-green-700/10">
              <i data-feather="user-plus" class="w-5 h-5 text-green-700"></i>
              <span class="text-sm font-medium">New Enrollment</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-3 border rounded-lg hover:bg-green-700/10">
              <i data-feather="file-text" class="w-5 h-5 text-green-700"></i>
              <span class="text-sm font-medium">Review Documents</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-3 border rounded-lg hover:bg-green-700/10">
              <i data-feather="layers" class="w-5 h-5 text-green-700"></i>
              <span class="text-sm font-medium">Manage Sections</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-3 border rounded-lg hover:bg-green-700/10">
              <i data-feather="bar-chart-2" class="w-5 h-5 text-green-700"></i>
              <span class="text-sm font-medium">View Reports</span>
            </a>
          </div>
        </div>

      </div>

    </main>
  </div>

  <script>
    feather.replace()
  </script>

</body>
</html>
