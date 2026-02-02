<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enrollment - School Year 2024–2025</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <div class="w-64">
    @include('layouts.sidebar.registrar')
  </div>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-6 lg:p-8">
      <h1 class="text-3xl font-bold text-[#057E2E]">Enrollment</h1>
      <p class="text-gray-500">School Year 2024–2025</p>
    </header>

    <!-- Page Body -->
    <section class="p-6 space-y-8">

      <!-- Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="users" class="text-[#057E2E] w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Enrollees</p>
            <p class="text-2xl font-bold text-[#057E2E]">1,243</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="clock" class="text-[#057E2E] w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending</p>
            <p class="text-2xl font-bold text-[#057E2E]">187</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="check-circle" class="text-[#057E2E] w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Approved</p>
            <p class="text-2xl font-bold text-[#057E2E]">1,056</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-[#057E2E]/10">
            <i data-feather="file-text" class="text-[#057E2E] w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Incomplete</p>
            <p class="text-2xl font-bold text-[#057E2E]">156</p>
          </div>
        </div>

      </div>

      <!-- Tabs -->
      <div class="space-y-4">
        <div class="flex border-b">
          <button onclick="openTab('requests', this)" class="px-4 py-2 border-b-2 border-[#057E2E] text-[#057E2E] font-medium">
            Requests
          </button>
          <button onclick="openTab('new', this)" class="px-4 py-2 text-gray-500 font-medium">
            New Enrollment
          </button>
          <button onclick="openTab('history', this)" class="px-4 py-2 text-gray-500 font-medium">
            History
          </button>
        </div>

        <!-- Requests -->
        <div id="requests" class="tab-content">
          <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-4 border-b bg-gray-50">
              <h3 class="font-semibold text-[#057E2E]">Pending Requests</h3>
            </div>

            <table class="w-full text-sm">
              <thead class="bg-gray-100">
                <tr>
                  <th class="px-6 py-3 text-left">Student</th>
                  <th class="px-6 py-3 text-left">Grade</th>
                  <th class="px-6 py-3 text-left">Guardian</th>
                  <th class="px-6 py-3 text-left">Status</th>
                  <th class="px-6 py-3 text-left">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y">
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 font-medium">Maria Santos</td>
                  <td class="px-6 py-4">Grade 7</td>
                  <td class="px-6 py-4">Rosa Santos</td>
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded bg-[#057E2E]/10 text-[#057E2E]">Pending</span>
                  </td>
                  <td class="px-6 py-4 flex gap-2">
                    <button class="text-black" data-feather="eye"></button>
                    <button class="text-black" data-feather="check-circle"></button>
                    <button class="text-black" data-feather="x-circle"></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- New -->
        <div id="new" class="tab-content hidden bg-white rounded-xl shadow p-6">
          New enrollment form goes here
        </div>

        <!-- History -->
        <div id="history" class="tab-content hidden bg-white rounded-xl shadow p-6 text-gray-500">
          Historical enrollment data
        </div>
      </div>

    </section>
  </main>

<script>
  function openTab(tabId, btn) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'))
    document.getElementById(tabId).classList.remove('hidden')

    btn.parentElement.querySelectorAll('button').forEach(b => {
      b.classList.remove('border-[#057E2E]', 'text-[#057E2E]')
      b.classList.add('text-gray-500')
    })

    btn.classList.add('border-[#057E2E]', 'text-[#057E2E]')
  }

  feather.replace()
</script>

</body>
</html>
