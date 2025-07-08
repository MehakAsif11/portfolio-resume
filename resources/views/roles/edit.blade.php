<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Edit Role</h2>
            <a href="{{ route('roles.index') }}" class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">     ← Back to Roles</a>
        </div>
    </x-slot>

    <x-message />

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="max-w-2xl p-6 mx-auto bg-white rounded shadow">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Role Name:</label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}"
                                class="w-full px-3 py-2 mt-1 border border-gray-300 rounded shadow-sm" required>
                            @error('name')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Permissions:</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($permissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                        <span class="text-sm">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="px-4 py-2 text-sm text-white rounded bg-slate-700 hover:bg-red-600">
                            Update Role
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
