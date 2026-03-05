<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student | Document Repository</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-[#F8FAFC] flex font-sans">
    
    @include('student.layouts.sidebar')
    
    <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-8">
            
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 pb-6">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Document Repository</h1>
                    <p class="text-xs font-bold text-green-600 uppercase tracking-widest mt-1">Admission Requirements & Records</p>
                </div>
            </div>

            {{-- Error Notification --}}
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ session('error') }}
            </div>
            @endif

            {{-- Document Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($documents as $column => $data)
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col justify-between h-56 group hover:border-green-200 transition-all">
                    <div>
                        <div class="flex justify-between items-start">
                            <div class="w-12 h-12 rounded-2xl mb-4 flex items-center justify-center {{ $data['path'] ? 'bg-green-50 text-green-600' : 'bg-slate-50 text-slate-400' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            @if($data['path'])
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">Available</span>
                            @else
                                <span class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">Missing</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">{{ $data['title'] }}</h3>
                        <p class="text-[10px] font-medium text-slate-400 mt-1">Database Key: <span class="font-mono">{{ $column }}</span></p>
                    </div>
                    
                    <div class="mt-4">
                        @if($data['path'])
                        <a href="{{ route('student.documents.download', $column) }}" class="block w-full text-[10px] font-black text-white bg-green-700 hover:bg-green-800 py-3 rounded-xl uppercase tracking-widest text-center shadow-lg shadow-green-900/10 transition-all active:scale-95">
                            Download File
                        </a>
                        @else
                        <button disabled class="w-full text-[10px] font-black text-slate-400 bg-slate-50 py-3 rounded-xl uppercase tracking-widest text-center cursor-not-allowed border border-slate-100">
                            No File Submitted
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </main>
</body>
</html>