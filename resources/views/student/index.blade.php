@extends('student.layouts.sidebar')

@section('content')
<main class="flex-1 ml-64 p-8 bg-gray-50 min-h-screen">
    <div class="space-y-6 max-w-7xl mx-auto">
        
        {{-- Welcome Header --}}
        <div class="bg-gradient-to-r from-[#057E2E] to-[#046324] rounded-2xl p-8 text-white shadow-lg shadow-green-900/10">
            <h1 class="text-3xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-white/80 mt-1 font-medium">Here's what's happening with your academics today.</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($stats as $stat)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-gray-50 {{ $stat['text_color'] }}">
                        {!! $stat['icon'] !!}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ $stat['label'] }}</p>
                        <p class="text-2xl font-black text-gray-800">{{ $stat['value'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Quick Links --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($quickLinks as $link)
                    <a href="{{ route($link['route']) }}" class="flex items-center gap-3 p-4 rounded-xl bg-gray-50 hover:bg-green-50 hover:text-[#057E2E] transition-all group border border-transparent hover:border-green-100">
                        <div class="text-gray-400 group-hover:text-[#057E2E]">
                            {!! $link['icon'] !!}
                        </div>
                        <span class="font-bold text-gray-700 group-hover:text-[#057E2E]">{{ $link['label'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Announcements --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#057E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <h2 class="text-lg font-bold text-gray-800">Announcements</h2>
            </div>
            <div class="p-6 space-y-4">
                @forelse($announcements as $announcement)
                <div class="p-5 rounded-xl border border-gray-100 bg-white hover:border-green-100 hover:bg-green-50/30 transition-all">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-800">{{ $announcement->title }}</h3>
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded-md uppercase tracking-tight">
                            {{ $announcement->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $announcement->content }}</p>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 italic">No new announcements today.</div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection