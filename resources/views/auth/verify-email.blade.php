<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | FUMCESS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6" x-data="{ 
    timer: 0, 
    startTimer() { 
        this.timer = 60; 
        let interval = setInterval(() => { 
            this.timer--; 
            if (this.timer <= 0) clearInterval(interval); 
        }, 1000); 
    } 
}">

    <div class="max-w-2xl w-full space-y-6">
        
        <div class="flex justify-between items-center px-2">
            <a href="/" class="flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-green-600 transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Home
            </a>
            <div class="text-right">
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest leading-none">FUMCESS Portal</p>
                <p class="text-[10px] font-bold text-green-600 uppercase tracking-tighter">Security Module</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="bg-gray-100 px-8 py-5 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg leading-tight">Email Verification Required</h3>
                    <p class="text-xs text-gray-500 font-medium">Step 2 of Account Activation</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>

            <div class="p-10 space-y-8">
                
                @if (session('status') == 'verification-link-sent')
                    <div class="bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4">
                        <div class="bg-green-600 rounded-full p-1 shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="text-sm font-bold">Success! A fresh verification link has been delivered to your email address.</p>
                    </div>
                @endif

                <div class="space-y-4">
                    <p class="text-gray-600 leading-relaxed font-medium">
                        Thanks for joining the FUMCESS community! Before you can access the Registrar dashboard, please confirm your email address by clicking on the link we just sent you. 
                    </p>
                    <p class="text-sm text-gray-500 italic">
                        If you haven't received it after 5 minutes, please check your spam folder or request a new link below.
                    </p>
                </div>

                <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center gap-4">
                    <form method="POST" action="{{ route('verification.send') }}" @submit="startTimer()" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" 
                            :disabled="timer > 0"
                            :class="timer > 0 ? 'bg-gray-200 cursor-not-allowed text-gray-500' : 'bg-green-600 hover:bg-green-700 text-white shadow-lg shadow-green-100'"
                            class="w-full flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-bold transition-all text-sm uppercase tracking-widest">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <template x-if="timer === 0"><span>Resend Link</span></template>
                            <template x-if="timer > 0"><span>Retry in <span x-text="timer"></span>s</span></template>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full px-8 py-4 border border-gray-300 rounded-xl font-bold text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all text-sm uppercase tracking-widest">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center">
                    &copy; 2026 FUMCESS Institutional Management System
                </p>
            </div>
        </div>
    </div>

</body>
</html>