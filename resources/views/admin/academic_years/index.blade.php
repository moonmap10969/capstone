<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Manage Academic Years</title>
</head>
<body class="min-h-screen flex bg-gray-50">
    @include('admin.layouts.sidebar')

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-green-700">Academic Year Management</h1>
            <a href="{{ route('admin.index') }}" class="text-gray-500 hover:text-green-700 font-medium">← Back to Dashboard</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Add New Period</h2>
                <form action="{{ route('admin.ay.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Year Range</label>
                        <input type="text" name="year_range" placeholder="e.g. 2025-2026" class="w-full border-gray-300 rounded-lg p-2 mt-1 bg-gray-50 border focus:ring-2 focus:ring-green-500 outline-none" required>
                    </div>
                  <div>
                    <label class="block text-sm font-bold text-gray-700">Semester</label>
                    <select name="semester" class="w-full border-gray-300 rounded-lg p-2 mt-1 bg-gray-50 border focus:ring-2 focus:ring-green-500 outline-none">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="3rd Semester">3rd Semester</option> 
                        <option value="Midyear">Midyear</option> </select>
                </div>
                    <button type="submit" class="w-full bg-green-700 text-white font-bold py-2 rounded-lg hover:bg-green-800 transition">Create Period</button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-4 text-sm font-bold text-gray-600">Year Range</th>
                            <th class="p-4 text-sm font-bold text-gray-600">Semester</th>
                            <th class="p-4 text-sm font-bold text-gray-600 text-center">Status</th>
                            <th class="p-4 text-sm font-bold text-gray-600 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($years as $year)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{ $year->year_range }}</td>
                            <td class="p-4 text-gray-600">{{ $year->semester }}</td>
                            <td class="p-4 text-center">
                                @if($year->is_current)
                                    <span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">Active</span>
                                @else
                                    <span class="bg-gray-100 text-gray-400 text-[10px] font-black px-3 py-1 rounded-full uppercase">Inactive</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                @if(!$year->is_current)
                                    <form action="{{ route('admin.ay.set', $year->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm font-bold text-blue-600 hover:underline">Set as Active</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>