<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Roles</h2>
            <a href="{{ route('roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800">
                Create Role
            </a>
        </div>
    </x-slot>

    <x-message />

    <div class="py-6">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 border-b text-xs font-semibold uppercase">
                    <tr>
                        <th class="px-6 py-3">Role Name</th>
                        <th class="px-6 py-3">Permissions</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $role->name }}</td>
                            <td class="px-6 py-4">
                                @if ($role->permissions->count())
                                    {{ $role->permissions->pluck('name')->join(', ') }}
                                @else
                                    <span class="text-gray-400">No permissions</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                No roles found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
