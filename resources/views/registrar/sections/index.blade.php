<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar | Section Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen flex bg-gray-100">

    @include('layouts.sidebar.registrar')

    <main class="flex-1 p-8 bg-gray-50 min-h-screen" 
          x-data="{ 
            showCreate: false, 
            showEdit: false,
            active: { id: '', name: '', section_id: '', capacity: '', year_level: '' },
            openEdit(data) { 
                this.active = JSON.parse(JSON.stringify(data)); 
                this.showEdit = true; 
            }
          }">
        
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Section Management</h1>
                    <p class="text-sm text-slate-500 font-medium">Monitor class sizes and occupancy levels.</p>
                </div>
                <button @click="showCreate = true" class="bg-green-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-green-800 transition-all">+ Add Section</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($sections as $section)
                @php 
                    $count = $section->enrollments_count ?? 0;
                    $max = $section->capacity ?? 1;
                    $percent = ($count / $max) * 100;
                    $isFull = $count >= $max;
                @endphp
                <div class="bg-white p-6 rounded-3xl border {{ $isFull ? 'border-red-200' : 'border-slate-200' }} shadow-sm group hover:shadow-md transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">
                            {{ str_replace(['kinder', 'grade'], ['Kinder ', 'Grade '], $section->year_level) }}
                        </span>
                        <div class="flex gap-1">
                            <button @click="openEdit({{ json_encode($section) }})" class="p-2 text-slate-400 hover:text-blue-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2.5"/></svg>
                            </button>
                            <form action="{{ route('registrar.sections.destroy', $section->section_id) }}" method="POST" onsubmit="return confirm('Delete this section?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2.5"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-800">{{ $section->name }}</h3>
                    <p class="text-[10px] text-slate-400 font-black mb-4 uppercase">Code: {{ $section->section_id }}</p>

                    <div class="space-y-2 mt-4">
                        <div class="flex justify-between items-end">
                            <p class="text-[10px] font-black text-slate-500 uppercase">Occupancy</p>
                            <p class="text-xs font-black {{ $isFull ? 'text-red-600' : 'text-slate-800' }}">
                                {{ $count }} / {{ $max }}
                            </p>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="h-full transition-all duration-700 {{ $isFull ? 'bg-red-500' : 'bg-green-600' }}" 
                                 style="width: {{ min($percent, 100) }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CREATE MODAL --}}
        <div x-show="showCreate" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak x-transition>
            <div class="bg-white w-full max-w-md rounded-[2rem] p-10 shadow-2xl" @click.away="showCreate = false">
                <h2 class="text-2xl font-black text-slate-800 mb-6">Create Section</h2>
                <form action="{{ route('registrar.sections.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Section Name" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold outline-none focus:ring-2 focus:ring-green-500/20">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="section_id" placeholder="Code (e.g. SEC01)" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold outline-none">
                        <input type="number" name="capacity" placeholder="Capacity" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold outline-none">
                    </div>
                    <select name="year_level" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold uppercase text-xs outline-none">
                        <option value="">Select Level</option>
                        @foreach(['Kinder 1', 'Kinder 2', 'Kinder 3', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'] as $level)
                            <option value="{{ $level }}">{{ $level }}</option>
                        @endforeach
                    </select>
                    <div class="flex gap-3 pt-6">
                        <button type="button" @click="showCreate = false" class="flex-1 py-4 font-black uppercase text-[10px] text-slate-400">Cancel</button>
                        <button type="submit" class="flex-1 bg-green-700 text-white py-4 rounded-2xl font-black uppercase text-[10px] shadow-lg">Save Section</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div x-show="showEdit" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak x-transition>
            <div class="bg-white w-full max-w-md rounded-[2rem] p-10 shadow-2xl" @click.away="showEdit = false">
                <h2 class="text-2xl font-black text-slate-800 mb-6">Edit Section</h2>
                <form :action="'{{ url('registrar/sections') }}/' + active.section_id" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <input type="text" name="name" x-model="active.name" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold outline-none">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="section_id" x-model="active.section_id" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold outline-none">
                        <input type="number" name="capacity" x-model="active.capacity" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold outline-none">
                    </div>
                    <select name="year_level" x-model="active.year_level" required class="w-full bg-slate-50 border p-4 rounded-2xl font-bold uppercase text-xs outline-none">
                        @foreach(['Kinder 1', 'Kinder 2', 'Kinder 3', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'] as $level)
                            <option value="{{ $level }}">{{ $level }}</option>
                        @endforeach
                    </select>
                    <div class="flex gap-3 pt-6">
                        <button type="button" @click="showEdit = false" class="flex-1 py-4 font-black uppercase text-[10px] text-slate-400">Cancel</button>
                        <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-2xl font-black uppercase text-[10px] shadow-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>