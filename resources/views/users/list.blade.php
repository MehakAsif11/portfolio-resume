<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Users List</h2>
            <a href="{{ route('users.create') }}"
               class="px-5 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-slate-900">
                CREATE
            </a>
        </div>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl">
        <x-message />

        <div class="px-4 py-6 bg-white rounded-md shadow-md">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3" width="60">ID</th>
                        <th class="px-6 py-3">NAME</th>
                        <th class="px-6 py-3">EMAIL</th>
                        <th class="px-6 py-3" width="180">ROLES</th>
                        <th class="px-6 py-3 text-center" width="180">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
{{-- <tbody>
    @forelse($users as $user)
        <tr class="border-b hover:bg-gray-50">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            ...
        </tr>
    @empty
        <tr><td>No users found.</td></tr>
    @endforelse
</tbody> --}}
{{-- <tr id="user-row-{{ $user->id }}"> --}}

                            @forelse ($users as $user)
                            <tr id="user-row-{{ $user->id }}" class="border-b hover:bg-gray-50">
{{-- <tr class="border-b hover:bg-gray-50"> --}}
                            <td class="px-6 py-3">{{ $user->id }}</td>
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                @if($user->getRoleNames()->isNotEmpty())
                                    @foreach ($user->getRoleNames() as $role)
                                        <span class="inline-block px-2 py-1 mr-1 text-xs font-medium text-green-800 bg-green-100 rounded">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-sm text-gray-400">No roles</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 space-x-1 text-center">
                                {{-- @can('edit users')
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="px-3 py-1 text-sm text-white bg-black-600 hover:bg-black-800">
                                        Edit
                                    </a>
                                @endcan --}}


                                  @can('edit users')

<a href=" {{ route("users.edit",$user->id) }}" class="px-3 py-2 text-sm text-white rounded-md bg-slate-700 hover:bg-success-600">EDIT</a>
                   @endcan

                                @can('delete users')
                                    {{-- <button onclick="deleteUser({{ $user->id }})"
                                            class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-800">
                                        Delete
                                    </button> --}}


<button type="button" onclick="deleteUser({{ $user->id }})"
    class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-800">
    Delete
</button>
<tr id="user-row-{{ $user->id }}" class="border-b hover:bg-gray-50">

                                    
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

  
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function deleteUser(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: '/users/' + id,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#user-row-' + id).remove(); // ✅ No reload, just remove row
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Unable to delete.'));
                }
            });
        }
    }
</script> --}}

    <script>
    function deleteUser(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: '/users/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message || 'User deleted');
                    $('#user-row-' + id).remove();
                },
                error: function(xhr) {
                    alert("Delete failed");
                }
            });
        }
    }
</script>


</x-app-layout>
