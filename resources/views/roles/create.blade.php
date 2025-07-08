<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Create Role</h2>
            <a href="{{ route('roles.index') }}" class="px-5 py-3 text-sm text-white rounded-md bg-slate-700">     ← Back to Roles</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Role Name:</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-1/2 px-3 py-2 border border-gray-300 rounded shadow-sm"
                                   placeholder="Enter role name" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Assign Permissions:</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($permissions as $permission)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="mr-2">
                                        {{ $permission->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit"
                                class="px-4 py-2 text-sm text-white rounded bg-slate-700 hover:bg-red-600">
                            Submit
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
