<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Retention Analytics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .bg-gold { background-color: #D4AF37; }
        .text-gold { color: #D4AF37; }
        .border-gold { border-color: #D4AF37; }
    </style>
</head>
<body class="min-h-screen flex bg-[#FCFDFB] font-sans" x-data="{ showEditor: false }">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-[1400px] mx-auto space-y-8">
            
            {{-- Header Navigation --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <a href="{{ route('registrar.enrollment.index') }}" class="p-3 bg-white border border-green-100 rounded-2xl text-green-700 hover:bg-green-50 transition-all shadow-sm">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-black text-green-900 tracking-tight uppercase">Retention Analytics</h1>
                        <p class="text-sm text-green-700/60 font-bold tracking-wide uppercase">Strategic Enrollment Management • {{ $currentYear->year_range }}</p>
                    </div>
                </div>
                
                <button @click="showEditor = !showEditor" class="flex items-center gap-2 px-5 py-2.5 rounded-xl border-2 border-yellow-500 text-yellow-600 font-black text-[10px] uppercase tracking-widest hover:bg-yellow-50 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2.5"/></svg>
                    <span x-text="showEditor ? 'Hide Template' : 'Edit SMS Template'"></span>
                </button>
            </div>

            {{-- Proactive Alert System Card --}}
            <form action="{{ route('registrar.enrollment.send_alerts') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white rounded-[2rem] border-2 border-green-50 shadow-2xl shadow-green-900/5 overflow-hidden">
                    
                    {{-- SMS Template Editor Section --}}
                    <div x-show="showEditor" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" class="p-8 bg-green-50/50 border-b-2 border-green-50">
                        <div class="max-w-3xl">
                            <label class="block text-[11px] font-black text-green-800 uppercase tracking-[0.2em] mb-3">Communication Template</label>
                            <textarea name="custom_message" rows="3" 
                                class="w-full bg-white border-2 border-green-100 rounded-2xl p-6 text-sm font-bold text-green-900 outline-none focus:border-yellow-500 transition-all shadow-inner"
                            >Hi [Student Name]! This is FUMCES. We noticed you haven't registered for SY {{ $currentYear->year_range }} yet. Secure your slot now!</textarea>
                            <p class="mt-3 text-[10px] text-yellow-600 font-black uppercase tracking-widest leading-relaxed">
                                <span class="bg-yellow-100 px-1.5 py-0.5 rounded">Note:</span> [Student Name] will be dynamically replaced for each recipient.
                            </p>
                        </div>
                    </div>

                    {{-- Main Action Banner --}}
                   <div class="p-10 flex flex-col lg:flex-row justify-between items-center gap-10">
    <div class="flex items-start gap-6">
        <div class="p-5 bg-yellow-400 rounded-3xl shadow-xl shadow-yellow-400/20 text-white shrink-0">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z" stroke-width="2.5"/></svg>
        </div>
        <div>
            <h2 class="text-2xl font-black text-green-900 leading-none uppercase tracking-tight">Predictive Stop-out Detection</h2>
            <p class="text-green-700/60 font-medium text-lg mt-3 max-w-lg leading-relaxed">
                The ML model has flagged <span class="text-green-900 font-black underline decoration-yellow-400 decoration-4 underline-offset-4">{{ $atRiskStudents->count() }} students</span> with a high risk of not returning for the next term.
            </p>
        </div>
    </div>

    <button type="submit" class="w-full lg:w-auto bg-green-700 text-white px-10 py-5 rounded-2xl font-black shadow-2xl shadow-green-900/20 hover:bg-green-800 hover:-translate-y-1 transition-all flex items-center justify-center gap-4 active:scale-95">
        <span class="text-sm uppercase tracking-[0.2em]">Launch Alert Campaign</span>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2.5"/></svg>
    </button>
</div>

{{-- Data Table with ML Risk Score --}}
<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-green-50 text-[10px] font-black text-green-800 uppercase tracking-[0.3em] border-y-2 border-green-50">
            <tr>
                <th class="px-10 py-6">Student Information</th>
                <th class="px-10 py-6 text-center">Previous Level</th>
                <th class="px-10 py-6">ML Risk Score</th>
                <th class="px-10 py-6 text-right">Outreach Status</th>
            </tr>
        </thead>
        <tbody class="divide-y-2 divide-green-50">
            @forelse($atRiskStudents as $student)
            <tr class="hover:bg-green-50/20 transition-colors group">
                <td class="px-10 py-8">
                    <p class="font-black text-green-900 text-lg group-hover:text-green-700 transition-colors">{{ $student->studentFirstName }} {{ $student->studentLastName }}</p>
                    <p class="text-[11px] font-mono text-green-600/50 mt-1 uppercase font-bold">SN: {{ $student->studentNumber }}</p>
                </td>
                <td class="px-10 py-8 text-center">
                    <span class="px-4 py-2 bg-white border border-green-100 text-green-700 rounded-xl text-[10px] font-black uppercase tracking-widest">{{ $student->year_level }}</span>
                </td>
                <td class="px-10 py-8">
                    <div class="flex items-center gap-3">
                        <div class="w-32 h-2.5 bg-green-100 rounded-full overflow-hidden shadow-inner">
                            <div class="h-full {{ $student->risk_score > 0.7 ? 'bg-red-500' : 'bg-yellow-500' }} transition-all duration-1000" 
                                 style="width: {{ $student->risk_score * 100 }}%"></div>
                        </div>
                        <span class="text-xs font-black {{ $student->risk_score > 0.7 ? 'text-red-600' : 'text-yellow-600' }}">
                            {{ number_format($student->risk_score * 100, 0) }}%
                        </span>
                    </div>
                    <p class="text-[9px] font-bold text-green-800/40 uppercase tracking-tighter mt-1">Random Forest Prediction</p>
                </td>
                <td class="px-10 py-8 text-right">
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-white text-green-800 rounded-full text-[10px] font-black uppercase tracking-widest border-2 border-green-50">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                        Awaiting Return
                    </span>
                </td>
            </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-32 text-center">
                                        <div class="p-6 bg-green-50 inline-block rounded-full mb-6">
                                            <svg class="w-16 h-16 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5"/></svg>
                                        </div>
                                        <p class="text-green-800/40 font-black text-xs uppercase tracking-[0.3em]">Full Retention Achieved • No Stop-outs Found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

           <div class="mt-12 bg-white border border-gray-100 rounded-xl overflow-hidden">
    <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100">
        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email Outreach History</h3>
    </div>
    <table class="w-full text-left text-xs">
        <thead class="bg-gray-50/30">
            <tr class="text-gray-400 font-black uppercase tracking-tighter">
                <th class="px-6 py-3">Timestamp</th>
                <th class="px-6 py-3">Student ID</th>
                <th class="px-6 py-3">Recipient</th>
                <th class="px-6 py-3 text-right">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach(\DB::table('email_logs')->orderBy('created_at', 'desc')->take(10)->get() as $log)
            <tr>
                <td class="px-6 py-4 text-gray-400">{{ \Carbon\Carbon::parse($log->created_at)->format('M d, H:i') }}</td>
                <td class="px-6 py-4 font-semibold text-gray-700">{{ $log->studentNumber }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $log->recipient_email }}</td>
                <td class="px-6 py-4 text-right">
                    <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase {{ $log->status === 'sent' ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                        {{ $log->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </main>
    
    {{-- Success Notification --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-cloak class="fixed bottom-10 right-10 z-[100] bg-green-900 border-l-8 border-yellow-400 shadow-2xl rounded-2xl p-6 flex items-center gap-5 min-w-[380px]">
        <div class="bg-yellow-400 p-3 rounded-xl shadow-lg shadow-yellow-400/20">
            <svg class="w-6 h-6 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="4" stroke-linecap="round"/></svg>
        </div>
        <div>
            <p class="text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] mb-1">Campaign Success</p>
            <p class="text-sm font-bold text-white">{{ session('success') }}</p>
        </div>
    </div>
    @endif

</body>
</html>