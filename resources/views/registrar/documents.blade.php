<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Documents - SY 2024-2025</title>
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
      <h2 class="text-3xl font-bold text-green-700">Student Documents</h2>
      <p class="text-gray-500">School Year 2024-2025</p>
    </header>

    <!-- Main Content -->
    <main class="p-6 space-y-6">

      <!-- Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="file-text" class="w-6 h-6 text-[#057E2E]"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Submissions</p>
            <p class="text-2xl font-bold text-[#057E2E]">2,314</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="clock" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending Review</p>
            <p class="text-2xl font-bold text-green-700">342</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="check-circle" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Approved</p>
            <p class="text-2xl font-bold text-green-700">1,892</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="x-circle" class="w-6 h-6 text-green-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Rejected</p>
            <p class="text-2xl font-bold text-green-700">80</p>
          </div>
        </div>
      </div>

      <!-- Grid Layout -->
      <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Documents Table -->
        <div class="xl:col-span-2 bg-white rounded-xl shadow border overflow-hidden">
          <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
            <div>
              <h3 class="font-semibold text-[#057E2E]">Submitted Documents</h3>
              <p class="text-sm text-gray-500">Review and verify student requirements</p>
            </div>
            <input
              type="text"
              placeholder="Search student..."
              class="border rounded-lg px-3 py-2 text-sm"
            />
          </div>

          <table class="min-w-full divide-y">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Student</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Grade</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Document</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Submitted</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
              </tr>
            </thead>

            <tbody class="divide-y">
                <tr class="hover:bg-green-700/5">
                  <td class="px-6 py-4 font-medium text-green-700">
                    Juan Dela Cruz
                  </td>
              
                  <td class="px-6 py-4">
                    Grade 10
                  </td>
              
                  <td class="px-6 py-4">
                    Report Card
                  </td>
              
                  <td class="px-6 py-4 text-sm text-gray-500">
                    Jan 12, 2025
                  </td>
              
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700 font-medium">
                      Pending
                    </span>
                  </td>
              
                  <td class="px-6 py-4 flex gap-2">
                    <button class="p-1 rounded hover:bg-green-700/10 text-gray-700">
                      <i data-feather="eye"></i>
                    </button>
              
                    <button class="p-1 rounded hover:bg-green-700/10 text-gray-700">
                      <i data-feather="check-circle"></i>
                    </button>
              
                    <button class="p-1 rounded hover:bg-green-700/10 text-gray-700">
                      <i data-feather="x-circle"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
                        </table>
        </div>

        <!-- Required Documents -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
          <div class="p-4 border-b">
            <h3 class="font-semibold text-green-700">Required Documents</h3>
          </div>

          <div class="p-4 space-y-3">
            <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-green-50">
              <div class="flex items-center gap-3">
                <i data-feather="file-text" class="w-5 h-5 text-green-700"></i>
                <span class="text-sm font-medium">Birth Certificate</span>
              </div>
              <span class="text-xs px-2 py-1 rounded border border-green-700 text-green-700">Required</span>
            </div>

            <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-green-50">
              <div class="flex items-center gap-3">
                <i data-feather="file-text" class="w-5 h-5 text-green-700"></i>
                <span class="text-sm font-medium">Report Card</span>
              </div>
              <span class="text-xs px-2 py-1 rounded border border-green-700 text-green-700">Required</span>
            </div>

            <div class="pt-4 border-t">
              <button class="w-full flex items-center justify-center gap-2 px-4 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-50">
                <i data-feather="upload" class="w-4 h-4"></i>
                Upload Document
              </button>
            </div>
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
