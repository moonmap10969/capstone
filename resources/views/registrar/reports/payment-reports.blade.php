<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Reports - SY 2024-2025</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <div class="w-64">
    @include('layouts.sidebar.registrar')
  </div>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-6 lg:p-8 flex justify-between items-center">
      <div>
        <h2 class="text-3xl font-bold text-green-700">Payment Reports</h2>
        <p class="text-gray-500">School Year 2024-2025</p>
      </div>
    </header>

    <main class="p-6 space-y-6">

      <!-- Payment Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="dollar-sign" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Payments</p>
            <p class="text-2xl font-bold text-green-700">₱5,432,000</p>
            <p class="text-sm text-gray-500">All students</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="check-circle" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Paid in Full</p>
            <p class="text-2xl font-bold text-green-700">1,056</p>
            <p class="text-sm text-gray-500">Complete payments</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="clock" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending</p>
            <p class="text-2xl font-bold text-green-700">187</p>
            <p class="text-sm text-gray-500">Awaiting confirmation</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="alert-circle" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Overdue</p>
            <p class="text-2xl font-bold text-green-700">45</p>
            <p class="text-sm text-gray-500">Needs follow-up</p>
          </div>
        </div>

      </div>

      <!-- Payment Table -->
      <div class="bg-white rounded-xl shadow border overflow-hidden">
        <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
          <div>
            <h3 class="font-semibold text-green-700">Payment Details</h3>
            <p class="text-sm text-gray-500">Student payments for the current school year</p>
          </div>
          <input type="text" placeholder="Search student..." class="border rounded-lg px-3 py-2 text-sm"/>
        </div>

        <table class="min-w-full divide-y">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold">Student</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Grade</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Amount Paid</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Balance</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
            </tr>
          </thead>

          <tbody class="divide-y">
            <tr class="hover:bg-green-700/5">
              <td class="px-6 py-4 font-medium text-green-700">Juan Dela Cruz</td>
              <td class="px-6 py-4">Grade 10</td>
              <td class="px-6 py-4">₱12,000</td>
              <td class="px-6 py-4">₱0</td>
              <td class="px-6 py-4">
                <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700 font-medium">Paid</span>
              </td>
              <td class="px-6 py-4 flex gap-2">
                <button class="p-1 rounded hover:bg-green-700/10 text-black">
                  <i data-feather="eye"></i>
                </button>
                <button class="p-1 rounded hover:bg-green-700/10 text-black">
                  <i data-feather="download"></i>
                </button>
              </td>
            </tr>

            <tr class="hover:bg-green-700/5">
              <td class="px-6 py-4 font-medium text-green-700">Maria Santos</td>
              <td class="px-6 py-4">Grade 7</td>
              <td class="px-6 py-4">₱5,000</td>
              <td class="px-6 py-4">₱7,000</td>
              <td class="px-6 py-4">
                <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700 font-medium">Partial</span>
              </td>
              <td class="px-6 py-4 flex gap-2">
                <button class="p-1 rounded hover:bg-green-700/10 text-black">
                  <i data-feather="eye"></i>
                </button>
                <button class="p-1 rounded hover:bg-green-700/10 text-black">
                  <i data-feather="download"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </main>
  </div>

  <script>
    feather.replace();
  </script>
</body>
</html>
