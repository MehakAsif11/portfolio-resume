<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Permissions</h2>

            @can('create permissions')
                <a href="{{ route('permissions.create') }}"
                   class="px-5 py-3 text-sm text-white rounded-md bg-slate-700 hover:bg-slate-900">
                    CREATE
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message />

            {{-- 🔍 Debug info --}}
            <div class="p-4 mb-4 text-sm text-black bg-yellow-100 rounded">
                <strong>User:</strong> {{ auth()->user()->name }} <br>
                <strong>Roles:</strong> {{ auth()->user()->getRoleNames()->join(', ') }} <br>
                <strong>Permissions:</strong> {{ auth()->user()->getAllPermissions()->pluck('name')->join(', ') }}
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

 <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs font-medium text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Created</th>
                                <th class="px-6 py-3">Roles</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        

                                           @forelse ($permissions as $permission)
                                <tr id="permission-row-{{ $permission->id }}" class="border-b hover:bg-gray-100">
                                    <td class="px-6 py-3">{{ $permission->id }}</td>
                                    <td class="px-6 py-3">{{ $permission->name }}</td>
                                    <td class="px-6 py-3">{{ $permission->created_at->format('d M, Y') }}</td>
                                    <td class="px-6 py-3">
                                        @foreach ($permission->roles as $role)
                                            <span class="inline-block px-2 py-1 mr-1 text-xs text-green-800 bg-green-100 rounded">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-3 space-x-2 text-center">
                                        @can('edit permissions')
                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                               class="px-3 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-green-600">
                                                EDIT
                                            </a>
                                        @endcan

                                        @can('delete permissions')
                                            <button onclick="deletePermission({{ $permission->id }})"
                                                    class="px-3 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-800">
                                                DELETE
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No permissions found.</td>
                                </tr>
                            @endforelse 
                            

                        </tbody>
                    </table> 

  </div>
            </div>
        </div>
    </div>
{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




                    
                    {{-- <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs font-medium text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Created</th>
                                <th class="px-6 py-3">Roles</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                                <tr id="permission-row-{{ $permission->id }}" class="border-b hover:bg-gray-100">
                                    <td class="px-6 py-3">{{ $permission->id }}</td>
                                    <td class="px-6 py-3">{{ $permission->name }}</td>
                                    <td class="px-6 py-3">{{ $permission->created_at->format('d M, Y') }}</td>
                                    <td class="px-6 py-3">
                                        @foreach ($permission->roles as $role)
                                            <span class="inline-block px-2 py-1 mr-1 text-xs text-green-800 bg-green-100 rounded">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-3 space-x-2 text-center">
                                        @can('edit permissions')
                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                               class="px-3 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-green-600">
                                                EDIT
                                            </a>
                                        @endcan

                                        @can('delete permissions')
                                            <button onclick="deletePermission({{ $permission->id }})"
                                                    class="px-3 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-800">
                                                DELETE
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No permissions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table> --}}
              

    {{-- jQuery + CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- AJAX Delete Script --}}
     <script>
        function deletePermission(id) {
            if (confirm("Are you sure you want to delete this permission?")) {
                $.ajax({
                    url: '{{ route("permissions.destroy") }}',
                    type: 'DELETE',
                    data: { id: id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status) {
                            $('#permission-row-' + id).fadeOut(300, function () {
                                $(this).remove();
                            });
                        } else {
                            alert("Delete failed: " + res.message);
                        }
                    },
                    // error: function () {
                    //     alert(".");An error occurred while deletin
                    // }
                });
            }
        }
    </script> 
   
</x-app-layout>
