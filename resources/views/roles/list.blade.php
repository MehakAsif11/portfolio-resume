<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Roles List</h2>
            <a href="{{ route('roles.create') }}" class="px-4 py-2 text-sm text-white rounded bg-slate-700 hover:bg-slate-900">
                CREATE
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif

                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3 text-center">Permissions</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr id="role-row-{{ $role->id }}" class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3">{{ $role->name }}</td>
                                    <td class="px-6 py-3 text-center">
                                        @forelse ($role->permissions as $permission)
                                            <span class="inline-block px-2 py-1 text-xs text-green-800 bg-green-100 rounded">
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-gray-400">No permissions</span>
                                        @endforelse
                                    </td>
                                    <td class="px-6 py-3 space-x-2 text-center">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="px-3 py-1 text-sm text-white rounded bg-slate-700 hover:bg-green-600">EDIT</a>
                                        <button onclick="deleteRole({{ $role->id }})" class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-800">DELETE</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No roles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- AJAX Delete --}}
    <script>
        function deleteRole(id) {
            if (confirm("Are you sure you want to delete this role?")) {
                $.ajax({
                    url: '/roles/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status) {
                            $('#role-row-' + id).fadeOut(300, function () {
                                $(this).remove();
                            });
                        } 
                        else {
                            alert('Delete failed');
                        }
                    },
                    // error: function () {
                    //     alert('Server error');
                    // }
                });
            }
        }
    </script>
</x-app-layout>
