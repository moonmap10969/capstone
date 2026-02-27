<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Section Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50">

    @include('admin.layouts.sidebar')

    @php 
        $levelsMap = [
            'kinder1' => 'Kinder 1', 'kinder2' => 'Kinder 2', 'kinder3' => 'Kinder 3',
            'grade1' => 'Grade 1', 'grade2' => 'Grade 2', 'grade3' => 'Grade 3',
            'grade4' => 'Grade 4', 'grade5' => 'Grade 5', 'grade6' => 'Grade 6',
            'grade7' => 'Grade 7', 'grade8' => 'Grade 8', 'grade9' => 'Grade 9', 'grade10' => 'Grade 10'
        ];
    @endphp

    <main class="flex-1 p-8 bg-gray-50 min-h-screen" 
          x-data="{ 
            showCreate: false, 
            showEdit: false,
            filterLevel: 'all',
            active: { id: '', name: '', section_id: '', capacity: '', year_level: '', shift: '' },
            openEdit(data) { 
                this.active = JSON.parse(JSON.stringify(data)); 
                this.showEdit = true; 
            }
          }">
        
        <div class="max-w-6xl mx-auto">
            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Section Management</h1>
                    <p class="text-sm text-slate-500 font-medium">Manage and filter your school sections.</p>
                </div>
                
                <div class="flex items-center gap-3 w-full md:w-auto">
                    {{-- Dropdown Filter --}}
                    <div class="relative flex-1 md:w-64">
                        <select x-model="filterLevel" 
                                class="w-full bg-white border border-slate-200 px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-700 outline-none appearance-none cursor-pointer hover:border-green-500 transition-colors shadow-sm">
                            <option value="all">Show All Sections</option>
                            <optgroup label="Year Levels">
                                @foreach($levelsMap as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                        </div>
                    </div>

                    <button @click="showCreate = true" class="bg-green-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-green-800 transition-all uppercase tracking-widest whitespace-nowrap">+ Add</button>
                </div>
            </div>

            {{-- Grid View with Filter Logic --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($sections as $section)
                    <div x-show="filterLevel === 'all' || filterLevel === '{{ strtolower($section->year_level) }}'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm group hover:shadow-md transition-all relative">
                        
                        @php 
                            $count = $section->enrollments_count ?? 0;
                            $max = $section->capacity ?? 1;
                            $percent = ($count / $max) * 100;
                            $isFull = $count >= $max;
                        @endphp

                        <div class="flex justify-between items-start mb-4">
                            <div class="flex flex-col gap-1">
                                <span class="bg-green-50 text-green-700 text-[9px] font-black px-2 py-0.5 rounded-md uppercase w-fit">
                                    Section Code: {{ $section->section_id }}
                                </span>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                                    {{ $levelsMap[strtolower($section->year_level)] ?? $section->year_level }}
                                </span>
                            </div>
                            <div class="flex gap-1">
                                <button @click="openEdit({{ json_encode($section) }})" class="p-2 text-slate-300 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2.5"/></svg>
                                </button>
                                <form action="{{ route('admin.sections.destroy', $section->section_id) }}" method="POST" onsubmit="return confirm('Delete this section?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-300 hover:text-red-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2.5"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <h3 class="text-xl font-black text-slate-800 mb-1">{{ $section->name }}</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-6 tracking-widest">{{ $section->shift }}</p>

                        <div class="space-y-2">
                            <div class="flex justify-between items-end text-[10px] font-black uppercase">
                                <span class="text-slate-400">Occupancy</span>
                                <span class="{{ $isFull ? 'text-red-600' : 'text-slate-800' }}">{{ $count }} / {{ $max }}</span>
                            </div>
                            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                <div class="h-full transition-all duration-700 {{ $isFull ? 'bg-red-500' : 'bg-green-600' }}" 
                                     style="width: {{ min($percent, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                        <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">No sections found in database</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- CREATE MODAL --}}
        <div x-show="showCreate" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak x-transition>
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl" @click.away="showCreate = false">
                <h2 class="text-2xl font-black text-slate-800 mb-6">New Section</h2>
                <form action="{{ route('admin.sections.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Section Name" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold outline-none">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="section_id" placeholder="Code" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold outline-none">
                        <input type="number" name="capacity" placeholder="Max" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <select name="year_level" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold uppercase text-[10px] outline-none">
                            <option value="">Year Level</option>
                            @foreach($levelsMap as $key => $label) <option value="{{ $key }}">{{ $label }}</option> @endforeach
                        </select>
                        <select name="shift" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold uppercase text-[10px] outline-none">
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Whole Day">Whole Day</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-6">
                        <button type="button" @click="showCreate = false" class="flex-1 py-4 font-black uppercase text-[10px] text-slate-400">Cancel</button>
                        <button type="submit" class="flex-1 bg-green-700 text-white py-4 rounded-2xl font-black uppercase text-[10px] shadow-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div x-show="showEdit" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak x-transition>
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl" @click.away="showEdit = false">
                <h2 class="text-2xl font-black text-slate-800 mb-6">Update Section</h2>
                <form :action="'{{ url('admin/sections') }}/' + active.section_id" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <input type="text" name="name" x-model="active.name" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold outline-none">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="section_id" x-model="active.section_id" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold outline-none">
                        <input type="number" name="capacity" x-model="active.capacity" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <select name="year_level" x-model="active.year_level" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold uppercase text-[10px] outline-none">
                            @foreach($levelsMap as $key => $label) <option value="{{ $key }}">{{ $label }}</option> @endforeach
                        </select>
                        <select name="shift" x-model="active.shift" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl font-bold uppercase text-[10px] outline-none">
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Whole Day">Whole Day</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-6">
                        <button type="button" @click="showEdit = false" class="flex-1 py-4 font-black uppercase text-[10px] text-slate-400">Cancel</button>
                        <button type="submit" class="flex-1 bg-green-700 text-white py-4 rounded-2xl font-black uppercase text-[10px] shadow-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>