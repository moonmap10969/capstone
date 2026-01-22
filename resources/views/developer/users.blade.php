<title>Admin - Manage Users</title>

@include('layouts.sidebar')

<main class="flex-1 bg-blue-50 p-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manage Users</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
            + Add New User
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $user->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $user->role }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-700 hover:underline">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</main>



