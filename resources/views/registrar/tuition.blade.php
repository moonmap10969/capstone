<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuition Management - SY 2024-2025</title>
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
        <h2 class="text-3xl font-bold text-green-700">Tuition Management</h2>
        <p class="text-gray-500">School Year 2024-2025</p>
      </div>
    </header>

    <!-- Stats -->
    <main class="p-6 space-y-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="dollar-sign" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Tuition</p>
            <p class="text-2xl font-bold text-green-700">₱12,345,678</p>
            <p class="text-sm text-gray-500">All enrolled students</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="credit-card" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Paid</p>
            <p class="text-2xl font-bold text-green-700">₱10,234,500</p>
            <p class="text-sm text-gray-500">Completed transactions</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="alert-circle" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending</p>
            <p class="text-2xl font-bold text-green-700">₱2,111,178</p>
            <p class="text-sm text-gray-500">Awaiting payment</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-lg transition">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="file-text" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Invoices</p>
            <p class="text-2xl font-bold text-green-700">1,245</p>
            <p class="text-sm text-gray-500">Generated for all students</p>
          </div>
        </div>

      </div>

      <!-- Tabs -->
      <div class="space-y-4">
        <div class="flex border-b">
          <button onclick="openTab('payments', this)" class="px-4 py-2 font-medium border-b-2 border-green-700 text-green-700">
            Payment Records
          </button>
          <button onclick="openTab('new', this)" class="px-4 py-2 font-medium text-gray-500">
            New Payment
          </button>
          <button onclick="openTab('history', this)" class="px-4 py-2 font-medium text-gray-500">
            History
          </button>
        </div>

        <!-- Payment Records -->
        <div id="payments" class="tab-content space-y-6">
          <div class="bg-white rounded-xl shadow border overflow-hidden">
            <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
              <div>
                <h3 class="font-semibold text-green-700">All Payments</h3>
                <p class="text-sm text-gray-500">Track and verify student payments</p>
              </div>
              <input type="text" placeholder="Search student..." class="border rounded-lg px-3 py-2 text-sm"/>
            </div>

            <table class="min-w-full divide-y">
              <thead class="bg-gray-100">
                <tr>
                  <th class="px-6 py-3 text-left text-sm font-semibold">Student</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold">Grade</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold">Amount</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold">Date Paid</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                </tr>
              </thead>

              <tbody class="divide-y">
                <tr class="hover:bg-green-700/5">
                  <td class="px-6 py-4 font-medium text-green-700">Juan Dela Cruz</td>
                  <td class="px-6 py-4">Grade 10</td>
                  <td class="px-6 py-4">₱12,000</td>
                  <td class="px-6 py-4 text-sm text-gray-500">Jan 12, 2025</td>
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700 font-medium">Paid</span>
                  </td>
                  <td class="px-6 py-4 flex gap-2">
                    <button class="p-1 rounded hover:bg-green-700/10 text-green-700">
                      <i data-feather="eye"></i>
                    </button>
                    <button class="p-1 rounded hover:bg-green-700/10 text-green-700">
                      <i data-feather="edit"></i>
                    </button>
                    <button class="p-1 rounded hover:bg-green-700/10 text-green-700">
                      <i data-feather="trash-2"></i>
                    </button>
                  </td>
                </tr>

                <tr class="hover:bg-green-700/5">
                  <td class="px-6 py-4 font-medium text-green-700">Maria Santos</td>
                  <td class="px-6 py-4">Grade 7</td>
                  <td class="px-6 py-4">₱10,500</td>
                  <td class="px-6 py-4 text-sm text-gray-500">Jan 10, 2025</td>
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded bg-green-700/10 text-green-700 font-medium">Pending</span>
                  </td>
                  <td class="px-6 py-4 flex gap-2">
                    <button class="p-1 rounded hover:bg-green-700/10 text-green-700">
                      <i data-feather="eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- New Payment -->
        <div id="new" class="tab-content hidden space-y-6">
          <div class="bg-white rounded-xl shadow border p-6 space-y-6">
            <h3 class="font-semibold text-lg flex items-center gap-2">
              <i data-feather="plus-circle" class="w-5 h-5"></i> Record New Payment
            </h3>
            <p class="text-sm text-gray-500">Fill out the form below to record a payment</p>

            <form class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                  <label for="student" class="block text-sm font-medium text-gray-700">Student</label>
                  <input id="student" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Student name"/>
                </div>
                <div class="space-y-2">
                  <label for="grade" class="block text-sm font-medium text-gray-700">Grade Level</label>
                  <select id="grade" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    <option>Grade 7</option>
                    <option>Grade 8</option>
                    <option>Grade 9</option>
                    <option>Grade 10</option>
                    <option>Grade 11</option>
                    <option>Grade 12</option>
                  </select>
                </div>
                <div class="space-y-2">
                  <label for="amount" class="block text-sm font-medium text-gray-700">Amount Paid</label>
                  <input id="amount" type="number" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="₱"/>
                </div>
              </div>

              <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button" class="px-4 py-2 border rounded-lg text-gray-700">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg flex items-center gap-2 hover:bg-green-800">
                  <i data-feather="plus-circle" class="w-4 h-4"></i> Submit Payment
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- History -->
        <div id="history" class="tab-content hidden">
          <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">
            Historical payment data will appear here
          </div>
        </div>

      </div>
    </main>
  </div>

  <script>
    function openTab(tabId, btn) {
      document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
      document.getElementById(tabId).classList.remove('hidden');

      btn.parentElement.querySelectorAll('button').forEach(b => {
        b.classList.remove('border-green-700', 'text-green-700');
        b.classList.add('text-gray-500');
      });

      btn.classList.add('border-green-700', 'text-green-700');
      btn.classList.remove('text-gray-500');
    }

    feather.replace();
  </script>

</body>
</html>
