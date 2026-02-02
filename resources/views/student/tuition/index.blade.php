<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Tuition Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

  @include('student.layouts.sidebar')

  <main class="flex-1 px-6 py-10 lg:px-12 space-y-12">

    <!-- Header -->
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Tuitions</h1>
      <p class="text-gray-500 mt-1">View and manage your tuition fees and payment history</p>
    </div>

    <!-- Payment Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
      <!-- Total Tuition -->
      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Total Tuition</p>
          <p class="text-2xl font-bold text-green-700">₱65,200</p>
        </div>
        <div class="h-12 w-12 rounded-xl bg-green-100 flex items-center justify-center">
          <span class="text-green-700 font-bold text-lg">₱</span>
        </div>
      </div>

      <!-- Total Paid -->
      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Total Paid</p>
          <p class="text-2xl font-bold text-green-700">₱63,200</p>
        </div>
        <div class="h-12 w-12 rounded-xl bg-green-100 flex items-center justify-center">
          <span class="text-green-700 font-bold text-lg">✓</span>
        </div>
      </div>

      <!-- Remaining Balance -->
      <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Remaining Balance</p>
          <p class="text-2xl font-bold text-green-700">₱2,000</p>
        </div>
        <div class="h-12 w-12 rounded-xl bg-green-100 flex items-center justify-center">
          <span class="text-green-700 font-bold text-lg">⚠</span>
        </div>
      </div>
    </div>

    <!-- Tuition Breakdown & Payment History -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full">

      <!-- Tuition Breakdown -->
      <div class="bg-white shadow rounded-xl w-full">
        <div class="p-6 border-b">
          <h2 class="text-lg font-semibold text-green-700">Fee Breakdown</h2>
        </div>
        <div class="p-6 space-y-2 w-full">
          <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Tuition Fee</span>
            <span class="font-medium">₱45,000</span>
          </div>
          <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Laboratory Fees</span>
            <span class="font-medium">₱8,500</span>
          </div>
          <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Miscellaneous Fees</span>
            <span class="font-medium">₱5,200</span>
          </div>
          <div class="flex justify-between py-2 border-b">
            <span class="text-gray-500">Library Fee</span>
            <span class="font-medium">₱1,500</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-gray-500">Technology Fee</span>
            <span class="font-medium">₱3,000</span>
          </div>
          <div class="flex justify-between pt-4 border-t-2">
            <span class="font-semibold text-green-700">Total</span>
            <span class="font-bold text-lg text-green-700">₱65,200</span>
          </div>

          <!-- Payment Progress -->
          <div class="pt-4 w-full">
            <div class="flex justify-between mb-2">
              <span class="text-sm text-gray-500">Payment Progress</span>
              <span class="text-sm font-medium text-green-700">97%</span>
            </div>
            <div class="w-full bg-gray-200 h-3 rounded-full">
              <div class="bg-green-700 h-3 rounded-full" style="width: 97%;"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Payment History -->
      <div class="bg-white shadow rounded-xl w-full">
        <div class="p-6 flex items-center justify-between border-b">
          <h2 class="text-lg font-semibold text-green-700">Payment History</h2>
          <button class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 text-sm">
            Submit Payment
          </button>
        </div>
        <div class="p-6 space-y-4 w-full">
          <div class="flex items-center justify-between p-4 rounded-lg bg-green-100 w-full">
            <div class="flex items-center gap-3">
              <div class="h-10 w-10 rounded-full bg-green-200 flex items-center justify-center">
                <span class="text-green-700 font-bold">₱</span>
              </div>
              <div>
                <p class="font-medium text-green-700">₱25,000</p>
                <p class="text-xs text-gray-500">Bank Transfer • TXN-2026-0110</p>
              </div>
            </div>
            <div class="text-right">
              <span class="bg-green-200 text-green-700 text-xs px-2 py-0.5 rounded-full">Paid</span>
              <p class="text-xs text-gray-500 mt-1">Jan 10, 2026</p>
            </div>
          </div>
          <div class="flex items-center justify-between p-4 rounded-lg bg-green-100 w-full">
            <div class="flex items-center gap-3">
              <div class="h-10 w-10 rounded-full bg-green-200 flex items-center justify-center">
                <span class="text-green-700 font-bold">₱</span>
              </div>
              <div>
                <p class="font-medium text-green-700">₱20,000</p>
                <p class="text-xs text-gray-500">GCash • TXN-2025-1215</p>
              </div>
            </div>
            <div class="text-right">
              <span class="bg-green-200 text-green-700 text-xs px-2 py-0.5 rounded-full">Paid</span>
              <p class="text-xs text-gray-500 mt-1">Dec 15, 2025</p>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Outstanding Balance -->
<div class="w-full">
    <div class="bg-green-700 text-white shadow rounded-xl p-6 flex flex-col md:flex-row items-center justify-between w-full">
      <div class="mb-4 md:mb-0">
        <h3 class="font-semibold text-lg">Outstanding Balance</h3>
        <p class="text-sm opacity-80">Due date: February 15, 2026</p>
      </div>
      <div class="flex items-center gap-4">
        <p class="text-2xl font-bold">₱2,000</p>
        <button class="bg-white text-green-700 px-4 py-2 rounded hover:bg-gray-100">Pay Now</button>
      </div>
    </div>
  </div>
  

  </main>
</body>
</html>
