@if(session('success'))
<div class="fixed inset-0 bg-gray-900/50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-3xl shadow-2xl max-w-sm text-center">
        <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">✓</div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Documents Submitted!</h2>
        <p class="text-gray-600 mb-6">Your requirements are now in the **verification stage**. Please check your email for your student number to access the portal.</p>
        <button onclick="this.parentElement.parentElement.remove()" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl">Understood</button>
    </div>
</div>
@endif