<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar | Tuition Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-100 min-h-screen flex overflow-hidden">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md h-screen flex-shrink-0 overflow-y-auto">
    @include('layouts.sidebar.registrar')
  </aside>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col overflow-y-auto">

    <!-- Header -->
    <header class="bg-white shadow p-6 lg:p-8 flex-shrink-0">
      <h1 class="text-3xl font-bold text-green-700">Tuition Records</h1>
      <p class="text-gray-500">School Year 2024–2025</p>
    </header>

    <!-- Page Body -->
    <section class="p-6 space-y-8 flex-1">

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="clock" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending</p>
            <p class="text-2xl font-bold text-green-700">{{ $totalPending }}</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="dollar-sign" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Partial Payments</p>
            <p class="text-2xl font-bold text-green-700">{{ $paymentsPartial }}</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="check-circle" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Completed Payments</p>
            <p class="text-2xl font-bold text-green-700">{{ $paymentsCompleted }}</p>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
          <div class="p-3 rounded-full bg-green-700/10">
            <i data-feather="users" class="text-green-700 w-6 h-6"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Students</p>
            <p class="text-2xl font-bold text-green-700">{{ $totalStudents }}</p>
          </div>
        </div>

      </div>

      <!-- Tabs -->
      <div class="space-y-4">
        <div class="flex border-b">
          <button onclick="openTab('all', this)" class="px-4 py-2 border-b-2 border-green-700 text-green-700 font-medium">All Tuitions</button>
          <button onclick="openTab('paid', this)" class="px-4 py-2 text-gray-500 font-medium">Fully Paid</button>
          <button onclick="openTab('balance', this)" class="px-4 py-2 text-gray-500 font-medium">With Balance</button>
        </div>

        <!-- All Tuitions -->
        <div id="all" class="tab-content">
          <div class="bg-white rounded-xl shadow overflow-auto">
            <table class="w-full text-sm min-w-[700px]">
              <thead class="bg-green-700 text-white">
                <tr>
                  <th class="px-6 py-3 text-left">ID</th>
                  <th class="px-6 py-3 text-left">Student Number</th>
                  <th class="px-6 py-3 text-left">Student</th>
                  <th class="px-6 py-3 text-left">Amount</th>
                  <th class="px-6 py-3 text-left">Status</th>
                  <th class="px-6 py-3 text-left">Payment Type</th>
                  <th class="px-6 py-3 text-left">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y">
                @forelse($tuitions as $tuition)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 font-medium">{{ $tuition->id }}</td>
                  <td class="px-6 py-4 font-medium">{{ $tuition->studentNumber }}</td>
                  <td class="px-6 py-4 font-medium">{{ $tuition->name }}</td>
                  <td class="px-6 py-4">₱{{ number_format($tuition->amount,2) }}</td>
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded 
                      {{ $tuition->status == 'approved' ? 'bg-green-200 text-green-800' : ($tuition->status=='pending' ? 'bg-yellow-200 text-yellow-800':'bg-red-200 text-red-800') }}">
                      {{ ucfirst($tuition->status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">{{ ucfirst($tuition->payment_type) }}</td>
                  <td class="px-6 py-4 flex gap-2">

                    <!-- Edit Button -->
                    <button class="editBtn bg-yellow-500 p-2 rounded hover:bg-yellow-600" 
                      data-id="{{ $tuition->id }}"
                      data-studentNumber="{{ $tuition->studentNumber }}"
                      data-name="{{ $tuition->name }}"
                      data-amount="{{ $tuition->amount }}"
                      data-reference_number="{{ $tuition->reference_number }}"
                      data-payment_method="{{ $tuition->payment_method }}"
                      data-status="{{ $tuition->status }}"
                      data-payment_type="{{ $tuition->payment_type }}">
                      <i data-feather="edit" class="text-white w-4 h-4"></i>
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('registrar.tuitions.destroy', $tuition->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                      @csrf
                      @method('DELETE')
                      <button class="bg-red-600 p-2 rounded hover:bg-red-700">
                        <i data-feather="trash-2" class="text-white w-4 h-4"></i>
                      </button>
                    </form>

                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="px-6 py-4 text-center text-gray-500">No records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            {{ $tuitions->links() }}
          </div>
        </div>

        <!-- Fully Paid -->
        <div id="paid" class="tab-content hidden bg-white rounded-xl shadow overflow-auto">
          <table class="w-full text-sm min-w-[500px]">
            <thead class="bg-green-700 text-white">
              <tr>
                <th class="px-6 py-3 text-left">Student</th>
                <th class="px-6 py-3 text-left">Amount</th>
                <th class="px-6 py-3 text-left">Payment Type</th>
              </tr>
            </thead>
            <tbody class="divide-y">
              @forelse($fullyPaid as $student)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $student->name }}</td>
                <td class="px-6 py-4">₱{{ number_format($student->amount,2) }}</td>
                <td class="px-6 py-4">{{ ucfirst($student->payment_type) }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No fully paid students</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- With Balance -->
        <div id="balance" class="tab-content hidden bg-white rounded-xl shadow overflow-auto">
          <table class="w-full text-sm min-w-[500px]">
            <thead class="bg-green-700 text-white">
              <tr>
                <th class="px-6 py-3 text-left">Student</th>
                <th class="px-6 py-3 text-left">Amount Paid</th>
                <th class="px-6 py-3 text-left">Remaining Balance</th>
                <th class="px-6 py-3 text-left">Payment Type</th>
              </tr>
            </thead>
            <tbody class="divide-y">
              @forelse($withBalance as $student)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $student->name }}</td>
                <td class="px-6 py-4">₱{{ number_format($student->amount,2) }}</td>
                <td class="px-6 py-4">₱{{ number_format($student->balance,2) }}</td>
                <td class="px-6 py-4">{{ ucfirst($student->payment_type) }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No students with balance</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </section>
  </main>

  <!-- Edit Modal -->
  @include('registrar.tuitions.edit')

<script>
function openTab(tabId, btn) {
  document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'))
  document.getElementById(tabId).classList.remove('hidden')

  btn.parentElement.querySelectorAll('button').forEach(b => {
    b.classList.remove('border-green-700','text-green-700')
    b.classList.add('text-gray-500')
  })

  btn.classList.add('border-green-700','text-green-700')
}

// Edit Button Functionality
document.querySelectorAll('.editBtn').forEach(btn => {
  btn.addEventListener('click', () => {
    const form = document.getElementById('editForm');
    form.action = `/registrar/tuitions/${btn.dataset.id}`;
    document.getElementById('edit_studentNumber').value = btn.dataset.studentNumber;
    document.getElementById('edit_name').value = btn.dataset.name;
    document.getElementById('edit_amount').value = btn.dataset.amount;
    document.getElementById('edit_payment_method').value = btn.dataset.payment_method;
    document.getElementById('edit_status').value = btn.dataset.status;
    document.getElementById('edit_payment_type').value = btn.dataset.payment_type;
    document.getElementById('edit_reference_number').value = btn.dataset.reference_number || '';
    
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    setTimeout(() => modal.querySelector('div').classList.remove('scale-95','opacity-0'),10);
  })
})

feather.replace()
</script>

</body>
</html>

